<?php
$arrContextOptions=array(
    "ssl"=>array(
        "verify_peer"=>false,
        "verify_peer_name"=>false,
    ),
); 
	echo file_get_contents("https://www.geoplugin.com/ip.php", false, stream_context_create($arrContextOptions));
?>