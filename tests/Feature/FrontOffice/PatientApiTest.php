<?php

namespace Tests\Feature\FrontOffice;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PatientApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_create_a_patient_and_auto_generates_medical_record_number()
    {
        $payload = [
            'full_name' => 'John Doe',
            'nik' => '1234567890123456',
            'mothers_maiden_name' => 'Jane Doe',
            'birth_place' => 'Jakarta',
            'birth_date' => '1990-01-01',
            'gender' => 'L',
            'language' => 'Indonesia',
            'address' => 'Jl. Merdeka',
            'rt' => '001',
            'rw' => '002',
            'village' => 'Gambir',
            'subdistrict' => 'Gambir',
            'city' => 'Jakarta Pusat',
            'postal_code' => '10110',
            'province' => 'DKI Jakarta',
            'country' => 'Indonesia',
            'phone_number' => '081234567890',
            'marital_status' => 'single',
        ];

        $response = $this->postJson('/api/front-office/patients', $payload);

        $response->assertStatus(201)
                 ->assertJsonPath('data.medical_record_number', '00-00-01')
                 ->assertJsonPath('data.full_name', 'John Doe');
                 
        $this->assertDatabaseHas('patients', [
            'medical_record_number' => '00-00-01',
            'nik' => '1234567890123456'
        ]);
    }

    public function test_it_fails_validation_when_required_fields_are_missing()
    {
        $response = $this->postJson('/api/front-office/patients', []);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['full_name', 'nik', 'birth_date']);
    }
}
