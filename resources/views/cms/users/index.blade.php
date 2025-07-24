@extends('layouts.master')

@section('content')
  <x-ui.app-content>
    <x-slot name="title">
      {{ __('app.users.titles.index') }}
    </x-slot>

    <x-slot name="tools">
      @can('create', \App\Models\User::class)
        <a href="{{ route('cms.users.create') }}" class="btn btn-primary">
          {{ __('app.buttons.add') }}
        </a>
      @endcan
    </x-slot>

    @session('message')
      <x-ui.alert :type="session('type')" :message="session('message')" />
    @endsession

    <div class="table-responsive" style="min-height: 15rem;">
      <table class="table table-hover">
        <thead>
          <tr>
            <th style="width: 10px">{{ __('app.general.number') }}</th>
            <th>{{ __('app.users.name') }}</th>
            <th>{{ __('app.users.email') }}</th>
            <th>{{ __('app.users.phone_number') }}</th>
            <th></th>
          </tr>
        </thead>

        <tbody>
          @foreach ($users as $user)
            <tr class="align-middle">
              <td>{{ $loop->iteration + $users->perPage() * ($users->currentPage() - 1) }}</td>
              <td>{{ $user->name }}</td>
              <td>{{ $user->email }}</td>
              <td>{{ $user->phone_number }}</td>
              <td style="width: 1%; white-space: nowrap;">
                <x-buttons.dropdown :label="__('app.buttons.actions')">

                  @can('view', $user)
                    <x-buttons.dropdown-item :label="__('app.buttons.detail')" :url="route('cms.users.show', $user->id)" />
                  @endcan

                  @can('update', $user)
                    <x-buttons.dropdown-item :label="__('app.buttons.edit')" :url="route('cms.users.edit', $user->id)" />
                  @endcan

                  @can('delete', $user)
                    <form action="{{ route('cms.users.destroy', $user->id) }}" method="post">
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

    {{ $users->links() }}
  </x-ui.app-content>
@endsection
