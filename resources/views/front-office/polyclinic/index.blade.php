@extends('layouts.main')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Master Data /</span> Manajemen Poliklinik</h4>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="nav-align-top mb-4">
        <ul class="nav nav-pills mb-3" role="tablist">
            <li class="nav-item">
                <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#tab-schedules" aria-controls="tab-schedules" aria-selected="true">
                    <i class="bx bx-calendar me-1"></i> Jadwal Operasional
                </button>
            </li>
            <li class="nav-item">
                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#tab-master" aria-controls="tab-master" aria-selected="false">
                    <i class="bx bx-hospital me-1"></i> Master Poliklinik
                </button>
            </li>
        </ul>
        <div class="tab-content p-0 bg-transparent shadow-none">
            <!-- Tab Jadwal Operasional -->
            <div class="tab-pane fade show active" id="tab-schedules" role="tabpanel">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Daftar Jadwal Layanan</h5>
                        <a href="{{ route('polyclinics.create') }}" class="btn btn-primary">
                            <span class="tf-icons bx bx-calendar-plus"></span>&nbsp; Buat Jadwal Baru
                        </a>
                    </div>
                    <div class="table-responsive text-nowrap p-3">
                        <table class="table table-hover datatable" id="table-schedules">
                            <thead>
                                <tr>
                                    <th>Poliklinik</th>
                                    <th>Hari</th>
                                    <th>Jam</th>
                                    <th>Dokter</th>
                                    <th>Asuransi</th>
                                    <th>Kuota</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($schedules as $schedule)
                                <tr>
                                    <td><strong>{{ $schedule->polyclinic->name }}</strong></td>
                                    <td><span class="badge bg-label-primary">{{ $schedule->day }}</span></td>
                                    <td>{{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}</td>
                                    <td>{{ $schedule->doctor->full_name ?? '-' }}</td>
                                    <td>{{ $schedule->insurance->name ?? '-' }}</td>
                                    <td>{{ $schedule->patient_quota }}</td>
                                    <td>
                                        <form action="{{ route('polyclinics.destroy', $schedule->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger btn-delete-confirm" title="Hapus Jadwal">
                                                <i class="bx bx-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Tab Master Poliklinik -->
            <div class="tab-pane fade" id="tab-master" role="tabpanel">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Daftar Unit Poliklinik</h5>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAddPolyclinic">
                            <span class="tf-icons bx bx-plus"></span>&nbsp; Tambah Unit Poli
                        </button>
                    </div>
                    <div class="table-responsive text-nowrap p-3">
                        <table class="table table-hover datatable" id="table-master">
                            <thead>
                                <tr>
                                    <th>Kode Poli</th>
                                    <th>Nama Poliklinik</th>
                                    <th>Status</th>
                                    <th>Dibuat Pada</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($polyclinics as $poli)
                                <tr>
                                    <td><strong>{{ $poli->polyclinic_code }}</strong></td>
                                    <td>{{ $poli->name }}</td>
                                    <td>
                                        <span class="badge bg-label-{{ $poli->status == 'active' ? 'success' : 'danger' }}">
                                            {{ ucfirst($poli->status) }}
                                        </span>
                                    </td>
                                    <td>{{ $poli->created_at->format('d/m/Y') }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-outline-warning btn-edit-master" 
                                                data-code="{{ $poli->polyclinic_code }}"
                                                data-name="{{ $poli->name }}"
                                                data-status="{{ $poli->status }}">
                                                <i class="bx bx-edit-alt"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-outline-danger btn-delete-master" 
                                                data-code="{{ $poli->polyclinic_code }}">
                                                <i class="bx bx-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Master Poliklinik -->
<div class="modal fade" id="modalEditPolyclinic" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Master Poliklinik</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form-edit-master">
                @csrf
                @method('PUT')
                <input type="hidden" id="edit_code" name="polyclinic_code">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Kode Poliklinik</label>
                        <input type="text" id="display_edit_code" class="form-control" disabled />
                    </div>
                    <div class="mb-3">
                        <label for="edit_name" class="form-label">Nama Poliklinik</label>
                        <input type="text" id="edit_name" name="name" class="form-control" required />
                    </div>
                    <div class="mb-3">
                        <label for="edit_status" class="form-label">Status</label>
                        <select id="edit_status" name="status" class="form-select">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Update Poli</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Tambah Master Poliklinik (Reuse dari create page logic) -->
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
                        <label for="new_polyclinic_code" class="form-label">Kode Poliklinik</label>
                        <input type="text" id="new_polyclinic_code" name="polyclinic_code" class="form-control" placeholder="Contoh: POLI-UMM" required />
                    </div>
                    <div class="mb-3">
                        <label for="new_name" class="form-label">Nama Poliklinik</label>
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
        $('.datatable').DataTable({
            language: { url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/id.json' },
        });

        // Handle Master Polyclinic Create
        $('#form-master-polyclinic').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: '{{ route('api.polyclinics.store') }}',
                type: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    Swal.fire('Berhasil!', 'Poliklinik master berhasil ditambahkan.', 'success').then(() => location.reload());
                },
                error: function(xhr) {
                    Swal.fire('Gagal!', xhr.responseJSON.message || 'Terjadi kesalahan.', 'error');
                }
            });
        });

        // Handle Edit Master Click
        $(document).on('click', '.btn-edit-master', function() {
            const code = $(this).data('code');
            const name = $(this).data('name');
            const status = $(this).data('status');

            $('#edit_code').val(code);
            $('#display_edit_code').val(code);
            $('#edit_name').val(name);
            $('#edit_status').val(status);
            
            $('#modalEditPolyclinic').modal('show');
        });

        // Handle Master Polyclinic Update
        $('#form-edit-master').on('submit', function(e) {
            e.preventDefault();
            const code = $('#edit_code').val();
            const url = '{{ route('api.polyclinics.update', ':code') }}'.replace(':code', code);

            $.ajax({
                url: url,
                type: 'POST', // POST with _method=PUT
                data: $(this).serialize(),
                success: function(response) {
                    Swal.fire('Berhasil!', 'Data poliklinik berhasil diperbarui.', 'success').then(() => location.reload());
                },
                error: function(xhr) {
                    Swal.fire('Gagal!', xhr.responseJSON.message || 'Terjadi kesalahan.', 'error');
                }
            });
        });

        // Handle Master Polyclinic Delete
        $(document).on('click', '.btn-delete-master', function() {
            const code = $(this).data('code');
            const url = '{{ route('api.polyclinics.destroy', ':code') }}'.replace(':code', code);

            Swal.fire({
                title: 'Hapus Master Poliklinik?',
                text: "Pastikan poliklinik ini tidak memiliki jadwal operasional aktif.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        success: function(response) {
                            Swal.fire('Terhapus!', response.message, 'success').then(() => location.reload());
                        },
                        error: function(xhr) {
                            Swal.fire('Gagal!', xhr.responseJSON.message || 'Terjadi kesalahan.', 'error');
                        }
                    });
                }
            });
        });
    });
</script>
@endpush
