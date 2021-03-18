<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\LoginRequest;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function index()
    {
        return view('login')->with('no_header', true);
    }

    public function store(LoginRequest $request)
    {
        $credentials = [
            'email'    => $request->get('email'),
            'password' => $request->get('password')
        ];

        /* Auth user by given credentials */
        if (Auth::attempt($credentials)) {
            /* If user banned then logout and back with error */
            if (!Auth::user()->status && !Auth::user()->is_admin) {
                Auth::logout();
                return back()->withErrors([
                    'non' => 'Your account has been banned',
                ]);
            }
            /* Return admin home if is admin user */
            if (Auth::user()->is_admin) {
                return redirect()->route('admin.home');
            }
            return redirect()->route('user.profile');
        }

        return back()->withErrors([
            'non' => 'Email or password is incorrect.',
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }
}
