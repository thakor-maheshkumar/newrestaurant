<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;

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


Route::get('/',[HomeController::class,'index']);

Route::get('/users',[AdminController::class,'user']);
Route::get('/deleteuser/{id}',[AdminController::class,'deleteuser']);
Route::get('/foodmenu',[AdminController::class,'foodmenu']);
Route::post('upload',[AdminController::class,'upload']);
Route::get('deletemenu/{id}',[AdminController::class,'deletemenu']);
Route::get('updatemenu/{id}',[AdminController::class,'editmenu']);
Route::post('update/{id}',[AdminController::class,'update']);
Route::post('reservation',[AdminController::class,'reservation']);
Route::get('viewreservation',[AdminController::class,'viewreservation']);
Route::get('viewchef',[AdminController::class,'viewchef']);
Route::post('storechef',[AdminController::class,'storechef']);
Route::get('editchef/{id}',[AdminController::class,'editchef']);
Route::post('updatechef/{id}',[AdminController::class,'updatechef']);
Route::get('deletechef/{id}',[AdminController::class,'deletechef']);

Route::get('/redirects',[HomeController::class,'redirects']);
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
