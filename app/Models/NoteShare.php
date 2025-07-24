<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $note_id
 * @property int $user_id
 */
class NoteShare extends Model
{
    protected $fillable = [
        'note_id',
        'user_id',
    ];
}
