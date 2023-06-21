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
        $logs = DB::table('user_reports')->paginate(10);
        return view ('employees.logs', compact('logs'));
    }
    public function downloadPDF(){
        // $logssql = UserReports::all();
        // foreach ($logssql as $log) {
        //     echo $log->action;
        // }
        // $logs = $logssql->toArray();
        // $pdf = Pdf::loadView('employees.logs',$logs);
        // return $pdf->download('Downloads/logs.pdf');
        $logs = UserReports::all();
        view()->share('user_reports',$logs);
        ini_set('max_execution_time', 120);
        $pdf = PDF::loadView('employees.logs')->setOption(['defaultFont' => 'sans-serif']);
        return $pdf->download('reports.pdf');
    }
    // public function downloadPDF(Request $request){
    //     $fromDate = $request->startDate;
    //     $toDate = $request->endDate;
    
    //     $title = 'User Logs Report'; // Report title

    //     $meta = [ // For displaying filters description on header
    //         'User logs from ' => $fromDate . ' To ' . $toDate,
    //     ];

    //     $queryBuilder = UserReports::select(['user_type','user_id','created_at'])
    //                         ->whereDate('created_at', '>=', $fromDate)
    //                         ->whereDate('created_at', '<=', $toDate)
    //                         ->orderBy('created_at', 'ASC');
    //     foreach($queryBuilder as $order){
    //         $userName = $order->user_id->name;
    //     }
    //     $columns = [ // Set Column to be displayeds
    //         'User Type' => 'user_type',
    //         'User ID' => 'user_id',
    //         'Registered At' => 'created_at', 
    //     ];

    //     // Generate Report with flexibility to manipulate column class even manipulate column value (using Carbon, etc).
    //     return PdfReport::of($title, $meta, $queryBuilder, $columns)
    //         ->editColumn('Registered At', [ // Change column class or manipulate its data for displaying to report
    //             'displayAs' => function($result) {
    //                 return $result->created_at->format('d M Y');
    //             },
    //             'class' => 'left'
    //         ])
    //         ->editColumns(['Registered At','Total'], [ // Mass edit column
    //             'class' => 'right bold'
    //         ])
    //         ->showTotal([ // Used to sum all value on specified column on the last table (except using groupBy method). 'point' is a type for displaying total with a thousand separator
    //             'Total' => 'point' // if you want to show dollar sign ($) then use 'Total Balance' => '$'
    //         ])
    //         ->limit(20) // Limit record to be showed
    //         ->download($fromDate.'-'.$toDate); // other available method: store('path/to/file.pdf') to save to disk, download('filename') to download pdf / make() that will producing DomPDF / SnappyPdf instance so you could do any other DomPDF / snappyPdf method such as stream() or download()
    //         return view('employees.logs');
    // }
}
