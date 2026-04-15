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
                        <label class="col-sm-3 col-form-label fw-bold">No. Rekam Medis</label>
                        <div class="col-sm-9">
                            <p class="form-control-plaintext">: {{ $patient->medical_record_number }}</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label fw-bold">Nomor IHS (SatuSehat)</label>
                        <div class="col-sm-9">
                            <p class="form-control-plaintext">: {{ $patient->ihs_number ?? '-' }}</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label fw-bold">Nama Lengkap</label>
                        <div class="col-sm-9">
                            <p class="form-control-plaintext">: {{ $patient->full_name }}</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label fw-bold">{{ $patient->passport_number ? 'Nomor Passport' : 'NIK' }}</label>
                        <div class="col-sm-9">
                            <p class="form-control-plaintext">: {{ $patient->passport_number ?? $patient->nik }}</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label fw-bold">Jenis Kelamin</label>
                        <div class="col-sm-9">
                            <p class="form-control-plaintext">: {{ $patient->gender == 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label fw-bold">Agama</label>
                        <div class="col-sm-9">
                            <p class="form-control-plaintext">: {{ $patient->religion ?? '-' }}</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label fw-bold">Golongan Darah</label>
                        <div class="col-sm-9">
                            <p class="form-control-plaintext">: {{ $patient->blood_type ?? '-' }}</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label fw-bold">Tempat, Tanggal Lahir</label>
                        <div class="col-sm-9">
                            <p class="form-control-plaintext">: {{ $patient->birth_place }}, {{ \Carbon\Carbon::parse($patient->birth_date)->format('d-m-Y') }}</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label fw-bold">Nama Ibu Kandung</label>
                        <div class="col-sm-9">
                            <p class="form-control-plaintext">: {{ $patient->mothers_maiden_name }}</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label fw-bold">Kontak & Bahasa</label>
                        <div class="col-sm-9">
                            <p class="form-control-plaintext">: {{ $patient->phone_number }} ({{ $patient->language }})</p>
                        </div>
                    </div>
                    <hr>
                    <h6 class="fw-bold">Alamat & Domisili</h6>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label fw-bold">Alamat Lengkap</label>
                        <div class="col-sm-9">
                            <p class="form-control-plaintext">: {{ $patient->address }}</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label fw-bold">Wilayah</label>
                        <div class="col-sm-9">
                            <p class="form-control-plaintext">: 
                                RT {{ $patient->rt }} / RW {{ $patient->rw }}, 
                                {{ $patient->village }}, {{ $patient->subdistrict }}, 
                                {{ $patient->city }}, {{ $patient->province }}, {{ $patient->country }} 
                                ({{ $patient->postal_code }})
                            </p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label fw-bold">Status Pernikahan</label>
                        <div class="col-sm-9">
                            <p class="form-control-plaintext">: {{ $patient->marital_status }}</p>
                        </div>
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('patients.edit', $patient->medical_record_number) }}" class="btn btn-warning">Edit Data</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
