<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PolyclinicSchedule extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'polyclinic_code',
        'doctor_code',
        'insurance_code',
        'day',
        'start_time',
        'end_time',
        'patient_quota',
    ];

    public function polyclinic()
    {
        return $this->belongsTo(Polyclinic::class, 'polyclinic_code', 'polyclinic_code');
    }

    public function doctor()
    {
        return $this->belongsTo(Employee::class, 'doctor_code', 'employee_code');
    }

    public function insurance()
    {
        return $this->belongsTo(Insurance::class, 'insurance_code', 'insurance_code');
    }
}
