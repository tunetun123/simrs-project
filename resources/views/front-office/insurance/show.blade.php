@extends('layouts.main')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Front Office / Asuransi /</span> Detail
    </h4>

    <div class="row">
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body text-center">
                    @if($insurance->logo)
                        <img src="{{ asset('storage/' . $insurance->logo) }}" alt="Logo" class="img-fluid rounded mb-3" style="max-height: 200px;">
                    @else
                        <div class="bg-label-primary rounded p-4 mb-3">
                            <i class="bx bx-id-card bx-lg"></i>
                        </div>
                    @endif
                    <h5 class="mb-1">{{ $insurance->name }}</h5>
                    <span class="badge bg-label-{{ $insurance->status == 'active' ? 'success' : 'danger' }}">
                        {{ ucfirst($insurance->status) }}
                    </span>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card mb-4">
                <h5 class="card-header">Informasi Asuransi</h5>
                <div class="card-body">
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label fw-bold">Kode Asuransi</label>
                        <div class="col-sm-9">
                            <p class="form-control-plaintext text-primary fw-bold">{{ $insurance->insurance_code }}</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label fw-bold">Nama Lengkap</label>
                        <div class="col-sm-9">
                            <p class="form-control-plaintext">{{ $insurance->name }}</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label fw-bold">Kontak</label>
                        <div class="col-sm-9">
                            <p class="form-control-plaintext">{{ $insurance->contact }}</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label fw-bold">Alamat</label>
                        <div class="col-sm-9">
                            <p class="form-control-plaintext">{{ $insurance->address }}</p>
                        </div>
                    </div>
                    <hr>
                    <div class="mt-4">
                        <a href="{{ route('insurances.edit', $insurance->insurance_code) }}" class="btn btn-warning me-2">
                            <i class="bx bx-edit-alt me-1"></i> Edit
                        </a>
                        <a href="{{ route('insurances.index') }}" class="btn btn-outline-secondary">
                            <i class="bx bx-arrow-back me-1"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
