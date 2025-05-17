<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>
    <link rel="icon" href="{{ asset('assets/img/Logo_Widyasentana.png') }}" type="image/x-icon">

    @vite(['resources/css/app.css','resources/js/app.js'])
    <!-- Bootstrap Icons -->
    {{--
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.css" /> --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.bootstrap5.css">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
</head>

<body>
    <div class="d-flex" id="wrapper">
        {{-- Sidebar --}}
        @include('partials.sidebar')

        {{-- Page Content --}}
        <div id="page-content-wrapper" class="w-100">
            <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                <div class="container-fluid">
                    <button class="btn btn-dark border-0" id="menu-toggle">
                        <i class="bi bi-list fs-5"></i>
                    </button>
                    <span class="navbar-brand ms-3">
                    </span>
                </div>
            </nav>

            <div class="container-fluid py-4">
                @yield('content-dashboard')
            </div>
        </div>
        @if (session('success'))
        <div id="session-alert" data-success="{{ session('success') }}"></div>
        @endif
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.bootstrap5.js"></script>
    {{-- <script src="{{ asset('js/datatables/datatables.min.js') }}"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.js"></script>
    <script>
        const toggleButton = document.getElementById('menu-toggle');
        const wrapper = document.getElementById('wrapper');
        if (toggleButton && wrapper) {
            toggleButton.addEventListener('click', () => {
                wrapper.classList.toggle('toggled');
            });
        }

        $(document).ready(function () {
            if ($("#add-row").length) {
                $("#add-row").DataTable({
                    order: [[0, "desc"]],
                    language: {
                        emptyTable: "Tidak ada data",
                    },
                });
            }
        });

        const sessionAlert = document.getElementById("session-alert");
        if (sessionAlert) {
            const message = sessionAlert.dataset.success;
            Swal.fire({
                title: "Berhasil!",
                text: message,
                icon: "success",
                confirmButtonText: "OK",
            });
        }
    </script>
    @stack('scripts')
</body>

</html>
