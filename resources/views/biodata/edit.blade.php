@extends('layouts.app')

@section('content')
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-3">
            <h5 class="m-0 fw-bold">Ubah Data Biodata</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('biodata.update', $biodata->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">NIM</label>
                        <input type="text" name="nim" class="form-control" value="{{ $biodata->nim }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control" value="{{ $biodata->nama }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Jurusan / Kelas</label>
                        <input type="text" name="jurusan_kelas" class="form-control"
                            value="{{ $biodata->jurusan_kelas }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ $biodata->email }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Telepon</label>
                        <input type="text" name="telepon" class="form-control" value="{{ $biodata->telepon }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Ganti Foto Profil</label>
                        <input type="file" name="foto" class="form-control" accept="image/*">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Alamat</label>
                        <textarea name="alamat" class="form-control" rows="2" required>{{ $biodata->alamat }}</textarea>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Tentang Saya</label>
                        <textarea name="tentang_saya" class="form-control" rows="3">{{ $biodata->tentang_saya }}</textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-warning text-white">Update Data</button>
                <a href="{{ route('biodata.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@endsection
