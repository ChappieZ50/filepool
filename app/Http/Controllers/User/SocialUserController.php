<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialUserController extends Controller
{
    public function googleLogin()
    {
        return Socialite::driver('google')->redirect();
    }

    public function facebookLogin()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleGoogleLogin()
    {
        return $this->setSocialUser('google');
    }

    public function handleFacebookLogin()
    {
        return $this->setSocialUser('facebook');
    }

    private function setSocialUser($driver, $column = '')
    {
        $column = empty($column) ? $driver : $column;
        $socialUser = Socialite::driver($driver)->user();

        if ($socialUser) {
            $user = User::where($column, $socialUser->id)->first();
            if ($user) {
                if (!$user->status) {
                    return redirect()->route('user.login.index')->withErrors([
                        'non' => 'Your account has been banned',
                    ]);
                }
                Auth::login($user);
                return redirect()->route('home');
            }

            $find = User::where('email', $socialUser->email)->first();

            /* If user already registered with normal register form then return back */
            if ($find) {
                return redirect()->route('user.login.index')->withErrors([
                    'non' => 'User already exists. Sign in with email password.'
                ]);
            }

            $user = User::create([
                'username' => $socialUser->name,
                'email'    => $socialUser->email,
                $column    => $socialUser->id,
                'password' => bcrypt($socialUser->id),
            ]);
            Auth::login($user);
            return redirect()->route('home');
        }

        return abort(404);
    }
}
