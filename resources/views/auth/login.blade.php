@extends('components.layouts.auth.default')

@section('content')
  <div class="w-100" style="max-width: 24rem;">
    @session('message')
      <x-ui.alert :type="session('type')" :message="session('message')" />
    @endsession

    <div class="card" style="border-radius: .75rem;">
      <div class="card-body">
        <div class="p-2 d-flex flex-column gap-4">
          <div class="d-flex flex-column gap-1">
            <span class="fw-bold">Login to your account</span>
            <span class="text-secondary">Enter your email below to login to your account</span>
          </div>

          <form method="POST" action="{{ route('login') }}">
            <div class="d-flex flex-column gap-4">
              @csrf

              <x-forms.input :label="__('app.users.email')" type="email" name="email" value="admin@example.com"
                :placeholder="__('app.users.placeholders.email')" />

              <x-forms.input :label="__('app.users.password')" type="password" name="password" value="password" :placeholder="__('app.users.placeholders.password')" />

              <div>
                <button type="submit" class="btn btn-primary w-100">
                  Login
                </button>
              </div>
            </div>
          </form>

          <div class="text-center">
            Don't have an account?
            <a href="{{ route('register') }}" class="text-dark">
              Sign up
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
