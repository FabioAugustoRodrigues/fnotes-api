<?php

namespace App\Http\Resources\Note;

use App\Models\Note;
use Illuminate\Http\Resources\Json\JsonResource;

class NoteResource extends JsonResource
{
    public static $wrap = null;

    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "user_id" => $this->user_id,
            "note_id" => $this->note_id,
            "slug" => $this->slug,
            "title" => $this->title,
            "content" => $this->content,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
            "child_notes" => Note::where('note_id', $this->id)
                ->with('childNotes')
                ->get()
        ];
    }
}
