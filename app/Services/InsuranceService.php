<?php

namespace App\Services;

use App\Repositories\Interfaces\InsuranceRepositoryInterface;

class InsuranceService
{
    protected $insuranceRepository;

    public function __construct(InsuranceRepositoryInterface $insuranceRepository)
    {
        $this->insuranceRepository = $insuranceRepository;
    }

    public function getAllInsurances()
    {
        return $this->insuranceRepository->all();
    }

    public function getInsuranceById($id)
    {
        return $this->insuranceRepository->find($id);
    }

    public function createInsurance(array $data)
    {
        return $this->insuranceRepository->create($data);
    }

    public function updateInsurance($id, array $data)
    {
        return $this->insuranceRepository->update($id, $data);
    }

    public function deleteInsurance($id)
    {
        return $this->insuranceRepository->delete($id);
    }
}
