<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
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



Auth::routes();
Route::get('/',function(){
    return view('landing');
});

Route::group(['middleware'=>['auth','PreventBackHistory']], function(){
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::get('/edit', [UserController::class, 'edit'])->name('edit');
    Route::put('/edit', [UserController::class, 'update']);
    
});