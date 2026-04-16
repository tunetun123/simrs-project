@extends('layouts.main')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Front Office /</span> Asuransi</h4>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Daftar Asuransi</h5>
            <a href="{{ route('insurances.create') }}" class="btn btn-primary">
                <span class="tf-icons bx bx-plus"></span>&nbsp; Tambah Asuransi
            </a>
        </div>
        <div class="table-responsive text-nowrap p-3">
            <table class="table table-hover" id="table-insurances">
                <thead>
                    <tr>
                        <th>Kode Asuransi</th>
                        <th>Nama Asuransi</th>
                        <th>Kontak</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach($insurances as $insurance)
                    <tr>
                        <td><strong>{{ $insurance->insurance_code }}</strong></td>
                        <td>{{ $insurance->name }}</td>
                        <td>{{ $insurance->contact }}</td>
                        <td>
                            <span class="badge bg-label-{{ $insurance->status == 'active' ? 'success' : 'danger' }}">
                                {{ ucfirst($insurance->status) }}
                            </span>
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('insurances.show', $insurance->insurance_code) }}" class="btn btn-sm btn-outline-info" title="Detail">
                                    <i class="bx bx-show-alt"></i>
                                </a>
                                <a href="{{ route('insurances.edit', $insurance->insurance_code) }}" class="btn btn-sm btn-outline-warning" title="Edit">
                                    <i class="bx bx-edit-alt"></i>
                                </a>
                                <form action="{{ route('insurances.destroy', $insurance->insurance_code) }}" method="POST" class="d-inline">
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
        $('#table-insurances').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/id.json',
            },
        });
    });
</script>
@endpush
