<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\WorksController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Публичные маршруты (доступны всем)
|--------------------------------------------------------------------------
*/
Route::get('/', [MainController::class, 'index'])->name('home');
Route::get('/about', function () {
    return view('about');
})->name('about');
Route::get('/works', [WorksController::class, 'index'])->name('works');
Route::get('/project/{id}', [ProjectController::class, 'show'])->name('project.show');

/*
|--------------------------------------------------------------------------
| Гостевые маршруты (только для неавторизованных)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    // Регистрация
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'storeRegister'])->name('register.store');
    
    // Вход
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'storeLogin'])->name('login.store');
});

/*
|--------------------------------------------------------------------------
| Маршруты для авторизованных пользователей
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    // Выход
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Корзина
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{project}', [CartController::class, 'add'])->name('cart.add');
    Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::put('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
    
    // Профиль и заказы
    Route::get('/profile/orders', [ProfileController::class, 'orders'])->name('profile.orders');
    
    // Админка (только для администраторов)
    Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
        // Управление проектами
        Route::get('/', [AdminController::class, 'index'])->name('index');
        Route::get('/create', [AdminController::class, 'create'])->name('create');
        Route::post('/store', [AdminController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [AdminController::class, 'edit'])->name('edit');
        Route::put('/{id}', [AdminController::class, 'update'])->name('update');
        Route::delete('/{id}', [AdminController::class, 'destroy'])->name('destroy');
        
        // Управление заказами
        Route::get('/orders', [AdminController::class, 'orders'])->name('orders');
        Route::put('/orders/{id}', [AdminController::class, 'updateOrder'])->name('orders.update');
        Route::delete('/orders/{id}', [AdminController::class, 'destroyOrder'])->name('orders.destroy');
    });
});