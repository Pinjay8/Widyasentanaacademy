<footer class="bg-footer-primary text-white pt-5 pb-3">
    <div class="container">
        <div class="row">
            <!-- Tentang -->
            <div class="col-lg-4 col-md-6 mb-4">
                <h5 class="fw-bold">Widya Sentana Academy</h5>
                <p class="small">
                    {{ __('messages.sub_heading_footer') }}
                </p>
            </div>

            <!-- Navigasi -->
            {{-- <div class="col-lg-3 col-md-6 mb-4">
                <h6 class="fw-semibold">Navigasi</h6>
                <ul class="list-unstyled small">
                    <li><a href="{{ route('home') }}" class="text-white text-decoration-none">{{ __('messages.home')
                            }}</a></li>
                    <li><a href="{{ route('donasi') }}" class="text-white text-decoration-none">{{ __('messages.donate')
                            }}</a></li>
                </ul>
            </div> --}}

            <!-- Bantuan -->


            <!-- Sosial Media -->
            <div class="col-lg-4 col-md-6 mb-4">
                <h6 class="fw-semibold">{{ __('messages.follow_us') }}</h6>
                <small></small>
                <small>JL. Br. Batu Culung, Kerobokan Kaja, Kec. Kuta Utara, Kabupaten Badung, Bali 80361, Indonesia
                </small>
                <br>
                <div class="mt-2">
                    <div class="d-flex align-items-center gap-2">
                        <a href="mailto:widyasentana.bali@gmail.com?subject=Informasi&body=Halo%20saya%20ingin%20bertanya"
                            class="text-white text-decoration-none">
                            <i class="bi bi-envelope-fill"></i>
                            <small>widyasentana.bali@gmail.com</small>
                        </a>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <a href="https://wa.me/62818101916" class=" text-decoration-none text-white">
                            <i class="bi bi-whatsapp"></i>
                            <small>+62 818 101 916</small>
                        </a>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <a href="https://www.instagram.com/widyasentana/?hl=en" class="text-white text-decoration-none">
                            <i class="bi bi-instagram"></i>
                            <small>@widyasentana</small>
                        </a>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <a href="https://www.youtube.com/channel/UCdA2vNoK90IcoUP8wMPsJ6w"
                            class="text-white text-decoration-none">
                            <i class=" bi bi-youtube"></i>
                            <small>Widya Sentana</small></a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4 overflow-auto">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3076.5523133916913!2d115.172221!3d-8.638051!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd23993602c01e7%3A0x3b07d236310f8f1d!2sWidya%20Sentana!5e1!3m2!1sen!2sus!4v1747714644097!5m2!1sen!2sus"
                    width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>

        <hr class="border-light">

        <div class="text-center small">
            &copy; {{ date('Y') }} Widya Sentana Academy. All rights reserved.
        </div>
    </div>
</footer>