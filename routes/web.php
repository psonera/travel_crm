<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PermissionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// Leads Route
Route::name('leads.')
    ->prefix('leads')
    ->group(function(){
        Route::get('/', [LeadController::class, 'index'])->name('index');
        Route::get('view/{id}', [LeadController::class, 'show'])->name('view');
        Route::get('create', [LeadController::class, 'create'])->name('create');
        Route::post('create/store', [LeadController::class, 'store'])->name('store');
        Route::get('edit/{id}', [LeadController::class, 'edit'])->name('edit');
        Route::post('delete/{id}', [LeadController::class, 'destroy'])->name('delete');
        Route::post('update/{id}', [LeadController::class, 'update'])->name('update');
        Route::post('create/add_product', [LeadController::class, 'add_product'])->name('add_product');
    });


Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::prefix('/')
    ->middleware('auth')
    ->group(function () {
        Route::resource('roles', RoleController::class);
        Route::resource('permissions', PermissionController::class);
    });


    
// Route::resource('product',ProductController::class);

Route::name('products.')
    ->prefix('products')
    ->group(function(){
        Route::get('/', [ProductController::class, 'index'])->name('index');
        Route::get('view/{id}', [ProductController::class, 'show'])->name('view');
        Route::get('create', [ProductController::class, 'create'])->name('create');
        Route::post('create/store', [ProductController::class, 'store'])->name('store');
        Route::get('edit/{id}', [ProductController::class, 'edit'])->name('edit');
        Route::delete('delete/{id}', [ProductController::class, 'destroy'])->name('destroy');
        Route::post('update/{id}', [ProductController::class, 'update'])->name('update');

    });
