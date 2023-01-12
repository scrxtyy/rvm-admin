<?php

namespace App\Http\Controllers;

use App\Mail\RvmMail;
use App\Models\Notifications;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
}
