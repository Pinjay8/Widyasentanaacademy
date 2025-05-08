@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('content-dashboard')
<div class="container-fluid">
    <div class="row mt-5">
        <!-- Card for Total Donasi -->
        <div class="col-md-6 col-lg-4">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5>{{ __("messages.total_donate") }}</h5>
                </div>
                <div class="card-body text-center">
                    <h2 class="fw-bold">Rp. {{ number_format($totalDonasi, 0, ',', '.') }}</h2>
                    <p class="text-muted">{{ __('messages.description_total_donate') }}.</p>
                </div>
            </div>
        </div>

        <!-- Card for Total Pembayaran -->
        <div class="col-md-6 col-lg-4">
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white">
                    <h5>{{ __('messages.amount_donate') }}</h5>
                </div>
                <div class="card-body text-center">
                    <h2 class="fw-bold">{{ $countDonations }}</h2>
                    <p class="text-muted">{{ __('messages.description_amount_donate') }}.</p>
                </div>
            </div>
        </div>

        <!-- Card for Latest Donation -->
        <div class="col-md-6 col-lg-4">
            <div class="card shadow-sm">
                <div class="card-header bg-warning text-white">
                    <h5>{{__("messages.new_donate") }}</h5>
                </div>
                <div class="card-body text-center">
                    @if($latestDonation)
                    <h6 class="fw-bold">{{ $latestDonation->campaigns->title }}</h6>
                    <p>Rp. {{ number_format($latestDonation->amount, 0, ',', '.') }}</p>
                    <p class="text-muted">{{ __('messages.date') }}: {{ $latestDonation->created_at->format('d-m-Y
                        H:i:s') }}</p>
                    @else
                    <p>Belum ada donasi yang dilakukan.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Table for Donations History -->
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-light">
                    <h5>{{ __('messages.history_donate') }}</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>{{ __('messages.name_campaign') }}</th>
                                    <th>{{ __('messages.amount_donate') }}</th>
                                    <th>{{ __('messages.date_donation') }}</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($donations as $donation)
                                <tr>
                                    <td>{{ $donation->id }}</td>
                                    <td>{{ $donation->campaigns->title }}</td>
                                    <td>Rp. {{ number_format($donation->amount, 0, ',', '.') }}</td>
                                    <td>{{ $donation->created_at->format('d-m-Y H:i:s') }}</td>
                                    <td>
                                        @if($donation->status == 'success')
                                        <span class="badge bg-success">Berhasil</span>
                                        @elseif($donation->status == 'pending')
                                        <span class="badge bg-warning">Pending</span>
                                        @else
                                        <span class="badge bg-danger">Gagal</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Table for Payments History -->
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-light">
                    <h5>{{ __('messages.history_payment') }}</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>{{ __('messages.method_payment') }}</th>
                                    <th>{{ __('messages.payment_amount') }}</th>
                                    <th>{{ __('messages.date_payment') }}</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($payments as $payment)
                                <tr>
                                    <td>{{ $payment->id }}</td>
                                    <td>
                                        @if($payment->donations->payment_method == "BCA")
                                        <img src="{{ asset('assets/img/bca.png') }}" alt="" width="80px" height="40px">
                                        @elseif($payment->donations->payment_method == "BRI")
                                        <img src="{{ asset('assets/img/bri.png') }}" alt="" width="80px" height="40px">
                                        @elseif($payment->donations->payment_method == "BNI")
                                        <img src="{{ asset('assets/img/bni.png') }}" alt="" width="80px" height="40px">
                                        @elseif($payment->donations->payment_method == "Qris")
                                        <img src="{{ asset('assets/img/logo_qris.png') }}" alt="" width="80px"
                                            height="40px">
                                        @endif
                                    </td>
                                    <td>Rp. {{ number_format($payment->donations->amount, 0, ',', '.') }}</td>
                                    <td>{{ $payment->created_at->format('d-m-Y H:i:s') }}</td>
                                    <td>
                                        @if($payment->status == 'success')
                                        <span class="badge bg-success px-3 py-2">Berhasil</span>
                                        @elseif($payment->status == 'pending')
                                        <span class="badge bg-warning">Pending</span>
                                        @else
                                        <span class="badge bg-danger">Gagal</span>
                                        @endif
                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection