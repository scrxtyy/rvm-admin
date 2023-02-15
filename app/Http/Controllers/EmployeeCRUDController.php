<?php

namespace App\Http\Controllers;

use App\Mail\AccountCreated;
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
        $errors = [
            'password.required' => 'Password field is required.',
            'password.confirmed' => 'Password does not match.',  
            'password.min' => 'Password must be at least 8 characters.',
        ];
        $request->validate([
            'password' => 'required|confirmed|min:8',
        ],$errors);
        
        $input = User::create([
            'rvm_id' => $request->rvm,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ])->assignRole('employee');

        $toEmail = [
            'rvm_id'=>$request->rvm,
            'name'=>$request->name,
            'email' =>$request->email,
            'password'=>$request->password,
        ];
        Mail::to($request->email)->queue(new AccountCreated($toEmail));
      
        $message = "Employee Successfully Added!";
        session(['message' => $message]);
        return redirect()->route('dashboard');
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
    
        $coinsLog = monitorCoins::where('rvm_id',$employees->rvm_id);   
        $sort2 = $coinsLog->latest()->first(); 
        $currentCoins = $sort2->coins_total; 
        $coins = $currentCoins / 200;
        
        $plastics = monitorPlastics::where('rvm_id', $employees->rvm_id)->latest();
        $plasticsLog = $plastics->Paginate(5, ['*'], 'plastics');

        $cans = monitorTincans::where('rvm_id', $employees->rvm_id)->latest();
        $cansLog = $cans->Paginate(5, ['*'], 'tincans');

        $coin = monitorCoins::where('rvm_id', $employees->rvm_id)->latest();
        $coinTable = $coin->Paginate(5, ['*'], 'coins');

        return view('employees.show',compact('coinTable','cansLog','plasticsLog','totalplastic','totaltincans','plasticweight','cansweight','currentCoins','employees','plastic','tincans','coins','plasticBars','tinBars'));
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
        $errors = [
            'current_password.required' => 'The current password field is required.',
            'new_password.required' => 'The new password field is required.',
            'new_password.confirmed' => 'The new password does not match.',  
            'new_password.min' => 'The new password must be at least 8 characters.',
        ];

        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|confirmed|min:8',
        ],$errors);

        $employees = User::find($request->id);
        if(!Hash::check($request->current_password, $employees->password)) {
            return redirect()->back()->withErrors(['current_password' => 'The current password is incorrect.']);
        }
        $employees = User::find($request->id);
        $employees->password = Hash::make($request->new_password);

        $email = $employees->email;
        Mail::to($email)->queue(new PasswordChanged());

        $message = "Employee Password has been changed.";
        session(['message' => $message]);
        return redirect()->back();
    }
 
  
    public function update(Request $request, $id)
    {
        $employees = User::find($id);
        $input = $request->all();
        $employees->update($input);
        $message = "Successfully Updated Employee Details!";
        session(['message' => $message]);
        return redirect()->route('dashboard');  
    }
 
   
    public function destroy($id)
    {
        User::destroy($id);
        $deletemessage = "Employee deleted.";
        session(['deletemessage' => $deletemessage]);
        return redirect()->route('dashboard');  
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
    public function sort(Request $request)
    {
        $column = $request->get('column');
        $order = $request->get('order');
        if($order == "asc"){
            $ordermsg = "Ascending";
        }
        if($order == "desc"){
            $ordermsg = "Descending";
        }
        $notifications = Notifications::orderBy($column, $order)->paginate(10);
        $sorted = "Sorted by " . "'". $column ."' in ". $ordermsg . " order.";
        return view('employees.notifs')->with('notifications', $notifications)->with('sorted',$sorted);
    }

    public function filter(Request $request){
        $status = $request->status;
        if ($request->status == "Incomplete") {
            $status = null;
        }
    $notifications = Notifications::where('rvm_id', '=', $request->rvmid)
        ->where('status', '=', $status)->get();

    $filtered = "Showing only " . "'".$request->status ."' status for RVM ID: ". $request->rvmid;
    return view('employees.notifs')->with('notifications',$notifications)->with('filtered',$filtered); 
    }

    public function filterEmployee(Request $request){
        $status = $request->status;
        if ($request->status == "Incomplete") {
            $status = null;
        }
    $notifications = Notifications::where('rvm_id', '=', $request->rvmid)
        ->where('status', '=', $status)->get();

    $filtered = "Showing only " . "'".$request->status ."' status for RVM ID: ". $request->rvmid;
    return view('rvm.employeenotif')->with('notifications',$notifications)->with('filtered',$filtered); 
    }

    public function sortEmployee(Request $request)
    {
        $column = $request->column;
        $order = $request->order;
        
        $employees = Auth::user();
        $notif = Notifications::where('sender_id',$employees->id)->get();

        $notifications = $notif->sort(function($a, $b) use ($column, $order) {
            if($order == 'asc')
                return $a->{$column} <=> $b->{$column};
            else
                return $b->{$column} <=> $a->{$column};
        });
        return view('rvm.employeenotif')->with('notifications', $notifications);
    }

    }
