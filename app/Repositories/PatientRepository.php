<?php

namespace App\Repositories;

use App\Models\Patient;
use App\Repositories\Interfaces\PatientRepositoryInterface;

class PatientRepository implements PatientRepositoryInterface
{
    public function all()
    {
        return Patient::all();
    }

    public function find($id)
    {
        return Patient::findOrFail($id);
    }

    public function create(array $data)
    {
        return Patient::create($data);
    }

    public function update($id, array $data)
    {
        $patient = $this->find($id);
        $patient->update($data);
        return $patient;
    }

    public function delete($id)
    {
        $patient = $this->find($id);
        return $patient->delete();
    }

    public function getLastMedicalRecordNumber()
    {
        return Patient::orderBy('medical_record_number', 'desc')->first()?->medical_record_number;
    }
}
