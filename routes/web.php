<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController as auth;
use App\Http\Controllers\DashboardController as dash;

use App\Http\Controllers\FrontController as front;

use App\Http\Controllers\Settings\DepartmentController as department;
use App\Http\Controllers\Settings\BodyTypeController as bodytype;
use App\Http\Controllers\Settings\SubBodyTypeController as subbodytype;
use App\Http\Controllers\Settings\DriveTypeController as drivetype;
use App\Http\Controllers\Settings\InventoryLocationController as invloc;
use App\Http\Controllers\Settings\AdminUserController as admin;
use App\Http\Controllers\Settings\UnitController as unit;
use App\Http\Controllers\Settings\UnitStyleController as unitstyle;
use App\Http\Controllers\Settings\SupplierController as supplier;
use App\Http\Controllers\Settings\BuyerController as buyer;

use App\Http\Controllers\Company\CompanyController as company;
use App\Http\Controllers\Company\WarehouseController as warehouse;
use App\Http\Controllers\Company\WarehouseBoardController as warehouseboard;

use App\Http\Controllers\Product\CategoryController as category;
use App\Http\Controllers\Product\ProductController as product;
use App\Http\Controllers\Product\ProductStyleController as productstyle;
use App\Http\Controllers\Product\ProductStyleDetailsController as productstyledetails;
use App\Http\Controllers\Product\IndentController as indent;
use App\Http\Controllers\Product\IndentDetailsController as indentdetails;

