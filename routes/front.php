<?php

use App\Http\Controllers\NewsletterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Artisan;

//frontend routes
Route::get('/', [FrontController::class, 'frontPage'])->name('home');

//cart routes
Route::get('/carts', [CartController::class, 'carts']);
Route::post('/cart-update', [CartController::class, 'cartUpdate']);
Route::get('/cart-delete/{id}', [CartController::class, 'cartDelete'])->name('cart.delete');
Route::post('/cart-update-ajax', [CartController::class, 'cartUpdateAjax'])->name('cart.update.ajax');
Route::get('/get-cart-modal', [CartController::class, 'getCartModal'])->name('get.cart.modal');

//product routes
Route::get('/product-details/{id}', [FrontController::class, 'productDetails']);
Route::get('/product-lists', [FrontController::class, 'productLists']);

//auth
Route::get('/login-register', [UserAuthController::class, 'loginRegister']);
Route::post('user-signup', [UserAuthController::class, 'userSignup']);
Route::post('user-signin', [UserAuthController::class, 'userSignin']);
Route::get('/user-logout', [UserAuthController::class, 'userLogout']);

//wishlists
Route::get('/wishlists', [WishlistController::class, 'wishlists']);

//checkout
Route::get('/checkout', [CheckoutController::class, 'checkout']);
Route::post('save-order', [CheckoutController::class, 'saveOrder']);
Route::post('reviews', [ReviewController::class, 'store'])->name('reviews.store');
Route::get('/bank-info', [CheckoutController::class, 'showBankInfo'])->name('bank.info');
Route::get('/bkash-info', [CheckoutController::class, 'showBkashInfo'])->name('bkash.info');

Route::get('/contact', [FrontController::class, 'contact'])->name('contact');
Route::get('/about', [FrontController::class, 'about'])->name('about');
Route::get('/my-account', [FrontController::class, 'myAccount'])->name('my-account');
Route::get('/invoice/{id}', [FrontController::class, 'showInvoice'])->name('front.invoice');
Route::post('/user-change-password', [FrontController::class, 'userChangePassword'])->name('user-change-password');
Route::get('/search-suggestions', [FrontController::class, 'searchSuggestions'])->name('search.suggestions');
Route::get('/cart-partial', [FrontController::class, 'getCartPartial'])->name('cart.partial');
Route::get('/get-cart-html', [FrontController::class, 'getCartHtml'])->name('get.cart.html');

Route::post('/newsletter/subscribe', [NewsletterController::class, 'store'])->name('newsletter.subscribe');


Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');

    return 'All caches (config, route, view, application) have been cleared!';
});

Route::get('/migrate', function(){
    Artisan::call('migrate', [
        '--force' => true,
    ]);
    return response()->json(['message' => 'Migrations run successfully.']);
});
