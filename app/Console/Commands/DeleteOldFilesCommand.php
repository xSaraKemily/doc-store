<?php

namespace App\Console\Commands;

use App\Actions\DeleteFilesAction;
use App\Models\File;
use Illuminate\Console\Command;

class DeleteOldFilesCommand extends Command
{
    protected $signature = 'app:delete-files-command';

    protected $description = 'Delete files 24 hours old';

    public function handle(): void
    {
        $query = File::where('created_at', '<=', now()->subHours(24))->get();

        if ($query->count()) {
            DeleteFilesAction::execute($query->pluck('id'));
        }
    }
}
