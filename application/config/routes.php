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
$route['default_controller'] = 'welcome';
$route['404_override'] = 'error_404';
$route['translate_uri_dashes'] = FALSE;

$route['welcome']='admin/admin';
$route['admin'] = 'admin/login';



//Frontend URL's
$route['auditorium'] = 'front/auditorium';
$route['newsandevents'] = 'front/newsevents/list';
$route['detail/(:any)/view'] = 'front/newsevents/details/$1';

$route['professor/scheduled/meetings/(:any)'] = 'front/professor/scheduledmeeting/$1';
$route['expert/scheduled/meetings/(:any)'] = 'front/experts/scheduledmeeting/$1';
$route['presentations'] = 'front/presentations';

$route['student/registration'] = 'front/students/registration';
$route['student/verifyOTP'] = 'front/students/verifyOTP';
$route['student/eventBag'] = 'front/eventsbag';
$route['student/eventBag/(:any)/view'] = 'front/eventsbag/eventbag_view/$1';
//$route['student/chat'] = 'student/chat';
$route['experts'] = 'front/experts';
$route['expert/profile/(:any)'] = 'front/experts/details/$1';

$route['espeakers'] = 'front/speakers/index';
$route['speakers'] = 'front/speakers/eminentspeakers';
$route['speaker/profile/(:any)'] = 'front/speakers/details/$1';

$route['professor'] = 'front/professor';
$route['professor/profile/(:any)'] = 'front/professor/details/$1';

$route['institute/registration'] = 'front/institutes/registration';
$route['institute/verifyOTP'] = 'front/institutes/verifyOTP';
//$route['exhibitors'] = 'front/institutes/listold';//old exhibitors
$route['exhibitors/(:any)'] = 'front/institutes/institute_view/$1';
$route['exhibitors/(:any)/video'] = 'front/institutes/video/$1';
$route['exhibitors/(:any)/gallery'] = 'front/institutes/gallery/$1';
$route['exhibitors/(:any)/programmefee'] = 'front/institutes/programmefee/$1';
$route['exhibitors/(:any)/achievements'] = 'front/institutes/achievements/$1';
$route['exhibitors/(:any)/admission'] = 'front/institutes/admission/$1';
$route['exhibitors/(:any)/apply'] = 'front/institutes/apply/$1';
$route['exhibitors/(:any)/feedback'] = 'front/institutes/feedback/$1';
$route['exhibitors/(:any)/counsellors'] = 'front/institutes/counsellors/$1';
$route['exhibitors/profile/(:any)'] = 'front/institutes/profile/$1';
$route['exhibitors/(:any)/placements'] = 'front/institutes/placements/$1';
$route['institute/details'] = 'front/institutes/details';
$route['exhibitors'] = 'front/institutes/list';
$route['eventschedule'] = 'front/webinars/list';

$route['professor/registration'] = 'front/professor/registration';
$route['professor/verifyOTP'] = 'front/professor/verifyOTP';
$route['expert/registration'] = 'front/experts/registration';
$route['expert/verifyOTP'] = 'front/experts/verifyOTP';
$route['speaker/registration'] = 'front/speakers/registration';
$route['speaker/verifyOTP'] = 'front/speakers/verifyOTP';
//$route['(:any)']='user/page';
//$route['(:any)/forgot']='user/page/forgot';
//$route['(:any)/test/(:any)/(:any)']='user/page/test/$1/$2';
$route['termsandconditions'] = 'welcome/termsandconditions';
$route['disclaimer'] = 'welcome/disclaimer';
$route['privacypolicy'] = 'welcome/privacypolicy';
$route['cancellation'] = 'welcome/cancellation';
$route['user/login'] = 'admin/login';
$route['user/admin/dashboard'] = 'admin/dashboard';