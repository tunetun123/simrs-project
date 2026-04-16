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
        'status',
        'department_code',
        'position_code',
    ];

    public function doctor()
    {
        return $this->hasOne(Doctor::class, 'employee_code', 'employee_code');
    }
}
