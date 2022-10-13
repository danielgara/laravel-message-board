<?php

namespace App\Interfaces;

use App\Models\User;

interface UserRepositoryInterface
{
    public function getById(int $userId);

    public function save(User $user);
}
