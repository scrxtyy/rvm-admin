<?php

namespace App\Http\Controllers;

use App\Mail\PasswordChanged;
use App\Mail\RvmMail;
use App\Models\Employees;
use App\Models\Rvms;
use App\Models\User;
use App\Models\monitorCoins;
use App\Models\monitorPlastics;
use App\Models\monitorTincans;
use App\Models\Notifications;
use Brian2694\Toastr\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Collection\Paginate;
use DB;
use Illuminate\Support\Facades\Redirect;

class EmployeeCRUDController extends Controller
{
    public $message = "";
    public function index()
    {
        $employees = DB::table('users')->whereNotNull('rvm_id')->paginate(5);
        // $employees = $employees->Paginate(5, ['*'], 'all');
        return view ('employees.index', compact('employees'));
    }

    public function rvmTable(){
        $rvms = DB::table('rvms')->paginate(5);
        return view('employees.rvms', compact('rvms'));
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
            'password'=>['required','confirmed'],
        ]);
        
        $employees = DB::table('users')->whereNotNull('rvm_id')->paginate(5);
        $message = "Employee Successfully Added!";
        $color = "green";
        return view ('employees.index', compact('employees','message'));
    }
 
    
    public function show($id)
    {
        $employees = User::find($id);
        $limit = 0.1;

        $selecttotal= monitorPlastics::where('rvm_id',$employees->rvm_id);
        $sort = $selecttotal->latest()->first();
        $totalplastic = $sort->total_kg;
        
        $selecttotal1= monitorTincans::where('rvm_id',$employees->rvm_id);
        $sort1 = $selecttotal1->latest()->first();
        $totaltincans = $sort1->total_kg;

        $plasticBars = monitorPlastics::where('rvm_id', $employees->rvm_id)->selectRaw("DATE(created_at) as date, SUM(kg_Weight) as count")->groupBy('date')->get();
        $plasticweight = $totalplastic * $limit;
        $plastic = $plasticweight;

        $tinBars = monitorTincans::where('rvm_id', $employees->rvm_id)->selectRaw("DATE(created_at) as date, SUM(kg_Weight) as count")->groupBy('date')->get();
        $cansweight = $totaltincans * $limit; 
        $tincans = $cansweight;
    
        $coinsLog = monitorCoins::latest()->first();   
        $currentCoins = $coinsLog->coins_total; 
        $coins = $currentCoins / 200;

        return view('employees.show',compact('totalplastic','totaltincans','plasticweight','cansweight','currentCoins','employees','plastic','tincans','coins','plasticBars','tinBars'));
    }

    public function edit($id)
    {
        $employees = User::find($id);
        $message = "Employee Detail Successfully Updated!";
        return view('edit.edit',compact('employees', 'message'));
    }

    public function editrvm($id){
        $employees = User::find($id);
        return view('edit.editrvm')->with('employees', $employees);
    }

    public function editpassword($id){
        $employees = User::find($id);
        
        return view('edit.password')->with('employees', $employees);
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|confirmed|min:8',
        ]);
        $employees = User::find($request->id);
        if(Hash::check($request->current_password, $employees->password)) {
            $employees = User::find($request->id);
            $employees->password = Hash::make($request->new_password);
            // $employees->save();

            $email = $employees->email;
            Mail::to($email)->queue(new PasswordChanged());
            
            // $employees = DB::table('users')->whereNotNull('rvm_id')->paginate(5);
            // $message = "Successfully changed employee password.";
            // $color = "green";
            return redirect()->route('dashboard');
            //,compact('employees','message','color')
        }
        else{
            $message = "Incorrect old password.";
            $color = "red";
            return Redirect::back()->withErrors(['msg', 'Incorrect old password.']);
        }
    }
 
  
    public function update(Request $request, $id)
    {
        $employees = User::find($id);
        $input = $request->all();
        $employees->update($input);
        $message = "Successfully Updated Employee Details!";
        $color = "green";
        return redirect('dashboard')->with('message',$message)->with('color',$color);  
    }
 
   
    public function destroy($id)
    {
        User::destroy($id);
        return redirect('dashboard')->with('flash_message', 'Employees Deleted!');  
    }
    public function search(Request $request)
    {
    $search = $request->get('search');
    $employees = User::where('name', 'like', "%{$search}%")->paginate(5);
    return view('employees.index', ['employees' => $employees]);
    }

    public function clearsearch(Request $request){
        $employees = DB::table('users')->whereNotNull('rvm_id')->paginate(5);
        return view ('employees.index', compact('employees'));
    }

    public function showPlastic($id){
        $employees = User::find($id);
        
        $limit = 0.1;

        $selecttotal= monitorPlastics::where('rvm_id',$employees->rvm_id);
        $sort = $selecttotal->latest()->first();
        $totalplastic = $sort->total_kg;
        
        $selecttotal1= monitorTincans::where('rvm_id',$employees->rvm_id);
        $sort1 = $selecttotal1->latest()->first();
        $totaltincans = $sort1->total_kg;

        $plasticBars = monitorPlastics::where('rvm_id', $employees->rvm_id)->selectRaw("DATE(created_at) as date, SUM(kg_Weight) as count")->groupBy('date')->get();
        $plasticweight = $totalplastic * $limit;
        $plastic = $plasticweight;

        $tinBars = monitorTincans::where('rvm_id', $employees->rvm_id)->selectRaw("DATE(created_at) as date, SUM(kg_Weight) as count")->groupBy('date')->get();
        $cansweight = $totaltincans * $limit; 
        $tincans = $cansweight;
   
        $coinsLog = monitorCoins::latest()->first();   
        $currentCoins = $coinsLog->coins_total; 
        $coins = $currentCoins / 200;

        $plastics = monitorPlastics::where('rvm_id', $employees->rvm_id);
        $plasticsLog = $plastics->Paginate(5, ['*'], 'all');

        return view('logs.plastics', compact('totalplastic','totaltincans','employees','plasticsLog','plastic','coins','tincans','tinBars','plasticBars'));
    }
    
    public function showTincans($id){
        $employees = User::find($id);
        
        $limit = 0.1;
        
        $selecttotal= monitorPlastics::where('rvm_id',$employees->rvm_id);
        $sort = $selecttotal->latest()->first();
        $totalplastic = $sort->total_kg;
        
        $selecttotal1= monitorTincans::where('rvm_id',$employees->rvm_id);
        $sort1 = $selecttotal1->latest()->first();
        $totaltincans = $sort1->total_kg;

        $plasticBars = monitorPlastics::where('rvm_id', $employees->rvm_id)->selectRaw("DATE(created_at) as date, SUM(kg_Weight) as count")->groupBy('date')->get();
        $plasticweight = $totalplastic * $limit;
        $plastic = $plasticweight;

        $tinBars = monitorTincans::where('rvm_id', $employees->rvm_id)->selectRaw("DATE(created_at) as date, SUM(kg_Weight) as count")->groupBy('date')->get();
        $cansweight = $totaltincans * $limit; 
        $tincans = $cansweight;
   
        $coinsLog = monitorCoins::latest()->first();   
        $currentCoins = $coinsLog->coins_total; 
        $coins = $currentCoins / 200;

        
        $cans = monitorTincans::where('rvm_id', $employees->rvm_id);
        $cansLog = $cans->Paginate(5, ['*'], 'all');

        return view('logs.tincans', compact('totalplastic','totaltincans','employees','cansLog','plastic','coins','tincans','tinBars','plasticBars'));
        
    }

    
    public function showCoins($id){
        $employees = User::find($id);
        
        $limit = 0.1;

        $selecttotal= monitorPlastics::where('rvm_id',$employees->rvm_id);
        $sort = $selecttotal->latest()->first();
        $totalplastic = $sort->total_kg;
        
        $selecttotal1= monitorTincans::where('rvm_id',$employees->rvm_id);
        $sort1 = $selecttotal1->latest()->first();
        $totaltincans = $sort1->total_kg;

        $plasticBars = monitorPlastics::where('rvm_id', $employees->rvm_id)->selectRaw("DATE(created_at) as date, SUM(kg_Weight) as count")->groupBy('date')->get();
        $plasticweight = $totalplastic * $limit;
        $plastic = $plasticweight;

        $tinBars = monitorTincans::where('rvm_id', $employees->rvm_id)->selectRaw("DATE(created_at) as date, SUM(kg_Weight) as count")->groupBy('date')->get();
        $cansweight = $totaltincans * $limit; 
        $tincans = $cansweight;
   
        $coinsLog = monitorCoins::latest()->first();   
        $currentCoins = $coinsLog->coins_total; 
        $coins = $currentCoins / 200;

        
        $coin = monitorCoins::where('rvm_id', $employees->rvm_id);
        $coinTable = $coin->Paginate(5, ['*'], 'all');

        return view('logs.coins', compact('totalplastic','totaltincans','employees','coinTable','currentCoins','plastic','coins','tincans','tinBars','plasticBars'));
    }
    }
