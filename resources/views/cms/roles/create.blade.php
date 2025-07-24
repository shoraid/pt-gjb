@extends('layouts.master')

@section('content')
  <x-ui.app-content>
    <x-slot name="title">
      {{ __('app.roles.titles.create') }}
    </x-slot>

    <x-slot name="tools">
      <a href="{{ route('cms.roles.index') }}" class="btn btn-secondary">
        {{ __('app.buttons.back') }}
      </a>
    </x-slot>

    <form action="{{ route('cms.roles.store') }}" method="post">
      @csrf

      <div class="d-flex flex-column gap-4">
        <x-forms.input :label="__('app.roles.name')" name="name" :placeholder="__('app.roles.placeholders.name')" required />

        <x-forms.textarea :label="__('app.roles.description')" name="description" :placeholder="__('app.roles.placeholders.description')" />

        <div>
          <div class="mb-2" style="font-size: 1.1rem;">
            {{ __('app.roles.permissions') }}
          </div>

          <div class="card card-body">
            @foreach ($permissions as $permission)
              <div class="mb-2">{{ $permission->name }}</div>
              @foreach ($permission->children as $child)
                <div class="mb-2 ms-2">
                  <x-forms.checkbox name="permission_ids[]" :label="$child->name" :value="$child->id" :items="old('permission_ids', [])" />
                </div>
              @endforeach
            @endforeach
          </div>
        </div>

        <div>
          <button type="submit" class="btn btn-primary me-2">
            {{ __('app.buttons.submit') }}
          </button>

          <a href="{{ route('cms.roles.index') }}" class="btn btn-secondary">
            {{ __('app.buttons.back') }}
          </a>
        </div>
      </div>
    </form>
  </x-ui.app-content>
@endsection
