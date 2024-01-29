<?php

namespace App\Http\Traits;

use Illuminate\Http\Request;


trait UploadFileTrait
{

    public function UploadFile(Request $request, $folderName, $fileName, $disk)
    {
        $file = time() . '.' . $request->file($fileName)->getClientOriginalName();
        $path = $request->file($fileName)->storeAs($folderName, $file, $disk);
        return $path;
    }

}
