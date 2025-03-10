<?php

namespace App\Actions;

use App\Models\File;
use Carbon\Carbon;
use Illuminate\Support\Str;

class CreateFilesAction
{
    public static function execute(array $files): void
    {
        $filesToSave = [];

        foreach ($files as $file) {
            $path = $file->store('uploads');

            if (!$path) {
                throw new \Exception('File upload failed');
            }

            $filesToSave[] = [
                'filename' => $file->getClientOriginalName(),
                'path' => $path,
                'size' => $file->getSize()
            ];
        }

        self::applyIdAndTimestamps($filesToSave);

        File::query()->insert($filesToSave);
    }

    private static function applyIdAndTimestamps(&$filesToSave): void {
        $currentTimestamp = Carbon::now();

        $filesToSave = array_map(fn ($item) => array_merge($item, [
            'id' => Str::uuid7()->toString(),
            'created_at' => $currentTimestamp,
            'updated_at' => $currentTimestamp,
        ]), $filesToSave);
    }
}
