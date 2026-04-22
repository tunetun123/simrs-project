@extends('layouts.main')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Back Office / Kepegawaian /</span> Detail Pegawai
    </h4>

    <div class="row">
        <!-- Profile Card -->
        <div class="col-xl-4 col-lg-5 col-md-5">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="user-avatar-section">
                        <div class="d-flex align-items-center flex-column">
                            @if($employee->photo_path)
                                <img class="img-fluid rounded my-4" src="{{ asset('storage/' . $employee->photo_path) }}" height="110" width="110" alt="User avatar" />
                            @else
                                <div class="bg-label-primary rounded p-4 my-4">
                                    <i class="bx bx-user bx-lg"></i>
                                </div>
                            @endif
                            <div class="user-info text-center">
                                <h4 class="mb-2">{{ $employee->full_name }}</h4>
                                <span class="badge bg-label-secondary">{{ $employee->position->name ?? '-' }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-around flex-wrap my-4 py-3">
                        <div class="d-flex align-items-start me-4 mt-3 gap-3">
                            <span class="badge bg-label-primary p-2 rounded"><i class="bx bx-check bx-sm"></i></span>
                            <div>
                                <h5 class="mb-0">{{ ucfirst($employee->gender) }}</h5>
                                <span>Gender</span>
                            </div>
                        </div>
                        <div class="d-flex align-items-start mt-3 gap-3">
                            <span class="badge bg-label-primary p-2 rounded"><i class="bx bx-customize bx-sm"></i></span>
                            <div>
                                <h5 class="mb-0">{{ $employee->department->name ?? '-' }}</h5>
                                <span>Dept</span>
                            </div>
                        </div>
                    </div>
                    <h5 class="pb-2 border-bottom mb-4">Details</h5>
                    <div class="info-container">
                        <ul class="list-unstyled">
                            <li class="mb-3">
                                <span class="fw-bold me-2">Kode Pegawai:</span>
                                <span>{{ $employee->employee_code }}</span>
                            </li>
                            <li class="mb-3">
                                <span class="fw-bold me-2">NIK:</span>
                                <span>{{ $employee->nik }}</span>
                            </li>
                            <li class="mb-3">
                                <span class="fw-bold me-2">Email/Kontak:</span>
                                <span>{{ $employee->contact }}</span>
                            </li>
                            <li class="mb-3">
                                <span class="fw-bold me-2">Phone:</span>
                                <span>{{ $employee->phone_number }}</span>
                            </li>
                        </ul>
                        <div class="d-flex justify-content-center pt-3">
                            <a href="{{ route('staffing.edit', $employee->employee_code) }}" class="btn btn-primary me-3">Edit</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Detail Information -->
        <div class="col-xl-8 col-lg-7 col-md-7">
            <div class="card mb-4">
                <h5 class="card-header">Informasi Lengkap</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="fw-bold">Tempat, Tgl Lahir</label>
                            <p>{{ $employee->birth_place }}, {{ \Carbon\Carbon::parse($employee->birth_date)->format('d F Y') }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="fw-bold">Pendidikan Terakhir</label>
                            <p>{{ $employee->last_education }}</p>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="fw-bold">Alamat</label>
                            <p>{{ $employee->address }}, RT {{ $employee->rt }} RW {{ $employee->rw }}, {{ $employee->village }}, {{ $employee->subdistrict }}, {{ $employee->city }}, {{ $employee->province }} {{ $employee->postal_code }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="fw-bold">Status Pernikahan</label>
                            <p>{{ $employee->marital_status }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="fw-bold">No. Rekening</label>
                            <p>{{ $employee->bank_account_number ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Specific Professional Info -->
            @if($employee->doctor || $employee->nurse)
            <div class="card border-primary">
                <h5 class="card-header text-primary">Informasi Profesi Klinis</h5>
                <div class="card-body">
                    @if($employee->doctor)
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="fw-bold">Spesialisasi</label>
                                <p>{{ $employee->doctor->specialization }}</p>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="fw-bold">No. SIP</label>
                                <p>{{ $employee->doctor->sip_number }}</p>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="fw-bold">Status Klinis</label>
                                <p><span class="badge bg-label-success">{{ ucfirst($employee->doctor->status) }}</span></p>
                            </div>
                        </div>
                    @elseif($employee->nurse)
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="fw-bold">No. STR</label>
                                <p>{{ $employee->nurse->str_number }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="fw-bold">Status Klinis</label>
                                <p><span class="badge bg-label-success">{{ ucfirst($employee->nurse->status) }}</span></p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
