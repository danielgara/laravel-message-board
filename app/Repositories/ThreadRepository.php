<?php

namespace App\Repositories;

use App\Interfaces\ThreadRepositoryInterface;
use App\Models\Thread;

class ThreadRepository implements ThreadRepositoryInterface
{
    public function save(Thread $thread): Thread
    {
        $thread->save();

        return $thread;
    }
}
