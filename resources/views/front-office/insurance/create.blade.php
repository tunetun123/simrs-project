@extends('layouts.main')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Front Office / Asuransi /</span> Tambah Baru
    </h4>

    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Form Data Asuransi</h5>
                </div>
                <div class="card-body">
                    <form id="form-insurance" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="insurance_code">Kode Asuransi</label>
                            <input type="text" class="form-control" id="insurance_code" name="insurance_code" placeholder="Contoh: BPJS, AIA, AXA" required />
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="name">Nama Asuransi</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan Nama Asuransi" required />
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="logo">Logo Asuransi</label>
                            <input type="file" class="form-control" id="logo" name="logo" accept="image/*" />
                            <small class="text-muted">Format: JPG, PNG, GIF. Maks: 2MB</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="contact">Kontak / Telepon</label>
                            <input type="text" class="form-control" id="contact" name="contact" placeholder="Masukkan Nomor Kontak" required />
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="address">Alamat</label>
                            <textarea id="address" class="form-control" name="address" placeholder="Masukkan Alamat Kantor" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="status">Status</label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary me-2">Simpan Asuransi</button>
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
        $('#form-insurance').on('submit', function(e) {
            e.preventDefault();
            
            const form = this;
            
            if (!form.checkValidity()) {
                form.reportValidity();
                return;
            }

            Swal.fire({
                title: 'Simpan Data Asuransi?',
                text: "Pastikan semua data sudah benar.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya, Simpan',
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
                        url: '{{ route('api.insurances.store') }}',
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        dataType: 'json',
                        success: function(response) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: 'Data asuransi berhasil disimpan.',
                            }).then(() => {
                                window.location.href = '{{ route('insurances.index') }}';
                            });
                        },
                        error: function(xhr) {
                            let errorMessage = 'Terjadi kesalahan sistem.';
                            if (xhr.status === 422) {
                                errorMessage = Object.values(xhr.responseJSON.errors).map(e => e[0]).join('<br>');
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
