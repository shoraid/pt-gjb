<?php

namespace App\Services;

use App\Models\Note;
use Illuminate\Support\Str;

class NoteService
{
    public function getList(int $userId)
    {
        return Note::query()
            ->where('author_id', $userId)
            ->latest('id')
            ->paginate();
    }

    public function create(array $data, int $userId): Note
    {
        return Note::query()->create([
            'public_id' => Str::uuid7(),
            'title' => $data['title'],
            'content' => $data['content'],
            'author_id' => $userId,
            'archived' => isset($data['archived']) && $data['archived'] == '1'  ? true : false,
        ]);
    }

    public function update(Note $note, array $data)
    {
        return $note->update([
            'title' => $data['title'],
            'content' => $data['content'],
            'archived' => $data['archived'] ?? false,
        ]);
    }

    public function delete(Note $note)
    {
        return $note->delete();
    }
}
