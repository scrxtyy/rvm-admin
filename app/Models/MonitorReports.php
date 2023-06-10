<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonitorReports extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
      'storage',
      'status',
      'capacity'
  ];
}
