@extends('layouts.main')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Front Office /</span> Edit Data Pasien
    </h4>

    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Form Edit Pasien</h5>
                    <small class="text-muted float-end">Ubah Informasi Identitas</small>
                </div>
                <div class="card-body">
                    <form action="{{ route('patients.update', 1) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label" for="full_name">Nama Lengkap</label>
                            <input type="text" class="form-control" id="full_name" name="full_name" value="John Doe" required />
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="nik">NIK</label>
                            <input type="text" class="form-control" id="nik" name="nik" value="1234567890123456" required />
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label" for="gender">Jenis Kelamin</label>
                                <select class="form-select" id="gender" name="gender" required>
                                    <option value="L" selected>Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="dob">Tanggal Lahir</label>
                                <input type="date" class="form-control" id="dob" name="dob" value="1990-01-01" required />
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="phone">No. Telepon</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="08123456789" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="address">Alamat</label>
                            <textarea id="address" class="form-control" name="address">Jalan Mawar No. 123</textarea>
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary me-2">Update</button>
                            <a href="{{ route('patients.index') }}" class="btn btn-outline-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
