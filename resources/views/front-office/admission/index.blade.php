@extends('layouts.main')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Front Office /</span> Pendaftaran</h4>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Daftar Pendaftaran (Kunjungan)</h5>
            <a href="{{ route('admissions.create') }}" class="btn btn-primary">
                <span class="tf-icons bx bx-plus"></span>&nbsp; Tambah Pendaftaran
            </a>
        </div>
        <div class="table-responsive text-nowrap p-3">
            <table class="table table-hover" id="table-admissions">
                <thead>
                    <tr>
                        <th>No. Kunjungan</th>
                        <th>No. RM</th>
                        <th>Nama Pasien</th>
                        <th>Klinik / Unit</th>
                        <th>Tgl Pendaftaran</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach($admissions as $admission)
                    <tr>
                        <td><strong>{{ $admission->visit_number }}</strong></td>
                        <td>{{ $admission->medical_record_number }}</td>
                        <td>{{ $patientName = $admission->patient ? $admission->patient->full_name : 'Pasien tidak ditemukan' }}</td>
                        <td>{{ $admission->polyclinic ? $admission->polyclinic->name : '-' }}</td>
                        <td>{{ \Carbon\Carbon::parse($admission->visit_date)->format('d-m-Y H:i') }}</td>
                        <td>
                            @php
                                $statusClass = match($admission->visit_status) {
                                    'Terdaftar' => 'bg-label-primary',
                                    'Dilayani' => 'bg-label-info',
                                    'Selesai' => 'bg-label-success',
                                    'Rawat Inap' => 'bg-label-warning',
                                    default => 'bg-label-secondary'
                                };
                            @endphp
                            <span class="badge {{ $statusClass }} me-1">{{ $admission->visit_status }}</span>
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('admissions.show', $admission->visit_number) }}" class="btn btn-sm btn-outline-info" title="Detail">
                                    <i class="bx bx-show-alt"></i>
                                </a>
                                <a href="{{ route('admissions.edit', $admission->visit_number) }}" class="btn btn-sm btn-outline-warning" title="Edit">
                                    <i class="bx bx-edit-alt"></i>
                                </a>
                                <form action="{{ route('admissions.destroy', $admission->visit_number) }}" method="POST" class="d-inline">
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
        $('#table-admissions').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/id.json',
            },
        });
    });
</script>
@endpush
