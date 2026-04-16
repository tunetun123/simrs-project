<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

use Illuminate\Support\Facades\Storage;

class InsuranceResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'insurance_code' => $this->insurance_code,
            'name' => $this->name,
            'logo' => $this->logo ? asset('storage/' . $this->logo) : null,
            'address' => $this->address,
            'contact' => $this->contact,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
