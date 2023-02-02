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
    public function testupdate2(){
        $lol = "test";
        event(new TestEvent($lol));
        redirect()->back();
    }

    public function testupdate(){
        $lol = "test";
        event(new UpdateDropdown($lol));
        redirect()->back();
    }
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

        $notify = "RVM Admin sent you a task. ".

        $task = $request->selectTask;
        $employees = User::find($request->id);
        $email = $employees->email;
        Mail::to($email)->queue(new RvmMail($task));

        $notif_dropdown = Notifications::where('sender_id',$employees->id)->latest()->get();
        $lol = "test";
        // event(new UpdateDropdown($lol));
        UpdateElementEvent::dispatch($notify);

        return redirect('notifications')->with('message',$message)->with('color',$color);
    }

    public function uploadProof(Request $request){
        $image = $request->proof;
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(300,200)->save('image/'.$name_gen);
            
        DB::table('notifications')->where('id',$request->id)->update(['proof' => 'image/'.$name_gen]);
        DB::table('notifications')->where('id', $request->id)->update(['status' => "For verification"]);

        $message = "Task marked as done! Please wait for admin approval.";
        return redirect()->back()->with('message',$message);
    }

    public function verifyProof(Request $request){
        DB::table('notifications')->where('id', $request->id)->update(['status' => "Done"]);
        DB::table('notifications')->where('id', $request->id)->update(['verified_at' => Carbon::now()]);


        return redirect('notifications');

    }

    public function getImage($id){
        $rendered_buffer= Notifications::all()->find($id)->proof;

        $response = Response::make($rendered_buffer);
        $response->header('Content-Type', 'image/png');
        $response->header('Cache-Control','max-age=2592000');
        return $response;
    }

    // public function sendNotification(){
    // $pusher = new Pusher(
    //     env('bc1280fa0058a73f5332'),
    //     env('c2cdead1ab85105ac669'),
    //     env('1542720'),
    //     [
    //         'cluster' => env('ap1'),
    //         'useTLS' => true
    //     ]
    // );

    // $pusher->trigger('update-element', 'my-event', ['message' => 'Notification sent!']);
    // }

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
