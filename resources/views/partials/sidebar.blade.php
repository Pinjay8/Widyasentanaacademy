<div class="bg-dark text-white" id="sidebar-wrapper" style="min-height: 100vh; width: 300px;">
    <div class="sidebar-heading p-3 fw-bold border-bottom ">Widya Sentana Academy</div>
    <div class="list-group list-group-flush p-2">
        <a href="{{ route('home') }}" class="list-group-item list-group-item-action bg-dark text-white p-3">
            <i class="bi bi-house-door me-2"></i> {{ __('messages.home') }}
        </a>
        @if(Auth::guard('admin')->check())
        <a href="{{ route('admin.dashboard') }}" class="list-group-item list-group-item-action bg-dark text-white p-3">
            <i class="bi bi-house-door me-2"></i> Dashboard
        </a>
        <a href="{{ route('banners.index') }}" class="list-group-item list-group-item-action bg-dark text-white p-3">
            <i class="bi bi bi-signpost-fill me-2"></i> Banners
        </a>
        <a href="{{ route('campaigns.indexDashboard') }}"
            class="list-group-item list-group-item-action bg-dark text-white p-3">
            <i class="bi bi-bullseye me-2"></i> Campaign
        </a>
        <a href="{{ route('donations.index') }}" class="list-group-item list-group-item-action bg-dark text-white p-3">
            <i class="bi bi-cash me-2"></i>{{ __('messages.donate') }}
        </a>
        <a href="{{ route('paymentsadmin.index') }}"
            class="list-group-item list-group-item-action bg-dark text-white p-3">
            <i class="bi bi-wallet me-2"></i>{{ __('messages.payment') }}
        </a>
        @endif
        @if(Auth::guard('user')->check())
        <a href="{{ route('dashboard') }}" class="list-group-item list-group-item-action bg-dark text-white p-3">
            <i class="bi bi-house-door me-2"></i> Dashboard
        </a>
        <a href="{{ route('donationuser.index') }}"
            class="list-group-item list-group-item-action bg-dark text-white p-3">
            <i class="bi bi-cash me-2"></i> {{ __('messages.donate') }}
        </a>
        <a href="{{ route('paymentuser.index') }}"
            class="list-group-item list-group-item-action bg-dark text-white p-3">
            <i class="bi bi-wallet me-2"></i>{{ __('messages.payment') }}
        </a>
        @endif
        <form method="POST" action="{{ route('logout') }}" class="mt-3">
            @csrf
            <button class="btn btn-outline-light w-100">
                <i class="bi bi-box-arrow-right me-2"></i> Logout
            </button>
        </form>
    </div>
</div>