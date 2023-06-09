<?php

use App\Http\Livewire\BootstrapTables;
use App\Http\Livewire\Components\Buttons;
use App\Http\Livewire\Components\Forms;
use App\Http\Livewire\Components\Modals;
use App\Http\Livewire\Components\Notifications;
use App\Http\Livewire\Components\Typography;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\Err404;
use App\Http\Livewire\Err500;
use App\Http\Livewire\ResetPassword;
use App\Http\Livewire\ForgotPassword;
use App\Http\Livewire\Lock;
use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Profile;
use App\Http\Livewire\Auth\Register;
use App\Http\Livewire\ForgotPasswordExample;
use App\Http\Livewire\Index;
use App\Http\Livewire\LoginExample;
use App\Http\Livewire\ProfileExample;
use App\Http\Middleware\CheckPermission;

use App\Http\Livewire\RegisterExample;
use App\Http\Livewire\Transactions;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\ResetPasswordExample;
use App\Http\Livewire\UpgradeToPro;
use App\Http\Livewire\Users;
use App\Http\Controllers\Mobile\MobileRegisterController;
use App\Http\Controllers\Mobile\LoginMobile;
use App\Http\Controllers\Mobile\OrderController;

use App\Http\Controllers\Mobile\Property;
use App\Http\Controllers\Web\WebProperties;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\Mobile\MobileContractController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SubsicriptionController;





use App\Http\Controllers\Mobile\BannerMobileController;

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

Route::redirect('/', '/login');


Route::get('/register', Register::class)->name('register');

Route::get('/login', Login::class)->name('login');

Route::get('/forgot-password', ForgotPassword::class)->name('forgot-password');

Route::get('/reset-password/{id}', ResetPassword::class)->name('reset-password')->middleware('signed');

Route::get('/404', Err404::class)->name('404');
Route::get('/500', Err500::class)->name('500');

