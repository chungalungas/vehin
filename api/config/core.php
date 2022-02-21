<?php
error_reporting(E_ALL);
date_default_timezone_set('America/Mexico_City');

include_once 'libs/php-jwt/BeforeValidException.php';
include_once 'libs/php-jwt/ExpiredException.php';
include_once 'libs/php-jwt/SignatureInvalidException.php';
include_once 'libs/php-jwt/JWT.php';
include_once 'libs/php-jwt/Key.php';

header("Access-Control-Allow-Origin: http://localhost/api/");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

function load_model($class_name)
{
	$path_to_file = 'objects/' . $class_name . '.php';
	if (file_exists($path_to_file)) {
		require $path_to_file;
	}
}
// auto load required classes
spl_autoload_register('load_model');
?>