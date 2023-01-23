<?php

namespace App\Http\Controllers;

use App\Models\Rvms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RVMController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rvms = DB::table('rvms')->paginate(5);
        return view('rvmcrud.rvmindex')->with('rvms',$rvms);
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
        $input = Rvms::create([
            'rvm_id' => $request->rvm_id,
            'location' => $request->location,
        ]);
        
        $rvms = DB::table('rvms')->paginate(5);
        return view ('employees.rvms')->with('rvms',$rvms);
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
        return view('rvmcrud.rvmshow')->with('rvms',$rvms);
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
        return redirect('employees.rvms');  
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
        return redirect('employees.rvms');  
    }
}
