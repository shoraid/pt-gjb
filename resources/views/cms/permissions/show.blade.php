@extends('layouts.master')

@section('content')
  <x-ui.app-content>
    <x-slot name="title">
      {{ __('app.permissions.titles.show') }}
    </x-slot>

    <x-slot name="tools">
      <a href="{{ route('cms.permissions.edit', $permission->id) }}" class="btn btn-warning">
        {{ __('app.buttons.edit') }}
      </a>
      <a href="{{ route('cms.permissions.index') }}" class="btn btn-secondary">
        {{ __('app.buttons.back') }}
      </a>
    </x-slot>

    <x-details.text :label="__('app.permissions.parent')" :value="$permission->parent?->name" />

    <x-details.text :label="__('app.permissions.id')" :value="$permission->id" />

    <x-details.text :label="__('app.permissions.name')" :value="$permission->name" />

    <x-details.text :label="__('app.permissions.display_order')" :value="$permission->display_order" />

    <x-details.text :label="__('app.permissions.description')" :value="$permission->description" />

    <div>
      <div class="text-secondary">{{ __('app.permissions.children') }}</div>
      @if ($permission->children->first())
        @foreach ($permission->children as $child)
          <ul class="m-0">
            <li>{{ $child->name }}</li>
          </ul>
        @endforeach
      @else
        -
      @endif
    </div>

  </x-ui.app-content>
@endsection
