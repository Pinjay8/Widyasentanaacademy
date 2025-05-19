@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('content-dashboard')
<div class="container-fluid">
    <div class="row">
        <!-- Card Total Donasi -->
        <div class="col-md-4 mb-4">
            <div class="card bg-primary text-white border-0" style="height: 100%;">
                <div class="card-body">
                    <h5 class="card-title">{{ __('messages.total_donate') }}</h5>
                    <h5 class="card-text">{{ $countDonasi }} Donasi</h5>
                    {{-- <p class="card-text">Rp. {{ number_format($totalDonasi, 0, ',', '.') }}</p> --}}
                </div>
            </div>
        </div>

        <!-- Card Total Pembayaran -->
        <div class="col-md-4 mb-4">
            <div class="card bg-success text-white border-0">
                <div class="card-body">
                    <h5 class="card-title">Total Pembayaran</h5>
                    <h5>{{ $countPembayaran }} Pembayaran</h5>
                    <h5 class="card-text">Rp. {{ number_format($totalPembayaran, 0, ',', '.') }}</h5>
                </div>
            </div>
        </div>

        <!-- Card Total Campaign -->
        <div class="col-md-4 mb-4">
            <div class="card bg-info text-white border-0" style="height: 100%;">
                <div class="card-body">
                    <h5 class="card-title">Total Campaign</h5>
                    <h5 class="card-text">{{ $totalCampaign }} Campaign</h5>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Campaigns Table -->
    <div class="card overflow-auto">
        <div class="card-header">
            <h5 class="card-title mb-0">Campaign Terbaru</h5>
        </div>
        <div class="card-body">
            <table class="table table-striped w-100 overflow-hidden">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Campaign</th>
                        <th>Deskripsi</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Selesai</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($campaigns as $campaign)
                    <tr>
                        <td>{{ $campaign->id }}</td>
                        <td>{{ $campaign->title }}</td>
                        <td>{!! Str::limit($campaign->description, 50) !!}</td>
                        <td>{{ \Carbon\Carbon::parse($campaign->start_date)->format('d-m-Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($campaign->end_date)->format('d-m-Y') }}</td>
                        <td>
                            @if($campaign->status == 'aktif')
                            <span class="badge bg-success">Aktif</span>
                            @else
                            <span class="badge bg-danger">Tidak Aktif</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-3 d-flex justify-content-end">
                <a href="{{ route('campaigns.indexDashboard') }}" class="btn btn-sm btn-primary fw-medium">Lihat Semua
                    Campaign</a>
            </div>
        </div>
    </div>

    <!-- Chart Donasi Per Bulan -->
    <div class="card mt-4 overflow-hidden">
        <div class="card-header">
            <h5 class="card-title mb-0">Donasi Per Bulan</h5>
        </div>
        <div class="card-body">
            <canvas id="donasiChart" style="width: 500px; height: 100px;"></canvas>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@push('scripts')
<script>
    var ctx = document.getElementById('donasiChart').getContext('2d');
    var donasiChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($months),
            datasets: [{
                label: 'Total Donasi',
                data: @json($totalAmount),
                borderColor: 'rgba(75, 192, 192, 1)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                fill: true,
            }]
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Bulan'
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Jumlah Donasi (Rp)'
                    }
                }
            }
        }});
</script>
@endpush
@endsection