use App\Http\Controllers\Stock\ProductInStockController as stockin;
use App\Http\Controllers\Stock\ProductOutStockController as stockout;
use App\Http\Controllers\Stock\CompanyRequisitionController as companyrequisition;
use App\Http\Controllers\Stock\ProductTransferIndentController as stocktransferind;
use App\Http\Controllers\Stock\ProductStockController as stock;
use App\Http\Controllers\Stock\RequisitionController as requisition;


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
        Route::resource('unitstyle',unitstyle::class,['as'=>'superadmin']);
        Route::resource('unit',unit::class,['as'=>'superadmin']);
        Route::resource('supplier',supplier::class,['as'=>'superadmin']);
        Route::resource('buyer',buyer::class,['as'=>'superadmin']);
        /* Company */
        Route::resource('company',company::class,['as'=>'superadmin']);
        Route::resource('warehouse',warehouse::class,['as'=>'superadmin']);
        Route::resource('warehouseboard',warehouseboard::class,['as'=>'superadmin']);

        /* Product */
        Route::resource('category',category::class,['as'=>'superadmin']);
        Route::resource('product',product::class,['as'=>'superadmin']);
        Route::get('productstyle',[productstyle::class,'index'])->name('superadmin.productstyle.index');
        Route::resource('productstyledetails',productstyledetails::class,['as'=>'superadmin']);
        Route::get('/psd_ps', [productstyledetails::class,'product_sc'])->name('superadmin.prosearch');
        Route::get('/psd_ps_rs', [productstyledetails::class,'product_sc_d'])->name('superadmin.prosearchrs');
        Route::resource('indent',indent::class,['as'=>'superadmin']);
        Route::resource('indentdetails',indentdetails::class,['as'=>'superadmin']);
        Route::get('/ind_createscreen', [indentdetails::class,'createinput'])->name('superadmin.ind.createscreen');
        Route::get('/ind_up_excel', [indentdetails::class,'upexcel'])->name('superadmin.ind.up_excel');
        Route::get('/ind_store_style', [indentdetails::class,'storestyle'])->name('superadmin.ind.store.style');
        Route::post('/ind_product_sc_excel', [indentdetails::class,'product_sc_excel'])->name('superadmin.ind.product_sc.excel');
        Route::get('/ind_ps', [indentdetails::class,'product_sc'])->name('superadmin.ind.prosearch');
        Route::get('/ind_ps_rs', [indentdetails::class,'product_sc_d'])->name('superadmin.ind.prosearchrs');

        /* stock */
        Route::resource('stockin',stockin::class,['as'=>'superadmin']);
        Route::get('/stockin_checkinv', [stockin::class,'check_invoice'])->name('superadmin.stockincheckinv');
        Route::get('/stockin_ps', [stockin::class,'product_sc'])->name('superadmin.stockinprosearch');
        Route::get('/stockin_ps_rs', [stockin::class,'product_sc_d'])->name('superadmin.stockinprosearchrs');
        Route::get('/stockin_createexcel', [stockin::class,'createexcel'])->name('superadmin.stockin.createexcel');
        Route::post('/stockin_up_excel', [stockin::class,'upexcel'])->name('superadmin.stockin.up_excel');

        Route::resource('stockout',stockout::class,['as'=>'superadmin']);
        Route::get('/stockout_ps_rs', [stockout::class,'product_sc_d'])->name('superadmin.stockoutprosearchrs');

        Route::resource('c_to_c_transfer',companyrequisition::class,['as'=>'superadmin']);
        Route::get('/ctcreq_ps', [companyrequisition::class,'product_sc'])->name('superadmin.ctcrequisitionprosearch');
        Route::get('/ctcreq_ps_rs', [companyrequisition::class,'product_sc_d'])->name('superadmin.ctcrequisitionprosearchrs');
        
        Route::get('/ctcpending_requisition', [companyrequisition::class,'pending_requisition'])->name('superadmin.req.ctcpending_requisition');
        Route::get('/ctc_accept_product/{id}', [companyrequisition::class,'accept_product'])->name('superadmin.req.ctcaccept_product');


        Route::resource('stock',stock::class,['as'=>'superadmin']);
        
        Route::resource('stocktransferind',stocktransferind::class,['as'=>'superadmin']);
        Route::get('/pti_get_product', [stocktransferind::class,'get_product'])->name('superadmin.pti.get_product');


        Route::resource('requisition',requisition::class,['as'=>'superadmin']);
        Route::get('/req_style', [requisition::class,'get_product_style'])->name('superadmin.requisitionstyle');
        Route::get('/req_get_product', [requisition::class,'get_product'])->name('superadmin.requisitionproduct');
        Route::get('/req_ps', [requisition::class,'product_sc'])->name('superadmin.requisitionprosearch');
        Route::get('/req_ps_rs', [requisition::class,'product_sc_d'])->name('superadmin.requisitionprosearchrs');
        
        Route::get('/pending_requisition', [requisition::class,'pending_requisition'])->name('superadmin.req.pending_requisition');
        Route::get('/req_accept_product/{id}', [requisition::class,'accept_product'])->name('superadmin.req.accept_product');
        Route::get('/req_accept_product_check', [requisition::class,'accept_product_check'])->name('superadmin.req.accept_product_check');
        Route::post('/req_accept_product/{id}', [requisition::class,'accept_product_edit'])->name('superadmin.req.accept_product_edit');
        Route::get('/req_delete_product/{reqid}/{proid}', [requisition::class,'delete_product'])->name('superadmin.req.delete_product');
        
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
        /* Company */
        Route::resource('company',company::class,['as'=>'admin']);
        Route::resource('warehouse',warehouse::class,['as'=>'admin']);
        Route::resource('warehouseboard',warehouseboard::class,['as'=>'admin']);

        /* Product */
        Route::resource('category',category::class,['as'=>'admin']);
        Route::resource('product',product::class,['as'=>'admin']);
        Route::get('productstyle',[productstyle::class,'index'])->name('admin.productstyle.index');
        Route::resource('productstyledetails',productstyledetails::class,['as'=>'admin']);
        Route::get('/psd_ps', [productstyledetails::class,'product_sc'])->name('admin.prosearch');
        Route::get('/psd_ps_rs', [productstyledetails::class,'product_sc_d'])->name('admin.prosearchrs');
        Route::resource('indent',indent::class,['as'=>'admin']);
        Route::resource('indentdetails',indentdetails::class,['as'=>'admin']);
        Route::get('/ind_createscreen', [indentdetails::class,'createinput'])->name('admin.ind.createscreen');
        Route::get('/ind_up_excel', [indentdetails::class,'upexcel'])->name('admin.ind.up_excel');
        Route::get('/ind_store_style', [indentdetails::class,'storestyle'])->name('admin.ind.store.style');
        Route::post('/ind_product_sc_excel', [indentdetails::class,'product_sc_excel'])->name('admin.ind.product_sc.excel');
        Route::get('/ind_ps', [indentdetails::class,'product_sc'])->name('admin.ind.prosearch');
        Route::get('/ind_ps_rs', [indentdetails::class,'product_sc_d'])->name('admin.ind.prosearchrs');

        /* stock */
        Route::resource('stockin',stockin::class,['as'=>'admin']);
        Route::get('/stockin_checkinv', [stockin::class,'check_invoice'])->name('admin.stockincheckinv');
        Route::get('/stockin_ps', [stockin::class,'product_sc'])->name('admin.stockinprosearch');
        Route::get('/stockin_ps_rs', [stockin::class,'product_sc_d'])->name('admin.stockinprosearchrs');
        Route::get('/stockin_createexcel', [stockin::class,'createexcel'])->name('admin.stockin.createexcel');
        Route::post('/stockin_up_excel', [stockin::class,'upexcel'])->name('admin.stockin.up_excel');

        Route::resource('stockout',stockout::class,['as'=>'admin']);
        Route::get('/stockout_ps_rs', [stockout::class,'product_sc_d'])->name('admin.stockoutprosearchrs');

        Route::resource('c_to_c_transfer',companyrequisition::class,['as'=>'admin']);
        Route::get('/ctcreq_ps', [companyrequisition::class,'product_sc'])->name('admin.ctcrequisitionprosearch');
        Route::get('/ctcreq_ps_rs', [companyrequisition::class,'product_sc_d'])->name('admin.ctcrequisitionprosearchrs');

        Route::resource('stock',stock::class,['as'=>'admin']);
        
        Route::resource('stocktransferind',stocktransferind::class,['as'=>'admin']);
        Route::get('/pti_get_product', [stocktransferind::class,'get_product'])->name('admin.pti.get_product');


        Route::resource('requisition',requisition::class,['as'=>'admin']);
        Route::get('/req_style', [requisition::class,'get_product_style'])->name('admin.requisitionstyle');
        Route::get('/req_get_product', [requisition::class,'get_product'])->name('admin.requisitionproduct');
        Route::get('/req_ps', [requisition::class,'product_sc'])->name('admin.requisitionprosearch');
        Route::get('/req_ps_rs', [requisition::class,'product_sc_d'])->name('admin.requisitionprosearchrs');
        
        Route::get('/pending_requisition', [requisition::class,'pending_requisition'])->name('admin.req.pending_requisition');
        Route::get('/req_accept_product/{id}', [requisition::class,'accept_product'])->name('admin.req.accept_product');
        Route::get('/req_accept_product_check', [requisition::class,'accept_product_check'])->name('admin.req.accept_product_check');
        Route::post('/req_accept_product/{id}', [requisition::class,'accept_product_edit'])->name('admin.req.accept_product_edit');
        Route::get('/req_delete_product/{reqid}/{proid}', [requisition::class,'delete_product'])->name('admin.req.delete_product');
        
    });
});



