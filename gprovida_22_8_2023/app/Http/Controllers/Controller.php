<?php

namespace App\Http\Controllers;

use App\Models\UserStore;
use Auth;
use Illuminate\Support\Facades\Session;
use View;
use App\Models\Store;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    private $user ;

    public function __construct() {
        //print "In BaseClass constructor\n";
        //if auth user, check if activated and show wall,
        // check if email is verified and send notice



        //$this->middleware('auth');

        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            if($this->user){
                $user_store_ids = UserStore::where('user_id', $this->user->id)->get()->pluck('store_id');
                $user_store = Store::whereIn('id', $user_store_ids)->get();
                Session::put('user_stores', $user_store);
            }
            return $next($request);
        });





    }
}
