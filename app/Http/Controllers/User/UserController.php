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
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function profile()
    {
        $user = auth()->user();
        return view('user.profile')->with('user', $user);
    }

    /* Getting user's files */
    public function userFiles()
    {
        $files = FileModel::where('user_id', auth()->user()->id)->orderByDesc('id')->paginate(36);
        return view('user.files')->with('files', $files);
    }

    /* Deleting file and database record */
    public function destroyFile($id)
    {
        $file = FileModel::where('file_id', $id)->where('user_id', Auth::user()->id)->first();

        if ($file) {
            $destroy = delete_file($file);

            if ($destroy) {
                $file->delete();
                return response()->json(['status' => true]);
            }
        }

        return response()->json(['status' => false]);
    }

    public function filePassword()
    {
        $id = request()->get('id');
        $file = FileModel::where('file_id', $id)->where('user_id', Auth::user()->id)->first();

        if ($file) {
            return response()->json(['status' => true, 'password' => $file->password]);
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

        $avatar = $request->file('avatar');
        $extension = $avatar->getClientOriginalExtension();
        $fileId = Str::random(12);
        $name = $fileId . '.' . $extension;

        if ($avatar->move(public_path(config('filepool.user_avatars_folder')), $name)) {
            $user->update([
                'avatar' => $name
            ]);
            return response()->json([
                'status' => true,
            ]);
        }

        return response()->json([], 500);
    }

    public function destroyAvatar()
    {
        File::delete(config('filepool.user_avatars_folder') . '/' . auth()->user()->avatar);
        Auth::user()->update([
            'avatar' => ''
        ]);
        return response()->json(['status' => true]);
    }
}
