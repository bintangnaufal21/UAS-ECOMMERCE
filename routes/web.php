<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\HomepageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\CategoryController as UserCategoryController;
use App\Http\Controllers\User\BookController as UserBookController;
use App\Http\Controllers\User\OrderController as UserOrderController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\ProfileController;


// ------------------------------------------------------------
// HALAMAN PUBLIC (TANPA LOGIN)
// ------------------------------------------------------------

Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/about', function () {
    return view('about');
})->name('about');



// ------------------------------------------------------------
// ADMIN AREA (WAJIB LOGIN + ROLE ADMIN)
// ------------------------------------------------------------
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Dashboard
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        // BOOKS (CRUD)
        Route::get('/books', [BookController::class, 'index'])->name('books.index');
        Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
        Route::post('/books', [BookController::class, 'store'])->name('books.store');
        Route::get('/books/{book}/edit', [BookController::class, 'edit'])->name('books.edit'); // route model binding
        Route::put('/books/{book}', [BookController::class, 'update'])->name('books.update');
        Route::delete('/books/{book}', [BookController::class, 'destroy'])->name('books.destroy');

        // CATEGORIES (CRUD)
        Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
        Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
        Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
        Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
        Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
        Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

        // Orders
        Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
        Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
        Route::put('/orders/{id}', [OrderController::class, 'update'])->name('orders.update');


        // Users
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');

        // Homepage setting
        Route::get('/homepages', [HomepageController::class, 'index'])->name('homepages.index');
        Route::post('/homepages/bestseller', [HomepageController::class, 'updateBestseller'])->name('homepages.updateBestseller');
        Route::post('/homepages', [HomepageController::class, 'update'])->name('homepages.update');
    });

// ------------------------------------------------------------
// AUTH (LOGIN / REGISTER)
// ------------------------------------------------------------

// LOGIN PAGE
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
// LOGIN PROCESS
Route::post('/login', [LoginController::class, 'login'])->name('login.process');
// LOGOUT
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// FORM REGISTER (GET)
Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
// PROSES REGISTER (POST)
Route::post('/register', [RegisterController::class, 'register'])->name('register.process');

// ------------------------------------------------------------
// USER AREA (WAJIB LOGIN, ROLE BEBAS: ADMIN/USER KEDUA2NYA BISA)
// ------------------------------------------------------------
// ------------------------------------------------------------
// USER AREA
// ------------------------------------------------------------
Route::middleware(['auth'])
    ->prefix('users')
    ->name('users.')
    ->group(function () {

        // DASHBOARD USER
        Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

        // CATEGORY (LIST & DETAIL)
        Route::get('/category', [UserCategoryController::class, 'index'])->name('category.index');
        Route::get('/category/{category}', [UserCategoryController::class, 'show'])->name('category.show');

        // DETAIL BUKU
        Route::get('/books/{book}', [UserBookController::class, 'show'])->name('books.show');

        // CART
        Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
        Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
        Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
        Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');

        // CHECKOUT
        Route::get('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
        Route::post('/cart/checkout', [CartController::class, 'processCheckout'])->name('cart.processCheckout');

        // ORDER HISTORY
        Route::get('/orders', [UserOrderController::class, 'index'])->name('orders.index');
        Route::get('/orders/{order}', [UserOrderController::class, 'show'])->name('orders.show');

        // PROFIL USER
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');


        Route::get('/about', function () {
            return view('users.about.index');
        })->name('about.index');
    });
