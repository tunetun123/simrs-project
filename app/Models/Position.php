<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Position extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'position_code';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'position_code',
        'name',
        'status',
    ];
}
