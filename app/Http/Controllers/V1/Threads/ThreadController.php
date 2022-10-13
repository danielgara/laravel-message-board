<?php

namespace App\Http\Controllers\V1\Threads;

use App\DTOs\ThreadDTO;
use App\Http\Controllers\BaseController;
use App\Http\Requests\Thread\CreateThreadRequest;
use App\Http\Resources\MessageResource;
use App\Http\Resources\ThreadResource;
use App\Interfaces\MessageRepositoryInterface;
use App\Interfaces\ThreadRepositoryInterface;
use Illuminate\Http\JsonResponse;

class ThreadController extends BaseController
{
    private ThreadRepositoryInterface $threadRepository;

    private MessageRepositoryInterface $messageRepository;

    public function __construct(ThreadRepositoryInterface $threadRepository, MessageRepositoryInterface $messageRepository)
    {
        $this->threadRepository = $threadRepository;
        $this->messageRepository = $messageRepository;
    }

    /**
     * Create a thread in storage and returns it.
     */
    public function create(CreateThreadRequest $request): JsonResponse
    {
        try {
            $threadObject = ThreadDTO::fromRequest($request);
            $thread = $this->threadRepository->save($threadObject);

            $responseData = [];
            $responseData['thread'] = new ThreadResource($thread);

            return $this->sendResponse($responseData, 201);
        } catch (Throwable $th) {
            $responseData = [];
            $responseData['message'] = $th->getMessage();

            return $this->sendResponseError($responseData, 500);
        }
    }

    /**
     * Returns thread messages by thread id
     */
    public function getMessages(int $threadId): JsonResponse
    {
        try {
            $thread = $this->threadRepository->getById($threadId);

            if (is_null($thread)) {
                $responseData = [];
                $responseData['message'] = 'Thread not found';

                return $this->sendResponseError($responseData);
            }

            $messages = MessageResource::collection($this->messageRepository->getByThreadId($threadId));

            if (count($messages) == 0) {
                $responseData = [];
                $responseData['message'] = 'Thread have not messages';

                return $this->sendResponseError($responseData);
            }

            $responseData = [];
            $responseData['messages'] = $messages;

            return $this->sendResponse($responseData);
        } catch (Throwable $th) {
            $responseData = [];
            $responseData['message'] = $th->getMessage();

            return $this->sendResponseError($responseData, 500);
        }
    }
}
