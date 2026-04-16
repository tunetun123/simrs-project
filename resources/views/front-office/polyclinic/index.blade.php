@extends('layouts.main')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Master Data /</span> Jadwal Poliklinik</h4>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Daftar Jadwal Operasional</h5>
            <a href="{{ route('polyclinics.create') }}" class="btn btn-primary">
                <span class="tf-icons bx bx-calendar-plus"></span>&nbsp; Buat Jadwal Baru
            </a>
        </div>
        <div class="table-responsive text-nowrap p-3">
            <table class="table table-hover" id="table-schedules">
                <thead>
                    <tr>
                        <th>Poliklinik</th>
                        <th>Hari</th>
                        <th>Jam</th>
                        <th>Dokter</th>
                        <th>Asuransi</th>
                        <th>Kuota</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
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
                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus jadwal ini?')" title="Hapus">
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
@endsection

@push('myscript')
<script>
    $(document).ready(function() {
        $('#table-schedules').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/id.json',
            },
        });
    });
</script>
@endpush
