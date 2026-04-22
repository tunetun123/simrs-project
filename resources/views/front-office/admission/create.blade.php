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
                    <form id="form-registration">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="patient_search">Cari Pasien (No. RM / Nama)</label>
                            <div class="input-group">
                                <input type="text" id="patient_search" class="form-control" placeholder="Masukkan No. RM atau Nama Pasien" />
                                <button class="btn btn-outline-primary" type="button" id="btn-search">Cari</button>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Nama Pasien</label>
                                <input type="text" id="display_name" class="form-control" readonly placeholder="Pilih pasien terlebih dahulu" />
                                <input type="hidden" name="medical_record_number" id="medical_record_number" required />
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">No. Rekam Medis</label>
                                <input type="text" id="display_rm" class="form-control" readonly placeholder="Pilih pasien terlebih dahulu" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label" for="polyclinic_code">Klinik / Unit Tujuan <span class="text-danger">*</span></label>
                                <select class="form-select" id="polyclinic_code" name="polyclinic_code" required>
                                    <option value="">Pilih Unit</option>
                                    @foreach($polyclinics as $poly)
                                        <option value="{{ $poly->polyclinic_code }}">{{ $poly->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="visit_type">Jenis Kunjungan <span class="text-danger">*</span></label>
                                <select class="form-select" id="visit_type" name="visit_type" required>
                                    <option value="Rawat Jalan">Rawat Jalan</option>
                                    <option value="IGD">IGD</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="insurance_code">Jenis Penjamin / Pembayaran <span class="text-danger">*</span></label>
                            <select class="form-select" id="insurance_code" name="insurance_code" required>
                                <option value="">Pilih Penjamin</option>
                                @foreach($insurances as $ins)
                                    <option value="{{ $ins->insurance_code }}">{{ $ins->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="participant_number">Nomor Peserta (Opsional)</label>
                            <input type="text" class="form-control" id="participant_number" name="participant_number" placeholder="Masukkan No. Kartu BPJS/Asuransi" />
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary me-2">Daftarkan Kunjungan</button>
                            <a href="{{ route('admissions.index') }}" class="btn btn-outline-secondary">Batal</a>
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
        // Handle pencarian pasien sederhana
        $('#btn-search').on('click', function() {
            const query = $('#patient_search').val();
            if(!query) return;

            $.ajax({
                url: "{{ route('api.patients.show', ':patient') }}".replace(':patient', query),
                type: 'GET',
                success: function(response) {
                    const patient = response.data;
                    $('#display_name').val(patient.full_name);
                    $('#display_rm').val(patient.medical_record_number);
                    $('#medical_record_number').val(patient.medical_record_number);
                    
                    Swal.fire({
                        icon: 'success',
                        title: 'Pasien Ditemukan',
                        text: 'Pasien: ' + patient.full_name,
                        timer: 1500,
                        showConfirmButton: false
                    });
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Tidak Ditemukan',
                        text: 'Pasien dengan No. RM tersebut tidak ditemukan.',
                        confirmButtonText: 'Tutup'
                    });
                    $('#display_name, #display_rm, #medical_record_number').val('');
                }
            });
        });

        // Handle submit registrasi
        $('#form-registration').on('submit', function(e) {
            e.preventDefault();
            
            const formData = $(this).serialize();
            
            $.ajax({
                url: '{{ route('api.register') }}',
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Pendaftaran Berhasil!',
                        text: 'Nomor Kunjungan: ' + response.data.visit_number,
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = '/front-office/admissions';
                        }
                    });
                },
                error: function(xhr) {
                    let errorMessage = 'Terjadi kesalahan sistem.';

                    if (xhr.status === 422) {
                        handleValidationErrors('#form-registration', xhr.responseJSON.errors);
                        errorMessage = 'Pastikan semua form diisi dengan benar.';
                    }                    
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal Daftar!',
                        html: errorMessage,
                        confirmButtonText: 'Tutup'
                    });
                }
            });
        });
    });
</script>
@endpush
