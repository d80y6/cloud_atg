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


// ==========================cron==========================
$route['getRawLogs'] = 'base/getRawLogs';
$route['maintCheck'] = 'base/maintCheck';
$route['synch'] = 'base/synch';
$route['ibafonLogs'] = 'base/ibafonLogs';
$route['backup'] = 'base/backup';

$route['testMail'] = 'base/testMail';
// ==========================cron==========================




$route['getReordersByTank'] = 'base/getReordersByTank';

$route['company'] = 'base/company';
$route['generalCompany'] = 'base/generalCompany';
$route['getcoyNotifications'] = 'base/getcoyNotifications';

$route['getSysSettings'] = 'base/getSysSettings';




$route['station'] = 'base/station';
$route['generalStation'] = 'base/generalStation';
$route['getstatNotifications'] = 'base/getstatNotifications';

$route['login_submit'] = 'base/login_submit';
$route['logout'] = 'base/logout';
$route['login'] = 'base/login';

$route['settings'] = 'base/settings';
$route['getKAT'] = 'base/getKAT';
$route['addKAT'] = 'base/addKAT';
$route['editKAT'] = 'base/editKAT';
$route['getPCD'] = 'base/getPCD';
$route['addPCD'] = 'base/addPCD';
$route['editPCD'] = 'base/editPCD';
$route['profile'] = 'base/profile';

$route['actLogs_loadtable'] = 'base/actLogs_loadtable';
$route['actLogs_loadtable/(:any)'] = 'base/actLogs_loadtable/$1';
$route['actLog'] = 'base/actLog';
$route['actLog/(:any)'] = 'base/actLog/$1';


$route['notLogs_loadtable'] = 'base/notLogs_loadtable';
$route['notLogs_loadtable/(:any)'] = 'base/notLogs_loadtable/$1';
$route['notifications'] = 'base/notifications';
$route['notLog/(:any)'] = 'base/notLog/$1';


$route['general'] = 'base/general';
$route['generalDashLoad'] = 'base/generalDashLoad';
$route['getNotifications'] = 'base/getNotifications';
$route['deleteNotification/(:any)'] = 'base/deleteNotification/$1';
$route['toggleApprove/(:any)'] = 'base/toggleApprove/$1';

$route['companymgt'] = 'base/companymgt';
$route['companymgt/(:any)'] = 'base/companymgt/$1';
$route['companies_loadtable'] = 'base/companies_loadtable';
$route['companies_loadtable/(:any)'] = 'base/companies_loadtable/$1';
$route['approveCompany/(:any)'] = 'base/approveCompany/$1';
$route['deleteCompany/(:any)'] = 'base/deleteCompany/$1';
$route['disableCompany/(:any)'] = 'base/disableCompany/$1';
$route['enableCompany/(:any)'] = 'base/enableCompany/$1';
$route['addCompany'] = 'base/addCompany';
$route['getCompany'] = 'base/getCompany';
$route['editCompany'] = 'base/editCompany';
$route['getCompanies'] = 'base/getCompanies';

$route['stationmgt'] = 'base/stationmgt';
$route['stationmgt/(:any)'] = 'base/stationmgt/$1';
$route['stations_loadtable'] = 'base/stations_loadtable';
$route['stations_loadtable/(:any)'] = 'base/stations_loadtable/$1';
$route['deleteStation/(:any)'] = 'base/deleteStation/$1';
$route['disableStation/(:any)'] = 'base/disableStation/$1';
$route['enableStation/(:any)'] = 'base/enableStation/$1';
$route['addStation'] = 'base/addStation';
$route['getStation'] = 'base/getStation';
$route['editStation'] = 'base/editStation';
$route['getStations'] = 'base/getStations';


$route['controllermgt'] = 'base/controllermgt';
$route['controllermgt/(:any)'] = 'base/controllermgt/$1';
$route['controllers_loadtable'] = 'base/controllers_loadtable';
$route['controllers_loadtable/(:any)'] = 'base/controllers_loadtable/$1';
$route['deleteController/(:any)'] = 'base/deleteController/$1';
$route['disableController/(:any)'] = 'base/disableController/$1';
$route['enableController/(:any)'] = 'base/enableController/$1';
$route['addController'] = 'base/addController';
$route['getController'] = 'base/getController';
$route['editController'] = 'base/editController';
$route['getControllers'] = 'base/getControllers';


$route['tankmgt'] = 'base/tankmgt';
$route['tankmgt/(:any)'] = 'base/tankmgt/$1';
$route['tanks_loadtable'] = 'base/tanks_loadtable';
$route['tanks_loadtable/(:any)'] = 'base/tanks_loadtable/$1';
$route['deleteTank/(:any)'] = 'base/deleteTank/$1';
$route['disableTank/(:any)'] = 'base/disableTank/$1';
$route['enableTank/(:any)'] = 'base/enableTank/$1';
$route['addTank'] = 'base/addTank';
$route['getTank'] = 'base/getTank';
$route['editTank'] = 'base/editTank';
$route['getCurrentTankData'] = 'base/getCurrentTankData';
$route['calibrationImport/(:any)'] = 'base/calibrationImport/$1';
$route['getTankLogs'] = 'base/getTankLogs';
$route['gettankNotifications'] = 'base/gettankNotifications';
$route['dailyAvgs'] = 'base/dailyAvgs';



$route['usermgt'] = 'base/usermgt';
$route['usermgt/(:any)'] = 'base/usermgt/$1';
$route['users_loadtable'] = 'base/users_loadtable';
$route['users_loadtable/(:any)'] = 'base/users_loadtable/$1';
$route['deleteUser/(:any)'] = 'base/deleteUser/$1';
$route['disableUser/(:any)'] = 'base/disableUser/$1';
$route['enableUser/(:any)'] = 'base/enableUser/$1';
$route['addUser'] = 'base/addUser';
$route['getUser'] = 'base/getUser';
$route['editUser'] = 'base/editUser';

$route['landing'] = 'base/landing';


$route['default_controller'] = 'base';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
