<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Invoices;
use App\Models\Invoices_Attchment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InvoicesArchive extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:الفواتير المؤرشفة'] , ['only' => ['index' , 'update' , 'destroy']]);
    }

    public function index()
    {
        $invoices = Invoices::onlyTrashed()->get();
        return view('invoices.archiveInvoices' , compact('invoices'));
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        
        $id = $request->invoice_id;
        $restore = Invoices::withTrashed()->where('id', $id)->restore();
        
        session()->flash('restore_invocice');
        return redirect('/invoices');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $delete_invoice_archive = Invoices::withTrashed()->where('id' , $request->invoice_id)->first();
        $delete_invoice_archive->forceDelete();

        session()->flash('delete_archive_invoice');
        return redirect('/archive');
    }
}
