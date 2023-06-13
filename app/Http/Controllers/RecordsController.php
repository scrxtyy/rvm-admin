<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RecordsController extends Controller
{
    public function displayLogs(){
        $logs = DB::table('user_reports')->paginate(10);
        return view ('employees.logs', compact('logs'));
    }
}
