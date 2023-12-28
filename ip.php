<?php
$user_ip = getenv('REMOTE_ADDR');
/*$location = json_encode(file_get_contents(""));

echo '<pre>';
print_r($location);*/

$ch = curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL, 'https://extreme-ip-lookup.com/json/'.$user_ip.'?key=9x9yyW5zMrdFwAKLH5jO');
$result = curl_exec($ch);
curl_close($ch);
$obj = json_decode($result);
print_r($obj);
echo $obj['country'];
?>