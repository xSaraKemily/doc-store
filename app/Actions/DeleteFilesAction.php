<?php

namespace App\Actions;

use App\Jobs\SendDeletedFilesMailJob;
use App\Models\File;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class DeleteFilesAction
{
    public static function execute(Collection $ids): void
    {
        $filesQuery = File::whereIn('id', $ids);

        self::deleteFromStorage($filesQuery->get());

        $filesQuery->delete();

        SendDeletedFilesMailJob::dispatch()->onQueue('default');
    }

    private static function deleteFromStorage(Collection $files): void
    {
        Storage::disk('local')->delete(
            $files->map(fn($file) => $file->path)->toArray()
        );
    }
}
