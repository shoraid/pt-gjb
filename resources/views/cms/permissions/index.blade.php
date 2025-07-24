@extends('layouts.master')

@section('content')
  <x-ui.app-content>
    <x-slot name="title">
      {{ __('app.permissions.titles.index') }}
    </x-slot>

    <x-slot name="tools">
      @can('create', \App\Models\Permission::class)
        <a href="{{ route('cms.permissions.create') }}" class="btn btn-primary">
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
            <th>{{ __('app.permissions.name') }}</th>
            <th>{{ __('app.permissions.parent') }}</th>
            <th>{{ __('app.permissions.display_order') }}</th>
            <th></th>
          </tr>
        </thead>

        <tbody>
          @foreach ($permissions as $permission)
            <tr class="align-middle">
              <td>{{ $loop->iteration + $permissions->perPage() * ($permissions->currentPage() - 1) }}</td>
              <td>{{ $permission->name }}</td>
              <td>{{ $permission->parent?->name ?? '-' }}</td>
              <td>{{ $permission->display_order }}</td>
              <td style="width: 1%; white-space: nowrap;">
                <x-buttons.dropdown :label="__('app.buttons.actions')">

                  @can('view', $permission)
                    <x-buttons.dropdown-item :label="__('app.buttons.detail')" :url="route('cms.permissions.show', $permission->id)" />
                  @endcan

                  @can('update', $permission)
                    <x-buttons.dropdown-item :label="__('app.buttons.edit')" :url="route('cms.permissions.edit', $permission->id)" />
                  @endcan

                  @can('delete', $permission)
                    <form action="{{ route('cms.permissions.destroy', $permission->id) }}" method="post">
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

    {{ $permissions->links() }}
  </x-ui.app-content>
@endsection
