<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Services\RegistrationService;
use App\Repositories\Interfaces\RegistrationRepositoryInterface;
use Carbon\Carbon;
use Mockery;

class RegistrationServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    public function test_it_generates_first_visit_number_correctly()
    {
        Carbon::setTestNow(Carbon::create(2026, 4, 15));
        
        $repository = Mockery::mock(RegistrationRepositoryInterface::class);
        $repository->shouldReceive('getLastVisitNumber')->with('2026/04/15')->once()->andReturn(null);
        $repository->shouldReceive('create')->once()->andReturnUsing(function ($data) {
            return (object) $data;
        });

        $service = new RegistrationService($repository);
        
        $registration = $service->registerPatient([
            'medical_record_number' => '00-00-01',
        ]);

        $this->assertEquals('2026/04/15/000001', $registration->visit_number);
    }

    public function test_it_increments_visit_number_correctly()
    {
        Carbon::setTestNow(Carbon::create(2026, 4, 15));
        
        $repository = Mockery::mock(RegistrationRepositoryInterface::class);
        $repository->shouldReceive('getLastVisitNumber')->with('2026/04/15')->once()->andReturn('2026/04/15/000009');
        $repository->shouldReceive('create')->once()->andReturnUsing(function ($data) {
            return (object) $data;
        });

        $service = new RegistrationService($repository);
        
        $registration = $service->registerPatient([
            'medical_record_number' => '00-00-01',
        ]);

        $this->assertEquals('2026/04/15/000010', $registration->visit_number);
    }
}
