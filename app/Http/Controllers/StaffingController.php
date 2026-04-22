<?php

namespace App\Http\Controllers;

use App\Services\EmployeeService;
use App\Services\StaffingService;
use Illuminate\Http\Request;

class StaffingController extends Controller
{
    protected $employeeService;
    protected $staffingService;

    public function __construct(EmployeeService $employeeService, StaffingService $staffingService)
    {
        $this->employeeService = $employeeService;
        $this->staffingService = $staffingService;
    }

    public function index()
    {
        return view('back-office.staffing.index', [
            'title' => 'Manajemen Kepegawaian',
            'employees' => $this->employeeService->getAllEmployees(),
            'doctors' => $this->staffingService->getAllDoctors(),
            'nurses' => $this->staffingService->getAllNurses(),
            'departments' => $this->staffingService->getAllDepartments(),
            'positions' => $this->staffingService->getAllPositions()
        ]);
    }

    public function create()
    {
        return view('back-office.staffing.create', [
            'title' => 'Tambah Pegawai Baru',
            'departments' => $this->staffingService->getAllDepartments()->where('status', 'active'),
            'positions' => $this->staffingService->getAllPositions()->where('status', 'active')
        ]);
    }

    public function show($id)
    {
        $employee = $this->employeeService->getEmployeeById($id);
        return view('back-office.staffing.show', [
            'title' => 'Detail Pegawai',
            'employee' => $employee
        ]);
    }

    public function edit($id)
    {
        $employee = $this->employeeService->getEmployeeById($id);
        return view('back-office.staffing.edit', [
            'title' => 'Edit Pegawai',
            'employee' => $employee,
            'departments' => $this->staffingService->getAllDepartments()->where('status', 'active'),
            'positions' => $this->staffingService->getAllPositions()->where('status', 'active')
        ]);
    }

    public function destroy($id)
    {
        $this->employeeService->deleteEmployee($id);
        return redirect()->route('staffing.index')->with('success', 'Data pegawai berhasil dihapus.');
    }
}
