<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "hudobniny";
$route['home'] = "hudobniny";
$route['about'] = "hudobniny/about";
$route['login'] = "auth/login";
$route['logout'] = "auth/logout";
$route['registration'] = "auth/registration";
$route['reg_validation'] = "auth/reg_validation";
$route['login_validation'] = "auth/login_validation";
$route['update_profile'] = "profile/update_profile";
$route['change_password'] = "profile/change_password";
$route['upload_profile_img'] = "profile/upload_profile_img";
$route['activate_acc'] = "auth/activate_acc";
$route['view_succ_activate'] = "auth/view_succ_activate"; 
$route['forgotten_pass'] = "auth/forgotten_pass";
$route['send_forgotten_pass'] = "auth/send_forgotten_pass"; 
$route['products'] = "products";
$route['add_sub'] = "products/add_sub";
$route['add_new_prod'] = "products/add_new_product";



$route['404_override'] = '';


/* End of file routes.php */
/* Location: ./application/config/routes.php */