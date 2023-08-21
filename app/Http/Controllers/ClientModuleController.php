<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ReservedVehicle;
use App\Models\Settings\Country;
use App\Models\Settings\Port;
use App\Models\UserDetail;
use Exception;
use Toastr;
use DB;

class ClientModuleController extends Controller
{
    public function all_client_list(){
        if(currentUser() == 'salesexecutive'){
            $countries = Country::all();
            $users=User::where('created_by',currentUserId())->paginate(50);
            return view('cm_module.cm_module',compact('users','countries'));
        }else{
            $users=User::paginate(10);
            return view('settings.adminusers.index',compact('users'));
        }
    }
    public function client_individual($id){
        $client_data = User::where('id',encryptor('decrypt',$id))->first();
        $client_details = UserDetail::where('user_id',encryptor('decrypt',$id))->first();
        $sales_rank = ReservedVehicle::where('id',encryptor('decrypt',$id))->count();
        $countries = Country::all();
        $ports = Port::all();
        /*=== Reserve Unit ==*/
        $reserve_vehicle = DB::table('reserved_vehicles')
        ->join('vehicles', 'vehicles.id', '=', 'reserved_vehicles.vehicle_id')
        ->join('brands', 'brands.id', '=', 'vehicles.brand_id')
        ->join('sub_brands', 'sub_brands.id', '=', 'vehicles.sub_brand_id')
        ->join('transmissions', 'vehicles.transmission_id', 'transmissions.id')
        ->select('reserved_vehicles.status as reserve_status', 'reserved_vehicles.id as reserveId', 'vehicles.*', 'brands.slug_name as b_slug', 'sub_brands.slug_name as sb_slug', 'transmissions.name as tname')
        ->where('reserved_vehicles.user_id',encryptor('decrypt',$id))->orderBy('reserved_vehicles.id', 'DESC')
        ->paginate(25);
        /* Proforma Invoice For Confirm Order */
        $resrv = ReservedVehicle::where('user_id', encryptor('decrypt',$id))->where('status',2)->orderBy('id', 'DESC')->paginate(25);
        return view('cm_module.cm_module_individual',compact('client_data','sales_rank','countries','ports','client_details','reserve_vehicle','resrv'));
    }
}
