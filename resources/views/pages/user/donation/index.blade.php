@extends('layouts.dashboard')

@section('title', 'Donasi')

@section('content-dashboard')
<div class="container-fluid">
    <div class="mt-5">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
            aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-black"><i
                            class="bi bi-house-fill text-black"></i><span class="ms-1">Dashboard</span></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('messages.donate') }}</li>
            </ol>
        </nav>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">{{ __('messages.donate') }}</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="add-row" class="table table-striped table-hover overflow-x-hidden ">
                            <thead>
                                <tr>
                                    <th class="fw-medium">Id</th>
                                    <th class="fw-medium">{{ __('messages.name_campaign') }}</th>
                                    <th class="fw-medium">{{ __('messages.donor_name') }}</th>
                                    <th class="fw-medium">{{ __('messages.amount_donate') }}</th>
                                    <th class="fw-medium">{{ __("messages.method_payment") }}</th>
                                    <th class="fw-medium">{{ __('messages.support') }}</th>
                                    <th class="fw-medium">{{ __('messages.date_donation') }}</th>
                                    <th class="fw-medium">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($donations->isNotEmpty())

                                @forelse($donations as $data)
                                <tr>
                                    <td>{{ $data->id }}</td>
                                    <td>{{ $data->campaigns?->title ?? '-' }}</td>
                                    <td>{{ $data->user->name }}</td>
                                    <td>Rp. {{ number_format($data->amount, 0, ',', '.') }}</td>
                                    <td>
                                        @if($data->payment_method == "BPD BALI")
                                        <img src="{{ asset('assets/img/bank-bpd-bali.png') }}"
                                            alt="Gambar Bank BPD Bali" width="80px" height="40px">
                                        @elseif($data->payment_method == "BRI")
                                        <img src="{{ asset('assets/img/bri.png') }}" alt="Gambar BRI" width="80px"
                                            height="40px">
                                        @elseif($data->payment_method == "BNI")
                                        <img src="{{ asset('assets/img/bni.png') }}" alt="" width="80px" height="40px">
                                        @elseif($data->payment_method == "Qris")
                                        <img src="{{ asset('assets/img/logo_qris.png') }}" alt="Gambar Qris"
                                            width="80px" height="40px">
                                        @endif
                                    </td>
                                    <td>{{ $data->messages }}</td>
                                    <td>{{ $data->created_at->format('d-m-Y H:i:s') }}</td>
                                    <td>
                                        @if($data->status == "pending")
                                        <span
                                            class="badge d-inline-flex align-items-center gap-1 bg-warning text-dark px-3 py-2 fw-medium"
                                            style="font-size: 15px;">
                                            <i class="bi bi-hourglass-split"></i> Pending
                                        </span>
                                        @elseif($data->status == "success")
                                        <span
                                            class="badge d-inline-flex align-items-center gap-1 bg-success px-3 py-2 fw-medium"
                                            style="font-size: 15px;">
                                            <i class="bi bi-check-circle-fill"></i> Berhasil
                                        </span>
                                        @elseif($data->status == "failed")
                                        <span
                                            class="badge d-inline-flex align-items-center gap-1 bg-danger px-3 py-2 fw-medium"
                                            style="font-size: 15px;">
                                            <i class="bi bi-x-circle-fill"></i> Gagal
                                        </span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8">Tidak ada data yang tersedia.</td>
                                </tr>
                                @endforelse
                                @else
                                @endif
                            </tbody>
                        </table>
                 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection