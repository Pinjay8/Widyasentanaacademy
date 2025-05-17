@extends('layouts.dashboard')

@section('title', 'Edit Banner')

@section('content-dashboard')
<div class="card">
    <div class="card-header fw-bold">Edit Banner</div>
    <div class="card-body">
        <form action="{{ route('banners.update', $banner->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('pages.admin.banner._form', ['button' => 'Edit', 'banner' => $banner])
        </form>
    </div>
</div>
@endsection
