<?php

namespace App\Services\Note;

use App\Repositories\NoteRepository;

class GetNotesService
{
    private $noteRepository;

    public function __construct(
        NoteRepository $noteRepository
    ) {
        $this->noteRepository = $noteRepository;
    }

    public function execute()
    {
        return $this->noteRepository->getAll();
    }
}
