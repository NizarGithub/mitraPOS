<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
|	https://codeigniter.com/user_guide/general/routing.html
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
$route['default_controller'] 						= 'C_page_handling/PageLogin';
$route['404_override'] 								= 'C_page_handling/Page404';
$route['translate_uri_dashes'] 						= FALSE;

$route['Login']										= 'C_page_handling/PageLogin';
$route['Gate/(:any)']								= 'C_page_handling/$1';
$route['Gate/(:any)/(:any)']						= 'C_page_handling/$1/$2';
$route['Gate/(:any)/(:any)/(:any)']					= 'C_page_handling/$1/$2/$3';
$route['Dashboard']									= 'C_dashboard';
$route['Dashboard/(:any)']							= 'C_dashboard/$1';
$route['Dashboard/(:any)/(:any)']					= 'C_dashboard/$1/$2';
$route['Dashboard/(:any)/(:any)/(:any)']			= 'C_dashboard/$1/$2/$3';

$route['Library']									= 'library/C_kategori';
// $route['Library/Outlet']							= 'library/C_outlet';
// $route['Library/Outlet/(:any)']						= 'library/C_outlet/$1';
// $route['Library/Outlet/(:any)/(:any)']				= 'library/C_outlet/$1/$2';
// $route['Library/Outlet/(:any)/(:any)/(:any)']		= 'library/C_outlet/$1/$2/$3';
$route['Library/Kategori']							= 'library/C_kategori';
$route['Library/Kategori/(:any)']					= 'library/C_kategori/$1';
$route['Library/Kategori/(:any)/(:any)']			= 'library/C_kategori/$1/$2';
$route['Library/Kategori/(:any)/(:any)/(:any)']		= 'library/C_kategori/$1/$2/$3';
$route['Library/Item']								= 'library/C_item';
$route['Library/Item/(:any)']						= 'library/C_item/$1';
$route['Library/Item/(:any)/(:any)']				= 'library/C_item/$1/$2';
$route['Library/Item/(:any)/(:any)/(:any)']			= 'library/C_item/$1/$2/$3';
$route['Library/Diskon']							= 'library/C_diskon';
$route['Library/Diskon/(:any)']						= 'library/C_diskon/$1';
$route['Library/Diskon/(:any)/(:any)']				= 'library/C_diskon/$1/$2';
$route['Library/Diskon/(:any)/(:any)/(:any)']		= 'library/C_diskon/$1/$2/$3';
$route['Library/Pajak']								= 'library/C_pajak';
$route['Library/Pajak/(:any)']						= 'library/C_pajak/$1';
$route['Library/Pajak/(:any)/(:any)']				= 'library/C_pajak/$1/$2';
$route['Library/Pajak/(:any)/(:any)/(:any)']		= 'library/C_pajak/$1/$2/$3';
$route['Library/Gratuity']							= 'library/C_gratuity';
$route['Library/Gratuity/(:any)']					= 'library/C_gratuity/$1';
$route['Library/Gratuity/(:any)/(:any)']			= 'library/C_gratuity/$1/$2';
$route['Library/Gratuity/(:any)/(:any)/(:any)']		= 'library/C_gratuity/$1/$2/$3';

$route['Inventory']									= 'inventory/C_supplier';
$route['Inventory/Suppliers']						= 'inventory/C_supplier';
$route['Inventory/Suppliers/(:any)']				= 'inventory/C_supplier/$1';
$route['Inventory/Suppliers/(:any)/(:any)']			= 'inventory/C_supplier/$1/$2';
$route['Inventory/Suppliers/(:any)/(:any)/(:any)']	= 'inventory/C_supplier/$1/$2/$3';
$route['Inventory/Transfer']						= 'inventory/C_transfer';
$route['Inventory/Transfer/(:any)']					= 'inventory/C_transfer/$1';
$route['Inventory/Transfer/(:any)/(:any)']			= 'inventory/C_transfer/$1/$2';
$route['Inventory/Transfer/(:any)/(:any)/(:any)']	= 'inventory/C_transfer/$1/$2/$3';
$route['Inventory/Adjustment']						= 'inventory/C_adjustment';
$route['Inventory/Adjustment/(:any)']				= 'inventory/C_adjustment/$1';
$route['Inventory/Adjustment/(:any)/(:any)']		= 'inventory/C_adjustment/$1/$2';
$route['Inventory/Adjustment/(:any)/(:any)/(:any)']	= 'inventory/C_adjustment/$1/$2/$3';

$route['Customers']									= 'customers/C_customer';
$route['Customers/List']							= 'customers/C_customer';
$route['Customers/List/(:any)']						= 'customers/C_customer/$1';
$route['Customers/List/(:any)/(:any)']				= 'customers/C_customer/$1/$2';
$route['Customers/List/(:any)/(:any)/(:any)']		= 'customers/C_customer/$1/$2/$3';

$route['Employees']									= 'employees/C_employee_type';
$route['Employees/List']							= 'employees/C_employee';
$route['Employees/List/(:any)']						= 'employees/C_employee/$1';
$route['Employees/List/(:any)/(:any)']				= 'employees/C_employee/$1/$2';
$route['Employees/List/(:any)/(:any)/(:any)']		= 'employees/C_employee/$1/$2/$3';
$route['Employees/Type']							= 'employees/C_employee_type';
$route['Employees/Type/(:any)']						= 'employees/C_employee_type/$1';
$route['Employees/Type/(:any)/(:any)']				= 'employees/C_employee_type/$1/$2';
$route['Employees/Type/(:any)/(:any)/(:any)']		= 'employees/C_employee_type/$1/$2/$3';

$route['Outlets']									= 'outlets/C_outlet';
$route['Outlets/(:any)']							= 'outlets/C_outlet/$1';
$route['Outlets/(:any)/(:any)']						= 'outlets/C_outlet/$1/$2';
$route['Outlets/(:any)/(:any)/(:any)']				= 'outlets/C_outlet/$1/$2/$3';