<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class monitorPlastics extends Model
{
    use HasFactory;

    protected $fillable =[
        'kg_weight',
        'pieces',
        'price',
        'total_kg',
    ];
}
