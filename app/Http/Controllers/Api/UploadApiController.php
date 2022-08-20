<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadApiController extends Controller
{
    public function get($uuid, $path, $name) {
        $fileName = $name !== 'hello' ? $uuid . '/' . $path . '/' . $name : Storage::disk('public')->files($uuid . '/' . $path)[0];
        $path = Storage::disk('public')->path($fileName);
        return response()->file($path);
    }

    public function upload(Request $request, $uuid, $path, $single=false) {
        if($single) {
            Storage::disk('public')->deleteDirectory($uuid . '/' . $path);
        }

        $filename = $request->file('image')->store($uuid . '/' . $path, 'public');

        return response()->json(['status' => 'success', 'filename' => $filename]);
    }

    public function delete(Request $request) {
        $data = json_decode($request->getContent(), true);
        Storage::disk('public')->delete($data['filename']);

        return response()->json(['status' => 'success']);
    }
}
