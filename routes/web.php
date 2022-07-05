<?php

use App\Http\Controllers\FileUploadController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('upload', [FileUploadController::class, 'createUploads'])->name('upload');
Route::post('upload', [FileUploadController::class, 'storeUploads'])->name('upload.store');
Route::get('view-upload', [FileUploadController::class, 'index'])->name('view-upload');
Route::delete('upload/{id}', [FileUploadController::class, 'destroy'])->name('upload.destroy');
Route::get('edit-upload/{id}', [FileUploadController::class, 'edit'])->name('upload.edit');
Route::put('edit-upload/{id}', [FileUploadController::class, 'update'])->name('upload.update');
