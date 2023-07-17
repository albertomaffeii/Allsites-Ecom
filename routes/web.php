<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Middleware\AdminMiddleware;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::post('/home', [HomeController::class, 'index'])->name('home');

Route::prefix('admin')->middleware('auth', 'isAdmin')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    //Category Routes
    Route::get('/category', [CategoryController::class, 'index'])->name('category');
    Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/category', [CategoryController::class, 'store'])->name('category.store');
    //Route::get('/category/{category}/delete', [CategoryController::class, 'delete'])->name('category.delete');

    // Rota para exibir o formulário de edição
    Route::get('/category/{category}/edit', [CategoryController::class, 'edit'])->name('category.edit');

    // Rota para processar o formulário de edição (se houver)
    Route::put('/category/{category}', [CategoryController::class, 'update'])->name('category.update');

 
});
