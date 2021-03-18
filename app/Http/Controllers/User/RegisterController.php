<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register')->with('no_header', true);
    }

    public function store(RegisterRequest $request)
    {
        $user = new User([
            'username' => $request->get('username'),
            'email'    => $request->get('email'),
            'password' => bcrypt($request->get('password')),
        ]);
        /* Saving user */
        if ($user->save()) {
            $credentials = [
                'email'    => $user->email,
                'password' => $request->get('password'),
            ];
            Auth::attempt($credentials);
            return redirect()->route('user.profile');
        }

        return back()->withErrors([
            'non' => 'Something wrong please try again.'
        ]);
    }
}
