<?php
$message="hi";
$to="tawhid8995@gmail.com";
$sub='Subject of the Mail';
//$headers = "MIME-Version: 1.0" . "\r\n";
//$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
//$headers .= "From:tawhid8995@gmail.com\r\n";
mail($to,$sub,$message); 
?>