<?php
defined('BASEPATH') or exit('No direct script access allowed');

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
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

/**
 * Admin Panel Routes
 */
$route['v1/panel/login'] = 'v1/backend/AuthController/login';
$route['v1/panel/register'] = 'v1/backend/AuthController/register';
$route['v1/panel/current-user'] = 'v1/backend/AuthController/currentUser';
$route['v1/panel/users'] = 'v1/backend/AuthController/user';
$route['v1/panel/users/(:num)'] = 'v1/backend/AuthController/user/$1';

// SETTINGS
$route['v1/panel/settings/(:num)'] = 'v1/backend/SettingsController/index/$1';
$route['v1/panel/settings/save'] = 'v1/backend/SettingsController/save';
$route['v1/panel/settings/update/(:num)'] = 'v1/backend/SettingsController/update/$1';
$route['v1/panel/settings/delete/(:num)'] = 'v1/backend/SettingsController/delete/$1';

// EMAIL SETTINGS
$route['v1/panel/emailsettings/(:num)'] = 'v1/backend/EmailSettingsController/index/$1';
$route['v1/panel/emailsettings/save'] = 'v1/backend/EmailSettingsController/save';
$route['v1/panel/emailsettings/update/(:num)'] = 'v1/backend/EmailSettingsController/update/$1';
$route['v1/panel/emailsettings/delete/(:num)'] = 'v1/backend/EmailSettingsController/delete/$1';

/**
 * User Panel Routes
 */
$route['v1/login'] = 'v1/frontend/AuthController/login';
$route['v1/register'] = 'v1/frontend/AuthController/register';
$route['v1/current-user'] = 'v1/frontend/AuthController/currentUser';
$route['v1/users'] = 'v1/frontend/AuthController/user';
$route['v1/users/(:num)'] = 'v1/frontend/AuthController/user/$1';
