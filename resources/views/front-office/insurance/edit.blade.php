@extends('layouts.main')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Front Office / Asuransi /</span> Edit
    </h4>

    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Form Edit Data Asuransi</h5>
                    <small class="text-muted float-end">Kode: {{ $insurance->insurance_code }}</small>
                </div>
                <div class="card-body">
                    <form id="form-edit-insurance" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label" for="insurance_code">Kode Asuransi</label>
                            <input type="text" class="form-control" id="insurance_code" value="{{ $insurance->insurance_code }}" disabled />
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="name">Nama Asuransi</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $insurance->name }}" required />
                        </div>

                        <div class="mb-3">
                            <label class="form-label d-block" for="logo">Logo Asuransi</label>
                            @if($insurance->logo)
                                <img src="{{ asset('storage/' . $insurance->logo) }}" alt="Logo" class="img-thumbnail mb-2" style="max-height: 100px;">
                            @endif
                            <input type="file" class="form-control" id="logo" name="logo" accept="image/*" />
                            <small class="text-muted">Kosongkan jika tidak ingin mengubah logo. Format: JPG, PNG, GIF. Maks: 2MB</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="contact">Kontak / Telepon</label>
                            <input type="text" class="form-control" id="contact" name="contact" value="{{ $insurance->contact }}" required />
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="address">Alamat <span class="text-danger">*</span></label>
                            <textarea id="address" class="form-control" name="address" required>{{ $insurance->address }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="status">Status <span class="text-danger">*</span></label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="active" {{ $insurance->status == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ $insurance->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary me-2">Update Asuransi</button>
                            <a href="{{ route('insurances.index') }}" class="btn btn-outline-secondary">Batal</a>
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
        $('#form-edit-insurance').on('submit', function(e) {
            e.preventDefault();
            
            const form = this;
            
            if (!form.checkValidity()) {
                form.reportValidity();
                return;
            }

            Swal.fire({
                title: 'Update Data Asuransi?',
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

                    const formData = new FormData(form);
                    
                    $.ajax({
                        url: '{{ route('api.insurances.update', $insurance->insurance_code) }}',
                        type: 'POST', // Use POST with _method=PUT for multipart support in PHP/Laravel
                        data: formData,
                        processData: false,
                        contentType: false,
                        dataType: 'json',
                        success: function(response) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: 'Data asuransi berhasil diperbarui.',
                            }).then(() => {
                                window.location.href = '{{ route('insurances.index') }}';
                            });
                        },
                        error: function(xhr) {
                            let errorMessage = 'Terjadi kesalahan sistem.';
                            if (xhr.status === 422) {
                                handleValidationErrors('#form-edit-insurance', xhr.responseJSON.errors);
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
