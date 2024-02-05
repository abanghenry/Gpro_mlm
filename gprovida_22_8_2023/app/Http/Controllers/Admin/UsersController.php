<?php

namespace App\Http\Controllers\Admin;

use App\Events\UserActivated;
use App\Models\Currency;
use App\Models\User;
use App\Models\UsersLoginLog;
use App\Models\WalletTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class UsersController extends Controller
{
    //

    public function search(Request $request)
    {
        $searchTerm = $request->query('search');
        if ($searchTerm) {
            $users = DB::table('users')
                            ->where('username', 'LIKE', "%{$searchTerm}%")
                            ->orWhere('firstname', 'LIKE', "%{$searchTerm}%")
                            ->orWhere('lastname', 'LIKE', "%{$searchTerm}%")
                            ->get();

            $usersMapped = $users->map(
                function ($user, $key) {
                  $new = [];
                  $new['id']    = $user->id;
                  $new['text']  = $user->username." (".$user->firstname." ".$user->lastname.")";
                  return $new;
                }
            );
            return response()->json($usersMapped);
        }
    }

    public  function getMembers(){
        $members= User::withTrashed()->with('session')->get();

        $activeUsers = DB::table('users')
                                ->where('active', 1)
                                ->count();
        $deletedUsers = DB::table('users')
                        ->whereNotNull('deleted_at')
                        ->count();

        $stockistUsers = DB::table('users')
                        ->where('type', 3)
                        ->count();


        return view('admin.member.index')->with([
            'pageTitle' => "Members",
            'members' => $members,
            'totalMembers' => count($members),
            'totalMembersActive' => $activeUsers,
            'totalMembersDeleted' => $deletedUsers,
            'stockistUsers' => $stockistUsers,
        ]);
    }

    public function show($id){
        $user = User::with('downlines.downlines.downlines','package','currency')->find($id);

        if(!$user){
            return redirect('admin/member')->with(['error'=>'User does not exist' ]);
        }

        $logins = UsersLoginLog::where('user_id', $user->id)
                                    ->orderBy('created_at', 'desc')
                                    ->take(10)
                                    ->get();

        $transactionsGroup = array('pending'=>0,'processing'=>0,'shipped'=>0,'cancelled'=>0,'fraud'=>0, 'refund'=>0 );
        $transactions = DB::table('orders')
            ->where('owner_id', $user->id)
            ->select('status_order', DB::raw('count(*) as total'))
            ->groupBy('status_order')
            ->get();

        foreach ($transactions as  $value) {
            $transactionsGroup[$value->status_order]= $value->total;
        }

        $currencies = Currency::all();
        return view('admin.member.edit')->with([
            'pageTitle' => "Edit member",
            'user' => $user,
            'transactionsGroup'=>$transactionsGroup,
            'currencies' => $currencies,
            'logins' => $logins,
        ]);

    }

    public function activate(Request $request){
        $request->validate([
            'userID' => 'required',
        ]);
        $user = User::find($request->userID);

        $position=""; $parent_id=$user->referred_by;
        event(new UserActivated($user, $parent_id, $position));
        return redirect('admin/members')->with(['status'=>'User Activated successfully' ]);
    }

    public function impersonate(Request $request){
        if($request->task !="impersonate"){
            return redirect('admin/members')->with(['error'=>'Unknown task']);
        }

        $impersonator = auth()->user();
        $persona = User::find($request->userID);

        // Check if persona user exists, can be impersonated and if the impersonator has the right to do so.
        if (!$persona || !$persona->canBeImpersonated() || !$impersonator->canImpersonate()) {
            return redirect('admin/members')->with(['error'=>"You can't impersonate this user"]);
        }

        Session::put('impersonator_id', $impersonator->id);
        Auth::login($persona);
        return redirect('dashboard')->with(['status'=>'Impersonating '.$persona->username ]);

    }

    public function fundwallet(Request $request){
        $request->validate([
            'userID' => 'required',
            'task' => 'required',
            'amount' => 'required|numeric',
        ]);
        $user = User::find($request->userID);
        $user->wallet += $request->amount;
        $user->save();

        WalletTransaction::create([
            'user_id'=> $user->id,
            'amount' => $request->amount,
            'type' => 'credit',
            'currency_code' => $user->currency->code,
            'currency_id' => $user->currency->id,
            'details' => "wallet Fund from Admin",
        ]);

        return redirect('admin/members')->with(['status'=>'User Wallet funded successfully' ]);

    }

    public function updateEmail(Request $request){
        $request->validate([
            'userID' => 'required',
            'task' => 'required',
            'email' => 'required|string|email|max:255',
        ]);
        if($request->task =="updateemail"){
            $user = User::find($request->userID);
            $user->email = $request->email;
            $user->save();
        }

        return redirect('admin/members')->with(['status'=>'User Email updated successfully' ]);

    }

    public function destroy(Request $request){
        if($request->task =="delete"){
            $user = User::find($request->userID);
            $user->delete();
            return redirect('admin/members')->with(['status'=>'User Deleted successfully' ]);
        }else{
            return redirect('admin/members')->with(['error'=>'Unknown task']);
        }
    }



}
