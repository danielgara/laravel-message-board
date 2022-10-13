<?php

namespace App\Http\Controllers\V1\Threads;

use App\DTOs\MessageDTO;
use App\Http\Controllers\BaseController;
use App\Http\Requests\Message\CreateMessageRequest;
use App\Http\Resources\MessageResource;
use App\Interfaces\MessageRepositoryInterface;
use Illuminate\Http\JsonResponse;

class UserThreadMessageController extends BaseController
{
    private MessageRepositoryInterface $messageRepository;

    public function __construct(MessageRepositoryInterface $messageRepository)
    {
        $this->messageRepository = $messageRepository;
    }

    /**
     * Create a message in storage and returns it.
     */
    public function create(CreateMessageRequest $request): JsonResponse
    {
        try {
            $messageObject = MessageDTO::fromRequest($request);
            $message = $this->messageRepository->save($messageObject);

            $responseData = [];
            $responseData['message'] = new MessageResource($message);

            return $this->sendResponse($responseData, 201);
        } catch (Throwable $th) {
            $responseData = [];
            $responseData['message'] = $th->getMessage();

            return $this->sendResponseError($responseData, 500);
        }
    }
}
