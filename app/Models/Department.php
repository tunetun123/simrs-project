<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'department_code';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'department_code',
        'name',
        'status',
    ];
}
