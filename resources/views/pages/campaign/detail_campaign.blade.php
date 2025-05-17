@extends('layouts.app')

@section('title', 'Campaign Donasi')

@section('content')
<div class="container py-5">

    <div class="row">
        <div class="col-md-8">
            <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
                aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="txt-primary">{{ __('messages.home')
                            }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('donasi') }}"
                            class="txt-primary">{{
                            __('messages.donate') }}</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">{{
                        $campaign->title }}</li>
                </ol>
            </nav>
            <h3 class="text-center">{{ $campaign->title }}</h3>
            <h6 class="text-muted text-center mb-0">{{
                \Carbon\Carbon::parse($campaign->created_at)->translatedFormat('l, j F
                Y H:i') }}
                WIB</h6>
            @if($campaign->thumbnail != null)
            <img src="{{ $campaign->thumbnail() }}" alt="Gambar Thumbnail" width="100%" height="550px"
                class="img-fluid mt-lg-4 mt-2 rounded "
                onerror="this.onerror=null; this.src='{{ asset('assets/img/background-placeholder.svg') }}';">
            @else
            <img src="{{ asset('assets/img/background-placeholder.svg') }}" alt="Gambar Thumbnail" width="100%"
                height="550px" class="img-fluid mt-lg-4 mt-2 rounded-2">
            @endif
            <div class="card mt-3 border-0">
                <div class="card-body ">
                    <h4 class="mb-0 fw-bold mb-3">{{ __('messages.story_campaign') }}</h4>
                    <p class="fw-normal" style="text-align: justify">{!! $campaign->description !!}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0">
                <div class="card-body">
                    <h5>{{ __('messages.collected_donate') }}</h5>
                    <h4 class="txt-primary">Rp. {{ number_format($campaign->collected_amount, 0, ',', '.') }}</h4>
                    <h6 class="fw-normal">{{ __('messages.target_collected') }} <span class="fw-semibold fs-5">Rp. {{
                            number_format($campaign->target_amount, 0, ',',
                            '.') }} </span>
                    </h6>
                    @php
                    $percentage = $campaign->target_amount > 0
                    ? ($campaign->collected_amount / $campaign->target_amount) * 100
                    : 0;
                    $percentage = round($percentage); // hasil misal: 73
                    @endphp

                    <div class="progress my-3" style="height: 14px;">
                        <div class="progress-bar bg-button" role="progressbar" style="width: {{ $percentage }}%;"
                            aria-valuenow="{{ $percentage }}" aria-valuemin="0" aria-valuemax="100">
                            {{ $percentage }}%
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-3 justify-content-center my-3">
                        <div class="border-end pe-3 border-2">
                            <h5 class="text-center text-muted">{{ $countDonations }}</h5>
                            <h5 class="text-muted">{{ __('messages.donate') }}</h5>
                        </div>
                        {{-- days_duration --}}
                        <div>
                            @if ($campaign->days_duration > 0)
                            <h5 class="fw-bold text-center text-muted">{{ $campaign->days_duration }}</h5>
                            <h5 class="text-muted text-center">{{ __('messages.days_left') }}</h5>
                            @else
                            <h5 class="text-muted text-center">{{ $campaign->label }}</h5>
                            @endif
                        </div>
                    </div>
                    @if($campaign->is_active)
                    <a href="{{ route('campaign.index',['slug' => $campaign->slug]) }}"
                        class="btn bg-button w-100 fw-medium fs-6 text-white"><i class="bi bi-heart-fill me-2"></i>{{
                        __('messages.donate') }} </a>

                    {{-- Tombol Bagikan --}}
                    <div class="d-flex gap-2 align-items-center mt-2">
                        <!-- Tombol Bagikan -->
                        <button type="button" class="btn btn-outline-primary fw-medium fs-6 w-100 no-hover"
                            data-bs-toggle="modal" data-bs-target="#shareModal">
                            {{ __('messages.share') }}
                        </button>

                        <!-- Ikon Bagikan -->
                        <button type="button" class="btn btn-outline-primary no-hover" data-bs-toggle="modal"
                            data-bs-target="#shareModal">
                            <i class="bi bi-share-fill"></i>
                        </button>
                    </div>
                    @else
                    <h5 class="mb-0 fw-normal">Terima kasih, Campaign ini sudah selesai.
                    </h5>
                    @endif
                    <div class="mt-3">
                        <h5 class="mb-3">{{ __('messages.donate') }}</h5>
                        @forelse ($donations->take(5) as $donation)
                        <div class="d-flex gap-3 align-items-start">
                            <div class="d-flex justify-content-center align-items-center">
                                <img src="{{ asset('assets/img/icon-profile.png') }}" alt="icon profile"
                                    class="img-fluid rounded-circle" style="width: 50px; height: 50px;">
                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0">{{ $donation->user->name }}</h5>
                                    <ul class="mb-0">
                                        <li class="text-muted fs-6">
                                            {{ \Carbon\Carbon::parse($donation->created_at)->diffForHumans() }}
                                        </li>
                                    </ul>
                                </div>

                                <small class="text-muted d-block mb-2 text-start">
                                    {{ \Carbon\Carbon::parse($donation->created_at)->format('d M Y, H:i') }}
                                </small>
                                <h5>Rp {{ number_format($donation->amount, 0, ',', '.') }}</h5>
                            </div>
                        </div>
                        @empty
                        <h6 class="text-center fw-normal">
                            {{ __('messages.empty_donate') }}.
                        </h6>
                        @endforelse
                    </div>

                    {{-- Modal Bagikan --}}
                    @include('pages.campaign.modal')
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        @foreach ($campaigns as $campaign)
        <div class="col-md-4">
            <div class="card shadow-sm rounded-3 h-100 d-flex flex-column p-0">
                <a href="{{ route('donasi.show', $campaign->slug) }}">
                    @if($campaign->thumbnail != null)
                    <img src="{{ $campaign->thumbnail() }}" alt="Gambar Thumbnail" width="100%"
                        class="object-fit-cover rounded-top" style="object-position: center; height: 200px;"
                        onerror="this.onerror=null; this.src='{{ asset('assets/img/background-placeholder.svg') }}';">
                    @else
                    <img src="{{ asset('assets/img/background-placeholder.svg') }}" class="img-fluid"
                        alt="{{ $campaign->title }}" height="200px">
                    @endif
                </a>
                <div class="card-body">
                    <h5 class="card-title" style="height: 48px;">{{ $campaign->title }}</h5>
                    <h6 class="fw-normal txt-primary fw-bold" style="height: 20px;">
                        Rp. {{ number_format($campaign->collected_amount, 0, ',', '.') }}
                        <span class="text-black fw-normal fs-6">{{ __('messages.collected') }}</span>
                        <span class="fs-6 fw-normal text-black">
                            Rp. {{ number_format($campaign->target_amount, 0, ',', '.') }}
                        </span>
                    </h6>
                    @php
                    $percentage = $campaign->target_amount > 0
                    ? ($campaign->collected_amount / $campaign->target_amount) * 100
                    : 0;
                    $percentage = round($percentage);
                    @endphp

                    <div class="progress my-3" style="height: 14px;">
                        <div class="progress-bar bg-button" role="progressbar" style="width: {{ $percentage }}%;"
                            aria-valuenow="{{ $percentage }}" aria-valuemin="0" aria-valuemax="100">
                            {{ $percentage }}%
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        @if($campaign->is_active)
                        <a href="{{ route('campaign.index', ['slug' => $campaign->slug]) }}"
                            class="btn bg-button text-white">{{ __('messages.donated') }}</a>
                        <p class="mb-0 fw-medium">{{ $campaign->label }}</p>
                        @else
                        <button class="btn btn-success" disabled>Sudah Selesai</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
@push('scripts')
<script>
    function copyShareLink() {
    var copyText = document.getElementById("shareLink");
    copyText.select();
    copyText.setSelectionRange(0, 99999); // Untuk mobile
    document.execCommand("copy");
}
</script>
@endpush