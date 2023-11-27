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
    public function all_client_list(Request $request){
        $countries = Country::all();
        $order_by = $request->order_by?$request->order_by:'desc';
        $perPage = $request->perPage?$request->perPage:50;
        if(currentUser() == 'salesexecutive'){
            $users = User::with(['country','clientTransfers' => function ($query) {
                $query->latest('id')->limit(1);
            }]);
            if ($request->userId) {
                $users = $users->where('id',$request->userId);
            }
            elseif($request->country_id){
                $users = $users->where('country_id',$request->country_id);
            }elseif($request->executiveId){
                /* Null=> For Free Not Null Assigned (In Database)*/
                if($request->executiveId == 1)
                $users = $users->whereNull('executiveId');
                else
                $users = $users->where('executiveId',currentUserId());
            }elseif($request->type){
                /* 1 => Active (Running deals on going) 2=> Semi Active (Purchased previously but at present no deals is running), 3 => Inactive (No purchase history or no deals is running)*/
                $users = $users->where('type',$request->type);
            }elseif($request->created_at){
                $created_at = explode('-',$request->created_at);
                $from = \Carbon\Carbon::createFromTimestamp(strtotime($created_at[0]))->format('Y-m-d');
                $to = \Carbon\Carbon::createFromTimestamp(strtotime($created_at[1]))->format('Y-m-d');
                $users = $users->whereBetween('created_at',[$from,$to]);
            }elseif($request->star){
                $users = $users->where('cmType',$request->star);
            }
            
            $users = $users
            ->where(function ($query) use ($request){
                $query->where('executiveId', '=', currentUserId())
                ->orWhereNull('executiveId');
            })
            ->where('role_id',4)->orderBy('id',$order_by)->paginate($perPage);
            $users = $users->appends(
                [
                    'userId' => $request->userId,
                    'country_id' => $request->country_id,
                    'order_by' => $request->order_by,
                    'executiveId' => $request->executiveId,
                    'type' => $request->type,
                ]
            );
            //$users=User::where('executiveId',currentUserId())->orWhere('executiveId',0)->where('role_id',4)->paginate(50);
            /*echo '<pre>';
            print_r($users->toArray());die*/;
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
        print_r($reserve_vehicle->toArray());die;*/
        return view('cm_module.cm_module_individual',compact('client_data','sales_rank','countries','ports','client_details','reserve_vehicle','resrv','con_detl','invoices','payments','deposits'));
    }
}
