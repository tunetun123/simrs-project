@extends('layouts.main')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Front Office /</span> Pasien</h4>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Daftar Pasien</h5>
            <a href="{{ route('patients.create') }}" class="btn btn-primary">
                <span class="tf-icons bx bx-plus"></span>&nbsp; Tambah Pasien
            </a>
        </div>
        <div class="table-responsive text-nowrap p-3">
            <table class="table table-hover" id="table-patients">
                <thead>
                    <tr>
                        <th>No. RM</th>
                        <th>Nama Lengkap</th>
                        <th>NIK</th>
                        <th>Jenis Kelamin</th>
                        <th>Tgl Lahir</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    <tr>
                        <td><strong>000001</strong></td>
                        <td>John Doe</td>
                        <td>1234567890123456</td>
                        <td>Laki-laki</td>
                        <td>01-01-1990</td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('patients.show', 1) }}" class="btn btn-sm btn-outline-info" title="Detail">
                                    <i class="bx bx-show-alt"></i>
                                </a>
                                <a href="{{ route('patients.edit', 1) }}" class="btn btn-sm btn-outline-warning" title="Edit">
                                    <i class="bx bx-edit-alt"></i>
                                </a>
                                <form action="{{ route('patients.destroy', 1) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Apakah anda yakin?')" title="Hapus">
                                        <i class="bx bx-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('myscript')
<script>
    $(document).ready(function() {
        $('#table-patients').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/id.json',
            },
        });
    });
</script>
@endpush
