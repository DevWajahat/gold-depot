<?php

// use App\Http\Controllers\Admin\BlogController;
// use App\Http\Controllers\Admin\CarouselController;
// use App\Http\Controllers\Admin\CategoryController;
// use App\Http\Controllers\Admin\CouponController;
// use App\Http\Controllers\Admin\IndexController;
// use App\Http\Controllers\Admin\OrderController;
// use App\Http\Controllers\Admin\ProductController;
// use App\Http\Controllers\Admin\ProductImagesController;
// use App\Http\Controllers\Admin\UserController;
// use Illuminate\Support\Facades\Route;

// // Route::get('admin',[IndexController::class,'index'])->name('admin.index');

//     // Route::middleware('CheckAdmin')->get('/', 'index')->name('index');
//     // Products
//     Route::prefix('/products')->controller(ProductController::class)->name('products')->group(function () {
//         Route::get('/all-products', 'index')->name('.index');
//         Route::get('/details/{id}', 'detail')->name('.detail');
//         Route::get('/add-products', 'create')->name('.create');
//         Route::post('/store', 'store')->name('.store');
//         Route::get('/edit-products/{id}', 'edit')->name('.edit');
//         Route::post('/update/{id}', 'update')->name('.update');
//         Route::post('/update-status', 'updateStatus')->name('.update.status');
//     });
//     // Product Images
//     Route::post('/product-image/destroy', [ProductImagesController::class, 'destroy'])->name('productimage.destroy');
//     // Category
//     Route::prefix('/category')->controller(CategoryController::class)->name('category.')->group(function () {
//         Route::get('/', 'index')->name('index');
//         Route::get('/create', 'create')->name('create');
//         Route::post('/store', 'store')->name('store');
//         Route::get('/edit/{id}', 'edit')->name('edit');
//         Route::post('/update/{id}', 'update')->name('update');
//         Route::post('/update-status', 'updateStatus')->name('update.status');
//     });
//     // Orders
//     Route::prefix('/orders')->controller(OrderController::class)->name('order.')->group(function () {
//         Route::get('/', 'index')->name('index');
//         Route::get('/details/{id}', 'details')->name('detail');
//         Route::post('/status-update', 'updateStatus')->name('.status.update');
//     });
//     // Coupons
//     Route::prefix('/coupon')->controller(CouponController::class)->name('coupon.')->group(function () {
//         Route::get('/', 'index')->name('index');
//         Route::get('/create', 'create')->name('create');
//         Route::post('/store', 'store')->name('store');
//         Route::get('/edit/{id}', 'edit')->name('edit');
//         Route::post('/update/{id}', 'update')->name('update');
//         Route::get('/destroy/{id}', 'destroy')->name('destroy');
//         Route::post('/update-status', 'updateStatus')->name('update');
//     });
//     //  Blogs
//     Route::prefix('/blogs')->controller(BlogController::class)->name('blog.')->group(function () {
//         Route::get('/', 'index')->name('index');
//         Route::get('/create', 'create')->name('create');
//         Route::post('/store', 'store')->name('store');
//         Route::get('/edit/{id}', 'edit')->name('edit');
//         Route::post('/update/{id}', 'update')->name('update');
//         Route::get('/destroy/{id}', 'destroy')->name('destroy');
//     });
//     // Users

//     Route::prefix('/users')->controller(UserController::class)->name('users.')->group(function () {
//         Route::get('/', 'index')->name('index');
//     });
//     // Carousels

//     Route::prefix('carousel')->controller(CarouselController::class)->name('carousel.')->group(function () {
//         Route::get('/index', 'index')->name('index');
//         Route::get('/create', 'create')->name('create');
//         Route::post('/store', 'store')->name('store');
//         Route::get('/edit/{id}', 'edit')->name('edit');
//         Route::post('/update/{id}', 'update')->name('update');
//         Route::get('/destroy/{id}', 'destroy')->name('destroy');
//     });

