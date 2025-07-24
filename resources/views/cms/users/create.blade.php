@extends('layouts.master')

@section('content')
  <x-ui.app-content>
    <x-slot name="title">
      {{ __('app.users.titles.create') }}
    </x-slot>

    <x-slot name="tools">
      <a href="{{ route('cms.users.index') }}" class="btn btn-secondary">
        {{ __('app.buttons.back') }}
      </a>
    </x-slot>

    <form action="{{ route('cms.users.store') }}" method="post" enctype="multipart/form-data">
      @csrf

      <div class="d-flex flex-column gap-4">
        <x-forms.input :label="__('app.users.name')" name="name" :placeholder="__('app.users.placeholders.name')" required />

        <x-forms.input :label="__('app.users.email')" type="email" name="email" :placeholder="__('app.users.placeholders.email')" required />

        <x-forms.input :label="__('app.users.phone_number')" type="tel" name="phone_number" :placeholder="__('app.users.placeholders.phone_number')" />

        <x-forms.input :label="__('app.users.password')" type="password" name="password" :placeholder="__('app.users.placeholders.password')" required />

        <x-forms.input :label="__('app.users.password_confirmation')" type="password" name="password_confirmation" :placeholder="__('app.users.placeholders.password_confirmation')" required />

        <x-forms.select :label="__('app.users.roles')" name="role_ids" select2 multiple>
          @foreach ($roles as $role)
            <option value="{{ $role->id }}" @selected(in_array($role->id, old('role_ids', [])))>
              {{ $role->name }}
            </option>
          @endforeach
        </x-forms.select>

        <x-forms.file :label="__('app.users.image')" name="image" accept=".jpg, .jpeg, .png" />

        <div>
          <button type="submit" class="btn btn-primary me-2">
            {{ __('app.buttons.submit') }}
          </button>

          <a href="{{ route('cms.users.index') }}" class="btn btn-secondary">
            {{ __('app.buttons.back') }}
          </a>
        </div>
      </div>
    </form>
  </x-ui.app-content>
@endsection
