<?php

namespace App\DTOs;

use App\Models\Thread;
use Illuminate\Http\Request;

class ThreadDTO
{
    public static function fromRequest(Request $request): Thread
    {
        $thread = new Thread();
        $thread->setTitle($request->title);

        return $thread;
    }
}
