<?php

namespace App\Livewire;

use App\Models\NoteComment;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Str;

class CommentItem extends Component
{
    public NoteComment $comment;
    public bool $showReply = false;
    public string $replyContent = '';
    public string $customStyle;
    public bool $showChildren = false;

    protected $rules = [
        'replyContent' => 'required|string|min:1|max:2000',
    ];

    public function mount($customStyle = '')
    {
        $this->customStyle = $customStyle;
    }

    public function postReply()
    {
        $this->authorize('view', $this->comment->note);

        $this->validate();

        $this->comment->note->comments()->create([
            'public_id' => Str::uuid7(),
            'user_id' => Auth::id(),
            'parent_id' => $this->comment->id,
            'content' => $this->replyContent,
        ]);

        $this->reset('replyContent');
        $this->showReply = false;
        $this->comment->unsetRelation('children'); // force reload
    }

    public function delete()
    {
        $this->comment->delete();
    }

    public function getChildrenProperty()
    {
        return $this->comment->children()
            ->with('user')
            ->latest()
            ->get();
    }

    public function render()
    {
        return view('livewire.comment-item');
    }
}
