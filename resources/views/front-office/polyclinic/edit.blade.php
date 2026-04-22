@extends('layouts.main')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Master Data / Poliklinik /</span> Edit
    </h4>

    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Form Edit Data Poliklinik</h5>
                    <small class="text-muted float-end">Kode: {{ $polyclinic->polyclinic_code }}</small>
                </div>
                <div class="card-body">
                    <form id="form-edit-polyclinic">
                        @csrf
                        @method('PUT')
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label" for="polyclinic_code">Kode Poliklinik</label>
                                <input type="text" class="form-control" id="polyclinic_code" value="{{ $polyclinic->polyclinic_code }}" disabled />
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="name">Nama Poliklinik</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $polyclinic->name }}" required />
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label" for="doctor_code">Dokter Spesialis <span class="text-danger">*</span></label>
                                <select class="form-select select2" id="doctor_code" name="doctor_code" required>
                                    <option value="">Pilih Dokter</option>
                                    @foreach($doctors as $doctor)
                                        <option value="{{ $doctor->employee_code }}" {{ $polyclinic->doctor_code == $doctor->employee_code ? 'selected' : '' }}>
                                            {{ $doctor->full_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="insurance_code">Asuransi Terkait <span class="text-danger">*</span></label>
                                <select class="form-select select2" id="insurance_code" name="insurance_code" required>
                                    <option value="">Pilih Asuransi</option>
                                    @foreach($insurances as $insurance)
                                        <option value="{{ $insurance->insurance_code }}" {{ $polyclinic->insurance_code == $insurance->insurance_code ? 'selected' : '' }}>
                                            {{ $insurance->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label" for="service_days">Hari Layanan</label>
                                <input type="text" class="form-control" id="service_days" name="service_days" value="{{ $polyclinic->service_days }}" required />
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="start_time">Jam Mulai</label>
                                <input type="time" class="form-control" id="start_time" name="start_time" value="{{ \Carbon\Carbon::parse($polyclinic->start_time)->format('H:i') }}" required />
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="end_time">Jam Selesai</label>
                                <input type="time" class="form-control" id="end_time" name="end_time" value="{{ \Carbon\Carbon::parse($polyclinic->end_time)->format('H:i') }}" required />
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label" for="patient_quota">Kuota Pasien</label>
                                <input type="number" class="form-control" id="patient_quota" name="patient_quota" value="{{ $polyclinic->patient_quota }}" required />
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="status">Status <span class="text-danger">*</span></label>
                                <select class="form-select" id="status" name="status" required>
                                    <option value="active" {{ $polyclinic->status == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="inactive" {{ $polyclinic->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary me-2">Update Poliklinik</button>
                            <a href="{{ route('polyclinics.index') }}" class="btn btn-outline-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('myscript')
<script>
    $(document).ready(function() {
        $('.select2').select2({
            theme: 'bootstrap-5'
        });

        $('#form-edit-polyclinic').on('submit', function(e) {
            e.preventDefault();
            
            const form = this;
            
            if (!form.checkValidity()) {
                form.reportValidity();
                return;
            }

            Swal.fire({
                title: 'Update Data Poliklinik?',
                text: "Pastikan semua data sudah benar.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya, Update',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Mohon Tunggu',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    const formData = $(form).serialize();
                    
                    $.ajax({
                        url: '{{ route('api.polyclinics.update', $polyclinic->polyclinic_code) }}',
                        type: 'POST',
                        data: formData,
                        dataType: 'json',
                        success: function(response) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: 'Data poliklinik berhasil diperbarui.',
                            }).then(() => {
                                window.location.href = '{{ route('polyclinics.index') }}';
                            });
                        },
                        error: function(xhr) {
                            let errorMessage = 'Terjadi kesalahan sistem.';
                            if (xhr.status === 422) {
                                handleValidationErrors('#form-edit-polyclinic', xhr.responseJSON.errors);
                                errorMessage = 'Pastikan semua form diisi dengan benar.';
                            }
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                html: errorMessage,
                            });
                        }
                    });
                }
            });
        });
    });
</script>
@endpush
