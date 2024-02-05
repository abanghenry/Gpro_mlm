<?php

namespace App\Http\Controllers;

use App\Mail\OrderPlaced;
use App\Mail\TestimonialCreated;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $testimonials = Testimonial::where('user_id', Auth::user()->id)
                                ->with('user')->get();
        return Inertia::render('Testimonial/Index', [
            'pageTitle'=>"Testimonial",
            'testimonials'=>$testimonials,
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Testimonial/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'message' =>'required',
        ]);
        $testimonial = new Testimonial();
        $testimonial->user_id = Auth::user()->id;
        $testimonial->message = $request->message;
        $testimonial->status ="pending";
        $testimonial->save();

        // send queue email to all admin
        $systemAdmins = User::where('type',User::ADMIN_USER)->pluck('email');
        foreach ($systemAdmins as $recipient) {
            Mail::to($recipient)
                ->queue(new TestimonialCreated($testimonial));
        }


        return redirect('testimonial')->with('success', 'New testimonial created successfully !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function show(Testimonial $testimonial)
    {
       $testimonial = Testimonial::where('user_id', Auth::user()->id)
                                    ->where('id', $testimonial->id)
                                    ->first();

        return Inertia::render('Testimonial/View')->with(['testimonial'=>$testimonial]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function edit(Testimonial $testimonial)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Testimonial $testimonial)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function destroy(Testimonial $testimonial)
    {
        //
    }
}
