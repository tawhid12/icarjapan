<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Settings\BodyType;
use App\Models\Settings\DriveType;
use App\Models\Settings\InventoryLocation;
use App\Models\Settings\SubBodyType;

use App\Models\Vehicle\Vehicle;
use App\Models\Vehicle\Brand;
use App\Models\Vehicle\Fuel;
use App\Models\Vehicle\Color;
use App\Models\Vehicle\Transmission;
use App\Models\Vehicle\VehicleModel;

use DB;

class FrontController extends Controller
{
    public function index(){
        $body_types = BodyType::all();
        $drive_types = DriveType::all();
        $inv_loc = InventoryLocation::all();
        $sub_body_types = SubBodyType::all();

        $brands = Brand::all();
        $fuel= Fuel::all();
        $colors = Color::all();
        $trans = Transmission::all();
        $vehicle_models = VehicleModel::all();
        $trans = Transmission::all();
        $vehicles=Vehicle::latest()->take(10)->get();

        /*====Price====Max===Min*/
        $price_range = DB::table('vehicles')->select(\DB::raw('MIN(price) AS minprice, MAX(price) AS maxprice'))->get()->toArray();
        /*====Discount====Max===Min*/
        $discount_range = DB::table('vehicles')->select(\DB::raw('MIN(discount) AS mindis, MAX(discount) AS maxdis'))->get()->toArray();
        /*====year====Max===Min*/
        $year_range = DB::table('vehicles')->select(\DB::raw('MIN(year) AS minyear, MAX(year) AS maxyear'))->get()->toArray();

        
        return view('front.landing',compact('year_range','discount_range','price_range','vehicles','body_types','drive_types','inv_loc','sub_body_types','brands','fuel','colors','trans','vehicle_models'));
    }
}
