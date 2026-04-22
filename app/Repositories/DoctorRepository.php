<?php

namespace App\Repositories;

use App\Models\Doctor;
use App\Repositories\Interfaces\DoctorRepositoryInterface;

class DoctorRepository implements DoctorRepositoryInterface
{
    public function all()
    {
        return Doctor::with('employee')->get();
    }

    public function find($id)
    {
        return Doctor::with('employee')->findOrFail($id);
    }

    public function create(array $data)
    {
        return Doctor::create($data);
    }

    public function update($id, array $data)
    {
        $doctor = $this->find($id);
        $doctor->update($data);
        return $doctor;
    }

    public function delete($id)
    {
        $doctor = $this->find($id);
        return $doctor->delete();
    }
}
