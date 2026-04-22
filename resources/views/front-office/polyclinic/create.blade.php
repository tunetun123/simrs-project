@extends('layouts.main')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Master Data / Poliklinik /</span> Buat Jadwal
    </h4>

    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Form Pembuatan Jadwal Layanan</h5>
                </div>
                <div class="card-body">
                    <form id="form-schedule">
                        @csrf
                        <!-- Master Selection Section -->
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <label class="form-label" for="polyclinic_code">Poliklinik <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <select class="form-select select2" id="polyclinic_code" name="polyclinic_code" required>
                                        <option value="">Cari Poliklinik...</option>
                                        @foreach($polyclinics as $poli)
                                            <option value="{{ $poli->polyclinic_code }}">{{ $poli->name }}</option>
                                        @endforeach
                                    </select>
                                    <button class="btn btn-outline-primary" type="button" data-bs-toggle="modal" data-bs-target="#modalAddPolyclinic">
                                        <i class="bx bx-plus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="doctor_code">Dokter Spesialis <span class="text-danger">*</span></label>
                                <select class="form-select select2" id="doctor_code" name="doctor_code" required>
                                    <option value="">Pilih Dokter</option>
                                    @foreach($doctors as $doctor)
                                        <option value="{{ $doctor->employee_code }}">{{ $doctor->full_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="insurance_code">Asuransi <span class="text-danger">*</span></label>
                                <select class="form-select select2" id="insurance_code" name="insurance_code" required>
                                    <option value="">Pilih Asuransi</option>
                                    @foreach($insurances as $insurance)
                                        <option value="{{ $insurance->insurance_code }}">{{ $insurance->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <hr class="my-4">

                        <!-- Dynamic Rows Section -->
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h6 class="mb-0">Detail Jadwal Operasional</h6>
                            <button type="button" class="btn btn-sm btn-info" id="btn-add-row">
                                <i class="bx bx-plus me-1"></i> Tambah Baris Hari
                            </button>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered" id="table-schedule-rows">
                                <thead class="table-light">
                                    <tr>
                                        <th style="width: 20%">Hari</th>
                                        <th style="width: 25%">Jam Mulai</th>
                                        <th style="width: 25%">Jam Selesai</th>
                                        <th style="width: 20%">Kuota Pasien</th>
                                        <th style="width: 10%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="schedule-row">
                                        <td>
                                            <select class="form-select" name="schedules[0][day]" required>
                                                @foreach(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'] as $day)
                                                    <option value="{{ $day }}">{{ $day }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td><input type="time" class="form-control" name="schedules[0][start_time]" required></td>
                                        <td><input type="time" class="form-control" name="schedules[0][end_time]" required></td>
                                        <td><input type="number" class="form-control" name="schedules[0][patient_quota]" placeholder="30" required></td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-icon btn-outline-danger btn-remove-row" disabled>
                                                <i class="bx bx-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-4 text-end">
                            <a href="{{ route('polyclinics.index') }}" class="btn btn-outline-secondary me-2">Batal</a>
                            <button type="submit" class="btn btn-primary">Simpan Semua Jadwal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Poliklinik Baru -->
<div class="modal fade" id="modalAddPolyclinic" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Poliklinik Master</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form-master-polyclinic">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="new_polyclinic_code" class="form-label">Kode Poliklinik <span class="text-danger">*</span></label>
                        <input type="text" id="new_polyclinic_code" name="polyclinic_code" class="form-control" placeholder="Contoh: POLI-UMM" required />
                    </div>
                    <div class="mb-3">
                        <label for="new_name" class="form-label">Nama Poliklinik <span class="text-danger">*</span></label>
                        <input type="text" id="new_name" name="name" class="form-control" placeholder="Contoh: Poliklinik Umum" required />
                    </div>
                    <div class="mb-3">
                        <label for="new_status" class="form-label">Status</label>
                        <select id="new_status" name="status" class="form-select">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan Poli</button>
                </div>
            </form>
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

        let rowIndex = 1;

        // Add Row
        $('#btn-add-row').on('click', function() {
            const newRow = `
                <tr class="schedule-row">
                    <td>
                        <select class="form-select" name="schedules[${rowIndex}][day]" required>
                            @foreach(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'] as $day)
                                <option value="{{ $day }}">{{ $day }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td><input type="time" class="form-control" name="schedules[${rowIndex}][start_time]" required></td>
                    <td><input type="time" class="form-control" name="schedules[${rowIndex}][end_time]" required></td>
                    <td><input type="number" class="form-control" name="schedules[${rowIndex}][patient_quota]" placeholder="30" required></td>
                    <td class="text-center">
                        <button type="button" class="btn btn-icon btn-outline-danger btn-remove-row">
                            <i class="bx bx-trash"></i>
                        </button>
                    </td>
                </tr>
            `;
            $('#table-schedule-rows tbody').append(newRow);
            rowIndex++;
            updateRemoveButtons();
        });

        // Remove Row
        $(document).on('click', '.btn-remove-row', function() {
            $(this).closest('tr').remove();
            updateRemoveButtons();
        });

        function updateRemoveButtons() {
            const rows = $('.schedule-row').length;
            if (rows <= 1) {
                $('.btn-remove-row').prop('disabled', true);
            } else {
                $('.btn-remove-row').prop('disabled', false);
            }
        }

        // Handle Master Polyclinic Form
        $('#form-master-polyclinic').on('submit', function(e) {
            e.preventDefault();
            const btn = $(this).find('button[type="submit"]');
            btn.prop('disabled', true);

            $.ajax({
                url: '{{ route('api.polyclinics.store') }}',
                type: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    $('#modalAddPolyclinic').modal('hide');
                    Swal.fire('Berhasil!', 'Poliklinik master berhasil ditambahkan.', 'success');
                    const newOption = new Option(response.data.name + ' (' + response.data.polyclinic_code + ')', response.data.polyclinic_code, true, true);
                    $('#polyclinic_code').append(newOption).trigger('change');
                    $('#form-master-polyclinic')[0].reset();
                },
                error: function(xhr) {
                    Swal.fire('Gagal!', xhr.responseJSON.message || 'Terjadi kesalahan.', 'error');
                },
                complete: function() {
                    btn.prop('disabled', false);
                }
            });
        });

        // Handle Schedule Form
        $('#form-schedule').on('submit', function(e) {
            e.preventDefault();
            
            const form = this;
            if (!form.checkValidity()) {
                form.reportValidity();
                return;
            }

            Swal.fire({
                title: 'Simpan Semua Jadwal?',
                text: "Semua baris jadwal yang Anda buat akan disimpan.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya, Simpan'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Mohon Tunggu',
                        allowOutsideClick: false,
                        didOpen: () => { Swal.showLoading(); }
                    });

                    $.ajax({
                        url: '{{ route('api.polyclinics.schedules.store') }}',
                        type: 'POST',
                        data: $(form).serialize(),
                        success: function(response) {
                            Swal.fire('Berhasil!', 'Jadwal poliklinik berhasil dibuat.', 'success').then(() => {
                                window.location.href = '{{ route('polyclinics.index') }}';
                            });
                        },
                        error: function(xhr) {
                            let errorMessage = xhr.responseJSON.message || 'Terjadi kesalahan.';
                            if (xhr.status === 422) {
                                handleValidationErrors('#form-schedule', xhr.responseJSON.errors);
                                errorMessage = 'Pastikan semua form diisi dengan benar.';
                            }
                            Swal.fire({ icon: 'error', title: 'Gagal!', html: errorMessage });
                        }
                    });
                }
            });
        });
    });
</script>
@endpush
