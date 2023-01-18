<?php

namespace App\Http\Controllers;

use App\Mail\RvmMail;
use App\Models\Notifications;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class NotifController extends Controller
{
    public function notifs(){
        $notifications = Notifications::all();
        return view ('employees.notifs')->with('notifications', $notifications);

    }

    public function sendEmail(){
        Mail::to("allyyydelrosario@gmail.com")
        ->send(new RvmMail());

        return view('employees.dashboard');
    }
    public function assignTask(Request $request,$id){
        $employees = User::find($id);
    
        return view('employees.assign',compact('id'));
    }

    public function insertAssign(Request $request){
        $assign = Notifications::create([
            'sender_id' => $request->sender_id,
            'message' => $request->message,
            'deadline' => $request->deadline,
        ]);
    }
    public function notifyEmployee($id){
        $employees = User::find($id);
        $email = $employees->email;

        Mail::to($email)->send(new RvmMail());

        return view('employees.dashboard');

    }
}
