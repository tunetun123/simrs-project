<?php

namespace App\Services;

use App\Repositories\Interfaces\PatientRepositoryInterface;

class PatientService
{
    protected $patientRepository;

    public function __construct(PatientRepositoryInterface $patientRepository)
    {
        $this->patientRepository = $patientRepository;
    }

    public function getAllPatients()
    {
        return $this->patientRepository->all();
    }

    public function getPatientById($id)
    {
        return $this->patientRepository->find($id);
    }

    public function createPatient(array $data)
    {
        $data['medical_record_number'] = $this->generateMedicalRecordNumber();
        return $this->patientRepository->create($data);
    }

    public function updatePatient($id, array $data)
    {
        return $this->patientRepository->update($id, $data);
    }

    public function deletePatient($id)
    {
        return $this->patientRepository->delete($id);
    }

    public function getNextMedicalRecordNumber()
    {
        return $this->generateMedicalRecordNumber();
    }

    private function generateMedicalRecordNumber()
    {
        $lastRecord = $this->patientRepository->getLastMedicalRecordNumber();

        if (!$lastRecord) {
            return '00-00-01';
        }

        $number = str_replace('-', '', $lastRecord);
        $nextNumber = str_pad((int)$number + 1, 6, '0', STR_PAD_LEFT);
        
        return substr($nextNumber, 0, 2) . '-' . substr($nextNumber, 2, 2) . '-' . substr($nextNumber, 4, 2);
    }
}
