<?php

namespace App\Http\Middleware;

use App\Models\Store;
use App\Models\UserStore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Inertia\Middleware;
use Tightenco\Ziggy\Ziggy;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request)
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed[]
     */
    public function share(Request $request)
    {

        return array_merge(parent::share($request), [
            'auth' => [
                'user' => $request->user(),
            ],
            'store' => [
                'user_stores' =>Session::get('user_stores'),
            ],
            'ziggy' => function () use ($request) {
                return array_merge((new Ziggy)->toArray(), [
                    'location' => $request->url(),
                ]);
            },
            'flash' => function () use ($request) {
                return [
                    'success' => $request->session()->get('success'),
                    'error' => $request->session()->get('error'),
                ];
            },

        ]);
    }




    // abandoned
    public function getStore($request){
        if($request->user()){
            $user_store_ids = UserStore::where('user_id', $request->user()->id)->get()->pluck('store_id');
            $user_store = Store::whereIn('id', $user_store_ids)->get();
            Session::put('user_stores', $user_store);
        }
    }
}

