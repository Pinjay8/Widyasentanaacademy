@extends('layouts.app')

@section('title', 'Masuk')

@section('content')

<div class="container">
    @include('auth.message')
    <div class="d-flex align-items-center justify-content-center" style="height: 70vh">
        <div class="card shadow rounded-4 p-4" style="max-width: 500px; width: 100%;">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-center w-auto">
                    <img src="{{ asset('assets/img/Logo_Widyasentana.png') }}" alt="" width="100" height="80" />
                </div>
                <h4 class="text-center my-4">{{ __('messages.login_title') }}</h4>
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control rounded-3" id="email" name="email" required
                            placeholder="{{ __('messages.email_placeholder') }}">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control rounded-3" id="login_password" name="password"
                                required placeholder="{{ __('messages.password_placeholder') }}">
                            <button type="button" class="btn btn-outline-secondary"
                                onclick="togglePassword('login_password', 'eye-login')">
                                <i class="bi bi-eye-slash" id="eye-login"></i>
                            </button>
                        </div>
                    </div>
                    <button type="submit" class="btn bg-button w-100 rounded-3 text-white">{{ __('messages.login')
                        }}</button>
                </form>
                <div class="text-center mt-3">
                    {{ __('messages.login_register') }} <a href="{{ route('indexRegister') }}" class="txt-primary">{{
                        __('messages.register') }}</a>

                </div>
            </div>
        </div>
    </div>
    @endsection

    @push('scripts')
    <script>
        function togglePassword(inputId, iconId) {
        const input = document.getElementById(inputId);
        const icon = document.getElementById(iconId);

        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.replace('bi-eye-slash', 'bi-eye');
        } else {
            input.type = 'password';
            icon.classList.replace('bi-eye', 'bi-eye-slash');
        }
    }
    </script>
    @endpush