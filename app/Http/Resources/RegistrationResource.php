<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RegistrationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'visit_number' => $this->visit_number,
            'medical_record_number' => $this->medical_record_number,
            'visit_status' => $this->visit_status,
            'visit_type' => $this->visit_type,
            'polyclinic_code' => $this->polyclinic_code,
            'visit_date' => $this->visit_date,
            'insurance_code' => $this->insurance_code,
            'participant_number' => $this->participant_number,
            'patient' => new PatientResource($this->whenLoaded('patient')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
