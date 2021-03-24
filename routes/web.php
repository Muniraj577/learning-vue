<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix'=>'admin/','as'=>'admin.'],function(){
    Route::get('dashboard',[AdminDashboardController::class,'dashboard'])->name('dashboard');
});

Route::get('{path}',[AdminDashboardController::class,'dashboard'])->where('path','([A-z\/_.\d-]+)?');
