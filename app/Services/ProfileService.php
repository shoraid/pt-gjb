<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ProfileService
{
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

        $user->update([
            'name' => $data['name'],
            'phone_number' => $data['phone_number'] ?? null,
            'image' => $image,
        ]);

        // remove old image
        if ($user->wasChanged('image') && $oldImage) {
            Storage::disk('public')->delete("images/{$oldImage}");
        }
    }
}
