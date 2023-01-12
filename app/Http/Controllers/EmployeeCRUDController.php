<?php

namespace App\Http\Controllers;

use App\Models\Employees;
use App\Models\monitorCoins;
use App\Models\monitorPlastics;
use App\Models\monitorTincans;
use App\Models\Notifications;
use Brian2694\Toastr\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Collection\Paginate;
use DB;

class EmployeeCRUDController extends Controller
{
    public $message = "";
    public function index()
    {
       // $employees = Employees::all()->Paginate(5,['*'], 'all');
        $employees = new Employees();
        $employees = $employees->Paginate(5, ['*'], 'all');
        return view ('employees.index', compact('employees'));
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
        ]);
        $validatedData = $request->validate([
            'email' => ['required','email'],
        ]);

        //$input = $request->all();
       // Employees::create($input);
        //Toastr::success('Messages in here', 'Title'); 
        $employees = new Employees();
        $employees = $employees->Paginate(5, ['*'], 'all');
        return view ('employees.index', compact('employees'));
    
        
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
