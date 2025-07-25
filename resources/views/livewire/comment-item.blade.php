<div class="mb-2" style="{{ $customStyle }}">
  <div class="d-flex align-items-start justify-content-between">
    <div class="d-flex align-items-start">
      <strong>{{ $comment->user->name }}</strong>
      <span class="ms-2">{{ $comment->content }}</span>
    </div>
    <span class="text-muted ms-2">{{ $comment->created_at->diffForHumans() }}</span>
  </div>

  <div class="d-flex gap-2">
    <button class="btn btn-link btn-sm ps-0" wire:click="$toggle('showReply')">Reply</button>

    @if ($comment->total_children)
      <button class="btn btn-link btn-sm ps-0" wire:click="$toggle('showChildren')">
        {{ $showChildren ? 'Hide Replies' : 'Show Replies' }} ({{ $comment->total_children }})
      </button>
    @endif
  </div>

  @if ($showReply)
    <div class="ms-2 mt-2">
      <textarea wire:model.lazy="replyContent" class="form-control" rows="2" placeholder="Write a reply..."></textarea>
      @error('replyContent')
        <div class="text-danger">{{ $message }}</div>
      @enderror
      <button class="btn btn-primary btn-sm mt-2" wire:click="postReply">Post Reply</button>
    </div>
  @endif

  {{-- Child Comments --}}
  @if ($showChildren)
    <div class="ms-4 mt-2">
      @foreach ($this->children as $child)
        <livewire:comment-item :key="$child->id" :comment="$child" />
      @endforeach
    </div>
  @endif
</div>
