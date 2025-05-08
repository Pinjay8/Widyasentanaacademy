<footer class="bg-footer-primary text-white pt-5 pb-3">
    <div class="container">
        <div class="row">
            <!-- Tentang -->
            <div class="col-md-4 mb-4">
                <h5 class="fw-bold">Widya Sentana Academy</h5>
                <p class="small">
                    {{ __('messages.sub_heading_footer') }}
                </p>
            </div>

            <!-- Navigasi -->
            <div class="col-md-4 mb-4">
                <h6 class="fw-semibold">Navigasi</h6>
                <ul class="list-unstyled small">
                    <li><a href="{{ route('home') }}" class="text-white text-decoration-none">{{ __('messages.home')
                            }}</a></li>
                    <li><a href="{{ route('donasi') }}" class="text-white text-decoration-none">{{ __('messages.donate')
                            }}</a></li>
                    {{-- <li><a href="" class="text-white text-decoration-none">Tentang</a></li>
                    <li><a href="" class="text-white text-decoration-none">Kontak</a></li> --}}
                </ul>
            </div>

            <!-- Bantuan -->
            {{-- <div class="col-md-3 mb-4">
                <h6 class="fw-semibold">Bantuan</h6>
                <ul class="list-unstyled small">
                    <li><a href="#" class="text-white text-decoration-none">Cara Donasi</a></li>
                    <li><a href="#" class="text-white text-decoration-none">Kebijakan Privasi</a></li>
                    <li><a href="#" class="text-white text-decoration-none">Syarat & Ketentuan</a></li>
                </ul>
            </div> --}}

            <!-- Sosial Media -->
            <div class="col-md-4 mb-4">
                <h6 class="fw-semibold">{{ __('messages.follow_us') }}</h6>
                <a href="#" class="text-white me-3"><i class="bi bi-facebook"></i></a>
                <a href="#" class="text-white me-3"><i class="bi bi-instagram"></i></a>
                <a href="#" class="text-white me-3"><i class="bi bi-twitter-x"></i></a>
                <a href="#" class="text-white"><i class="bi bi-youtube"></i></a>
            </div>
        </div>

        <hr class="border-light">

        <div class="text-center small">
            &copy; {{ date('Y') }} Widya Sentana Academy. All rights reserved.
        </div>
    </div>
</footer>