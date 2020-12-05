<?php

use App\Http\Controllers\Admin\CategoryController;
use \App\Http\Controllers\Admin\AttributeController;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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

//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/', function () {
    return view('layouts.dashboard');
});

Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::resource('categroy',CategoryController::class);
Route::resource('attribute',AttributeController::class);
