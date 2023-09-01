<?php
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Frontend\WishlistController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\OrderController;
use App\Http\Controllers\Frontend\FrontendController;
use Sabberworm\CSS\Settings;

Auth::routes();

Route::controller(FrontendController::class)->group(function () {

    Route::get('/', 'index')->name('welcome');

    Route::get('/collections', 'categories')->name('collections');
    Route::get('/collections/{category_slug}', 'products');
    Route::get('/collections/{category_slug}/{product_slug}', 'productView');

    Route::get('/new-arrivals', 'newArrival')->name('newarrivals');
    Route::get('/featured-products', 'featuredProducts')->name('featured');

    Route::get('/search', 'searchProducts')->name('search');

    Route::get('/thank-you', 'thankyou');

});

Route::group(['prefix' => 'frontend'], function () {
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist')->middleware('auth');
    Route::get('/cart', [CartController::class, 'index'])->name('cart')->middleware('auth');
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout')->middleware('auth');
});

Route::get('orders', [OrderController::class, 'index'])->name('orders')->middleware('auth');
Route::get('orders/{orderId}', [OrderController::class, 'show'])->middleware('auth');

Route::get('/home', [HomeController::class, 'index']);

Route::prefix('admin')->middleware('auth', 'isAdmin')->group(function () {

    //Dashboard Route
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

    //Settings Route
    Route::get('settings', [SettingController::class, 'index'])->name('settings')->middleware('auth');
    Route::put('settings/{setting}', [SettingController::class, 'update'])->name('settings.update')->middleware('auth');


    // Admin Orders and Invoices Routes
    Route::controller(App\Http\Controllers\Admin\OrderController::class)->group(function () {
        Route::get('/orders', 'index')->name('orders.index');
        Route::get('/orders/{orderId}', 'show');
        Route::put('/orders/{orderId}', 'updateOrderStatus');

        Route::get('/invoice/{orderId}', 'viewInvoice');
        Route::get('/invoice/{orderId}/generate', 'generateInvoice');
    });

    // Category Routes
    Route::get('/category', [CategoryController::class, 'index'])->name('category');
    Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/category', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/category/{category}/edit', [CategoryController::class, 'edit'])->name('category.edit');
    Route::put('/category/{category}', [CategoryController::class, 'update'])->name('category.update');

    // Products Routes
    Route::controller(ProductController::class)->group(function () {
        Route::get('/products', 'index')->name('products');
        Route::get('/products/create', 'create')->name('products.create');
        Route::post('/products', 'store')->name('products.store');
        Route::get('/products/{product}/edit', 'edit')->name('products.edit');
        Route::put('/products/{product}', 'update')->name('products.update');
        Route::get('/products/{product_id}/delete','destroy')->name('products.delete');
        Route::get('/product-image/{product_image_id}/delete', 'destroyImage');

        Route::post('/product-color/{prod_color_id}', 'updateProdColorQty');
        Route::get('/product-color/{prod_color_id}/delete', 'deleteProdColor');
    });

    // Brands Route
    Route::get('/brands', App\Http\Livewire\Admin\Brand\Index::class)->name('brands');

    // Colors Routes
    Route::controller(ColorController::class)->group(function () {
        Route::get('/colors', 'index')->name('colors');
        Route::get('/colors/create', 'create')->name('colors.create');
        Route::post('/colors/create', 'store')->name('colors.store');
        Route::get('/colors/{color}/edit', 'edit')->name('colors.edit');
        Route::put('/colors/{color_id}', 'update')->name('colors.update');
        Route::get('/colors/{color_id}/delete','destroy')->name('colors.delete');
    });

    // sliders Routes
    Route::controller(SliderController::class)->group(function () {
        Route::get('/sliders', 'index')->name('sliders');
        Route::get('/sliders/create', 'create')->name('sliders.create');
        Route::post('/sliders/create', 'store')->name('sliders.store');
        Route::get('/sliders/{slider}/edit', 'edit')->name('sliders.edit');
        Route::put('/sliders/{slider}', 'update')->name('sliders.update');
        Route::get('/sliders/{slider}/delete','destroy')->name('sliders.delete');
    });

    // Admin Users Routes
    Route::controller(UserController::class)->group(function () {
        //Route::

    });
});
