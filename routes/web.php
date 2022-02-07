<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
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
Route::group(['middleware'=>['auth','PreventBackHistory']], function(){
    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::get('/profile/edit', [UserController::class, 'edit'])->name('editInfo');
    Route::put('update-profile-info', [UserController::class, 'update'])->name('updateInfo');
    Route::put('change-password', [UserController::class, 'changePassword'])->name('changePassword');
    Route::put('upload-avatar', [UserController::class, 'uploadAvatar'])->name('uploadAvatar');
    Route::post('creat-poste', [PostController::class, 'create'])->name('createPost');
});