<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PolyclinicResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'polyclinic_code' => $this->polyclinic_code,
            'name' => $this->name,
            'doctor_code' => $this->doctor_code,
            'insurance_code' => $this->insurance_code,
            'service_days' => $this->service_days,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'patient_quota' => $this->patient_quota,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
