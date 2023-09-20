<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController as auth;
use App\Http\Controllers\DashboardController as dash;

use App\Http\Controllers\FrontController as front;
use App\Http\Controllers\BuyController as buy;
use App\Http\Controllers\InquiryController as inquiry;
use App\Http\Controllers\MostViewController as mostView;

use App\Http\Controllers\Settings\BodyTypeController as bodytype;
use App\Http\Controllers\Settings\SubBodyTypeController as subbodytype;
use App\Http\Controllers\Settings\DriveTypeController as drivetype;
use App\Http\Controllers\Settings\InventoryLocationController as invloc;
use App\Http\Controllers\Settings\PortController as port;
use App\Http\Controllers\Settings\CountryController as country;

use App\Http\Controllers\Vehicle\BrandController as brand;
use App\Http\Controllers\Vehicle\SubBrandController as subBrand;
use App\Http\Controllers\Vehicle\ColorController as color;
use App\Http\Controllers\Vehicle\DoorController as door;
use App\Http\Controllers\Vehicle\SeatController as seat;
use App\Http\Controllers\Vehicle\ConditionController as condition;
use App\Http\Controllers\Vehicle\FuelController as fuel;
use App\Http\Controllers\Vehicle\TransmissionController as transmission;
use App\Http\Controllers\Vehicle\VehicleModelController as vehicle_model;
use App\Http\Controllers\Settings\AdminUserController as admin;
use App\Http\Controllers\Settings\UserProfileController as userprofile;


use App\Http\Controllers\Vehicle\VehicleController as vehicle;
use App\Http\Controllers\UserDetailController as userdetl;
use App\Http\Controllers\UserContactController as usercontact;
use App\Http\Controllers\UserPreferenceController as userpref;
use App\Http\Controllers\CompanyAccountInfoController as compaccinfo;
use App\Http\Controllers\ConsigneeDetailController as consigdetl;
use App\Http\Controllers\FavouriteVehicleController as favourvehicle;
use App\Http\Controllers\ReservedVehicleController as reservevehicle;
use App\Http\Controllers\PurchasedVehicleController as purvehicle;
use App\Http\Controllers\AuctionVehicleController as aucvehicle;

use App\Http\Controllers\NotificationController as notification;
use App\Http\Controllers\InvoiceController as invoice;
use App\Http\Controllers\PaymentController as payment;
use App\Http\Controllers\TestController as test;
use App\Http\Controllers\ContactUsController as contactus;

use App\Http\Controllers\NotifyController as notify;
use App\Http\Controllers\NoteController as note;

use App\Http\Controllers\ClientModuleController as clientmodule;
use App\Http\Controllers\SalesModuleController as salesmodule;

use App\Http\Controllers\ShipmentDetailController as shipment;
use App\Http\Controllers\DepositController as deposit;

use App\Http\Controllers\PhotoGallaryController as pGallery;

/* Middleware */
use App\Http\Middleware\isAccountant;
use App\Http\Middleware\isSuperadmin;
use App\Http\Middleware\isSalesexecutive;
use App\Http\Middleware\isUser;

use App\Http\Middleware\unknownCountryMiddleware;
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
/*Test controler */
Route::get('/mail', [test::class,'index'])->name('mail');

/*========FrontEnd==== */

//Route::group(['middleware' => unknownCountryMiddleware::class], function () {
Route::get('/country-select', [front::class,'countrySelect'])->name('front.countrySelect');
Route::get('/country-select-post', [front::class,'countrySelectpost'])->name('countrySelectpost');
//});

