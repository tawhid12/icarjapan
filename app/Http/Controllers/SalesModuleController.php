<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Settings\Country;
use App\Models\Vehicle\Brand;
use App\Models\Vehicle\VehicleModel;
use App\Models\Settings\BodyType;
use App\Models\Settings\SubBodyType;
use App\Models\Settings\DriveType;
use App\Models\Vehicle\Transmission;
use App\Models\Vehicle\Fuel;
use App\Models\Vehicle\Color;
use App\Models\Settings\InventoryLocation;
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
    public function reserve_list()
    {
        $countries = Country::all();
        $brands = Brand::all();
        $vehicle_models = VehicleModel::all();
        $body_types = BodyType::get();
        $sub_body_types = SubBodyType::all();
        $drive_types = DriveType::all();
        $trans = Transmission::get();
        $fuel = Fuel::all();
        $colors = Color::all();
        $year_range = DB::table('vehicles')->select(\DB::raw('MIN(manu_year) AS minyear, MAX(manu_year) AS maxyear'))->get()->toArray();
        $max_manu_Year = DB::table('vehicles')->max(DB::raw('YEAR(manu_year)'));
        $min_manu_Year = DB::table('vehicles')->min(DB::raw('YEAR(manu_year)'));
        $inv_loc = InventoryLocation::all();
        $vehicles = DB::table('reserved_vehicles')
            ->join('vehicles', 'vehicles.id', '=', 'reserved_vehicles.vehicle_id')
            ->join('brands', 'brands.id', '=', 'vehicles.brand_id')
            ->join('sub_brands', 'sub_brands.id', '=', 'vehicles.sub_brand_id')
            ->join('transmissions', 'vehicles.transmission_id', 'transmissions.id')
            ->select('reserved_vehicles.*', 'vehicles.*', 'brands.slug_name as b_slug', 'sub_brands.slug_name as sb_slug', 'transmissions.name as tname')
            ->where('reserved_vehicles.assign_user_id', currentUserId())
            ->whereNotNull('vehicles.r_status')
            ->paginate(50);
        /*echo '<pre>';
print_r($favourites->toArray());die;*/
        return view('sales_module.search_vehicle', compact('vehicles', 'countries','brands', 'vehicle_models', 'body_types', 'sub_body_types', 'drive_types', 'year_range', 'trans', 'fuel', 'colors', 'max_manu_Year', 'min_manu_Year', 'inv_loc'));
    }
    public function search()
    {
        $brands = Brand::all();
        $vehicle_models = VehicleModel::all();
        $body_types = BodyType::get();
        $sub_body_types = SubBodyType::all();
        $drive_types = DriveType::all();
        $trans = Transmission::get();
        $fuel = Fuel::all();
        $colors = Color::all();
        $year_range = DB::table('vehicles')->select(\DB::raw('MIN(manu_year) AS minyear, MAX(manu_year) AS maxyear'))->get()->toArray();
        $max_manu_Year = DB::table('vehicles')->max(DB::raw('YEAR(manu_year)'));
        $min_manu_Year = DB::table('vehicles')->min(DB::raw('YEAR(manu_year)'));
        $inv_loc = InventoryLocation::all();
        return view('sales_module.search_vehicle', compact('brands', 'vehicle_models', 'body_types', 'sub_body_types', 'drive_types', 'year_range', 'trans', 'fuel', 'colors', 'max_manu_Year', 'min_manu_Year', 'inv_loc'));
    }
    public function sales_module()
    {
        $reserve_vehicle = DB::table('reserved_vehicles')
            ->join('vehicles', 'vehicles.id', '=', 'reserved_vehicles.vehicle_id')
            ->join('brands', 'brands.id', '=', 'vehicles.brand_id')
            ->join('sub_brands', 'sub_brands.id', '=', 'vehicles.sub_brand_id')
            ->join('transmissions', 'vehicles.transmission_id', 'transmissions.id')
            ->select('reserved_vehicles.*', 'vehicles.*', 'brands.slug_name as b_slug', 'sub_brands.slug_name as sb_slug', 'transmissions.name as tname')
            ->where('reserved_vehicles.assign_user_id', currentUserId())->orderBy('reserved_vehicles.id', 'DESC')
            ->where('reserved_vehicles.assign_user_id', currentUserId())
            ->where('reserved_vehicles.created_by', currentUserId())
            ->paginate(25);
        return view('sales_module.sales_list', compact('reserve_vehicle'));
    }
    public function all_client_list_json()
    {
        $users = User::where('executiveId', currentUserId())->get();


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
