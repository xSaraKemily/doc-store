<?php

namespace App\Jobs;

use Bschmitt\Amqp\Facades\Amqp;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;

class SendDeletedFilesMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable;

    public function __construct(private readonly array $files) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $filenames = Collection::make($this->files)
            ->map(fn ($file) => $file->filename)
            ->join(', ');

        $message = [
            'to' => env('NOTIFICATION_EMAIL'),
            'subject' => 'Deleted Files',
            'body' => "Files deleted: {$filenames}"
        ];

        Amqp::publish('file_deletions', json_encode($message));
    }
}
