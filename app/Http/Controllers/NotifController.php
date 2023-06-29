<?php

namespace App\Http\Controllers;

use App\Events\NotifyUser;
use App\Events\UpdateNotifCount;
use App\Mail\RvmMail;
use App\Models\fullStorageNotifications;
use App\Models\Notifications;
use App\Models\User;
use App\Models\UserReports;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Response;
use Intervention\Image\ImageManagerStatic as Image;
use Pusher\Pusher;
use Carbon\Carbon;

class NotifController extends Controller
{
    public function storageBlade(){
        $storageTable = fullStorageNotifications::latest()->get();
        return view('employees.fullstorage')->with('storageTable',$storageTable);
    }
    public function notifs(){
        $notifications = Notifications::latest()->get();
        return view ('employees.notifs', compact('notifications'));

    }

    public function employeenotifications($id){
        $employees = User::find($id);
        $notifications = Notifications::where('sender_id',$employees->id)->latest()->get();
        $rvmid = User::where('id',$employees->id);

        return view('rvm.employeenotif',compact('notifications','employees','rvmid'));
    }
    public function assignTask($id){
        $employees = User::find($id);

        $name = $employees->name;
        $rvmid = $employees->rvm_id;
        return view('employees.assign',compact('id', 'name', 'rvmid'));
    }

    public function insertAssign(Request $request){
        $notifs = new Notifications();
        $deadline = $request->deadlinedate ." ". $request->deadlinetime;

        if($request->selectTask=='Replenish Coins'){
            $notifs->create([
                'name' => $request->name,
                'sender_id' => $request->id,
                'rvm_id' => $request->rvmid,
                'isAdmin'=> false,
                'message' => $request->selectTask,
                'notes' =>$request->description,
                'coin_amount' =>$request->coinsamt,
                'deadline' => $deadline,
            ]);
        }
        else{
            $notifs->create([
                'name' => $request->name,
                'sender_id' => $request->id,
                'rvm_id' => $request->rvmid,
                'isAdmin'=> false,
                'message' => $request->selectTask,
                'notes' =>$request->description,
                'deadline' => $deadline,
            ]);
        }

        $notify = "RVM Admin sent you a task. ".

        $task = $request->selectTask;
        $employees = User::find($request->id);
        $email = $employees->email;
        Mail::to($email)->queue(new RvmMail($task));
        
        $count = Notifications::where('sender_id', '=', $request->id)->where('isread', '=', 0)->count();
        
        //REPORT
            UserReports::create([
                'user_type'=>'0',
                'user_id'=> '19',
                'action'=> 'Assigned task to '.$task.' to employee with user ID: ' .$request->id,
                
                ]);
        //END OF REPORT
        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            [
                'cluster' => 'ap1',
                'useTLS' => true
            ]
        );
        
        $events = [
        //     [
        //         'channel' => 'notify-user',
        //         'name' => 'notif',
        //         'data' => $notify
        //     ],
            [
                'channel' => 'update-count',
                'name' => 'count',
                'data' => $count
            ]
        ];
        
        $pusher->triggerBatch($events);

        //UpdateNotifCount::dispatch($count);
        NotifyUser::dispatch($notify);

        $message = "Notification sent to RVM ID: ". $request->rvmid;
        session(['message' => $message]);
        
        return redirect()->route('notifications');
    }

    public function uploadProof(Request $request){
        $errors = [
            'proof.image' => 'Proof must be in an image format. (JPEG, JPG, PNG)',
        ];
        $request->validate([
            'proof' => 'image|mimes:jpeg,jpg,png',
        ],$errors);

        $image = $request->proof;
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(300,200)->save('image/'.$name_gen);
       
        DB::table('notifications')->where('id',$request->id)->update(['proof' => 'image/'.$name_gen]);
        DB::table('notifications')->where('id', $request->id)->update(['status' => "For verification"]);

        
            //REPORT
            UserReports::create([
                'user_type'=>'0',
                'user_id'=> Auth::id(),
                'action'=> 'Employee with user ID: '.Auth::id().'has uploaded proof of task ID: '.$request->id,
                
                ]);
            //END OF REPORT

        $message = "Proof successfully submitted! Please wait for admin approval.";
        session(['message' => $message]);
        return redirect()->back();
    }

    public function verifyProof(Request $request){
        DB::table('notifications')->where('id', $request->id)->update(['status' => "Done"]);
        DB::table('notifications')->where('id', $request->id)->update(['verified_at' => Carbon::now()]);

        return redirect('notifications');
    }

    public function viewnotif($id){
        $notif = Notifications::find($id);

        DB::table('notifications')->where('id', $id)->update(['isread' => 1]);
        
        return view('rvm.shownotif',compact('notif'));

    }

}
