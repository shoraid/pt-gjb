<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property string $public_id
 * @property string $title
 * @property string $content
 * @property int $author_id
 * @property bool $is_public
 */
class Note extends Model
{
    /** @use HasFactory<\Database\Factories\NoteFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'public_id',
        'title',
        'content',
        'author_id',
        'is_public',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id')->withDefault();
    }

    public function users()
    {
        return $this->belongsToMany(User::class, NoteShare::class);
    }

    public function comments()
    {
        return $this->hasMany(NoteComment::class);
    }
}
