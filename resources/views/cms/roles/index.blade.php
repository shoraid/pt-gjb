@extends('layouts.master')

@section('content')
  <x-ui.app-content>
    <x-slot name="title">
      {{ __('app.roles.titles.index') }}
    </x-slot>

    <x-slot name="tools">
      @can('create', \App\Models\Role::class)
        <a href="{{ route('cms.roles.create') }}" class="btn btn-primary">
          {{ __('app.buttons.add') }}
        </a>
      @endcan
    </x-slot>

    @session('message')
      <x-ui.alert :type="session('type')" :message="session('message')" />
    @endsession

    <div class="table-responsive">
      <table class="table table-hover">
        <thead>
          <tr>
            <th style="width: 10px">{{ __('app.general.number') }}</th>
            <th>{{ __('app.roles.name') }}</th>
            <th>{{ __('app.roles.description') }}</th>
            <th></th>
          </tr>
        </thead>

        <tbody>
          @foreach ($roles as $role)
            <tr class="align-middle">
              <td>{{ $loop->iteration + $roles->perPage() * ($roles->currentPage() - 1) }}</td>
              <td>{{ $role->name }}</td>
              <td>{{ $role->description }}</td>
              <td style="width: 1%; white-space: nowrap;">
                <x-buttons.dropdown :label="__('app.buttons.actions')">
                  @can('view', $role)
                    <x-buttons.dropdown-item :label="__('app.buttons.detail')" :url="route('cms.roles.show', $role->id)" />
                  @endcan

                  @can('update', $role)
                    <x-buttons.dropdown-item :label="__('app.buttons.edit')" :url="route('cms.roles.edit', $role->id)" />
                  @endcan

                  @can('delete', $role)
                    <form action="{{ route('cms.roles.destroy', $role->id) }}" method="post">
                      @csrf
                      @method('DELETE')
                      <button type="submit" onclick="return confirm('{{ __('app.messages.sure_to_delete') }}');"
                        class="dropdown-item">
                        {{ __('app.buttons.delete') }}
                      </button>
                    </form>
                  @endcan

                </x-buttons.dropdown>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    {{ $roles->links() }}
    </div>
  </x-ui.app-content>
@endsection
