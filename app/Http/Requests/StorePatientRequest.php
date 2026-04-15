<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePatientRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'full_name' => 'required|string|max:255',
            'ihs_number' => 'nullable|string|max:255',
            'nik' => 'required_without:passport_number|nullable|string|max:255|unique:patients,nik',
            'passport_number' => 'required_without:nik|nullable|string|max:255|unique:patients,passport_number',
            'mothers_maiden_name' => 'required|string|max:255',
            'birth_place' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'gender' => 'required|in:L,P',
            'religion' => 'required|string',
            'language' => 'required|string|max:255',
            'address' => 'required|string',
            'blood_type' => 'required|string|max:5',
            'rt' => 'required|string|max:255',
            'rw' => 'required|string|max:255',
            'village' => 'required|string|max:255',
            'subdistrict' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'postal_code' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'phone_number' => 'required|string|max:255',
            'marital_status' => 'required|string|max:255',
        ];
    }
}
