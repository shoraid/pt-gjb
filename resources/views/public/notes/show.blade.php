@extends('components.layouts.public.default')

@section('content')
  <x-layouts.public.content>
    <x-slot name="title">
      {{ $note->title }}
    </x-slot>

    <div class="d-flex flex-column gap-4">
      <div class="d-flex align-items-center justify-content-center fs-5">
        {{ $note->title }}
      </div>

      <div>
        {{ $note->content }}
      </div>
    </div>
  </x-layouts.public.content>
@endsection
