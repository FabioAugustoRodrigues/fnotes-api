<?php

namespace App\Services\Note;

use App\Repositories\NoteRepository;
use App\Services\User\GetUserByIdService;

class getNotesByUserService
{
    private $noteRepository;
    private $getUserByIdService;

    public function __construct(
        NoteRepository $noteRepository,
        GetUserByIdService $getUserByIdService
    ) {
        $this->noteRepository = $noteRepository;
        $this->getUserByIdService = $getUserByIdService;
    }

    public function execute(int $user_id)
    {
        $user = $this->getUserByIdService->execute($user_id);

        return $this->noteRepository->getAllByUserId($user_id);
    }
}
