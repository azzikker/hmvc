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

//admin
$route['admin'] = "admin/admin";
//admin login/logout
$route['user/login'] = "user/user_login";
$route['user/register'] = "user/user_register";
$route['user/save'] = "user/user_register/saveregister";
$route['user/dologin'] = "user/user_login/checklogin";
$route['user/logout'] = "user/user_login/dologout";

//vigdeals frontend start
$route['past_deals'] = "vigdeals/vigdealswauth/pastdeals";
$route['past_deals/(:any)'] = "vigdeals/vigdealswauth/pastdeals_view/(:any)";
$route['how_it_works'] = "vigdeals/howitworks";
$route['about_us'] = "vigdeals/aboutus";
$route['account'] = "vigdeals/vigdealswauth/profile";
$route['order'] = "vigdeals/vigdealswauth/order";
$route['order/(:any)'] = "vigdeals/vigdealswauth/orderpage/(:any)";
$route['deal/(:any)'] = "vigdeals/view/(:any)";
$route['buy/(:any)'] = "vigdeals/vigdealswauth/profile/(:any)";
$route['category/(:any)'] = "vigdeals/index/(:any)";
$route['past-category/(:any)'] = "vigdeals/vigdealswauth/pastdeals/(:any)";
$route['review'] = "vigdeals/vigdealswauth/review";
$route['payment'] = "vigdeals/vigdealswauth/payment";
$route['payment2'] = "vigdeals/vigdealswauth/payment2";
$route['account/edit'] = "vigdeals/vigdealswauth/profile_edit";
$route['confirmation'] = "vigdeals/vigdealswauth/finish";
$route['print/(:any)'] = "vigdeals/vigdealswauth/printvouch/(:any)";
$route['invite'] = "vigdeals/vigdealswauth/invitefriends";
$route['invitenow'] = "vigdeals/vigdealswauth/invitefriendsnow";
$route['invited'] = "vigdeals/vigdealswauth/invitedfriends";
$route['recommend'] = "vigdeals/vigdealswauth/recommenddeal";
$route['recommends'] = "vigdeals/vigdealswauth/recommendnow";
$route['recommended/(:any)'] = "vigdeals/vigdealswauth/recommended/(:any)";
$route['recommended-deals'] = "vigdeals/vigdealswauth/recommendeddeals";
//vigdeals frontend end
//vigdeals mobile start
$route['mobile/category/(:any)'] = "mobile/index/(:any)";
$route['mobile/deal/(:any)'] = "mobile/view/(:any)";
$route['mobile/account'] = "mobile/profile";
$route['mobile/account/edit'] = "mobile/mobile_profile/edit";
$route['mobile/account/update'] = "mobile/mobile_profile/update";
$route['mobile/account/save'] = "mobile/mobile_profile/save";
$route['mobile/orders'] = "mobile/orders";
$route['mobile/orders/(:any)'] = "mobile/orders/(:any)";
$route['mobile/past_deals'] = "mobile/pastdeals";
$route['mobile/past-category/(:any)'] = "mobile/pastdeals/(:any)";
$route['mobile/past_deals/(:any)'] = "mobile/pastdeals_view/(:any)";
$route['mobile/review'] = "mobile/review";
$route['mobile/buy/(:any)'] = "mobile/review/(:any)";
$route['mobile/buys/(:any)'] = "mobile/review2/(:any)";
$route['mobile/payment'] = "mobile/payment";
$route['mobile/payment2'] = "mobile/payment2";
$route['mobile/print/(:any)'] = "mobile/printvouch/(:any)";
//vigdeals mobile end
$route['default_controller'] = "vigdeals";
$route['404_override'] = '';


/* End of file routes.php */
/* Location: ./application/config/routes.php */
