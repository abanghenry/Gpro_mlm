<?php

namespace App\Listeners;


use App\Models\UsersLoginLog;
use Illuminate\Auth\Events\Logout;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class LogSuccessfulLogout
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Illuminate\Auth\Events\Logout  $event
     * @return void
     */
    public function handle(Logout $event)
    {
        Auth::user()->last_login_date = date("Y-m-d H:i:s");
        Auth::user()->last_login_ip = Request::getClientIp();
        Auth::user()->save();

        $loginActivity  = new UsersLoginLog();
        $loginActivity->user_id    = $event->user->id;
        $loginActivity->username   = $event->user->username;
        $loginActivity->ip_address = Request::getClientIp();
        $loginActivity->date_time  = date("Y-m-d H:i:s");
        $loginActivity->action     = "logout";
        $loginActivity->save();
    }
}
