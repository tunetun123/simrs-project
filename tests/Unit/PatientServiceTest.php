<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Services\PatientService;
use App\Repositories\Interfaces\PatientRepositoryInterface;
use Mockery;

class PatientServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    public function test_it_generates_first_medical_record_number_correctly()
    {
        $repository = Mockery::mock(PatientRepositoryInterface::class);
        $repository->shouldReceive('getLastMedicalRecordNumber')->once()->andReturn(null);
        $repository->shouldReceive('create')->once()->andReturnUsing(function ($data) {
            return (object) $data;
        });

        $service = new PatientService($repository);
        
        $patient = $service->createPatient([
            'full_name' => 'John Doe',
        ]);

        $this->assertEquals('00-00-01', $patient->medical_record_number);
    }

    public function test_it_increments_medical_record_number_correctly()
    {
        $repository = Mockery::mock(PatientRepositoryInterface::class);
        $repository->shouldReceive('getLastMedicalRecordNumber')->once()->andReturn('00-00-09');
        $repository->shouldReceive('create')->once()->andReturnUsing(function ($data) {
            return (object) $data;
        });

        $service = new PatientService($repository);
        
        $patient = $service->createPatient([
            'full_name' => 'Jane Doe',
        ]);

        $this->assertEquals('00-00-10', $patient->medical_record_number);
    }
}
