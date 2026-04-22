<?php

namespace App\Services;

use App\Repositories\Interfaces\EmployeeRepositoryInterface;
use Illuminate\Support\Facades\Storage;

class EmployeeService
{
    protected $employeeRepository;

    public function __construct(EmployeeRepositoryInterface $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
    }

    public function getAllEmployees()
    {
        return $this->employeeRepository->all();
    }

    public function getEmployeeById($id)
    {
        return $this->employeeRepository->find($id);
    }

    public function createEmployee(array $data)
    {
        if (isset($data['photo'])) {
            $data['photo_path'] = $data['photo']->store('employees', 'public');
            unset($data['photo']);
        }
        return $this->employeeRepository->create($data);
    }

    public function updateEmployee($id, array $data)
    {
        $employee = $this->employeeRepository->find($id);
        if (isset($data['photo'])) {
            if ($employee->photo_path) {
                Storage::disk('public')->delete($employee->photo_path);
            }
            $data['photo_path'] = $data['photo']->store('employees', 'public');
            unset($data['photo']);
        }
        return $this->employeeRepository->update($id, $data);
    }

    public function deleteEmployee($id)
    {
        $employee = $this->employeeRepository->find($id);
        if ($employee->photo_path) {
            Storage::disk('public')->delete($employee->photo_path);
        }
        return $this->employeeRepository->delete($id);
    }
}
