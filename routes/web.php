<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DocumentController;
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

Route::post('/staff/get', [UserController::class, 'getAllStaff'])->middleware('auth');
Route::post('/file/upload', [DocumentController::class, 'upload'])->middleware('auth');
Route::get('/file/{name}', [DocumentController::class, 'file'])->middleware('auth');
Route::post('/docs/search', [DocumentController::class, 'searchDocs'])->middleware('auth');
Route::post('/docs/history', [DocumentController::class, 'getHistory'])->middleware('auth');
Route::post('/docs/my_docs', [DocumentController::class, 'getMyDocs'])->middleware('auth');
Route::post('/docs', [DocumentController::class, 'index'])->middleware('auth');

Route::post('/user', [AuthController::class, 'index']);
Route::post('/user/login', [AuthController::class, 'login']);
Route::post('/user/logout', [AuthController::class, 'logout']);

Route::get('/{any}', function () {
    return view('welcome');
})->where('any', '.*');
