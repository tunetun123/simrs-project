@extends('layouts.main')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Front Office /</span> Pasien</h4>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

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
                    @foreach($patients as $patient)
                    <tr>
                        <td><strong>{{ $patient->medical_record_number }}</strong></td>
                        <td>{{ $patient->full_name }}</td>
                        <td>{{ $patient->nik }}</td>
                        <td>{{ $patient->gender == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                        <td>{{ \Carbon\Carbon::parse($patient->birth_date)->format('d-m-Y') }}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('patients.show', $patient->medical_record_number) }}" class="btn btn-sm btn-outline-info" title="Detail">
                                    <i class="bx bx-show-alt"></i>
                                </a>
                                <a href="{{ route('patients.edit', $patient->medical_record_number) }}" class="btn btn-sm btn-outline-warning" title="Edit">
                                    <i class="bx bx-edit-alt"></i>
                                </a>
                                <form action="{{ route('patients.destroy', $patient->medical_record_number) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Apakah anda yakin?')" title="Hapus">
                                        <i class="bx bx-trash"></i>
                                    </button>
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
