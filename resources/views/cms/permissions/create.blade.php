@extends('layouts.master')

@section('content')
  <x-ui.app-content>
    <x-slot name="title">
      {{ __('app.permissions.titles.create') }}
    </x-slot>

    <x-slot name="tools">
      <a href="{{ route('cms.permissions.index') }}" class="btn btn-secondary">
        {{ __('app.buttons.back') }}
      </a>
    </x-slot>

    <form action="{{ route('cms.permissions.store') }}" method="post">
      @csrf

      <div class="d-flex flex-column gap-4">
        <x-forms.select :label="__('app.permissions.parent')" name="parent_id" select2>
          @foreach ($parents as $parent)
            <option value="{{ $parent->id }}" @selected($parent->id == old('parent_id'))>
              {{ $parent->name }}
            </option>
          @endforeach
        </x-forms.select>

        <x-forms.input :label="__('app.permissions.id')" name="id" :placeholder="__('app.permissions.placeholders.id')" required />

        <x-forms.input :label="__('app.permissions.name')" name="name" :placeholder="__('app.permissions.placeholders.name')" required />

        <x-forms.input :label="__('app.permissions.display_order')" name="display_order" type="number" :placeholder="__('app.permissions.placeholders.display_order')" required />

        <x-forms.textarea :label="__('app.permissions.description')" name="description" :placeholder="__('app.permissions.placeholders.description')" />

        <div>
          <button type="submit" class="btn btn-primary me-2">
            {{ __('app.buttons.submit') }}
          </button>

          <a href="{{ route('cms.permissions.index') }}" class="btn btn-secondary">
            {{ __('app.buttons.back') }}
          </a>
        </div>
      </div>
    </form>

  </x-ui.app-content>
@endsection
