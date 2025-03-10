<?php

namespace App\Actions;

use App\Models\File;
use Illuminate\Support\Facades\Storage;

class DeleteFileAction
{
    public static function execute(string $id): void {
        $file = File::find($id);

        self::deleteFromStorage($file);

        $file->delete();
    }

    private static function deleteFromStorage(File $file): void
    {
        Storage::disk('local')->delete($file->path);
    }
}
