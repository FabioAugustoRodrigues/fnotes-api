<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController;
use App\Http\Requests\Note\CreateNoteRequest;
use App\Services\Note\CreateNoteService;

class NoteController extends BaseController
{
    protected $createNoteService;

    public function __construct(
        CreateNoteService $createNoteService
    ) {
        $this->createNoteService = $createNoteService;
    }

    public function store(CreateNoteRequest $request)
    {
        $parent_note_id = $request->note_id;
        $note = $this->createNoteService->execute($request->user()->id, $parent_note_id, $request->validated());

        return $this->sendResponse(['note' => $note], "", 201);
    }

}
