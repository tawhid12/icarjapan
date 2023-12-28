<?php
$user_ip = getenv('REMOTE_ADDR');
$api_url = "https://extreme-ip-lookup.com/json/$user_ip?key=9x9yyW5zMrdFwAKLH5jO";

// Fetch JSON data from the API
$jsonData = file_get_contents($api_url);

// Convert JSON data to array
$location = json_decode($jsonData, true);

// Check if decoding was successful
if ($location !== null) {
    echo '<pre>';
    print_r($location);
} else {
    echo 'Error decoding JSON data.';
}

?>