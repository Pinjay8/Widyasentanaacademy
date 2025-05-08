@extends('layouts.app')

@section('title', 'Daftar')

@section('content')

<div class="container">

    <div class="d-flex align-items-center justify-content-center"
        style="height: 70vh; margin-top: 150px; margin-bottom: 100px;">
        <div class="card shadow rounded-4 p-4" style="max-width: 500px; width: 100%;">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-center w-auto">
                    <img src="{{ asset('assets/img/Logo_Widyasentana.png') }}" alt="" width="100" height="80" />
                </div>
                <h4 class="text-center my-4">{{ __('messages.register_title') }}</h4>
                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">{{ __('messages.register_name') }}</label>
                        <input type="text" class="form-control rounded-3" id="name" name="name"
                            placeholder="{{ __('messages.register_name_placeholder') }}">
                        @error('name')
                        <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="no_telp" class="form-label">{{ __('messages.register_number') }}</label>
                        <input type="tel" class="form-control rounded-3" id="no_telp" name="no_telp"
                            value="{{ old('no_telp') }}" placeholder="{{ __('messages.register_number_placeholder') }}"
                            pattern="[0-9]{10,15}" inputmode="numeric"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                        @error('no_telp')
                        <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control rounded-3" id="email" name="email"
                            placeholder="{{ __('messages.email_placeholder') }}">
                        @error('email')
                        <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="{{ __('messages.password_placeholder') }}">
                            <button type="button" class="btn btn-outline-secondary"
                                onclick="togglePassword('password', 'eye-icon1')">
                                <i class="bi bi-eye-slash" id="eye-icon1"></i>
                            </button>
                        </div>
                        @error('password')
                        <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">{{
                            __('messages.register_confirm_password') }}</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="password_confirmation"
                                name="password_confirmation"
                                placeholder="{{ __('messages.register_confirm_password_placeholder') }}">
                            <button type="button" class="btn btn-outline-secondary"
                                onclick="togglePassword('password_confirmation', 'eye-icon2')">
                                <i class="bi bi-eye-slash" id="eye-icon2"></i>
                            </button>
                        </div>
                        @error('password_confirmation')
                        <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    {{-- @include('auth.message') --}}
                    <button type="submit" class="btn btn-primary w-100 rounded-3">Daftar</button>
                </form>
                <div class="text-center mt-3">
                    <small>{{ __('messages.register_login') }} <a href="{{ route('login') }}">{{ __('messages.login')
                            }}</a></small>
                </div>
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