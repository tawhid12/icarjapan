<?php
$user_ip = getenv('REMOTE_ADDR');
$location =  unserialize(file_get_contents("https://extreme-ip-lookup.com/json/$user_ip?key=9x9yyW5zMrdFwAKLH5jO"));
echo '<pre>';
print_r($location);
?>