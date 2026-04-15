<?php

namespace App\Http\Controllers\Api\FrontOffice;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePatientRequest;
use App\Http\Requests\UpdatePatientRequest;
use App\Http\Resources\PatientResource;
use App\Services\PatientService;

class PatientController extends Controller
{
    protected $patientService;

    public function __construct(PatientService $patientService)
    {
        $this->patientService = $patientService;
    }

    public function index()
    {
        $patients = $this->patientService->getAllPatients();
        return PatientResource::collection($patients);
    }

    public function store(StorePatientRequest $request)
    {
        $patient = $this->patientService->createPatient($request->validated());
        return new PatientResource($patient);
    }

    public function show($id)
    {
        $patient = $this->patientService->getPatientById($id);
        return new PatientResource($patient);
    }

    public function update(UpdatePatientRequest $request, $id)
    {
        $patient = $this->patientService->updatePatient($id, $request->validated());
        return new PatientResource($patient);
    }

    public function destroy($id)
    {
        $this->patientService->deletePatient($id);
        return response()->json(['message' => 'Patient deleted successfully.']);
    }
}
