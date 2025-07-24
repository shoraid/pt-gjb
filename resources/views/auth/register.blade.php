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
            <span class="fw-bold">Create an Account</span>
            <span class="text-secondary">Join us and start managing your data efficiently.</span>
          </div>

          <form method="POST" action="{{ route('register') }}">
            <div class="d-flex flex-column gap-4">
              @csrf

              <x-forms.input :label="__('app.users.name')" name="name" :placeholder="__('app.users.placeholders.name')" required />

              <x-forms.input :label="__('app.users.email')" type="email" name="email" :placeholder="__('app.users.placeholders.email')" required />

              <x-forms.input :label="__('app.users.phone_number')" name="phone_number" :placeholder="__('app.users.placeholders.phone_number')" />

              <x-forms.input :label="__('app.users.password')" type="password" name="password" :placeholder="__('app.users.placeholders.password')" required />

              <x-forms.input :label="__('app.users.password_confirmation')" type="password" name="password_confirmation" :placeholder="__('app.users.placeholders.password_confirmation')"
                required />

              <div>
                <button type="submit" class="btn btn-primary w-100">
                  Register
                </button>
              </div>
            </div>
          </form>

          <div class="text-center">
            Already have an account?
            <a href="{{ route('login') }}" class="text-dark">
              Sign in
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
