<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use DB;

class SalesModuleController extends Controller
{
    public function favourite_list()
    {
        $favourites = DB::table('favourite_vehicles')
            ->join('vehicles', 'vehicles.id', '=', 'favourite_vehicles.vehicle_id')
            ->join('brands', 'brands.id', '=', 'vehicles.brand_id')
            ->join('sub_brands', 'sub_brands.id', '=', 'vehicles.sub_brand_id')
            ->join('transmissions', 'vehicles.transmission_id', 'transmissions.id')
            ->select('favourite_vehicles.*', 'vehicles.*', 'brands.slug_name as b_slug', 'sub_brands.slug_name as sb_slug', 'transmissions.name as tname')
            ->where('favourite_vehicles.user_id', currentUserId())->get();
        /*echo '<pre>';
print_r($favourites->toArray());die;*/
        return view('sales_module.favourite_list', compact('favourites'));
    }
    public function search()
    {
        return view('sales_module.search_vehicle');
    }
    public function sales_module()
    {
        $reserve_vehicle = DB::table('reserved_vehicles')
        ->join('vehicles', 'vehicles.id', '=', 'reserved_vehicles.vehicle_id')
        ->join('brands', 'brands.id', '=', 'vehicles.brand_id')
        ->join('sub_brands', 'sub_brands.id', '=', 'vehicles.sub_brand_id')
        ->join('transmissions', 'vehicles.transmission_id', 'transmissions.id')
        ->select('reserved_vehicles.*', 'vehicles.*', 'brands.slug_name as b_slug', 'sub_brands.slug_name as sb_slug', 'transmissions.name as tname')
        ->where('reserved_vehicles.assign_user_id',currentUserId())->orderBy('reserved_vehicles.id', 'DESC')
        ->where('reserved_vehicles.assign_user_id',currentUserId())
        ->where('reserved_vehicles.created_by',currentUserId())
        ->paginate(25);
        return view('sales_module.sales_list',compact('reserve_vehicle'));
    }
    public function all_client_list_json()
    {
        $users = User::where('created_by', currentUserId())->get();
       
      
        $data = '<div class="row">';
 
        $data .= '<div class="col-md-4 col-12">';
        $data .= '<div class="form-group">';
        $data .= '<label for="user_id">Select Client</label>';
        $data .= '<select name="user_id" class="form-control js-example-basic-single" required>';
        $data .= '<option value="">Select</option>';

        foreach ($users as $user) {
            $data .= '<option value="' . $user->id . '">' . $user->name . '</option>';
        }

        $data .= '</select>';
        $data .= '</div>';
        $data .= '</div>';

        $data .= '<div class="col-md-4 col-12">';
        $data .= '<div class="form-group">';
        $data .= '<label for="shipment_type">Shipment Type</label>';
        $data .= '<select name="shipment_type" class="form-control" required>';
        $data .= '<option value="">Select</option>';

       
            $data .= '<option value="1">RORO</option>';
            $data .= '<option value="2">Container</option>';
      

        $data .= '</select>';
        $data .= '</div>';
        $data .= '</div>';

        $data .= '</div>';
      
      
        return response()->json(['data' => $data]);
    }
}