Route::group(['middleware' => 'country.selection'], function () {
// Your protected routes
Route::get('/', [front::class,'index'])->name('front');

Route::resource('mostview',mostView::class);
Route::get('/used-cars-search/{brand}', [front::class,'brand'])->name('brand');
Route::get('/used-cars-search/{brand}/{subBrand}', [front::class,'subBrand'])->name('subBrand');
Route::get('/used-cars-search/{brand}/{subBrand}/{stock_id}', [front::class,'singleVehicle'])->name('singleVehicle');

Route::get('/used-cars-search',[front::class,'searchStData'])->name('searchStData');


/*Route::get('/search',[front::class,'search_by_data'])->name('searchStData');
Route::post('/vehicle/search/data/',[front::class,'searchpostStData'])->name('search_by_data');*/

/* Country Wise Vehicle */
Route::get('/icar-{country}', [front::class,'countrywiseVehicle'])->name('countrywiseVehicle');

Route::get('/resize-image/{foldername}/{filename}/{width}/{height}', [front::class,'resizeImage'])->name('resizeImage');

Route::resource('inquiry', inquiry::class)->only(['store']);
Route::resource('contactus', contactus::class)->only(['store']);


/*=== Page ===*/
Route::get('/why-choose-us',function(){ return view('front.page.why-choose-us'); });
Route::get('/how-to-order-from-auction',function(){ return view('front.page.how-to-order-from-auction'); });
Route::get('/how-to-buy-from-stock',function(){ return view('front.page.how-to-buy-from-stock'); });
Route::get('/shipping',function(){ return view('front.page.shipping'); });
Route::get('/inspection-services',function(){ return view('front.page.inspection-services'); });
Route::get('/overview',function(){ return view('front.page.overview'); });
Route::get('/company-profile',function(){ return view('front.page.company-profile'); });
Route::get('/customer-review',function(){ return view('front.page.customer-review'); });
Route::get('/bank-information',function(){ return view('front.page.bank-information'); });
Route::get('/faq',function(){ return view('front.page.faq'); })->name('faq');
Route::get('/contact-us',function(){ return view('front.page.contact-us'); });

});

Route::get('/vehicle/search/data/',[front::class,'searchpostStData'])->name('search_by_data');
Route::get('/vehicle/advance/search/data/',[front::class,'front_adv_search_by_data'])->name('front_adv_search_by_data');


Route::get('/register', [auth::class,'signUpForm'])->name('register');
Route::post('/register', [auth::class,'signUpStore'])->name('register.store');
Route::get('/signin', [auth::class,'signInForm'])->name('signIn');
Route::get('/login', [auth::class,'signInForm'])->name('login');
Route::post('/login', [auth::class,'signInCheck'])->name('login.check');
Route::get('/logout', [auth::class,'singOut'])->name('logOut');

Route::group(['middleware'=>[isUser::class,'country.selection']],function(){
    Route::prefix('user')->group(function(){
        Route::get('/dashboard', [dash::class,'userDashboard'])->name('user.dashboard');

        Route::get('/profile', [userprofile::class,'profile'])->name('user.profile');
        Route::post('/profile', [userprofile::class,'store'])->name('user.profile.store');
        Route::get('/change_password', [userprofile::class,'change_password'])->name('user.change_password');
        Route::post('/change_password', [userprofile::class,'change_password_store'])->name('user.change_password.store');

        Route::resource('userdetl', userdetl::class,['as'=>'user']);
        Route::resource('usercontact', usercontact::class,['as'=>'user']);
        Route::resource('userpref', userpref::class,['as'=>'user']);
        Route::resource('compaccinfo', compaccinfo::class,['as'=>'user']);
        Route::resource('consigdetl', consigdetl::class,['as'=>'user']);
        Route::resource('favourvehicle', favourvehicle::class,['as'=>'user']);
        Route::resource('reservevehicle', reservevehicle::class,['as'=>'user']);
        Route::resource('notifyvehicle', notify::class,['as'=>'user']);
        Route::resource('purvehicle', purvehicle::class,['as'=>'user']);
        Route::resource('aucvehicle', aucvehicle::class,['as'=>'user']);
        
        Route::resource('buy', buy::class,['as'=>'user']);
        Route::resource('reserve', reservevehicle::class,['as'=>'user']);
        Route::resource('inquiry', inquiry::class,['as'=>'user']);
        Route::resource('invoice', invoice::class,['as'=>'user']);
        Route::resource('payment', payment::class,['as'=>'user']);


    });
});
Route::group(['middleware'=>isAccountant::class],function(){
    Route::prefix('accountant')->group(function(){
        Route::get('/dashboard', [dash::class,'accountantDashboard'])->name('accountant.dashboard');

        Route::get('/profile', [userprofile::class,'profile'])->name('accountant.profile');
        Route::post('/profile', [userprofile::class,'store'])->name('accountant.profile.store');
        Route::get('/change_password', [userprofile::class,'change_password'])->name('accountant.change_password');
        Route::post('/change_password', [userprofile::class,'change_password_store'])->name('accountant.change_password.store');

        /*Cm Module */
        Route::get('all-client-list',[clientmodule::class,'all_client_list'])->name('accountant.all_client_list');
        Route::get('client-individual/{id}',[clientmodule::class,'client_individual'])->name('accountant.client_individual');

      
        Route::resource('vehicle',vehicle::class,['as'=>'accountant'])->only(['show']);
        Route::resource('invoice', invoice::class,['as'=>'accountant'])->only(['show']);
        Route::resource('payment', payment::class,['as'=>'accountant']);
        Route::resource('reservevehicle', reservevehicle::class,['as'=>'accountant']);
        Route::resource('deposit', deposit::class,['as'=>'accountant']);

    });
});

