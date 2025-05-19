@extends('layouts.app')

@section('title', 'Pembayaran')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center ">
        <div class="col-md-6 shadow-md rounded-4 p-4 bg-white">
            <div class="d-flex gap-3 mb-4">
                <img src="{{ $donation->campaigns->thumbnail() }}" alt="" width="165" height="120" class="rounded">
                <div class="d-flex flex-column">
                    <h4 class="text-start">{{ $donation->campaigns->title }}</h4>
                    <h5 class="d-block">Widya Sentana <i class="bi bi-patch-check-fill ms-1"
                            style="color: #2598F2;"></i>
                    </h5>
                </div>
            </div>
            <h5>{{ __('messages.completed_payment') }}</h5>
            <hr>
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="fw-medium">{{ __('messages.payment_deadline') }}</h6>
                <h6>{{ \Carbon\Carbon::parse($donation->payment->expires_at)->translatedFormat('l, d F Y - H:i') }} WIB
                </h6>
            </div>
            <div class="d-flex flex-column align-items-center justify-content-cneter">
                <h5 class="text-center mb-0 mt-4">Rp. {{ number_format($donation->amount, 0, ',', '.') }}</h5>
                @if($donation->payment_method == "Qris")
                <img src="{{ asset('assets/img/qris_bankbpd.jpg') }}" alt="QRIS" class="img-fluid mt-2" width="300">
                @elseif($donation->payment_method == "BPD BALI")
                {{-- <img src="{{ asset('assets/img/qris.png') }}" alt="BCA" class="img-fluid mt-0" width="300"> --}}
                @elseif($donation->payment_method == "BRI")
                {{-- <img src="{{ asset('assets/img/qris.png') }}" alt="BRI" class="img-fluid mt-0" width="300"> --}}
                {{-- @elseif($donation->payment_method == "BNI")
                <img src="{{ asset('assets/img/qris.png') }}" alt="BNI" class="img-fluid mt-0" width="300"> --}}
                @endif
                <hr>
            </div>

            <div class="mt-1">
                @if($donation->payment_method == "BRI")
                <h5 class="fw-medium mb-0 mt-2">{{ __('messages.account_number') }}</h5>
                <div class="d-flex align-items-center justify-content-between mb-3 p-3 rounded shadow-sm"
                    style="background-color: #f8f9fa;">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-credit-card fs-4 txt-primary"></i>
                        <h5 id="vaNumber" class="mb-0 fw-semibold text-dark">4717-01-01295853-3</h5>
                    </div>
                    <button class="btn bg-button btn-sm d-flex align-items-center gap-1 px-3 py-2 text-white"
                        onclick="copyToClipboard()">
                        <i class="bi bi-clipboard"></i>
                        <span>{{ __('messages.copy') }}</span>
                    </button>
                </div>
                @elseif($donation->payment_method == "BPD BALI")
                <h5 class="fw-medium mb-0 mt-0">{{ __('messages.account_number') }}</h5>
                <div class="d-flex align-items-center justify-content-between mb-3 p-3 rounded shadow-sm"
                    style="background-color: #f8f9fa;">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-credit-card fs-4 txt-primary"></i>
                        <h5 id="vaNumber" class="mb-0 fw-semibold text-dark">0360202040001</h5>
                    </div>
                    <button class="btn bg-button btn-sm d-flex align-items-center gap-1 px-3 py-2 text-white"
                        onclick="copyToClipboard()">
                        <i class="bi bi-clipboard"></i>
                        <span>{{ __('messages.copy') }}</span>
                    </button>
                </div>
                @else
                @endif

                <h4 class="mb-2">{{ __('messages.how_to_payment') }}</h4>
                @if($donation->payment_method == "Qris")
                <ol>
                    {{-- <li>Buka <strong>Aplikasi Gopay/OVO/Shopeepay/LinkAja/DANA</strong> atau lainnya</li>
                    <li>Pilih <strong>Scan</strong> pada menu aplikasi anda</li>
                    <li>Lakukan <strong>Scan</strong> pada Barcode diatas</li>
                    <li>Masukkan <strong>Nominal</strong> sesuai dengan yang tertera diatas
                    </li>
                    </li>
                    <li>Pilih <strong>Bayar</strong> dan masukkan <strong>pin</strong> Anda</li>
                    <li>Tunggu hingga proses <strong>pembayaran berhasil</strong></li>
                    <li>Transaksi Anda akan <strong>otomatis terkonfirmasi</strong> di sistem</li> --}}
                    <li>{{ __('messages.qris_step_1') }}</li>
                    <li>{{ __('messages.qris_step_2') }}</li>
                    <li>{{ __('messages.qris_step_3') }}</li>
                    <li>{{ __('messages.qris_step_4') }}</li>
                    <li>{{ __('messages.qris_step_5') }}</li>
                    <li>{{ __('messages.qris_step_6') }}</li>
                    <li>{{ __('messages.qris_step_7') }}</li>
                </ol>
                @elseif($donation->payment_method == "BPD BALI")
                <ul class="nav nav-tabs" id="paymentTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="atm-tab" data-bs-toggle="tab" data-bs-target="#atm"
                            type="button" role="tab">ATM</button>
                    </li>
                </ul>

                <div class="tab-content mt-3" id="paymentTabContent">
                    <div class="tab-pane fade show active" id="atm" role="tabpanel">
                        <ol>
                            {{-- <li>Masukkan kartu ATM <strong>BPD Bali</strong> & <strong>PIN</strong>.</li>
                            <li>Pilih <strong>transaksi lainnya</strong>.</li>
                            <li>Pilih menu <strong>transfer</strong>.</li>
                            <li>Pilih <strong>rekening Bank BPD Bali</strong>.</li>
                            <li>Masukkan <strong>nomor rekening</strong> tujuan.</li>
                            <li>Masukkan <strong>jumlah uang</strong> yang ingin dibayarkan.</li>
                            <li>Akan muncul layar <strong>konfirmasi</strong>, tekan YA jika
                                sudah benar.</li>
                            <li>Pembayaran <strong>selesai</strong>.</li> --}}
                            <li>{{ __('messages.bank_bpd_step_1') }}</li>
                            <li>{{ __('messages.bank_bpd_step_2') }}</li>
                            <li>{{ __('messages.bank_bpd_step_3') }}</li>
                            <li>{{ __('messages.bank_bpd_step_4') }}</li>
                            <li>{{ __('messages.bank_bpd_step_5') }}</li>
                            <li>{{ __('messages.bank_bpd_step_6') }}</li>
                            <li>{{ __('messages.bank_bpd_step_7') }}</li>
                            <li>{{ __('messages.bank_bpd_step_8') }}</li>
                        </ol>
                    </div>
                </div>
                @elseif($donation->payment_method == "BRI")
                <ul class="nav nav-tabs" id="paymentTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="atm-tab" data-bs-toggle="tab" data-bs-target="#atm"
                            type="button" role="tab">ATM</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="mbca-tab" data-bs-toggle="tab" data-bs-target="#mbca" type="button"
                            role="tab">m-Banking</button>
                    </li>
                </ul>

                <div class="tab-content mt-3" id="paymentTabContent">
                    <div class="tab-pane fade show active" id="atm" role="tabpanel">
                        <ol>
                            {{-- <li>Masukkan kartu <strong>ATM</strong> dan <strong>PIN</strong>.</li>
                            <li>Pilih <strong>"Transaksi Lain"</strong> dan pilih <strong>"Pembayaran"</strong></li>
                            <li>Pilih <strong>transfer</strong></li>
                            <li>Pilih Ke <strong>Rekening BRI</strong></li>
                            <li>Masukkan <strong>nomor rekening</strong> tujuan.</li>
                            <li>Masukkan nominal <strong>uang</strong> yang ingin ditransfer.</li>
                            <li>Konfirmasi, pilih <strong>Ya</strong>.</li> --}}
                            <li>{{ __('messages.bank_bri_step_1') }}</li>
                            <li>{{ __('messages.bank_bri_step_2') }}</li>
                            <li>{{ __('messages.bank_bri_step_3') }}</li>
                            <li>{{ __('messages.bank_bri_step_4') }}</li>
                            <li>{{ __('messages.bank_bri_step_5') }}</li>
                            <li>{{ __('messages.bank_bri_step_6') }}</li>
                            <li>{{ __('messages.bank_bri_step_7') }}</li>
                        </ol>
                    </div>
                    <div class="tab-pane fade show" id="mbca" role="tabpanel">
                        <ol>
                            <li>{{ __('messages.bank_bri_mbanking_step_1') }}</li>
                            <li>{{ __('messages.bank_bri_mbanking_step_2') }}</li>
                            <li>{{ __('messages.bank_bri_mbanking_step_3') }}</li>
                            <li>{{ __('messages.bank_bri_mbanking_step_4') }}</li>
                            <li>{{ __('messages.bank_bri_mbanking_step_5') }}</li>
                            <li>{{ __('messages.bank_bri_mbanking_step_6') }}</li>
                            {{-- <li>Login dengan <strong>username</strong> dan <strong>password</strong> atau
                                <strong>sidik
                                    jari</strong>.
                            </li>
                            <li>Pilih <strong>Transfer</strong> ke Sesama BRI.</li>
                            <li>Masukkan <strong>>nomor rekening</strong> tujuan</li>
                            <li>Masukkan <strong>jumlah transfer</strong>.</li>
                            <li>Konfirmasi data, lalu pilih <strong>Transfer</strong>.</li>
                            <li>Masukkan <strong>PIN BRImo</strong>, selesai.</li> --}}
                        </ol>
                    </div>
                </div>
                @else
                @endif
            </div>
            <form action="{{ route('payments.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="donation_id" value="{{ $donation->id }}">
                <div class="mb-3">
                    <label for="history_payment" class="form-label fw-medium fs-5 mt-2">{{
                        __('messages.upload_history_payment') }}</label>
                    <input type="file" name="history_payment" id="history_payment"
                        class="form-control @error('history_payment') is-invalid @enderror">
                    @error('history_payment')
                    <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn bg-button w-100 text-white">{{ __('messages.completed_payment')
                    }}</button>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    function copyToClipboard() {
        const text = document.getElementById("vaNumber").innerText;
        navigator.clipboard.writeText(text).then(function () {
            // alert("Nomor berhasil disalin!");
        }, function () {
            // alert("Gagal menyalin.");
        });
    }
</script>

@endpush