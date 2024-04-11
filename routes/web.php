<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VoyagerProductController;

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
    return view('welcome');
});


Route::group(['prefix' => 'admin'], function () {
    // Route::resource('/products', ProductsController::class);
    Voyager::routes();
    Route::post('/products', [VoyagerProductController::class, 'store'])->name('voyager.products.store');
});

