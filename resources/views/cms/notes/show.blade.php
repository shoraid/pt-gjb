@extends('layouts.master')

@section('content')
  <x-ui.app-content>
    <x-slot name="title">
      {{ __('app.notes.titles.show') }}
    </x-slot>

    <x-slot name="tools">
      @can('update', $note)
        <a href="{{ route('cms.notes.edit', $note->id) }}" class="btn btn-warning">
          {{ __('app.buttons.edit') }}
        </a>
      @endcan

      <a href="{{ route('cms.notes.index') }}" class="btn btn-secondary">
        {{ __('app.buttons.back') }}
      </a>
    </x-slot>

    <x-details.text :label="__('app.notes.title')" :value="$note->title" />

    <x-details.text :label="__('app.notes.content')" :value="$note->content" />

    <x-details.text :label="__('app.notes.total_comments')" :value="$note->total_comments" />

    <x-details.text :label="__('app.notes.is_public')" :value="$note->is_public ? __('app.general.yes') : __('app.general.no')" />

    <div>
      <div class="text-secondary">{{ __('app.notes.user_sharing_label') }}</div>
      @if ($note->users->first())
        @foreach ($note->users as $user)
          <ul class="m-0">
            <li>{{ $user->name }}</li>
          </ul>
        @endforeach
      @else
        -
      @endif
    </div>

    <x-slot name="additional">
      <div class="d-flex justify-content-center">
        <div class="w-100" style="max-width: 60rem;">
          <div class="card mb-4 py-3">
            <div class="card-body">
              <div class="d-flex flex-column gap-4">
                <livewire:comments :note="$note" />
              </div>
            </div>
          </div>
        </div>
      </div>
    </x-slot>
  </x-ui.app-content>
@endsection
