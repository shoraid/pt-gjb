<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Note;
use App\Services\NoteService;

class PublicNoteController extends Controller
{
    public function __construct(private NoteService $service) {}

    /**
     * Display the specified resource.
     */
    public function show($publicId)
    {
        $note = Note::query()
            ->where('public_id', $publicId)
            ->where('is_public', true)
            ->firstOrFail();

        return view('public.notes.show', compact('note'));
    }
}
