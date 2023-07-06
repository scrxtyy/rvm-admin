<?php

namespace App\Http\Controllers;

use App\Models\monitorCoins;
use App\Models\monitorPlastics;
use App\Models\monitorTincans;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class DataController extends Controller
{
    public function downloadtincansPDF(Request $request){
        $startDate = $request->startDate;
        $endDate = $request->endDate;
        $cansLogs = monitorTincans::whereBetween('created_at',[$startDate,$endDate])->get();
        view()->share('monitor_tincans',$cansLogs);
        ini_set('max_execution_time', 120);
        $pdf = Pdf::loadView('pdf.tincanslogs',compact('cansLogs','startDate','endDate'));
        return $pdf->download('tincansreports.pdf');
    }
    public function downloadplasticsPDF(Request $request){
        $startDate = $request->startDate;
        $endDate = $request->endDate;
        $logs = monitorPlastics::whereBetween('created_at',[$startDate,$endDate])->get();
        view()->share('monitor_plastics',$logs);
        ini_set('max_execution_time', 120);
        $pdf = Pdf::loadView('pdf.plasticslogs',compact('logs','startDate','endDate'));
        return $pdf->download('plasticsreports.pdf');
    }
    public function downloadcoinsPDF(Request $request){
        $startDate = $request->startDate;
        $endDate = $request->endDate;
        $logs = monitorCoins::whereBetween('created_at',[$startDate,$endDate])->get();
        view()->share('monitor_coins',$logs);
        ini_set('max_execution_time', 120);
        $pdf = Pdf::loadView('pdf.coinslogs',compact('logs','startDate','endDate'));
        return $pdf->download('coinsreports.pdf');
    }
}
