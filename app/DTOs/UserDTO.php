<?php

namespace App\DTOs;

use App\Models\User;
use Illuminate\Http\Request;

class UserDTO
{
    public static function fromRequest(Request $request): User
    {
        $user = new User();
        $user->setName($request->full_name);
        $user->setEmail($request->email);
        $user->setPassword($request->password);
        $user->setBio($request->bio);

        return $user;
    }
}
