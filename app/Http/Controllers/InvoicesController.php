<?php

namespace App\Http\Controllers;

use App\Models\Invoices;
use App\Models\Section;
use App\Http\Controllers\Controller;
use App\Models\Invoices_Attchment;
use App\Models\Invoices_Details;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Auth\SessionGuard;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Notifications\sendEmaill;
use Illuminate\Support\Facades\Notification;
use App\Notifications\Add_Invocie;

class InvoicesController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:الفواتير' , 'permission:قائمة الفواتير'] , ['only' => ['index']]);
        $this->middleware(['permission:أضف فاتورة'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:تعديل الفاتورة'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:تغير حالة الدفع'], ['only' => ['status_update']]);
        $this->middleware(['permission:طباعةالفاتورة'], ['only' => ['print_invoice']]);

        $this->middleware(['permission:الفواتير المدفوعة'], ['only' => ['invoice_Paid']]);
        $this->middleware(['permission:الفواتير الغير مدفوعة'], ['only' => ['invoice_UnPaid']]);
        $this->middleware(['permission:الفواتير المدفوعة جزئيا'], ['only' => ['invoice_PaidPart']]);
        
        $this->middleware(['permission:حذف الفاتورة' , 'permission: نقل الي الارشيف'], 
        ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $invoices = Invoices::all();
        $sections = Section::all();
        return view('invoices.invoices' , compact('invoices' , 'sections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $sections = Section::all();
        return view('invoices.create' , compact('sections'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $vaidator = $request->validate([
            'invoice_number' => 'required',
            'invoice_date' => 'required',
            'due_date' => 'required',
            'amount_collection' => 'required',
            'amount_commission' => 'required',
            'rate_vat' => 'required',
            
            'product' => 'required',
            'discount' => 'required',
            
        ],
        [
            'invoice_number.required' => 'يرجي أدخال رقم الفاتورة',
            'invoice_date.required' =>'يرجي أدخال تاريخ الفاتورة',
            'due_date.required' => 'يرجي أدخال تاريخ الأستحقاق',
            'amount_collection.required' => 'يرجي أدخال مبلغ التحصيل ',
            'amount_commission.required' => 'يرجي أدخال مبلغ العمولة',
            'rate_vat.required' => 'يرجي تحديد نسبة الضريبة',
            
            'product.required' => 'يرجي تحديد المنتج',
            'discount.required' => 'يرجي أدخال مبلغ الخصم'
            
        ]);
        // Create a new Invoice in DB
            Invoices::create([
            'invoice_number' => $request->invoice_number,
            'invoice_date' => $request->invoice_date,
            'due_date' => $request->due_date,
            'product' => $request->product,
            'section_id' => $request->Section,
            'amount_collection' => $request->amount_collection,
            'amount_commission' => $request->amount_commission,
            'discount' => $request->discount,
            'value_vat' => $request->value_vat,
            'rate_vat' => $request->rate_vat,
            'total' => $request->total,
            'status' => 'غير مدفوعة',
            'value_status' => 2,
            'note' => $request->note,
        ]);
        
        // Create a new Invoice Detail in DB
        $invoices_id = Invoices::latest()->first()->id;
        Invoices_Details::create([
            'id_Invoice' => $invoices_id,
            'invoice_number' => $request->invoice_number,
            'product' => $request->product,
            'Section' => $request->Section,
            'status' => 'غير مدفوعة',
            'value_status' => 2,
            'note' => $request->note,
            'user' => (Auth::User()->name)
        ]);

        // Create a new Invoice Attchment in DB
        if ($request->hasFile('pic')) {

            $invoice_id = Invoices::latest()->first()->id;
            $image = $request->file('pic');
            $file_name = $image->getClientOriginalName();
            $invoice_number = $request->invoice_number;

            $attachments = new Invoices_Attchment();
            $attachments->file_name = $file_name;
            $attachments->invoice_number = $invoice_number;
            $attachments->created_by = Auth::user()->name;
            $attachments->invoice_id = $invoice_id;
            $attachments->save();

            // move pic
            $imageName = $request->pic->getClientOriginalName();
            $request->pic->move(public_path('Attachments/' . $invoice_number), $imageName);
        }

            $user = Auth::user();
            $invoice_id = Invoices::latest()->first()->id;
            Notification::send($user, new sendEmaill($invoice_id));

            
            $sendEmailUserDB = User::get();
            $Invoices = Invoices::latest()->first();
            Notification::send($sendEmailUserDB, new Add_Invocie($Invoices)); 

            session()->flash('Add' , 'تم أضافة الفاتورة بنجاح');
            return redirect('/invoices');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $invoice = Invoices::where("id" , $id)->first();
        return view('invoices.status_update', compact('invoice'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $invoices = Invoices::where("id", $id)->first();
        $sections = Section::all();
        return view('invoices.editInvoices' , compact('invoices', 'sections'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        // Update Invoices
        $invoices = Invoices::find($request->invoice_id);
        $invoices->update([
            'invoice_number' => $request->invoice_number,
            'invoice_date' => $request->invoice_date,
            'due_date' => $request->due_date,
            'product' => $request->product,
            'section_id' => $request->Section,
            'amount_collection' => $request->amount_collection,
            'amount_commission' => $request->amount_commission,
            'discount' => $request->discount,
            'value_vat' => $request->value_vat,
            'rate_vat' => $request->rate_vat,
            'total' => $request->total,
            'note' => $request->note,
        ]);

        session()->flash('update' , 'تم تعديل المنتج بنجاح');
        return redirect('/invoices');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->invoice_id;
        $invoices = Invoices::where('id', $id)->first();
        $attachment = Invoices_Attchment::where('invoice_id', $id)->first();

        $id_page = $request->id_page;

        if(!$id_page == 2) {

            if (!empty($attachment->invoice_number)) {
                Storage::disk('public_uploads')->deleteDirectory($attachment->invoice_number);
            }
            
            $invoices->forceDelete();
            session()->flash('delete_invoice');
            return redirect('/invoices');
        }
        else {
            $invoices->Delete();
            session()->flash('archive_invoice');
            return redirect('/archive');
        }

    }

    public function getproducts($id) {
        $products = DB::table("products")->where("section_id", $id)->pluck("product_name", "id");
        return json_encode($products);
    }

    public function status_update($id , Request $request) {

        $invoices = Invoices::findOrFail($id);

        if ($request->status === 'مدفوعة') {
            $invoices->update([
                'value_status' => 1,
                'status' => $request->status,
                'payment_date' => $request->payment_date
            ]);

            Invoices_Details::create([
                'id_Invoice' => $request->id,
                'invoice_number' => $request->invoice_number,
                'product' => $request->product,
                'Section' => $request->Section,
                'status' => $request->status,
                'value_status' => 1 ,
                'payment_date' => $request->payment_date,
                'note' => $request->note,
                'user' => (Auth::user()->name),
            ]);
        }
        else {

            $invoices->update([
                'value_status' => 3,    
                'status' => $request->status,
                'payment_date' => $request->payment_date
            ]);

            Invoices_Details::create([
                'id_Invoice' => $request->id,
                'invoice_number' => $request->invoice_number,
                'product' => $request->product,
                'Section' => $request->Section,
                'status' => $request->status,
                'value_status' => 3 ,
                'payment_date' => $request->payment_date,
                'note' => $request->note,
                'user' => (Auth::user()->name),
            ]);
        }

        session()->flash('add_status');
        return redirect('/invoices');
    }

    public function invoice_UnPaid() {
        $invoices = Invoices::where('value_status' , 2)->get();
        return view('invoices.unPaidInvoice' , compact('invoices'));
    }

    public function invoice_Paid() {
        $invoices = Invoices::where('value_status' , 1)->get();
        return view('invoices.paidInvoices' , compact('invoices'));
    }

    public function invoice_PaidPart() {
        $invoices = Invoices::where('value_status' , 3)->get();
        return view('invoices.paidPartInvoices' , compact('invoices'));
    }

    public function print_invoice($id) 
    {
        $invoices = Invoices::where('id' , $id)->first();
        return view('invoices.print_invoice' , compact('invoices'));
    }

    public function MarkAsRead()
    {
        $userUnreadNotifiaction = auth()->user()->unreadNotifications;
        if($userUnreadNotifiaction)
        {
            $userUnreadNotifiaction->MarkAsRead();
            return back();
        }
    }
}
