<?php

namespace App\Services;

use App\Repositories\Interfaces\DoctorRepositoryInterface;
use App\Repositories\Interfaces\NurseRepositoryInterface;
use App\Repositories\Interfaces\DepartmentRepositoryInterface;
use App\Repositories\Interfaces\PositionRepositoryInterface;

class StaffingService
{
    protected $doctorRepository;
    protected $nurseRepository;
    protected $departmentRepository;
    protected $positionRepository;

    public function __construct(
        DoctorRepositoryInterface $doctorRepository,
        NurseRepositoryInterface $nurseRepository,
        DepartmentRepositoryInterface $departmentRepository,
        PositionRepositoryInterface $positionRepository
    ) {
        $this->doctorRepository = $doctorRepository;
        $this->nurseRepository = $nurseRepository;
        $this->departmentRepository = $departmentRepository;
        $this->positionRepository = $positionRepository;
    }

    // Doctors
    public function getAllDoctors()
    {
        return $this->doctorRepository->all();
    }

    public function createDoctor(array $data)
    {
        return $this->doctorRepository->create($data);
    }

    public function updateDoctor($id, array $data)
    {
        return $this->doctorRepository->update($id, $data);
    }

    // Nurses
    public function getAllNurses()
    {
        return $this->nurseRepository->all();
    }

    public function createNurse(array $data)
    {
        return $this->nurseRepository->create($data);
    }

    public function updateNurse($id, array $data)
    {
        return $this->nurseRepository->update($id, $data);
    }

    // Departments
    public function getAllDepartments()
    {
        return $this->departmentRepository->all();
    }

    public function createDepartment(array $data)
    {
        return $this->departmentRepository->create($data);
    }

    public function updateDepartment($id, array $data)
    {
        return $this->departmentRepository->update($id, $data);
    }

    public function deleteDepartment($id)
    {
        return $this->departmentRepository->delete($id);
    }

    // Positions
    public function getAllPositions()
    {
        return $this->positionRepository->all();
    }

    public function createPosition(array $data)
    {
        return $this->positionRepository->create($data);
    }

    public function updatePosition($id, array $data)
    {
        return $this->positionRepository->update($id, $data);
    }

    public function deletePosition($id)
    {
        return $this->positionRepository->delete($id);
    }
}
