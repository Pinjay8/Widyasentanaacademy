@extends('layouts.app')

@section('title', 'Widya Sentana Academy')

@section('content')
<section>
    <div class="container">
        {{-- <div class="hero"> --}}
            {{-- <div class="text-center mt-5  pt-3 shadow-lg p-5 rounded-5" style="background-image: url('assets/img/img_donasi.jpg');
                height: 380px; background-repeat: no-repeat;
                background-size: cover;"> --}}
                {{-- <h1>Welcome to the Home Page</h1>
                <p>This is a simple Laravel Blade template example.</p>
                <p>Current date and time: {{ now() }}</p> --}}
                {{-- <img src="{{ asset('assets/img/img_donasi.jpg') }}" alt="" height="300px"> --}}
                {{--
            </div> --}}

            {{-- </div> --}}
        <div class="swiper mySwipers mt-5">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <img src="{{ asset('assets/img/background-placeholder.svg') }}" alt="" class="img-fluid">
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('assets/img/background-placeholder.svg') }}" alt="" class="img-fluid">
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('assets/img/background-placeholder.svg') }}" alt="" class="img-fluid">
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('assets/img/background-placeholder.svg') }}" alt="" class="img-fluid">
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('assets/img/background-placeholder.svg') }}" alt="" class="img-fluid">
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('assets/img/background-placeholder.svg') }}" alt="" class="img-fluid">
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('assets/img/background-placeholder.svg') }}" alt="" class="img-fluid">
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('assets/img/background-placeholder.svg') }}" alt="" class="img-fluid">
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('assets/img/background-placeholder.svg') }}" alt="" class="img-fluid">
                </div>
            </div>
            <div class="swiper-pagination"></div>
        </div>

        <div class="card-container my-5 pt-4">
            <div class="row g-4">
                <div class="d-flex justify-content-between align-items-center">
                    <h3>
                        {{ __('messages.subheading_campaign') }}
                    </h3>
                    <a href="{{ route('donasi') }}" class="btn btn-outline-primary rounded-4 fs-6 ">
                        {{ __('messages.others') }} <i class="bi bi-arrow-right fs-6"></i>
                    </a>
                </div>
                @foreach ($campaigns as $campaign)
                <div class="col-md-4">
                    <div class="card shadow-sm rounded-3 h-100 d-flex flex-column p-0">
                        <a href="{{ route('donasi.show', $campaign->slug) }}">
                            @if($campaign->thumbnail != null)
                            <img src="{{ $campaign->thumbnail() }}" alt="Gambar Thumbnail" width="100%"
                                class="object-fit-cover" style="object-position: center; height: 168px;"
                                onerror="this.onerror=null; this.src='{{ asset('assets/img/background-placeholder.svg') }}';">
                            @else
                            <img src="{{ asset('assets/img/background-placeholder.svg') }}" class="img-fluid"
                                alt="{{ $campaign->title }}" height="200px">
                            @endif
                        </a>
                        <div class="card-body">
                            <h5 class="card-title">{{ $campaign->title }}</h5>
                            <h6 class="fw-normal text-primary fw-bold">
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
                            @endphp

                            <div class="progress my-3" style="height: 14px;">
                                <div class="progress-bar bg-primary" role="progressbar"
                                    style="width: {{ $percentage }}%;" aria-valuenow="{{ $percentage }}"
                                    aria-valuemin="0" aria-valuemax="100">
                                    {{ $percentage }} %
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                @if($campaign->is_active)
                                <a href="{{ route('campaign.index', ['slug' => $campaign->slug]) }}"
                                    class="btn btn-primary text-white">{{ __('messages.donated') }}</a>
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
                    <h4>{{ __('messages.why_choose_us_1') }}</h4>
                    <p></p>
                </div>
                <div class="col-md-3 d-flex align-items-center flex-column justify-content-center">
                    <i class="bi bi-bullseye fs-1 mb-3"></i>
                    <h4>{{ __('messages.why_choose_us_2') }}</h4>
                    <p></p>
                </div>
                <div class="col-md-3 d-flex align-items-center flex-column justify-content-center">
                    <i class="bi bi-heart fs-1 mb-3"></i>
                    <h4>{{ __('messages.why_choose_us_3') }}</h4>
                    <p></p>
                </div>
                <div class="col-md-3 d-flex align-items-center flex-column justify-content-center">
                    <i class="bi bi-hand-index fs-1 mb-3"></i>
                    <h4>{{ __('messages.why_choose_us_4') }}</h4>
                    <p></p>
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
                    <div class="card rounded-4 h-100 p-lg-3 border-0 shadow-sm" style="background-color: #fffcfc;">
                        <div class="card-body ">
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
                            <h6 class="card-subtitle mb-2 mt-2">{{ $donation->campaigns->title }}</h6>
                            <p style="
                            display: -webkit-box;
                            -webkit-line-clamp: 2;
                            -webkit-box-orient: vertical;
                            overflow: hidden;
                            text-overflow: ellipsis;
                        ">
                                {{ $donation->messages }}
                            </p>
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
        <div class="accordion" id="accordionExample">
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