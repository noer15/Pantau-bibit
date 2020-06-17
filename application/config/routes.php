<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] 			= 'MainController';

// login
$route['logout'] 			 			= 'AuthController/logout';

$route['login'] 			 			= 'AuthController';
$route['login/action']    				= 'AuthController/login';


// category
$route['category']    					= 'CategoryController';
$route['category/add_action']    		= 'CategoryController/add_action';
$route['category/update']    			= 'CategoryController/update';
$route['category/delete/(:num)']   		= 'CategoryController/delete/$1';



// jenis bibit
$route['jenis']    						= 'JenisController';
$route['jenis/update']    				= 'JenisController/update';
$route['jenis/add_action']    			= 'JenisController/add_action';
$route['jenis/delete/(:num)']    		= 'JenisController/delete/$1';





// sumbang bibit
$route['sumbang/testing']    			= 'SumbangController/testing';


$route['sumbang']    					= 'SumbangController';
$route['sumbang/kabupaten']    			= 'SumbangController/kabupaten';
$route['sumbang/kecamatan']    			= 'SumbangController/kecamatan';
$route['sumbang/desa']    				= 'SumbangController/desa';


$route['sumbang/add']    				= 'SumbangController/add';
$route['sumbang/edit/(:num)']    		= 'SumbangController/edit/$1';
$route['sumbang/delete/(:num)']    		= 'SumbangController/delete/$1';
$route['sumbang/add_action']    		= 'SumbangController/add_action';
$route['sumbang/update']    			= 'SumbangController/update';

// laporan
$route['laporan']    					= 'LaporanController';
$route['laporan/provinsi']    			= 'LaporanController/provinsi';
$route['laporan/kabupaten']    			= 'LaporanController/kabupaten';
$route['laporan/kecamatan']    			= 'LaporanController/kecamatan';
$route['laporan/desa']    				= 'LaporanController/desa';






$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
