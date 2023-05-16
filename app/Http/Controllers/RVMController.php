<?php

namespace App\Http\Controllers;

use App\Models\monitorCoins;
use App\Models\monitorPlastics;
use App\Models\monitorTincans;
use App\Models\Rvms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
        
        $rvm = Rvms::oldest()->first();   
        $lastrvmid = $rvm->rvm_id;
        Rvms::create([
            'rvm_id' => $lastrvmid +1,
            'location' => $request->location,
        ]);
        
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
