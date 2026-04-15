@extends('layouts.main')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Front Office /</span> Pendaftaran Pasien Baru
    </h4>

    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Form Data Pasien</h5>
                    <small class="text-muted float-end">Informasi Identitas</small>
                </div>
                <div class="card-body">
                    <form action="{{ route('patients.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="full_name">Nama Lengkap</label>
                            <input type="text" class="form-control" id="full_name" name="full_name" placeholder="Masukkan Nama Lengkap" required />
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="nik">NIK</label>
                            <input type="text" class="form-control" id="nik" name="nik" placeholder="Masukkan NIK" required />
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label" for="gender">Jenis Kelamin</label>
                                <select class="form-select" id="gender" name="gender" required>
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="L">Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="dob">Tanggal Lahir</label>
                                <input type="date" class="form-control" id="dob" name="dob" required />
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="phone">No. Telepon</label>
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="Masukkan No. Telepon" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="address">Alamat</label>
                            <textarea id="address" class="form-control" name="address" placeholder="Masukkan Alamat Lengkap"></textarea>
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary me-2">Simpan</button>
                            <a href="{{ route('patients.index') }}" class="btn btn-outline-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
