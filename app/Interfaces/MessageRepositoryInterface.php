<?php

namespace App\Interfaces;

use App\Models\Message;

interface MessageRepositoryInterface
{
    public function getById(int $messageId);

    public function getByThreadId(int $threadId);

    public function save(Message $message);

    public function getMessagesByUserIdAndThreadIdAndSearchTerm(int $userId, int $threadId, string $searchTerm);
}
