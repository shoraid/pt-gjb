@extends('layouts.master')

@section('content')
  <x-ui.app-content>
    <x-slot name="title">
      {{ __('app.profile.titles.show') }}
    </x-slot>

    <x-slot name="tools">
      <a href="{{ route('cms.profile.edit') }}" class="btn btn-warning">
        {{ __('app.buttons.edit') }}
      </a>
    </x-slot>

    <x-details.text :label="__('app.profile.name')" :value="$user->name" />

    <x-details.text :label="__('app.profile.email')" :value="$user->email" />

    <x-details.text :label="__('app.profile.phone_number')" :value="$user->phone_number" />

    <x-details.image :label="__('app.profile.image')" :value="$user->image_url" />

  </x-ui.app-content>
@endsection
