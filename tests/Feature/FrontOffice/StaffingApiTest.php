<?php

namespace Tests\Feature\FrontOffice;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Position;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StaffingApiTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Department::create(['department_code' => 'DEP01', 'name' => 'HRD', 'status' => 'active']);
        Position::create(['position_code' => 'POS01', 'name' => 'Staff', 'status' => 'active']);
    }

    public function test_can_create_employee()
    {
        $data = [
            'employee_code' => 'EMP-TEST',
            'full_name' => 'Test Employee',
            'nik' => '1234567890123456',
            'birth_date' => '1990-01-01',
            'birth_place' => 'Jakarta',
            'gender' => 'laki-laki',
            'last_education' => 'S1',
            'contact' => 'test@test.com',
            'address' => 'Jl. Test',
            'rt' => '01',
            'rw' => '01',
            'village' => 'Village',
            'subdistrict' => 'Subdistrict',
            'city' => 'City',
            'postal_code' => '12345',
            'province' => 'Province',
            'country' => 'Indonesia',
            'phone_number' => '08123',
            'marital_status' => 'Single',
            'department_code' => 'DEP01',
            'position_code' => 'POS01'
        ];

        $response = $this->postJson(route('api.employees.store'), $data);

        $response->assertStatus(201);
        $this->assertDatabaseHas('employees', ['employee_code' => 'EMP-TEST', 'gender' => 'laki-laki']);
    }

    public function test_can_create_doctor_with_status()
    {
        $employee = Employee::create([
            'employee_code' => 'DOC-001',
            'full_name' => 'Dr. Test',
            'nik' => '9999999999999999',
            'birth_date' => '1980-01-01',
            'birth_place' => 'Jakarta',
            'gender' => 'laki-laki',
            'last_education' => 'S2',
            'contact' => 'doc@test.com',
            'address' => 'Jl. Doc',
            'rt' => '01', 'rw' => '01', 'village' => 'V', 'subdistrict' => 'S', 'city' => 'C', 'postal_code' => '1', 'province' => 'P', 'country' => 'I',
            'phone_number' => '123',
            'marital_status' => 'M',
            'department_code' => 'DEP01',
            'position_code' => 'POS01'
        ]);

        $data = [
            'employee_code' => 'DOC-001',
            'specialization' => 'Bedah',
            'sip_number' => 'SIP-123',
            'status' => 'aktif'
        ];

        $response = $this->postJson(route('api.doctors.store'), $data);

        $response->assertStatus(201);
        $this->assertDatabaseHas('doctors', ['employee_code' => 'DOC-001', 'status' => 'aktif']);
    }
}
