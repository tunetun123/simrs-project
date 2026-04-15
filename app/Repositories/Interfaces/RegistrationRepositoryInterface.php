<?php

namespace App\Repositories\Interfaces;

interface RegistrationRepositoryInterface
{
    public function create(array $data);
    public function getLastVisitNumber($datePrefix);
}
