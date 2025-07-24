@extends('layouts.master')

@section('content')
  <x-ui.app-content>
    <x-slot name="title">
      {{ __('app.notes.titles.index') }}
    </x-slot>

    <x-slot name="tools">
      @can('create', \App\Models\Note::class)
        <a href="{{ route('cms.notes.create') }}" class="btn btn-primary">
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
            <th>{{ __('app.notes.title') }}</th>
            <th>{{ __('app.notes.archived') }}</th>
            <th></th>
          </tr>
        </thead>

        <tbody>
          @foreach ($notes as $note)
            <tr class="align-middle">
              <td>{{ $loop->iteration + $notes->perPage() * ($notes->currentPage() - 1) }}</td>
              <td>{{ $note->title }}</td>
              <td>{{ $note->archived ? __('app.general.yes') : __('app.general.no') }}</td>
              <td style="width: 1%; white-space: nowrap;">
                <x-buttons.dropdown :label="__('app.buttons.actions')">
                  @can('view', $note)
                    <x-buttons.dropdown-item :label="__('app.buttons.detail')" :url="route('cms.notes.show', $note->id)" />
                  @endcan

                  @can('update', $note)
                    <x-buttons.dropdown-item :label="__('app.buttons.edit')" :url="route('cms.notes.edit', $note->id)" />
                  @endcan

                  @can('delete', $note)
                    <form action="{{ route('cms.notes.destroy', $note->id) }}" method="post">
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

    {{ $notes->links() }}
    </div>
  </x-ui.app-content>
@endsection
