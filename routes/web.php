<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Middleware\AdminMiddleware;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::post('/home', [HomeController::class, 'index'])->name('home');

Route::prefix('admin')->middleware('auth', 'isAdmin')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Category Routes
    Route::get('/category', [CategoryController::class, 'index'])->name('category');
    Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/category', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/category/{category}/edit', [CategoryController::class, 'edit'])->name('category.edit');
    Route::put('/category/{category}', [CategoryController::class, 'update'])->name('category.update');

    //Products Routes
    Route::controller(ProductController::class)->group(function () {
        Route::get('/products', 'index')->name('products');
        Route::get('/products/create', 'create')->name('products.create');
        Route::post('/products', 'store')->name('products.store');
        Route::get('/products/{product}/edit', 'edit')->name('products.edit');
        Route::put('/products/{product}', 'update')->name('products.update');
        Route::get('/products/{product_id}/delete','destroy')->name('products.delete');

        Route::get('/product-image/{product_image_id}/delete', 'destroyImage');

    });

    // Brands Route
    Route::get('/brands', App\Http\Livewire\Admin\Brand\Index::class)->name('brands');

    //Colors Routes
        Route::controller(ColorController::class)->group(function () {
            Route::get('/colors', 'index')->name('colors');
            Route::get('/colors/create', 'create')->name('colors.create');
            Route::post('/colors/create', 'store')->name('colors.store');

            Route::get('/colors/{color}/edit', 'edit')->name('colors.edit');
            Route::put('/colors/{color_id}', 'update')->name('colors.update');
            Route::get('/colors/{color_id}/delete','destroy')->name('colors.delete');        
        });
});
