<?php
$user_ip = getenv('REMOTE_ADDR');
$api_url = "https://extreme-ip-lookup.com/json/$user_ip?key=9x9yyW5zMrdFwAKLH5jO";

// Fetch JSON data from the API
$jsonData = file_get_contents($api_url);

// Convert JSON data to array
$location = json_decode($jsonData, true);
$currency_data = array(
    'geoplugin_status' => 200,
    'geoplugin_currencyCode' => 'USD',
    'geoplugin_currencyConverter' => 0,
);
$location = array_merge($location, $currency_data);
// Check if decoding was successful
if ($location !== null) {
    echo '<pre>';
    print_r($location);
} else {
    echo 'Error decoding JSON data.';
}

?>