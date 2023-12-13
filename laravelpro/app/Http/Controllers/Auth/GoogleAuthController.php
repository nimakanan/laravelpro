<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Psy\Util\Str;
use RealRashid\SweetAlert\Facades\Alert;

class GoogleAuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->stateless()->redirect();
    }

    public function callback()
    {
        try {
            $googleuser = Socialite::driver('google')->stateless()->user();

            $user = User::where('email', $googleuser->email)->first();
            if ($user) {
                auth()->loginUsingId($user->id);
            } else {
                $newuser = User::create([
                    'name' => $googleuser->name,
                    'email' => $googleuser->email,
                    'password' => bcrypt(\Str::random(16)),
                ]);

                auth()->loginUsingId($newuser->id);
            }
            return redirect('/');

        }
 catch (\Exception $e) {
           Alert::error('ورود با گوگل موفق آمیز نبود');
           return redirect("/login");
        }

    }
}