Route::middleware('auth')->group(function () {


    Route::get('/profile', Profile::class)->name('profile');
    Route::post('/change/password', [Profile::class, 'editPassword'])->name('edit_password');

    Route::get('/profile-example', ProfileExample::class)->name('profile-example');
    Route::middleware('checkPermission:client_page,Show')->group(function () {
        // Routes that require permission to access
        Route::get('/clients', Users::class)->name('users');
    });


    Route::middleware('checkPermission:dashboard,Show')->group(function () {
        // Routes that require permission to access
        Route::get('/dashboard', Dashboard::class)->name('dashboard');
    });
    Route::get('/transactions', Transactions::class)->name('transactions');
    Route::get('/bootstrap-tables', BootstrapTables::class)->name('bootstrap-tables');
    Route::get('/lock', Lock::class)->name('lock');
    Route::get('/buttons', Buttons::class)->name('buttons');
    Route::get('/notifications', Notifications::class)->name('notifications');
    Route::get('/forms', Forms::class)->name('forms');
    Route::get('/modals', Modals::class)->name('modals');
    Route::get('/typography', Typography::class)->name('typography');
    //for users

    Route::get('/user/view/{id}', [Users::class, 'View'])->name('view_user');


    Route::get('/user/edit/{id}', [Users::class, 'edit'])->name('edit_user');
    Route::post('/user/editUser', [Users::class, 'editUser'])->name('editUser');

    Route::get('/delete_user/{id}', [Users::class, 'delete'])->name('delete_user');
    //for properties 
    Route::get('/properties/view/{id}', [WebProperties::class, 'view'])->name('properties_view');
    Route::get('/properties/edit/{id}', [WebProperties::class, 'edit'])->name('properties_edit');
    Route::post('/properties/update', [WebProperties::class, 'update'])->name('properties_update');
    Route::post('/properties/deleteimage/', [WebProperties::class, 'deleteImage'])->name('delete_image');

    Route::post('/properties/addimage', [WebProperties::class, 'addImage'])->name('add_image');
    Route::get('/properties/delete/{id}', [WebProperties::class, 'delete'])->name('properties_delete');
    Route::middleware('checkPermission:properties,Show')->group(function () {
        // Routes that require permission to access
        Route::get('/properties', [WebProperties::class, 'view_all'])->name('all_property');
    });
    // for banner 
    Route::middleware('checkPermission:banner_Page,view_banner')->group(function () {
        // Routes that require permission to access
        Route::get('/Banner/view', [BannerController::class, 'view'])->name('view_banner');
    });
    Route::middleware('checkPermission:banner_Page,edit_banner')->group(function () {
        // Routes that require permission to access
        Route::get('/Banner/edit', [BannerController::class, 'edit'])->name('edit_banner');
    });
    Route::middleware('checkPermission:banner_Page,add_banner')->group(function () {
        // Routes that require permission to access
        Route::get('/Banner/add', [BannerController::class, 'add'])->name('add_new_banner');
    });
    Route::get('/Contract/add', [ContractController::class, 'add'])->name('add_new_contract');
    Route::middleware('checkPermission:contract_page,view_all_contract')->group(function () {
        // Routes that require permission to access
        Route::get('/Contract/view', [ContractController::class, 'view'])->name('view_contract');
    });
    Route::middleware('checkPermission:all_contract_page,edit_contract')->group(function () {
        // Routes that require permission to access
        Route::get('/Contract/edit/{id}', [ContractController::class, 'edit'])->name('edit_contract');
    });
    Route::middleware('checkPermission:all_contract_page,view_contract')->group(function () {
        // Routes that require permission to access
        Route::get('/Contract/details/{id}', [ContractController::class, 'details'])->name('details_contract');
    });
    Route::middleware('checkPermission:contract_page,view_check_request')->group(function () {
        // Routes that require permission to access
        Route::get('Contract/request/check', [ContractController::class, 'checkRequestView'])->name('check.request');
    });

    // end contract 
    Route::post('/Banner/add', [BannerController::class, 'create'])->name('create_banner');
    Route::post('/api/update/banner', [BannerController::class, 'update'])->name('update_banner');
    Route::post('/banner/delete', [BannerController::class, 'delete'])->name('delete_banner_image');


    /// this is maintenance route 
    Route::middleware('checkPermission:order_page,view_maintenance_order')->group(function () {
        // Routes that require permission to access
        Route::get('/order/maintenance/view', [OrderController::class, 'view_maintenance_order'])->name('view_maintenance_order');
    });
    Route::middleware('checkPermission:order_page,view_general_order')->group(function () {
        // Routes that require permission to access
        Route::get('/order/general/view', [OrderController::class, 'view_general_order'])->name('view_general_order');
    });
    Route::middleware('checkPermission:orders,View')->group(function () {
        // Routes that require permission to access
        Route::get('/order/maintenance/details/{id}', [OrderController::class, 'details_maintenance_order'])->name('details_maintenance_order');
    });

    //users
    Route::middleware('checkPermission:admin_page,Show')->group(function () {
        // Routes that require permission to access
        Route::get('/users/view', [AdminController::class, 'view'])->name('view_admin');
    });
    Route::middleware('checkPermission:admin_page,view')->group(function () {
        // Routes that require permission to access
        Route::get('/users/view/details/{id}', [AdminController::class, 'details'])->name('details_admin');
    });
    Route::middleware('checkPermission:admin_page,edit')->group(function () {
        // Routes that require permission to access
        Route::get('/users/edit/{id}', [AdminController::class, 'edit'])->name('edit_admin');
    });
    Route::middleware('checkPermission:subsicription,Show')->group(function () {
        
        Route::get('/subsicription', [SubsicriptionController::class, 'view'])->name('view_subsicription');
    });
    Route::middleware('checkPermission:subsicription,view_subsicription')->group(function () {
        
        Route::get('/client/subsicription/{id}', [SubsicriptionController::class, 'details'])->name('details_subsicription');
    });
    Route::middleware('checkPermission:subsicription,edit_subsicription')->group(function () {
        
        Route::get('/client/subsicription/edit/{id}', [SubsicriptionController::class, 'edit'])->name('edit_subsicription');
    });
    Route::post('/client/subsicription/delete', [SubsicriptionController::class, 'delete'])->name('delete_subsicription');
    Route::post('/client/subsicription/update', [SubsicriptionController::class, 'update'])->name('update_subsicription');

  
    Route::post('/subsicription', [SubsicriptionController::class, 'create'])->name('create_subsicription');

    Route::post('/users/edit/password', [AdminController::class, 'editPassowrd'])->name('Admin_edit_Password');
    Route::post('/users/update', [AdminController::class, 'update'])->name('Admin_update');
    Route::get('/users/delete/{id}', [AdminController::class, 'delete'])->name('Admin_delete');
    Route::post('/users/add/admin', [AdminController::class, 'add'])->name('add_new_admin');
    Route::post('/api/users/update/permession', [AdminController::class, 'updatePermission'])->name('update_permession');
});

//route for mobile

// for sign-in and register 
Route::post('/api/register', [MobileRegisterController::class, 'register']);
Route::post('/api/client/update', [MobileRegisterController::class, 'update']);

Route::post('/api/login', [LoginMobile::class, 'login']);
// for property

Route::post('/api/createproperty', [Property::class, 'Create']);
Route::post('/api/deletePropertyImage', [Property::class, 'deletePropertyImage']);


Route::any('/api/getallproperties', [Property::class, 'getallproperties']);
Route::any('/api/getallpropertiesSearch', [Property::class, 'getallpropertiesSearch']);

Route::any('/api/getsubsecription', [SubsicriptionController::class, 'getsubsicription']);

Route::any('/api/getpropertiesbyclientId', [Property::class, 'getpropertiesbyclientId']);
Route::any('/api/getpropertiesbySection', [Property::class, 'getpropertiesbySection']);
Route::any('/api/getpropertiesbyid', [Property::class, 'getpropertiesbyid']);
Route::any('/api/editpropety', [Property::class, 'editpropety']);
Route::any('/api/deleteproperty', [Property::class, 'deleteproperty']);
Route::any('/api/likeProperty', [Property::class, 'likeProperty']);
Route::any('/api/getlikeProperty', [Property::class, 'getlikeProperty']);

// for banner 

Route::any('/api/getbannerimage', [BannerMobileController::class, 'get']);
Route::any('/api/views/counter', [BannerMobileController::class, 'counter']);

// for contract
Route::any('/api/contract/create', [MobileContractController::class, 'create']);
Route::any('/api/contract/update', [MobileContractController::class, 'update']);
Route::any('/api/check/status/update', [ContractController::class, 'updateStatus']);
Route::any('/api/order/status/update', [OrderController::class, 'updateStatus']);
Route::post('/api/Contract/request/get', [ContractController::class, 'getCheck'])->name('get.check');
Route::post('/api/order/get', [OrderController::class, 'getOrder'])->name('get.order');

Route::any('/api/payment/create', [PaymentController::class, 'create'])->name('create_payment');
Route::any('/api/contract/terminate', [MobileContractController::class, 'terminate'])->name('terminate');

Route::any('/api/contract/get', [MobileContractController::class, 'get']);

Route::get('/api/contract/details/pdf/{id}', [ContractController::class, 'ContractPdf'])->name('contract_details_pdf');
// for payment
Route::any('/api/payment/get', [PaymentController::class, 'get']);
Route::any('/api/payment/update/status', [PaymentController::class, 'updateStatus']);
//for Client
Route::any('/api/client/get', [ClientController::class, 'get']);
//maintenance 
Route::any('/api/order/create', [OrderController::class, 'create']);
