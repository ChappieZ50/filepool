<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File as FacadesFile;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function index(Request $request)
    {
        $files = File::orderByDesc('id');
        if ($request->has('s')) {
            $s = $request->get('s');
            $files->whereHas('user', function ($query) use ($s) {
                return $query->where('username', 'like', '%' . $s . '%')->orWhere('email', 'like', '%' . $s . '%');
            })->orWhere('file_id', 'like', '%' . $s . '%');
        }
        return view('fpool.files.files')->with('files', $files->paginate());
    }

    public function show($id)
    {
        $file = File::findOrFail($id);
        /* If file has not a user then set anonymous user data */
        if (!$file->user) {
            $file->user = json_decode(json_encode(config('filepool.anonymous_user')));
        }

        return view('fpool.files.file')->with('file', $file);
    }

    public function destroy($id)
    {
        $file = File::where('id', $id)->first();

        if ($file) {
            $destroy = delete_file($file);


            if ($destroy) {
                $file->delete();
                return response()->json(['status' => true]);
            }
        }

        return response()->json(['status' => false]);
    }
}
