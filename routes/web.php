<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\GenderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('api')->group(function () {
    Route::get('/brands', [BrandController::class, 'listBrands']);
    Route::get('/categories', [CategoryController::class, 'listCategories']);
    Route::get('/colors', [ColorController::class, 'listColors']);
    Route::get('/genders', [GenderController::class, 'listGenders']);
    Route::get('/sizes', [SizeController::class, 'listSizes']);
    Route::get('/tags', [TagController::class, 'listTags']);
    Route::get('/products', [ProductController::class, 'listProducts']);
    Route::get('/product/{id}', [ProductController::class, 'listProductsById']);
    Route::get('/all-products', [ProductController::class, 'listAllProducts']);
});

