<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileUploadController;

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


Route::get('/', [FileUploadController::class, 'showUploadForm']);
Route::post('/upload', [FileUploadController::class, 'store']);
Route::delete('/files/{file}', [FileUploadController::class, 'destroy']);
