<?php

namespace App\Http\Controllers\Api\BackOffice;

use App\Http\Controllers\Controller;
use App\Services\StaffingService;
use Illuminate\Http\Request;

class NurseController extends Controller
{
    protected $staffingService;

    public function __construct(StaffingService $staffingService)
    {
        $this->staffingService = $staffingService;
    }

    public function index()
    {
        $nurses = $this->staffingService->getAllNurses();
        return response()->json(['data' => $nurses]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'employee_code' => 'required|exists:employees,employee_code|unique:nurses,employee_code',
            'str_number' => 'required|string|max:255',
            'status' => 'required|in:aktif,cuti,non-aktif',
        ]);

        $nurse = $this->staffingService->createNurse($validated);
        return response()->json(['data' => $nurse], 201);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'str_number' => 'required|string|max:255',
            'status' => 'required|in:aktif,cuti,non-aktif',
        ]);

        $nurse = $this->staffingService->updateNurse($id, $validated);
        return response()->json(['data' => $nurse]);
    }
}
