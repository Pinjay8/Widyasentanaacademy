@extends('layouts.dashboard')

@section('title', 'Pembayaran')

@section('content-dashboard')
<div class="container-fluid">
    <div class="mt-5">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
            aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-black"><i
                            class="bi bi-house-fill text-black"></i><span class="ms-1">Dashboard</span></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('messages.payment') }}</li>
            </ol>
        </nav>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">{{ __('messages.payment') }}</h4>
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
                                    <th class="fw-medium text-start">{{ __('messages.date_payment') }}</th>
                                    <th class="fw-medium">{{ __('messages.proof_payment') }}</th>
                                    <th class="fw-medium">Status</th>
                                    <th class="fw-medium">{{ __('messages.action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($payments as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->donations->campaigns?->title ?? '-' }}</td>
                                    <td>{{ $data->donations->user->name }}</td>
                                    <td>Rp. {{ number_format($data->donations->amount, 0, ',', '.') }}</td>
                                    <td class="text-start">{{ $data->payment_date }}</td>
                                    <td>
                                        @if($data->history_payment)
                                        <img src="{{ asset('storage/' . $data->history_payment) }}"
                                            alt="Bukti Pembayaran" width="80" height="45" style="cursor: pointer;"
                                            data-bs-toggle="modal" data-bs-target="#imageModal"
                                            onclick="showImageModal('{{ asset('storage/' . $data->history_payment) }}')" />
                                        @else
                                        -
                                        @endif
                                    </td>
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
                                    @if ($data->expires_at &&
                                    \Carbon\Carbon::parse($data->expires_at)->isFuture() && $data->history_payment ==
                                    null)
                                    <td>
                                        <a href="{{ route('payments.showForm', Crypt::encrypt($data->donations->id)) }}"
                                            class="btn btn-primary fw-semibold">Donasi</a>
                                    </td>
                                    @else
                                    <td></td>
                                    @endif
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7">Tidak ada data yang tersedia.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        @include('pages.admin.payments.modals')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    function showImageModal(src) {
        const modalImg = document.getElementById('modalImage');
        modalImg.src = src;
    }
</script>
@endpush