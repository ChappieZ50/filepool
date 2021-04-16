<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Http\Requests\Admin\UserUpdateRequest;
use App\Models\File as FileModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::orderByDesc('id');
        if ($request->has('s')) {
            $s = $request->get('s');
            $users->where('username', 'like', '%' . $s . '%')->orWhere('email', 'like', '%' . $s . '%');
        }
        return view('fpool.users.users')->with('users', $users->paginate());
    }

    public function show($id, Request $request)
    {
        $s = $request->get('s');
        $files = FileModel::orderByDesc('id')->where('user_id', $id)->where(function ($q) use ($s) {
            if ($s) {
                $q->where('file_id', 'like', '%' . $s . '%')->orWhere('file_original_id', 'like', '%' . $s . '%');
            }
        })->paginate();

        $user = User::findOrFail($id);

        return view('fpool.users.user')->with([
            'user'  => $user,
            'files' => $files
        ]);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('fpool.users.user-edit')->with('user', $user);
    }

    public function deleteAvatar($id)
    {
        $user = User::where('id', $id)->first();
        if ($user) {
            File::delete(config('filepool.user_avatars_folder') . '/' . $user->avatar);
            $user->update([
                'avatar' => ''
            ]);
            return response()->json(['status' => true]);
        }


        return response()->json([], 404);

    }

    public function update(User $user, UserUpdateRequest $request)
    {

        $update = $user->update([
            'username'      => $request->get('username'),
            'email'         => $request->get('email'),
            'storage_limit' => mb_to_bytes($request->get('storage_limit')),
            'is_admin'      => $user->id != User::first()->id ? ($request->get('is_admin') ? true : false) : true,
            'is_premium'    => $request->get('is_premium') ? true : false,
        ]);

        if ($update) {
            return back()->with('success', 'User successfully updated.');
        } else {
            return back()->with('error', 'Something gone wrong.');
        }
    }

    public function store(UserRequest $request)
    {
        $user = new User([
            'username' => $request->get('username'),
            'email'    => $request->get('email'),
            'password' => bcrypt($request->get('password')),
            'is_admin' => $request->get('is_admin') ? true : false,
        ]);
        if ($user->save()) {
            return response()->json([
                'status'  => true,
                'message' => 'User Created',
            ]);
        } else {
            return response()->json([
                'status'  => false,
                'message' => 'Something wrong please try again.'
            ], 500);
        }
    }

    /* Ajax Call */
    public function status(Request $request)
    {
        $user = User::where('id', '!=', Auth::user()->id)->find($request->get('user'));
        $update = false;
        if ($user) {
            if ($user->is_admin) {
                return response()->json([
                    'status'  => false,
                    'message' => 'Admin user cannot ban',
                ]);
            }

            $update = $user->update([
                'status' => $request->get('status') ? true : false
            ]);
        }


        return response()->json([
            'status' => $update ? true : false
        ]);
    }
}
