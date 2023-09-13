<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ConsigneeDetail;
use App\Models\ReservedVehicle;
use App\Models\Settings\Country;
use App\Models\Settings\Port;
use App\Models\UserDetail;

use App\Models\Payment;
use App\Models\Invoice;
use App\Models\Deposit;

use Exception;
use Toastr;
use DB;

class ClientModuleController extends Controller
{
    public function all_client_list(){
        if(currentUser() == 'salesexecutive'){
            $countries = Country::all();
            $users=User::where('executiveId',currentUserId())->orWhere('executiveId',0)->where('role_id',4)->paginate(50);
            return view('cm_module.cm_module',compact('users','countries'));
        }elseif(currentUser() == 'accountant'){
            $countries = Country::all();
            $users=User::where('role_id',4)->paginate(50);
            return view('cm_module.cm_module',compact('users','countries'));
        }else{
            $users=User::paginate(10);
            return view('settings.adminusers.index',compact('users'));
        }
    }
    public function client_individual($id){
        $client_data = User::where('id',encryptor('decrypt',$id))->first();
        $client_details = UserDetail::where('user_id',encryptor('decrypt',$id))->first();
        $sales_rank = ReservedVehicle::where('user_id',encryptor('decrypt',$id))->where('status','2')->count();
        $user_status = ReservedVehicle::where('user_id',encryptor('decrypt',$id))->count();
        $con_detl = ConsigneeDetail::where('user_id',encryptor('decrypt',$id))->get();

        $invoices = Invoice::where('client_id',encryptor('decrypt',$id))->get();
        $payments = Payment::where('client_id',encryptor('decrypt',$id))->get();
        $deposits = Deposit::where('client_id',encryptor('decrypt',$id))->get();

        /*====== Total ===========*/
        $payment_total = DB::table('payments')->where('client_id',encryptor('decrypt',$id))->sum('amount');
        $allocated_total = DB::table('reserved_vehicles')->where('user_id',encryptor('decrypt',$id))->sum('allocated');
        $deposit_total = DB::table('deposits')->where('client_id',encryptor('decrypt',$id))->selectRaw('SUM(COALESCE(deposit_amt,0) + COALESCE(deduction,0)) as total_sum')->value('total_sum');
        $invoice_total = DB::table('invoices')->where('client_id',encryptor('decrypt',$id))->where('invoice_type',4)->sum('inv_amount')-DB::table('payments')->where('client_id',encryptor('decrypt',$id))->sum('amount');
        
        //print_r($con_detl);die;
        $countries = Country::all();
        $ports = Port::all();
        /*=== Reserve Unit ==*/
        $reserve_vehicle = DB::table('reserved_vehicles')
        ->join('vehicles', 'vehicles.id', '=', 'reserved_vehicles.vehicle_id')
        ->join('brands', 'brands.id', '=', 'vehicles.brand_id')
        ->join('sub_brands', 'sub_brands.id', '=', 'vehicles.sub_brand_id')
        ->join('transmissions', 'vehicles.transmission_id', 'transmissions.id')
        ->select('reserved_vehicles.allocated','reserved_vehicles.status as reserve_status', 'reserved_vehicles.total','reserved_vehicles.id as reserveId','reserved_vehicles.fob_amt','reserved_vehicles.shipment_type','reserved_vehicles.freight_amt','reserved_vehicles.insu_amt','reserved_vehicles.insp_amt','reserved_vehicles.aditional_cost', 'reserved_vehicles.discount as dis','reserved_vehicles.m3_value','reserved_vehicles.m3_charge','vehicles.*', 'brands.slug_name as b_slug', 'sub_brands.slug_name as sb_slug', 'transmissions.name as tname')
        ->where('reserved_vehicles.user_id',encryptor('decrypt',$id))->orderBy('reserved_vehicles.id', 'DESC')
        ->paginate(25);
        /* Proforma Invoice For Confirm Order */
        $resrv = DB::table('reserved_vehicles')
        ->join('vehicles', 'vehicles.id', '=', 'reserved_vehicles.vehicle_id')
        ->join('brands', 'brands.id', '=', 'vehicles.brand_id')
        ->join('sub_brands', 'sub_brands.id', '=', 'vehicles.sub_brand_id')
        ->join('transmissions', 'vehicles.transmission_id', 'transmissions.id')
        ->select('reserved_vehicles.allocated','reserved_vehicles.status as reserve_status', 'reserved_vehicles.total','reserved_vehicles.id as reserveId','reserved_vehicles.fob_amt','reserved_vehicles.shipment_type','reserved_vehicles.freight_amt','reserved_vehicles.insu_amt','reserved_vehicles.insp_amt','reserved_vehicles.aditional_cost', 'reserved_vehicles.discount as dis','reserved_vehicles.m3_value','reserved_vehicles.m3_charge','vehicles.*', 'brands.slug_name as b_slug', 'sub_brands.slug_name as sb_slug', 'transmissions.name as tname')
        ->where('reserved_vehicles.user_id',encryptor('decrypt',$id))->where('reserved_vehicles.status',2)->orderBy('reserved_vehicles.id', 'DESC')
        ->paginate(25);
        /*echo '<pre>';
        print_r($resrv->toArray());die;*/
        return view('cm_module.cm_module_individual',compact('client_data','sales_rank','countries','ports','client_details','reserve_vehicle','resrv','con_detl','invoices','payments','deposits'));
    }
}
