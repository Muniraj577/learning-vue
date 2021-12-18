<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\API\CategoryController as AdminAPICategoryController;
use App\Http\Controllers\Admin\API\SubCategoryController as AdminAPISubCategoryController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix'=>'admin/','as'=>'admin.'],function(){
    Route::group(['prefix'=>'category/','as'=>'category.'],function(){
        Route::get('',[AdminAPICategoryController::class,'index'])->name('index');
        Route::post('store',[AdminAPICategoryController::class,'store'])->name('store');
        Route::get('edit/{id}',[AdminAPICategoryController::class,'edit'])->name('edit');
        Route::put('update/{id}',[AdminAPICategoryController::class,'update'])->name('update');
        Route::delete('delete/{id}',[AdminAPICategoryController::class,'destroy'])->name('destroy');
    });
    Route::get('get-categories',[AdminAPICategoryController::class,'getAllCategories'])->name('getAllCategories');
    Route::group(['prefix'=>'subcategory/','as'=>'subcategory.'],function(){
        Route::get('',[AdminAPISubCategoryController::class,'index'])->name('index');
        Route::get('create', [AdminAPISubCategoryController::class, 'create'])->name('create');
        Route::post('store',[AdminAPISubCategoryController::class,'store'])->name('store');
        Route::get('edit/{id}',[AdminAPISubCategoryController::class,'edit'])->name('edit');
        Route::put('update/{id}',[AdminAPISubCategoryController::class,'update'])->name('update');
        Route::delete('delete/{id}',[AdminAPISubCategoryController::class,'destroy'])->name('destroy');
    });
});
