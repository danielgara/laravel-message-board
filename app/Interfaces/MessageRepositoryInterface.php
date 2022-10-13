<?php

namespace App\Interfaces;

interface MessageRepositoryInterface
{
    public function getByThreadId(int $threadId);
}
