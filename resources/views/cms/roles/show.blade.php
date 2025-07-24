@extends('layouts.master')

@section('content')
  <x-ui.app-content>
    <x-slot name="title">
      {{ __('app.roles.titles.show') }}
    </x-slot>

    <x-slot name="tools">
      <a href="{{ route('cms.roles.edit', $role->id) }}" class="btn btn-warning">
        {{ __('app.buttons.edit') }}
      </a>
      <a href="{{ route('cms.roles.index') }}" class="btn btn-secondary">
        {{ __('app.buttons.back') }}
      </a>
    </x-slot>

    <x-details.text :label="__('app.roles.name')" :value="$role->name" />

    <x-details.text :label="__('app.roles.description')" :value="$role->description" />

    <div>
      <div class="text-secondary">{{ __('app.roles.permissions') }}</div>
      @if ($role->permissions->first())
        @foreach ($role->permissions as $permission)
          <ul class="m-0">
            <li>{{ $permission->name }}</li>
          </ul>
        @endforeach
      @else
        -
      @endif
    </div>
  </x-ui.app-content>
@endsection
