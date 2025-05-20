@extends('layouts.app')

@section('title', 'Widya Sentana Academy')

@section('content')
<section>
    <div class="container">
        <div class="swiper mySwipers mt-lg-5 vh-lg-100 vh-50">
            <div class="swiper-wrapper">
                @foreach($banners as $banner)
                <div class="swiper-slide">
                    <img src="{{ $banner->imagePath() }}" alt="" class="object-fit-contain object-center rounded">
                </div>
                @endforeach
            </div>
            <div class="swiper-pagination"></div>
        </div>

        <div class="card-container my-5 pt-4">
            <div class="row g-4">
                <div class="d-flex justify-content-between align-items-center">
                    <h3>
                        {{ __('messages.subheading_campaign') }}
                    </h3>
                    <a href="{{ route('donasi') }}" class="btn btn-outline-primary rounded-4 fs-6 no-hover">
                        {{ __('messages.others') }} <i class="bi bi-arrow-right fs-6"></i>
                    </a>
                </div>
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
                            <h6 class="card-title title-campaign">{{ $campaign->title }}</h6>
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
                            $percentage = $percentage > 0 ? max(1, round($percentage)) : 0;
                            @endphp

                            <div class="progress my-3" style="height: 14px;">
                                <div class="progress-bar bg-button" role="progressbar"
                                    style="width: {{ $percentage }}%;" aria-valuenow="{{ $percentage }}"
                                    aria-valuemin="0" aria-valuemax="100">
                                    {{ $percentage }}%
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                @if($campaign->is_active)
                                {{-- Campaign sedang berlangsung --}}
                                <a href="{{ route('campaign.index', ['slug' => $campaign->slug]) }}"
                                    class="btn bg-button text-white">{{ __('messages.donated') }}</a>
                                <p class="mb-0 fw-medium text-">{{ $campaign->label }}</p>

                                @elseif(Str::startsWith($campaign->label, __('messages.upcoming')))
                                {{-- Campaign belum dimulai --}}
                                <button class="btn btn-warning text-white" disabled>Belum Dimulai</button>
                                <p class="mb-0 fw-medium text-warning">{{ $campaign->label }}</p>

                                @else
                                {{-- Campaign sudah selesai --}}
                                <button class="btn btn-success" disabled>Sudah Selesai</button>
                                <p class="mb-0 fw-medium text-muted">{{ $campaign->label }}</p>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="card-container my-5 pt-5 bg-primary-clr text-white">
        <div class="container">
            <div class="row p-5">
                <div class="col-md-12 mb-5 pb-lg-5">
                    <h4 class="text-center">{{ __('messages.why_choose_us') }}</h4>
                    <h5 class="text-center">#{{ __('messages.subheading_why_choose_us') }}</h5>
                </div>

                <div class="col-md-3 d-flex align-items-center flex-column justify-content-center">
                    <i class="bi bi-search fs-1 mb-3"></i>
                    <h4 class="text-center">{{ __('messages.why_choose_us_1') }}</h4>
                </div>
                <div class="col-md-3 d-flex align-items-center flex-column justify-content-center">
                    <i class="bi bi-bullseye fs-1 mb-3"></i>
                    <h4 class="text-center">{{ __('messages.why_choose_us_2') }}</h4>
                </div>
                <div class="col-md-3 d-flex align-items-center flex-column justify-content-center">
                    <i class="bi bi-heart fs-1 mb-3"></i>
                    <h4 class="text-center">{{ __('messages.why_choose_us_3') }}</h4>
                </div>
                <div class="col-md-3 d-flex align-items-center flex-column justify-content-center">
                    <i class="bi bi-hand-index fs-1 mb-3"></i>
                    <h4 class="text-center">{{ __('messages.why_choose_us_4') }}</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <h3>{{ __('messages.kindly_donated') }}</h3>
        <div class="swiper mySwiper mt-lg-3 mt-1 pb-lg-5 pb-4">
            <div class="swiper-wrapper">
                @foreach ($donations as $donation)
                <div class="swiper-slide mt-3">
                    <div class="card rounded-4 h-100 p-lg-3 border-0 shadow-sm"
                        style="background-color: #fffcfc; display: flex; flex-direction: column;">
                        <div class="card-body d-flex flex-column" style="flex-grow: 1;">
                            <div class="d-flex gap-3 align-items-start">
                                <img src="{{ asset('assets/img/icon-profile.png') }}" alt=""
                                    style="width: 50px; height: 50px;" class="rounded-circle">
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
                                </div>
                            </div>
                            <p class="card-text mb-0">
                                <strong>Rp {{ number_format($donation->amount, 0, ',', '.') }}</strong>
                            </p>
                            <h6 class="card-subtitle mb-2 mt-2 title-campaign">{{ $donation->campaigns->title }}</h6>
                            <p class="message">
                                {{ $donation->messages ?? '-' }}
                            </p>
                            <div class="mt-auto"></div> <!-- Ensures content is pushed to the bottom of the card -->
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="swiper-pagination mt-3"></div>
        </div>
    </div>
    <div class="container mt-3 mb-5">
        <h3>{{ __('messages.faq') }}</h3>
        <h5 class="fw-normal mb-3">{{ __('messages.sub_faq') }}</h5>
        <div class="accordion shadow-sm rounded" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        {{ __('messages.accordion_1') }}
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        {{ __('messages.accordion_1_desc') }}
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        {{ __('messages.accordion_2') }}

                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        {{ __('messages.accordion_2_desc') }}
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        {{ __('messages.accordion_3') }}
                    </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        {{ __('messages.accordion_3_desc') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection