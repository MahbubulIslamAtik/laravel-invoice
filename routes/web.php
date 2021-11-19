<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\InvoiceController;


Route::get("logout",[AuthController::class,"logout"]);
Route::post("login",[AuthController::class,"signin"]);

Route::get('/', function () {
    return view('layouts.login');
});

Route::get('/dashboard', function () {
    return view('pages.dashboard');
})->middleware('secured');

Route::get('/blank', function () {
    return view('pages.blank');
});

Route::resource("students",StudentController::class)->middleware('secured');

Route::get('invoice/', [InvoiceController::class,"index"]); 
Route::post('invoice/store', [InvoiceController::class,"store"]); 
Route::post('invoice/addItem', [InvoiceController::class,"addItem"]); 
Route::post('invoice/updateItem', [InvoiceController::class,"updateItem"]); 
Route::delete('invoice/removeItem', [InvoiceController::class,"removeItem"]); 