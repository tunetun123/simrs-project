<?php

namespace Tests\Feature\FrontOffice;

use App\Models\Insurance;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class InsuranceApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_get_all_insurances()
    {
        Insurance::create([
            'insurance_code' => 'BPJS',
            'name' => 'BPJS Kesehatan',
            'address' => 'Jl. Letjen Suprapto No. 1',
            'contact' => '1500400',
            'status' => 'active'
        ]);

        $response = $this->getJson(route('api.insurances.index'));

        $response->assertStatus(200)
                 ->assertJsonCount(1, 'data');
    }

    public function test_can_create_insurance_with_logo()
    {
        Storage::fake('public');

        $file = UploadedFile::fake()->image('logo.jpg');

        $data = [
            'insurance_code' => 'AXA',
            'name' => 'AXA Mandiri',
            'logo' => $file,
            'address' => 'Jl. Sudirman No. 2',
            'contact' => '021-3000-8000',
            'status' => 'active'
        ];

        $response = $this->postJson(route('api.insurances.store'), $data);

        $response->assertStatus(201);
        $this->assertDatabaseHas('insurances', ['insurance_code' => 'AXA']);
        
        $insurance = Insurance::find('AXA');
        $this->assertNotNull($insurance->logo);
        Storage::disk('public')->assertExists($insurance->logo);
    }

    public function test_can_update_insurance_and_replace_logo()
    {
        Storage::fake('public');

        // Create initial insurance with logo
        $oldFile = UploadedFile::fake()->image('old_logo.jpg');
        $oldPath = $oldFile->store('insurances', 'public');

        $insurance = Insurance::create([
            'insurance_code' => 'BPJS',
            'name' => 'BPJS Kesehatan',
            'logo' => $oldPath,
            'address' => 'Jl. Letjen Suprapto No. 1',
            'contact' => '1500400',
            'status' => 'active'
        ]);

        $newFile = UploadedFile::fake()->image('new_logo.jpg');

        $updateData = [
            '_method' => 'PUT',
            'name' => 'BPJS Kesehatan Updated',
            'logo' => $newFile,
            'address' => 'Jl. Letjen Suprapto No. 1 Updated',
            'contact' => '1500400',
            'status' => 'inactive'
        ];

        // Use POST with _method=PUT for multipart/form-data support
        $response = $this->postJson(route('api.insurances.update', $insurance->insurance_code), $updateData);

        $response->assertStatus(200);
        
        $insurance->refresh();
        $this->assertEquals('BPJS Kesehatan Updated', $insurance->name);
        
        // Assert old logo is deleted and new one exists
        Storage::disk('public')->assertMissing($oldPath);
        Storage::disk('public')->assertExists($insurance->logo);
    }

    public function test_can_delete_insurance()
    {
        $insurance = Insurance::create([
            'insurance_code' => 'BPJS',
            'name' => 'BPJS Kesehatan',
            'address' => 'Jl. Letjen Suprapto No. 1',
            'contact' => '1500400',
            'status' => 'active'
        ]);

        $response = $this->deleteJson(route('api.insurances.destroy', $insurance->insurance_code));

        $response->assertStatus(200);
        $this->assertSoftDeleted('insurances', ['insurance_code' => 'BPJS']);
    }
}
