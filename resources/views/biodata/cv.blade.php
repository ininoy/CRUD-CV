@extends('layouts.app')

@section('content')
    <div class="mb-3">
        <a href="{{ route('biodata.index') }}" class="btn btn-outline-primary rounded-pill btn-sm">
            <i class="bi bi-arrow-left"></i> Kembali ke Data Biodata
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card border-0 shadow-sm overflow-hidden" style="border-radius: 15px;">
        <div class="bg-primary text-white p-4">
            <div class="d-flex align-items-center gap-3">
                @if ($biodata->foto)
                    <img src="{{ asset('storage/' . $biodata->foto) }}" class="rounded-circle border border-3 border-white"
                        width="90" height="90" style="object-fit:cover;">
                @else
                    <div class="bg-white text-primary fw-bold rounded-circle d-flex align-items-center justify-content-center"
                        style="width: 90px; height: 90px; font-size: 2rem;">
                        {{ strtoupper(substr($biodata->nama, 0, 2)) }}
                    </div>
                @endif
                <div>
                    <h2 class="fw-bold m-0">{{ $biodata->nama }}</h2>
                    <p class="m-0 text-white-50">Mahasiswa {{ $biodata->jurusan_kelas }} • NIM: {{ $biodata->nim }}</p>
                    <div class="mt-2 text-white-50 small">
                        <span class="me-3"><i class="bi bi-geo-alt"></i> {{ $biodata->alamat }}</span>
                        <span class="me-3"><i class="bi bi-envelope"></i> {{ $biodata->email }}</span>
                        <span><i class="bi bi-telephone"></i> {{ $biodata->telepon }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body p-4">
            <h5 class="fw-bold text-primary mb-3"><i class="bi bi-person"></i> Tentang Saya</h5>
            <p class="text-secondary">{{ $biodata->tentang_saya ?? 'Belum ada deskripsi.' }}</p>

            <hr class="my-4">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="fw-bold text-primary m-0"><i class="bi bi-mortarboard"></i> Riwayat Pendidikan</h5>
                <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalPendidikan">
                    + Tambah Pendidikan
                </button>
            </div>

            <ul class="list-group list-group-flush mb-4">
                @forelse($biodata->pendidikans as $edu)
                    <li class="list-group-item px-0 d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="fw-bold m-0">{{ $edu->nama_instansi }}</h6>
                            <small class="text-muted">{{ $edu->keterangan }}</small>
                            <span class="badge bg-primary d-block mt-1"
                                style="width: fit-content;">{{ $edu->tahun }}</span>
                        </div>
                        <form action="{{ route('pendidikan.destroy', $edu->id) }}" method="POST"
                            onsubmit="return confirm('Hapus riwayat pendidikan ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger border-0"><i
                                    class="bi bi-trash"></i></button>
                        </form>
                    </li>
                @empty
                    <li class="list-group-item px-0 text-muted small">Belum ada riwayat pendidikan yang ditambahkan.</li>
                @endforelse
            </ul>
        </div>
    </div>

    <div class="modal fade" id="modalPendidikan" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Tambah Riwayat Pendidikan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('pendidikan.store', $biodata->id) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Nama Instansi / Sekolah</label>
                            <input type="text" name="nama_instansi" class="form-control"
                                placeholder="Contoh: Politeknik Caltex Riau" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Keterangan / Jurusan</label>
                            <input type="text" name="keterangan" class="form-control"
                                placeholder="Contoh: D3 Teknik Informatika" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tahun</label>
                            <input type="text" name="tahun" class="form-control" placeholder="Contoh: 2024 - Sekarang"
                                required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
