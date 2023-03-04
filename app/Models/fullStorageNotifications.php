<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class fullStorageNotifications extends Model
{
    use HasFactory;
    protected $table = 'full_storage_notifications';
    protected $primaryKey = 'log_id';
    protected $fillable = ['storage','rvm_id','full_date'];

}
