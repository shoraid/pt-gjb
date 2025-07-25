<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NoteComment extends Model
{
    protected $fillable = [
        'public_id',
        'note_id',
        'user_id',
        'parent_id',
        'content',
    ];

    public function children()
    {
        return $this->hasMany(NoteComment::class, 'parent_id');
    }

    public function note()
    {
        return $this->belongsTo(Note::class)->withDefault();
    }

    public function parent()
    {
        return $this->belongsTo(Note::class, 'parent_id')->withDefault();
    }

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }
}
