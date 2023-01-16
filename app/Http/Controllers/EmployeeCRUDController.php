<?php

namespace App\Http\Controllers;

use App\Models\Employees;
use App\Models\User;
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
        $employees = DB::table('users')->whereNotNull('rvm_id')->paginate(5);
        // $employees = $employees->Paginate(5, ['*'], 'all');
        return view ('employees.index', compact('employees'));
    }
 
    
    public function create()
    {   
        return view('employees.create');
    }
 
   
    public function store(Request $request)
    {
        $input = User::create([
            'rvm_id' => $request->rvm,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ])->assignRole('employee');
        $validatedData = $request->validate([
            'email' => ['required','email'],
            'rvm_id' => ['required'],
        ]);
        //$input = $request->all();
       // Employees::create($input);
        //Toastr::success('Messages in here', 'Title'); 
        // $employees = new User();
        // $employees = $employees->Paginate(5, ['*'], 'all');
        $employees = DB::table('users')->whereNotNull('rvm_id')->paginate(5);
        return view ('employees.index', compact('employees'));
    }
 
    
    public function show($id)
    {
        $employees = User::find($id);
        $limit = 100;


        $result1 = monitorPlastics::where('rvm_id', $employees->rvm_id)->sum('pieces');
        $plastics = monitorPlastics::where('rvm_id', $employees->rvm_id);
        $plasticsLog = $plastics->Paginate(7, ['*'], 'all');
        $plasticweight = $result1 / $limit;
        $plastic = $plasticweight;

        $result2 = monitorTincans::where('rvm_id', $employees->rvm_id)->sum('pieces');
        $cans = monitorTincans::where('rvm_id', $employees->rvm_id);
        $cansLog = $cans->Paginate(7, ['*'], 'all');
        $cansweight = $result2 / $limit; 
        $tincans = $cansweight;
   
        $coinsLog = monitorCoins::latest()->first();   
        $currentCoins = $coinsLog->coins_total; 
        $coins = $currentCoins / 200;

        $coin = monitorCoins::where('rvm_id', $employees->rvm_id);
        $coinTable = $coin->Paginate(7, ['*'], 'all');
        return view('employees.show',compact('plasticweight','cansweight','currentCoins','coinTable','employees','plastic','tincans','coins','plasticsLog','cansLog'));
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
    public function search(Request $request)
    {
    $search = $request->get('search');
    $employees = User::where('name', 'like', "%{$search}%")->paginate(5);
    return view('employees.index', ['employees' => $employees]);
    }

        
    }
