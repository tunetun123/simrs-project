<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePatientRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $medicalRecordNumber = $this->route('patient');

        return [
            'full_name' => 'sometimes|required|string|max:255',
            'ihs_number' => 'nullable|string|max:255',
            'nik' => 'sometimes|required|string|max:255|unique:patients,nik,' . $medicalRecordNumber . ',medical_record_number',
            'passport_number' => 'nullable|string|max:255',
            'mothers_maiden_name' => 'sometimes|required|string|max:255',
            'birth_place' => 'sometimes|required|string|max:255',
            'birth_date' => 'sometimes|required|date',
            'gender' => 'sometimes|required|in:L,P',
            'language' => 'sometimes|required|string|max:255',
            'address' => 'sometimes|required|string',
            'blood_type' => 'nullable|string|max:255',
            'rt' => 'sometimes|required|string|max:255',
            'rw' => 'sometimes|required|string|max:255',
            'village' => 'sometimes|required|string|max:255',
            'subdistrict' => 'sometimes|required|string|max:255',
            'city' => 'sometimes|required|string|max:255',
            'postal_code' => 'sometimes|required|string|max:255',
            'province' => 'sometimes|required|string|max:255',
            'country' => 'sometimes|required|string|max:255',
            'phone_number' => 'sometimes|required|string|max:255',
            'marital_status' => 'sometimes|required|string|max:255',
        ];
    }
}
