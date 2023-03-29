<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController;
use App\Http\Requests\Note\CreateNoteRequest;
use App\Http\Requests\Note\UpdateNoteRequest;
use App\Http\Resources\Note\NoteCollection;
use App\Http\Resources\Note\NoteResource;
use App\Services\Note\CreateNoteService;
use App\Services\Note\GetNoteBySlugService;
use App\Services\Note\getNotesByUserService;
use App\Services\Note\GetNotesService;
use App\Services\Note\UpdateNoteService;
use Illuminate\Http\Request;

class NoteController extends BaseController
{
    protected $createNoteService;
    protected $getNoteBySlugService;
    protected $getNotesService;
    protected $getNotesByUserService;
    protected $updateNoteService;

    public function __construct(
        CreateNoteService $createNoteService,
        GetNoteBySlugService $getNoteBySlugService,
        GetNotesService $getNotesService,
        getNotesByUserService $getNotesByUserService,
        UpdateNoteService $updateNoteService
    ) {
        $this->createNoteService = $createNoteService;
        $this->getNoteBySlugService = $getNoteBySlugService;
        $this->getNotesService = $getNotesService;
        $this->getNotesByUserService = $getNotesByUserService;
        $this->updateNoteService = $updateNoteService;
    }

    public function store(CreateNoteRequest $request)
    {
        $parent_note_id = $request->note_id;
        $note = $this->createNoteService->execute($request->user()->id, $parent_note_id, $request->validated());

        return $this->sendResponse(new NoteResource($note), "", 201);
    }

    public function showBySlug($slug)
    {
        $note = $this->getNoteBySlugService->execute($slug);

        return $this->sendResponse(new NoteResource($note), "", 200);
    }

    public function index()
    {
        return $this->sendResponse(new NoteCollection($this->getNotesService->execute()), "", 200);
    }

    public function showByUser($user_id) {
        return $this->sendResponse(new NoteCollection($this->getNotesByUserService->execute($user_id)), "", 200);
    }

    public function showByCurrentUser(Request $request) {
        return $this->sendResponse(new NoteCollection($this->getNotesByUserService->execute($request->user()->id)), "", 200);
    }

    public function update(UpdateNoteRequest $request, $id) {
        return $this->sendResponse(new NoteResource($this->updateNoteService->execute($id, $request->user()->id, $request->validated())), "", 200);
    }
}
