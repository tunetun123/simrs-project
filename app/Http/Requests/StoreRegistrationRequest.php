<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRegistrationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'medical_record_number' => 'required|string|exists:patients,medical_record_number',
            'visit_type' => 'required|in:Rawat Jalan,IGD',
            'polyclinic_code' => 'required|string|exists:polyclinics,polyclinic_code',
            'insurance_code' => 'required|string|exists:insurances,insurance_code',
            'participant_number' => 'nullable|string|max:255',
        ];
    }
}
