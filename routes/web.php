<?php

use App\Http\Controllers\Customers_Report;
use App\Http\Controllers\InvoicesArchive;
use App\Http\Controllers\InvoicesAttchmentController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\InvoicesDetailsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;

Route::get('/', function () {
    return view('auth.login');
});

// Route::get('/{page}', 'AdminController@index');

//Auth::routes();
Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');

Route::resource('invoices' , InvoicesController::class)->middleware('auth');

Route::resource('sections' , SectionController::class)->middleware('auth');

Route::resource('products' , ProductController::class)->middleware('auth');

Route::resource('InvoiceAttachments' , InvoicesAttchmentController::class)->middleware('auth');

Route::get('/section/{id}', 'App\Http\Controllers\InvoicesController@getproducts')->middleware('auth');

Route::get('/InvoicesDetails/{id}' , [InvoicesDetailsController::class , 'show'])->middleware('auth');

Route::get('download/{invoice_number}/{file_name}', [InvoicesDetailsController::class , 'get_file'])->middleware('auth');

Route::get('View_file/{invoice_number}/{file_name}', [InvoicesDetailsController::class , 'open_file'])->middleware('auth');

Route::post('delete_file', [InvoicesDetailsController::class , 'destroy'])->name('delete_file')->middleware('auth');

Route::get('/edit_invoice/{id}', 'App\Http\Controllers\InvoicesController@edit')->middleware('auth');

Route::get('/show_status/{id}', [InvoicesController::class, 'show'])->name('show_status')->middleware('auth');

Route::post('/status_update/{id}', [InvoicesController::class, 'status_update'])->name('status_update')->middleware('auth');

Route::get('/UnPaidInvoices' , [InvoicesController::class, 'invoice_UnPaid'])->name('invoice_UnPaid')->middleware('auth');

Route::get('/paid_Invoices' , [InvoicesController::class, 'invoice_Paid'])->name('paid_Invoices')->middleware('auth');

Route::get('/paidPart_Invoices' , [InvoicesController::class, 'invoice_PaidPart'])->name('paidPart_Invoices')->middleware('auth');

Route::resource('archive' , InvoicesArchive::class)->middleware('auth');

Route::get('/print_invoice/{id}' , [InvoicesController::class, 'print_invoice'])->name('print_invoice')->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
});

Route::get('invoices_Report' , [ReportController::class , 'index'])->name('report.index')->middleware('auth');

Route::post('Search_invoices' , [ReportController::class, 'Search_invoices'])->middleware('auth');

Route::get('/customers_report' , [Customers_Report::class, 'index'])->middleware('auth');

Route::post('/Search_customers' , [Customers_Report::class, 'Search_customers'])->middleware('auth');

Route::get('MarkAsRead' , [InvoicesController::class, 'MarkAsRead'])->name('MarkAsRead')->middleware('auth');

Route::get('/{page}', 'App\Http\Controllers\AdminController@index')->middleware('auth');

Route::redirect('/index' , '/home')->middleware('auth');