<?php

use App\Models\Lead;
use App\Models\User;
use App\Models\Product;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\LeadTypeController;
use App\Http\Controllers\TripTypeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\LeadSourceController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\LeadManagerController;
use App\Http\Controllers\AccomodationController;
use App\Http\Controllers\LeadPipelineController;
use App\Http\Controllers\EmailTemplateController;
use App\Http\Controllers\Auth\ForgotPasswordController;

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

Route::group(['middleware' => ['web']],function(){
    Route::get('/login', function(){ return view('auth.login'); })->name('login');
    Route::post('/login/done', [LoginController::class, 'store'])->name('signin');
    Route::get('/forgot_password', [ForgotPasswordController::class, 'create'])->name('forgot_password');
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
            Route::get('view/{lead}', 'view')->name('view');
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
            Route::post('draft', 'draft')->name('storedraft');
            Route::get('/','index')->name('index');
            Route::get('inbox', 'inbox')->name('inbox');
            Route::get('compose', 'compose')->name('compose');
            Route::get('outbox', 'outbox')->name('outbox');
            Route::post('store', 'store')->name('store');
            Route::get('sent', 'sent')->name('sent');
            Route::delete('mail/{id}', 'destroy')->name('destroy');
            Route::get('trash', 'trash')->name('trash');
            Route::get('draft','getDraft')->name('draft');
            // Route::post('maill/{id}', 'forceDelete')->name('forceDelete');
            // Route::post('mail/{id}', 'restore')->name('restore');
        });

    // Product Routes
    Route::resource('products',ProductController::class);

    // Note Routes
    Route::resource('notes',NoteController::class);

    // Activity Routes
    Route::post('/activities/create/find_user',[ActivityController::class,'find_user'])->name('find_user');
    Route::resource('activities',ActivityController::class);

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

        // Email Routes
        Route::resource('email_templates',EmailTemplateController::class);

        // Trip Routes
        Route::resource('trips',TripController::class);

        // Trip Type Routes
        Route::resource('trip_types',TripTypeController::class);

        // Accomodation Routes
        Route::resource('accomodations',AccomodationController::class);

        // Role Routes
        Route::resource('roles',RoleController::class);

        // User Routes
        Route::resource('users',UserController::class);
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
