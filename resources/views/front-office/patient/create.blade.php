@extends('layouts.main')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Front Office /</span> Pendaftaran Pasien Baru
    </h4>

    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Form Data Pasien</h5>
                    <small class="text-muted float-end">Informasi Identitas</small>
                </div>
                <div class="card-body">
                    <form id="form-patient">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label" for="medical_record_number">No. Rekam Medis</label>
                                <input type="text" class="form-control" id="medical_record_number_display" value="{{ $nextMrn }}" disabled />
                                <input type="hidden" name="medical_record_number" value="{{ $nextMrn }}" />
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="ihs_number">Nomor IHS (SatuSehat)</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="ihs_number" name="ihs_number" placeholder="Nomor IHS akan terisi otomatis" readonly />
                                    <button class="btn btn-outline-primary" type="button" id="btn-request-ihs">Request IHS</button>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="full_name">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="full_name" name="full_name" placeholder="Masukkan Nama Lengkap" required />
                        </div>

                        <div class="mb-3">
                            <div class="form-check form-switch mb-2">
                                <input class="form-check-input" type="checkbox" id="is_foreign" />
                                <label class="form-check-label" for="is_foreign">Pasien Luar Negeri (WNA)</label>
                            </div>
                        </div>

                        <div class="mb-3" id="nik_container">
                            <label class="form-label" for="nik">NIK <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="nik" name="nik" placeholder="Masukkan NIK" required />
                        </div>

                        <div class="mb-3 d-none" id="passport_container">
                            <label class="form-label" for="passport_number">Nomor Passport</label>
                            <input type="text" class="form-control" id="passport_number" name="passport_number" placeholder="Masukkan Nomor Passport" />
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label" for="gender">Jenis Kelamin <span class="text-danger">*</span></label>
                                <select class="form-select" id="gender" name="gender" required>
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="L">Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="religion">Agama <span class="text-danger">*</span></label>
                                <select class="form-select" id="religion" name="religion" required>
                                    <option value="">Pilih Agama</option>
                                    <option value="Islam">Islam</option>
                                    <option value="Kristen">Kristen</option>
                                    <option value="Katolik">Katolik</option>
                                    <option value="Hindu">Hindu</option>
                                    <option value="Budha">Budha</option>
                                    <option value="Khonghucu">Khonghucu</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="blood_type">Golongan Darah <span class="text-danger">*</span></label>
                                <select class="form-select" id="blood_type" name="blood_type" required>
                                    <option value="-">Tidak Tahu</option>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="AB">AB</option>
                                    <option value="O">O</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label" for="birth_place">Tempat Lahir <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="birth_place" name="birth_place" placeholder="Masukkan Tempat Lahir" required />
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="birth_date">Tanggal Lahir <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="birth_date" name="birth_date" required />
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="mothers_maiden_name">Nama Ibu Kandung <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="mothers_maiden_name" name="mothers_maiden_name" placeholder="Masukkan Nama Ibu Kandung" required />
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label" for="phone_number">No. Telepon <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="Masukkan No. Telepon" required />
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="language">Bahasa <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="language" name="language" placeholder="Contoh: Indonesia" required />
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="address">Alamat Lengkap <span class="text-danger">*</span></label>
                            <textarea id="address" class="form-control" name="address" placeholder="Masukkan Alamat Lengkap" required></textarea>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label" for="country">Negara <span class="text-danger">*</span></label>
                                <select class="form-select select2-location" id="country" name="country" required>
                                    <option value="Indonesia">Indonesia</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="province">Provinsi <span class="text-danger">*</span></label>
                                <select class="form-select select2-location" id="province" name="province" required>
                                    <option value="">Pilih Provinsi</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label" for="city">Kota / Kabupaten <span class="text-danger">*</span></label>
                                <select class="form-select select2-location" id="city" name="city" required>
                                    <option value="">Pilih Kota</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="subdistrict">Kecamatan <span class="text-danger">*</span></label>
                                <select class="form-select select2-location" id="subdistrict" name="subdistrict" required>
                                    <option value="">Pilih Kecamatan</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label" for="village">Kelurahan / Desa <span class="text-danger">*</span></label>
                                <select class="form-select select2-location" id="village" name="village" required>
                                    <option value="">Pilih Kelurahan</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label" for="rt">RT <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="rt" name="rt" placeholder="001" required />
                            </div>
                            <div class="col-md-2">
                                <label class="form-label" for="rw">RW <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="rw" name="rw" placeholder="002" required />
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="postal_code">Kode Pos <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="postal_code" name="postal_code" required />
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="marital_status">Status Pernikahan <span class="text-danger">*</span></label>
                            <select class="form-select" id="marital_status" name="marital_status" required>
                                <option value="Belum Kawin">Belum Kawin</option>
                                <option value="Kawin">Kawin</option>
                                <option value="Cerai Hidup">Cerai Hidup</option>
                                <option value="Cerai Mati">Cerai Mati</option>
                            </select>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary me-2">Simpan Pasien</button>
                            <button type="button" id="btn-cancel" class="btn btn-outline-secondary">Batal</button>
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
        // Initialize Select2 for locations with tags: true
        $('.select2-location').select2({
            theme: 'bootstrap-5',
            tags: true,
            placeholder: 'Pilih atau ketik manual...',
            allowClear: true
        });

        // Toggle Foreign Patient
        $('#is_foreign').on('change', function() {
            if ($(this).is(':checked')) {
                $('#nik_container').addClass('d-none');
                $('#nik').removeAttr('required').val('');
                $('#passport_container').removeClass('d-none');
                $('#passport_number').attr('required', true);
                $('#country').val('Lainnya').trigger('change');
            } else {
                $('#nik_container').removeClass('d-none');
                $('#nik').attr('required', true);
                $('#passport_container').addClass('d-none');
                $('#passport_number').removeAttr('required').val('');
                $('#country').val('Indonesia').trigger('change');
            }
        });

        // Request IHS (Placeholder with Validation)
        $('#btn-request-ihs').on('click', function() {
            const isForeign = $('#is_foreign').is(':checked');
            const nik = $('#nik').val();
            const passport = $('#passport_number').val();

            if (!isForeign && !nik) {
                Swal.fire({
                    title: 'NIK Kosong',
                    text: 'Silakan isi NIK terlebih dahulu sebelum request IHS.',
                    icon: 'warning'
                });
                return;
            }

            if (isForeign && !passport) {
                Swal.fire({
                    title: 'Nomor Passport Kosong',
                    text: 'Silakan isi Nomor Passport terlebih dahulu sebelum request IHS.',
                    icon: 'warning'
                });
                return;
            }

            Swal.fire({
                title: 'Request IHS',
                text: 'Fitur integrasi SatuSehat akan segera tersedia menggunakan identitas: ' + (isForeign ? passport : nik),
                icon: 'info'
            });
        });

        // Wilayah.id Integration
        const base_url = "https://www.emsifa.com/api-wilayah-indonesia/api";

        function loadProvinces() {
            $.ajax({
                url: `${base_url}/provinces.json`,
                type: 'GET',
                success: function(provinces) {
                    let options = '<option value="">Pilih Provinsi</option>';
                    provinces.forEach(p => {
                        options += `<option value="${p.name}" data-id="${p.id}">${p.name}</option>`;
                    });
                    $('#province').html(options).trigger('change');
                }
            });
        }

        $('#country').on('change', function() {
            if ($(this).val() === 'Indonesia') {
                loadProvinces();
            } else {
                $('#province, #city, #subdistrict, #village').empty().append('<option value="">Pilih atau ketik manual...</option>').trigger('change');
            }
        });

        loadProvinces(); // Initial load

        $('#province').on('change', function() {
            const provinceId = $(this).find(':selected').data('id');
            if (!provinceId) return;

            $.ajax({
                url: `${base_url}/regencies/${provinceId}.json`,
                type: 'GET',
                success: function(cities) {
                    let options = '<option value="">Pilih Kota</option>';
                    cities.forEach(c => {
                        options += `<option value="${c.name}" data-id="${c.id}">${c.name}</option>`;
                    });
                    $('#city').html(options).trigger('change');
                    $('#subdistrict, #village').empty().append('<option value="">Pilih...</option>').trigger('change');
                }
            });
        });

        $('#city').on('change', function() {
            const cityId = $(this).find(':selected').data('id');
            if (!cityId) return;

            $.ajax({
                url: `${base_url}/districts/${cityId}.json`,
                type: 'GET',
                success: function(districts) {
                    let options = '<option value="">Pilih Kecamatan</option>';
                    districts.forEach(d => {
                        options += `<option value="${d.name}" data-id="${d.id}">${d.name}</option>`;
                    });
                    $('#subdistrict').html(options).trigger('change');
                    $('#village').empty().append('<option value="">Pilih...</option>').trigger('change');
                }
            });
        });

        $('#subdistrict').on('change', function() {
            const districtId = $(this).find(':selected').data('id');
            if (!districtId) return;

            $.ajax({
                url: `${base_url}/villages/${districtId}.json`,
                type: 'GET',
                success: function(villages) {
                    let options = '<option value="">Pilih Kelurahan</option>';
                    villages.forEach(v => {
                        options += `<option value="${v.name}" data-id="${v.id}">${v.name}</option>`;
                    });
                    $('#village').html(options).trigger('change');
                }
            });
        });

        // Cancel Button Confirmation
        $('#btn-cancel').on('click', function() {
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Data yang telah diisi akan hilang.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, batalkan!',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '{{ route('patients.index') }}';
                }
            });
        });

        // Form Submit with Confirmation and Validation Warning
        $('#form-patient').on('submit', function(e) {
            e.preventDefault();
            
            const form = this;
            
            // 1. Check for empty required fields
            if (!form.checkValidity()) {
                form.reportValidity(); // Show native browser warning
                Swal.fire({
                    icon: 'warning',
                    title: 'Data Belum Lengkap',
                    text: 'Silakan isi semua kolom yang bertanda wajib (required) terlebih dahulu.',
                });
                return;
            }

            // 2. Confirmation before Save
            Swal.fire({
                title: 'Simpan Data Pasien?',
                text: "Pastikan semua data yang diisi sudah benar.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#696cff',
                cancelButtonColor: '#8592a3',
                confirmButtonText: 'Ya, Simpan',
                cancelButtonText: 'Cek Kembali'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Start AJAX Loading
                    Swal.fire({
                        title: 'Mohon Tunggu',
                        text: 'Sedang menyimpan data...',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    const formData = $(form).serialize();
                    
                    $.ajax({
                        url: '{{ route('api.patients.store') }}',
                        type: 'POST',
                        data: formData,
                        dataType: 'json',
                        success: function(response) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: 'Data pasien berhasil disimpan dengan nomor RM: ' + response.data.medical_record_number,
                            }).then(() => {
                                window.location.href = '{{ route('patients.index') }}';
                            });
                        },
                        error: function(xhr) {
                            let errorMessage = 'Terjadi kesalahan sistem.';
                            if (xhr.status === 422) {
                                handleValidationErrors('#form-patient', xhr.responseJSON.errors);
                                errorMessage = 'Pastikan semua form diisi dengan benar.';
                            }
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal Menyimpan!',
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
