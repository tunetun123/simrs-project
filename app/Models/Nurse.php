<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Nurse extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'employee_code';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'employee_code',
        'str_number',
        'status',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_code', 'employee_code');
    }
}
