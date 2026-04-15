<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PatientResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'medical_record_number' => $this->medical_record_number,
            'full_name' => $this->full_name,
            'ihs_number' => $this->ihs_number,
            'nik' => $this->nik,
            'passport_number' => $this->passport_number,
            'mothers_maiden_name' => $this->mothers_maiden_name,
            'birth_place' => $this->birth_place,
            'birth_date' => $this->birth_date,
            'gender' => $this->gender,
            'language' => $this->language,
            'address' => $this->address,
            'blood_type' => $this->blood_type,
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
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
