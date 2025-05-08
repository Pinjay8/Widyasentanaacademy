<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('assets/img/Logo_Widyasentana.png') }}" type="image/x-icon">
    @vite([ 'resources/css/app.css','resources/js/app.js',])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <title>@yield('title')</title>
</head>

<body>
    <x-navbar />
    <main class="bg-main">
        @yield('content')
    </main>
    <x-footer />
    <a href="https://wa.me/6281234567890" target="_blank" class="whatsapp-icon">
        <i class="bi bi-whatsapp" style="font-size: 40px; color: white;"></i>
    </a>
    <a href="#" class="scroll-to-top-icon" id="scrollToTopBtn" style="display: none;">
        <i class="bi bi-arrow-up-short" style="font-size: 30px; color: white;"></i>
    </a>
    <script src=" https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    @stack('scripts')
    <script>
        @if (session('success'))
            Swal.fire({
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        @endif
    </script>
</body>

</html>