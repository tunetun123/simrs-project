<?php

namespace App\Repositories;

use App\Models\Registration;
use App\Repositories\Interfaces\RegistrationRepositoryInterface;

class RegistrationRepository implements RegistrationRepositoryInterface
{
    public function create(array $data)
    {
        return Registration::create($data);
    }

    public function getLastVisitNumber($datePrefix)
    {
        return Registration::where('visit_number', 'like', $datePrefix . '%')
            ->orderBy('visit_number', 'desc')
            ->first()?->visit_number;
    }
}
