@extends('layouts.main')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Back Office / Kepegawaian /</span> Tambah Pegawai Baru
    </h4>

    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Form Data Kepegawaian</h5>
                    <small class="text-muted float-end">Lengkapi semua data bertanda *</small>
                </div>
                <div class="card-body">
                    <form id="form-employee" enctype="multipart/form-data">
                        @csrf
                        
                        <!-- Section Identitas -->
                        <div class="divider text-start">
                            <div class="divider-text fw-bold text-primary">I. IDENTITAS PRIBADI</div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label">Kode Pegawai <span class="text-danger">*</span></label>
                                <input type="text" name="employee_code" class="form-control" placeholder="EMP-XXXX" required />
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">NIK (No. KTP) <span class="text-danger">*</span></label>
                                <input type="text" name="nik" class="form-control" maxlength="16" placeholder="16 Digit NIK" required />
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" name="full_name" class="form-control" placeholder="Nama Tanpa Gelar" required />
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                                <select class="form-select" name="gender" required>
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="laki-laki">Laki-laki</option>
                                    <option value="perempuan">Perempuan</option>
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Tempat Lahir <span class="text-danger">*</span></label>
                                <input type="text" name="birth_place" class="form-control" placeholder="Kota Lahir" required />
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
                                <input type="date" name="birth_date" class="form-control" required />
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>

                        <!-- Section Kontak & Alamat -->
                        <div class="divider text-start mt-5">
                            <div class="divider-text fw-bold text-primary">II. KONTAK & ALAMAT</div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">No. Telepon/WA <span class="text-danger">*</span></label>
                                <input type="text" name="phone_number" class="form-control" placeholder="08XXXXXXXXXX" required />
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email / Kontak Lain <span class="text-danger">*</span></label>
                                <input type="text" name="contact" class="form-control" placeholder="email@contoh.com" required />
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Alamat Lengkap <span class="text-danger">*</span></label>
                            <textarea class="form-control" name="address" rows="2" placeholder="Nama Jalan, No Rumah" required></textarea>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label class="form-label">RT <span class="text-danger">*</span></label>
                                <input type="text" name="rt" class="form-control" placeholder="000" required>
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">RW <span class="text-danger">*</span></label>
                                <input type="text" name="rw" class="form-control" placeholder="000" required>
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Kelurahan <span class="text-danger">*</span></label>
                                <input type="text" name="village" class="form-control" placeholder="Nama Desa/Kelurahan" required>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label">Kecamatan <span class="text-danger">*</span></label>
                                <input type="text" name="subdistrict" class="form-control" required>
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Kota/Kabupaten <span class="text-danger">*</span></label>
                                <input type="text" name="city" class="form-control" required>
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Provinsi <span class="text-danger">*</span></label>
                                <input type="text" name="province" class="form-control" required>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>

                        <!-- Section Kepegawaian -->
                        <div class="divider text-start mt-5">
                            <div class="divider-text fw-bold text-primary">III. DATA KEPEGAWAIAN</div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Departemen <span class="text-danger">*</span></label>
                                <select name="department_code" class="form-select select2" required>
                                    <option value="">Pilih Departemen</option>
                                    @foreach($departments as $dept)
                                        <option value="{{ $dept->department_code }}">{{ $dept->name }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Jabatan <span class="text-danger">*</span></label>
                                <select name="position_code" id="position_code" class="form-select select2" required>
                                    <option value="">Pilih Jabatan</option>
                                    @foreach($positions as $pos)
                                        <option value="{{ $pos->position_code }}">{{ $pos->name }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label">Pendidikan Terakhir <span class="text-danger">*</span></label>
                                <input type="text" name="last_education" class="form-control" placeholder="Contoh: S1 Kedokteran" required>
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Status Pernikahan <span class="text-danger">*</span></label>
                                <select name="marital_status" class="form-select" required>
                                    <option value="Belum Kawin">Belum Kawin</option>
                                    <option value="Kawin">Kawin</option>
                                    <option value="Cerai Hidup">Cerai Hidup</option>
                                    <option value="Cerai Mati">Cerai Mati</option>
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">No. Rekening Bank</label>
                                <input type="text" name="bank_account_number" class="form-control" placeholder="Optional">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Foto Pegawai</label>
                            <input type="file" name="photo" class="form-control" accept="image/*">
                            <div class="invalid-feedback"></div>
                        </div>

                        <!-- Conditional Professional Section -->
                        <div id="section-specific" class="d-none animate__animated animate__fadeIn">
                            <div class="divider text-start mt-5">
                                <div class="divider-text fw-bold text-danger">IV. DATA PROFESI KLINIS</div>
                            </div>
                            <div class="card border-danger shadow-none bg-label-secondary">
                                <div class="card-body">
                                    <div id="fields-doctor" class="d-none row mb-3">
                                        <div class="col-md-6">
                                            <label class="form-label">Spesialisasi *</label>
                                            <input type="text" name="specialization" class="form-control clinic-field">
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Nomor SIP *</label>
                                            <input type="text" name="sip_number" class="form-control clinic-field">
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                    <div id="fields-nurse" class="d-none mb-3">
                                        <label class="form-label">Nomor STR *</label>
                                        <input type="text" name="str_number" class="form-control clinic-field">
                                        <div class="invalid-feedback"></div>
                                    </div>
                                    <div class="mb-0">
                                        <label class="form-label">Status Aktif Klinis *</label>
                                        <select name="clinic_status" class="form-select clinic-field">
                                            <option value="aktif">Aktif</option>
                                            <option value="cuti">Cuti</option>
                                            <option value="non-aktif">Non-Aktif</option>
                                        </select>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-5 text-end">
                            <a href="{{ route('staffing.index') }}" class="btn btn-outline-secondary me-2">Batal</a>
                            <button type="submit" class="btn btn-primary btn-lg">Simpan Data Pegawai</button>
                        </div>
                        <input type="hidden" name="postal_code" value="00000"> 
                        <input type="hidden" name="country" value="Indonesia">
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
        $('.select2').select2({ theme: 'bootstrap-5' });

                    });
        }

        $('#position_code').on('change', function() {
            const positionText = $(this).find('option:selected').text().toLowerCase();
            $('#section-specific').addClass('d-none');
            $('#fields-doctor').addClass('d-none');
            $('#fields-nurse').addClass('d-none');
            $('.clinic-field').prop('required', false);

            if (positionText.includes('dokter')) {
                $('#section-specific').removeClass('d-none');
                $('#fields-doctor').removeClass('d-none');
                $('#fields-doctor .clinic-field').prop('required', true);
                $('select[name="clinic_status"]').prop('required', true);
            } else if (positionText.includes('perawat')) {
                $('#section-specific').removeClass('d-none');
                $('#fields-nurse').removeClass('d-none');
                $('#fields-nurse .clinic-field').prop('required', true);
                $('select[name="clinic_status"]').prop('required', true);
            }
        });

        $('#form-employee').on('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);

            Swal.fire({
                title: 'Konfirmasi Simpan',
                text: "Simpan data pegawai baru ke sistem?",
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
                        url: '/api/back-office/employees',
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            const empCode = response.data.employee_code;
                            const posText = $('#position_code option:selected').text().toLowerCase();

                            if (posText.includes('dokter') || posText.includes('perawat')) {
                                const type = posText.includes('dokter') ? 'doctors' : 'nurses';
                                const subData = {
                                    employee_code: empCode,
                                    status: $('select[name="clinic_status"]').val()
                                };
                                if (type === 'doctors') {
                                    subData.specialization = $('input[name="specialization"]').val();
                                    subData.sip_number = $('input[name="sip_number"]').val();
                                } else {
                                    subData.str_number = $('input[name="str_number"]').val();
                                }

                                $.ajax({
                                    url: `/api/back-office/${type}`,
                                    type: 'POST',
                                    data: subData,
                                    success: function() {
                                        Swal.fire('Berhasil!', 'Data Pegawai & Profesi Berhasil Disimpan.', 'success').then(() => {
                                            window.location.href = '{{ route('staffing.index') }}';
                                        });
                                    }
                                });
                            } else {
                                Swal.fire('Berhasil!', 'Data Pegawai Berhasil Disimpan.', 'success').then(() => {
                                    window.location.href = '{{ route('staffing.index') }}';
                                });
                            }
                        },
                        error: function(xhr) {
                            if (xhr.status === 422) {
                                handleValidationErrors('#form-employee', xhr.responseJSON.errors);
                                Swal.fire('Gagal!', 'Beberapa input tidak valid. Silakan periksa kembali.', 'error');
                            } else {
                                let msg = xhr.responseJSON.message || 'Terjadi kesalahan sistem.';
                                Swal.fire('Gagal!', msg, 'error');
                            }
                        }
                    });
                }
            });
        });
    });
</script>
@endpush
