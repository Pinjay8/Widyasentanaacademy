@extends('layouts.app')

@section('title', 'Campaign Donasi')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Campaign Donasi</h2>

    {{-- Filter Form --}}
    <form method="GET" action="{{ route('donasi') }}" class="row mb-4">
        <div class="col-lg-5 px-1">
            {{-- <input type="text" name="search" class="form-control" placeholder="Cari campaign..."
                value="{{ request('search') }}"> --}}
            <input type="text" name="search" class="form-control"
                placeholder="{{ __('messages.search_campaign_placeholder') }}" value="{{ request('search') }}"
                onchange="this.form.submit()">
        </div>
        <div class="col-lg-5 py-3 py-lg-0 px-0">
            <select name="filter" class="form-select" onchange="this.form.submit()">
                <option value="" hidden>{{ __('messages.sort_by') }}</option>
                <option value="newest" {{ request('filter')=='newest' ? 'selected' : '' }}>{{ __('messages.sort_newest')
                    }}</option>
                <option value="oldest" {{ request('filter')=='oldest' ? 'selected' : '' }}>{{ __('messages.sort_oldest')
                    }}</option>
                <option value="highest" {{ request('filter')=='highest' ? 'selected' : '' }}>{{
                    __('messages.sort_highest') }}</option>
                <option value="lowest" {{ request('filter')=='lowest' ? 'selected' : '' }}>{{ __('messages.sort_lowest')
                    }}</option>
                <option value="still_active" {{ request('filter')=='still_active' ? 'selected' : '' }}>{{
                    __('messages.sort_still_active')
                    }}</option>
                </option>
                <option value="finished" {{ request('filter')=='finished' ? 'selected' : '' }}>{{
                    __('messages.sort_finished')
                    }}</option>
                ></option>
            </select>
        </div>
        <div class="col-lg-2">
            <button type="submit" class="btn bg-button w-100 text-white">{{ __('messages.filter') }}</button>
        </div>
    </form>

    {{-- Campaign Cards --}}
    <div class="row g-4">
        @forelse ($campaigns as $campaign)
        <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4  p-1">
            <div class="card shadow-sm rounded-3 h-100 d-flex flex-column p-0">
                <a href="{{ route('donasi.show', $campaign->slug) }}">
                    @if($campaign->thumbnail != null)
                    <img src="{{ $campaign->thumbnail() }}" alt="Gambar Thumbnail" width="100%"
                        class=" object-fit-cover rounded-top" style="object-position: center; height: 150px;"
                        onerror="this.onerror=null; this.src='{{ asset('assets/img/background-placeholder.svg') }}';">
                    @else
                    <img src="{{ asset('assets/img/background-placeholder.svg') }}" class="img-fluid"
                        alt="{{ $campaign->title }}" height="200px">
                    @endif
                </a>
                <div class="card-body d-flex flex-column">
                    <h6 class="card-title title-campaign mb-0">{{ $campaign->title }}</h6>
                    <h6 class="fw-normal txt-primary fw-bold" style="font-size: 15px;">
                        Rp. {{ number_format($campaign->collected_amount, 0, ',', '.') }}
                        <span class="text-black fw-normal">{{ __('messages.collected') }}</span>
                        <span class="fs-6 fw-medium text-black">
                            Rp. {{ number_format($campaign->target_amount, 0, ',', '.') }}
                        </span>
                    </h6>

                    @php
                    $percentage = $campaign->target_amount > 0
                    ? ($campaign->collected_amount / $campaign->target_amount) * 100
                    : 0;
                    $percentage = $percentage > 0 ? max(1, round($percentage)) : 0;
                    @endphp

                    <div class="progress my-1">
                        <div class="progress-bar bg-button" role="progressbar" style="width: {{ $percentage }}%;"
                            aria-valuenow="{{ $percentage }}" aria-valuemin="0" aria-valuemax="100">
                            {{ $percentage }}%
                        </div>
                    </div>
                </div>

                {{-- Footer selalu di bawah --}}
                <div class="d-flex justify-content-between align-items-center mt-auto px-3 pb-3">
                    {{-- @php
                    $isExpired = \Carbon\Carbon::parse($campaign->end_date)->lt(now());
                    @endphp

                    @if (!$isExpired) --}}
                    @if($campaign->is_active)
                    <a href="{{ route('campaign.index', ['slug' => $campaign->slug]) }}"
                        class="btn bg-button text-white">{{ __('messages.donated') }}</a>
                    @else
                    <button class="btn btn-success" disabled>Sudah Selesai</button>
                    @endif

                    <p class="mb-0 fw-medium">{{ $campaign->label }}</p>
                    {{-- @else
                    <span class="text-success fw-semibold">Campaign Selesai</span>
                    @endif --}}
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <p class="text-center fs-5">Tidak ada campaign
                yang ditemukan.</p>
        </div>
        @endforelse
        {!! $campaigns->withQueryString()->links() !!}
    </div>
</div>

@endsection