<div>
  <form wire:submit.prevent="post" class="mb-3">
    <textarea wire:model.lazy="content" class="form-control" rows="3" placeholder="Write a comment..."></textarea>
    @error('content')
      <div class="text-danger">{{ $message }}</div>
    @enderror
    <button class="btn btn-primary mt-2" type="submit">Post</button>
  </form>

  @foreach ($comments as $comment)
    <livewire:comment-item :key="$comment->id" :comment="$comment"
      customStyle="border-bottom: 1px solid; border-bottom-color: oklch(92.2% 0 0);" />
  @endforeach

  {{ $comments->links('pagination::bootstrap-5') }}
</div>
