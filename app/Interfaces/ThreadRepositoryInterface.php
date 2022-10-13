<?php

namespace App\Interfaces;

use App\Models\Thread;

interface ThreadRepositoryInterface
{
    public function getById(int $threadId);

    public function save(Thread $thread);
}
