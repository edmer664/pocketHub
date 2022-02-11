<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\MessageController;
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
    Route::put('edit-post/{id}', [PostController::class, 'edit'])->name('editPost');
    Route::delete('delete-post/{id}', [PostController::class, 'delete'])->name('deletePost');
    // show post
    Route::get('/post/{id}', [PostController::class, 'show'])->name('showPost');
    // add comment to post
    Route::post('/post/{id}/comment', [PostController::class, 'addComment'])->name('addComment');
    // TODO: routes for edit and delete comment
    Route::delete('/comment/delete/{id}', [PostController::class, 'deleteComment'])->name('deleteComment'); 
    // get user information
    Route::get('api/user/{id}', [UserController::class, 'getUserInfo'])->name('getUserInfo');

    // message route
    Route::get('/message', [MessageController::class, 'index'])->name('message');
    // messages api
    Route::get('api/conversations/{id}', [MessageController::class, 'getConversations'])->name('getConversations');

    // get conversation Messages
    Route::get('api/conversations/{id}/messages', [MessageController::class, 'getMessages'])->name('getMessages');
    // send message
    Route::post('api/conversations/{id}/send', [MessageController::class, 'send'])->name('sendMessage');
    // fetch conversations containing input from search
    Route::get('api/conversations/search/{input}', [MessageController::class, 'searchConversations'])->name('searchConversations');
});