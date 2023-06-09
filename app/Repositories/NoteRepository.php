<?php

namespace App\Repositories;

use App\Models\Note;

class NoteRepository
{
    protected $model;

    public function __construct(Note $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        return $this->model->where('note_id', null)->get();
    }

    public function getAllByUserId($user_id)
    {
        return $this->model->where('user_id', $user_id)->where('note_id', null)->get();
    }

    public function getById($id)
    {
        return $this->model->find($id);
    }

    public function findBySlug($slug)
    {
        return $this->model->where('slug', $slug)->first();
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $record = $this->getById($id);
        $record->update($data);

        return $record->refresh();
    }

    public function delete($id)
    {
        $record = $this->getById($id);

        return $record->delete();
    }
}
