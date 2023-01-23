<?php

namespace App\Http\Controllers;

use App\Mail\RvmMail;
use App\Models\Notifications;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class NotifController extends Controller
{
    public function notifs(){
        $notifications = Notifications::all();
        return view ('employees.notifs', compact('notifications'));

    }

    public function employeenotifications($id){
        $employees = User::find($id);
        $notifications = Notifications::where('sender_id',$employees->id)->get();

        return view('rvm.employeenotif',compact('notifications','employees'));
    }
    public function sendEmail(){
        Mail::to("allyyydelrosario@gmail.com")
        ->send(new RvmMail());

        return view('employees.dashboard');
    }
    public function assignTask($id){
        $employees = User::find($id);
        $name = $employees->name;
        return view('employees.assign',compact('id', 'name'));
    }

    public function insertAssign(Request $request){
        $notifs = new Notifications();
        $deadline = $request->deadlinedate ." ". $request->deadlinetime;
        $notifs->create([
            'name' => $request->name,
            'sender_id' => $request->id,
            'isAdmin'=> false,
            'message' => $request->selectTask,
            'notes' =>$request->description,
            'deadline' => $deadline,
        ]);

        if($request->selectTask=='Replenish Coins'){
            $notifs->create([
                'name' => $request->name,
                'sender_id' => $request->id,
                'isAdmin'=> false,
                'message' => $request->selectTask,
                'notes' =>$request->description,
                'coin_amount' =>$request->coinsamt,
                'deadline' => $deadline,
            ]);
        }

        $message = "Notification sent.";
        $color = "green";

        $task = $request->selectTask;
        $employees = User::find($request->id);
        $email = $employees->email;
        Mail::to($email)->queue(new RvmMail($task));

        return redirect('notifications')->with('message',$message)->with('color',$color);
    }
    public function notifyEmployee($id){
        $employees = User::find($id);
        $email = $employees->email;

        Mail::to($email)->send(new RvmMail());

        return view('employees.dashboard');

    }
}
