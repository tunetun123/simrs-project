<?php

namespace App\Http\Controllers;

use App\Services\InsuranceService;
use Illuminate\Http\Request;

class InsuranceController extends Controller
{
    protected $insuranceService;

    public function __construct(InsuranceService $insuranceService)
    {
        $this->insuranceService = $insuranceService;
    }

    public function index()
    {
        $insurances = $this->insuranceService->getAllInsurances();
        return view('front-office.insurance.index', [
            'title' => 'Daftar Asuransi',
            'insurances' => $insurances
        ]);
    }

    public function create()
    {
        return view('front-office.insurance.create', [
            'title' => 'Tambah Asuransi Baru'
        ]);
    }

    public function show(string $id)
    {
        $insurance = $this->insuranceService->getInsuranceById($id);
        return view('front-office.insurance.show', [
            'title' => 'Detail Asuransi',
            'insurance' => $insurance
        ]);
    }

    public function edit(string $id)
    {
        $insurance = $this->insuranceService->getInsuranceById($id);
        return view('front-office.insurance.edit', [
            'title' => 'Edit Asuransi',
            'insurance' => $insurance
        ]);
    }

    public function destroy(string $id)
    {
        $this->insuranceService->deleteInsurance($id);
        return redirect()->route('insurances.index')->with('success', 'Data asuransi berhasil dihapus.');
    }
}
