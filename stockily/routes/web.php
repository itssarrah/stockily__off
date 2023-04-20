<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CompanyController;

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
Route::get('/manager/manager_dashboard', function () {
    return view('/manager/manager_dashboard');
});
//go to continue after registration as manager 

Route::get('/manager/continue_manager', function () {
    return view('/manager/continue_manager');
});
//add the role 
Route::get('/manager/add_role',function(){
    return view('/manager/add_role');
});
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
