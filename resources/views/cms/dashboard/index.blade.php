@extends('layouts.master')

@section('content')
  <x-ui.app-content>
    <x-slot name="title">
      {{ __('app.dashboard.titles.index') }}
    </x-slot>

    @session('message')
      <x-ui.alert :type="session('type')" :message="session('message')" />
    @endsession

    <h5>Welcome</h5>
  </x-ui.app-content>
@endsection
