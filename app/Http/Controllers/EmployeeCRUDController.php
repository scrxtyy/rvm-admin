<?php

namespace App\Http\Controllers;

use App\Models\Employees;
use App\Models\monitorCoins;
use App\Models\monitorPlastics;
use App\Models\monitorTincans;
use App\Models\Notifications;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;

class EmployeeCRUDController extends Controller
{
    public function rules()
    {
        return [
            'password' => 'required|confirmed',
        ];
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
        $input = Employees::create([

            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $validatedData = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8'],
            'password_confirmation' => ['same:password'],
        ]);
        //$input = $request->all();
       // Employees::create($input);
        return redirect('dashboard')->with('flash_message', 'Employees Added!');  
    }
 
    
    public function show($id)
    {
        $employees = Employees::find($id);

        $result1 = monitorPlastics::latest()->first();   
        $plasticweight = $result1->total_kg; 
        $plastic = $plasticweight * 0.1;

        $result2 = monitorTincans::latest()->first();   
        $cansweight = $result2->total_kg; 
        $tincans = $cansweight * 0.1;

        $result3 = monitorCoins::latest()->first();   
        $currentCoins = $result3->coins_total; 
        $coins = $currentCoins / 200;
        
        return view('employees.show',compact('employees','plastic','tincans','coins'));
    }
 
    public function rules(){
        $rules->id;

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
        return redirect('dashboard')->with('flash_message', 'Employees Deleted!');  
    }

        
    }
