<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rvms extends Model
{
    use HasFactory;

    protected $primaryKey = ['rvm_id'];
    protected $fillable = ['location'];
}
