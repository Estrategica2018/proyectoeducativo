<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    //

        public function redirect(){
            return Socialite::driver('facebook')->user();
        }

        public function callback(){
            $user = Socialite::driver('facebook')->user();
            return $user->getAvatar();
        }
}
