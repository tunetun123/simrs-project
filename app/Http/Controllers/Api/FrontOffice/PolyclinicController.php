<?php

namespace App\Http\Controllers\Api\FrontOffice;

use App\Http\Controllers\Controller;
use App\Http\Resources\PolyclinicResource;
use App\Services\PolyclinicService;
use Illuminate\Http\Request;

class PolyclinicController extends Controller
{
    protected $polyclinicService;

    public function __construct(PolyclinicService $polyclinicService)
    {
        $this->polyclinicService = $polyclinicService;
    }

    public function index()
    {
        $polyclinics = $this->polyclinicService->getAllPolyclinics();
        return PolyclinicResource::collection($polyclinics);
    }

    // Create Master Polyclinic
    public function store(Request $request)
    {
        $validated = $request->validate([
            'polyclinic_code' => 'required|string|unique:polyclinics,polyclinic_code',
            'name' => 'required|string',
            'status' => 'required|in:active,inactive',
        ]);

        $polyclinic = $this->polyclinicService->createPolyclinic($validated);
        return new PolyclinicResource($polyclinic);
    }

    // Create Schedules
    public function storeSchedule(Request $request)
    {
        $validated = $request->validate([
            'polyclinic_code' => 'required|exists:polyclinics,polyclinic_code',
            'doctor_code' => 'required|exists:employees,employee_code',
            'insurance_code' => 'required|exists:insurances,insurance_code',
            'schedules' => 'required|array|min:1',
            'schedules.*.day' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'schedules.*.start_time' => 'required',
            'schedules.*.end_time' => 'required',
            'schedules.*.patient_quota' => 'required|integer|min:1',
        ]);

        $schedules = $this->polyclinicService->createSchedules($validated);
        return response()->json(['message' => 'Schedules created successfully', 'data' => $schedules], 201);
    }

    public function destroySchedule($id)
    {
        $this->polyclinicService->deleteSchedule($id);
        return response()->json(['message' => 'Schedule deleted successfully.']);
    }
}
