<?php

use App\Http\Controllers\BannerController;
use App\Http\Controllers\CosmeticController;
use App\Http\Controllers\IntroController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\AccessController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\VariantController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\OrderController;

Route::get('/admin/login', [IndexController::class, 'loginPage']);

Route::post('admin-login', [AccessController::class, 'adminLogin']);

Route::get('/admin/logout', [AccessController::class, 'adminLogout']);

Route::get('/migrate', function(){
    Artisan::call('migrate', [
        '--force' => true,
    ]);
    return response()->json(['message' => 'Migrations run successfully.']);
});

Route::group(['middleware' => 'prevent-back-history'],function(){

	//admin dashboard

    Route::get('/dashboard', [DashboardController::class, 'Dashboard'])->name('dashboard');

	//categories
	Route::resource('categories', CategoryController::class);
	//subcategories
	Route::resource('subcategories', SubcategoryController::class);
	//brands
	Route::resource('brands', BrandController::class);
	//units
	Route::resource('units', UnitController::class);
	//variants
	Route::resource('variants', VariantController::class);
	//products
	Route::resource('products', ProductController::class);
    Route::delete('/product-image/{id}', [ProductController::class, 'deleteImage'])->name('product.image.delete');
    Route::get('/add-product-variant/{id}', [AjaxController::class, 'addProductVariant']);
	Route::post('save-product-variant', [AjaxController::class, 'saveProductVariant']);

	//sliders
	Route::resource('sliders', SliderController::class);

	//orders

	Route::get('/order-lists', [OrderController::class, 'orderLists']);

	Route::get('/show-order/{id}', [OrderController::class, 'showOrder']);
    Route::post('order-status-update', [OrderController::class, 'orderStatusUpdate']);

    Route::get('password-change', [UserController::class, 'passwordChange'])->name('password-change');
    Route::post('change-password', [UserController::class, 'changePassword'])->name('change-password');

    // Settings
    Route::get('/settings', [SettingController::class, 'settings'])->name('settings');
    Route::post('settings-app', [SettingController::class, 'settingApp']);

    // Delivery
    Route::get('/delivery-charges', [SettingController::class, 'deliveryCharges'])->name('delivery-charges');
    Route::post('delivery-charges', [SettingController::class, 'updateDeliveryCharges'])->name('delivery-charges.update');

    Route::get('/dc-bank-info', [SettingController::class, 'bankInfo'])->name('dc-bank-info');
    Route::post('dc-bank-info', [SettingController::class, 'updateBankInfo'])->name('dc-bank-info.update');

    Route::get('/dc-bkash-info', [SettingController::class, 'bkashInfo'])->name('dc-bkash-info');
    Route::post('dc-bkash-info', [SettingController::class, 'updateBkashInfo'])->name('dc-bkash-info.update');

    // about-us
    Route::get('about-us', [SettingController::class, 'aboutUs'])->name('about-us');
    Route::post('about-us', [SettingController::class, 'storeAboutUs'])->name('store-about-us');

    //banner
    Route::resource('banners', BannerController::class);

    // Cosmetic
    Route::resource('cosmetics', CosmeticController::class);

    //intro
    Route::resource('intros', IntroController::class);

    //newsletters
    Route::resource('newsletters', NewsletterController::class);
});
