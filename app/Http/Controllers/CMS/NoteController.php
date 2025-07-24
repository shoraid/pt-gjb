<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Requests\CMS\NoteRequest;
use App\Models\Note;
use App\Services\NoteService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class NoteController extends Controller
{
    public function __construct(private NoteService $service) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        Gate::authorize('viewAny', Note::class);

        $notes = $this->service->getList($request->user()->id);

        return view('cms.notes.index', compact('notes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create', Note::class);

        return view('cms.notes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NoteRequest $request)
    {
        Gate::authorize('create', Note::class);

        $this->service->create($request->validated(), $request->user()->id);

        return to_route('cms.notes.index')->with([
            'type' => 'success',
            'message' => __('app.messages.data_saved')
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Note $note)
    {
        Gate::authorize('view', $note);

        return view('cms.notes.show', compact('note'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Note $note)
    {
        Gate::authorize('update', $note);

        return view('cms.notes.edit', compact('note'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(NoteRequest $request, Note $note)
    {
        Gate::authorize('update', $note);

        $this->service->update($note, $request->validated());

        return to_route('cms.notes.index')->with([
            'type' => 'success',
            'message' => __('app.messages.data_saved')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
        Gate::authorize('delete', $note);

        $this->service->delete($note);

        return to_route('cms.notes.index')->with([
            'type' => 'success',
            'message' => __('app.messages.data_deleted')
        ]);
    }
}
