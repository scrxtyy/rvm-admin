<?php

namespace App\Http\Controllers;

use App\Models\Employees;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function viewEmployees(){
        $employees = Employees::all();
        return view('dashboard', compact('employees'));
    }
}
