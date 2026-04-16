<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePolyclinicRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'doctor_code' => 'required|string|exists:employees,employee_code',
            'insurance_code' => 'required|string|exists:insurances,insurance_code',
            'service_days' => 'required|string',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i',
            'patient_quota' => 'required|integer|min:1',
            'status' => 'required|in:active,inactive',
        ];
    }
}
