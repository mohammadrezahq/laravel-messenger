<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\FriendController;
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

Route::middleware(['auth:sanctum', 'verified'])->get('/', [PageController::class, 'home'])->name('home');
Route::middleware(['auth:sanctum', 'verified'])->get('/friends', [PageController::class, 'friends'])->name('friends');

Route::middleware(['auth:sanctum', 'verified'])->post('/messages/get', [MessageController::class, 'get']);
Route::middleware(['auth:sanctum', 'verified'])->post('/messages/send', [MessageController::class, 'create']);

Route::middleware(['auth:sanctum', 'verified'])->post('/friends/add', [FriendController::class, 'create']);
Route::middleware(['auth:sanctum', 'verified'])->put('/friends/update', [FriendController::class, 'update']);
