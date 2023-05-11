<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\Inventory\SupplierController;
use App\Http\Controllers\Inventory\UnitController;
use App\Http\Controllers\Inventory\ProductController;
use App\Http\Controllers\Inventory\CategoryController;
use App\Http\Controllers\Inventory\PurchaseController;
use App\Http\Controllers\Inventory\DefaultController;
use App\Http\Controllers\Inventory\InvoiceController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//showing the main page 
Route::get('/', function () {
    return view('welcome');
});


Route::get('/users/login', function () {
    return view('/users/login');
});


//register page 
Route::get('/users/register',[UserController::class,'create']);

//create a new user 
Route::post('/users',[UserController::class,'store']);

//log User out 
Route::post('/logout',[UserController::class,'logout']);

//show login form 
Route::post('/users/login',[UserController::class,'login']);

//log in user 
Route::get('/users/authenticate',[UserController::class,'authenticate']);

//user dashboard
Route::get('/users/dashboard', function () {
    return view('/users/dashboard');
});
//manager dashboard
Route::get('/manager/admin/index', function () {
    return view('/manager/admin/index');
});
//go to continue after registration as manager 

Route::get('/manager/continue_manager', function () {
    return view('/manager/continue_manager');
});
//add the role 
Route::post('/manager/add_role',function(){
    return view('/manager/add_role');
})->name("add_role");
//add items
Route::get('/manager/add_item',function(){
    return view('/manager/add_item');
});
//in process page 
Route::get('/manager/inprocess_page',function(){
    return view('/manager/inprocess_page');
});
//company info
Route::post('/manager', [CompanyController::class, 'store']);
Route::get('/manager/continue_manager',[CompanyController::class,'create']);

//for sending email 
Auth::routes([
    'verify'=> true
]);
//send the email
Route::group(['middleware' => ['auth']], function() {

    /**
    * Verification Routes
    */
    Route::get('/email/verify', 'VerificationController@show')->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', 'VerificationController@verify')->name('verification.verify')->middleware(['signed']);
    Route::post('/email/resend', 'VerificationController@resend')->name('verification.resend');
});
//routes 
// supplier routes
Route::controller(SupplierController::class)->group(function () {
    Route::get('/supplier/all', 'SupplierAll')->name('supplier.all');
    Route::get('/supplier/add', 'SupplierAdd')->name('supplier.add');
    Route::post('/supplier/store', 'SupplierStore')->name('supplier.store');
    Route::get('/supplier/edit/{id}', 'SupplierEdit')->name('supplier.edit');
    Route::post('/supplier/update', 'SupplierUpdate')->name('supplier.update');
    Route::get('/supplier/delete/{id}', 'SupplierDelete')->name('supplier.delete');
});
Route::get('/manager/admin/index', function () {
    return view('manager.admin.index');
});

//from basic
Route::controller(UserController::class)->group(function () {
    Route::get('/admin/logout', 'destroy')->name('admin.logout');
    Route::get('/admin/profile', 'Profile')->name('admin.profile');
    Route::get('/edit/profile', 'EditProfile')->name('edit.profile');
    Route::post('/store/profile', 'StoreProfile')->name('store.profile');

    Route::get('/change/password', 'ChangePassword')->name('change.password');
    Route::post('/update/password', 'UpdatePassword')->name('update.password');
     
});


// categories routes
Route::controller(CategoryController::class)->group(function () {
    Route::get('/category/all', 'CategoryAll')->name('category.all');
    Route::get('/category/add', 'CategoryAdd')->name('category.add');
    Route::post('/category/store', 'CategoryStore')->name('category.store');
    Route::get('/category/edit/{id}', 'CategoryEdit')->name('category.edit');
    Route::post('/category/update', 'CategoryUpdate')->name('category.update');
    Route::get('/category/delete/{id}', 'CategoryDelete')->name('category.delete');
});


// unit routes
Route::controller(UnitController::class)->group(function () {
    Route::get('/unit/all', 'UnitAll')->name('unit.all');
    Route::get('/unit/add', 'UnitAdd')->name('unit.add');
    Route::post('/unit/store', 'UnitStore')->name('unit.store');
    Route::get('/unit/edit/{id}', 'UnitEdit')->name('unit.edit');
    Route::post('/unit/update', 'UnitUpdate')->name('unit.update');
    Route::get('/unit/delete/{id}', 'UnitDelete')->name('unit.delete');
});


// Products routes
Route::controller(ProductController::class)->group(function () {
    Route::get('/product/all', 'ProductAll')->name('product.all');
    Route::get('/product/add', 'ProductAdd')->name('product.add');
    Route::post('/product/store', 'ProductStore')->name('product.store');
    Route::get('/product/edit/{id}', 'ProductEdit')->name('product.edit');
    Route::post('/product/update', 'ProductUpdate')->name('product.update');
    Route::get('/product/delete/{id}', 'ProductDelete')->name('product.delete');
});

//routes for purchase
Route::controller(PurchaseController::class)->group(function(){
    Route::get('/purchase/all', 'purchaseAll')->name('purchase.all');
    Route::get('/purchase/add', 'purchaseAdd')->name('purchase.add');
    Route::get('/purchase/delete/{id}', 'purchaseDelete')->name('purchase.delete');
    Route::get('/purchase/approve/{id}', 'purchaseApprove')->name('purchase.approve');
    Route::get('/purchase/pending', 'purchasePending')->name('purchase.pending');
    Route::post('/purchase/store', 'PurchaseStore')->name('purchase.store');
    Route::get('/daily/purchase/report', 'dailyPurchaseReport')->name('daily.purchase.report');
    Route::get('/daily/purchase/pdf', 'dailyPurchasePdf')->name('daily.purchase.pdf');

});

//add
Route::controller(DefaultController::class)->group(function(){
    Route::get('/get-category', 'getCategory')->name('get-category');
    Route::get('/get-product', 'getProduct')->name('get-product'); 
    Route::get('/check-product', 'getStock')->name('check-product-stock'); 
});

//invoice
Route::controller(InvoiceController::class)->group(function(){
    Route::get('/invoice/all', 'invoiceAll')->name('invoice.all');
    Route::get('/invoice/add', 'invoiceAdd')->name('invoice.add');
    Route::get('/invoice/delete/{id}', 'invoiceDelete')->name('invoice.delete');
    Route::get('/invoice/approve/{id}', 'invoiceApprove')->name('invoice.approve');
    Route::post('/approval/store/{id}', 'approvalStore')->name('approval.store');
    Route::get('/print/invoice/list', 'printInvoiceList')->name('print.invoice.list');
    Route::get('/invoice/pending/list', 'pendingList')->name('invoice.pending.list');
    Route::get('/print/invoice/{id}', 'printInvoice')->name('print.invoice');
    Route::get('/daily/invoice/report', 'dailyInvoiceReport')->name('daily.invoice.report');
    Route::get('/daily/invoice/pdf', 'dailyInvoicePdf')->name('daily.invoice.pdf');
    Route::post('/invoice/store', 'invoiceStore')->name('invoice.store');
});