Route::group(['middleware'=>isSalesexecutive::class],function(){
    Route::prefix('salesexecutive')->group(function(){
        Route::get('/dashboard', [dash::class,'salesexecutiveDashboard'])->name('salesexecutive.dashboard');

        Route::get('/profile', [userprofile::class,'profile'])->name('salesexecutive.profile');
        Route::post('/profile', [userprofile::class,'store'])->name('salesexecutive.profile.store');
        Route::get('/change_password', [userprofile::class,'change_password'])->name('salesexecutive.change_password');
        Route::post('/change_password', [userprofile::class,'change_password_store'])->name('salesexecutive.change_password.store');

        Route::resource('inquiry', inquiry::class,['as'=>'salesexecutive']);
        Route::resource('contactus', contactus::class,['as'=>'salesexecutive']);

        Route::resource('vehicle',vehicle::class,['as'=>'salesexecutive']);

        /*Cm Module */
        Route::get('all-client-list',[clientmodule::class,'all_client_list'])->name('salesexecutive.all_client_list');
        Route::get('client-individual/{id}',[clientmodule::class,'client_individual'])->name('salesexecutive.client_individual');
        /*Sales Module */
        Route::get('all-client-list-json',[salesmodule::class,'all_client_list_json'])->name('salesexecutive.all_client_list_json');
        Route::get('favourite-list',[salesmodule::class,'favourite_list'])->name('salesexecutive.favourite_list');
        Route::get('search',[salesmodule::class,'search'])->name('salesexecutive.search');
        Route::get('sales-module',[salesmodule::class,'sales_module'])->name('salesexecutive.sales_module');

        /* == Free Client Assign by Salesexecutive ==*/
        Route::post('/client/assign/save', [userprofile::class, 'clAssign'])->name('salesexecutive.clAssign');

        /*Shipment Details */
        Route::resource('shipment',shipment::class,['as'=>'salesexecutive']);

        Route::resource('pGallery',pGallery::class,['as'=>'salesexecutive']);
        Route::get('pGallerydelete', [pGallery::class, 'delete'])->name('salesexecutive.image.delete'); 
        /* settings */
        Route::resource('consigdetl', consigdetl::class,['as'=>'salesexecutive']);
        Route::resource('admin',admin::class,['as'=>'salesexecutive']);
        Route::patch('cm_category/{id}',[admin::class,'cm_category'])->name('salesexecutive.cm_category');
        Route::patch('cm_type/{id}',[admin::class,'cm_type'])->name('salesexecutive.cm_type');
        Route::resource('userdetl', userdetl::class,['as'=>'salesexecutive']);
        Route::resource('reservevehicle', reservevehicle::class,['as'=>'salesexecutive']);
        Route::resource('invoice', invoice::class,['as'=>'salesexecutive']);
        Route::resource('payment', payment::class,['as'=>'salesexecutive']);
        Route::resource('/notes', note::class, ["as" => "salesexecutive"]);
        Route::resource('favourvehicle', favourvehicle::class,['as'=>'salesexecutive']);
        Route::get('/note/history', [note::class, 'note_by_vehicle_id'])->name('salesexecutive.noteHistoryByvehicleId');
    });
});

