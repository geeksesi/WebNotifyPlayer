<?php
ini_set('display_errors'        , 'On');
ini_set('display_startup_errors', 'On');
ini_set('error_reporting'       , 'E_ALL | E_STRICT');
ini_set('track_errors'          , 'On');
ini_set('display_errors'        , 1);
error_reporting(E_ALL);


define('VIEW_DIR', __DIR__.'/app/view/');
define('CONTROLLER_DIR', __DIR__.'/app/controller/');
define('MODEL_DIR', __DIR__.'/app/model/');
define('IMAGE_DIR', __DIR__.'/assets/img/');
define('MUSIC_DIR', __DIR__.'/assets/music/');
define('JS_DIR', __DIR__.'/assets/js/');
 
if (!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] != "on") 
{ 
    $port = "http://";
}
else
{
  $port = "https://";
}
$web_url = $port.$_SERVER["SERVER_NAME"]."/"; 
 
require_once('include.php');

$model = new Model();
$view = new View();
$controller = new Controller();
