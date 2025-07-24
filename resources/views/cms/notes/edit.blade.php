@extends('layouts.master')

@section('content')
  <x-ui.app-content>
    <x-slot name="title">
      {{ __('app.notes.titles.edit') }}
    </x-slot>

    <x-slot name="tools">
      <a href="{{ route('cms.notes.index') }}" class="btn btn-secondary">
        {{ __('app.buttons.back') }}
      </a>
    </x-slot>

    <form action="{{ route('cms.notes.update', $note->id) }}" method="post">
      @csrf
      @method('PUT')

      <div class="d-flex flex-column gap-4">
        <x-forms.input :label="__('app.notes.title')" name="title" :value="$note->title" :placeholder="__('app.notes.placeholders.title')" required />

        <x-forms.textarea :label="__('app.notes.content')" name="content" :value="$note->content" :placeholder="__('app.notes.placeholders.content')" required />

        <x-forms.select :label="__('app.notes.user_sharing_label')" name="user_ids" multiple>
          @foreach ($users as $user)
            <option value="{{ $user->id }}" @selected(in_array($user->id, old('user_ids', $selectedUserIds)))>
              {{ $user->name }}
            </option>
          @endforeach
        </x-forms.select>

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


@push('scripts')
  <script>
    $('#user_ids').select2({
      width: '100%',
      allowClear: true,
      placeholder: "{{ __('app.notes.placeholders.users') }}",
      cache: true,
      ajax: {
        url: "{{ route('cms.notes.users') }}",
        dataType: 'json',
        delay: 250,
        data: function(params) {
          return {
            search: params.term || '',
            page: params.page || 1,
          };
        },
        processResults: function(result) {
          return {
            results: result.data.data.map(function(user) {
              return {
                id: user.id,
                text: user.name,
                avatar: user.image_url
              };
            }),
            pagination: {
              more: result.data.next_page_url !== null
            }
          };
        },
      },
      templateResult: function(user) {
        if (!user.id) return user.text;

        var $user = $(
          '<div class="select2-result-user d-flex align-items-center">' +
          '<img src="' + user.avatar + '" class="rounded-circle me-2" style="width:24px; height:24px;" />' +
          '<span>' + user.text + '</span>' +
          '</div>'
        );
        return $user;
      },
      templateSelection: function(user) {
        return user.text || user.id;
      },
      escapeMarkup: function(markup) {
        return markup;
      }
    });
  </script>
@endpush
