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
    public function assignTask($id){
        $employees = User::find($id);
    
        return view('employees.assign',compact('id'));
    }

    public function insertAssign(Request $request){
        $assign = Notifications::create([
            'name' => $request->name,
            'sender_id' => $request->id,
            'isAdmin'=> false,
            'message' => $request->description,
            'deadline' => $request->deadline,
        ]);

        return redirect('dashboard');
    }
    public function notifyEmployee($id){
        $employees = User::find($id);
        $email = $employees->email;

        Mail::to($email)->send(new RvmMail());

        return view('employees.dashboard');

    }
}
