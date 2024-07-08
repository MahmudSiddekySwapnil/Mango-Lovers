<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class ImageDeleteService
{
    public function deleteImage($model, $id, $path, $url)
    {
        $image = $model::find($id);
        if (!$image) {
            return response()->json(['message' => 'Image not found'], 404);
        }
        $fullPath = $path . $image->picture;

        if (Storage::exists($fullPath)) {
            Storage::delete($fullPath);
        }

        $image->delete();

        return response()->json(['message' => 'successful', 'url' => $url]);
    }
}
