<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;

class UploadController extends BaseController
{
    public function store(Request $request)
    {
        $result = $request->file('file')->storeOnCloudinary();

        $data = File::create([
            'url' => $result->getSecurePath(),
            'name' => $result->getOriginalFileName(),
            'type' => $result->getFileType(),
            'size' => $result->getSize(),
        ]);

        return response()->json([
            "status" => true,
            "data" => $data
        ]);
    }
}
