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
                <li class="breadcrumb-item active" aria-current="page">Banner</li>
            </ol>
        </nav>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Banner</h4>
                        <a href="{{ route('banners.create') }}" class="btn btn-primary btn-round ms-auto"
                            style="font-size: 14px">
                            {{-- <i class="fa fa-plus me-2"></i> --}}
                            Tambah
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="add-row" class="table table-striped overflow-x-hidden " style="width: 100%">
                            <thead>
                                <tr>
                                    <th class="fw-medium" style="width: 5%">Id</th>
                                    <th class="fw-medium">Gambar</th>
                                    <th class="fw-medium" style="width: 10%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($banners->isEmpty())
                                @else
                                @forelse($banners as $data)
                                <tr>
                                    <td>{{ $data->id }}</td>
                                    <td><img src="{{ $data->imagePath() }}" alt="" width="150px" height="100px" /></td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2 h-100">
                                            <a href="{{ route('banners.edit', $data->id) }}"
                                                class="btn btn-warning btn-sm text-white px-3 py-2">Edit</a>
                                            <form action="{{ route('banners.destroy', $data->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn btn-sm btn-danger mt-2 mt-lg-0 px-3 py-2">Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection