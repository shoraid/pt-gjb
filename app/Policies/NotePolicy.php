<?php

namespace App\Policies;

use App\Enums\PermissionEnum;
use App\Models\Note;
use App\Models\User;

class NotePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissions(PermissionEnum::NOTES__LIST);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Note $note): bool
    {
        if ($user->hasPermissions(PermissionEnum::NOTES__DETAIL) && $user->id == $note->author_id) {
            return true;
        }

        if (in_array($user->id, $note->users->pluck('id')->toArray())) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissions(PermissionEnum::NOTES__CREATE);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Note $note): bool
    {
        return $user->hasPermissions(PermissionEnum::NOTES__UPDATE) && $user->id == $note->author_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Note $note): bool
    {
        return $user->hasPermissions(PermissionEnum::NOTES__DELETE) && $user->id == $note->author_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Note $note): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Note $note): bool
    {
        return false;
    }
}
