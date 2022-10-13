<?php

namespace App\DTOs;

use App\Models\User;

class UserDTO
{
    public static function fromRequest(string $full_name, string $email, string $password, string $bio): User
    {
        $user = new User();
        $user->setName($full_name);
        $user->setEmail($email);
        $user->setPassword($password);
        $user->setBio($bio);

        return $user;
    }
}
