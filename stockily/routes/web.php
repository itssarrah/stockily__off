<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

// //to have link to register page
// Route::get('/users/register', function () {
//     return view('/users/register');
// });
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

