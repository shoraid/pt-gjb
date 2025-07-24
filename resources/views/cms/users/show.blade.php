@extends('layouts.master')

@section('content')
  <x-ui.app-content>
    <x-slot name="title">
      {{ __('app.users.titles.show') }}
    </x-slot>

    <x-slot name="tools">
      <a href="{{ route('cms.users.edit', $user->id) }}" class="btn btn-warning">
        {{ __('app.buttons.edit') }}
      </a>
      <a href="{{ route('cms.users.index') }}" class="btn btn-secondary">
        {{ __('app.buttons.back') }}
      </a>
    </x-slot>

    <x-details.text :label="__('app.users.name')" :value="$user->name" />

    <x-details.text :label="__('app.users.email')" :value="$user->email" />

    <x-details.text :label="__('app.users.phone_number')" :value="$user->phone_number" />

    <x-details.image :label="__('app.users.image')" :value="$user->image_url" />

    <div>
      <div class="text-secondary">{{ __('app.users.roles') }}</div>
      @if ($user->roles->first())
        @foreach ($user->roles as $role)
          <ul class="m-0">
            <li>{{ $role->name }}</li>
          </ul>
        @endforeach
      @else
        -
      @endif
    </div>
  </x-ui.app-content>
@endsection
