<?php

namespace App\Http\Controllers;

use App\Models\Employees;
use Illuminate\Http\Request;

class EmployeeCRUDController extends Controller
{
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index()
        {
            $employees = Employees::all();
            return view ('employees.index')->with('employees', $employees);
        }
     
        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function create()
        {
            return view('employees.create');
        }
     
        /**
         * Store a newly created resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @return \Illuminate\Http\Response
         */
        public function store(Request $request)
        {
            $input = $request->all();
            Employees::create($input);
            return redirect('employees.index')->with('flash_message', 'Employees Added!');  
        }
     
        /**
         * Display the specified resource.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function show($rvm_id)
        {
            $employee = Employees::find($rvm_id);
            return view('employees.show')->with('employees', $employee);
        }
     
        /**
         * Show the form for editing the specified resource.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function edit($rvm_id)
        {
            $employees = Employees::find($rvm_id);
            return view('employees.edit')->with('employees', $employees);
        }
     
        /**
         * Update the specified resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function update(Request $request, $rvm_id)
        {
            $employee = Employees::find($rvm_id);
            $input = $request->all();
            $employee->update($input);
            return redirect('employees.index')->with('flash_message', 'Employee Updated!');  
        }
     
        /**
         * Remove the specified resource from storage.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function destroy($rvm_id)
        {
            Employees::destroy($rvm_id);
            return redirect('employees.index')->with('flash_message', 'Employees deleted!');  
        }
    }
