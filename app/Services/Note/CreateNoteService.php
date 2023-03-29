<?php

namespace App\Services\Note;

use App\Exceptions\DomainException;
use App\Repositories\NoteRepository;
use App\Services\User\GetUserByIdService;
use App\Utils\SlugUtil;

class CreateNoteService
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

    public function execute(int $user_id, ?int $note_id, array $data)
    {
        $user = $this->getUserByIdService->execute($user_id);

        $data['user_id'] = $user->id;
        $data['note_id'] = $note_id;

        if ($data['note_id'] != null) {
            $existingNote = $this->noteRepository->getById($data['note_id']);
            if (!$existingNote) {
                throw new DomainException(['Note not found'], 404);
            }

            if ($existingNote->user_id != $user_id) {
                throw new DomainException(['Note parent does not belong to the given user'], 403);
            }
        }

        $data['slug'] = SlugUtil::generateSlug($data['title']);
 
        return $this->noteRepository->create($data);
    }
}
