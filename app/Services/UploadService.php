<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UploadService
{
    public function handle(UploadedFile $file, string $path, ?string $oldPath = null): string
    {
        if ($oldPath) {
            $this->delete($oldPath);
        }


        $validator = Validator::make(
            ['file' => $file, 'path' => $path],
            [
                'file' => 'required|file|mimes:jpg,jpeg,png|max:2048',
                'path' => 'required|string'
            ]
        );

        if ($validator->fails()) {
            throw new \InvalidArgumentException($validator->errors()->first());
        }

        return $file->store($path, 'public');
    }

    public function delete(String $path){
        if (Storage::disk('public')->exists($path)) {
            return Storage::disk('public')->delete($path);
        }

        return false;
    }

}
