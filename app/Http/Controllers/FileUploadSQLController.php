<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileUploadSQLController extends Controller
{
    public function upload(Request $request)
    {
        if ($request->file->getClientMimeType() == "application/sql") {
            $fileName = $request->file->getClientOriginalName();

            if (empty(Storage::disk('db')->exists($fileName))) {
                $fileModel = new File;
                $filePath = $request->file('file')->storeAs('db', $fileName);
                $fileModel->name = $request->file->getClientOriginalName();
                $fileModel->path = '/storage/' . $filePath;
                $fileModel->save();

                return redirect('home')->with('status_upload', 'File Has been uploaded successfully');
            } else {
                return redirect('home')->with('status_upload', 'File already exist');
            }
        } else {
            return back()->withErrors(['file' => 'The file must be sql type']);
        }
    }
}
