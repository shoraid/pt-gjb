<?php

namespace App\Services;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UserService
{
    public function getList()
    {
        return User::query()
            ->latest('id')
            ->paginate();
    }

    public function getRoleList()
    {
        return Role::all(['id', 'name']);
    }

    public function getRoleIds(User $user)
    {
        return $user->roles->pluck('id')->all();
    }

    public function create(array $data, int $userId): User
    {
        $image = null;
        if (isset($data['image']) && $data['image'] instanceof UploadedFile) {
            /** @var UploadedFile $tempFile */
            $tempFile = $data['image'];
            $tempFile->store('images', 'public');
            $image = $tempFile->hashName();
        }

        return DB::transaction(function () use ($data, $image, $userId) {
            $user = User::query()->create([
                'name' => $data['name'],
                'email' => $data['email'],
                'phone_number' => $data['phone_number'] ?? null,
                'password' => bcrypt($data['password']),
                'image' => $image,
                'created_by_id' => $userId,
            ]);

            $user->roles()->attach($data['role_ids'] ?? []);

            return $user;
        });
    }

    public function update(User $user, array $data)
    {
        $oldImage = $user->image;
        $image = $user->image;
        if (isset($data['image']) && $data['image'] instanceof UploadedFile) {
            /** @var UploadedFile $tempFile */
            $tempFile = $data['image'];
            $tempFile->store('images', 'public');
            $image = $tempFile->hashName();
        }

        DB::transaction(function () use ($user, $data, $image) {
            $user->update([
                'name' => $data['name'],
                'phone_number' => $data['phone_number'] ?? null,
                'image' => $image
            ]);

            $user->roles()->sync($data['role_ids'] ?? []);
        });

        // remove old image
        if ($user->wasChanged('image') && $oldImage) {
            Storage::disk('public')->delete("images/{$oldImage}");
        }
    }

    public function delete(User $user)
    {
        return $user->delete();
    }
}
