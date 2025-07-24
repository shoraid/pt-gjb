<?php

namespace App\Services;

use App\Models\Note;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class NoteService
{
    public function getList(int $userId)
    {
        return Note::query()
            ->with([
                'users:id,name',
                'author:id,name',
            ])
            ->where(function (Builder $q) use ($userId) {
                $q
                    ->orWhere('author_id', $userId)
                    ->orWhereHas('users', function (Builder $q) use ($userId) {
                        $q->where('id', $userId);
                    });
            })
            ->latest('id')
            ->paginate();
    }

    public function getUserList(Request $request)
    {
        $search = $request->search;

        return User::query()
            ->when($search, function (Builder $q) use ($search) {
                $q->where('name', 'ILIKE', "%{$search}%");
            })
            ->paginate(columns: ['id', 'name', 'image']);
    }

    public function getSelectedUserList(array $userIds = [])
    {
        return User::query()
            ->whereIn('id', old('user_ids', $userIds))
            ->get(['id', 'name', 'image']);
    }

    public function create(array $data, int $userId): Note
    {
        $note = DB::transaction(function () use ($data, $userId) {
            $note = Note::query()->create([
                'public_id' => Str::uuid7(),
                'title' => $data['title'],
                'content' => $data['content'],
                'author_id' => $userId,
                'is_public' => isset($data['is_public']) && $data['is_public'] == '1'  ? true : false,
            ]);

            $note->users()->attach($data['user_ids'] ?? []);

            return $note;
        });

        return $note;
    }

    public function update(Note $note, array $data)
    {
        DB::transaction(function () use ($note, $data) {
            $note->update([
                'title' => $data['title'],
                'content' => $data['content'],
                'is_public' => isset($data['is_public']) && $data['is_public'] == '1'  ? true : false,
            ]);

            $note->users()->sync($data['user_ids'] ?? []);
        });
    }

    public function delete(Note $note)
    {
        return $note->delete();
    }
}
