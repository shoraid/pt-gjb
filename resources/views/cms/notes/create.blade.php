@extends('layouts.master')

@section('content')
  <x-ui.app-content>
    <x-slot name="title">
      {{ __('app.notes.titles.create') }}
    </x-slot>

    <x-slot name="tools">
      <a href="{{ route('cms.notes.index') }}" class="btn btn-secondary">
        {{ __('app.buttons.back') }}
      </a>
    </x-slot>

    <form action="{{ route('cms.notes.store') }}" method="post">
      @csrf

      <div class="d-flex flex-column gap-4">
        <x-forms.input :label="__('app.notes.title')" name="title" :placeholder="__('app.notes.placeholders.title')" required />

        <x-forms.textarea :label="__('app.notes.content')" name="content" :placeholder="__('app.notes.placeholders.content')" required />

        <x-forms.label :label="__('app.notes.archived')" name="archived" required>
          <div>
            <x-forms.radio :label="__('app.general.yes')" name="archived" value="1" inline :checked="old('archived', '1') == '1'" />
            <x-forms.radio :label="__('app.general.no')" name="archived" value="0" inline :checked="old('is_active') == '0'" />
          </div>
        </x-forms.label>

        <div>
          <button type="submit" class="btn btn-primary me-2">
            {{ __('app.buttons.submit') }}
          </button>

          <a href="{{ route('cms.notes.index') }}" class="btn btn-secondary">
            {{ __('app.buttons.back') }}
          </a>
        </div>
      </div>
    </form>
  </x-ui.app-content>
@endsection
