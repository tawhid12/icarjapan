<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use App\Models\Settings\Country;
use App\Models\FavouriteVehicle;
use App\Models\Invoice;
use App\Models\ReservedVehicle;
use App\Models\Notification;
use App\Models\User;
use App\Models\Vehicle\Vehicle;
use App\Models\Notify;
use App\Jobs\SendReserveCancelEmailJOb;
use Illuminate\Http\Request;
use Toastr;
use Carbon\Carbon;
use DB;

class ReservedVehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user_ip = getenv('REMOTE_ADDR') /*'122.152.53.35'*/;
        $api_url = "https://extreme-ip-lookup.com/json/$user_ip?key=9x9yyW5zMrdFwAKLH5jO";
        // Fetch JSON data from the API
        $jsonData = file_get_contents($api_url);
        $location = json_decode($jsonData, true);
        if ($user_ip) {
        if(isset($location)){
            if(isset($location['status']) && $location['status'] == 'success'){
                Log::info($location);
                $countryCodeToTimeZone = [
                    'AF' => 'Asia/Kabul',
                    'AL' => 'Europe/Tirane',
                    'DZ' => 'Africa/Algiers',
                    'AS' => 'Pacific/Pago_Pago',
                    'AD' => 'Europe/Andorra',
                    'AO' => 'Africa/Luanda',
                    'AI' => 'America/Anguilla',
                    'AQ' => 'Antarctica/Casey',
                    'AG' => 'America/Antigua',
                    'AR' => 'America/Argentina/Buenos_Aires',
                    'AM' => 'Asia/Yerevan',
                    'AW' => 'America/Aruba',
                    'AU' => 'Australia/Sydney',
                    'AT' => 'Europe/Vienna',
                    'AZ' => 'Asia/Baku',
                    'BS' => 'America/Nassau',
                    'BH' => 'Asia/Bahrain',
                    'BD' => 'Asia/Dhaka',
                    'BB' => 'America/Barbados',
                    'BY' => 'Europe/Minsk',
                    'BE' => 'Europe/Brussels',
                    'BZ' => 'America/Belize',
                    'BJ' => 'Africa/Porto-Novo',
                    'BM' => 'Atlantic/Bermuda',
                    'BT' => 'Asia/Thimphu',
                    'BO' => 'America/La_Paz',
                    'BA' => 'Europe/Sarajevo',
                    'BW' => 'Africa/Gaborone',
                    'BR' => 'America/Sao_Paulo',
                    'BN' => 'Asia/Brunei',
                    'BG' => 'Europe/Sofia',
                    'BF' => 'Africa/Ouagadougou',
                    'BI' => 'Africa/Bujumbura',
                    'KH' => 'Asia/Phnom_Penh',
                    'CM' => 'Africa/Douala',
                    'CA' => 'America/Toronto',
                    'CV' => 'Atlantic/Cape_Verde',
                    'KY' => 'America/Cayman',
                    'CF' => 'Africa/Bangui',
                    'TD' => 'Africa/Ndjamena',
                    'CL' => 'America/Santiago',
                    'CN' => 'Asia/Shanghai',
                    'CO' => 'America/Bogota',
                    'KM' => 'Indian/Comoro',
                    'CG' => 'Africa/Brazzaville',
                    'CD' => 'Africa/Kinshasa',
                    'CR' => 'America/Costa_Rica',
                    'HR' => 'Europe/Zagreb',
                    'CU' => 'America/Havana',
                    'CY' => 'Asia/Nicosia',
                    'CZ' => 'Europe/Prague',
                    'DK' => 'Europe/Copenhagen',
                    'DJ' => 'Africa/Djibouti',
                    'DM' => 'America/Dominica',
                    'DO' => 'America/Santo_Domingo',
                    'EC' => 'America/Guayaquil',
                    'EG' => 'Africa/Cairo',
                    'SV' => 'America/El_Salvador',
                    'GQ' => 'Africa/Malabo',
                    'ER' => 'Africa/Asmara',
                    'EE' => 'Europe/Tallinn',
                    'ET' => 'Africa/Addis_Ababa',
                    'FJ' => 'Pacific/Fiji',
                    'FI' => 'Europe/Helsinki',
                    'FR' => 'Europe/Paris',
                    'GA' => 'Africa/Libreville',
                    'GM' => 'Africa/Banjul',
                    'GE' => 'Asia/Tbilisi',
                    'DE' => 'Europe/Berlin',
                    'GH' => 'Africa/Accra',
                    'GR' => 'Europe/Athens',
                    'GD' => 'America/Grenada',
                    'GU' => 'Pacific/Guam',
                    'GT' => 'America/Guatemala',
                    'GN' => 'Africa/Conakry',
                    'GW' => 'Africa/Bissau',
                    'GY' => 'America/Guyana',
                    'HT' => 'America/Port-au-Prince',
                    'HN' => 'America/Tegucigalpa',
                    'HK' => 'Asia/Hong_Kong',
                    'HU' => 'Europe/Budapest',
                    'IS' => 'Atlantic/Reykjavik',
                    'IN' => 'Asia/Kolkata',
                    'ID' => 'Asia/Jakarta',
                    'IR' => 'Asia/Tehran',
                    'IQ' => 'Asia/Baghdad',
                    'IE' => 'Europe/Dublin',
                    'IL' => 'Asia/Jerusalem',
                    'IT' => 'Europe/Rome',
                    'JM' => 'America/Jamaica',
                    'JP' => 'Asia/Tokyo',
                    'JO' => 'Asia/Amman',
                    'KZ' => 'Asia/Almaty',
                    'KE' => 'Africa/Nairobi',
                    'KI' => 'Pacific/Tarawa',
                    'KP' => 'Asia/Pyongyang',
                    'KR' => 'Asia/Seoul',
                    'KW' => 'Asia/Kuwait',
                    'KG' => 'Asia/Bishkek',
                    'LA' => 'Asia/Vientiane',
                    'LV' => 'Europe/Riga',
                    'LB' => 'Asia/Beirut',
                    'LS' => 'Africa/Maseru',
                    'LR' => 'Africa/Monrovia',
                    'LY' => 'Africa/Tripoli',
                    'LI' => 'Europe/Vaduz',
                    'LT' => 'Europe/Vilnius',
                    'LU' => 'Europe/Luxembourg',
                    'MO' => 'Asia/Macau',
                    'MK' => 'Europe/Skopje',
                    'MG' => 'Indian/Antananarivo',
                    'MW' => 'Africa/Blantyre',
                    'MY' => 'Asia/Kuala_Lumpur',
                    'MV' => 'Indian/Maldives',
                    'ML' => 'Africa/Bamako',
                    'MT' => 'Europe/Malta',
                    'MH' => 'Pacific/Majuro',
                    'MQ' => 'America/Martinique',
                    'MR' => 'Africa/Nouakchott',
                    'MU' => 'Indian/Mauritius',
                    'YT' => 'Indian/Mayotte',
                    'MX' => 'America/Mexico_City',
                    'FM' => 'Pacific/Pohnpei',
                    'MD' => 'Europe/Chisinau',
                    'MC' => 'Europe/Monaco',
                    'MN' => 'Asia/Ulaanbaatar',
                    'ME' => 'Europe/Podgorica',
                    'MS' => 'America/Montserrat',
                    'MA' => 'Africa/Casablanca',
                    'MZ' => 'Africa/Maputo',
                    'MM' => 'Asia/Yangon',
                    'NA' => 'Africa/Windhoek',
                    'NR' => 'Pacific/Nauru',
                    'NP' => 'Asia/Kathmandu',
                    'NL' => 'Europe/Amsterdam',
                    'NZ' => 'Pacific/Auckland',
                    'NI' => 'America/Managua',
                    'NE' => 'Africa/Niamey',
                    'NG' => 'Africa/Lagos',
                    'NU' => 'Pacific/Niue',
                    'NF' => 'Pacific/Norfolk',
                    'MP' => 'Pacific/Saipan',
                    'NO' => 'Europe/Oslo',
                    'OM' => 'Asia/Muscat',
                    'PK' => 'Asia/Karachi',
                    'PW' => 'Pacific/Palau',
                    'PS' => 'Asia/Gaza',
                    'PA' => 'America/Panama',
                    'PG' => 'Pacific/Port_Moresby',
                    'PY' => 'America/Asuncion',
                    'PE' => 'America/Lima',
                    'PH' => 'Asia/Manila',
                    'PN' => 'Pacific/Pitcairn',
                    'PL' => 'Europe/Warsaw',
                    'PT' => 'Europe/Lisbon',
                    'PR' => 'America/Puerto_Rico',
                    'QA' => 'Asia/Qatar',
                    'RO' => 'Europe/Bucharest',
                    'RU' => 'Europe/Moscow',
                    'RW' => 'Africa/Kigali',
                    'BL' => 'America/St_Barthelemy',
                    'SH' => 'Atlantic/St_Helena',
                    'KN' => 'America/St_Kitts',
                    'LC' => 'America/St_Lucia',
                    'MF' => 'America/Marigot',
                    'PM' => 'America/Miquelon',
                    'VC' => 'America/St_Vincent',
                    'WS' => 'Pacific/Apia',
                    'SM' => 'Europe/San_Marino',
                    'ST' => 'Africa/Sao_Tome',
                    'SA' => 'Asia/Riyadh',
                    'SN' => 'Africa/Dakar',
                    'RS' => 'Europe/Belgrade',
                    'SC' => 'Indian/Mahe',
                    'SL' => 'Africa/Freetown',
                    'SG' => 'Asia/Singapore',
                    'SX' => 'America/Lower_Princes',
                    'SK' => 'Europe/Bratislava',
                    'SI' => 'Europe/Ljubljana',
                    'SB' => 'Pacific/Guadalcanal',
                    'SO' => 'Africa/Mogadishu',
                    'ZA' => 'Africa/Johannesburg',
                    'SS' => 'Africa/Juba',
                    'ES' => 'Europe/Madrid',
                    'LK' => 'Asia/Colombo',
                    'SD' => 'Africa/Khartoum',
                    'SR' => 'America/Paramaribo',
                    'SZ' => 'Africa/Mbabane',
                    'SE' => 'Europe/Stockholm',
                    'CH' => 'Europe/Zurich',
                    'SY' => 'Asia/Damascus',
                    'TW' => 'Asia/Taipei',
                    'TJ' => 'Asia/Dushanbe',
                    'TZ' => 'Africa/Dar_es_Salaam',
                    'TH' => 'Asia/Bangkok',
                    'TL' => 'Asia/Dili',
                    'TG' => 'Africa/Lome',
                    'TK' => 'Pacific/Fakaofo',
                    'TO' => 'Pacific/Tongatapu',
                    'TT' => 'America/Port_of_Spain',
                    'TN' => 'Africa/Tunis',
                    'TR' => 'Europe/Istanbul',
                    'TM' => 'Asia/Ashgabat',
                    'TC' => 'America/Grand_Turk',
                    'TV' => 'Pacific/Funafuti',
                    'UG' => 'Africa/Kampala',
                    'UA' => 'Europe/Kiev',
                    'AE' => 'Asia/Dubai',
                    'GB' => 'Europe/London',
                    'US' => 'America/New_York',
                    'UY' => 'America/Montevideo',
                    'UZ' => 'Asia/Tashkent',
                    'VU' => 'Pacific/Efate',
                    'VA' => 'Europe/Vatican',
                    'VE' => 'America/Caracas',
                    'VN' => 'Asia/Ho_Chi_Minh',
                    'EH' => 'Africa/El_Aaiun',
                    'YE' => 'Asia/Aden',
                    'ZM' => 'Africa/Lusaka',
                    'ZW' => 'Africa/Harare'
                ];
                if (isset($location['timezone']) && strlen($location['timezone']) === 2 && array_key_exists($location['timezone'], $countryCodeToTimeZone)) {
                    $location['timezone'] = $countryCodeToTimeZone[$location['timezone']];
                } elseif(in_array($location['timezone'], timezone_identifiers_list())){
                    $location['timezone'] = $location['timezone'];
                }else {
                    unset($_SESSION['countryName']);
                    unset($_SESSION['location']);
                    return redirect()->route('front.countrySelect');
                }
                $current_locale_data = Carbon::now($location['timezone']);
                $countryName = Country::where('code', $location['countryCode'])->first();
                $currency_data = array(
                    'geoplugin_status' => 200,
                    'geoplugin_currencyCode' => 'USD',
                    'geoplugin_currencyConverter' => 0,
                    'expairy' => 1,
                );
                $location = array_merge($location, $currency_data);
                session()->put('countryName', $countryName);
                session()->put('location', $location);
                session()->put('current_locale_data', $current_locale_data);
            }
        }
        $location =  request()->session()->get('location');
        $countryName =  request()->session()->get('countryName');
        }
        if (currentUser() == 'superadmin') {
            $sales_executives = User::where('role_id',3)->get();
            $resrv = ReservedVehicle::query()
                    ->join('vehicles', 'vehicles.id', '=', 'reserved_vehicles.vehicle_id');
            /* existing filters … */
            if ($request->filled('cmId')) {
                $resrv->where('user_id', $request->cmId);
            }
            if ($request->filled('executive_id')) {
                $resrv->where('assign_user_id', $request->executive_id);
            }
            if ($request->filled('status')) {
                $resrv->where('reserved_vehicles.status', $request->status);
            }
           if ($request->filled('type')) {
                if ($request->type == 1) {
                    // Type 1: Sold vehicles
                    $resrv->where('vehicles.sold_status', 1);
                } elseif ($request->type == 2) {
                   $resrv->where('vehicles.sold_status', '!=', 1)
                          ->whereExists(function ($query) {
                              $query->select(DB::raw(1))
                                    ->from('payments')
                                    ->whereColumn('payments.reserve_id', 'reserved_vehicles.id')
                                    ->where('payments.amount', '>', 0);
                          });
                }
                // You can add more type conditions here if needed
            }



            /* vehicle search */
            if ($request->filled('search')) {
                $search = $request->search;
            
                $resrv->where(function ($q) use ($search) {
                    $q->where('vehicles.fullName',  'LIKE', "%{$search}%")
                      ->orWhere('vehicles.stock_id',    $search)
                      ->orWhere('vehicles.chassis_no',  $search);
                });
            }
           /* choose the columns you need to select to avoid ambiguity */
            $resrv = $resrv->select('reserved_vehicles.*')          // primary table
               ->orderBy('reserved_vehicles.id', 'DESC')
               ->paginate(100)
               ->appends($request->query());

            return view('vehicle.resrv_vehicle.index', compact('resrv','sales_executives'));
        } elseif (currentUser() == 'salesexecutive') {
            $resrv = ReservedVehicle::where('assign_user_id', currentUserId())->orderBy('id', 'DESC')->paginate(25);
            return view('vehicle.resrv_vehicle.index', compact('resrv'));
        } else {
            $resrv = ReservedVehicle::where('user_id', currentUserId())->orderBy('id', 'DESC')->paginate(25);

            $location =  request()->session()->get('location');
            $countryName =  request()->session()->get('countryName');

            if (isset($location['geoplugin_currencyCode']) && isset($location['geoplugin_currencyConverter']) && isset($countryName->id)) {
                return view('user.resrv_vehicle.index', compact('resrv', 'location'));
            } else {
                unset($_SESSION['countryName']);
                unset($_SESSION['location']);
                return redirect()->route('front.countrySelect');
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (currentUser() == 'salesexecutive') {
            $users = User::where('created_by', currentUserId())->paginate(10);
        }
        return view('vehicle.resrv_vehicle.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);

        $vehicle = Vehicle::find($request->vehicle_id);

        if (is_null($vehicle->r_status)) {
            try {
                $b = new ReservedVehicle();
                $b->vehicle_id = $request->vehicle_id;
                if (currentUser() == 'user') {
                    $user = User::find(currentUserId());
                    $b->user_id = currentUserId();
                    $b->created_by = currentUserId();
                    if($user){
                        $b->assign_user_id = $user->executiveId;
                    }
                } else {
                    $b->user_id = $request->user_id;
                    $b->assign_user_id = currentUserId();
                    $b->created_by = currentUserId();

                    /*=== Update Executive Id into  Users Table to assign Executive to user ===*/
                    $user = User::where('id', $request->user_id)->update(['executiveId' => currentUserId(), 'type' => 1]);
                }
                /* Check Shipment Type RORO or Container if container what is price need to ask but roro will calculate*/
                //if ($request->shipment_type == 1) {
                    $user = DB::table('users')->where('id', $request->user_id)->first();

                    $country_data = DB::table('countries')->where('id', $user->country_id)->first();
                    $b->insp_amt =  $request->insp_amt == 1 ? $country_data->inspection : 0;
                    $b->insu_amt =  $request->insu_amt == 1 ? $country_data->insurance : 0;

                    if (is_null($user->port_id)) {
                        return redirect()->back()->with(Toastr::error('Please Select Port For User!', 'Fail', ["positionClass" => "toast-top-right"]));
                    }
                    $port_data = DB::table('ports')->where('id', $user->port_id)->first();

                    if ($vehicle->m3 == 0.00) {
                        return redirect()->back()->with(Toastr::error('M3 Value can not be Zero!', 'Fail', ["positionClass" => "toast-top-right"]));
                    }
                    $b->m3_value = $vehicle->m3 ? $vehicle->m3 : 0;
                    if ($port_data->m3 == 0.00) {
                        return redirect()->back()->with(Toastr::error('M3 Charge can not be Zero!', 'Fail', ["positionClass" => "toast-top-right"]));
                    }
                    $b->m3_charge = $port_data->m3;

                    if (isset($port_data->aditional_cost))
                        $b->aditional_cost = $port_data->aditional_cost;
                    else
                        $b->aditional_cost =  0;
                //}
                $b->shipment_type =  1 /*$request->shipment_type*/;
                $b->fob_amt = $vehicle->price ? $vehicle->price : 0.00;
                $b->discount = $vehicle->sp_dis ? $vehicle->sp_dis : 0.00;



                if ($b->save()) {

                    $vehicle->r_status = 1;
                    $vehicle->save();

                    $notification = new Notification();
                    $notification->user_id = currentUserId();
                    $notification->title = 'Vehicle Reserved ' . $vehicle->fullName;
                    $notification->click_url = route('superadmin.reservevehicle.show', $b->id);
                    $notification->read_status = 0;
                    $notification->type = 1;
                    $notification->save();
                    // Redirect user to intended URL
                    return redirect()->back()->with(Toastr::success('Reserved Request Received!', 'Success', ["positionClass" => "toast-top-right"]));
                } else {
                    return redirect()->back()->withInput()->with(Toastr::error('Please try again!', 'Fail', ["positionClass" => "toast-top-right"]));
                }
            } catch (Exception $e) {
                //dd($e);
                return redirect()->back()->withInput()->with(Toastr::error('Please try again!', 'Fail', ["positionClass" => "toast-top-right"]));
            }
        } else {
            // Redirect user to intended URL
            return redirect()->back()->with(Toastr::error('Vehicle  Reserved !!', 'Success', ["positionClass" => "toast-top-right"]));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ReservedVehicle  $reservedVehicle
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //return view()
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ReservedVehicle  $reservedVehicle
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = User::whereIn('role_id', [3])->with('role')->orderBy('id', 'DESC')->get();
        /*echo '<pre>';
        print_r($users);die;*/
        $resv = ReservedVehicle::find($id);
        return view('vehicle.resrv_vehicle.edit', compact('resv', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ReservedVehicle  $reservedVehicle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {


        try {
            $resv = ReservedVehicle::findOrFail(encryptor('decrypt', $id));
            $vehicle = Vehicle::find($resv->vehicle_id);
            if (currentUser() == 'accountant') {
                DB::connection()->enableQueryLog();
                $total_paid = DB::table('payments')
                    ->join('invoices', 'payments.client_id', 'invoices.client_id')
                    ->where('payments.client_id', $resv->user_id)
                    ->where('invoices.invoice_type', 1)
                    ->sum('payments.amount');
                $queries = \DB::getQueryLog();
                //dd($queries);
                $total_allocate = DB::table('reserved_vehicles')->where('user_id', $resv->user_id)->sum('allocated');
                /*echo $total_paid ."<br>";
                echo $total_allocate."<br>";
                echo $request->allocate;
                die;*/
                if ($total_paid - $total_allocate > 0 && $request->allocate <= $total_paid - $total_allocate) {
                    $resv->allocated = $request->allocate;
                } else {
                    return redirect()->back()->with(Toastr::error($total_paid - $total_allocate . ' Allocation Available!', 'error', ["positionClass" => "toast-top-right"]));
                }
            }
            if (currentUser() == 'salesexecutive' || currentUser() == 'superadmin') {
                //echo '<pre>'; print_r($resv);die;


                /* Check Shipment Type RORO or Container if container what is price need to ask but roro will calculate*/
                if ($resv->shipment_type == 2) {
                    $resv->freight_amt = $request->freight_amt;
                    $resv->insp_amt = $request->insp_amt;
                    $resv->insu_amt = $request->insu_amt;
                    $resv->m3_value = $request->m3_value;
                    $resv->m3_charge = $request->m3_charge;
                    $resv->aditional_cost =  $request->aditional_cost;
                    $resv->fob_amt = $request->fob_amt;
                }



                if ($request->status == 2) {
                    /* If Reserve By Customer need to update assisgn_user_id of reserve table and executiveId of users table */
                    if ($resv->assign_user_id == null) {
                        $resv->assign_user_id = currentUserId();
                        $user = User::find($resv->user_id);
                        $user->type = 1;
                        $user->executiveId = currentUserId();
                        $user->save();
                    }
                    /*Insert To Proforma Invoice */
                    if (Invoice::where('vehicle_id', $resv->vehicle_id)->where('reserve_id', $resv->id)->where('invoice_type', 1)->doesntExist()) {
                        $invoice = new Invoice();
                        $invoice->invoice_type = 1;
                        $invoice->invoice_date = date('Y-m-d');
                        $invoice->reserve_id =  $resv->id;
                        $invoice->vehicle_id = $resv->vehicle_id;
                        $invoice->client_id     = $resv->user_id;
                        //$invoice->fob_amt = $resv->settle_price;
                        $invoice->executiveId = $resv->assign_user_id;

                        $invoice->inv_amount = $resv->total ? $resv->total : 0.00;
                        $invoice->save();
                    }
                    $resv->status = 2;
                    $inv = Invoice::where('reserve_id', $resv->id)->where('invoice_type', 1)->first();
                    $resv->invoice_no = 'ICJ' .\Carbon\Carbon::createFromTimestamp(strtotime(date('Y-m-d')))->format('Ymd'). $inv->id;
                }
                $resv->discount =  $vehicle->sp_dis ? $vehicle->sp_dis : 0.00;
                $resv->total();

               
                $invoice = Invoice::where('reserve_id', $resv->id)->where('invoice_type', 1)->first();
                if($invoice){
                    $invoice->inv_amount =  $resv->total ? $resv->total : 0.00;
                    $invoice->save();
                }
                /*Assign Executiv By Superadmin*/
                if ($resv->assign_user_id == null && currentUser() == 'superadmin') {
                     $resv->assign_user_id = $request->assign_user_id;
                }
                /* Send Proforma Invoice To User with mail */
            }
           if($request->required_deposit)
           $resv->required_deposit =  $request->required_deposit;
           else
            $resv->required_deposit =  floor($resv->total >= 0.5) ? ceil($resv->total*0.5) : floor($resv->total*0.5);
            $resv->updated_by = currentUserId();
            if ($resv->save()) {
                return redirect()->back()->with(Toastr::success('Reserved Request Received!', 'Success', ["positionClass" => "toast-top-right"]));
                //return redirect()->route(currentUser() . '.reservevehicle.index')->with(Toastr::success('Data Updated!', 'Success', ["positionClass" => "toast-top-right"]));
            } else {
                return redirect()->back()->withInput()->with(Toastr::error('Please try again!', 'Fail', ["positionClass" => "toast-top-right"]));
            }
        } catch (Exception $e) {
            //dd($e);
            return redirect()->back()->withInput()->with(Toastr::error('Please try again!', 'Fail', ["positionClass" => "toast-top-right"]));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ReservedVehicle  $reservedVehicle
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $notify = Notify::where(['vehicle_id' => $id, 'status' => 2])->get();
        foreach ($notify as $n) {
            /*To User */
            $user = User::where('id', $n->user_id)->first();
            $v_data = Vehicle::where('id', $n->vehicle_id)->first();
            /*echo $user->email;
            die;*/
            \Mail::send('mail.reply_reserve_cancel', ['notify' => $n], function ($message) use ($n, $v_data, $user) {
                $message->from('info@icarjapan.com', 'Icarjapan')
                    ->to($user->email)
                    ->subject('Reserved Free For ' . $v_data->name . ' and Stock Id ' . $v_data->stock_id);
            });
            /*== Notify Cancel Update ==*/
            $notify  =  Notify::find($n->id);
            $notify->status = 1;
            $notify->save();

            /*== Reserve Vehicle Cancel ==*/
            $resv = ReservedVehicle::findOrFail($id);
            $resv->status = 3;
            $resv->save();
        }

        /*== Notify Vehicle Cancel Update ==*/
        $vehicle = Vehicle::findOrFail($id);
        $vehicle->r_status = null;
        if ($vehicle->save()) {
            return redirect()->route(currentUser() . '.reservevehicle.index')->with(Toastr::success('Reserve Cancel!', 'Success', ["positionClass" => "toast-top-right"]));
        } else {
            return redirect()->back()->withInput()->with(Toastr::error('Please try again!', 'Fail', ["positionClass" => "toast-top-right"]));
        }
    }
    /*public function reserve_cancel(Request $request)
    {
        $id = $request->id;
        $reserveId =  $request->reserveId;
        if ($id && $reserveId) {
            $notify = FavouriteVehicle::where(['vehicle_id' => $id, 'user_id' => currentUserId(), 'status' => 2])->get();
            foreach ($notify as $n) {
                dispatch(new SendReserveCancelEmailJOb($n));
                /*== Favourite Status Update ==*/
                /*$notify  =  FavouriteVehicle::find($n->id);
                $notify->status = 1;
                $notify->save();
            }*/
            /*== Reserve Vehicle Cancel ==*/
            /*$resv = ReservedVehicle::findOrFail($reserveId);
            $resv->status = 3;
            $resv->save();*/

            /*== Notify Vehicle Cancel Update ==*/
            /*$vehicle = Vehicle::findOrFail($id);
            $vehicle->r_status = null;
            $vehicle->save();

            return redirect()->back()->with(Toastr::success('Reserve Cancel!', 'Success', ["positionClass" => "toast-top-right"]));
        } else {
            return redirect()->back()->withInput()->with(Toastr::error('Please try again!', 'Fail', ["positionClass" => "toast-top-right"]));
        }
    }*/


    public function reserve_cancel(Request $request)
    {
        $id = $request->id;

        $reserveId = $request->reserveId;
        $resv = ReservedVehicle::findOrFail($reserveId);
        if ($id && $reserveId) {
            $notify = FavouriteVehicle::where([
                'vehicle_id' => $resv->vehicle_id,
                'user_id' => currentUserId(),
                'status' => 2
            ])->get();
    
            foreach ($notify as $n) {
                // Dispatch email job
                dispatch(new SendReserveCancelEmailJOb($n));
    
                // Update Favourite status
                $fav = FavouriteVehicle::find($n->id);
                $fav->status = 1;
                $fav->save();
            }
    
            // ✅ Start Transaction
            DB::beginTransaction();
            try {
                // Update Reserved Vehicle
               
                $resv->status = 3;
                $resv->save();
    
                // Update Vehicle notify status
                $vehicle = Vehicle::findOrFail($resv->vehicle_id);
                $vehicle->r_status = null;
                $vehicle->save();
    
                DB::commit(); // ✅ All good — commit changes
                return redirect()->back()->with(Toastr::success('Reserve Cancelled!', 'Success', ["positionClass" => "toast-top-right"]));
            } catch (\Exception $e) {
                DB::rollBack(); // ❌ Something failed — rollback changes
                return redirect()->back()->withInput()->with(Toastr::error('Cancel failed, please try again!', 'Error', ["positionClass" => "toast-top-right"]));
            }
        } else {
            return redirect()->back()->withInput()->with(Toastr::error('Invalid request!', 'Error', ["positionClass" => "toast-top-right"]));
        }
    }

    
    public function reserve_calculate(Request $request)
    {

        $vehicle = Vehicle::find($request->vehicle_id);
        $resv = ReservedVehicle::findOrFail($request->reserve_id);
       
        /* Check Shipment Type RORO or Container if container what is price need to ask but roro will calculate*/
        if ($resv->shipment_type == 1) {

            $user = DB::table('users')->where('id', $resv->user_id)->first();

            $country_data = DB::table('countries')->where('id', $user->country_id)->first();
            $resv->insp_amt =  $request->insp_amt == 1 ? $country_data->inspection : 0;
            $resv->insu_amt =  $request->insu_amt == 1 ? $country_data->insurance : 0;

            if (is_null($user->port_id)) {
                return redirect()->back()->with(Toastr::error('Please Select Port For User!', 'Fail', ["positionClass" => "toast-top-right"]));
            }
            $port_data = DB::table('ports')->where('id', $user->port_id)->first();

            if ($vehicle->m3 == 0.00) {
                return redirect()->back()->with(Toastr::error('M3 Value can not be Zero!', 'Fail', ["positionClass" => "toast-top-right"]));
            }
            $resv->m3_value = $vehicle->m3 ? $vehicle->m3 : 0;
            if ($port_data->m3 == 0.00) {
                return redirect()->back()->with(Toastr::error('M3 Charge can not be Zero!', 'Fail', ["positionClass" => "toast-top-right"]));
            }
            $resv->m3_charge = $port_data->m3;

            if (isset($port_data->aditional_cost))
                $resv->aditional_cost = $port_data->aditional_cost;
            else
                $resv->aditional_cost =  0;
        }
        $resv->shipment_type =  $request->shipment_type;
        $resv->fob_amt = $vehicle->price ? $vehicle->price : 0.00;
        $resv->discount = $vehicle->sp_dis ? $vehicle->sp_dis : 0.00;
        $resv->total();
        /*Insert To Proforma Invoice */
        if (Invoice::where('vehicle_id', $resv->vehicle_id)->where('reserve_id', $resv->id)->where('invoice_type', 1)->doesntExist()) {
            $invoice = new Invoice();
            $invoice->invoice_type = 1;
            $invoice->invoice_date = date('Y-m-d');
            $invoice->reserve_id =  $resv->id;
            $invoice->vehicle_id = $resv->vehicle_id;
            $invoice->client_id     = $resv->user_id;
            //$invoice->fob_amt = $resv->settle_price;
            $invoice->executiveId = $resv->assign_user_id;

            $invoice->inv_amount = $resv->total ? $resv->total : 0.00;
            $invoice->save();
        }
        $invoice = Invoice::where('reserve_id', $resv->id)->where('invoice_type', 1)->first();
        $invoice->inv_amount =  $resv->total ? $resv->total : 0.00;

        if($request->required_deposit > 0)
           $resv->required_deposit =  $request->required_deposit;
        else
            $resv->required_deposit =  floor($resv->total >= 0.5) ? ceil($resv->total*0.5) : floor($resv->total*0.5);

        $invoice->save();
        if ($resv->save()) {
        
            return redirect()->back()->with(Toastr::success('Shipment Type Updated', 'error', ["positionClass" => "toast-top-right"]));
        }
    }
    public function reserve_merge(){
        
    }
}
