<?php

use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\BlogController as AdminBlogController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\IndexController as AdminIndexController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductImagesController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Web\AboutController;
use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\BlogController;
use App\Http\Controllers\Web\CartController;
use App\Http\Controllers\Web\CheckoutController;
use App\Http\Controllers\Web\ContactController;
use App\Http\Controllers\Web\CouponController as WebCouponController;
use App\Http\Controllers\Web\IndexController;
use App\Http\Controllers\Web\ProfileController;
use App\Http\Controllers\Web\ReviewController;
use App\Http\Controllers\Web\ShopController;
use App\Models\ProductImage;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;


// Web Routes

Route::get('/', [IndexController::class, 'index'])->name('index');

Route::get('about', [AboutController::class, 'index'])->name('about');

Route::get('contact', [ContactController::class, 'index'])->name('contact');
Route::post('contact/store', [ContactController::class, 'store'])->name('contact.store');

Route::get('blog', [BlogController::class, 'index'])->name('blog');

//  Web Shop Routes
Route::controller(ShopController::class)->name('shop.')->group(function () {
    Route::get('/products', 'index')->name('index');
    Route::get('/{id}/products', 'category')->name('category');
    Route::get('/product/details/{id}', 'details')->name('details');
});

// Web Cart Routes

Route::get('cart', [CartController::class, 'index'])->name('cart.index');
Route::post('cart/store/{id}', [CartController::class, 'store'])->name('cart.store');
Route::post('cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::get('cart/destroy/{id}', [CartController::class, 'destroy'])->name('cart.destroy');


// Web Coupon Routes

Route::get('check-coupon/{couponCode}/', [WebCouponController::class, 'checkCoupon'])->name('checkCoupon');

// Route::get('dcart',function () {
//    session()->forget('cart');
//     return back();
// });


//Checkout Routes

Route::get('checkout', [CheckoutController::class, 'index'])->middleware('CheckCustomer')->name('checkout.index');
Route::post('checkout/store', [CheckoutController::class, 'store'])->middleware('CheckCustomer')->name('checkout.store');

Route::get('confirmed-order', [CheckoutController::class, 'confirm'])->name('checkout.confirm');



// Authorization and Authentication of Customers

Route::get('login', [AuthController::class, 'loginView'])->name('login')->middleware('guest');
Route::post('login', [AuthController::class, 'login']);
Route::get('register', [AuthController::class, 'registerView'])->name('register')->middleware('guest');
Route::post('register', [AuthController::class, 'register']);
Route::get('/logout', [AdminAuthController::class, 'logout'])->name('logout');

// Manage Customer Profile

Route::middleware('CheckCustomer')->prefix('profile')->controller(ProfileController::class)->name('profile.')->group(function () {
    Route::get('/details', 'index')->name('index');
    Route::get('/edit', 'edit')->name('edit');
    Route::post('/update', 'update')->name('update');
    Route::get('/edit-password', 'editPassword')->name('edit.password');
    Route::post('/update-password', 'updatePassword')->name('update.password');
    Route::get('/orders', 'orders')->name('order');
    Route::get('order/details/{id}', 'orderDetail')->name('order.detail');
});

// Customer Reviews

Route::post('store/reviews/{id}', [ReviewController::class, 'store'])->middleware('CheckCustomer')->name('store.reviews');

// Admin Routes

Route::middleware('CheckAdmin')->prefix('/admin')->controller(AdminIndexController::class)->name('admin.')->group(function () {
    Route::middleware('CheckAdmin')->get('/', 'index')->name('index');
    // Products
    Route::prefix('/products')->controller(ProductController::class)->name('products')->group(function () {
        Route::get('/all-products', 'index')->name('.index');
        Route::get('/details/{id}', 'detail')->name('.detail');
        Route::get('/add-products', 'create')->name('.create');
        Route::post('/store', 'store')->name('.store');
        Route::get('/edit-products/{id}', 'edit')->name('.edit');
        Route::post('/update/{id}', 'update')->name('.update');
        Route::get('/destroy/{id}', 'destroy')->name('.destroy');
    });

    // Product Images

    Route::post('/product-image/destroy', [ProductImagesController::class, 'destroy'])->name('productimage.destroy');


    // Category

    Route::prefix('/category')->controller(CategoryController::class)->name('category.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/update/{id}', 'update')->name('update');
        Route::get('/destroy/{id}', 'destroy')->name('destroy');
    });

    // Orders

    Route::prefix('/orders')->controller(OrderController::class)->name('order.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/details/{id}', 'details')->name('detail');
    });

    // Coupons
    Route::prefix('/coupon')->controller(CouponController::class)->name('coupon.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/update/{id}', 'update')->name('update');
        Route::get('/destroy/{id}', 'destroy')->name('destroy');
    });

    //  Blogs

    Route::prefix('/blogs')->controller(AdminBlogController::class)->name('blog.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/update/{id}', 'update')->name('update');
        Route::get('/destroy/{id}', 'destroy')->name('destroy');
    });

    // Users

    Route::prefix('/users')->controller(UserController::class)->name('users.')->group(function () {
        Route::get('/', 'index')->name('index');
    });
});



// Authentication and Authorization of Admin

Route::get('/admin/login', [AdminAuthController::class, 'loginView'])->name('admin.login')->middleware('guest');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->middleware('guest');
// Route::get('/admin/register', [AdminAuthController::class, 'registerView'])->name('admin.register')->middleware('guest');
// Route::post('/admin/register', [AdminAuthController::class, 'register'])->middleware('guest');
Route::get('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
