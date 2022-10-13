<?php

namespace App\Http\Controllers\V1\Threads;

use App\DTOs\ThreadDTO;
use App\Http\Controllers\BaseController;
use App\Http\Requests\Thread\CreateThreadRequest;
use App\Http\Resources\ThreadResource;
use App\Interfaces\ThreadRepositoryInterface;

class ThreadController extends BaseController
{
    private ThreadRepositoryInterface $threadRepository;

    public function __construct(ThreadRepositoryInterface $threadRepository)
    {
        $this->threadRepository = $threadRepository;
    }

    /**
     * Create a thread in storage and returns it.
     */
    public function create(CreateThreadRequest $request)
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
}
