<?php

namespace App\Repositories;

use App\Models\Polyclinic;
use App\Models\PolyclinicSchedule;
use App\Repositories\Interfaces\PolyclinicRepositoryInterface;

class PolyclinicRepository implements PolyclinicRepositoryInterface
{
    public function all()
    {
        return Polyclinic::all();
    }

    public function find($id)
    {
        return Polyclinic::findOrFail($id);
    }

    public function create(array $data)
    {
        return Polyclinic::create($data);
    }

    public function update($id, array $data)
    {
        $polyclinic = $this->find($id);
        $polyclinic->update($data);
        return $polyclinic;
    }

    public function delete($id)
    {
        $polyclinic = $this->find($id);
        return $polyclinic->delete();
    }

    public function allSchedules()
    {
        return PolyclinicSchedule::with(['polyclinic', 'doctor.doctor', 'insurance'])->get();
    }

    public function createSchedule(array $data)
    {
        return PolyclinicSchedule::create($data);
    }

    public function deleteSchedule($id)
    {
        $schedule = PolyclinicSchedule::findOrFail($id);
        return $schedule->delete();
    }
}
