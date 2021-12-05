<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HealthFacility extends Model
{
    use HasFactory;
    protected $table = 'health_facilities';
    protected  $fillable =[
        'facilityname',
        'facilitycounty',
        'facilitylocation'
    ];
}
