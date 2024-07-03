<?php
use App\Models\Settings\Country;
use App\Models\Vehicle\Vehicle;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Log;
// function countryIp(){
//     if ($_SERVER['REMOTE_ADDR']) {
//         $location = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip=' . $_SERVER['REMOTE_ADDR']));
//         /*echo '</pre>';
//         print_r($location);die;*/
//         if($location['geoplugin_status'] != 404){
//             Log::info($location);
//             $location = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip=' . $_SERVER['REMOTE_ADDR']));
//             $current_locale_data = Carbon::now($location['geoplugin_timezone']);
//             $countryName = Country::where('code', $location['geoplugin_countryCode'])->first();
//             session()->put('countryName', $countryName);
//             session()->put('location', $location);
//             session()->put('current_locale_data', $current_locale_data);

//             // Check if there is a requested URL in the session
//             session()->put('requestedUrl', url()->current());
//             $requestedUrl = session()->get('requestedUrl');
//             if ($requestedUrl) {
                
//                 echo "<script> window.location.href= ' $requestedUrl ' </script>";
//                 //return redirect()->to($requestedUrl);
//                 // If a requested URL is found in the session, redirect to it
//                 //return Redirect::to($requestedUrl);
//             }else{
//                 unset($_SESSION['countryName']);
//                 unset($_SESSION['location']);
//                 return redirect()->route('front.countrySelect');
//             }
//         }else{
//             unset($_SESSION['countryName']);
//             unset($_SESSION['location']);
//             return redirect()->route('front.countrySelect');
//         }
//     }else{
//             unset($_SESSION['countryName']);
//             unset($_SESSION['location']);
//             return redirect()->route('front.countrySelect');
//         }
// }

function countryIp(){
    $user_ip = getenv('REMOTE_ADDR') /*'122.152.53.35'*/;
    $api_url = "https://extreme-ip-lookup.com/json/$user_ip?key=9x9yyW5zMrdFwAKLH5jO";
    // Fetch JSON data from the API
    $jsonData = file_get_contents($api_url);
    $location = json_decode($jsonData, true);
    if ($user_ip) {
        if(isset($location)){
            if(isset($location['status']) && $location['status'] == 'success'){
                Log::info($location);
                if($location['timezone'] == 'SG')
                $current_locale_data = Carbon::now('Asia/Singapore');
                elseif($location['timezone'] == 'US')
                $current_locale_data = Carbon::now('America/New_York');
                elseif($location['timezone'] == 'BD')
                $current_locale_data = Carbon::now('Asia/Dhaka');
                else
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
    
                // Check if there is a requested URL in the session
                session()->put('requestedUrl', url()->current());
                $requestedUrl = session()->get('requestedUrl');
                if ($requestedUrl) {
                    echo "<script> window.location.href= ' $requestedUrl ' </script>";
                    // If a requested URL is found in the session, redirect to it
                    //return Redirect::to($requestedUrl);
                }else{
                    unset($_SESSION['countryName']);
                    unset($_SESSION['location']);
                    return redirect()->route('front.countrySelect');
                }
            }else{
                unset($_SESSION['countryName']);
                unset($_SESSION['location']);
                return redirect()->route('front.countrySelect');
            }
        }else{
            unset($_SESSION['countryName']);
            unset($_SESSION['location']);
            return redirect()->route('front.countrySelect');
        }
    }else{
        unset($_SESSION['countryName']);
        unset($_SESSION['location']);
        return redirect()->route('front.countrySelect');
    }
}
function Replace($data) {
    $data = str_replace("!", "", $data);
    $data = str_replace("@", "", $data);
    $data = str_replace("#", "", $data);
    $data = str_replace("$", "", $data);
    $data = str_replace("%", "", $data);
    $data = str_replace("^", "", $data);
    $data = str_replace("&", "", $data);
    $data = str_replace("*", "", $data);
    $data = str_replace("(", "", $data);
    $data = str_replace(")", "", $data);
    $data = str_replace("?", "", $data);
    $data = str_replace("+", "", $data);
    $data = str_replace("=", "", $data);
    $data = str_replace(",", "", $data);
    $data = str_replace(":", "", $data);
    $data = str_replace(";", "", $data);
    $data = str_replace("|", "", $data);
    $data = str_replace("'", "", $data);
    $data = str_replace('"', "", $data);
    $data = str_replace("  ", "-", $data);
    $data = str_replace(" ", "-", $data);
    $data = str_replace(".", "-", $data);
    $data = str_replace("__", "-", $data);
    $data = str_replace("_", "-", $data);
    return strtolower($data);
 }

 

