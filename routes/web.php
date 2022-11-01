<?php

use App\Models\Lead;
use App\Models\User;
use App\Models\Product;
use App\Models\LeadSource;
use App\Models\LeadProduct;
use App\Models\QuotationItem;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CityController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\LeadTypeController;
use App\Http\Controllers\TripTypeController;
use App\Http\Controllers\Quotationcontroller;
use App\Http\Controllers\TransportController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\LeadSourceController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\LeadManagerController;
use App\Http\Controllers\AccomodationController;
use App\Http\Controllers\ActivityFileController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\LeadPipelineStageController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\CheckPermissionController;

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
            'leads' => Lead::latest()->paginate(10),
            'lead_monthwise' => Lead::select(DB::raw("COUNT(*) as count"), DB::raw("DATE_FORMAT(created_at, '%b') as month_name"))
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw("MONTH('created_at')"))
            ->pluck('count', 'month_name')->toArray(),
            'won_leads_count' => Lead::where('lead_pipeline_stage_id', 5)->count(),
            'total_earning' => Lead::where('lead_pipeline_stage_id', 5)->sum('lead_value'),
            'total_user' => User::all()->count(),
            'user_monthwise' => User::select(DB::raw("COUNT(*) as count"), DB::raw("DATE_FORMAT(created_at, '%b') as month_name"))
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw("MONTH('created_at')"))
            ->pluck('count', 'month_name')->toArray(),
            'lead_source_counts' => LeadSource::withCount('leads')->get(),
            'new_leads' => Lead::where('lead_pipeline_stage_id', 1)->count(),
            'product_sales' => LeadProduct::where('product_id', '!=', '0')->sum('amount') + QuotationItem::where('product_id', '!=', '0')->sum('total'),
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
            Route::get('edit/{lead}', 'edit')->name('edit');
            Route::post('delete/{lead}', 'destroy')->name('delete');
            Route::post('update/{lead}', 'update')->name('update');
            Route::post('add_product', 'add_product')->name('add_product');
            Route::post('find_lm', 'find_lm')->name('find_lm');
            Route::post('find_manager', 'find_manager')->name('find_manager');
            Route::post('find_prd', 'find_prd')->name('find_prd');
            Route::post('find_trip', 'find_trip')->name('find_trip');
            Route::post('change_status', 'change_status')->name('change_status');
            Route::get('get_stages', 'get_stages')->name('getStages');
            Route::get('get', 'get')->name('getLeads');
            Route::post('remove_stage', 'remove_stage')->name('remove_stage');
        });

    // Checking Permission Route
    Route::get('permission/{permission}', [CheckPermissionController::class, 'check']);

    //Email routes
    Route::name('mails.')
        ->prefix('mails')
        ->controller(MailController::class)
        ->group(function(){
            Route::post('draft', 'draft')->name('storedraft');
            Route::get('/','index')->name('index');
            Route::get('inbox', 'inbox')->name('inbox');
            //vue js edit
            Route::get('/editdraft/{email}','edit')->name('editdraft');
            Route::post('/updatedraft/{email}','update')->name('updatedraft');
            //vue js send draft mail
            Route::get('senddraft/{id}', 'sendDraft')->name('sendDraft');
            Route::get('compose', 'compose')->name('compose');
            Route::get('outbox', 'outbox')->name('outbox');
            Route::post('store', 'store')->name('store');
            //vue js sent
            Route::get('sent', 'sent')->name('sent');
            Route::get('getsent','getsent')->name('getsent');
            //vue js delete
            Route::get('destroy/{id}', 'destroy')->name('destroy');
            //vue js trash
            Route::get('trash', 'trash')->name('trash');
            Route::get('gettrash', 'gettrash')->name('gettrash');
            //vue js draft
            Route::get('draft','draftview')->name('draft');
            Route::get('getdraft','getDraft')->name('getdraft');
            //vue js force delete
            Route::post('forceDelete/{id}', 'forceDelete')->name('forceDelete');
            Route::get('restore/{id}', 'restore')->name('restore');
    });


    // Product Routes
    Route::name('products.')
        ->prefix('products')
        ->controller(ProductController::class)
        ->group(function(){
            Route::get('/','index')->name('index');
            Route::get('/create','create')->name('create');
            Route::post('/store','store')->name('store');
            Route::get('/{product}/edit','edit')->name('edit');
            Route::put('/{product}','update')->name('update');
            Route::delete('/delete/{product}','destroy')->name('destroy');
            Route::get('/getproducts','getproducts')->name('getproducts');
    });

    // Product Routes
    Route::name('lead_pipeline_stages.')
        ->prefix('lead_pipeline_stages')
        ->controller(LeadPipelineStageController::class)
        ->group(function(){
            Route::get('create','create')->name('create');
            Route::post('store','store')->name('store');
    });

    // Activity Routes
    Route::name('activities.')
        ->prefix('activities')
        ->controller(ActivityController::class)
        ->group(function(){
            Route::get('/', 'index')->name('index');
            Route::get('view/{activity}', 'view')->name('view');
            Route::get('create', 'create')->name('create');
            Route::post('store', 'store')->name('store');
            Route::get('edit/{activity}', 'edit')->name('edit');
            Route::get('delete/{id}', 'destroy')->name('delete');
            Route::post('update/{activity}', 'update')->name('update');
            Route::get('file-download/{id}', 'download')->name('download');
            Route::get('mark-done/{id}', 'mark_as_done')->name('mark-done');
            Route::post('create/find_user', 'find_user')->name('find_user');
        });

    // Activity File Routes
    Route::name('activity_file.')
        ->prefix('activity_file')
        ->controller(ActivityFileController::class)
        ->group(function(){
            Route::get('view/{activity_file}', 'view')->name('view');
            Route::post('store', 'store')->name('store');
            Route::post('delete/{id}', 'destroy')->name('delete');
            Route::post('update/{id}', 'update')->name('update');
        });

        // Profile Routes
    Route::name('profile.')
        ->prefix('profile')
        ->controller(ProfileController::class)
        ->group(function(){
            Route::get('edit/{user}', 'edit')->name('edit');
            Route::post('update/{user}', 'update')->name('update');
        });

    // Lead Manager Routes
    Route::name('lead_managers.')
        ->prefix('lead_managers')
        ->controller(LeadManagerController::class)
        ->group(function(){
            Route::get('/', 'index')->name('index');
            Route::get('view/{lead_manager}', 'view')->name('view');
            Route::get('create', 'create')->name('create');
            Route::post('store', 'store')->name('store');
            Route::get('edit/{lead_manager}', 'edit')->name('edit');
            Route::delete('delete/{lead_manager}', 'destroy')->name('destroy');
            Route::post('update/{lead_manager}', 'update')->name('update');
        });

    Route::name('notifications.')
           ->prefix('notifications')
           ->controller(NotificationController::class)
           ->group(function(){
                Route::get('markread/{id}', 'markread')->name('markasread');
                Route::get('markallread', 'markallread')->name('markallread');
           });

    Route::prefix('settings')->name('settings.')->group(function () {

        Route::get('/', function(){ return view('settings.index'); })->name('index');

        // Lead Source Routes
        Route::name('lead_sources.')
            ->prefix('lead_sources')
            ->controller(LeadSourceController::class)
            ->group(function(){
                Route::get('','index')->name('index');
                Route::get('/create','create')->name('create');
                Route::post('/store','store')->name('store');
                Route::get('/edit/{lead_source}','edit')->name('edit');
                Route::put('/{lead_source}','update')->name('update');
                Route::delete('/delete/{lead_source}','destroy')->name('destroy');
        });

        // Lead Type Routes
        Route::name('lead_types.')
            ->prefix('lead_types')
            ->controller(LeadTypeController::class)
            ->group(function(){
                Route::get('','index')->name('index');
                Route::get('/create','create')->name('create');
                Route::post('/store','store')->name('store');
                Route::get('/edit/{lead_type}','edit')->name('edit');
                Route::put('/{lead_type}','update')->name('update');
                Route::delete('/delete/{lead_type}','destroy')->name('destroy');

                //api
                Route::get('getleadtype','allleadtype');
        });

        // Lead Pipeline Stages Routes
        Route::name('lead_pipeline_stages.')
            ->prefix('lead_pipeline_stages')
            ->controller(LeadPipelineStageController::class)
            ->group(function(){
                Route::get('','index')->name('index');
                Route::get('create','create')->name('create');
                Route::post('store','store')->name('store');
                Route::get('edit/{lead_pipeline_stage}','edit')->name('edit');
                Route::post('update/{lead_pipeline_stage}','update')->name('update');
                Route::post('delete/{lead_pipeline_stage}','destroy')->name('delete');
        });

        // Trip Routes
        Route::name('trips.')
            ->prefix('trips')
            ->controller(TripController::class)
            ->group(function(){
                Route::get('/', 'index')->name('index');
                Route::get('view/{trip}', 'view')->name('view');
                Route::get('create', 'create')->name('create');
                Route::post('store', 'store')->name('store');
                Route::get('edit/{trip}', 'edit')->name('edit');
                Route::post('delete/{trip}', 'destroy')->name('delete');
                Route::post('update/{trip}', 'update')->name('update');
                Route::get('get', 'get')->name('getAll');
        });

        // Trip Type Routes
        Route::name('trip_types.')
            ->prefix('trip_types')
            ->controller(TripTypeController::class)
            ->group(function(){
                Route::get('/', 'index')->name('index');
                Route::get('view/{trip_type}', 'view')->name('view');
                Route::get('create', 'create')->name('create');
                Route::post('store', 'store')->name('store');
                Route::get('edit/{trip_type}', 'edit')->name('edit');
                Route::post('delete/{trip_type}', 'destroy')->name('delete');
                Route::post('update/{trip_type}', 'update')->name('update');
                Route::get('get', 'get')->name('getAll');
        });

        // Transport Routes
        Route::name('transports.')
            ->prefix('transports')
            ->controller(TransportController::class)
            ->group(function(){
                Route::get('/', 'index')->name('index');
                Route::get('view/{transport}', 'view')->name('view');
                Route::get('create', 'create')->name('create');
                Route::post('store', 'store')->name('store');
                Route::get('edit/{transport}', 'edit')->name('edit');
                Route::post('delete', 'destroy')->name('delete');
                Route::post('update/{transport}', 'update')->name('update');
        });

        // Accomodation Routes
        Route::name('accomodations.')
            ->prefix('accomodations')
            ->controller(AccomodationController::class)
            ->group(function(){
                Route::get('/', 'index')->name('index');
                Route::get('view/{accomodation}', 'view')->name('view');
                Route::get('create', 'create')->name('create');
                Route::post('store', 'store')->name('store');
                Route::get('edit/{accomodation}', 'edit')->name('edit');
                Route::post('delete/{accomodation}', 'destroy')->name('delete');
                Route::post('update/{accomodation}', 'update')->name('update');
                Route::get('get', 'get')->name('getAll');
        });

        // Role Routes
        Route::name('roles.')
            ->prefix('roles')
            ->controller(RoleController::class)
            ->group(function(){
                Route::get('','index')->name('index');
                Route::get('/create','create')->name('create');
                Route::post('/store','store')->name('store');
                Route::get('/edit/{role}','edit')->name('edit');
                Route::put('/{role}','update')->name('update');
                Route::delete('/delete/{role}','destroy')->name('destroy');

                //api
                Route::get('getroles','allrole');
        });

        // User Routes
        Route::name('users.')
            ->prefix('users')
            ->controller(UserController::class)
            ->group(function(){
                Route::get('/', 'index')->name('index');
                Route::get('view/{user}', 'view')->name('view');
                Route::get('create', 'create')->name('create');
                Route::post('store', 'store')->name('store');
                Route::get('edit/{user}', 'edit')->name('edit');
                Route::post('update/{user}', 'update')->name('update');
                Route::delete('delete/{user}', 'destroy')->name('destroy');
                //api
                Route::get('getusers/{number}',[UserController::class,'alluser']);
                Route::get('getSources',[UserController::class,'getSources']);
                Route::get('isLeadManager/{id}',[UserController::class,'isLeadManager']);
                Route::get('is_super-admin',[UserController::class,'isAdmin']);
                Route::get('check_manager',[UserController::class,'checkManager']);
                Route::get('managers/{query}',[UserController::class,'managers']);
            });
    });

    Route::name('quotations.')
        ->prefix('quotations')
        ->controller(Quotationcontroller::class)
        ->group(function(){
            Route::get('','index')->name('index');
            Route::get('/create','create')->name('create');
            Route::post('/store','store')->name('store');
            Route::get('/edit/{id}','edit')->name('edit');
            Route::post('/update/{id}','update')->name('update');
            Route::delete('/delete/{id}','destroy')->name('delete');
            //api
            Route::get('/names',"getNames")->name('leadmanagernames');
            Route::get('/leadnames',"getLeadNames")->name('leadnames');
            Route::get('/managers','getManagers')->name('managers');
            Route::get('/search','searchproduct');
            Route::get('/totalquntity','totalquntity');
            Route::get('/country',[CountryController::class,'getCountry']);
            Route::get('/state',[StateController::class,'getState']);
            Route::get('/cities',[CityController::class,'getcities']);
    });

    Route::get('/test_session', function(){ return view('test.test_session'); });

    Route::get('/logout', [LoginController::class, 'logout']);
});

Auth::routes();
