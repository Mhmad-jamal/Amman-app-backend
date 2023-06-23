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
Route::get('/upgrade-to-pro', UpgradeToPro::class)->name('upgrade-to-pro');

Route::middleware('auth')->group(function () {
    Route::get('/profile', Profile::class)->name('profile');
    Route::get('/profile-example', ProfileExample::class)->name('profile-example');
    Route::get('/users', Users::class)->name('users');
    Route::get('/login-example', LoginExample::class)->name('login-example');
    Route::get('/register-example', RegisterExample::class)->name('register-example');
    Route::get('/forgot-password-example', ForgotPasswordExample::class)->name('forgot-password-example');
    Route::get('/reset-password-example', ResetPasswordExample::class)->name('reset-password-example');
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/transactions', Transactions::class)->name('transactions');
    Route::get('/bootstrap-tables', BootstrapTables::class)->name('bootstrap-tables');
    Route::get('/lock', Lock::class)->name('lock');
    Route::get('/buttons', Buttons::class)->name('buttons');
    Route::get('/notifications', Notifications::class)->name('notifications');
    Route::get('/forms', Forms::class)->name('forms');
    Route::get('/modals', Modals::class)->name('modals');
    Route::get('/typography', Typography::class)->name('typography');
    //for users
    Route::get('/users', Users::class)->name('users');

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
    Route::get('/properties', [WebProperties::class, 'view_all'])->name('all_property');
// for banner 
Route::get('/Banner/add', [BannerController::class, 'add'])->name('add_new_banner');
Route::get('/Banner/view', [BannerController::class, 'view'])->name('view_banner');
Route::get('/Banner/edit', [BannerController::class, 'edit'])->name('edit_banner');

// end bannner
// contract
Route::get('/Contract/add', [ContractController::class, 'add'])->name('add_new_contract');
Route::get('/Contract/view', [ContractController::class, 'view'])->name('view_contract');
Route::get('/Contract/edit/{id}', [ContractController::class, 'edit'])->name('edit_contract');
Route::get('/Contract/details/{id}', [ContractController::class, 'details'])->name('details_contract');

// end contract 
Route::post('/Banner/add', [BannerController::class, 'create'])->name('create_banner');
Route::post('//api/update/banner', [BannerController::class, 'update'])->name('update_banner');
Route::post('/banner/delete', [BannerController::class, 'delete'])->name('delete_banner_image');

Route::get('Contract/request/check', [ContractController::class, 'checkRequestView'])->name('check.request');
/// this is maintenance route 
Route::get('/order/maintenance/view', [OrderController::class, 'view_maintenance_order'])->name('view_maintenance_order');
Route::get('/order/maintenance/details/{id}', [OrderController::class, 'details_maintenance_order'])->name('details_maintenance_order');

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

Route::any('/api/getpropertiesbyclientId', [Property::class, 'getpropertiesbyclientId']);
Route::any('/api/getpropertiesbySection', [Property::class, 'getpropertiesbySection']);
Route::any('/api/getpropertiesbyid', [Property::class, 'getpropertiesbyid']);
Route::any('/api/editpropety', [Property::class, 'editpropety']);
Route::any('/api/deleteproperty', [Property::class, 'deleteproperty']);
Route::any('/api/likeProperty', [Property::class, 'likeProperty']);
Route::any('/api/getlikeProperty', [Property::class, 'getlikeProperty']);

// for banner 

Route::any('/api/getbannerimage', [BannerMobileController::class, 'get']);
// for contract
Route::any('/api/contract/create', [MobileContractController::class, 'create']);
Route::any('/api/contract/update', [MobileContractController::class, 'update']);
Route::any('/api/check/status/update', [ContractController::class, 'updateStatus']);
Route::any('/api/order/status/update', [OrderController::class, 'updateStatus']);

Route::any('/api/payment/create', [PaymentController::class, 'create'])->name('create_payment');

Route::any('/api/contract/get', [MobileContractController::class, 'get']);

Route::get('/api/contract/details/pdf/{id}', [ContractController::class, 'ContractPdf'])->name('contract_details_pdf');
// for payment
Route::any('/api/payment/get', [PaymentController::class, 'get']);
Route::any('/api/payment/update/status', [PaymentController::class, 'updateStatus']);
//for Client
Route::any('/api/client/get', [ClientController::class, 'get']);
//maintenance 
Route::any('/api/order/create', [OrderController::class, 'create']);




