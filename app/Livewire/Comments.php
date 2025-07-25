<?php

namespace App\Livewire;

use App\Models\Note;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;

class Comments extends Component
{
    use WithPagination;

    public Note $note;
    public string $content = '';

    protected $rules = [
        'content' => 'required|string|min:1|max:2000',
    ];

    public function mount(Note $note)
    {
        $this->note = $note;
        $this->authorize('view', $this->note);
    }

    public function post()
    {
        $this->authorize('view', $this->note);
        $this->validate();

        $this->note->comments()->create([
            'public_id' => Str::uuid7(),
            'user_id' => Auth::id(),
            'content' => $this->content,
        ]);

        $this->reset('content');
        $this->resetPage(); // return to page 1
    }

    public function render()
    {
        $comments = $this->note->comments()
            ->whereNull('parent_id')
            ->latest()
            ->paginate(10);

        return view('livewire.comments', compact('comments'));
    }
}
