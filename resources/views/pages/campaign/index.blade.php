@extends('layouts.app')

@section('title', 'Campaign Donasi')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center ">
        <div class="col-md-6 shadow-md rounded-4 p-4 bg-white">
            <div class="d-flex gap-3 mb-4">
                <img src="{{ asset('assets/img/img_donasi.jpg') }}" alt="" width="100" height="100">
                <div class="d-flex flex-column">
                    <h4 class=" text-center">Donasi untuk Campaign</h4>
                    <h5 class="d-block">Widya Sentana <i class="bi bi-patch-check-fill ms-1"
                            style="color: #2598F2;"></i>
                    </h5>
                </div>
            </div>

            <form action="{{ route('campaign.store') }}" method="POST">
                @csrf
                <input type="hidden" name="campaign_id" value="{{ $campaigns->id }}">
                <div class="input-group">
                    <span class="input-group-text">Rp</span>
                    <input type="number" class="form-control @error('amount') is-invalid @enderror" name="amount"
                        id="amount" placeholder="Contoh: 10000">
                </div>
                @error('amount')
                <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
                <hr>
                {{-- Pilihan nominal cepat --}}
                <div class="mb-3">
                    <h5>Nominal</h5>
                    <label class="form-label">Pilih nominal yang tersedia</label>
                    <div class="d-flex flex-wrap gap-2">
                        @foreach ([10000, 25000, 50000, 100000] as $value)
                        <button type="button" class="btn btn-outline-primary rounded-pill quick-amount"
                            data-value="{{ $value }}">
                            Rp. {{ number_format($value, 0, ',', '.') }}
                        </button>
                        @endforeach
                    </div>
                </div>
                <h6 class="mt-4 mb-2">Doa dan Dukungan untuk campaign</h6>
                <div class="form-floating">
                    <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea" rows="10"
                        style="height: 120px" name="messages"></textarea>
                    <label for="floatingTextarea">Tulis doa atau dukungan (opsional)</label>
                </div>
                <hr>
                <div class="mb-3">
                    <h5 class="form-label">Pilih Metode Pembayaran</h5>
                    <div class="d-flex gap-3">
                        <label class="form-check-label" for="bank_bca">
                            <input class="form-check-input me-2  @error('payment_method') is-invalid @enderror"
                                type="radio" name="payment_method" id="payment_method" value="BCA">
                            <img src="{{ asset('assets/img/bca.png') }}" alt="BCA" width="60">
                        </label>
                        <label class="form-check-label" for="bank_bri">
                            <input class="form-check-input me-2 @error('payment_method') is-invalid @enderror"
                                type="radio" name="payment_method" id="payment_method" value="BRI">
                            <img src="{{ asset('assets/img/bri.png') }}" alt="BRI" width="60">
                        </label>
                        <label class="form-check-label" for="bank_bni">
                            <input class="form-check-input me-2 @error('payment_method') is-invalid @enderror"
                                type="radio" name="payment_method" id="payment_method" value="BNI">
                            <img src="{{ asset('assets/img/bni.png') }}" alt="BNI" width="60">
                        </label>
                        <label class="form-check-label" for="qris">
                            <input class="form-check-input me-2 @error('payment_method') is-invalid @enderror"
                                type="radio" name="payment_method" id="payment_method" value="Qris">
                            <img src="{{ asset('assets/img/logo_qris.png') }}" alt="Qris" width="60">
                        </label>
                    </div>
                    @error('payment_method')
                    <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Tombol lanjutkan --}}
                <div class="d-grid mt-5">
                    <button type="submit" class="btn btn-primary">Lanjutkan</button>
                </div>

            </form>

        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Saat tombol nominal cepat diklik, isikan ke input nominal
    document.querySelectorAll('.quick-amount').forEach(button => {
        button.addEventListener('click', function () {
            document.getElementById('amount').value = this.getAttribute('data-value');
        });
    });
</script>
@endpush