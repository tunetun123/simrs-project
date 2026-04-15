<?php

namespace App\Http\Controllers;

use App\Services\PatientService;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    protected $patientService;

    public function __construct(PatientService $patientService)
    {
        $this->patientService = $patientService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $patients = $this->patientService->getAllPatients();
        return view('front-office.patient.index', [
            'title' => 'Daftar Pasien',
            'patients' => $patients
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $nextMrn = $this->patientService->getNextMedicalRecordNumber();
        return view('front-office.patient.create', [
            'title' => 'Pendaftaran Pasien Baru',
            'nextMrn' => $nextMrn
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Handled by API
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $patient = $this->patientService->getPatientById($id);
        return view('front-office.patient.show', [
            'title' => 'Detail Pasien',
            'patient' => $patient
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $patient = $this->patientService->getPatientById($id);
        return view('front-office.patient.edit', [
            'title' => 'Edit Pasien',
            'patient' => $patient
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->patientService->deletePatient($id);
        return redirect()->route('patients.index')->with('success', 'Data pasien berhasil dihapus.');
    }
}
