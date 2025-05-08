<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm py-3">
    <div class="container">
        <a href="{{ route('home') }}">
            <img class="navbar-brand fw-bold text-primary" src=" {{ asset('assets/img/Logo_Widyasentana.png') }}"
                alt="Logo Widya Sentana Academy" width="60">
            {{-- DonasiKita --}}
            </img>
        </a>
        <button class="navbar-toggler shadow-none border-0" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarMain">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarMain">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 pe-lg-3">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('/') ? 'active fw-semibold' : '' }} text-primary "
                        href="{{ route('home') }}">{{ __('messages.home') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('campaign-donasi') ? 'active fw-semibold' : '' }} text-primary"
                        href="{{ route('donasi') }}">{{ __('messages.donate') }}</a>
                </li>
                @auth
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dashboard')}}">Dashboard</a>
                </li>
                @endauth
            </ul>

            <!-- Dropdown untuk Pilihan Bahasa -->
            <ul class="navbar-nav mb-lg-0 mb-2">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle mt-2" href="#" role="button" data-bs-toggle="dropdown">
                        <img src="{{ asset('images/flags/' . app()->getLocale() . '.png') }}"
                            alt="{{ app()->getLocale() }} flag" width="20" height="14">
                        {{ strtoupper(app()->getLocale()) }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                        <li>
                            <a class="dropdown-item d-flex align-items-center gap-2"
                                href="{{ LaravelLocalization::getLocalizedURL($localeCode, url()->current()) }}">
                                <img src="{{ asset('images/flags/' . $localeCode . '.png') }}"
                                    alt="{{ $localeCode }} flag" width="20" height="14">
                                {{ $properties['native'] }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </li>

                @php
                $user = Auth::guard('user')->user();
                $admin = Auth::guard('admin')->user();
                @endphp

                @if ($user || $admin)
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center gap-2" href="#" role="button"
                        data-bs-toggle="dropdown">
                        <i class="bi bi-person-circle fs-3"></i> <!-- Ikon profil -->
                        <span>{{ $admin?->name ?? $user?->name }}</span> <!-- Nama -->
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        @if(Auth::guard('admin')->check())
                        <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        @endif
                        @if(Auth::guard('user')->check())
                        <li><a class="dropdown-item" href="{{ route('dashboard') }}">Dashboard</a></li>
                        @endif
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="dropdown-item" type="submit">{{ __('messages.logout') }}</button>
                            </form>
                        </li>
                    </ul>
                </li>
                @else
                <div class="d-flex gap-1">
                    <li class="nav-item">
                        <a class="btn btn-outline-primary me-1" href="{{ route('indexLogin') }}">{{ __('messages.login')
                            }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-primary" href="{{ route('indexRegister') }}">{{ __('messages.register') }}</a>
                    </li>
                </div>
                @endif
            </ul>
        </div>
    </div>
</nav>