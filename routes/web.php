<?php

use App\Http\Controllers\Api\v1\OrderController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    // return redirect('http://www.kiporbo.com');
});

Route::get('invoice/{order}',[OrderController::class, 'invoice'])->name('invoice');
