<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Polyclinic extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'polyclinic_code';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'polyclinic_code',
        'name',
        'status',
    ];

    public function schedules()
    {
        return $this->hasMany(PolyclinicSchedule::class, 'polyclinic_code', 'polyclinic_code');
    }

    public function registrations()
    {
        return $this->hasMany(Registration::class, 'polyclinic_code', 'polyclinic_code');
    }
}
