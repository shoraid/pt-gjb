@extends('layouts.master')

@section('content')
  <x-ui.app-content>
    <x-slot name="title">
      {{ __('app.notes.titles.show') }}
    </x-slot>

    <x-slot name="tools">
      <a href="{{ route('cms.notes.edit', $note->id) }}" class="btn btn-warning">
        {{ __('app.buttons.edit') }}
      </a>
      <a href="{{ route('cms.notes.index') }}" class="btn btn-secondary">
        {{ __('app.buttons.back') }}
      </a>
    </x-slot>

    <x-details.text :label="__('app.notes.title')" :value="$note->title" />

    <x-details.text :label="__('app.notes.content')" :value="$note->content" />

    <x-details.text :label="__('app.notes.archived')" :value="$note->archived ? __('app.general.yes') : __('app.general.no')" />

  </x-ui.app-content>
@endsection
