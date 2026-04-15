@extends('layouts.main')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Front Office /</span> Detail Pendaftaran
    </h4>

    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Informasi Kunjungan</h5>
                    <a href="{{ route('admissions.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label fw-bold">No. Rekam Medis</label>
                        <div class="col-sm-9">
                            <p class="form-control-plaintext">: 000001</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label fw-bold">Nama Pasien</label>
                        <div class="col-sm-9">
                            <p class="form-control-plaintext">: John Doe</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label fw-bold">Klinik / Unit</label>
                        <div class="col-sm-9">
                            <p class="form-control-plaintext">: Poli Umum</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label fw-bold">Dokter</label>
                        <div class="col-sm-9">
                            <p class="form-control-plaintext">: dr. Smith</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label fw-bold">Jenis Pembayaran</label>
                        <div class="col-sm-9">
                            <p class="form-control-plaintext">: Umum (Mandiri)</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label fw-bold">Tanggal Daftar</label>
                        <div class="col-sm-9">
                            <p class="form-control-plaintext">: 15-04-2024 09:00</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label fw-bold">Status</label>
                        <div class="col-sm-9">
                            <p class="form-control-plaintext">: <span class="badge bg-label-primary">Terdaftar</span></p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label fw-bold">Keluhan</label>
                        <div class="col-sm-9">
                            <p class="form-control-plaintext">: Sakit perut sudah 2 hari</p>
                        </div>
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('admissions.edit', 1) }}" class="btn btn-warning">Edit Pendaftaran</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
