<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ProfileController extends Controller
{

    public function profile(){
        return Inertia::render('Profile/View')->with(['user'=>Auth::user()]);

    }

    public function editProfile(){

    }
    public function changePassword(){

    }
}
