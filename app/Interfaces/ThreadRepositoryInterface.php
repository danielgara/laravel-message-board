<?php

namespace App\Interfaces;

use App\Models\Thread;

interface ThreadRepositoryInterface
{
    public function save(Thread $thread);
}
