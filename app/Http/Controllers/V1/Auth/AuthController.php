<?php

namespace App\Http\Controllers\V1\Auth;

use App\DTOs\UserDTO;
use App\Http\Controllers\BaseController;
use App\Http\Requests\User\CreateUserRequest;
use App\Interfaces\UserRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Throwable;

class AuthController extends BaseController
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Create a user in storage
     */
    public function create(CreateUserRequest $request): JsonResponse
    {
        try {
            $userObject = UserDTO::fromRequest(
                $request->full_name,
                $request->email,
                $request->password,
                $request->bio,
            );
            $user = $this->userRepository->save($userObject);

            $responseData = [];
            $responseData['token'] = $user->createToken('auth_token')->plainTextToken;

            return $this->sendResponse($responseData, 201);
        } catch (Throwable $th) {
            $responseData = [];
            $responseData['message'] = $th->getMessage();

            return $this->sendResponseError($responseData, 500);
        }
    }
}
