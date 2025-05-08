@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('content-dashboard')
<div class="container-fluid">
    <div class="mt-5">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
            aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-black"><i
                            class="bi bi-house-fill text-black"></i><span class="ms-1">Dashboard</span></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Campaign</li>
            </ol>
        </nav>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Campaign</h4>
                        <a href="{{ route('campaigns.create') }}" class="btn btn-primary btn-round ms-auto"
                            style="font-size: 14px">
                            {{-- <i class="fa fa-plus me-2"></i> --}}
                            Tambah
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="add-row" class="table table-striped  overflow-x-hidden " style="width: 100%">
                            <thead>
                                <tr>
                                    <th class="fw-medium">Id</th>
                                    <th class="fw-medium">Judul</th>
                                    <th class="fw-medium">Deskripsi</th>
                                    <th class="fw-medium">Target Donasi</th>
                                    <th class="fw-medium">Terkumpul</th>
                                    <th class="fw-medium">Tanggal Mulai</th>
                                    <th class="fw-medium">Tanggal Selesai</th>
                                    <th class="fw-medium">Gambar</th>
                                    <th class="fw-medium">Status</th>
                                    <th class="fw-medium">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($campaigns as $data)
                                <tr>
                                    <td>{{ $data->id }}</td>
                                    <td>{{ $data->title }}</td>
                                    <td>{{ $data->description }}</td>
                                    <td>Rp. {{ number_format($data->target_amount, 0, ',', '.') }}</td>
                                    <td>Rp. {{ number_format($data->collected_amount, 0, ',', '.') }}</td>
                                    <td>{{ $data->start_date }}</td>
                                    <td>{{ $data->end_date }}</td>
                                    <td><img src="{{ $data->thumbnail() }}" alt="" width="90px" height="60px" /></td>
                                    <td>
                                        @if($data->status == "aktif")
                                        <span class="badge bg-success px-3 py-3 fw-medium">Aktif</span>
                                        @elseif($data->status == "ditutup")
                                        <span class="badge bg-danger px-3 py-3">Ditutup</span>
                                        @elseif($data->status == "selesai")
                                        <span class="badge bg-black px-3 py-3">Selesai</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('campaigns.edit', $data->id) }}"
                                            class="btn btn-warning btn-sm text-white px-3 py-2">Edit</a>
                                        <form action="{{ route('campaigns.destroy', $data->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="btn btn-sm btn-danger mt-2 mt-lg-0 px-3 py-2">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <td colspan="12">Tidak ada data yang tersedia.</td>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection