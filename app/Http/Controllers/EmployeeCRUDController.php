<?php

namespace App\Http\Controllers;

use App\Models\Employees;
use Illuminate\Http\Request;

class EmployeeCRUDController extends Controller
{
    public function search(Request $request){

    }
    public function index()
    {
        $employees = Employees::all();
        return view ('employees.index')->with('employees', $employees);
    }
 
    
    public function create()
    {
        return view('employees.create');
    }
 
   
    public function store(Request $request)
    {
        $input = $request->all();
        Employees::create($input);
        return redirect('dashboard')->with('flash_message', 'Employees Addedd!');  
    }
 
    
    public function show($id)
    {
        $employees = Employees::find($id);
        return view('employees.show')->with('employees', $employees);
    }
 
    
    public function edit($id)
    {
        $employees = Employees::find($id);
        return view('employees.edit')->with('employees', $employees);
    }
 
  
    public function update(Request $request, $id)
    {
        $employees = Employees::find($id);
        $input = $request->all();
        $employees->update($input);
        return redirect('dashboard')->with('flash_message', 'Employees Updated!');  
    }
 
   
    public function destroy($id)
    {
        Employees::destroy($id);
        return redirect('dashboard')->with('flash_message', 'Employees deleted!');  
    }

    }
