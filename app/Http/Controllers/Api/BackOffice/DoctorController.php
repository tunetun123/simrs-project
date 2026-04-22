<?php

namespace App\Http\Controllers\Api\BackOffice;

use App\Http\Controllers\Controller;
use App\Services\StaffingService;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    protected $staffingService;

    public function __construct(StaffingService $staffingService)
    {
        $this->staffingService = $staffingService;
    }

    public function index()
    {
        $doctors = $this->staffingService->getAllDoctors();
        return response()->json(['data' => $doctors]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'employee_code' => 'required|exists:employees,employee_code|unique:doctors,employee_code',
            'specialization' => 'required|string|max:255',
            'sip_number' => 'required|string|max:255',
            'status' => 'required|in:aktif,cuti,non-aktif',
        ], [
            'required' => ':attribute wajib diisi.',
            'unique' => 'Data profesi dokter untuk pegawai ini sudah ada.',
            'exists' => 'Pegawai tidak ditemukan.',
            'in' => 'Status tidak valid.'
        ], [
            'specialization' => 'Spesialisasi',
            'sip_number' => 'Nomor SIP',
            'status' => 'Status Klinik'
        ]);

        $doctor = $this->staffingService->createDoctor($validated);
        return response()->json(['data' => $doctor], 201);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'specialization' => 'required|string|max:255',
            'sip_number' => 'required|string|max:255',
            'status' => 'required|in:aktif,cuti,non-aktif',
        ], [
            'required' => ':attribute wajib diisi.',
            'in' => 'Status tidak valid.'
        ], [
            'specialization' => 'Spesialisasi',
            'sip_number' => 'Nomor SIP',
            'status' => 'Status Klinik'
        ]);

        $doctor = $this->staffingService->updateDoctor($id, $validated);
        return response()->json(['data' => $doctor]);
    }
}
