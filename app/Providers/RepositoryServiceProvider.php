<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Interfaces\PatientRepositoryInterface;
use App\Repositories\PatientRepository;
use App\Repositories\Interfaces\RegistrationRepositoryInterface;
use App\Repositories\RegistrationRepository;
use App\Repositories\Interfaces\InsuranceRepositoryInterface;
use App\Repositories\InsuranceRepository;
use App\Repositories\Interfaces\PolyclinicRepositoryInterface;
use App\Repositories\PolyclinicRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(PatientRepositoryInterface::class, PatientRepository::class);
        $this->app->bind(RegistrationRepositoryInterface::class, RegistrationRepository::class);
        $this->app->bind(InsuranceRepositoryInterface::class, InsuranceRepository::class);
        $this->app->bind(PolyclinicRepositoryInterface::class, PolyclinicRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
