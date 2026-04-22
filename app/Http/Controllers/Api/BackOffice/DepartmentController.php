<?php

namespace App\Http\Controllers\Api\BackOffice;

use App\Http\Controllers\Controller;
use App\Services\StaffingService;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    protected $staffingService;

    public function __construct(StaffingService $staffingService)
    {
        $this->staffingService = $staffingService;
    }

    public function index()
    {
        $departments = $this->staffingService->getAllDepartments();
        return response()->json(['data' => $departments]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'department_code' => 'required|string|max:255|unique:departments,department_code',
            'name' => 'required|string|max:255',
            'status' => 'required|in:active,inactive',
        ], [
            'required' => ':attribute wajib diisi.',
            'unique' => ':attribute sudah digunakan.',
            'in' => ':attribute tidak valid.'
        ], [
            'department_code' => 'Kode Departemen',
            'name' => 'Nama Departemen',
            'status' => 'Status'
        ]);

        $department = $this->staffingService->createDepartment($validated);
        return response()->json(['data' => $department], 201);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|in:active,inactive',
        ], [
            'required' => ':attribute wajib diisi.',
            'in' => ':attribute tidak valid.'
        ], [
            'name' => 'Nama Departemen',
            'status' => 'Status'
        ]);

        $department = $this->staffingService->updateDepartment($id, $validated);
        return response()->json(['data' => $department]);
    }

    public function destroy($id)
    {
        $department = $this->staffingService->getAllDepartments()->where('department_code', $id)->first();
        // Check if any employee is using this department
        if (\App\Models\Employee::where('department_code', $id)->exists()) {
            return response()->json(['message' => 'Departemen tidak bisa dihapus karena masih digunakan oleh pegawai.'], 422);
        }

        $this->staffingService->deleteDepartment($id);
        return response()->json(['message' => 'Department deleted successfully.']);
    }
}
