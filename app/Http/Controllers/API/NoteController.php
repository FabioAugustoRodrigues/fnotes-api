<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController;
use App\Http\Requests\Note\CreateNoteRequest;
use App\Services\Note\CreateNoteService;
use App\Services\Note\GetNoteBySlugService;
use App\Services\Note\GetNotesService;

class NoteController extends BaseController
{
    protected $createNoteService;
    protected $getNoteBySlugService;
    protected $getNotesService;

    public function __construct(
        CreateNoteService $createNoteService,
        GetNoteBySlugService $getNoteBySlugService,
        GetNotesService $getNotesService
    ) {
        $this->createNoteService = $createNoteService;
        $this->getNoteBySlugService = $getNoteBySlugService;
        $this->getNotesService = $getNotesService;
    }

    public function store(CreateNoteRequest $request)
    {
        $parent_note_id = $request->note_id;
        $note = $this->createNoteService->execute($request->user()->id, $parent_note_id, $request->validated());

        return $this->sendResponse(['note' => $note], "", 201);
    }

    public function showBySlug($slug)
    {
        $note = $this->getNoteBySlugService->execute($slug);

        return $this->sendResponse(['note' => $note], "", 200);
    }

    public function index()
    {
        return $this->sendResponse($this->getNotesService->execute(), "", 200);
    }
}
