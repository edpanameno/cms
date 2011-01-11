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
| 	example.com/class/method/id/
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
| There are two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['scaffolding_trigger'] = 'scaffolding';
|
| This route lets you set a "secret" word that will trigger the
| scaffolding feature for added security. Note: Scaffolding must be
| enabled in the controller in which you intend to use it.   The reserved 
| routes must come before any wildcard or regular expression routes.
|
*/

$route['default_controller'] = "home";
$route['scaffolding_trigger'] = "";

// Admin Routing
// $route['admin/users'] = 'admin/home/index';
$route['admin/user/deactivate/(:num)'] = 'admin/home/deactivate_user/$1';
$route['admin/user/activate/(:num)'] = 'admin/home/activate_user/$1';
$route['admin/user/edit/(:num)'] = 'admin/home/edit_user/$1';
$route['admin/user/create'] = 'admin/home/create_user';
$route['admin/user/reset_password'] = 'admin/home/reset_password';

// User Routing
$route['user/change_password'] = 'user/home/change_password';
$route['user/change_info'] = 'user/home/change_info';

// Project
$route['projects/create'] = 'projects/home/create';
$route['projects/(:num)/([a-z_A-Z0-9.]+)'] = 'projects/home/index/$1/$2';

// Wiki
$route['projects/(:num)/([0-9a-z_A-Z0-9.]+)/wiki'] = 'projects/wiki/index/$1/$2';

// Trac
$route['projects/(:num)/([0-9a-z_A-Z0-9.]+)/trac'] = 'projects/trac/index/$1/$2';
$route['projects/(:num)/([0-9a-z_A-Z0-9.]+)/trac/new_ticket'] = 'projects/trac/new_ticket/$1/$2';
$route['projects/(:num)/([0-9a-z_A-Z0-9.]+)/trac/(:num)'] = 'projects/trac/view_ticket/$3/$2';
$route['projects/(:num)/([0-9a-z_A-Z0-9.]+)/trac/(:num)/new_note'] = 'projects/trac/new_ticket_note/$3/$2/$1';

/* End of file routes.php */
/* Location: ./system/application/config/routes.php */