function encryptor($action, $string) {
    $output = false;

    $encrypt_method = "AES-256-CBC";
        //pls set your unique hashing key
    $secret_key = 'beatnik#technolgoy_sampreeti';
    $secret_iv = 'beatnik$technolgoy@sampreeti';

        // hash
    $key = hash('sha256', $secret_key);

        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
    $iv = substr(hash('sha256', $secret_iv), 0, 16);

        //do the encyption given text/string/number
    if( $action == 'encrypt' ) {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    }
    else if( $action == 'decrypt' ){
            //decrypt the given text/string/number
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }
    return $output;
}


// The function to count words in Unicode  strings
function countUnicodeWords( $unicode_string ){
    // First remove all the punctuation marks & digits
    $unicode_string = preg_replace('/[[:punct:][:digit:]]/', '', $unicode_string);
    // Now replace all the whitespaces (tabs, new lines, multiple spaces) by single space
    $unicode_string = preg_replace('/[[:space:]]/', ' ', $unicode_string);
    // The words are now separated by single spaces and can be splitted to an array
    // I have included \n\r\t here as well, but only space will also suffice
    $words_array = preg_split( "/[\n\r\t ]+/", $unicode_string, 0, PREG_SPLIT_NO_EMPTY );
    // Now we can get the word count by counting array elments
    return count($words_array);
}
  
  
  
function limitWordShow($string, $word_limit)
{
    $words = explode(" ",$string);
    return implode(" ", array_splice($words, 0, $word_limit));
}

function currentUserId(){
	return encryptor('decrypt', request()->session()->get('userId'));
}

function currentUser(){
	return encryptor('decrypt', request()->session()->get('roleIdentity'));
}

function company(){
    return ['company_id' => encryptor('decrypt', Session::get('companyId'))];
}
function companyAccess(){
    return encryptor('decrypt', Session::get('companyAccess'));
}



function invoice(){
	return [
		['image'=>'','link'=>''],
		['image'=>'','link'=>'']
	];
}

function get_cancel_date(){
   
    //echo $get_cancel_date;die;
    $rsv = DB::table('reserved_vehicles')
    ->join('vehicles','reserved_vehicles.vehicle_id','vehicles.id')
    ->where('vehicles.r_status',1)->where('vehicles.sold_status',0)
    ->select('reserved_vehicles.created_at','vehicles.id','reserved_vehicles.user_id')
    ->get();
    $cancel_day = (int)\App\Models\CompanyAccountInfo::first()->reserve_cancel;
    foreach($rsv as $r){
        if (Carbon::today() > Carbon::parse($r->created_at)) {
            $resv = \App\Models\ReservedVehicle::where('vehicle_id',$r->id)->update(['status' => 3,'note' => "Reserved Date Exapired!!"]);
            $vehicle = \App\Models\Vehicle\Vehicle::where('id',$r->id)->update(['r_status'=>null]);

            $user = \App\Models\User::where('id',$r->user_id)->update(['type'=>null]);
        }else{
            return redirect()->back()->withInput()->with(Toastr::error('Reservation Exists!', 'Fail', ["positionClass" => "toast-top-right"]));
        }
    }
}

function client_status($id){
    $count_active_reserve =  $rsv = DB::table('reserved_vehicles')
    ->join('users','reserved_vehicles.user_id','users.id')
    ->join('vehicles','reserved_vehicles.vehicle_id','vehicles.id')
    ->where('vehicles.r_status',1)->where('vehicles.sold_status',0)
    ->where('users.id',$id)
    ->count();

    $purchase_count =  $rsv = DB::table('reserved_vehicles')
    ->join('users','reserved_vehicles.user_id','users.id')
    ->join('vehicles','reserved_vehicles.vehicle_id','vehicles.id')
    ->where('vehicles.r_status',1)->where('vehicles.sold_status',1)
    ->where('users.id',$id)
    ->count();
}
