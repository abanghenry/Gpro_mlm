<?php

namespace App\Http\Controllers;

use App\Events\SupportTicketCreated;
use App\Events\SupportTicketUpdated;
use App\Mail\TestimonialCreated;
use App\Models\Order;
use App\Models\Support;
use App\Models\Testimonial;
use App\Models\TicketStatus;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;

class SupportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $supports = Support::where('user_id', Auth::user()->id)
                            ->whereNull('parent_id')
                            ->with('user', 'status')
                            ->get();
        return Inertia::render('Support/Index', [
            'pageTitle'=>"supports",
            'supports'=>$supports,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Support/Create', ['user'=>Auth::user() ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required',
            'message' => 'required',
        ]);

        $user = Auth::user();
        $ticketStatus = TicketStatus::where('name','Open')->first();

        $support = new Support();
        $support->user_id       = $user->id;
        $support->subject       = $request->subject;
        $support->message       = $request->message;
        $support->status_id     = $ticketStatus->id;
        $support->urgency       = $request->urgency;
        $support->save();

        $support->ticket_id     =576244+$support->id;
        $support->save();

        event(new SupportTicketCreated($support));


        return redirect('support')->with('success', 'New Support Ticket created successfully !');



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($encrypted_id)
    {

        try {
            $ticket_id = base64_decode($encrypted_id);
        }catch (\Exception $exception){
            return redirect('/support')->with(['error'=>'Unknown Ticket']);
        }

        $ticket = Support::where('ticket_id',$ticket_id)
                    ->where('user_id', Auth::user()->id)
                    ->with('user', 'children.user','status')
                    ->first();

        //dd($ticket);

        return Inertia::render('Support/Edit')->with(['user'=>Auth::user(), 'ticket'=>$ticket ]);

    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($encrypted_id)
    {
        try {
            $ticket_id = base64_decode($encrypted_id);
        }catch (\Exception $exception){
            return redirect('/support')->with(['error'=>'Unknown Ticket']);
        }

        $ticket = Support::where('ticket_id',$ticket_id)
            ->where('user_id', Auth::user()->id)
            ->with('user', 'children','status')
            ->first();
        return Inertia::render('Support/Edit')->with(['user'=>Auth::user(), 'ticket'=>$ticket ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $oldTicket = Support::where('user_id',Auth::user()->id)
                        ->where('id', $id)
                        ->with('user', 'status')
                        ->first();
        if(!$oldTicket){
            return redirect('support')->with('error', 'Ticket Not found!');
        }


        $ticketStatus = TicketStatus::where('name','Customer-Reply')->first();
        $oldTicket->status_id     = $ticketStatus->id;
        $oldTicket->last_reply    = now();
        $oldTicket->save();

        $user = Auth::user();
        $reply = new Support();
        $reply->parent_id     = $oldTicket->id;
        $reply->user_id       = $user->id;
        $reply->subject       = $oldTicket->subject;
        $reply->message       = $request->message;
        $reply->status_id     = $ticketStatus->id;
        $reply->urgency       = $oldTicket->urgency;
        $reply->save();

        $reply->ticket_id     =576244+$reply->id;
        $reply->save();

        event(new SupportTicketUpdated($reply, $oldTicket));
        return redirect('support')->with('success', 'Support Ticket Updated !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
