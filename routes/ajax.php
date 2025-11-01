<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AjaxController;

//ajax requests
Route::post('category-status-update', [AjaxController::class, 'categoryStatusUpdate']);
Route::post('subcategory-status-update', [AjaxController::class, 'subCategoryStatusUpdate']);
Route::post('brand-status-update', [AjaxController::class, 'brandStatusUpdate']);
Route::post('unit-status-update', [AjaxController::class, 'unitStatusUpdate']);
Route::post('variant-status-update', [AjaxController::class, 'variantStatusUpdate']);
Route::post('product-status-update', [AjaxController::class, 'productStatusUpdate']);
Route::get('/get-subcategories/{id}', [AjaxController::class, 'getSubcategories']);
Route::get('/delete-variant/{id}', [AjaxController::class, 'deleteVariant']);


//cart ajax requests
Route::get('/add-to-cart', [AjaxController::class, 'addToCart']);
Route::get('/cart-delete/{id}', [AjaxController::class, 'cartDelete']);
Route::get('/cart-empty', [AjaxController::class, 'cartEmpty']);

//product ajax requests
Route::get('/product-variant-details/{id}', [AjaxController::class, 'productVariantDetails']);

//wishlist ajax requests
Route::get('/add-wishlist/{id}', [AjaxController::class, 'addWishlist']);
Route::get('/remove-wishlist/{id}', [AjaxController::class, 'removeWishlist']);