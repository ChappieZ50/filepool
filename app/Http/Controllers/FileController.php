<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileDownloadRequest;
use App\Http\Requests\FileRequest;
use App\Models\File;
use App\Repositories\FileRepository;

class FileController extends Controller
{

    public function store(FileRequest $request)
    {
        $file = $request->file('file');
        $storage = FileRepository::findStorage();

        $file = upload_file($file, $storage['upload_folder'], '', $storage['disk'])->getData();
        return FileRepository::create($file, $request, $storage['storage']);
    }

    public function downloadFile(FileDownloadRequest $request)
    {
        $file = File::where('file_id', $request->get('id'))->first();

        return FileRepository::downloadFile($file, $request);
    }

    public function show($file)
    {
        $file = File::where('file_id', $file)->first();
        return $file ? view('file')->with('file', $file) : abort(404);
    }
}
