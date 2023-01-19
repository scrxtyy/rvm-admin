<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class EmployeeController extends Controller
{
    public function addCoins($id){
        $employees = User::find($id);

        return view('rvm.addcoins', compact('id'));
    }
}
