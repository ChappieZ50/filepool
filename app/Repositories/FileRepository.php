<?php

namespace App\Repositories;

use App\Models\File;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class FileRepository
{

    public static function create($file, $request, $storage)
    {
        $expire = $request->get('expire');
        $password = $request->get('password');
        $create = [
            // File unique id
            'file_id'          => $file->file_id,
            // File unique id with file extension
            'file_full_id'     => $file->file_id . '.' . $file->extension,
            // File original name
            'file_original_id' => $file->file_original_id,
            // File size with bytes
            'file_size'        => $file->file_size,
            // File extension type
            'file_mime'        => $file->extension,
            // File uploaded place - "aws" or "local"
            'uploaded_to'      => $storage,
            // File's password
            'password'         => $password,
            // File expire date - If expire is null then file won't delete automatically
            'expire'           => $expire === 'never' ? null : Carbon::now()->addDays($expire),
        ];

        // If user logged
        if (Auth::check()) {
            $user = Auth::user();
            // User connecting to file
            $create['user_id'] = $user->id;
            // User storage updating if storage limit not full
            $storage = check_storage_limit($user->storage, $user->storage_limit, $file->file_size);

            // Blocking file upload
            if ($storage === false) {
                return response()->json(['status' => false, 'message' => 'Your storage is full, you should buy storage'], Response::HTTP_REQUEST_ENTITY_TOO_LARGE);
            }

            $user->update([
                'storage' => $storage
            ]);
        }

        $create = File::create($create);
        if ($create) {
            return response()->json(['url' => route('file.show', $file->file_id)]);
        }

        return response()->json([], 500);
    }

    public static function findStorage()
    {
        $setting = Setting::first();

        if ($setting && $setting->uploads_storage === 'aws') {
            // Aws storage settings
            return [
                'disk'          => 's3',
                'storage'       => 'aws',
                'upload_folder' => config('filepool.aws_folder')
            ];
        }

        // Default storage settings
        return [
            'disk'          => '',
            'storage'       => 'local',
            'upload_folder' => config('filepool.local_folder')
        ];
    }

    public static function downloadFile($file, Request $request)
    {
        if ($file) {
            // User can download directly this file if his own file
            if (Auth::check() && Auth::user()->id === $file->user->id) {
                return download_file($file);
            }

            // Password checking if file's has password
            if (!empty($file->password) && $request->get('password') != $file->password) {
                return response()->json(['status' => false, 'message' => 'Password incorrect'], 401);
            } else {
                return download_file($file);
            }
        }

        return response()->json(['status' => false, 'message' => 'File not found']);
    }

    public static function delete($file)
    {
        if ($file) {
            // Deleting file
            $destroy = delete_file($file);

            if ($destroy) {
                if ($file->user) {
                    // Restoring user's storage
                    $size = $file->user->storage - $file->file_size;
                    $file->user->update([
                        'storage' => $size < 0 ? 0 : $size,
                    ]);
                }

                // Deleting record
                $file->delete();
                return response()->json(['status' => true]);
            }
        }

        return response()->json(['status' => false]);
    }
}
