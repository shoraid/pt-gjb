@extends('layouts.master')

@section('content')
  <x-ui.app-content>
    <x-slot name="title">
      {{ __('app.profile.titles.edit') }}
    </x-slot>

    <x-slot name="tools">
      <a href="{{ route('cms.profile.show') }}" class="btn btn-secondary">
        {{ __('app.buttons.back') }}
      </a>
    </x-slot>

    <form action="{{ route('cms.profile.update') }}" method="post" enctype="multipart/form-data">
      @csrf
      @method('PATCH')

      <div class="d-flex flex-column gap-4">
        <x-forms.input :label="__('app.profile.name')" name="name" :value="$user->name" :placeholder="__('app.profile.placeholders.name')" required />

        <x-forms.input :label="__('app.profile.email')" name="email" :value="$user->email" disabled />

        <x-forms.input :label="__('app.profile.phone_number')" name="phone_number" type="tel" :value="$user->phone_number" :placeholder="__('app.profile.placeholders.phone_number')" />

        <x-forms.file :label="__('app.profile.image')" name="image" :value="$user->image_url" accept=".jpg, .jpeg, .png" />

        <div>
          <button type="submit" class="btn btn-primary me-2">
            {{ __('app.buttons.submit') }}
          </button>

          <a href="{{ route('cms.profile.show') }}" class="btn btn-secondary">
            {{ __('app.buttons.back') }}
          </a>
        </div>
      </div>
    </form>
  </x-ui.app-content>
@endsection
