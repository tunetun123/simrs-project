<?php

namespace App\Http\Controllers\Api\FrontOffice;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRegistrationRequest;
use App\Http\Resources\RegistrationResource;
use App\Services\RegistrationService;

class RegistrationController extends Controller
{
    protected $registrationService;

    public function __construct(RegistrationService $registrationService)
    {
        $this->registrationService = $registrationService;
    }

    public function store(StoreRegistrationRequest $request)
    {
        $registration = $this->registrationService->registerPatient($request->validated());
        return new RegistrationResource($registration);
    }
}
