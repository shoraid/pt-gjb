@extends('layouts.master')

@section('content')
  <x-ui.app-content>
    <x-slot name="title">
      {{ __('app.users.titles.edit') }}
    </x-slot>

    <x-slot name="tools">
      <a href="{{ route('cms.users.index') }}" class="btn btn-secondary">
        {{ __('app.buttons.back') }}
      </a>
    </x-slot>

    <form action="{{ route('cms.users.update', $user->id) }}" method="post" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      <div class="d-flex flex-column gap-4">
        <x-forms.input :label="__('app.users.name')" name="name" :value="$user->name" :placeholder="__('app.users.placeholders.name')" required />

        <x-forms.input :label="__('app.users.email')" name="email" :value="$user->email" :placeholder="__('app.users.placeholders.email')" disabled />

        <x-forms.input :label="__('app.users.phone_number')" name="phone_number" :value="$user->phone_number" :placeholder="__('app.users.placeholders.phone_number')" />

        <x-forms.select :label="__('app.users.roles')" name="role_ids" select2 multiple>
          @foreach ($roles as $role)
            <option value="{{ $role->id }}" @selected(in_array($role->id, old('role_ids', $selectedRoleIds)))>
              {{ $role->name }}
            </option>
          @endforeach
        </x-forms.select>

        <x-forms.file :label="__('app.users.image')" name="image" :value="$user->image_url" accept=".jpg, .jpeg, .png" />

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
