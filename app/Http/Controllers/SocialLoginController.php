<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use App\Models\SocialLogin;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class SocialLoginController extends Controller
{
    public function redirectToGoogle (){
        return Socialite::driver ('google')->redirect();
    }
    
    public function handleGoogleCallback(){
        $user = Socialite::driver('google')->user();

        $user_account = SocialLogin::where('provider', 'google')->where('provider_id', $user->getId())->first();
        
        if($user_account) {
            Auth::Login($user_account->user);

            Session::regenerate();

            return redirect()->intended('dashboard');
        }

        $db_user = User::where('email', $user->getEmail())->first();

        if($db_user) {
            SocialLogin::create([
                'provider' => 'google',
                'provider_id' => $user->getId(),
                'user_id' => $db_user->id
            ]);
        }else {
            $db_user = User::create([
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'password'=>bcrypt(rand(1000,9999))
            ]);
        }

        Auth::Login($db_user);

        Session::regenerate();

        return redirect()->intended('dashboard');

    }

}
