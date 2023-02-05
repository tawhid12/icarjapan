<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController as auth;
use App\Http\Controllers\DashboardController as dash;

use App\Http\Controllers\FrontController as front;


use App\Http\Controllers\Settings\BodyTypeController as bodytype;
use App\Http\Controllers\Settings\SubBodyTypeController as subbodytype;
use App\Http\Controllers\Settings\DriveTypeController as drivetype;
use App\Http\Controllers\Settings\InventoryLocationController as invloc;
use App\Http\Controllers\Vehicle\BrandController as brand;
use App\Http\Controllers\Vehicle\ColorController as color;
use App\Http\Controllers\Vehicle\FuelController as fuel;
use App\Http\Controllers\Vehicle\TransmissionController as transmission;
use App\Http\Controllers\Vehicle\VehicleModelController as vehicle_model;
use App\Http\Controllers\Settings\AdminUserController as admin;


use App\Http\Controllers\Vehicle\VehicleController as vehicle;

/* Middleware */
use App\Http\Middleware\isAdmin;
use App\Http\Middleware\isSuperadmin;

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
/*========FrontEnd==== */
Route::get('/', [front::class,'index'])->name('front');

Route::get('/register', [auth::class,'signUpForm'])->name('register');
Route::post('/register', [auth::class,'signUpStore'])->name('register.store');
Route::get('/signin', [auth::class,'signInForm'])->name('signIn');
Route::get('/login', [auth::class,'signInForm'])->name('login');
Route::post('/login', [auth::class,'signInCheck'])->name('login.check');
Route::get('/logout', [auth::class,'singOut'])->name('logOut');

Route::group(['middleware'=>isSuperadmin::class],function(){
    Route::prefix('superadmin')->group(function(){
        Route::get('/dashboard', [dash::class,'superadminDashboard'])->name('superadmin.dashboard');
        /* settings */
        Route::resource('admin',admin::class,['as'=>'superadmin']);
        Route::resource('department',department::class,['as'=>'superadmin']);
        Route::resource('bodytype',bodytype::class,['as'=>'superadmin']);
        Route::resource('subbodytype',subbodytype::class,['as'=>'superadmin']);
        Route::resource('drivetype',drivetype::class,['as'=>'superadmin']);
        Route::resource('invloc',invloc::class,['as'=>'superadmin']);
        Route::resource('brand',brand::class,['as'=>'superadmin']);
        Route::resource('color',color::class,['as'=>'superadmin']);
        Route::resource('fuel',fuel::class,['as'=>'superadmin']);
        Route::resource('transmission',transmission::class,['as'=>'superadmin']);
        Route::resource('vehicle_model',vehicle_model::class,['as'=>'superadmin']);
        /* Vehicle */
        Route::resource('vehicle',vehicle::class,['as'=>'superadmin']);
    });
});
Route::group(['middleware'=>isAdmin::class],function(){
    Route::prefix('admin')->group(function(){
        Route::get('/dashboard', [dash::class,'adminDashboard'])->name('admin.dashboard');
        /* settings */
        Route::resource('admin',admin::class,['as'=>'admin']);
        Route::resource('department',department::class,['as'=>'admin']);
        Route::resource('designation',designation::class,['as'=>'admin']);
        Route::resource('unitstyle',unitstyle::class,['as'=>'admin']);
        Route::resource('unit',unit::class,['as'=>'admin']);
        Route::resource('supplier',supplier::class,['as'=>'admin']);
        Route::resource('buyer',buyer::class,['as'=>'admin']);
        
    });
});



