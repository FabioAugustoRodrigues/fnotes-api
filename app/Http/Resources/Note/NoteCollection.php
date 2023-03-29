<?php

namespace App\Http\Resources\Note;

use Illuminate\Http\Resources\Json\ResourceCollection;

class NoteCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return $this->collection;
    }
}