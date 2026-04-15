<?php

namespace Tests\Feature\FrontOffice;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Patient;
use App\Models\Polyclinic;
use App\Models\Insurance;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class RegistrationApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_register_a_patient_and_auto_generates_visit_number()
    {
        Carbon::setTestNow(Carbon::create(2026, 4, 15));

        Schema::disableForeignKeyConstraints();

        DB::table('departments')->insert([
            'department_code' => 'DEP-01',
            'name' => 'Dep',
            'status' => 'active',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('positions')->insert([
            'position_code' => 'POS-01',
            'name' => 'Pos',
            'status' => 'active',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('employees')->insert([
            'employee_code' => 'DOC',
            'full_name' => 'Dr',
            'nik' => '111',
            'birth_date' => '1990-01-01',
            'birth_place' => 'JKT',
            'gender' => 'male',
            'last_education' => 'S1',
            'contact' => '08',
            'address' => 'jl',
            'rt' => '01',
            'rw' => '02',
            'village' => 'v',
            'subdistrict' => 's',
            'city' => 'c',
            'postal_code' => '12',
            'province' => 'p',
            'country' => 'ID',
            'phone_number' => '08',
            'marital_status' => 's',
            'status' => 'active',
            'department_code' => 'DEP-01',
            'position_code' => 'POS-01',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        Insurance::insert([
            'insurance_code' => 'INS',
            'name' => 'BPJS',
            'address' => 'Jl',
            'contact' => '08',
            'status' => 'active',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        Polyclinic::insert([
            'polyclinic_code' => 'POLI-01',
            'name' => 'Poli',
            'doctor_code' => 'DOC',
            'insurance_code' => 'INS',
            'service_days' => 'Senin',
            'start_time' => '08:00',
            'end_time' => '16:00',
            'patient_quota' => 20,
            'status' => 'active',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        Patient::insert([
            'medical_record_number' => '00-00-01',
            'full_name' => 'John Doe',
            'nik' => '123',
            'mothers_maiden_name' => 'Jane',
            'birth_place' => 'JKT',
            'birth_date' => '1990-01-01',
            'gender' => 'L',
            'language' => 'ID',
            'address' => 'jl',
            'rt' => '01',
            'rw' => '02',
            'village' => 'Vil',
            'subdistrict' => 'Sub',
            'city' => 'City',
            'postal_code' => '123',
            'province' => 'Prov',
            'country' => 'ID',
            'phone_number' => '08',
            'marital_status' => 'single',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        
        Schema::enableForeignKeyConstraints();

        $payload = [
            'medical_record_number' => '00-00-01',
            'visit_type' => 'Rawat Jalan',
            'polyclinic_code' => 'POLI-01',
            'insurance_code' => 'INS',
        ];

        $response = $this->postJson('/api/front-office/register', $payload);

        $response->assertStatus(201)
                 ->assertJsonPath('data.visit_number', '2026/04/15/000001')
                 ->assertJsonPath('data.visit_status', 'Terdaftar');
                 
        $this->assertDatabaseHas('registrations', [
            'visit_number' => '2026/04/15/000001',
            'medical_record_number' => '00-00-01'
        ]);
    }
    
    public function test_it_fails_validation_for_registration()
    {
        $response = $this->postJson('/api/front-office/register', []);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['medical_record_number', 'visit_type', 'polyclinic_code', 'insurance_code']);
    }
}
