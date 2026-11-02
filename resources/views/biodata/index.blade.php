@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold m-0">Data Biodata Mahasiswa</h3>
            <small class="text-muted">Program Studi Informatika • Politeknik Caltex Riau</small>
        </div>
        <a href="{{ route('biodata.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i> Tambah Data Baru
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row mb-3">
        <div class="col-md-4 mb-2">
            <div class="card border-0 shadow-sm p-3 d-flex flex-row align-items-center">
                <div class="bg-primary bg-opacity-10 p-3 rounded me-3 text-primary">
                    <i class="bi bi-people-fill fs-3"></i>
                </div>
                <div>
                    <small class="text-muted text-uppercase fw-bold">Total Mahasiswa</small>
                    <h4 class="m-0 fw-bold">{{ $biodatas->count() }} Orang</h4>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <form action="{{ route('biodata.index') }}" method="GET">
                <div class="input-group">
                    <input type="text" name="search" class="form-control"
                        placeholder="Cari nama, email, atau data mahasiswa..." value="{{ request('search') }}">
                    <button class="btn btn-outline-secondary" type="submit"><i class="bi bi-search"></i> Cari</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Foto</th>
                            <th>Nama Mahasiswa</th>
                            <th>Jurusan / Kelas</th>
                            <th>Email</th>
                            <th>Telepon</th>
                            <th>Alamat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($biodatas as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    @if ($item->foto)
                                        <img src="{{ asset('storage/' . $item->foto) }}" class="rounded-circle"
                                            width="40" height="40" style="object-fit:cover;">
                                    @else
                                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center fw-bold"
                                            style="width: 40px; height: 40px;">
                                            {{ strtoupper(substr($item->nama, 0, 2)) }}
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <strong class="d-block">{{ $item->nama }}</strong>
                                    <small class="text-muted">NIM: {{ $item->nim }}</small>
                                </td>
                                <td><span class="badge bg-light text-primary border">{{ $item->jurusan_kelas }}</span></td>
                                <td><a href="mailto:{{ $item->email }}">{{ $item->email }}</a></td>
                                <td>{{ $item->telepon }}</td>
                                <td>{{ $item->alamat }}</td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <a href="{{ route('biodata.cv', $item->id) }}"
                                            class="btn btn-sm btn-info text-white" title="Lihat CV">
                                            <i class="bi bi-file-person"></i>
                                        </a>
                                        <a href="{{ route('biodata.edit', $item->id) }}"
                                            class="btn btn-sm btn-warning text-white" title="Ubah">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <form action="{{ route('biodata.destroy', $item->id) }}" method="POST"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger" title="Hapus"><i
                                                    class="bi bi-trash"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-4 text-muted">Belum ada data biodata.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
