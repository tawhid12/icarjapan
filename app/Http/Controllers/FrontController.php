<?php

namespace App\Http\Controllers;

use App\Models\MostView;
use Illuminate\Http\Request;
use App\Models\Settings\BodyType;
use App\Models\Settings\DriveType;
use App\Models\Settings\InventoryLocation;
use App\Models\Settings\SubBodyType;
use App\Models\Settings\Country;

use App\Models\Vehicle\Vehicle;
use App\Models\Vehicle\Brand;
use App\Models\Vehicle\SubBrand;
use App\Models\Vehicle\Fuel;
use App\Models\Vehicle\Color;
use App\Models\Vehicle\Transmission;
use App\Models\Vehicle\VehicleModel;

use DB;
use Carbon\Carbon;

use function PHPUnit\Framework\isEmpty;
use Intervention\Image\Facades\Image;
use App\Services\GeoLocationService;
class FrontController extends Controller
{
    protected $geoLocationService;
    public function __construct(GeoLocationService $geoLocationService)
    {
        $this->geoLocationService = $geoLocationService;
    }
    public function index(Request $request)
    {
        $japan_locale_data = Carbon::now('Asia/Tokyo');

        $location = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$_SERVER['REMOTE_ADDR']));
        //$location = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip=122.152.55.168')); //210.138.184.59//122.152.55.168
        /*Use try catch or if else if location data found then data show either default data show or internet not found problem solving issue */
        /*
        $data = @file_get_contents($location);
            if (!$data) {
            // Handle error when there is no internet connection
            } else {
            // Process the data when the request is successful
            }

            or 
            if (get_headers('http://www.geoplugin.net/php.gp?ip='.$_SERVER['REMOTE_ADDR'])) {
    $geoLocationData = file_get_contents('http://www.geoplugin.net/php.gp?ip='.$_SERVER['REMOTE_ADDR']);
    // Process the $geoLocationData as needed
} else {
    // Handle the case when internet connectivity is not available
}

        */
        $current_locale_data = Carbon::now($location['geoplugin_timezone']);

        $countryName = Country::where('code', $location['geoplugin_countryCode'])->first();
        //echo '<pre>';
        //print_r($countryName);die;

        /*==New Arival== | New Affordable==*/
        $new_arivals = DB::table('vehicles')
            ->select('vehicles.id as vid', 'vehicles.name', 'vehicles.price', 'vehicles.discount', 'vehicles.manu_year', 'vehicles.chassis_no', 'vehicles.stock_id', 'brands.slug_name as b_slug', 'sub_brands.slug_name as sb_slug')
            ->join('new_arivals', 'vehicles.id', 'new_arivals.vehicle_id')
            ->join('brands', 'vehicles.brand_id', 'brands.id')
            ->join('sub_brands', 'vehicles.sub_brand_id', 'sub_brands.id')
            ->whereNull('r_status')
            ->where('new_arivals.country_id', $countryName->id)
            ->orWhereNull('new_arivals.country_id')->orderBy('vehicles.id','desc')->get();
            //->inRandomOrder()->take(10);
        //print_r($new_arivals);die;
        $country_price_range = DB::table('countries')->select('afford_range', 'high_grade_range')->where('id', $countryName->id)->first();


        /*==Afford Vehicle==*/
        $afford_by_country = DB::table('vehicles')
            ->select('vehicles.id as vid', 'vehicles.name', 'vehicles.price', 'vehicles.discount', 'vehicles.manu_year', 'vehicles.chassis_no', 'vehicles.stock_id', 'brands.slug_name as b_slug', 'sub_brands.slug_name as sb_slug')
            ->join('countries_vehicles', 'vehicles.id', 'countries_vehicles.vehicle_id')
            ->join('brands', 'vehicles.brand_id', 'brands.id')
            ->join('sub_brands', 'vehicles.sub_brand_id', 'sub_brands.id')
            ->whereNull('r_status')
            ->where('countries_vehicles.country_id', $countryName->id)
            ->where('price', '<=', $country_price_range->afford_range)->orderBy('vehicles.id','desc')->get();
            //->inRandomOrder()->take(10)

        /*==High Grade Vehicle==*/
        $high_grade_by_country = DB::table('vehicles')
            ->select('vehicles.id as vid', 'vehicles.name', 'vehicles.price', 'vehicles.discount', 'vehicles.manu_year', 'vehicles.chassis_no', 'vehicles.stock_id', 'brands.slug_name as b_slug', 'sub_brands.slug_name as sb_slug')
            ->join('countries_vehicles', 'vehicles.id', 'countries_vehicles.vehicle_id')
            ->join('brands', 'vehicles.brand_id', 'brands.id')
            ->join('sub_brands', 'vehicles.sub_brand_id', 'sub_brands.id')
            ->whereNull('r_status')
            ->where('countries_vehicles.country_id', $countryName->id)
            ->where('price', '>=', $country_price_range->high_grade_range)->orderBy('vehicles.id','desc')->get();
            //->inRandomOrder()->take(10)

        $vehicles = Vehicle::latest()->take(10)->get();
        /*=Most Viewed Vehicle in Bangladesh==*/
        $most_views = DB::table('vehicles')
            ->select('vehicles.id as vid', 'vehicles.name', 'vehicles.price', 'vehicles.discount', 'vehicles.manu_year', 'vehicles.chassis_no', 'vehicles.stock_id', 'brands.slug_name as b_slug', 'sub_brands.slug_name as sb_slug')
            ->join('most_views', 'vehicles.id', 'most_views.vehicle_id')
            ->join('brands', 'vehicles.brand_id', 'brands.id')
            ->join('sub_brands', 'vehicles.sub_brand_id', 'sub_brands.id')
            ->whereNull('vehicles.r_status')
            ->where('most_views.country_id', $countryName->id)->orderBy('vehicles.id','desc')->get();
            //->inRandomOrder()->take(10)
        //print_r($most_views);die;

        $countries = DB::table('countries')
            ->join('countries_vehicles', 'countries.id', 'countries_vehicles.country_id')
            ->select('countries.name')->distinct()->get();
        //return response()->json(array('data' =>'ok'));

        

        return view('front.welcome', compact('most_views', 'countryName', 'current_locale_data', 'japan_locale_data', 'location', 'afford_by_country', 'high_grade_by_country', 'new_arivals', 'vehicles', 'countries'));
    }
    public function brand(Brand $brand)
    {
        $sub_prefix = DB::table('sub_brands')
            ->select(DB::raw('substring(`name`,1,1) as cat'), DB::raw('GROUP_CONCAT(`id`) ids'))
            ->where('brand_id', $brand->id)
            ->groupBy('cat')
            ->get();
        /*echo '<pre>';
        print_r($sub_prefix->toArray());die;*/

        return view('front.brand', compact('brand', 'sub_prefix'));
    }
    /*@if($vehicle->images)
    <img src="{{asset('uploads/vehicle_images/'.$vehicle->images->first()->image)}}" class="card-img-top" alt="{{$vehicle->name}}">
  @endif*/
    public function subBrand(Brand $brand, SubBrand $subBrand)
    {
        $brand = Brand::where('name', $brand->name)->firstOrFail();
       
        $sub_brand_id = SubBrand::where('slug_name', $subBrand->slug_name)->firstOrFail();

        $vehicles = DB::table('vehicles')
        ->join('brands', 'vehicles.brand_id', 'brands.id')
        ->join('sub_brands', 'vehicles.sub_brand_id', 'sub_brands.id')
        ->where('vehicles.brand_id', $brand->id)->where('vehicles.sub_brand_id', $sub_brand_id->id)
        ->whereNull('r_status')->inRandomOrder()->get();

        echo '<pre>';
        print_r($vehicles);die;
        return view('front.search', compact('vehicles', 'brand', 'sub_brand_id'));
    }
    public function singleVehicle(Brand $brand, SubBrand $subBrand, $stock_id)
    {
        $countryName = $this->geoLocationService->getCountry();
        $brand = Brand::where('slug_name', $brand->slug_name)->firstOrFail();
        $sub_brand_id = SubBrand::where('slug_name', $subBrand->slug_name)->firstOrFail();
        $v = Vehicle::where('stock_id', $stock_id)->first();
        $v_images = DB::table('vehicle_images')->where('vehicle_id', $v->id)->get();
        $cover_img = DB::table('vehicle_images')->where('vehicle_id',$v->id)->where('is_cover_img',1)->first();
        $countries = Country::all();
        $recomended = DB::table('vehicles')
        ->select('vehicles.id as vid', 'vehicles.name', 'vehicles.price', 'vehicles.discount', 'vehicles.manu_year', 'vehicles.chassis_no', 'vehicles.stock_id', 'brands.slug_name as b_slug', 'sub_brands.slug_name as sb_slug')
        ->join('countries_vehicles', 'vehicles.id', 'countries_vehicles.vehicle_id')
        ->join('brands', 'vehicles.brand_id', 'brands.id')
        ->join('sub_brands', 'vehicles.sub_brand_id', 'sub_brands.id')
        ->whereNull('r_status')
        ->orWhere('countries_vehicles.country_id', $countryName->id)
        ->where('brands.id', $v->brand_id)
        ->where('sub_brands.id', $v->sub_brand_id)
        ->whereNotIn('vehicles.id', [$v->id])
        ->inRandomOrder()->take(10)->get();

        $url= url('used-cars-search/'.$brand->slug_name.'/'.$subBrand->slug_name.'/'.$stock_id);
        $shareComponent = \Share::page($url, 'Share title')
        ->facebook()
        ->twitter()
        ->whatsapp();
        return view('front.single', compact('countries', 'v_images', 'v', 'brand', 'sub_brand_id','shareComponent','url','cover_img','recomended'));
    }
    public function searchStData(Request $request)
    {
        $search_data = DB::table('vehicles')
            //->join('brands', 'brands.id', '=', 'vehicles.brand_id')
            //->join('sub_brands', 'sub_brands.id', '=', 'vehicles.sub_brand_id')
            //->select('vehicles.name as v_name', 'vehicles.fullName as v_full_bame', 'vehicles.stock_id', 'brands.name as b_name', 'sub_brands.name as sb_name')
            ->select('search_keyword')
            ->where('vehicles.r_status', 0)
            ->whereRaw("FIND_IN_SET('$request->sdata', search_keyword)")
            /*->orWhere('vehicles.name', 'like', '%' . $request->sdata . '%')
            ->orWhere('vehicles.fullName', $request->sdata)
            ->orWhere('vehicles.stock_id', $request->sdata)
            ->orWhere('brands.name', $request->sdata)
            ->orWhere('sub_brands.name', $request->sdata)*/
            ->get();
        $search_keyword = array();
        foreach ($search_data as $sd) {
            foreach (explode(',', $sd->search_keyword) as $e) {
                $search_keyword[] = $e;
            }
        }
        $unique_keyword = array_values(array_unique($search_keyword));  // remove any duplicate values and index array from 0
        return response()->json($unique_keyword);
    }
    public function search_by_data(Request $request)
    {
        $countries = Country::all();
        if(empty($request->filled('brand')) || empty($request->filled('sub_brand')) ){
            $vehicles = DB::table('vehicles')
            ->join('brands', 'vehicles.brand_id', 'brands.id')
            ->join('sub_brands', 'vehicles.sub_brand_id', 'sub_brands.id')
            ->whereNull('r_status')->inRandomOrder()->paginate(10);
            /*echo '<pre>';
            print_r($vehicles);die;*/
            return view('front.search',compact('vehicles','countries'));
        }
        elseif ($request->filled('brand') && !$request->filled('sub_brand')) {
            
            $brand = Brand::where('id', $request->brand)->firstOrFail();
            $sub_prefix = DB::table('sub_brands')
                ->select(DB::raw('substring(`name`,1,1) as cat'), DB::raw('GROUP_CONCAT(`id`) ids'))
                ->where('brand_id', $brand->id)
                ->groupBy('cat')
                ->get();
            return view('front.brand', compact('brand', 'sub_prefix','countries'));
        }
        elseif($request->filled('brand') && $request->filled('sub_brand')){
           
        }
       
       
        /*print_r($request->toArray());
        die;*/
    }
    


    public function resizeImage($filename, $width, $height)
    {
        $img = Image::make(public_path('uploads/vehicle_images/'.$filename));
        $img->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        });
        return $img->response();
    }
    
}