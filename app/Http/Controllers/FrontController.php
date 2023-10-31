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
    public function countrySelectpost(Request $request)
    {

        $countryName = Country::where('code', $request->code)->first();
        if ($countryName->ip_address) {
            $location = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip=' . $countryName->ip_address));


            /*if (session()->has('countryName')) {
            unset($_SESSION['countryName']);
        }
        if (session()->has('location')) {
            unset($_SESSION['location']);
        }*/
            session()->put('countryName', $countryName);
            session()->put('location', $location);
            /*echo '<pre>';
        print_r(session()->get('countryName'));
        print_r(session()->get('location'));
        die;*/
            return redirect()->route('front');
        }
    }
    public function countrySelect()
    {
        /*if ($_SERVER['REMOTE_ADDR']) {
            $location = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip=' . $_SERVER['REMOTE_ADDR']));
            if ($location && isset($location['geoplugin_timezone'])) {
                $current_locale_data = Carbon::now($location['geoplugin_timezone']);
                $countryName = Country::where('code', $location['geoplugin_countryCode'])->first();
                session()->put('countryName', $countryName);
                session()->put('location', $location);
                return redirect()->route('front');
            } else{
                $countries = Country::all();
                return view('front.country-select', compact('countries'));
            }
        } else {*/
        $countries = Country::all();
        return view('front.country-select', compact('countries'));
        //}
    }
    public function index(Request $request)
    {
        /*if (session()->has('countryName')) {
            unset($_SESSION['countryName']);*/
        //session()->forget('countryName');
        //}

        /*if (session()->has('location')) {
            unset($_SESSION['location']);*/
        //session()->forget('location');
        //}
        $japan_locale_data = Carbon::now('Asia/Tokyo');
        //if (!session()->has('countryName') && !session()->has('location')) {
        //$location = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip=' . $_SERVER['REMOTE_ADDR']));
        //$location = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip=122.152.55.168')); //210.138.184.59//122.152.55.168
        /*if ($location && isset($location['geoplugin_timezone'])) {
                $current_locale_data = Carbon::now($location['geoplugin_timezone']);
                $countryName = Country::where('code', $location['geoplugin_countryCode'])->first();
            } else {*/
        /*if (!$request->filled('code')) {
                    $countries = Country::all();
                    return view('front.country-select', compact('countries'));
                } else*/
        /*if ($request->filled('code')) {
                    $countryName = Country::where('code', $request->code)->first();
                    echo $countryName->ip_address;
                    if ($countryName->ip_address) {
                        $location = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip=' . $countryName->ip_address));
                        $current_locale_data = Carbon::now($location['geoplugin_timezone']);
                    } else {
                        $location = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip=210.138.184.59'));*/
        /*echo '<pre>';
                    print_r($location);die;*/
        /*$current_locale_data = Carbon::now($location['geoplugin_timezone']);
                        $countryName = Country::where('code', $location['geoplugin_countryCode'])->first();
                    }
                } else {*/
        //$location = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip=210.138.184.59'));
        /*echo '<pre>';
                print_r($location);die;*/
        //$current_locale_data = Carbon::now($location['geoplugin_timezone']);
        //$countryName = Country::where('code', $location['geoplugin_countryCode'])->first();
        //}
        /*}
            session()->put('countryName', $countryName);
            session()->put('location', $location);
        }else{
            $location =  request()->session()->get('location');
            $countryName =  request()->session()->get('countryName');*/
        /*if(empty($location) && empty($countryName)){
                return redirect()->route('front.countrySelect');
            }*/
        //}
        $location =  request()->session()->get('location');
        $countryName =  request()->session()->get('countryName');
        //$location['geoplugin_status'] == 404 || 
        if ( empty($location) || empty($countryName)) {
            unset($_SESSION['countryName']);
            unset($_SESSION['location']);
            return redirect()->route('front.countrySelect');
        }

        /*echo '<pre>';
print_r(session()->all());
die;*/

        $current_locale_data = Carbon::now($location['geoplugin_timezone']);
        /*==New Arival== | New Affordable==*/
        $new_arivals = DB::table('vehicles')
            ->select('vehicles.id as vid', 'vehicles.r_status', 'vehicles.name', 'vehicles.price', 'vehicles.discount', 'vehicles.manu_year', 'vehicles.chassis_no', 'vehicles.stock_id', 'brands.slug_name as b_slug', 'sub_brands.slug_name as sb_slug')
            ->join('new_arivals', 'vehicles.id', 'new_arivals.vehicle_id')
            ->join('brands', 'vehicles.brand_id', 'brands.id')
            ->join('sub_brands', 'vehicles.sub_brand_id', 'sub_brands.id')
            //->whereNull('r_status')
            ->where('new_arivals.country_id', $countryName->id)
            ->orWhereNull('new_arivals.country_id')->orderBy('vehicles.id', 'desc')->take(10)->get();
        //->inRandomOrder()->take(10);
        //print_r($new_arivals);die;
        $country_price_range = DB::table('countries')->select('afford_range', 'high_grade_range')->where('id', $countryName->id)->first();


        /*==Afford Vehicle==*/
        $afford_by_country = DB::table('vehicles')
            ->select('vehicles.id as vid', 'vehicles.r_status', 'vehicles.name', 'vehicles.price', 'vehicles.discount', 'vehicles.manu_year', 'vehicles.chassis_no', 'vehicles.stock_id', 'brands.slug_name as b_slug', 'sub_brands.slug_name as sb_slug')
            ->join('countries_vehicles', 'vehicles.id', 'countries_vehicles.vehicle_id')
            ->join('brands', 'vehicles.brand_id', 'brands.id')
            ->join('sub_brands', 'vehicles.sub_brand_id', 'sub_brands.id')
            //->whereNull('r_status')
            ->where('countries_vehicles.country_id', $countryName->id)
            ->where('price', '<=', $country_price_range->afford_range)->orderBy('vehicles.id', 'desc')->take(10)->get();
        //->inRandomOrder()->take(10)

        /*==High Grade Vehicle==*/
        $high_grade_by_country = DB::table('vehicles')
            ->select('vehicles.id as vid', 'vehicles.r_status', 'vehicles.name', 'vehicles.price', 'vehicles.discount', 'vehicles.manu_year', 'vehicles.chassis_no', 'vehicles.stock_id', 'brands.slug_name as b_slug', 'sub_brands.slug_name as sb_slug')
            ->join('countries_vehicles', 'vehicles.id', 'countries_vehicles.vehicle_id')
            ->join('brands', 'vehicles.brand_id', 'brands.id')
            ->join('sub_brands', 'vehicles.sub_brand_id', 'sub_brands.id')
            //->whereNull('r_status')
            ->where('countries_vehicles.country_id', $countryName->id)
            ->where('price', '>=', $country_price_range->high_grade_range)->orderBy('vehicles.id', 'desc')->take(10)->get();
        //->inRandomOrder()->take(10)

        $vehicles = Vehicle::latest()->take(10)->get();
        /*=Most Viewed Vehicle in Bangladesh==*/
        $most_views = DB::table('vehicles')
            ->select('vehicles.id as vid', 'vehicles.r_status', 'vehicles.name', 'vehicles.price', 'vehicles.discount', 'vehicles.manu_year', 'vehicles.chassis_no', 'vehicles.stock_id', 'brands.slug_name as b_slug', 'sub_brands.slug_name as sb_slug')
            ->join('most_views', 'vehicles.id', 'most_views.vehicle_id')
            ->join('brands', 'vehicles.brand_id', 'brands.id')
            ->join('sub_brands', 'vehicles.sub_brand_id', 'sub_brands.id')
            //->whereNull('vehicles.r_status')
            ->where('most_views.country_id', $countryName->id)->orderBy('vehicles.id', 'desc')->take(10)->get();
        //->inRandomOrder()->take(10)
        //print_r($most_views);die;

        $countries = DB::table('countries')
            ->join('countries_vehicles', 'countries.id', 'countries_vehicles.country_id')
            ->select('countries.name')->distinct()->get();
        //return response()->json(array('data' =>'ok'));



        return view('front.welcome', compact('most_views', 'countryName', 'current_locale_data', 'japan_locale_data', 'location', 'afford_by_country', 'high_grade_by_country', 'new_arivals', 'vehicles', 'countries'));
    }
    public function countrywiseVehicle(Country $country)
    {
        //print_r($country->toArray());
        $country_wise_vehicles = DB::table('vehicles')
            ->select('vehicles.id as vid', 'vehicles.name', 'vehicles.price', 'vehicles.discount', 'vehicles.manu_year', 'vehicles.chassis_no', 'vehicles.stock_id', 'brands.slug_name as b_slug', 'sub_brands.slug_name as sb_slug')
            ->join('brands', 'vehicles.brand_id', 'brands.id')
            ->join('sub_brands', 'vehicles.sub_brand_id', 'sub_brands.id')
            ->join('countries_vehicles', 'vehicles.id', 'countries_vehicles.vehicle_id')
            //->whereNull('r_status')
            ->where('countries_vehicles.country_id', $country->id)
            ->orderBy('vehicles.id', 'desc')->get();
        /*echo '<pre>';
        print_r($country_wise_vehicles);die;*/
        return view('front.country-vehicle', compact('country_wise_vehicles', 'country'));
    }
    public function brand(Brand $brand)
    {
        $sub_prefix =  DB::table('sub_brands')
            ->select(
                DB::raw('SUBSTRING(sub_brands.name, 1, 1) as cat'),
                DB::raw('GROUP_CONCAT(sub_brands.id) as ids'),
                DB::raw('COUNT(vehicles.id) as vehicles_count')
            )
            ->leftJoin('vehicles', 'sub_brands.id', '=', 'vehicles.sub_brand_id')
            ->where('sub_brands.brand_id', $brand->id)
            ->groupBy('cat')
            ->get();


        /*DB::table('sub_brands')
            ->select(DB::raw('substring(`sub_brands.name`,1,1) as cat'), 'sub_brands.id', DB::raw('GROUP_CONCAT(`sub_brands.id`) ids'),DB::raw('COUNT(vehicles.id) as vehicles_count'))
            ->leftJoin('vehicles', 'sub_brands.id', '=', 'vehicles.sub_brand_id')
            ->where('sub_brands.brand_id', $brand->id)
            ->groupBy('sub_brands.cat')
            ->get();
        echo '<pre>';
        print_r($sub_prefix->toArray());die;*/

        return view('front.brand', compact('brand', 'sub_prefix'));
    }
    /*@if($vehicle->images)
    <img src="{{asset('uploads/vehicle_images/'.$vehicle->images->first()->image)}}" class="card-img-top" alt="{{$vehicle->name}}">
  @endif*/
    public function subBrand(Brand $brand, SubBrand $subBrand)
    {
        $location =  request()->session()->get('location');
        $countryName =  request()->session()->get('countryName');
        if (!is_null($countryName) && !is_null($location)) {
        $countries = Country::all();
        $brand = Brand::where('name', $brand->name)->firstOrFail();

        $sub_brand_id = SubBrand::where('slug_name', $subBrand->slug_name)->firstOrFail();

        $vehicles = DB::table('vehicles')
            ->select('vehicles.*', 'brands.slug_name as b_slug', 'sub_brands.slug_name as sb_slug', 'transmissions.name as tname')
            ->join('brands', 'vehicles.brand_id', 'brands.id')
            ->join('sub_brands', 'vehicles.sub_brand_id', 'sub_brands.id')
            ->join('transmissions', 'vehicles.transmission_id', 'transmissions.id')
            ->where('vehicles.brand_id', $brand->id)->where('vehicles.sub_brand_id', $sub_brand_id->id)
            //->whereNull('r_status')
            ->inRandomOrder()->paginate(10);

        /*echo '<pre>';
        print_r($vehicles);die;*/
        return view('front.search', compact('location','vehicles', 'brand', 'sub_brand_id', 'countries'));
        } else {
            return redirect()->route('front.countrySelect');
        }
    }
    public function singleVehicle(Brand $brand, SubBrand $subBrand, $stock_id)
    {
        $location =  request()->session()->get('location');
        $countryName =  request()->session()->get('countryName');
        if ( isset($location['geoplugin_currencyCode']) && isset($location['geoplugin_currencyConverter']) && isset($countryName->id)) {
            /*echo '</pre>';
            print_r($countryName);
            die;*/
            $brand = Brand::where('slug_name', $brand->slug_name)->firstOrFail();
            $sub_brand_id = SubBrand::where('slug_name', $subBrand->slug_name)->firstOrFail();
            $v = Vehicle::where('stock_id', $stock_id)->first();
            $v_images = DB::table('vehicle_images')->where('vehicle_id', $v->id)->get();
            $cover_img = DB::table('vehicle_images')->where('vehicle_id', $v->id)->where('is_cover_img', 1)->first();
            $countries = Country::all();
            $recomended = DB::table('vehicles')
                ->select('vehicles.id as vid', 'vehicles.r_status', 'vehicles.name', 'vehicles.price', 'vehicles.discount', 'vehicles.manu_year', 'vehicles.chassis_no', 'vehicles.stock_id', 'brands.slug_name as b_slug', 'sub_brands.slug_name as sb_slug')
                ->join('countries_vehicles', 'vehicles.id', 'countries_vehicles.vehicle_id')
                ->join('brands', 'vehicles.brand_id', 'brands.id')
                ->join('sub_brands', 'vehicles.sub_brand_id', 'sub_brands.id')
                //->whereNull('r_status')
                ->orWhere('countries_vehicles.country_id', $countryName->id)
                ->where('brands.id', $v->brand_id)
                ->where('sub_brands.id', $v->sub_brand_id)
                ->whereNotIn('vehicles.id', [$v->id])
                ->inRandomOrder()->take(10)->get();

            $url = url('used-cars-search/' . $brand->slug_name . '/' . $subBrand->slug_name . '/' . $stock_id);
            $shareComponent = \Share::page($url, 'Share title')
                ->facebook()
                ->twitter()
                ->whatsapp();
            return view('front.single', compact('location','countryName','countries', 'v_images', 'v', 'brand', 'sub_brand_id', 'shareComponent', 'url', 'cover_img', 'recomended'));
        }else{
            countryIp();
        }
    }
    public function searchStData(Request $request)
    {
        $search_data = DB::table('vehicles')
            ->join('brands', 'brands.id', '=', 'vehicles.brand_id')
            ->join('sub_brands', 'sub_brands.id', '=', 'vehicles.sub_brand_id')
            ->select('vehicles.name as v_name', 'vehicles.fullName as v_full_name', 'vehicles.stock_id', 'vehicles.chassis_no', 'brands.name as b_name', 'sub_brands.name as sb_name')
            ->where('vehicles.name', 'like', '%' . $request->sdata . '%')
            ->orWhere('vehicles.fullName', 'like', '%' . $request->sdata . '%')
            ->orWhere('vehicles.stock_id', 'like', '%' . $request->sdata . '%')
            ->orWhere('brands.name', 'like', '%' . $request->sdata . '%')
            ->orWhere('sub_brands.name', 'like', '%' . $request->sdata . '%')
            ->orWhere('vehicles.chassis_no', 'like', '%' . $request->sdata . '%')
            ->get();
        $search_keywords = [];

        foreach ($search_data as $sd) {
            $search_keywords[] = $sd->v_name;
            $search_keywords[] = $sd->v_full_name;
            $search_keywords[] = $sd->stock_id;
            $search_keywords[] = $sd->b_name;
            $search_keywords[] = $sd->sb_name;
            $search_keywords[] = $sd->chassis_no;
        }
        $unique_keyword = array_values(array_unique($search_keywords));
        $unique_keyword = array_filter($unique_keyword, function ($value) use ($request) {
            return stripos($value, $request->sdata) === 0;
        });
        $unique_keyword = array_slice($unique_keyword, 0, 10);
        $unique_keyword = array_values($unique_keyword);
        return response()->json($unique_keyword);
    }
    public function searchpostStData(Request $request)
    {
        $countries = Country::all();
        $vehicles = DB::table('vehicles')
            ->join('brands', 'brands.id', '=', 'vehicles.brand_id')
            ->join('sub_brands', 'sub_brands.id', '=', 'vehicles.sub_brand_id')
            ->join('transmissions', 'vehicles.transmission_id', 'transmissions.id')
            ->select('vehicles.*', 'brands.slug_name as b_slug', 'sub_brands.slug_name as sb_slug', 'transmissions.name as tname')
            ->where('vehicles.name', 'like', '%' . $request->sdata . '%')
            ->orWhere('vehicles.fullName', $request->sdata)
            ->orWhere('vehicles.stock_id', $request->sdata)
            ->orWhere('brands.name', $request->sdata)
            ->orWhere('sub_brands.name', $request->sdata)
            ->orWhere('vehicles.chassis_no', 'like', '%' . $request->sdata . '%')
            ->inRandomOrder()->paginate(10);
        if ($request->sales_search == 'search')
            return view('sales_module.search_vehicle', compact('vehicles', 'countries'));
        else
            return view('front.search', compact('vehicles', 'countries'));
    }
    /*Search Backup code By Search Keyword */
    /*$search_data = DB::table('vehicles')
            //->join('brands', 'brands.id', '=', 'vehicles.brand_id')
            //->join('sub_brands', 'sub_brands.id', '=', 'vehicles.sub_brand_id')
            //->select('vehicles.name as v_name', 'vehicles.fullName as v_full_bame', 'vehicles.stock_id', 'brands.name as b_name', 'sub_brands.name as sb_name')
            ->select('search_keyword')
            ->where('vehicles.r_status', 0)
            ->whereRaw("FIND_IN_SET('$request->sdata', search_keyword)")*/
    /*->orWhere('vehicles.name', 'like', '%' . $request->sdata . '%')
            ->orWhere('vehicles.fullName', $request->sdata)
            ->orWhere('vehicles.stock_id', $request->sdata)
            ->orWhere('brands.name', $request->sdata)
            ->orWhere('sub_brands.name', $request->sdata)*/
    //->get();
    /*$search_keyword = array();
        foreach ($search_data as $sd) {
            foreach (explode(',', $sd->search_keyword) as $e) {
                $search_keyword[] = $e;
            }
        }
        $unique_keyword = array_values(array_unique($search_keyword));  // remove any duplicate values and index array from 0
        return response()->json($unique_keyword);*/
    public function front_adv_search_by_data(Request $request)
    {
        /* print_r($request->toArray());
        echo 'ok';die;*/
        $countries = Country::all();
        if (!empty($request->brand) && !empty($request->sub_brand)) {
            $vehicles = DB::table('vehicles')
                ->select('vehicles.*', 'brands.slug_name as b_slug', 'sub_brands.slug_name as sb_slug')
                ->join('brands', 'vehicles.brand_id', 'brands.id')
                ->join('sub_brands', 'vehicles.sub_brand_id', 'sub_brands.id')
                //->whereNull('r_status')
                ->inRandomOrder()->paginate(10);
            /*echo '<pre>';
            print_r($vehicles);die;*/

            /*echo '<pre>';
            print_r(request()->toArray());*/
            $brands = Brand::withCount('vehicles')->get();
            $brand = Brand::where('id', $request->brand)->firstOrFail();
            $sub_brand_id = SubBrand::where('id', $request->sub_brand)->firstOrFail();
            $vehicles = DB::table('vehicles')
                ->select('vehicles.*', 'brands.slug_name as b_slug', 'sub_brands.slug_name as sb_slug', 'transmissions.name as tname')
                ->leftjoin('brands', 'vehicles.brand_id', 'brands.id')
                ->leftjoin('sub_brands', 'vehicles.sub_brand_id', 'sub_brands.id')
                ->leftjoin('transmissions', 'vehicles.transmission_id', 'transmissions.id')
                ->where('vehicles.brand_id', $brand->id)->where('vehicles.sub_brand_id', $sub_brand_id->id);
            if ($request->filled('body_type')) {
                $vehicles = $vehicles->where('vehicles.body_type_id', $request->body_type);
            }
            if ($request->filled('steering')) {
                $vehicles = $vehicles->where('vehicles.steering', $request->steering);
            }
            if ($request->filled('from_year') && $request->filled('to_year')) {
                $vehicles = $vehicles->whereBetween('vehicles.reg_year', [$request->to_year, $request->from_year]);
            }
            /*=== Most Affordable === price desc*/
            if ($request->afford) {
                $vehicles = $vehicles->where('price', '>', 0)->orderBy('price', 'asc');
            }
            if ($request->highgrade) {
                $vehicles = $vehicles->where('price', '>', 0)->orderBy('price', 'desc');
            }

           


                if ($request->adv_search == 'sale_module_search'){
                    $vehicles = $vehicles->paginate(10)->appends([
                        'adv_search' => $request->adv_search,
                        'brand' => $request->brand,
                        'sub_brand' => $request->sub_brand,
                        'steering' => $request->steering,
                        'body_type' => $request->body_type,
                        'drive_id' => $request->drive_id,
                        'to_year' => $request->to_year,
                        'from_year' => $request->from_year,
                        'from_price' => $request->from_price,
                        'to_price' => $request->to_price,
                        'e_size_from' => $request->e_size_from,
                        'e_size_to' => $request->e_size_to,
                        'mileage' => $request->mileage,
                        'ext_color_id' => $request->ext_color_id,
                        'max_loading_capacity' => $request->max_loading_capacity,
                        'inv_locatin_id' => $request->inv_locatin_id,
                    ]);
                    $brands = Brand::all();
                    $vehicle_models = VehicleModel::all();
                    $body_types = BodyType::get();
                    $sub_body_types = SubBodyType::all();
                    $drive_types = DriveType::all();
                    $trans = Transmission::get();
                    $fuel= Fuel::all();
                    $colors = Color::all();
                    $year_range = DB::table('vehicles')->select(\DB::raw('MIN(manu_year) AS minyear, MAX(manu_year) AS maxyear'))->get()->toArray();
                    $max_manu_Year = DB::table('vehicles')->max(DB::raw('YEAR(manu_year)'));
                    $min_manu_Year = DB::table('vehicles')->min(DB::raw('YEAR(manu_year)'));
                    $inv_loc = InventoryLocation::all();
                        return view('sales_module.search_vehicle', compact('vehicles', 'countries','brands','vehicle_models','body_types','sub_body_types','drive_types','year_range','trans','fuel','colors','max_manu_Year','min_manu_Year','inv_loc'));
                }
                
        else
        $vehicles = $vehicles->paginate(10)->appends([
            'brand' => $request->brand,
            'sub_brand' => $request->sub_brand,
            'steering' => $request->steering,
            'body_type' => $request->body_type,
            'drive_id' => $request->drive_id,
            'to_year' => $request->to_year,
            'from_year' => $request->from_year,
            'from_price' => $request->from_price,
            'to_price' => $request->to_price,
            'e_size_from' => $request->e_size_from,
            'e_size_to' => $request->e_size_to,
            'mileage' => $request->mileage,
            'ext_color_id' => $request->ext_color_id,
            'max_loading_capacity' => $request->max_loading_capacity,
            'inv_locatin_id' => $request->inv_locatin_id,
        ]);
        $location =  request()->session()->get('location');
        $countryName =  request()->session()->get('countryName');
        if (!is_null($countryName) && !is_null($location)) {
            return view('front.search', compact('location','brands', 'vehicles', 'brand', 'sub_brand_id', 'countries'));
		} else {
            return redirect()->route('front.countrySelect');
        }
            
        
            //return view('front.search', compact('vehicles', 'countries'));
        } elseif ($request->filled('brand') && $request->filled('search')) {
            $brand = Brand::where('id', $request->brand)->firstOrFail();
            $sub_prefix = DB::table('sub_brands')
                ->select(
                    DB::raw('SUBSTRING(sub_brands.name, 1, 1) as cat'),
                    DB::raw('GROUP_CONCAT(sub_brands.id) as ids'),
                    DB::raw('COUNT(vehicles.id) as vehicles_count')
                )
                ->leftJoin('vehicles', 'sub_brands.id', '=', 'vehicles.sub_brand_id')
                ->where('sub_brands.brand_id', $brand->id)
                ->groupBy('cat')
                ->get();

            return view('front.brand', compact('brand', 'sub_prefix', 'countries'));
        } elseif ($request->adv_search) {

        }
            
    }



    public function resizeImage($foldername, $filename, $width, $height)
    {
        $img = Image::make(public_path('uploads/' . $foldername . '/' . $filename));
        $img->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        });
        return $img->response();
    }
}
