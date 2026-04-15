<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Registration extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'visit_number';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'visit_number',
        'medical_record_number',
        'visit_status',
        'visit_type',
        'polyclinic_code',
        'visit_date',
        'insurance_code',
        'participant_number',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'medical_record_number', 'medical_record_number');
    }

    public function polyclinic()
    {
        return $this->belongsTo(Polyclinic::class, 'polyclinic_code', 'polyclinic_code');
    }

    public function insurance()
    {
        return $this->belongsTo(Insurance::class, 'insurance_code', 'insurance_code');
    }
}