Route::group(['middleware'=>isSuperadmin::class],function(){
    Route::prefix('superadmin')->group(function(){
        Route::get('/dashboard', [dash::class,'superadminDashboard'])->name('superadmin.dashboard');

        Route::get('/profile', [userprofile::class,'profile'])->name('superadmin.profile');
        Route::post('/profile', [userprofile::class,'store'])->name('superadmin.profile.store');
        Route::get('/change_password', [userprofile::class,'change_password'])->name('superadmin.change_password');
        Route::post('/change_password', [userprofile::class,'change_password_store'])->name('superadmin.change_password.store');

        Route::resource('userdetl', userdetl::class,['as'=>'superadmin']);
        Route::resource('compaccinfo', compaccinfo::class,['as'=>'superadmin']);

     
        Route::resource('pGallery',pGallery::class,['as'=>'superadmin']);
        Route::get('pGallerydelete', [pGallery::class, 'delete'])->name('superadmin.image.delete'); 
        /* settings */
        Route::resource('admin',admin::class,['as'=>'superadmin']);
        Route::resource('bodytype',bodytype::class,['as'=>'superadmin']);
        Route::resource('subbodytype',subbodytype::class,['as'=>'superadmin']);
        Route::resource('drivetype',drivetype::class,['as'=>'superadmin']);
        Route::resource('invloc',invloc::class,['as'=>'superadmin']);
        Route::resource('brand',brand::class,['as'=>'superadmin']);
        Route::resource('subBrand',subBrand::class,['as'=>'superadmin']);
        Route::resource('color',color::class,['as'=>'superadmin']);
        Route::resource('door',door::class,['as'=>'superadmin']);
        Route::resource('seat',seat::class,['as'=>'superadmin']);
        Route::resource('condition',condition::class,['as'=>'superadmin']);
        Route::resource('fuel',fuel::class,['as'=>'superadmin']);
        Route::resource('transmission',transmission::class,['as'=>'superadmin']);
        Route::resource('vehicle_model',vehicle_model::class,['as'=>'superadmin']);
        Route::resource('country',Country::class,['as'=>'superadmin']);
        Route::resource('port',Port::class,['as'=>'superadmin']);
        /* Vehicle */
        Route::resource('vehicle',vehicle::class,['as'=>'superadmin']);
        Route::resource('buy',buy::class,['as'=>'superadmin']);
        Route::resource('inquiry', inquiry::class,['as'=>'superadmin']);
        Route::resource('contactus', contactus::class,['as'=>'superadmin']);
        Route::resource('notification', notification::class,['as'=>'superadmin']);
        Route::resource('reservevehicle', reservevehicle::class,['as'=>'superadmin']);
        Route::resource('invoice', invoice::class,['as'=>'superadmin']);
        Route::resource('payment', payment::class,['as'=>'superadmin']);
        Route::resource('/notes', note::class, ["as" => "superadmin"]);
        Route::get('/note/history', [note::class, 'note_by_vehicle_id'])->name('superadmin.noteHistoryByvehicleId');


        /*==Client Transfer==*/
        Route::get('/client/transfer/list', [userprofile::class, 'clientTransferList'])->name('superadmin.clientTransferList');
        Route::get('/client/transfer', [userprofile::class, 'clientTransfer'])->name('superadmin.clientTransfer');
        Route::get('/client/executive', [userprofile::class, 'clientExecutive'])->name('superadmin.clientExecutive');
        Route::post('/client/transfer/save', [userprofile::class, 'clTransfer'])->name('superadmin.clTransfer');

       
    });
});
Route::group(['middleware'=>isAdmin::class],function(){
    Route::prefix('admin')->group(function(){
        Route::get('/dashboard', [dash::class,'adminDashboard'])->name('admin.dashboard');
        /* settings */

        
    });
});
Route::post('gallery/delete',[vehicle::class, 'deleteImg'])->name('gallery.delete');
Route::get('gallery/cover/{id}',[vehicle::class, 'galleryCover'])->name('gallery.cover');
Route::get('subBrand',[subBrand::class, 'get_sub_brand_by_id'])->name('subBrandbyId');
Route::get('port',[port::class, 'get_port_by_id'])->name('portById');
Route::get('m3',[port::class, 'get_m3_charge_by_port_id'])->name('m3Charge');
Route::get('/watermark',[vehicle::class, 'addWatermarkall']);




