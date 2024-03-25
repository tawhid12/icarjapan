<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;

use App\Models\MostView;
use App\Models\Review;
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
use App\Models\Page;

use DB;
use Carbon\Carbon;

use Intervention\Image\Facades\Image;

class FrontController extends Controller
{
    public function countrySelectpost(Request $request)
    {
        $c_data = Country::where('code', $request->code)->first();
        /*echo '<pre>';
        print_r($c_data->toArray());
        echo '<pre>';*/
        //die;
        if (isset($c_data->ip_address)) {
            //echo 'ok';die;

            $api_url = file_get_contents('https://extreme-ip-lookup.com/json/' . $c_data->ip_address . '?key=9x9yyW5zMrdFwAKLH5jO');
            $jsonData = file_get_contents($api_url);
            $location = json_decode($jsonData, true);
            if (isset($location['status']) && $location['status'] == 'success') {
                //print_r($location);

                //Log::info($location);
                if (array_key_exists('timezone', $location) && array_key_exists('expairy', $location)) {
                    $current_locale_data = Carbon::now($location['timezone']);
                } else {
                    countryIp();
                }
                $countryName = Country::where('code', $location['geoplugin_countryCode'])->first();
                session()->put('countryName', $countryName);
                session()->put('location', $location);
                session()->put('current_locale_data', $current_locale_data);
                return redirect()->route('front');
            }
        } else {
            return redirect()->route('front.countrySelect');
        }
    }
    public function countrySelect()
    {
        unset($_SESSION['countryName']);
        unset($_SESSION['location']);
        $countries = Country::all();
        return view('front.country-select', compact('countries'));
    }
    public function index(Request $request)
    {
        $location =  request()->session()->get('location');
        $countryName =  request()->session()->get('countryName');
        /*echo '<pre>';
        print_r($countryName);
        echo $countryName->name;
        die;*/
        if (isset($location['geoplugin_currencyCode']) && isset($location['geoplugin_currencyConverter']) && isset($countryName->id)) {
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

            $reviews = Review::with(['review_images','vehicle','user'])->orderBy('id','desc')->take(15)->get();
            $review_count = DB::table('reviews')->count();
    

            if (array_key_exists('timezone', $location) && array_key_exists('expairy', $location)) {
                $current_locale_data = Carbon::now($location['timezone']);
                return view('front.welcome', compact('review_count','reviews', 'most_views', 'countryName', 'current_locale_data', 'location', 'afford_by_country', 'high_grade_by_country', 'new_arivals', 'vehicles', 'countries'));
            } else {
                countryIp();
            }
        } else {
            countryIp();
        }
    }
    public function countrywiseVehicle(Country $country)
    {
        //countryIp();
        $location =  request()->session()->get('location');
        $countryName =  request()->session()->get('countryName');
        if (isset($location['geoplugin_currencyCode']) && isset($location['geoplugin_currencyConverter']) && isset($countryName->id)) {
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
            return view('front.country-vehicle', compact('location', 'country_wise_vehicles', 'country'));
        } else {
            countryIp();
        }
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
        //countryIp();
        $location =  request()->session()->get('location');
        $countryName =  request()->session()->get('countryName');
        if (isset($location['geoplugin_currencyCode']) && isset($location['geoplugin_currencyConverter']) && isset($countryName->id)) {
            return view('front.brand', compact('location', 'brand', 'sub_prefix'));
        } else {
            countryIp();
        }
    }
    public function subBrand(Brand $brand, SubBrand $subBrand)
    {
        //countryIp();
        $location =  request()->session()->get('location');
        $countryName =  request()->session()->get('countryName');
        /*echo '<pre>';
        print_r(session()->all());
        die;*/
        if (isset($location['geoplugin_currencyCode']) && isset($location['geoplugin_currencyConverter']) && isset($countryName->id)) {

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
            return view('front.search', compact('location', 'vehicles', 'brand', 'sub_brand_id', 'countries'));
        } else {
            countryIp();
        }
    }
    public function singleVehicle(Brand $brand, SubBrand $subBrand, $stock_id)
    {

        $location =  request()->session()->get('location');
        $countryName =  request()->session()->get('countryName');
        $v = Vehicle::where('stock_id', trim($stock_id))->first();
        if (isset($location['geoplugin_currencyCode']) && isset($location['geoplugin_currencyConverter']) && isset($countryName->id) && isset($v->id)) {
            //Log::info("Vehicle Id {$v->id}");
            /*echo '</pre>';
            print_r($countryName);
            print_r($location);
            die;*/


            $brand = Brand::where('slug_name', $brand->slug_name)->firstOrFail();
            $sub_brand_id = SubBrand::where('slug_name', $subBrand->slug_name)->firstOrFail();

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
            $reviews = Review::with(['review_images','vehicle','user'])->where('vehicle_id',$v->id)->orderBy('id','desc')->get();
            $clientIds = Review::whereNull('deleted_at')->distinct()->where('vehicle_id',$v->id)->where('review_type',3)->pluck('client_id')->toArray(); 
            return view('front.single', compact('clientIds','reviews','location', 'countryName', 'countries', 'v_images', 'v', 'brand', 'sub_brand_id', 'shareComponent', 'url', 'cover_img', 'recomended'));
        } else {
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
        if ($request->sales_search == 'search') {
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
            return view('sales_module.search_vehicle', compact('vehicles', 'countries', 'brands', 'vehicle_models', 'body_types', 'sub_body_types', 'drive_types', 'year_range', 'trans', 'fuel', 'colors', 'max_manu_Year', 'min_manu_Year', 'inv_loc'));
        } else {
            $location =  request()->session()->get('location');
            $countryName =  request()->session()->get('countryName');
            if (isset($location['geoplugin_currencyCode']) && isset($location['geoplugin_currencyConverter']) && isset($countryName->id)) {
            return view('front.search', compact('vehicles', 'countries', 'location'));
            } else {
                countryIp();
            }
        }
    }

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
                ->where('vehicles.sold_status', 0)
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


            $vehicles = $vehicles->orderBy('r_status', 'asc');
            if ($request->adv_search == 'sale_module_search') {
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
                $fuel = Fuel::all();
                $colors = Color::all();
                $year_range = DB::table('vehicles')->select(\DB::raw('MIN(manu_year) AS minyear, MAX(manu_year) AS maxyear'))->get()->toArray();
                $max_manu_Year = DB::table('vehicles')->max(DB::raw('YEAR(manu_year)'));
                $min_manu_Year = DB::table('vehicles')->min(DB::raw('YEAR(manu_year)'));
                $inv_loc = InventoryLocation::all();
                /*countryIp();
                $location =  request()->session()->get('location');
                $countryName =  request()->session()->get('countryName');*/
                return view('sales_module.search_vehicle', compact('vehicles', 'countries', 'brands', 'vehicle_models', 'body_types', 'sub_body_types', 'drive_types', 'year_range', 'trans', 'fuel', 'colors', 'max_manu_Year', 'min_manu_Year', 'inv_loc'));
            } else
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
            //countryIp();
            $location =  request()->session()->get('location');
            $countryName =  request()->session()->get('countryName');
            /*echo '<pre>';
                print_r(session()->all());
                die;*/
            if (isset($location['geoplugin_currencyCode']) && isset($location['geoplugin_currencyConverter']) && isset($countryName->id)) {
                return view('front.search', compact('location', 'brands', 'vehicles', 'brand', 'sub_brand_id', 'countries'));
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

    public function chooseUs()
    {
        $location =  request()->session()->get('location');
        $countryName =  request()->session()->get('countryName');
        if (isset($location['geoplugin_currencyCode']) && isset($location['geoplugin_currencyConverter']) && isset($countryName->id)) {
            return view('front.page.why-choose-us', compact('location', 'countryName'));
        } else {
            countryIp();
        }
    }

    public function orderfromAuction()
    {
        $location =  request()->session()->get('location');
        $countryName =  request()->session()->get('countryName');
        if (isset($location['geoplugin_currencyCode']) && isset($location['geoplugin_currencyConverter']) && isset($countryName->id)) {
            return view('front.page.how-to-order-from-auction', compact('location', 'countryName'));
        } else {
            countryIp();
        }
    }

    public function buyfromStock()
    {
        $location =  request()->session()->get('location');
        $countryName =  request()->session()->get('countryName');
        if (isset($location['geoplugin_currencyCode']) && isset($location['geoplugin_currencyConverter']) && isset($countryName->id)) {
            return view('front.page.how-to-buy-from-stock', compact('location', 'countryName'));
        } else {
            countryIp();
        }
    }

    public function shipping()
    {

        $location =  request()->session()->get('location');
        $countryName =  request()->session()->get('countryName');
        if (isset($location['geoplugin_currencyCode']) && isset($location['geoplugin_currencyConverter']) && isset($countryName->id)) {
            return view('front.page.shipping', compact('location', 'countryName'));
        } else {
            countryIp();
        }
    }


    public function inspectionService()
    {

        $location =  request()->session()->get('location');
        $countryName =  request()->session()->get('countryName');
        if (isset($location['geoplugin_currencyCode']) && isset($location['geoplugin_currencyConverter']) && isset($countryName->id)) {
            return view('front.page.inspection-services', compact('location', 'countryName'));
        } else {
            countryIp();
        }
    }

    public function overview()
    {

        $location =  request()->session()->get('location');
        $countryName =  request()->session()->get('countryName');
        if (isset($location['geoplugin_currencyCode']) && isset($location['geoplugin_currencyConverter']) && isset($countryName->id)) {
            return view('front.page.overview', compact('location', 'countryName'));
        } else {
            countryIp();
        }
    }

    public function companyProfile()
    {

        $location =  request()->session()->get('location');
        $countryName =  request()->session()->get('countryName');
        if (isset($location['geoplugin_currencyCode']) && isset($location['geoplugin_currencyConverter']) && isset($countryName->id)) {
            return view('front.page.company-profile', compact('location', 'countryName'));
        } else {
            countryIp();
        }
    }

    public function customerReview()
    {

        $location =  request()->session()->get('location');
        $countryName =  request()->session()->get('countryName');
        if (isset($location['geoplugin_currencyCode']) && isset($location['geoplugin_currencyConverter']) && isset($countryName->id)) {
            $reviews = Review::with(['review_images','vehicle','user'])->orderBy('id','desc')->paginate(10);
            $review_count = DB::table('reviews')->whereNull('reviews.deleted_at')->count();
            return view('front.page.customer-review', compact('location', 'countryName','reviews','review_count'));
        } else {
            countryIp();
        }
    }

    public function bankInformation()
    {

        $location =  request()->session()->get('location');
        $countryName =  request()->session()->get('countryName');
        if (isset($location['geoplugin_currencyCode']) && isset($location['geoplugin_currencyConverter']) && isset($countryName->id)) {
            return view('front.page.bank-information', compact('location', 'countryName'));
        } else {
            countryIp();
        }
    }

    public function faq()
    {

        $location =  request()->session()->get('location');
        $countryName =  request()->session()->get('countryName');
        if (isset($location['geoplugin_currencyCode']) && isset($location['geoplugin_currencyConverter']) && isset($countryName->id)) {
            return view('front.page.faq', compact('location', 'countryName'));
        } else {
            countryIp();
        }
    }
    public function contactUs()
    {

        $location =  request()->session()->get('location');
        $countryName =  request()->session()->get('countryName');
        if (isset($location['geoplugin_currencyCode']) && isset($location['geoplugin_currencyConverter']) && isset($countryName->id)) {
            return view('front.page.contact-us', compact('location', 'countryName'));
        } else {
            countryIp();
        }
    }
    public function page($slug){
        $location =  request()->session()->get('location');
        $countryName =  request()->session()->get('countryName');
        if (isset($location['geoplugin_currencyCode']) && isset($location['geoplugin_currencyConverter']) && isset($countryName->id)) {
        $page = Page::where('slug',$slug)->first();
        return view('front.page.page', compact('page'));
        }else {
            countryIp();
        }
    }
}
