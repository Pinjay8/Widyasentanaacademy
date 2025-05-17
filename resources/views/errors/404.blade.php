@extends('layouts.app')

@section('title', __('messages.not_found'))

@section('content')
<div class="d-flex justify-content-center align-items-center vh-100">
    <div class="text-center">
        <h1 class="display-1 text-danger">404</h1>
        <h2 class="mb-4">Oops! {{ __('messages.not_found') }}</h2>
        <p class="text-muted mb-4">
            {{ __('messages.not_found_desc') }}
        </p>
        <a href="{{ route('home') }}" class="btn bg-button text-white">
            <i class="bi bi-arrow-left"></i> {{ __('messages.not_found_back') }}
        </a>
    </div>
</div>
@endsection