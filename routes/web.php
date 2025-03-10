<?php

use App\Http\Controllers\FileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('app');
});

Route::resource('/files', FileController::class)->only(['index', 'store', 'update', 'destroy']);
