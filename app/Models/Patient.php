<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patient extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'medical_record_number';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'medical_record_number',
        'full_name',
        'ihs_number',
        'nik',
        'passport_number',
        'mothers_maiden_name',
        'birth_place',
        'birth_date',
        'gender',
        'religion',
        'language',
        'address',
        'blood_type',
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
    ];

    public function registrations()
    {
        return $this->hasMany(Registration::class, 'medical_record_number', 'medical_record_number');
    }
}
