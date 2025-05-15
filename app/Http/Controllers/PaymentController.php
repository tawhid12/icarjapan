<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Carbon;
use App\Models\Settings\Country;
use App\Models\Payment;
use App\Models\PurchasedVehicle;
use App\Models\Vehicle\Vehicle;
use App\Models\Invoice;
use App\Models\User;
use Illuminate\Http\Request;
use Toastr;
use DB;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
        if (currentUser() == 'salesexecutive') {
            $payments = Payment::where('created_by', currentUserId())->get();
            return view('sales.payment.index', compact('payments'));
        } elseif (currentUser() == 'user') {
            $payments = Payment::where('client_id', currentUserId())->get();

            $location =  request()->session()->get('location');
            $countryName =  request()->session()->get('countryName');
            if (isset($location['geoplugin_currencyCode']) && isset($location['geoplugin_currencyConverter']) && isset($countryName->id)) {
                return view('user.payment.index', compact('payments','location'));
            }else{
                unset($_SESSION['countryName']);
                unset($_SESSION['location']);
                return redirect()->route('front.countrySelect');
            }
        } else {
            $payments = Payment::all();
            return view('superadmin.payment.index', compact('payments'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if ($request->filled('id')) {
            $invoice = Invoice::find($request->id);
            return view('sales.payment.create-payment', compact('invoice'));
        }
        $invoices = Invoice::where('executive_id', currentUserId())->get();
        return view('sales.payment.create', compact('invoices'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $inv = Invoice::where('id', $request->invoice_id)->first();
            if ($inv)
                $fob_amt  = $inv->inv_amount;
            else
                $fob_amt = 0;
            $paid_amt = Payment::where(['reserve_id' => $request->reserve_id, 'client_id' => $request->client_id])->sum('amount');
            /*echo $fob_amt . '<br>';
            echo $request->amount + $paid_amt;
            die;*/
            //$deposit_amt = Payment::whereNull('invoice_id')->where('customer_id', $request->customer_id)->sum('deposit');

            /*echo '<pre>';
            print_r($inv->toArray());die;*/
            if ($request->amount + $paid_amt + $request->deduction > $fob_amt) {
                return redirect()->back()->withInput()->with(Toastr::error('Paid Amount Greater Than Due Amount!', 'Fail', ["positionClass" => "toast-top-right"]));
            } else {
                $payment = new Payment();
                if ($request->adjust_deposit == 1) {

                    $vehicle = Vehicle::find($inv->vehicle_id);
                    $vehicle->sold_status = 1;
                    $vehicle->save();

                    $payment->invoice_id = $request->invoice_id;
                    $payment->created_by  = currentUserId();
                    $payment->receive_date = date('Y-m-d', strtotime($request->receive_date));
                    $payment->currency_type = $request->currency_type;
                    $payment->reserve_id = $request->reserve_id;
                    $payment->amount = $request->amount;
                    /*=== user balance will be duduct ===*/
                    $deposit_update = DB::table('deposits')->where('client_id', $request->client_id)->update(['deduction' => -$request->deduction, 'merged_by' => currentUserId(), 'merge_date' => date('Y-m-d', strtotime($request->receive_date)), 'payment_id' => $request->payment_id, 'updated_by' => currentUserId()]);
                    /*== deposit+$request->amount+$paid_amt == fob_amt (vechicle sold out) and data insert to purchased table==*/
                    if ($deposit_update) {
                        $deposit_merge = new Payment();
                        $deposit_merge->invoice_id = $request->invoice_id;
                        $deposit_merge->created_by  = currentUserId();
                        $deposit_merge->receive_date = date('Y-m-d', strtotime($request->receive_date));
                        $deposit_merge->currency_type = $request->currency_type;
                        $deposit_merge->reserve_id = $request->reserve_id;
                        $deposit_merge->type = 2;
                        $deposit_merge->amount = $request->deduction;
                        $deposit_merge->client_id = $inv->client_id;
                        $deposit_merge->save();
                    }
                    if ($fob_amt == $request->amount + $request->deduction) {
                        /* Insert Data Into Purchase Table */
                        $pur_vehicle = new PurchasedVehicle();
                        $pur_vehicle->vehicle_id = $inv->vehicle_id;
                        $pur_vehicle->reserve_id = $inv->reserve_id;
                        $pur_vehicle->invoice_id = $inv->id;
                        $pur_vehicle->executive_id = $request->executive_id;
                        $pur_vehicle->customer_id = $inv->client_id;
                        $pur_vehicle->sale_date = date('Y-m-d', strtotime($request->receive_date));
                        $pur_vehicle->save();
                    }
                } elseif ($fob_amt == $request->amount + $paid_amt) {
                    /*===Vehicle Will Be Sold Out ===*/
                    if ($request->amount) {
                        $vehicle = Vehicle::find($inv->vehicle_id);
                        $vehicle->sold_status = 1;
                        $vehicle->save();


                        /* Insert Data Into Purchase Table */
                        $pur_vehicle = new PurchasedVehicle();
                        $pur_vehicle->vehicle_id = $inv->vehicle_id;
                        $pur_vehicle->reserve_id = $inv->reserve_id;
                        $pur_vehicle->invoice_id = $inv->id;
                        $pur_vehicle->executive_id = $request->executive_id;
                        $pur_vehicle->customer_id = $inv->client_id;
                        $pur_vehicle->sale_date = date('Y-m-d', strtotime($request->receive_date));
                        $pur_vehicle->save();
                    }
                }
                $payment->invoice_id = $request->invoice_id;
                $payment->created_by  = currentUserId();
                $payment->receive_date = date('Y-m-d', strtotime($request->receive_date));
                $payment->currency_type = $request->currency_type;
                $payment->reserve_id = $request->reserve_id;
                $payment->amount = $request->amount;
                //$payment->allocated = $request->allocated;
                /*if($request->allocated && $request->amount >= $request->allocated){
                    $payment->deposit = $request->amount - $request->allocated;
                }else{
                    $payment->deposit = $request->deposit;
                }*/
                //$payment->security_deposit	 = $request->security_deposit;
                //$payment->deposit = $request->deposit;
                $payment->type     = $request->type;
                $payment->client_id = $request->client_id;
                $payment->paid_by = currentUserId();
                $payment->created_by = currentUserId();
            }




            if ($payment->save()) {
                /*== Save Deposit to user Balance ==*/
                if ($request->deposit) {
                    $user = User::where('id', $request->customer_id)->first();
                    $user->deposit_bal +=  $request->deposit;
                    $user->save();
                }
                return redirect()->route(currentUser() . '.client_individual', encryptor('encrypt', $request->client_id))->with(Toastr::success('Data Updated!', 'Success', ["positionClass" => "toast-top-right"]));
            } else {
                return redirect()->back()->withInput()->with(Toastr::error('Please try again!', 'Fail', ["positionClass" => "toast-top-right"]));
            }
        } catch (Exception $e) {
            //dd($e);
            return redirect()->back()->withInput()->with(Toastr::error('Please try again!', 'Fail', ["positionClass" => "toast-top-right"]));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $invoice = Invoice::find($id);
        return view('sales.payment.create-payment', compact('invoice', 'id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
        $payment = Payment::find(encryptor('decrypt', $id));
        if($payment->delete()){
            return redirect()->back()->with(Toastr::success('Payment Deleted Successfully!', 'Success', ["positionClass" => "toast-top-right"]));
        }
        return redirect()->back()->withInput()->with(Toastr::error('Paid Amount Greater Than Due Amount!', 'Fail', ["positionClass" => "toast-top-right"]));
        
        } catch (Exception $e) {
            //dd($e);
            return redirect()->back()->withInput()->with(Toastr::error('Please try again!', 'Fail', ["positionClass" => "toast-top-right"]));
        }
    }
}
