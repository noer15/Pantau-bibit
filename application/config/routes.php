<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] 	= 'MainController';

// login
$route['logout'] 			 	= 'AuthController/logout';

$route['login'] 			 	= 'AuthController';
$route['login/action']    		= 'AuthController/login';


// category
$route['category']    			= 'CategoryController';






$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
