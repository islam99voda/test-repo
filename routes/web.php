<?php

use Auth\ForgotPasswordController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\SectionsController;

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



//note: you shoud register first Befor login.
Route::get('/', function () {
    return view('auth.login');
});
// Authentication Routes...
Auth::routes();

//الصفحة الرئيسية
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//الفواتير/قائمة الفواتير
Route::get('invoices',[App\Http\Controllers\InvoicesController::class,'index']);
//----------------------------------------------------------------------------------------

//الاعدادات/ اضافة قسم
Route::get('sections',[SectionsController::class,'index']);
Route::post('sections',[SectionsController::class,'store'])->name('sections.store');
Route::get('sections/show',[SectionsController::class,'show'])->name('sections.show');
Route::get('sections/edit/{id}',[SectionsController::class,'edit'])->name('sections.edit');
Route::put('sections/update/{id}',[SectionsController::class,'update'])->name('sections.update');
Route::delete('sections/delete/{id}',[SectionsController::class,'destroy'])->name('sections.destroy');
//----------------------------------------------------------------------------------------


//الاعدادات/عرض المنتجات
Route::get('products',[ProductsController::class,'index']);
//اضافة وتعديل وحذف المنتجات
Route::post('products',[ProductsController::class,'store'])->name('products.store');
Route::get('products/show',[ProductsController::class,'show'])->name('products.show');
Route::get('products/edit/{id}',[ProductsController::class,'edit'])->name('sections.edit');
Route::delete('products/delete/{id}',[ProductsController::class,'destroy'])->name('products.destroy');
Route::put('products/update/{id}',[ProductsController::class,'update'])->name('products.update');

//----------------------------------------------------------------------------------------
//اضافة وتعديل وحذف الفاتورة
Route::get('invoices',[App\Http\Controllers\InvoicesController::class,'index']);
Route::get('invoices/create',[App\Http\Controllers\InvoicesController::class,'create']);
//select ivoices and products with ajax
Route::get('section/{id}',[App\Http\Controllers\InvoicesController::class,'getproducts']);
Route::post('invoices.store',[App\Http\Controllers\InvoicesController::class,'store'])->name('invoices.store');
Route::get('InvoicesDetails/{id}',[App\Http\Controllers\InvoicesController::class,'InvoicesDetails']);
//button view File / Download File
Route::get('View_file/{invoice_number}/{file_name}',[App\Http\Controllers\InvoicesDetalesController::class,'open_file']);
Route::get('download/{invoice_number}/{file_name}',[App\Http\Controllers\InvoicesDetalesController::class,'download_file']);
Route::post('delete_file',[App\Http\Controllers\InvoicesDetalesController::class,'destroy']);
//Edit achament
Route::post('InvoiceAttachments',[App\Http\Controllers\InvoiceAttachmentsController::class,'store']);


















//----------------------------------------------------------------------------------------
//Admin Controller
Route::get('/{page}',[AdminController::class,'index']);
