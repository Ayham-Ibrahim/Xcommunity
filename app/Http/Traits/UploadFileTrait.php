<?php

namespace App\Http\Traits;

use Illuminate\Http\Request;


trait UploadFileTrait
{

    public function UploadFile(Request $request, $folderName, $fileName, $disk)
    {
        $photo = time() . '.' . $request->file($fileName)->getClientOriginalName();
        $path = $request->file($fileName)->storeAs($folderName, $file, $disk);
        return $path;
    }


    public function downloadFile($file,$folder)
    {
        $path = storage_path(assets("files/{$folder}/{$file}"));

        if (file_exists($path)) {
            return response()->download($path);
        } else {
            return response()->json(['message' => 'Not Found!'], 404);
        }
    }

}
