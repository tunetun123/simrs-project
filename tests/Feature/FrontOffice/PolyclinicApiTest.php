<?php

namespace Tests\Feature\FrontOffice;

use App\Models\Department;
use App\Models\Doctor;
use App\Models\Employee;
use App\Models\Insurance;
use App\Models\Polyclinic;
use App\Models\Position;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PolyclinicApiTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Create Department and Position
        Department::create(['department_code' => 'DEP01', 'name' => 'Medis']);
        Position::create(['position_code' => 'POS01', 'name' => 'Dokter']);

        // Create Employee and Doctor
        Employee::create([
            'employee_code' => 'EMP001',
            'full_name' => 'Dr. Budi Santoso',
            'nik' => '1234567890123456',
            'birth_date' => '1980-01-01',
            'birth_place' => 'Jakarta',
            'gender' => 'male',
            'last_education' => 'S2 Kedokteran',
            'contact' => '08123456789',
            'address' => 'Jl. Kebon Sirih',
            'rt' => '01',
            'rw' => '02',
            'village' => 'Gambir',
            'subdistrict' => 'Gambir',
            'city' => 'Jakarta Pusat',
            'postal_code' => '10110',
            'province' => 'DKI Jakarta',
            'country' => 'Indonesia',
            'phone_number' => '08123456789',
            'marital_status' => 'Kawin',
            'department_code' => 'DEP01',
            'position_code' => 'POS01'
        ]);

        Doctor::create([
            'employee_code' => 'EMP001',
            'specialization' => 'Umum',
            'sip_number' => 'SIP/123/2026'
        ]);

        // Create Insurance
        Insurance::create([
            'insurance_code' => 'BPJS',
            'name' => 'BPJS Kesehatan',
            'address' => 'Jl. Letjen Suprapto',
            'contact' => '1500400',
            'status' => 'active'
        ]);
    }

    public function test_can_get_all_polyclinics()
    {
        Polyclinic::create([
            'polyclinic_code' => 'POLI01',
            'name' => 'Poli Umum',
            'doctor_code' => 'EMP001',
            'insurance_code' => 'BPJS',
            'service_days' => 'Senin - Jumat',
            'start_time' => '08:00',
            'end_time' => '14:00',
            'patient_quota' => 30,
            'status' => 'active'
        ]);

        $response = $this->getJson(route('api.polyclinics.index'));

        $response->assertStatus(200)
                 ->assertJsonCount(1, 'data');
    }

    public function test_can_create_polyclinic()
    {
        $data = [
            'polyclinic_code' => 'POLI02',
            'name' => 'Poli Gigi',
            'doctor_code' => 'EMP001',
            'insurance_code' => 'BPJS',
            'service_days' => 'Senin, Rabu, Jumat',
            'start_time' => '09:00',
            'end_time' => '12:00',
            'patient_quota' => 15,
            'status' => 'active'
        ];

        $response = $this->postJson(route('api.polyclinics.store'), $data);

        $response->assertStatus(201);
        $this->assertDatabaseHas('polyclinics', ['polyclinic_code' => 'POLI02']);
    }

    public function test_can_update_polyclinic()
    {
        $polyclinic = Polyclinic::create([
            'polyclinic_code' => 'POLI01',
            'name' => 'Poli Umum',
            'doctor_code' => 'EMP001',
            'insurance_code' => 'BPJS',
            'service_days' => 'Senin - Jumat',
            'start_time' => '08:00',
            'end_time' => '14:00',
            'patient_quota' => 30,
            'status' => 'active'
        ]);

        $updateData = [
            'name' => 'Poli Umum Updated',
            'doctor_code' => 'EMP001',
            'insurance_code' => 'BPJS',
            'service_days' => 'Senin - Sabtu',
            'start_time' => '08:00',
            'end_time' => '15:00',
            'patient_quota' => 50,
            'status' => 'inactive'
        ];

        $response = $this->putJson(route('api.polyclinics.update', $polyclinic->polyclinic_code), $updateData);

        $response->assertStatus(200);
        $this->assertDatabaseHas('polyclinics', [
            'polyclinic_code' => 'POLI01',
            'name' => 'Poli Umum Updated',
            'patient_quota' => 50,
            'status' => 'inactive'
        ]);
    }

    public function test_can_delete_polyclinic()
    {
        $polyclinic = Polyclinic::create([
            'polyclinic_code' => 'POLI01',
            'name' => 'Poli Umum',
            'doctor_code' => 'EMP001',
            'insurance_code' => 'BPJS',
            'service_days' => 'Senin - Jumat',
            'start_time' => '08:00',
            'end_time' => '14:00',
            'patient_quota' => 30,
            'status' => 'active'
        ]);

        $response = $this->deleteJson(route('api.polyclinics.destroy', $polyclinic->polyclinic_code));

        $response->assertStatus(200);
        $this->assertSoftDeleted('polyclinics', ['polyclinic_code' => 'POLI01']);
    }
}
