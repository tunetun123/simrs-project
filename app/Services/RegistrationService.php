<?php

namespace App\Services;

use App\Repositories\Interfaces\RegistrationRepositoryInterface;
use Carbon\Carbon;

class RegistrationService
{
    protected $registrationRepository;

    public function __construct(RegistrationRepositoryInterface $registrationRepository)
    {
        $this->registrationRepository = $registrationRepository;
    }

    public function registerPatient(array $data)
    {
        $data['visit_number'] = $this->generateVisitNumber();
        $data['visit_date'] = Carbon::now();
        $data['visit_status'] = 'Terdaftar';
        return $this->registrationRepository->create($data);
    }

    private function generateVisitNumber()
    {
        $datePrefix = Carbon::now()->format('Y/m/d');
        $lastVisit = $this->registrationRepository->getLastVisitNumber($datePrefix);

        if (!$lastVisit) {
            return $datePrefix . '/000001';
        }

        $parts = explode('/', $lastVisit);
        $lastSequence = (int)end($parts);
        $nextSequence = str_pad($lastSequence + 1, 6, '0', STR_PAD_LEFT);

        return $datePrefix . '/' . $nextSequence;
    }
}
