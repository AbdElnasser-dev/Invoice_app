<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Customers_Report;
use App\Http\Controllers\Invoice_report;
use App\Http\Controllers\InvoiceArchiveController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\InvoicesAttachmentsController;
use App\Http\Controllers\InvoicesDetailController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SectionsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});
// Route::get('/logout', function () {
//     return view('auth.login');
// });


Auth::routes();
// Auth::routes(['register'=>false]);
Route::resource('invoices', InvoicesController::class);

Route::resource('sections', SectionsController::class);

Route::resource('products', ProductsController::class);

Route::get('/section/{id}',[InvoicesController::class,'getproducts']);

Route::get('/Status_show/{id}',[InvoicesController::class,'show'])->name("Status_show");

Route::post('/Status_Update/{id}',[InvoicesController::class,'Status_Update'])->name("Status_Update");

Route::get('/InvoicesDetails/{id}',[InvoicesDetailController::class,'edit']);

Route::get('/View_file/{invoice_number}/{file_name}',[InvoicesDetailController::class,'open_file']);

Route::get('/download/{invoice_number}/{file_name}',[InvoicesDetailController::class,'download_file']);

Route::post('delete_file',[InvoicesDetailController::class,'destroy'])->name('delete_file');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/Invoice_Paid',[InvoicesController::class,'Invoice_Paid']);

Route::get('/Invoice_unPaid',[InvoicesController::class,'Invoice_unPaid']);

Route::get('/Invoice_Partial',[InvoicesController::class,'Invoice_Partial']);

Route::resource('Invoice_Archive',InvoiceArchiveController::class);

Route::resource('InvoiceAttachments', InvoicesAttachmentsController::class);

Route::get('/edit_invoice/{id}', [InvoicesController::class,'edit']);

Route::get('/Print_invoice/{id}', [InvoicesController::class,'Print_invoice']);

Route::get('export_invoices', [InvoicesController::class,'export']);

Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
});

Route::get("/Invoice_report",[Invoice_report::class,'index']);

Route::post("/Search_invoices",[Invoice_report::class,'Search_invoices']);

Route::get('customers_report', [Customers_Report::class,'index']);

Route::post('Search_customers', [Customers_Report::class,'Search_customers']);

Route::get('MarkAsRead_all',[InvoicesController::class,'MarkAsRead_all'])->name('MarkAsRead_all');

Route::get('/{page}', [AdminController::class,'index']);


