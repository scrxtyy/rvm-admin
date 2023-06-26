<?php

namespace App\Http\Controllers;

use App\Models\UserReports;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// use Jimmyjs\ReportGenerator\ReportMedia\PdfReport;
use Jimmyjs\ReportGenerator\ReportMedia\CSVReport;


class RecordsController extends Controller
{
    public function displayLogs(){
        $logs = DB::table('user_reports')->paginate(20);
        return view ('employees.logs', compact('logs'));
    }
    public function downloadPDF(Request $request){
        $startDate = $request->startDate;
        $endDate = $request->endDate;
        $logs = UserReports::whereBetween('created_at',[$startDate,$endDate])->get();
        view()->share('user_reports',$logs);
        ini_set('max_execution_time', 120);
        $pdf = PDF::loadView('pdf.logs',compact('logs','startDate','endDate'));
        return $pdf->download('reports.pdf');
    }
}
