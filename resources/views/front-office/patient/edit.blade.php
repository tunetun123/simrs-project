@extends('layouts.main')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Front Office /</span> Edit Data Pasien
    </h4>

    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Form Edit Pasien</h5>
                    <small class="text-muted float-end">Ubah Informasi Identitas</small>
                </div>
                <div class="card-body">
                    <form id="form-edit-patient">
                        @csrf
                        @method('PUT')
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label" for="medical_record_number">No. Rekam Medis</label>
                                <input type="text" class="form-control" value="{{ $patient->medical_record_number }}" disabled />
                                <input type="hidden" name="medical_record_number" value="{{ $patient->medical_record_number }}" />
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="ihs_number">Nomor IHS (SatuSehat)</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="ihs_number" name="ihs_number" value="{{ $patient->ihs_number }}" readonly />
                                    <button class="btn btn-outline-primary" type="button" id="btn-request-ihs">Request IHS</button>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="full_name">Nama Lengkap</label>
                            <input type="text" class="form-control" id="full_name" name="full_name" value="{{ $patient->full_name }}" required />
                        </div>

                        <div class="mb-3">
                            <div class="form-check form-switch mb-2">
                                <input class="form-check-input" type="checkbox" id="is_foreign" {{ $patient->passport_number ? 'checked' : '' }} />
                                <label class="form-check-label" for="is_foreign">Pasien Luar Negeri (WNA)</label>
                            </div>
                        </div>

                        <div class="mb-3 {{ $patient->passport_number ? 'd-none' : '' }}" id="nik_container">
                            <label class="form-label" for="nik">NIK</label>
                            <input type="text" class="form-control" id="nik" name="nik" value="{{ $patient->nik }}" {{ $patient->passport_number ? '' : 'required' }} />
                        </div>

                        <div class="mb-3 {{ $patient->passport_number ? '' : 'd-none' }}" id="passport_container">
                            <label class="form-label" for="passport_number">Nomor Passport</label>
                            <input type="text" class="form-control" id="passport_number" name="passport_number" value="{{ $patient->passport_number }}" {{ $patient->passport_number ? 'required' : '' }} />
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label" for="gender">Jenis Kelamin <span class="text-danger">*</span></label>
                                <select class="form-select" id="gender" name="gender" required>
                                    <option value="L" {{ $patient->gender == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="P" {{ $patient->gender == 'P' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="religion">Agama <span class="text-danger">*</span></label>
                                <select class="form-select" id="religion" name="religion" required>
                                    @php $religions = ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Budha', 'Khonghucu', 'Lainnya']; @endphp
                                    @foreach($religions as $r)
                                        <option value="{{ $r }}" {{ $patient->religion == $r ? 'selected' : '' }}>{{ $r }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="blood_type">Golongan Darah <span class="text-danger">*</span></label>
                                <select class="form-select" id="blood_type" name="blood_type" required>
                                    @php $bloods = ['-', 'A', 'B', 'AB', 'O']; @endphp
                                    @foreach($bloods as $b)
                                        <option value="{{ $b }}" {{ $patient->blood_type == $b ? 'selected' : '' }}>{{ $b }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label" for="birth_place">Tempat Lahir</label>
                                <input type="text" class="form-control" id="birth_place" name="birth_place" value="{{ $patient->birth_place }}" required />
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="birth_date">Tanggal Lahir</label>
                                <input type="date" class="form-control" id="birth_date" name="birth_date" value="{{ $patient->birth_date }}" required />
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="mothers_maiden_name">Nama Ibu Kandung</label>
                            <input type="text" class="form-control" id="mothers_maiden_name" name="mothers_maiden_name" value="{{ $patient->mothers_maiden_name }}" required />
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label" for="phone_number">No. Telepon</label>
                                <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ $patient->phone_number }}" required />
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="language">Bahasa</label>
                                <input type="text" class="form-control" id="language" name="language" value="{{ $patient->language }}" required />
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="address">Alamat Lengkap <span class="text-danger">*</span></label>
                            <textarea id="address" class="form-control" name="address" required>{{ $patient->address }}</textarea>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label" for="country">Negara <span class="text-danger">*</span></label>
                                <select class="form-select select2-location" id="country" name="country" required>
                                    <option value="Indonesia" {{ $patient->country == 'Indonesia' ? 'selected' : '' }}>Indonesia</option>
                                    <option value="Lainnya" {{ $patient->country != 'Indonesia' ? 'selected' : '' }}>Lainnya</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="province">Provinsi <span class="text-danger">*</span></label>
                                <select class="form-select select2-location" id="province" name="province" required>
                                    <option value="{{ $patient->province }}" selected>{{ $patient->province }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label" for="city">Kota / Kabupaten <span class="text-danger">*</span></label>
                                <select class="form-select select2-location" id="city" name="city" required>
                                    <option value="{{ $patient->city }}" selected>{{ $patient->city }}</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="subdistrict">Kecamatan <span class="text-danger">*</span></label>
                                <select class="form-select select2-location" id="subdistrict" name="subdistrict" required>
                                    <option value="{{ $patient->subdistrict }}" selected>{{ $patient->subdistrict }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label" for="village">Kelurahan / Desa <span class="text-danger">*</span></label>
                                <select class="form-select select2-location" id="village" name="village" required>
                                    <option value="{{ $patient->village }}" selected>{{ $patient->village }}</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label" for="rt">RT</label>
                                <input type="text" class="form-control" id="rt" name="rt" value="{{ $patient->rt }}" required />
                            </div>
                            <div class="col-md-2">
                                <label class="form-label" for="rw">RW</label>
                                <input type="text" class="form-control" id="rw" name="rw" value="{{ $patient->rw }}" required />
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="postal_code">Kode Pos</label>
                                <input type="text" class="form-control" id="postal_code" name="postal_code" value="{{ $patient->postal_code }}" required />
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="marital_status">Status Pernikahan <span class="text-danger">*</span></label>
                            <select class="form-select" id="marital_status" name="marital_status" required>
                                @php $statuses = ['Belum Kawin', 'Kawin', 'Cerai Hidup', 'Cerai Mati']; @endphp
                                @foreach($statuses as $s)
                                    <option value="{{ $s }}" {{ $patient->marital_status == $s ? 'selected' : '' }}>{{ $s }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary me-2">Update Data</button>
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
        $('.select2-location').select2({
            theme: 'bootstrap-5',
            tags: true,
            placeholder: 'Pilih atau ketik manual...',
            allowClear: true
        });

        $('#is_foreign').on('change', function() {
            if ($(this).is(':checked')) {
                $('#nik_container').addClass('d-none');
                $('#nik').removeAttr('required');
                $('#passport_container').removeClass('d-none');
                $('#passport_number').attr('required', true);
                $('#country').val('Lainnya').trigger('change');
            } else {
                $('#nik_container').removeClass('d-none');
                $('#nik').attr('required', true);
                $('#passport_container').addClass('d-none');
                $('#passport_number').removeAttr('required');
                $('#country').val('Indonesia').trigger('change');
            }
        });

        // Request IHS Logic
        $('#btn-request-ihs').on('click', function() {
            const isForeign = $('#is_foreign').is(':checked');
            const identitas = isForeign ? $('#passport_number').val() : $('#nik').val();
            if(!identitas) {
                Swal.fire('Peringatan', 'Identitas harus diisi!', 'warning');
                return;
            }
            Swal.fire('Info', 'Integrasi SatuSehat akan segera hadir.', 'info');
        });

        // Wilayah.id Integration
        const base_url = "https://www.emsifa.com/api-wilayah-indonesia/api";

        function loadProvinces() {
            $.ajax({
                url: `${base_url}/provinces.json`,
                type: 'GET',
                success: function(provinces) {
                    let currentProv = $('#province').val();
                    let options = '<option value="">Pilih Provinsi</option>';
                    provinces.forEach(p => {
                        options += `<option value="${p.name}" data-id="${p.id}" ${p.name == currentProv ? 'selected' : ''}>${p.name}</option>`;
                    });
                    $('#province').html(options).trigger('change');
                }
            });
        }

        $('#country').on('change', function() {
            if ($(this).val() === 'Indonesia') {
                loadProvinces();
            }
        });

        // Cascading Logic
        $('#province').on('change', function() {
            const provinceId = $(this).find(':selected').data('id');
            if (!provinceId) return;
            $.ajax({
                url: `${base_url}/regencies/${provinceId}.json`,
                type: 'GET',
                success: function(cities) {
                    let currentCity = $('#city').val();
                    let options = '<option value="">Pilih Kota</option>';
                    cities.forEach(c => {
                        options += `<option value="${c.name}" data-id="${c.id}" ${c.name == currentCity ? 'selected' : ''}>${c.name}</option>`;
                    });
                    $('#city').html(options).trigger('change');
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
                    let currentSub = $('#subdistrict').val();
                    let options = '<option value="">Pilih Kecamatan</option>';
                    districts.forEach(d => {
                        options += `<option value="${d.name}" data-id="${d.id}" ${d.name == currentSub ? 'selected' : ''}>${d.name}</option>`;
                    });
                    $('#subdistrict').html(options).trigger('change');
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
                    let currentVil = $('#village').val();
                    let options = '<option value="">Pilih Kelurahan</option>';
                    villages.forEach(v => {
                        options += `<option value="${v.name}" data-id="${v.id}" ${v.name == currentVil ? 'selected' : ''}>${v.name}</option>`;
                    });
                    $('#village').html(options).trigger('change');
                }
            });
        });

        if($('#country').val() === 'Indonesia') loadProvinces();

        // Confirmation & Submit
        $('#btn-cancel').on('click', function() {
            Swal.fire({
                title: 'Batal Edit?',
                text: "Perubahan tidak akan disimpan.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Kembali',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.isConfirmed) window.location.href = '{{ route('patients.index') }}';
            });
        });

        $('#form-edit-patient').on('submit', function(e) {
            e.preventDefault();
            if (!this.checkValidity()) {
                this.reportValidity();
                return;
            }

            Swal.fire({
                title: 'Update Data Pasien?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya, Update',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({ title: 'Mohon Tunggu', allowOutsideClick: false, didOpen: () => Swal.showLoading() });
                    
                    $.ajax({
                        url: '{{ route('api.patients.update', $patient->medical_record_number) }}',
                        type: 'POST',
                        data: $(this).serialize(),
                        success: function() {
                            Swal.fire('Berhasil!', 'Data pasien diperbarui.', 'success').then(() => {
                                window.location.href = '{{ route('patients.index') }}';
                            });
                        },
                        error: function(xhr) {
                            let msg = 'Error sistem.';
                            if (xhr.status === 422) {
                                handleValidationErrors('#form-edit-patient', xhr.responseJSON.errors);
                                msg = 'Pastikan semua form diisi dengan benar.';
                            }
                            Swal.fire('Gagal!', msg, 'error');
                        }
                    });
                }
            });
        });
    });
</script>
@endpush
