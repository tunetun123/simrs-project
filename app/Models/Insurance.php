<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Insurance extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'insurance_code';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'insurance_code',
        'name',
        'address',
        'contact',
        'status',
    ];

    public function registrations()
    {
        return $this->hasMany(Registration::class, 'insurance_code', 'insurance_code');
    }
}
