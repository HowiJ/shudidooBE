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

//  System Default and 404
////////////////////////////////////////////////////////////////////
$route['default_controller'] = "main";
$route['404_override'] = '';
$route['setNonsetUserTags'] = "main/setNonsetUserTags";
////////////////////////////////////////////////////////////////////



//  Login & Registration
////////////////////////////////////////////////////////////////////
$route['checkLogin'] = "main/checkLogin";
$route['addUser'] = "main/register";
$route['json/addUser'] = "main/jsonRegister";
$route['logout'] = "main/logout";
$route['delete/(:any)'] = "main/deleteUser/$1";
////////////////////////////////////////////////////////////////////




//  Add User Tag & Add Activity Tag
////////////////////////////////////////////////////////////////////
$route['addTag'] = "main/addTag";
// $route['addTag'] = "main/getTasksByName";                   //All Tags
$route['addActivity'] = "main/addActivity";

$route['addUserTag'] = "main/addUserTag";
$route['addActivityTag'] = "main/addActivityTag";
////////////////////////////////////////////////////////////////////






//  Tasks
////////////////////////////////////////////////////////////////////
$route['addTasks'] = "main/addOneTask";
$route['addBulkTasks'] = "main/addTasks";
$route['json/tasks'] = "main/getTasksByName";           //json Tasks for a user
$route['deleteTask/(:any)'] = "main/deleteAllTask/$1";
////////////////////////////////////////////////////////////////////






//  Craziness
////////////////////////////////////////////////////////////////////
$route['getBulkActivities/(:any)'] = "task/index/$1";
////////////////////////////////////////////////////////////////////







//  json encrypted data for GET
////////////////////////////////////////////////////////////////////
$route['json/users'] = "main/allUsers";                 //All Users
$route['json/tags'] = "main/allTags";                   //All Tags
$route['json/activities'] = "main/allActivities";       //All Activities
$route['json/usertags'] = "main/allUserTags";           //All User Tags
$route['json/activitytags'] = "main/allActivityTags";   //All Activity Tags

$route['json/login'] = "main/jsonCheckLogin";           //Login for json
////////////////////////////////////////////////////////////////////


/* End of file routes.php */
/* Location: ./application/config/routes.php */
