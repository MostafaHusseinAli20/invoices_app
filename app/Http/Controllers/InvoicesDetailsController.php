<?php

namespace App\Http\Controllers;

use App\Models\Invoices_Details;
use App\Http\Controllers\Controller;
use App\Models\Invoices;
use App\Models\Invoices_Attchment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InvoicesDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $invoices = Invoices::where('id' , $id)->first();
        $details = Invoices_Details::where('id_Invoice', $id)->get();
        $attchments = Invoices_Attchment::where('invoice_id', $id)->get();
        return view('invoices.InvoicesDetails' , compact('invoices' , 'details' , 'attchments'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoices_Details $invoices_Details)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Invoices_Details $invoices_Details)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $deleted = Invoices_Attchment::find($request->id_file);
        $deleted->delete();
        Storage::disk('public_uploads')->delete($request->invoice_number . '/' . $request->file_name);
        session()->flash('delete', 'تم حذف المرفق بنجاح');
        return back();
    }

    // Download File
    public function get_file($invoice_number,$file_name)

    {
            $download = Storage::disk('public_uploads')->path($invoice_number.'/'.$file_name);

            if (Storage::disk('public_uploads')->exists($invoice_number.'/'.$file_name)) {
                
                return response()->download($download);
            } else {
                
                return abort(404, 'File not found.');
            }
    }

    // Display File
    public function open_file($invoice_number,$file_name)

    {
            $file = Storage::disk('public_uploads')->path($invoice_number.'/'.$file_name);

            if (Storage::disk('public_uploads')->exists($invoice_number.'/'.$file_name)) {
                return response()->file($file);

            } else {

                return abort(404, 'File not found.');
            }
    }

}
