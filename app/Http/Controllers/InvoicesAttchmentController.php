<?php

namespace App\Http\Controllers;

use App\Models\Invoices_Attchment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoicesAttchmentController extends Controller
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
        $this->validate($request , [
            'file_name' => 'max:4048',

        ], 
        [
            'file_name.max' => 'يجب أن يكون حجم المرفق أقل من 4 ميجابايت',
        ]);

        $image = $request->file('file_name');
        $file_name = $image->getClientOriginalName();

        $attachment = new Invoices_Attchment();
        $attachment->file_name = $file_name;
        $attachment->invoice_number = $request->invoice_number;
        $attachment->invoice_id = $request->invoice_id;
        $attachment->created_by = Auth::user()->name;
        $attachment->save();

        // move pic
        $imageName = $request->file_name->getClientOriginalName();
        $request->file_name->move(public_path('Attachments/' . $request->invoice_number) , $imageName);

        session()->flash('Add' , 'تم أضافة المرفق بنجاح');
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoices_Attchment $invoices_Attchment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoices_Attchment $invoices_Attchment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Invoices_Attchment $invoices_Attchment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoices_Attchment $invoices_Attchment)
    {
        //
    }
}
