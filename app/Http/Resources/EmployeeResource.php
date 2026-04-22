<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'employee_code' => $this->employee_code,
            'full_name' => $this->full_name,
            'nik' => $this->nik,
            'birth_date' => $this->birth_date,
            'birth_place' => $this->birth_place,
            'gender' => $this->gender,
            'last_education' => $this->last_education,
            'contact' => $this->contact,
            'address' => $this->address,
            'rt' => $this->rt,
            'rw' => $this->rw,
            'village' => $this->village,
            'subdistrict' => $this->subdistrict,
            'city' => $this->city,
            'postal_code' => $this->postal_code,
            'province' => $this->province,
            'country' => $this->country,
            'phone_number' => $this->phone_number,
            'marital_status' => $this->marital_status,
            'bank_account_number' => $this->bank_account_number,
            'photo_url' => $this->photo_path ? asset('storage/' . $this->photo_path) : null,
            'department' => $this->whenLoaded('department'),
            'position' => $this->whenLoaded('position'),
            'doctor' => $this->whenLoaded('doctor'),
            'nurse' => $this->whenLoaded('nurse'),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
