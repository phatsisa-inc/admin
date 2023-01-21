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

/*Default Routes*/
$route['default_controller'] = 'login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

/*Dasboard Routes*/
$route['signout'] = 'login/signout';
$route['dashboard'] = 'dashboard/home';
$route['order'] = 'dashboard/order_view';
$route['driver'] = 'dashboard/driver_view';
$route['customer'] = 'dashboard/customer_view';
$route['report'] = 'dashboard/report_view';
$route['profile'] = 'dashboard/profile';
$route['fetchuser'] = 'dashboard/fetch_single_user';
$route['editpassword'] = 'dashboard/updateUser_Password';
$route['sendemail'] = 'dashboard/sendEmail';

/*Customer Routes*/
$route['addcustomer'] = 'customer/addCustomer';
$route['getcustomer'] = 'customer/findCustomer';
$route['getcustomers'] = 'customer/getCustomers';
$route['fetchcustomer'] = 'customer/fetch_single_customer';
$route['editcustomer'] = 'customer/editCustomer';
$route['deletecustomer'] = 'customer/delete_single_customer';

/*Order Routes*/
$route['addorder'] = 'order/addOrder';
$route['loadneworder'] = 'order/getNewOrders';
$route['loadattendedorder'] = 'order/getAttendedOrders';
$route['fetchorder'] = 'order/fetch_single_order';
$route['assigndriver'] = 'order/fetch_assign_drivers';
$route['orderdriver'] = 'order/assignDriver';
$route['editorder'] = 'order/editOrder';
$route['deleteorder'] = 'order/delete_single_order';
$route['restoreorder'] = 'order/restore_single_order';
$route['claimorders'] = 'order/claimDriverOrders';

/*Driver Routes*/
$route['adddriver'] = 'driver/addDriver';
$route['getdrivers'] = 'driver/getDrivers';
$route['getdriverclaims'] = 'driver/getDriverClaims';
$route['fetchdriver'] = 'driver/fetch_single_driver';
$route['editdriver'] = 'driver/editDriver';
$route['deletedriver'] = 'driver/delete_single_driver';
$route['driverclaims'] = 'driver/driverClaims_view';
$route['fetchdriverclaims'] = 'driver/getClaims';

/*Reports Routes*/
$route['addadmin'] = 'report/addAdmin';
$route['fetchunclaimed'] = 'report/getUnclaimedOrders';
$route['fetchclaimed'] = 'report/getClaimedOrders';
$route['fetchdeleted'] = 'report/getDeletedOrders';
$route['fetchcompleted'] = 'report/getCompletedOrders';
$route['exportunclaimed'] = 'report/exportUnclaimedOrders';
$route['exportclaimed'] = 'report/exportClaimedOrders';
$route['exportdeleted'] = 'report/exportDeletedOrders';


