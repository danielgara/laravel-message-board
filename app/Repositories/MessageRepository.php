<?php

namespace App\Repositories;

use App\Interfaces\MessageRepositoryInterface;
use App\Models\Message;
use Illuminate\Database\Eloquent\Collection;

class MessageRepository implements MessageRepositoryInterface
{
    public function save(Message $message): Message
    {
        $message->save();

        return $message;
    }

    public function getByThreadId(int $threadId): ?Collection
    {
        return Message::where('thread_id', '=', $threadId)->orderBy('created_at', 'desc')->get();
    }
}
