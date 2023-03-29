<?php

namespace App\Services\Note;

use App\Exceptions\DomainException;
use App\Repositories\NoteRepository;

class GetNoteBySlugService
{
    private $noteRepository;

    public function __construct(
        NoteRepository $noteRepository
    ) {
        $this->noteRepository = $noteRepository;
    }

    public function execute(string $slug)
    {
        $existingNote = $this->noteRepository->findBySlug($slug);
        if (!$existingNote) {
            throw new DomainException(['Note not found'], 404);
        }
 
        return $existingNote;
    }
}
