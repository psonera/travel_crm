<?php

use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\LeadManagerController;
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

Auth::routes();

Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');

// Leads Route
Route::name('leads.')
    ->prefix('leads')
    ->controller(LeadController::class)
    ->group(function(){
        Route::get('/', 'index')->name('index');
        Route::get('view/{id}', 'show')->name('view');
        Route::get('create', 'create')->name('create');
        Route::post('create/store', 'store')->name('store');
        Route::get('edit/{id}', 'edit')->name('edit');
        Route::post('delete/{id}', 'destroy')->name('delete');
        Route::post('update/{id}', 'update')->name('update');
        Route::post('create/add_product', 'add_product')->name('add_product');
    });

// Roles & Permission Routes
Route::prefix('/')
    ->middleware('auth')
    ->group(function () {
        Route::resource('roles', RoleController::class);
        Route::resource('permissions', PermissionController::class);
});

// Testing purpose
// Route::get('/permission',function(){
//     $out = "";
//     $total = Role::where('name','Super Admin')->first()->permissions->count();
//     $out .= "Total = ".$total.'<br>';
//     foreach(Role::where('name','Super Admin')->first()->permissions as $permission){
//         $out .= $permission->name.'<br>';
//     }
//     return $out;
// });

// Product Routes
Route::name('products.')
    ->prefix('products')
    ->controller(ProductController::class)
    ->group(function(){
        Route::get('/', 'index')->name('index');
        Route::get('view/{id}', 'show')->name('view');
        Route::get('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');
        Route::get('edit/{id}', 'edit')->name('edit');
        Route::delete('delete/{id}', 'destroy')->name('destroy');
        Route::post('update/{id}', 'update')->name('update');
    });



// Lead Manager Routes
Route::name('lead_managers.')
    ->prefix('lead_managers')
    ->controller(LeadManagerController::class)
    ->group(function(){
        Route::get('/', 'index')->name('index');
        Route::get('view/{id}', 'show')->name('view');
        Route::get('create', 'create')->name('create');
        Route::post('create/store', 'store')->name('store');
        Route::get('edit/{id}', 'edit')->name('edit');
        Route::delete('delete/{id}', 'destroy')->name('destroy');
        Route::post('update/{id}', 'update')->name('update');
    });