@extends('layouts.dashboard')

@section('title', 'Tambah Campaign')

@section('content-dashboard')
<div class="card">
    <div class="card-header fw-semibold fs-5">Tambah Campaign</div>
    <div class="card-body">
        <form action="{{ route('campaigns.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('pages.admin.campaign._form', ['button' => 'Simpan'])
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
  $('#editor').summernote({
    tabsize: 2,
        height: 100
  });
});
</script>
@endpush