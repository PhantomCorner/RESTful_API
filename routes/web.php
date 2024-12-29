<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\Api\V1\CustomerController;



Route::get('/', function () {
    return view('welcome');
});
Route::get('/test', [TestController::class, 'index']);
Route::get('/greeting', function () {
    return 'Hello World';
});
