<?php

namespace App\Http\Controllers;

use App\Models\monitorCoins;
use App\Models\monitorPlastics;
use App\Models\monitorTincans;
use App\Models\Rvms;
use App\Models\UserReports;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RVMController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allRvms = DB::table('rvms')->paginate(5);
        return view('employees.rvms')->with('allRvms',$allRvms);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('rvmcrud.rvmcreate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $location = "Brgy. ".$request->barangay.", ".$request->city.",".$request->province;
        Rvms::create([
            'rvm_id' => $request->rvm_id,
            'location' => $location,
        ]);
         //REPORT
            $input2 = UserReports::create([
                'user_type'=>'0',
                'user_id'=> '19',
                'action'=> 'RVM: ' .Str::upper($request->rvm_id).' has been created.'
                
            ]);
        //END OF REPORT
        session(['message' => 'RVM Successfully created!']);
        return redirect()->route('rvm');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $rvms = Rvms::find($id);

        $selecttotal= monitorPlastics::where('rvm_id',$rvms->rvm_id)->latest()->first();
        $totalplastic = $selecttotal->total_kg;
        
        $selecttotal1= monitorTincans::where('rvm_id',$rvms->rvm_id)->latest()->first();
        $totaltincans = $selecttotal1->total_kg;

        $coinsLog = monitorCoins::where('rvm_id',$rvms->rvm_id)->latest()->first(); 
        $currentCoins = $coinsLog->coins_total;

        $plasticBars = monitorPlastics::where('rvm_id', $rvms->rvm_id)->selectRaw("DATE(created_at) as date, SUM(kg_Weight) as count")->groupBy('date')->get();

        $tinBars = monitorTincans::where('rvm_id', $rvms->rvm_id)->selectRaw("DATE(created_at) as date, SUM(kg_Weight) as count")->groupBy('date')->get();
        
        $plastics = monitorPlastics::where('rvm_id', $rvms->rvm_id)->latest();
        $plasticsLog = $plastics->Paginate(5, ['*'], 'plastics');

        $cans = monitorTincans::where('rvm_id', $rvms->rvm_id)->latest();
        $cansLog = $cans->Paginate(5, ['*'], 'tincans');

        $coin = monitorCoins::where('rvm_id', $rvms->rvm_id)->latest();
        $coinTable = $coin->Paginate(5, ['*'], 'coins');
  
        return view('rvmcrud.rvmshow',compact('coinTable','cansLog','plasticsLog','totalplastic','totaltincans','currentCoins','rvms','plasticBars','tinBars'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rvms = Rvms::find($id);
        return view('rvmcrud.rvmedit')->with('rvms', $rvms);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rvms = Rvms::find($id);
        $input = $request->all();
        $rvms->update($input);
        
        //REPORT
          UserReports::create([
            'user_type'=>'0',
            'user_id'=> '19',
            'action'=> 'RVM: ' .$id.' details has been updated.'
            
            ]);
        //END OF REPORT
        
        session(['edited' => 'RVM details has been successfully updated.']);
        return redirect()->route('rvm');  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Rvms::destroy($id);
        //REPORT
            $input2 = UserReports::create([
                'user_type'=>'0',
                'user_id'=> '19',
                'action'=> 'RVM: ' .Str::upper($id).' has been deleted.'
                
            ]);
        //END OF REPORT
        
        session(['deleted' => 'RVM has been deleted.']);
        return redirect()->route('rvm'); 
    }

    public function updatePrice(Request $request){
        $admin = Auth::user();
        $hashedPassword = $admin ? $admin->getAuthPassword() : null;
        if (Hash::check($request->password, $hashedPassword)) {
            DB::table('grams_to_coins')->where('id', 1)->update([$request->waste => $request->gramsperpiso]);     
            session(['message' => 'Grams per coins successfully updated!']);
        } else {
            session(['incorrect' => 'Incorrect Admin password!']);
        }
        return redirect()->back();
    }
}
