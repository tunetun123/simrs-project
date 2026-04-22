<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'employee_code';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'employee_code',
        'full_name',
        'nik',
        'birth_date',
        'birth_place',
        'gender',
        'last_education',
        'contact',
        'address',
        'rt',
        'rw',
        'village',
        'subdistrict',
        'city',
        'postal_code',
        'province',
        'country',
        'phone_number',
        'marital_status',
        'bank_account_number',
        'photo_path',
        'department_code',
        'position_code',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_code', 'department_code');
    }

    public function position()
    {
        return $this->belongsTo(Position::class, 'position_code', 'position_code');
    }

    public function doctor()
    {
        return $this->hasOne(Doctor::class, 'employee_code', 'employee_code');
    }

    public function nurse()
    {
        return $this->hasOne(Nurse::class, 'employee_code', 'employee_code');
    }

    public function isDoctor()
    {
        return $this->doctor()->exists();
    }

    public function isNurse()
    {
        return $this->nurse()->exists();
    }

    public function getProfessionType()
    {
        if ($this->isDoctor()) return 'Dokter';
        if ($this->isNurse()) return 'Perawat';
        return 'Non-Klinis';
    }
}
