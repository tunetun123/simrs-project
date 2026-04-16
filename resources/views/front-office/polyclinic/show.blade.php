@extends('layouts.main')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Master Data / Poliklinik /</span> Detail
    </h4>

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Informasi Poliklinik: <span class="text-primary">{{ $polyclinic->name }}</span></h5>
                    <span class="badge bg-label-{{ $polyclinic->status == 'active' ? 'success' : 'danger' }}">
                        {{ ucfirst($polyclinic->status) }}
                    </span>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <th style="width: 40%">Kode Poliklinik</th>
                                    <td>: {{ $polyclinic->polyclinic_code }}</td>
                                </tr>
                                <tr>
                                    <th>Nama Poliklinik</th>
                                    <td>: {{ $polyclinic->name }}</td>
                                </tr>
                                <tr>
                                    <th>Dokter Spesialis</th>
                                    <td>: <span class="fw-bold text-info">{{ $polyclinic->doctor->full_name ?? '-' }}</span></td>
                                </tr>
                                <tr>
                                    <th>Asuransi Terkait</th>
                                    <td>: {{ $polyclinic->insurance->name ?? '-' }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <th style="width: 40%">Hari Layanan</th>
                                    <td>: {{ $polyclinic->service_days }}</td>
                                </tr>
                                <tr>
                                    <th>Jam Operasional</th>
                                    <td>: {{ \Carbon\Carbon::parse($polyclinic->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($polyclinic->end_time)->format('H:i') }}</td>
                                </tr>
                                <tr>
                                    <th>Kuota Pasien</th>
                                    <td>: {{ $polyclinic->patient_quota }} Pasien</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="mt-2">
                        <a href="{{ route('polyclinics.edit', $polyclinic->polyclinic_code) }}" class="btn btn-warning me-2">
                            <i class="bx bx-edit-alt me-1"></i> Edit
                        </a>
                        <a href="{{ route('polyclinics.index') }}" class="btn btn-outline-secondary">
                            <i class="bx bx-arrow-back me-1"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
