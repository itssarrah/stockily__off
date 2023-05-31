<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\Inventory\UnitController;
use App\Http\Controllers\Inventory\StockController;
use App\Http\Controllers\Inventory\DefaultController;
use App\Http\Controllers\Inventory\ProductController;
use App\Http\Controllers\Inventory\CategoryController;
use App\Http\Controllers\Inventory\PurchaseController;
use App\Http\Controllers\Inventory\SupplierController;
use App\Http\Controllers\Inventory\DashboardController;
use App\Http\Controllers\Inventory\SublocationController;
use App\Http\Controllers\Inventory\ProductsDetailsController;
use App\Http\Controllers\InviteController;

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
})->name('home');


Route::get('/users/login', function () {
    return view('/users/login');
})->name('login_page');


//register page 
Route::get('/users/register',[UserController::class,'create']);
Route::get('/users/register_normal',[UserController::class,'createNormal']);

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

//----------------------------------------
//go dashboard 
//help
Route::get('/help/help', function () {
    return view('/help/help');
})->name('help');
//for help page
Route::get('/help/terms_of_use', function () {
    return view('/help/terms_of_use');
});
//terms of use 
Route::get('/help/terms_of_use', function () {
    return view('/help/terms_of_use');
});
//---------------------------------------
Route::get('/manager/continue_manager', function () {
    return view('/manager/continue_manager');
});
//add the role 
Route::get('/manager/add_role',function(){
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
Route::post('/manager/add_role', [CompanyController::class, 'store'])->name('company');
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
    Route::get('/unit/display/{unit}', 'displayProducts')->name('unit.display');
    
});

Route::controller(SublocationController::class)->group(function () {
    Route::get('/sublocation/all', 'sublocation_all')->name('sublocation.all');
    Route::get('/sublocation/add', 'sublocation_add')->name('sublocation.add');
    Route::post('/sublocation/store', 'sublocation_store')->name('sublocation.store');
    Route::get('/sublocation/delete/{id}', 'sublocationDelete')->name('sub.delete');
    Route::get('/sublocation/edit/{id}', 'subEdit')->name('sub.edit');
    Route::post('/sublocation/update', 'subUpdate')->name('sub.update');
  
});


Route::get('/get-sublocations/{id}', [UnitController::class, 'getSublocations'])->name('get.sublocations');


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
    Route::get('/download-pdf', 'downloadPDF')->name('download.pdf');

});

//add
Route::controller(DefaultController::class)->group(function(){
    Route::get('/get-category', 'getCategory')->name('get-category');
    Route::get('/get-product', 'getProduct')->name('get-product'); 
    Route::get('/check-product', 'getStock')->name('check-product-stock'); 
});


//the stock 
Route::controller(StockController::class)->group(function(){
    Route::get('/stock/report', 'stockReport')->name('stock.report');
    Route::get('/stock/report/pdf', 'stockReportPdf')->name('stock.report.pdf');
    Route::get('/stock/supplier/wise', 'stockSupplierWise')->name('stock.supplier.wise');
    Route::get('/supplier/wise/pdf', 'supplierWisePdf')->name('supplier.wise.pdf');
    Route::get('/product/wise/pdf', 'productWisePdf')->name('product.wise.pdf');
    Route::get('/download-stock-pdf', 'downloadStockPDF')->name('downloadstock.pdf');
    Route::get('/download-supplier-pdf', 'downloadSupplierPDF')->name('downloadsupplier.pdf');
});


// dashboard' details 

Route::get('/chart/update', [ProductsDetailsController::class, 'update'])->name('chart.update');
// functionality of charts and graphs (product per category ) 

Route::get('manager/admin/index', [DashboardController::class, 'dashboard_details']);

Route::match(['get','post'],'add_role',[InviteController::class, 'SendEmail'])->name('send_email');