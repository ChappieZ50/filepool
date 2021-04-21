<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserAvatarRequest;
use App\Http\Requests\User\UserPasswordRequest;
use App\Http\Requests\User\UserRequest;
use App\Models\File as FileModel;
use App\Repositories\FileRepository;
use Carbon\Carbon;
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
        $expire = request()->get('expire');
        $files = FileModel::where('user_id', auth()->user()->id)->orderByDesc('id');
        if (in_array($expire, config('filepool.file_expires'))) {
            if ($expire === 'never') {
                $files->whereNull('expire');
            } else {
                $files->whereDate('expire', '>=', Carbon::now()->addDays($expire)->format('Y-m-d H:i:s'));
            }
        }
        $files = $files->paginate(36);
        return view('user.files')->with('files', $files);
    }

    /* Deleting file and database record */
    public function destroyFile($id)
    {
        $file = FileModel::where('file_id', $id)->where('user_id', Auth::user()->id)->first();
        return FileRepository::delete($file);
    }

    public function filePassword()
    {
        $id = request()->get('id');
        $file = FileModel::where('file_id', $id)->where('user_id', Auth::user()->id)->first();

        if ($file) {
            return response()->json(['status' => true, 'password' => $file->password]);
        }

        return response_server_error();
    }

    public function update(UserRequest $request)
    {
        $update = Auth::user()->update($request->validated());

        if ($update) {
            return response()->json(['status' => true, 'message' => __('page.front.user.profile_update')]);
        }

        return response_server_error();
    }

    public function updatePassword(UserPasswordRequest $request)
    {
        $password = Hash::make($request->get('password'));

        $update = Auth::user()->update([
            'password' => $password
        ]);

        if ($update) {
            return response()->json(['status' => true, 'message' => __('page.front.user.password_update')]);
        }

        return response_server_error();
    }


    public function updateAvatar(UserAvatarRequest $request)
    {
        $user = Auth::user();
        $avatar = upload_website_file($request->file('avatar'), config('filepool.user_avatars_folder'))->getData();

        if ($avatar->status) {
            $user->update([
                'avatar' => $avatar->name
            ]);
            return response()->json([
                'status'  => true,
                'message' => __('page.front.user.avatar_update')
            ]);
        }

        return response_server_error();
    }

    public function destroyAvatar()
    {
        File::delete(config('filepool.user_avatars_folder') . '/' . auth()->user()->avatar);
        Auth::user()->update([
            'avatar' => ''
        ]);
        return response()->json(['status' => true, 'message' => __('page.front.user.avatar_delete')]);
    }
}
