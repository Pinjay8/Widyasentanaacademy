@extends('layouts.dashboard')

@section('title', 'Edit Campaign')

@section('content-dashboard')
<div class="card">
    <div class="card-header fw-bold">Edit Campaign</div>
    <div class="card-body">
        <form action="{{ route('campaigns.update', $campaign->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('pages.admin.campaign._form', ['button' => 'Edit', 'campaign' => $campaign])
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