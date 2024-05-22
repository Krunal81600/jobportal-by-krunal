<?php

$ip = $_SERVER['REMOTE_ADDR']; 
$freegeoipjson = file_get_contents("http://freegeoip.net/json/". $ip ."");
$jsondata = json_decode($freegeoipjson);
$countryfromip = $jsondata->country_name;
$cityfromip = $jsondata->city;

echo $cityip = $cityfromip; 
?>
<br>
<?php
/*Get Country name by return array*/
echo $countryip = $countryfromip;
?>
