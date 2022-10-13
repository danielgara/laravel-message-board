<?php

namespace App\DTOs;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageDTO
{
    public static function fromRequest(Request $request): Message
    {
        $message = new Message();
        $message->setBody($request->body);
        $message->setUserId($request->user_id);
        $message->setThreadId($request->thread_id);

        return $message;
    }
}
