<?php

namespace App\Actions;

use App\Jobs\SendDeletedFilesMailJob;
use Illuminate\Support\Collection;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class SendDeletedFilesNotificationAction
{
    public static function execute(Collection $files): void
    {
        $filenames = Collection::make($files)
            ->map(fn($file) => $file->filename)
            ->join(', ');

        $message = [
            'to' => env('NOTIFICATION_EMAIL'),
            'subject' => 'Deleted Files',
            'body' => "Files deleted: {$filenames}"
        ];

        self::publishOnRabbitMQ($message);
    }


    private static function publishOnRabbitMQ(array $message): void
    {
        $connection = new AMQPStreamConnection(
            env('RABBITMQ_HOST'),
            env('RABBITMQ_PORT'),
            env('RABBITMQ_USER'),
            env('RABBITMQ_PASSWORD')
        );
        $channel = $connection->channel();

        $channel->queue_declare('file_deletions', false, true, false, false);

        $msg = new AMQPMessage(json_encode($message));
        $channel->basic_publish($msg, '', 'file_deletions');

        $channel->close();
        $connection->close();
    }
}
