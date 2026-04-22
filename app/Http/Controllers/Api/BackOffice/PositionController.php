<?php

namespace App\Http\Controllers\Api\BackOffice;

use App\Http\Controllers\Controller;
use App\Services\StaffingService;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    protected $staffingService;

    public function __construct(StaffingService $staffingService)
    {
        $this->staffingService = $staffingService;
    }

    public function index()
    {
        $positions = $this->staffingService->getAllPositions();
        return response()->json(['data' => $positions]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'position_code' => 'required|string|max:255|unique:positions,position_code',
            'name' => 'required|string|max:255',
            'status' => 'required|in:active,inactive',
        ], [
            'required' => ':attribute wajib diisi.',
            'unique' => ':attribute sudah digunakan.',
            'in' => ':attribute tidak valid.'
        ], [
            'position_code' => 'Kode Jabatan',
            'name' => 'Nama Jabatan',
            'status' => 'Status'
        ]);

        $position = $this->staffingService->createPosition($validated);
        return response()->json(['data' => $position], 201);
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
            'name' => 'Nama Jabatan',
            'status' => 'Status'
        ]);

        $position = $this->staffingService->updatePosition($id, $validated);
        return response()->json(['data' => $position]);
    }

    public function destroy($id)
    {
        // Check if any employee is using this position
        if (\App\Models\Employee::where('position_code', $id)->exists()) {
            return response()->json(['message' => 'Jabatan tidak bisa dihapus karena masih digunakan oleh pegawai.'], 422);
        }

        $this->staffingService->deletePosition($id);
        return response()->json(['message' => 'Position deleted successfully.']);
    }
}
