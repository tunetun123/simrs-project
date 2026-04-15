@extends('layouts.main')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Front Office /</span> Pendaftaran Kunjungan
    </h4>

    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Form Pendaftaran Baru</h5>
                    <small class="text-muted float-end">Data Kunjungan</small>
                </div>
                <div class="card-body">
                    <form action="{{ route('admissions.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="patient_id">Cari Pasien (No. RM / Nama)</label>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Masukkan No. RM atau Nama Pasien" />
                                <button class="btn btn-outline-primary" type="button">Cari</button>
                            </div>
                        </div>
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
                                <label class="form-label" for="unit">Klinik / Unit Tujuan</label>
                                <select class="form-select" id="unit" name="unit" required>
                                    <option value="">Pilih Unit</option>
                                    <option value="poli_umum">Poli Umum</option>
                                    <option value="poli_gigi">Poli Gigi</option>
                                    <option value="igd">IGD</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="doctor">Dokter</label>
                                <select class="form-select" id="doctor" name="doctor" required>
                                    <option value="">Pilih Dokter</option>
                                    <option value="dr_smith">dr. Smith</option>
                                    <option value="dr_doe">dr. Doe</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="payment_type">Jenis Penjamin / Pembayaran</label>
                            <select class="form-select" id="payment_type" name="payment_type" required>
                                <option value="umum">Umum (Mandiri)</option>
                                <option value="bpjs">BPJS Kesehatan</option>
                                <option value="asuransi_lain">Asuransi Lainnya</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="notes">Keterangan / Keluhan Utama</label>
                            <textarea id="notes" class="form-control" name="notes" placeholder="Masukkan Keluhan Singkat"></textarea>
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary me-2">Daftarkan</button>
                            <a href="{{ route('admissions.index') }}" class="btn btn-outline-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
