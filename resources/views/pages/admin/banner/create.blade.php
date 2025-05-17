@extends('layouts.dashboard')

@section('title', 'Tambah Banner')

@section('content-dashboard')
<div class="card">
    <div class="card-header fw-semibold fs-5">Tambah Banner</div>
    <div class="card-body">
        <form action="{{ route('banners.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('pages.admin.banner._form', ['button' => 'Simpan'])
        </form>
    </div>
</div>
@endsection