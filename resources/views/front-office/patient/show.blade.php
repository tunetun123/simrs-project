@extends('layouts.main')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Front Office /</span> Detail Pasien
    </h4>

    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Informasi Pasien</h5>
                    <a href="{{ route('patients.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label fw-bold">No. Rekam Medis</label>
                        <div class="col-sm-10">
                            <p class="form-control-plaintext">: 000001</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label fw-bold">Nama Lengkap</label>
                        <div class="col-sm-10">
                            <p class="form-control-plaintext">: John Doe</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label fw-bold">NIK</label>
                        <div class="col-sm-10">
                            <p class="form-control-plaintext">: 1234567890123456</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label fw-bold">Jenis Kelamin</label>
                        <div class="col-sm-10">
                            <p class="form-control-plaintext">: Laki-laki</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label fw-bold">Tanggal Lahir</label>
                        <div class="col-sm-10">
                            <p class="form-control-plaintext">: 01-01-1990</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label fw-bold">No. Telepon</label>
                        <div class="col-sm-10">
                            <p class="form-control-plaintext">: 08123456789</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label fw-bold">Alamat</label>
                        <div class="col-sm-10">
                            <p class="form-control-plaintext">: Jalan Mawar No. 123</p>
                        </div>
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('patients.edit', 1) }}" class="btn btn-warning">Edit Data</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
