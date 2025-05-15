<?php

namespace App\Http\Controllers\Settings;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Settings\Country;
use App\Models\Settings\Port;
use App\Models\CompanyAccountInfo;

use Illuminate\Support\Facades\Hash;
use App\Http\Traits\ImageHandleTraits;
use App\Models\ClientTransfer;
use Exception;
use DB;
use Toastr;
use Illuminate\Support\Carbon;

class UserProfileController extends Controller
{
    use ImageHandleTraits;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function profile()
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
        $user = User::find(currentUserId());
        $countries = Country::where('id', $user->country_id)->get();
        $ports = Port::where('inv_loc_id', $user->country_id)->get();
        $com_info = CompanyAccountInfo::first();
        if (currentUser() == 'superadmin' || currentUser() == 'salesexecutive' || currentUser() == 'accountant') {
            return view('settings.general.profile', compact('user', 'countries', 'ports', 'com_info'));
        } else {
            $location =  request()->session()->get('location');
            $countryName =  request()->session()->get('countryName');
            if (isset($location['geoplugin_currencyCode']) && isset($location['geoplugin_currencyConverter']) && isset($countryName->id)) {
                return view('settings.user.profile', compact('location', 'user', 'countries', 'ports', 'com_info'));
            }else{
                unset($_SESSION['countryName']);
                unset($_SESSION['location']);
                return redirect()->route('front.countrySelect');
            }
        }
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
            $user = User::find(currentUserId());
            $user->name = $request->userName;
            $user->contact_no = $request->contactNumber;
            $user->port_id = $request->port_id;
            if ($request->has('image')) $user->image = $this->uploadImage($request->file('image'), 'uploads/admin');
            if ($user->save())
                return redirect()->back()->with(Toastr::success('Data Saved!', 'Success', ["positionClass" => "toast-top-right"]));
            else
                return redirect()->back()->withInput()->with(Toastr::error('Please try again!', 'Fail', ["positionClass" => "toast-top-right"]));
        } catch (Exception $e) {
            return redirect()->back()->withInput()->with(Toastr::error('Please try again!', 'Fail', ["positionClass" => "toast-top-right"]));
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function change_password()
    {
        if (currentUser() == 'user')
            countryIp();
        $location =  request()->session()->get('location');
        $countryName =  request()->session()->get('countryName');
        if (isset($location['geoplugin_currencyCode']) && isset($location['geoplugin_currencyConverter']) && isset($countryName->id)) {
            return view('settings.user.change_password', compact('location'));
        } else
            return view('settings.general.change_password');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function change_password_store(Request $request)
    {
        try {
            $user = User::find(currentUserId());
            if (Hash::check($request->oldpassword, $user->password)) {
                if ($request->password == $request->cpassword) {
                    if ($request->has('password') && $request->password)
                        $user->password = Hash::make($request->password);

                    if ($user->save())
                        return redirect()->back()->with(Toastr::success('Successfully updated!', 'Success', ["positionClass" => "toast-top-right"]));
                    else
                        return redirect()->back()->withInput()->with(Toastr::error('Please try again!', 'Fail', ["positionClass" => "toast-top-right"]));
                } else
                    return redirect()->back()->withInput()->with(Toastr::error('Both the password and confirm password fields value must be matched', 'Fail', ["positionClass" => "toast-top-right"]));
            } else
                return redirect()->back()->withInput()->with(Toastr::error('Old password dose not match!', 'Fail', ["positionClass" => "toast-top-right"]));
        } catch (Exception $e) {
            //dd($e);
            return redirect()->back()->withInput()->with(Toastr::error('Please try again!', 'Fail', ["positionClass" => "toast-top-right"]));
        }
    }


    /*Student Transfer */
    public function clientTransfer()
    {
        $allUser = User::with(['country','port'])->where('role_id', 4)->get();
        return view('client.clientTransfer', compact('allUser'));
    }
    public function clientExecutive(Request $request)
    {
        $old_ex = User::where('id', $request->id)->first();

        $ex_list = User::where('role_id', 3)->whereNot('id', '=', $old_ex->executiveId)->get();

        $old_ex_data = User::find($old_ex->executiveId);
        /*echo '<pre>';
            print_r($old_ex_data->toArray());die;*/
        if ($old_ex_data)
            $data = '
            <label for="curexId" class="col-sm-3">Old Executive</label>
            <div class="col-sm-9">
            <input type="text" class="form-control" value="' . $old_ex_data->name . '" readonly>
            <input type="hidden" class="form-control" value="' . $old_ex_data->id . '" name="curexId">
            </div>
        ';
        else
            $data = '
        <label for="curexId" class="col-sm-3">Old Executive</label>
        <div class="col-sm-9">
        <input type="text" class="form-control" value="ICARJAPAN" readonly>
        <input type="hidden" class="form-control" value="1" name="curexId">
        </div>';

        //return response()->json(array('data' => $ex_list));
        $data2 = '<label for="newexId" class="col-sm-3">To Executive</label>
                <div class="col-sm-9">
                <select class="js-example-basic-single form-control" id="newexId" name="newexId" required>
                <option value="">Select</option>';
        foreach ($ex_list as $e) {
            $data2 .= '<option value="' . $e->id . '">' . $e->name . '</option>';
        }
        $data2 .= '</select></div>';


        return response()->json(array('data' => $data, 'data2' => $data2));
    }
    public function clTransfer(Request $request)
    {
        //print_r($request->toArray());die;
        DB::beginTransaction();

        try {
            
            foreach($request->user_id as $user_id){
                //echo $user_id;die;
                $data = array(
                    'executiveId' => $request->newexId
                );
                DB::table('users')->where('id', $request->user_id)->update($data);
                $data2 = array(
                    'user_id' => $user_id,
                    'curexId' => $request->curexId,
                    'newexId' =>  $request->newexId,
                    'created_by' => currentUserId(),
                    'note' => $request->note,
                    'created_at' => Carbon::now()
                );
                DB::table('client_transfers')->insert($data2);

            }
            DB::commit();
            return redirect()->route(currentUser() . '.clientTransferList')->with(Toastr::success('Data Saved!', 'Success', ["positionClass" => "toast-top-right"]));
        } catch (\Exception $e) {
            DB::rollback();
            // something went wrong
            dd($e);
            return redirect()->back()->withInput()->with(Toastr::error('Please try again!', 'Fail', ["positionClass" => "toast-top-right"]));
            return false;
        }
    }
    public function clientTransferList()
    {
        $client_transfers = ClientTransfer::with(['user.country','prevExeutive','newexecutiveId'])->orderBy('id','desc')->paginate(50);

        /*DB::table('client_transfers')
            ->join('users', 'client_transfers.created_by', 'users.id')
            ->select('client_transfers.*', 'users.name as uname')*/


        return view('client.clientTransferList', compact('client_transfers'));
    }
    public function assignTo(Request $request)
    {
        $user = User::where('id', $request->user_id)->first();
        if (!$user->executiveId) {
            User::where('id', $request->user_id)->update(['executiveId' => currentUserId()]);
            return redirect()->back()->with(Toastr::success('Assigned to successful!', 'Success', ["positionClass" => "toast-top-right"]));
        } else
            return redirect()->back()->withInput()->with(Toastr::error('Please try again!', 'Fail', ["positionClass" => "toast-top-right"]));
    }
    public function freeUser(Request $request)
    {
        $user = User::where('id', $request->user_id)->first();
        $reserve_count = DB::table('reserved_vehicles')->where('user_id', $request->user_id)->where('status', 1)->count();
        if ($user->executiveId && $reserve_count == 0) {
            User::where('id', $request->user_id)->update(['executiveId' => null]);
            return redirect()->back()->with(Toastr::success('User Free Successfull!', 'Success', ["positionClass" => "toast-top-right"]));
        } else
            return redirect()->back()->withInput()->with(Toastr::error('Please try again!', 'Fail', ["positionClass" => "toast-top-right"]));
    }
    public function bulk_client_assign()
    {
        $allUser = User::with(['country','port'])->where('role_id', 4)->whereNull('executiveId')->get();
        return view('client.bulk_assign', compact('allUser'));
    }
}
