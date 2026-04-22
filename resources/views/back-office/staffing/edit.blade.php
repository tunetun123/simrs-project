@extends('layouts.main')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Back Office / Kepegawaian /</span> Edit Data Pegawai
    </h4>

    <form id="form-edit-employee" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <!-- Section 1: Identitas Dasar -->
            <div class="col-md-6">
                <div class="card mb-4">
                    <h5 class="card-header">1. Identitas Pribadi</h5>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Kode Pegawai</label>
                                <input type="text" id="employee_code" class="form-control" value="{{ $employee->employee_code }}" disabled>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">NIK (KTP)</label>
                                <input type="text" name="nik" class="form-control" maxlength="16" value="{{ $employee->nik }}" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="full_name" class="form-control" value="{{ $employee->full_name }}" required>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                                <select name="gender" class="form-select" required>
                                    <option value="laki-laki" {{ $employee->gender == 'laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="perempuan" {{ $employee->gender == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Tgl Lahir</label>
                                <input type="date" name="birth_date" class="form-control" value="{{ $employee->birth_date }}" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tempat Lahir</label>
                            <input type="text" name="birth_place" class="form-control" value="{{ $employee->birth_place }}" required>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section 2: Kontak & Alamat -->
            <div class="col-md-6">
                <div class="card mb-4">
                    <h5 class="card-header">2. Kontak & Alamat</h5>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Email/Kontak</label>
                                <input type="text" name="contact" class="form-control" value="{{ $employee->contact }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">No. Telepon</label>
                                <input type="text" name="phone_number" class="form-control" value="{{ $employee->phone_number }}" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Alamat Lengkap <span class="text-danger">*</span></label>
                            <textarea name="address" class="form-control" rows="2" required>{{ $employee->address }}</textarea>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label class="form-label">RT</label>
                                <input type="text" name="rt" class="form-control" value="{{ $employee->rt }}" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">RW</label>
                                <input type="text" name="rw" class="form-control" value="{{ $employee->rw }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Kelurahan</label>
                                <input type="text" name="village" class="form-control" value="{{ $employee->village }}" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Kecamatan</label>
                                <input type="text" name="subdistrict" class="form-control" value="{{ $employee->subdistrict }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Kota</label>
                                <input type="text" name="city" class="form-control" value="{{ $employee->city }}" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Provinsi</label>
                                <input type="text" name="province" class="form-control" value="{{ $employee->province }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Kode Pos</label>
                                <input type="text" name="postal_code" class="form-control" value="{{ $employee->postal_code }}" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section 3: Kepegawaian -->
            <div class="col-md-6">
                <div class="card mb-4">
                    <h5 class="card-header">3. Informasi Kepegawaian</h5>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Departemen <span class="text-danger">*</span></label>
                                <select name="department_code" class="form-select select2" required>
                                    @foreach($departments as $dept)
                                        <option value="{{ $dept->department_code }}" {{ $employee->department_code == $dept->department_code ? 'selected' : '' }}>{{ $dept->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Jabatan <span class="text-danger">*</span></label>
                                <select name="position_code" id="position_code" class="form-select select2" required>
                                    @foreach($positions as $pos)
                                        <option value="{{ $pos->position_code }}" {{ $employee->position_code == $pos->position_code ? 'selected' : '' }}>{{ $pos->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Pendidikan Terakhir</label>
                            <input type="text" name="last_education" class="form-control" value="{{ $employee->last_education }}" required>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Status Pernikahan</label>
                                <input type="text" name="marital_status" class="form-control" value="{{ $employee->marital_status }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">No. Rekening</label>
                                <input type="text" name="bank_account_number" class="form-control" value="{{ $employee->bank_account_number }}">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Ganti Foto Pegawai</label>
                            @if($employee->photo_path)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $employee->photo_path) }}" width="80" class="rounded">
                                </div>
                            @endif
                            <input type="file" name="photo" class="form-control" accept="image/*">
                        </div>
                        <input type="hidden" name="country" value="Indonesia">
                    </div>
                </div>
            </div>

            <!-- Section 4: Data Spesifik (Conditional) -->
            <div class="col-md-6 {{ $employee->doctor || $employee->nurse ? '' : 'd-none' }}" id="section-specific">
                <div class="card mb-4 border-primary">
                    <h5 class="card-header text-primary">4. Data Profesi Klinis</h5>
                    <div class="card-body">
                        <!-- Dokter Fields -->
                        <div id="fields-doctor" class="{{ $employee->doctor ? '' : 'd-none' }}">
                            <div class="mb-3">
                                <label class="form-label">Spesialisasi</label>
                                <input type="text" name="specialization" class="form-control clinic-field" value="{{ $employee->doctor->specialization ?? '' }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nomor SIP</label>
                                <input type="text" name="sip_number" class="form-control clinic-field" value="{{ $employee->doctor->sip_number ?? '' }}">
                            </div>
                        </div>
                        <!-- Perawat Fields -->
                        <div id="fields-nurse" class="{{ $employee->nurse ? '' : 'd-none' }}">
                            <div class="mb-3">
                                <label class="form-label">Nomor STR</label>
                                <input type="text" name="str_number" class="form-control clinic-field" value="{{ $employee->nurse->str_number ?? '' }}">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status Aktif Klinis</label>
                            <select name="clinic_status" class="form-select clinic-field">
                                @php $currentStatus = $employee->doctor->status ?? ($employee->nurse->status ?? 'aktif'); @endphp
                                <option value="aktif" {{ $currentStatus == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="cuti" {{ $currentStatus == 'cuti' ? 'selected' : '' }}>Cuti</option>
                                <option value="non-aktif" {{ $currentStatus == 'non-aktif' ? 'selected' : '' }}>Non-Aktif</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-4 text-end">
            <a href="{{ route('staffing.index') }}" class="btn btn-outline-secondary me-2">Batal</a>
            <button type="submit" class="btn btn-primary">Update Data Pegawai</button>
        </div>
    </form>
</div>
@endsection

@push('myscript')
<script>
    $(document).ready(function() {
        $('.select2').select2({ theme: 'bootstrap-5' });

        $('#form-edit-employee').on('submit', function(e) {
            e.preventDefault();
            const empCode = '{{ $employee->employee_code }}';
            const formData = new FormData(this);

            Swal.fire({
                title: 'Update Data Pegawai?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya, Update'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.showLoading();
                    $.ajax({
                        url: `/api/back-office/employees/${empCode}`,
                        type: 'POST', // Use POST with _method=PUT for multipart
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function() {
                            // Update specific data if needed
                            const posText = $('#position_code option:selected').text().toLowerCase();
                            if (posText.includes('dokter') || posText.includes('perawat')) {
                                const type = posText.includes('dokter') ? 'doctors' : 'nurses';
                                const subData = {
                                    status: $('select[name="clinic_status"]').val()
                                };
                                if (type === 'doctors') {
                                    subData.specialization = $('input[name="specialization"]').val();
                                    subData.sip_number = $('input[name="sip_number"]').val();
                                } else {
                                    subData.str_number = $('input[name="str_number"]').val();
                                }

                                $.ajax({
                                    url: `/api/back-office/${type}/${empCode}`,
                                    type: 'POST',
                                    data: subData,
                                    success: function() {
                                        Swal.fire('Berhasil!', 'Data pegawai dan profesi diperbarui.', 'success').then(() => {
                                            window.location.href = '{{ route('staffing.index') }}';
                                        });
                                    },
                                    error: function(xhr) {
                                        let msg = xhr.responseJSON.message || 'Gagal update data profesi.';
                                        if(xhr.status === 422) msg = Object.values(xhr.responseJSON.errors).flat().join('<br>');
                                        Swal.fire('Gagal!', msg, 'error');
                                    }
                                });
                            } else {
                                Swal.fire('Berhasil!', 'Data pegawai diperbarui.', 'success').then(() => {
                                    window.location.href = '{{ route('staffing.index') }}';
                                });
                            }
                        },
                        error: function(xhr) {
                            let msg = xhr.responseJSON.message || 'Terjadi kesalahan.';
                            if(xhr.status === 422) msg = Object.values(xhr.responseJSON.errors).flat().join('<br>');
                            Swal.fire('Gagal Update!', msg, 'error');
                        }
                    });
                }
            });
        });
    });
</script>
@endpush
