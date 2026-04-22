@extends('layouts.main')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Front Office /</span> Edit Pendaftaran
    </h4>

    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Form Edit Pendaftaran</h5>
                    <small class="text-muted float-end">Ubah Data Kunjungan</small>
                </div>
                <div class="card-body">
                    <form action="{{ route('admissions.update', 1) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Nama Pasien</label>
                                <input type="text" class="form-control" readonly value="John Doe" />
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">No. Rekam Medis</label>
                                <input type="text" class="form-control" readonly value="000001" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label" for="unit">Klinik / Unit Tujuan <span class="text-danger">*</span></label>
                                <select class="form-select" id="unit" name="unit" required>
                                    <option value="poli_umum" selected>Poli Umum</option>
                                    <option value="poli_gigi">Poli Gigi</option>
                                    <option value="igd">IGD</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="doctor">Dokter <span class="text-danger">*</span></label>
                                <select class="form-select" id="doctor" name="doctor" required>
                                    <option value="dr_smith" selected>dr. Smith</option>
                                    <option value="dr_doe">dr. Doe</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="payment_type">Jenis Penjamin / Pembayaran <span class="text-danger">*</span></label>
                            <select class="form-select" id="payment_type" name="payment_type" required>
                                <option value="umum" selected>Umum (Mandiri)</option>
                                <option value="bpjs">BPJS Kesehatan</option>
                                <option value="asuransi_lain">Asuransi Lainnya</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="status">Status <span class="text-danger">*</span></label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="terdaftar" selected>Terdaftar</option>
                                <option value="menunggu">Menunggu</option>
                                <option value="dilayani">Sedang Dilayani</option>
                                <option value="selesai">Selesai</option>
                                <option value="batal">Batal</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="notes">Keterangan / Keluhan Utama</label>
                            <textarea id="notes" class="form-control" name="notes">Sakit perut sudah 2 hari</textarea>
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary me-2">Update</button>
                            <a href="{{ route('admissions.index') }}" class="btn btn-outline-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
