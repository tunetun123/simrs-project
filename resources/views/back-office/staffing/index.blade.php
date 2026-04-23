@extends('layouts.main')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Back Office /</span> Manajemen Kepegawaian</h4>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="nav-align-top mb-4">
        <ul class="nav nav-pills mb-3" role="tablist">
            <li class="nav-item">
                <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#tab-employees" aria-controls="tab-employees" aria-selected="true">
                    <i class="bx bx-group me-1"></i> Semua Pegawai
                </button>
            </li>
            <li class="nav-item">
                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#tab-doctors" aria-controls="tab-doctors" aria-selected="false">
                    <i class="bx bx-plus-medical me-1"></i> Dokter
                </button>
            </li>
            <li class="nav-item">
                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#tab-nurses" aria-controls="tab-nurses" aria-selected="false">
                    <i class="bx bx-first-aid me-1"></i> Perawat
                </button>
            </li>
            <li class="nav-item">
                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#tab-departments" aria-controls="tab-departments" aria-selected="false">
                    <i class="bx bx-buildings me-1"></i> Departemen
                </button>
            </li>
            <li class="nav-item">
                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#tab-positions" aria-controls="tab-positions" aria-selected="false">
                    <i class="bx bx-briefcase me-1"></i> Jabatan
                </button>
            </li>
        </ul>
        <div class="tab-content p-0 bg-transparent shadow-none">
            <!-- Tab Semua Pegawai -->
            <div class="tab-pane fade show active" id="tab-employees" role="tabpanel">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Daftar Semua Pegawai</h5>
                        <a href="{{ route('staffing.create') }}" class="btn btn-primary">
                            <span class="tf-icons bx bx-user-plus"></span>&nbsp; Tambah Pegawai
                        </a>
                    </div>
                    <div class="table-responsive text-nowrap p-3">
                        <table class="table table-hover datatable" id="table-employees">
                            <thead>
                                <tr>
                                    <th>Kode</th>
                                    <th>Nama Lengkap</th>
                                    <th>Departemen</th>
                                    <th>Jabatan</th>
                                    <th>Gender</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($employees as $employee)
                                <tr>
                                    <td><strong>{{ $employee->employee_code }}</strong></td>
                                    <td>{{ $employee->full_name }}</td>
                                    <td>{{ $employee->department->name ?? '-' }}</td>
                                    <td>
                                        {{ $employee->position->name ?? '-' }}<br>
                                        <small class="text-primary fw-bold">{{ $employee->getProfessionType() }}</small>
                                    </td>
                                    <td>{{ ucfirst($employee->gender) }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('staffing.show', $employee->employee_code) }}" class="btn btn-sm btn-outline-info"><i class="bx bx-show"></i></a>
                                            <a href="{{ route('staffing.edit', $employee->employee_code) }}" class="btn btn-sm btn-outline-warning"><i class="bx bx-edit-alt"></i></a>
                                            <form action="{{ route('staffing.destroy', $employee->employee_code) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger btn-delete-confirm"><i class="bx bx-trash"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Tab Dokter -->
            <div class="tab-pane fade" id="tab-doctors" role="tabpanel">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Daftar Dokter Pasien</h5>
                    </div>
                    <div class="table-responsive text-nowrap p-3">
                        <table class="table table-hover datatable" id="table-doctors">
                            <thead>
                                <tr>
                                    <th>Nama Dokter</th>
                                    <th>Spesialisasi</th>
                                    <th>No. SIP</th>
                                    <th>Status Klinik</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($doctors as $doctor)
                                <tr>
                                    <td><strong>{{ $doctor->employee->full_name ?? '-' }}</strong></td>
                                    <td>{{ $doctor->specialization }}</td>
                                    <td>{{ $doctor->sip_number }}</td>
                                    <td>
                                        <span class="badge bg-label-{{ $doctor->status == 'aktif' ? 'success' : ($doctor->status == 'cuti' ? 'warning' : 'danger') }}">
                                            {{ ucfirst($doctor->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-outline-warning btn-edit-doctor" 
                                            data-code="{{ $doctor->employee_code }}"
                                            data-spec="{{ $doctor->specialization }}"
                                            data-sip="{{ $doctor->sip_number }}"
                                            data-status="{{ $doctor->status }}">
                                            <i class="bx bx-edit-alt"></i>
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Tab Perawat -->
            <div class="tab-pane fade" id="tab-nurses" role="tabpanel">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Daftar Tenaga Perawat</h5>
                    </div>
                    <div class="table-responsive text-nowrap p-3">
                        <table class="table table-hover datatable" id="table-nurses">
                            <thead>
                                <tr>
                                    <th>Nama Perawat</th>
                                    <th>No. STR</th>
                                    <th>Status Klinik</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($nurses as $nurse)
                                <tr>
                                    <td><strong>{{ $nurse->employee->full_name ?? '-' }}</strong></td>
                                    <td>{{ $nurse->str_number }}</td>
                                    <td>
                                        <span class="badge bg-label-{{ $nurse->status == 'aktif' ? 'success' : ($nurse->status == 'cuti' ? 'warning' : 'danger') }}">
                                            {{ ucfirst($nurse->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-outline-warning btn-edit-nurse" 
                                            data-code="{{ $nurse->employee_code }}"
                                            data-str="{{ $nurse->str_number }}"
                                            data-status="{{ $nurse->status }}">
                                            <i class="bx bx-edit-alt"></i>
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Tab Departemen -->
            <div class="tab-pane fade" id="tab-departments" role="tabpanel">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Master Departemen</h5>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAddDepartment">
                            <span class="tf-icons bx bx-plus"></span>&nbsp; Tambah Departemen
                        </button>
                    </div>
                    <div class="table-responsive text-nowrap p-3">
                        <table class="table table-hover datatable" id="table-departments">
                            <thead>
                                <tr>
                                    <th>Kode</th>
                                    <th>Nama Departemen</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($departments as $dept)
                                <tr>
                                    <td>{{ $dept->department_code }}</td>
                                    <td>{{ $dept->name }}</td>
                                    <td>
                                        <span class="badge bg-label-{{ $dept->status == 'active' ? 'success' : 'danger' }}">
                                            {{ ucfirst($dept->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-outline-warning btn-edit-dept" data-code="{{ $dept->department_code }}" data-name="{{ $dept->name }}" data-status="{{ $dept->status }}"><i class="bx bx-edit-alt"></i></button>
                                            <button type="button" class="btn btn-sm btn-outline-danger btn-delete-dept" data-code="{{ $dept->department_code }}"><i class="bx bx-trash"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Tab Jabatan -->
            <div class="tab-pane fade" id="tab-positions" role="tabpanel">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Master Jabatan</h5>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAddPosition">
                            <span class="tf-icons bx bx-plus"></span>&nbsp; Tambah Jabatan
                        </button>
                    </div>
                    <div class="table-responsive text-nowrap p-3">
                        <table class="table table-hover datatable" id="table-positions">
                            <thead>
                                <tr>
                                    <th>Kode</th>
                                    <th>Nama Jabatan</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($positions as $pos)
                                <tr>
                                    <td>{{ $pos->position_code }}</td>
                                    <td>{{ $pos->name }}</td>
                                    <td>
                                        <span class="badge bg-label-{{ $pos->status == 'active' ? 'success' : 'danger' }}">
                                            {{ ucfirst($pos->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-outline-warning btn-edit-pos" data-code="{{ $pos->position_code }}" data-name="{{ $pos->name }}" data-status="{{ $pos->status }}"><i class="bx bx-edit-alt"></i></button>
                                            <button type="button" class="btn btn-sm btn-outline-danger btn-delete-pos" data-code="{{ $pos->position_code }}"><i class="bx bx-trash"></i></button>
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

<!-- Modal Edit Master Data -->
<div class="modal fade" id="modalEditDepartment" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Departemen</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form-edit-dept">
                @csrf
                @method('PUT')
                <input type="hidden" name="department_code" id="edit_dept_code">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Departemen <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="edit_dept_name" class="form-control" required>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" id="edit_dept_status" class="form-select">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalEditPosition" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Jabatan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form-edit-pos">
                @csrf
                @method('PUT')
                <input type="hidden" name="position_code" id="edit_pos_code">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Jabatan <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="edit_pos_name" class="form-control" required>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" id="edit_pos_status" class="form-select">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalEditDoctor" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Status & Data Dokter</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form-edit-doctor">
                @csrf
                @method('PUT')
                <input type="hidden" id="doctor_emp_code" name="employee_code">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Spesialisasi <span class="text-danger">*</span></label>
                        <input type="text" name="specialization" id="doctor_spec" class="form-control" required>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">No. SIP <span class="text-danger">*</span></label>
                        <input type="text" name="sip_number" id="doctor_sip" class="form-control" required>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status Klinik</label>
                        <select name="status" id="doctor_status" class="form-select">
                            <option value="aktif">Aktif</option>
                            <option value="cuti">Cuti</option>
                            <option value="non-aktif">Non-Aktif</option>
                        </select>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update Data</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Add Data -->
<div class="modal fade" id="modalAddDepartment" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Departemen</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form-add-dept">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Kode Departemen <span class="text-danger">*</span></label>
                        <input type="text" name="department_code" class="form-control" placeholder="Contoh: HRD, IT, MED" required>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Departemen <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" placeholder="Nama Lengkap Departemen" required>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalAddPosition" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Jabatan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form-add-pos">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Kode Jabatan <span class="text-danger">*</span></label>
                        <input type="text" name="position_code" class="form-control" placeholder="Contoh: DOC, NUR, ADM" required>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Jabatan <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" placeholder="Nama Lengkap Jabatan" required>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
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
            language: { url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/id.json' }
        });

        // Generic Validation Handler

        // ---------------- DOKTER ----------------
        $(document).on('click', '.btn-edit-doctor', function() {
            $('#doctor_emp_code').val($(this).data('code'));
            $('#doctor_spec').val($(this).data('spec'));
            $('#doctor_sip').val($(this).data('sip'));
            $('#doctor_status').val($(this).data('status'));
            $('#modalEditDoctor').modal('show');
        });

        $('#form-edit-doctor').on('submit', function(e) {
            e.preventDefault();
            const form = this;
            const code = $('#doctor_emp_code').val();
            $.ajax({
                url: `/api/back-office/doctors/${code}`,
                type: 'POST',
                data: $(this).serialize(),
                success: function() {
                    $('#modalEditDoctor').modal('hide');
                    Swal.fire('Berhasil!', 'Data dokter diupdate.', 'success').then(() => location.reload());
                },
                error: function(xhr) {
                    if(xhr.status === 422) handleValidationErrors(form, xhr.responseJSON.errors);
                    else Swal.fire('Gagal!', 'Terjadi kesalahan sistem.', 'error');
                }
            });
        });

        // ---------------- DEPARTEMEN ----------------
        $('#form-add-dept').on('submit', function(e) {
            e.preventDefault();
            const form = this;
            $.ajax({
                url: '/api/back-office/departments',
                type: 'POST',
                data: $(this).serialize() + '&status=active',
                success: function() {
                    $('#modalAddDepartment').modal('hide');
                    Swal.fire('Berhasil!', 'Departemen ditambahkan.', 'success').then(() => location.reload());
                },
                error: function(xhr) {
                    if(xhr.status === 422) handleValidationErrors(form, xhr.responseJSON.errors);
                    else Swal.fire('Gagal!', 'Terjadi kesalahan sistem.', 'error');
                }
            });
        });

        $(document).on('click', '.btn-edit-dept', function() {
            $('#edit_dept_code').val($(this).data('code'));
            $('#edit_dept_name').val($(this).data('name'));
            $('#edit_dept_status').val($(this).data('status'));
            $('#modalEditDepartment').modal('show');
        });

        $('#form-edit-dept').on('submit', function(e) {
            e.preventDefault();
            const form = this;
            const code = $('#edit_dept_code').val();
            $.ajax({
                url: `/api/back-office/departments/${code}`,
                type: 'POST',
                data: $(this).serialize(),
                success: function() {
                    $('#modalEditDepartment').modal('hide');
                    Swal.fire('Berhasil!', 'Departemen diupdate.', 'success').then(() => location.reload());
                },
                error: function(xhr) {
                    if(xhr.status === 422) handleValidationErrors(form, xhr.responseJSON.errors);
                    else Swal.fire('Gagal!', 'Terjadi kesalahan sistem.', 'error');
                }
            });
        });

        $(document).on('click', '.btn-delete-dept', function() {
            const code = $(this).data('code');
            Swal.fire({
                title: 'Hapus Departemen?',
                text: "Pastikan tidak ada pegawai yang terikat.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/api/back-office/departments/${code}`,
                        type: 'DELETE',
                        success: function() {
                            Swal.fire('Terhapus!', 'Departemen dihapus.', 'success').then(() => location.reload());
                        },
                        error: function(xhr) {
                            Swal.fire('Gagal!', xhr.responseJSON.message || 'Gagal menghapus data.', 'error');
                        }
                    });
                }
            });
        });

        // ---------------- JABATAN ----------------
        $('#form-add-pos').on('submit', function(e) {
            e.preventDefault();
            const form = this;
            $.ajax({
                url: '/api/back-office/positions',
                type: 'POST',
                data: $(this).serialize() + '&status=active',
                success: function() {
                    $('#modalAddPosition').modal('hide');
                    Swal.fire('Berhasil!', 'Jabatan ditambahkan.', 'success').then(() => location.reload());
                },
                error: function(xhr) {
                    if(xhr.status === 422) handleValidationErrors(form, xhr.responseJSON.errors);
                    else Swal.fire('Gagal!', 'Terjadi kesalahan sistem.', 'error');
                }
            });
        });

        $(document).on('click', '.btn-edit-pos', function() {
            $('#edit_pos_code').val($(this).data('code'));
            $('#edit_pos_name').val($(this).data('name'));
            $('#edit_pos_status').val($(this).data('status'));
            $('#modalEditPosition').modal('show');
        });

        $('#form-edit-pos').on('submit', function(e) {
            e.preventDefault();
            const form = this;
            const code = $('#edit_pos_code').val();
            $.ajax({
                url: `/api/back-office/positions/${code}`,
                type: 'POST',
                data: $(this).serialize(),
                success: function() {
                    $('#modalEditPosition').modal('hide');
                    Swal.fire('Berhasil!', 'Jabatan diupdate.', 'success').then(() => location.reload());
                },
                error: function(xhr) {
                    if(xhr.status === 422) handleValidationErrors(form, xhr.responseJSON.errors);
                    else Swal.fire('Gagal!', 'Terjadi kesalahan sistem.', 'error');
                }
            });
        });

        $(document).on('click', '.btn-delete-pos', function() {
            const code = $(this).data('code');
            Swal.fire({
                title: 'Hapus Jabatan?',
                text: "Pastikan tidak ada pegawai yang terikat.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/api/back-office/positions/${code}`,
                        type: 'DELETE',
                        success: function() {
                            Swal.fire('Terhapus!', 'Jabatan dihapus.', 'success').then(() => location.reload());
                        },
                        error: function(xhr) {
                            Swal.fire('Gagal!', xhr.responseJSON.message || 'Gagal menghapus data.', 'error');
                        }
                    });
                }
            });
        });
    });
</script>
@endpush
