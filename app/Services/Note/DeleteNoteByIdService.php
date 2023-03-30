<?php

namespace App\Services\Note;

use App\Exceptions\DomainException;
use App\Repositories\NoteRepository;

class DeleteNoteByIdService
{
    private $noteRepository;

    public function __construct(NoteRepository $noteRepository)
    {
        $this->noteRepository = $noteRepository;
    }

    public function execute(int $id, int $user_id)
    {
        $existingNote = $this->noteRepository->getById($id);
        if (!$existingNote) {
            throw new DomainException(['Note not found'], 404);
        }

        if ($existingNote->user_id != $user_id) {
            throw new DomainException(['Note does not belong to the user'], 403);
        }

        return $this->noteRepository->delete($id);
    }
}
