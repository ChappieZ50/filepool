<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserAvatarRequest;
use App\Http\Requests\User\UserPasswordRequest;
use App\Http\Requests\User\UserRequest;
use App\Models\File as FileModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function profile()
    {
        $user = auth()->user();
        return view('user.profile')->with('user', $user);
    }

    /* Getting user's files */
    public function userImages()
    {
        $files = FileModel::where('user_id', auth()->user()->id)->orderByDesc('id')->paginate();
        return view('user.files')->with('files', $files);
    }

    /* Deleting file and database record */
    public function destroyFile($id)
    {
        $file = FileModel::where('id', $id)->where('user_id', Auth::user()->id)->first();
        if ($file) {
            $destroy = delete_file($file);

            if ($destroy) {
                $file->delete();
                return response()->json(['status' => true]);
            }
        }

        return response()->json(['status' => false]);
    }

    public function update(UserRequest $request)
    {
        $update = Auth::user()->update($request->validated());

        if ($update) {
            return response()->json(['status' => true]);
        }

        return response()->json([], 500);
    }

    public function updatePassword(UserPasswordRequest $request)
    {
        $password = Hash::make($request->get('password'));

        $update = Auth::user()->update([
            'password' => $password
        ]);

        if ($update) {
            return response()->json(['status' => true]);
        }

        return response()->json([], 500);
    }


    public function updateAvatar(UserAvatarRequest $request)
    {
        $user = Auth::user();

        $avatar = upload_file($request->file('avatar'), config('imgpool.user_avatars_folder'), $user->avatar)->getData();
        if ($avatar) {
            $update = $user->update([
                'avatar' => $avatar->name
            ]);
            if ($update) {
                return response()->json(['status' => true]);
            }
        }

        return response()->json([], 500);
    }

    public function destroyAvatar()
    {
        File::delete(config('imgpool.user_avatars_folder') . '/' . auth()->user()->avatar);
        Auth::user()->update([
            'avatar' => ''
        ]);
        return response()->json(['status' => true]);
    }
}
