<?php

namespace App\Http\Controllers;

use App\Events\TestEvent;
use App\Events\UpdateDropdown;
use App\Events\UpdateElementEvent;
use App\Mail\RvmMail;
use App\Models\Notifications;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Response;
use Intervention\Image\ImageManagerStatic as Image;
use Pusher\Pusher;
use Carbon\Carbon;

class NotifController extends Controller
{
    public function testupdate(){
        
        $options = array(
            'cluster' => 'ap1',
            'useTLS' => true
        );

        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );

        $data = 'test text';
        $pusher->trigger('update-dropdown','update',$data);
        UpdateDropdown::dispatch($data);
        return redirect('notifications');
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
        $notifs->create([
            'name' => $request->name,
            'sender_id' => $request->id,
            'rvm_id' => $request->rvmid,
            'isAdmin'=> false,
            'message' => $request->selectTask,
            'notes' =>$request->description,
            'deadline' => $deadline,
        ]);

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

        $notify = "RVM Admin sent you a task. ".

        $task = $request->selectTask;
        $employees = User::find($request->id);
        $email = $employees->email;
        Mail::to($email)->queue(new RvmMail($task));

        $test = "test";
        UpdateDropdown::dispatch($test);
        UpdateElementEvent::dispatch($notify);
        $message = "Notification sent to RVM ID: ". $request->rvmid;
        session(['message' => $message]);
        
        return redirect()->route('notifications');
    }

    public function uploadProof(Request $request){
        $image = $request->proof;
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(300,200)->save('image/'.$name_gen);
            
        DB::table('notifications')->where('id',$request->id)->update(['proof' => 'image/'.$name_gen]);
        DB::table('notifications')->where('id', $request->id)->update(['status' => "For verification"]);

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
    public function updateDropdown($id)
    {
    $notifications = DB::table('notifications')->where('sender_id',$id)->latest()->get();

    event(new UpdateDropdown($notifications));
    }

}
