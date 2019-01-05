<?php
ini_set('display_errors'        , 'On');
ini_set('display_startup_errors', 'On');
ini_set('error_reporting'       , 'E_ALL | E_STRICT');
ini_set('track_errors'          , 'On');
ini_set('display_errors'        , 1);
error_reporting(E_ALL);
if ($_POST["JavadKhof"] != "Im") 
{
	die("sry");
}

include 'Class/Calender.php';
$calender = new Calender("Qom", "Iran", "Asia/Tehran", "hijri-shamsy");

$json = json_encode($calender->get_first_delay());
echo $json;
