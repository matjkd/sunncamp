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

$route['default_controller'] = "welcome";
$route['about'] = '/welcome/home';
$route['menu'] = 'menus/list_menus';
$route['testimonials'] = '/welcome/home';
$route['events'] = '/welcome/home';
$route['brochures'] = '/welcome/home';
$route['contact'] = '/welcome/home';
$route['social'] = '/welcome/home';
$route['terms'] = '/welcome/home';
$route['warranty'] = '/welcome/home';
$route['privacy'] = '/welcome/home';
$route['delivery'] = '/welcome/home';
$route['sitemap'] = '/welcome/home';
$route['jobs'] = '/welcome/home';
$route['news'] = '/welcome/home';
$route['login'] = '/welcome/login';
$route['stockists'] = '/welcome/home';
$route['instruction_manuals'] = '/welcome/instruction_manuals';
$route['services'] = '/welcome/home';
$route['trade_reviews'] = '/welcome/trade_reviews';
$route['faq'] = '/welcome/home';
$route['404_override'] = '';


/* End of file routes.php */
/* Location: ./application/config/routes.php */
