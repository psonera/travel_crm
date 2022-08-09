<?php

use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ProductController;

use App\Http\Controllers\Quotationcontroller;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LeadTypeController;
use App\Http\Controllers\TripTypeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\LeadSourceController;

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
    Route::name('quotation.')->prefix('quotation')->group(function(){
        Route::get('/index',[Quotationcontroller::class,'index'])->name('index');
        Route::get('/create',[Quotationcontroller::class,'create'])->name('create');
        Route::post('/store',[Quotationcontroller::class,'store'])->name('store');
        Route::get('/edit/{id}',[Quotationcontroller::class,'edit'])->name('edit');
        Route::post('/update.{id}',[Quotationcontroller::class,'update'])->name('update');
        Route::get('/delete/{id}',[Quotationcontroller::class,'destroy'])->name('delete');
        Route::get('/search',[Quotationcontroller::class,'searchproduct']);
    });



Route::group(['middleware' => ['auth']], function(){
    Route::get('/', function () {
        return view('dashboard',[
            'leads' => Lead::all(),
            'won_leads_count' => Lead::where('lead_pipeline_stage_id', 5)->count(),
            'total_earning' => Lead::where('lead_pipeline_stage_id', 5)->sum('lead_value'),
            'total_user' => User::all()->count(),
            'new_leads' => Lead::where('lead_pipeline_stage_id', 1)->count(),
            'product_sales' => 550000,
            'total_products' => Product::all()->count()
        ]);
    })->name('dashboard');

    // Leads Route
    Route::name('leads.')
        ->prefix('leads')
        ->controller(LeadController::class)
        ->group(function(){
            Route::get('/', 'index')->name('index');
            Route::get('view/{id}', 'show')->name('view');
            Route::get('create', 'create')->name('create');
            Route::post('store', 'store')->name('store');
            Route::get('edit/{id}', 'edit')->name('edit');
            Route::post('delete/{id}', 'destroy')->name('delete');
            Route::post('update/{id}', 'update')->name('update');
            Route::post('create/add_product', 'add_product')->name('add_product');
            Route::post('create/find_lm', 'find_lm')->name('find_lm');
            Route::post('create/find_prd', 'find_prd')->name('find_prd');
            Route::post('create/find_trip', 'find_trip')->name('find_trip');
            Route::post('change_status', 'change_status')->name('change_status');
        });

    // Roles & Permission Routes
    // Route::prefix('/')
    //     ->middleware('auth')
    //     ->group(function () {
    //         Route::resource('roles', RoleController::class);
    //         Route::resource('permissions', PermissionController::class);
    // });



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

    //Email routes
    Route::name('mails.')
        ->prefix('mails')
        ->controller(MailController::class)
        ->group(function(){
            Route::post('/draft', 'draft')->name('storedraft');
            Route::get('/', 'index')->name('index');
            Route::get('/inbox', 'inbox')->name('inbox');
            Route::get('/compose', 'compose')->name('compose');
            Route::get('/outbox', 'outbox')->name('outbox');
            Route::post('/store', 'store')->name('store');
            Route::get('/sent', 'sent')->name('sent');
            Route::delete('/mail/{id}', 'destroy')->name('destroy');
            Route::get('/trash', 'trash')->name('trash');
            Route::get('/draft','getDraft')->name('draft');
        });


    // Product Routes
    Route::resource('products',ProductController::class);

     // Profile Routes
     Route::resource('profile',ProfileController::class);

    // Lead Manager Routes
    Route::resource('lead_managers',LeadManagerController::class);

    // Settings Route
    Route::get('/settings', function(){
        return view('settings.index');
    })->name('settings.index');


    Route::prefix('settings')->name('settings.')->group(function () {

        // Lead Pipeline Routes
        Route::resource('lead_pipelines',LeadPipelineController::class);

        // Lead Source Routes
        Route::resource('lead_sources',LeadSourceController::class);

        // Lead Type Routes
        Route::resource('lead_types',LeadTypeController::class);

    });

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::prefix('/')
    ->middleware('auth')
    ->group(function () {
        Route::resource('roles', RoleController::class);
        Route::resource('permissions', PermissionController::class);
});

Route::get('/permission',function(){
    $out = "";
    $total = Role::where('name','Super Admin')->first()->permissions->count();
    $out .= "Total = ".$total.'<br>';
    foreach(Role::where('name','Super Admin')->first()->permissions as $permission){
        $out .= $permission->name.'<br>';
    }
    return $out;
});

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


    Route::get('serachview',function(){
        return view('serachview');
    });


    Route::name('quotation.')->prefix('quotation')->group(function(){
        Route::get('/index',[Quotationcontroller::class,'index'])->name('index');
        Route::get('/create',[Quotationcontroller::class,'create'])->name('create');
        Route::post('/store',[Quotationcontroller::class,'store'])->name('store');
        Route::get('/edit/{id}',[Quotationcontroller::class,'edit'])->name('edit');
        Route::post('/update.{id}',[Quotationcontroller::class,'update'])->name('update');
        Route::get('/delete/{id}',[Quotationcontroller::class,'destroy'])->name('delete');
        Route::get('/search',[Quotationcontroller::class,'searchproduct']);
    });

    Route::get('/test_session', function(){ return view('test.test_session'); });

    Route::get('/logout', [LoginController::class, 'logout']);
});

Auth::routes();

