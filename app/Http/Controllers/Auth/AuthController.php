<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Socialite;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

/**
 * Description of AuthController
 *
 * @author Mayada
 */
class AuthController extends Controller{
    protected $redirectTo = '/auth/facebook/callback';

    public function redirectToProvider($provider){
        return Socialite::driver($provider)->redirect();
    }
    
     public function handleProviderCallback($provider,Request $request)
    {
        if (!$request->has('code') || $request->has('denied')) {
            return redirect('/');
        }
        $request->session()->put('state',Str::random(40));
        $user = Socialite::driver($provider)->stateless()->user();
//        $user = Socialite::driver($provider)->user();

        $authUser = $this->findOrCreateUser($user, $provider);
        Auth::login($authUser, true);
//        return redirect($this->redirectTo);
        return redirect ('/home');

    }
    public function findOrCreateUser($user, $provider)
    {
        $authUser = User::where('provider_id', $user->id)->first();
        if ($authUser) {
            return $authUser;
        }
        return User::create([
            'first_name'     => $user->name,
            'email'    => $user->email,
            'provider' => $provider,
            'provider_id' => $user->id
        ]);
    }
}
