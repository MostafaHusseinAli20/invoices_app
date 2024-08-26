<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Invoices;
use App\Models\Product;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:التقارير' , 'permission:تقارير الفواتير'] , 
        ['only' => ['index' , 'Search_invoices']]);
    }
    //
    public function index()
    {
        return view('reports.invoices_report');
    }

    public function Search_invoices(Request $request)
    {
        $rdio = $request->rdio;

        if($rdio == 1)
        {
            // في حالة لم يحدد تاريخ الفاتورة
            if($request->type && $request->start_at == "" && $request->end_at == "")
            {
                $invoices = Invoices::select('*')->where('status','=',$request->type)->get();
                $type = $request->type;
                return view('reports.invoices_report' , compact('type'))->withDetails($invoices);
            }

            // في حالة لم يحدد تاريخ الأستحقاق
            else {
                $start_at = date($request->start_at);
                $end_at = date($request->end_at);
                $type = $request->type;

                $invoices = Invoices::whereBetween('invoice_date' , [$start_at , $end_at])
                ->where('status','=',$request->type)->get();
                return view('reports.invoices_report' , compact('type' , 'start_at', 'end_at'))
                ->withDetails($invoices);
            }
        }

        // لو البحث كان برقم الفاتورة
        else {
            $invoices = Invoices::select('*')->where('invoice_number','=',$request->invoice_number)->get();
            return view('reports.invoices_report')->withDetails($invoices);
        }
    }
}
