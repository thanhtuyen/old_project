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
|	http://codeigniter.com/user_guide/general/routing.html
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

$route['404_override']                  = 'error/error_404';
$route['errors/sp']                     = 'user/error/sp';
//USER--------------------------------------------------------------

$route['translate_uri_dashes']          = FALSE;
$route['default_controller']            = 'Index/index';

//U_3
$route['api/lp_hv']                     = "user/api/lp_hv";
//U_3
$route['job/detail/(:num)']             = "user/job/detail/$1";

$route['job/preview/(:num)']            = "user/job/preview/$1";

//U_2
$route['search']                        = "user/job/search";

//nursery list for user
//shisetsu
$route['shisetsu/a'] = "user/nursery/phonetic_list/a/";
$route['shisetsu/ka'] = "user/nursery/phonetic_list/ka/";
$route['shisetsu/sa'] = "user/nursery/phonetic_list/sa/";
$route['shisetsu/ta'] = "user/nursery/phonetic_list/ta/";
$route['shisetsu/na'] = "user/nursery/phonetic_list/na/";
$route['shisetsu/ha'] = "user/nursery/phonetic_list/ha/";
$route['shisetsu/ma'] = "user/nursery/phonetic_list/ma/";
$route['shisetsu/ya'] = "user/nursery/phonetic_list/ya/";
$route['shisetsu/ra'] = "user/nursery/phonetic_list/ra/";
$route['shisetsu/wa'] = "user/nursery/phonetic_list/wa/";
$route['shisetsu/(:num)']     = "user/nursery/nursery_detail/$1";
$route['shisetsu/(:num)/job']                        = "user/nursery/job/$1";
$route['shisetsu']                        = "user/nursery/phonetic_list";
$route['search_by_station']             = "user/search/search";
$route['station_select']             = "user/search/station_select";
$route['search_condition']             = "user/search/search_condition";
$route['search_condition/(:num)']             = "user/search/search_condition/$1";
$route['railway/line_(:num)']           = "user/search/station_select/$1";
$route['railway/list_station(:num)']   = "user/search/search_by_single_station/$1";
$route['railway/list_station(:num)/(:any)']   = "user/search/search_by_single_station/$1/$2";
$route['railway/list_station(:num)/(:any)/(:any)']   = "user/search/search_by_single_station/$1/$2/$3";
$route['railway/list_station(:num)/(:any)/(:any)/(:any)']   = "user/search/search_by_single_station/$1/$2/$3/$4";
$route['railway/list_station(:num)/(:any)/(:any)/(:any)/(:any)']   = "user/search/search_by_single_station/$1/$2/$3/$4/$5";

//都道府県特集ページをここに
// $route['p_([a-z]+)']                    = "";
//U_1->U_2


$route['p_(:any)']                      = "user/job/search_area/$1";
// $route['p_(:any)']                    = "user/job/parse_search_segment/";
//$route['p_(:any)']                      = "user/job/search_area/$1";

// $route['p_(:any)']                    = "user/job/parse_search_segment/";
$route['p_(:any)/list_(:any)']                    = "user/job/parse_search_segment/";
$route['p_(:any)/list_(:any)/list_(:any)']                    = "user/job/parse_search_segment/";
$route['p_(:any)/list_(:any)/list_(:any)/list_(:any)']                    = "user/job/parse_search_segment/";
$route['p_(:any)/list_(:any)/list_(:any)/list_(:any)/list_(:any)']                    = "user/job/parse_search_segment/";
$route['p_(:any)/list_(:any)/list_(:any)/list_(:any)/list_(:any)/list_(:any)']                    = "user/job/parse_search_segment/";
$route['list_(:any)/list_(:any)/list_(:any)/list_(:any)/list_(:any)/list_(:any)']                    = "user/job/parse_search_segment/";
$route['list_(:any)/list_(:any)/list_(:any)/list_(:any)/list_(:any)']                    = "user/job/parse_search_segment/";
$route['list_(:any)/list_(:any)/list_(:any)/list_(:any)']                    = "user/job/parse_search_segment/";
$route['list_(:any)/list_(:any)/list_(:any)']                    = "user/job/parse_search_segment/";
$route['list_(:any)/list_(:any)']                    = "user/job/parse_search_segment/";
$route['list_(:any)']                    = "user/job/parse_search_segment/";
// $route['c_([a-z]+)']                    = "user/job/parse_search_segment/c_$1";

// $route['p_(:any)/'] = "user/job/search/$1";
$route['railway/(:any)'] =  "user/job/search_line/$1";
//U_3
$route['signup/apply'] = "user/signup/apply";
$route['signup/bookmark'] = "user/signup/bookmark";
$route['detail_(:any)'] = "user/job/detail/$1";

//U_5
// $route['agent']                         = "user/agent/index";
$route['agent']                         = "user/agent/agent_list";
$route['signup']                        = "user/signup/index";
$route['signup/mail_confirm/(:any)']    = "user/signup/mail_confirm/$1";
/*$route['signup/complete_apply/(:num)']  = "user/signup/complete_apply/$1";
$route['signup/complete_bookmark/(:num)']  = "user/signup/complete_bookmark/$1";*/
$route['signup/(:any)']                 = "user/signup/$1";

$route['complete_apply/(:any)/(:any)/(:num)']  = "user/job/complete_apply/$1/$2/$3";

$route['lp']                            = "user/campaign/proto_a";

$route['rd']                 = "user/account/rd";

//U_15
$route['login']                         = "user/account/login";
$route['login/(:any)']                  = "user/account/$1";
$route['logout']                        = "user/account/logout";

//U_16
$route['password']                      = "user/password/index";
$route['password/reset/(:any)']         = "user/password/reset/$1";
$route['password/(:any)']               = "user/password/$1";

$route['mypage']                        = "user/mypage/index";
$route['mypage/(:any)']                 = "user/mypage/$1";

$route['client/confirm_template/(:num)'] = "client/scout/confirm_template/$1";
$route['client']                         = "client/index";

$route['inquiry']                       = "user/Inquire/index";// not logged in and, logged in user
$route['inquiry/complete']              = "user/Inquire/complete";// not logged in and, logged in user
$route['businessoffer']                 = "user/Inquire/businessoffer";// not logged in and, logged in user
$route['client/inquiry']                = "client/Inquire/businessoffer";//logged in client
$route['client/inquiry/complete']       = "client/Inquire/complete";

//agent
// $route['agent']                         = "user/agent/index"; //expired v3 agent index , replaced agent_list
$route['agent/(:num)/job']                  = "user/agent/job/$1";
$route['agent/(:num)']                  = "user/agent/show_detail/$1";
// $route['agent/(:num)']                  = "user/agent/detail/$1";
$route['agent/(:num)/flow']             = "user/agent/service_flow/$1";
$route['agent/(:num)/staff']            = "user/agent/intro_staff/$1";

//UL_9
$route['agent_entry'] = "user/agent/applicantlist";

//static
$route['about'] = "user/statics/about";
$route['guide'] = "user/statics/guide";
$route['rule'] = "user/statics/rule";
$route['rule_company'] = "user/statics/rule_company";
$route['fqa'] = "user/statics/fqa";



//CLIENT--------------------------------------------------------------

/**
 * Thanh
 * Ignore this action
 */
// /$route['client/contact'] = "client/backend/contact";


//C_2
$route['client/login']                                  = 'client/account/login';
$route['client/login/(:any)']                        = 'client/account/$1';

$route['client/logout']                        = "client/account/logout";
//job_apply
$route['client/job_apply/detail/(:any)']    = 'client/job_apply/detail/$1';
//agent
//$route['client/profile/agent/edit']           = 'client/profile/edit_career_adviser_info/';
//$route['client/profile/agent/edit/(:any)']     = 'client/profile/edit_career_adviser_info/$1';


$route['contents/ajax/(:any)'] = 'user/ajax/$1';



//admin--------------------------------------------------------------

$route['manager/session'] = 'admin/session/add';
$route['manager/create'] = 'admin/session/create';
$route['manager/logout'] = 'admin/session/delete';
$route['manager/user'] = 'admin/user/index';
$route['manager/user/index'] = 'admin/user/index';
$route['manager/user/detail/(:num)'] = 'admin/user/detail/$1';
$route['manager/user/dammy_user_login/(:num)'] = 'admin/user/dammy_user_login/$1';
$route['manager/agent/dammy_agent_login/(:num)'] = 'admin/agent/dammy_agent_login/$1';
$route['manager/nursery/dammy_nursery_login/(:num)'] = 'admin/nursery/dammy_nursery_login/$1';
$route['manager/user/del/(:num)'] = 'admin/user/delete_flg/$1';
$route['manager/user/temporary'] = 'admin/user/temporary';
$route['manager/user/ajax_send_confirm_mail'] = 'admin/user/ajax_send_confirm_mail';

$route['manager/group'] = 'admin/group/index';
$route['manager/group/add'] = 'admin/group/add';
$route['manager/group/create'] = 'admin/group/create';
$route['manager/group/edit/(:num)'] = 'admin/group/edit/$1';
$route['manager/group/update'] = 'admin/group/update';
$route['manager/group/del/(:num)'] = 'admin/group/delete_flg/$1';
$route['manager/group/batch_delete'] = 'admin/group/batch_delete';


$route['manager/tag/add'] = 'admin/tag/add';
$route['manager/tag/create'] = 'admin/tag/create';
$route['manager/tag/edit/(:num)'] = 'admin/tag/edit/$1';
$route['manager/tag/update'] = 'admin/tag/update';
$route['manager/tag/del/(:num)'] = 'admin/tag/delete_flg/$1';



$route['manager/client/(agent|nursery)'] = 'admin/client/index/$1';
$route['manager/client/add'] = 'admin/client/add';
$route['manager/client/create'] = 'admin/client/create';
$route['manager/agent/plan/add/(:num)'] = 'admin/client/add_plan/$1';
$route['manager/nursery/plan/add/(:num)'] = 'admin/client/add_plan/$1';
$route['manager/client/plan/detail'] = 'admin/client/plan_detail';
$route['manager/client/plan/create'] = 'admin/client/create_plan';
$route['manager/area/ajax_get_city'] = 'admin/area/get_city_by_pref';


$route['manager/agent/(:num)/careeradviser'] = 'admin/careeradviser/index/$1';
$route['manager/careeradviser/update'] = 'admin/careeradviser/update';
$route['manager/careeradviser/del/(:num)'] = 'admin/careeradviser/delete_flg/$1';


$route['manager/agent/detail/(:num)'] = 'admin/agent/detail/$1';
$route['manager/agent/edit/(:num)'] = 'admin/agent/edit/$1';
$route['manager/agent/update'] = 'admin/agent/update';
$route['manager/agent/update_pr'] = 'admin/agent/update_pr';


$route['manager/nursery/detail/(:num)'] = 'admin/nursery/detail/$1';
$route['manager/nursery/edit/(:num)'] = 'admin/nursery/edit/$1';
$route['manager/nursery/update'] = 'admin/nursery/update';
$route['manager/nursery/update_pr'] = 'admin/nursery/update_pr';
$route['manager/nursery/del/(:num)'] = 'admin/nursery/del/$1';



$route['manager/plan'] = 'admin/plan/index';
$route['manager/plan/category'] = 'admin/plan/category';
$route['manager/plan/detail/(:num)'] = 'admin/plan/detail/$1';
$route['manager/plan/edit/(:num)'] = 'admin/plan/edit/$1';
$route['manager/plan/update'] = 'admin/plan/update';
$route['manager/plan/add'] = 'admin/plan/add';
$route['manager/plan/del/(:num)'] = 'admin/plan/delete_flg/$1';
$route['manager/plan/create'] = 'admin/plan/create';
$route['manager/plan_group/add'] = 'admin/plan/add_group';
$route['manager/plan_group/create'] = 'admin/plan/create_group';
$route['manager/plan_group/edit/(:num)'] = 'admin/plan/edit_group/$1';
$route['manager/plan_group/update'] = 'admin/plan/update_group';
$route['manager/plan_group/del/(:num)'] = 'admin/plan/group_delete_flg/$1';
$route['manager/plan_group_plan/del/(:num)/(:num)'] = 'admin/plan/delete_relation/$1/$2';

//jobs
$route['manager/jobs'] = 'admin/job/index';
$route['manager/jobs/index'] = 'admin/job/index';
$route['manager/jobs/detail/(:num)'] = 'admin/job/detail/$1';
$route['manager/jobs/delete/(:num)'] = 'admin/job/delete_flg/$1';
$route['manager/job/index/export'] = 'admin/job/export_file';

//apply_jobs
/*
$route['manager/entries/'] = 'admin/entry/index';
$route['manager/entries/'] = 'admin/entry/index';
$route['manager/entry/detail/(:num)'] = 'admin/entry/detail/$1';
$route['manager/entry/update'] = 'admin/entry/update';
$route['manager/entries/del/(:num)'] = 'admin/entry/delete_flg/$1';
$route['manager/entries/index/export'] = 'admin/entry/export_file';
*/
$route['manager/entries/job'] = 'admin/entry/index';
$route['manager/entries/job'] = 'admin/entry/index';
$route['manager/entries/agent'] = 'admin/entry/agent_index';
$route['manager/entries/agent'] = 'admin/entry/agent_index';
$route['manager/entry/job/detail/(:num)'] = 'admin/entry/job_detail/$1';
$route['manager/entry/job/update'] = 'admin/entry/job_update';
$route['manager/entries/job/del/(:num)'] = 'admin/entry/job_delete_flg/$1';
$route['manager/entries/job/export'] = 'admin/entry/job_export_file';
$route['manager/entry/agent/detail/(:num)'] = 'admin/entry/agent_detail/$1';
$route['manager/entry/agent/update'] = 'admin/entry/agent_update';
$route['manager/entries/agent/del/(:num)'] = 'admin/entry/agent_delete_flg/$1';
$route['manager/entries/agent/export'] = 'admin/entry/agent_export_file';


$route['manager/except/agency'] = 'admin/except/agency';
$route['manager/except/agency/index'] = 'admin/except/agency';
$route['manager/except/job'] = 'admin/except/job';
$route['manager/except/job/index'] = 'admin/except/job';
$route['manager/except/del/(:num)'] = 'admin/except/delete/$1';
$route['manager/except/detail_agency/(:num)'] = 'admin/except/detail_agency/$1';
$route['manager/except/detail_job/(:num)'] = 'admin/except/detail_job/$1';
$route['manager/except/(job|agency)/(valid|rejected)/(:num)'] = 'admin/except/confirm/$1/$2/$3';
// $route['manager/except/agency/valid/(:num)'] = 'admin/except/confirm/$1';


//mail
$route['manager/contact'] = 'admin/contact';
$route['manager/contact/index'] = 'admin/contact';
$route['manager/scout'] = 'admin/scout';
$route['manager/scout/index'] = 'admin/scout';
$route['manager/mail'] = 'admin/mail';
$route['manager/mail/index'] = 'admin/mail';
$route['manager/scout/detail/(:num)'] = 'admin/scout/detail/$1';
$route['manager/mail/create'] = 'admin/mail/create';
$route['manager/mail/detail/(:num)'] = 'admin/mail/detail/$1';
$route['manager/contact/detail/(:num)'] = 'admin/contact/detail/$1';

//analyze
$route['manager/statics'] = 'admin/analyze/';
$route['manager/statics'] = 'admin/analyze/index';

//url generator
$route['manager/session/generate_url'] = 'admin/session/generate_url/';
$route['manager/session/generate_comp'] = 'admin/session/create_url/';

//export file

$route['manager/user/export'] = 'admin/user/export_file';
$route['manager/plan/export'] = 'admin/plan/export_file';
$route['manager/plan/category/export'] = 'admin/plan/export_group_file';
$route['manager/except/agency/export'] = 'admin/except/export_agecy_file';
$route['manager/except/job/export'] = 'admin/except/export_job_file';
$route['manager/client/agent/export'] = 'admin/client/export_file';
$route['manager/client/nursery/export'] = 'admin/client/export_nursery_file';
$route['manager/scout//export'] = 'admin/scout/export_file';
$route['manager/template/export'] = 'admin/scout/export_template_file';

//nursery_kana
$route['manager/nursery_kana'] = 'admin/furigana/index';
$route['manager/nursery_kana/done'] = 'admin/furigana/done';



$route['manager/ad/(banner|text|partner|job_right_navi|job_content_upper|job_content_lower)'] = 'admin/ad/index/$1';
$route['manager/ad/banner/del/(:num)'] = 'admin/ad/delete_flg/$1';
$route['manager/ad/text/del/(:num)'] = 'admin/ad/delete_flg/$1';
$route['manager/ad/partner/del/(:num)'] = 'admin/ad/delete_flg/$1';
$route['manager/ad/job_right_navi/del/(:num)'] = 'admin/ad/delete_flg/$1';
$route['manager/ad/job_content_upper/del/(:num)'] = 'admin/ad/delete_flg/$1';
$route['manager/ad/job_content_lower/del/(:num)'] = 'admin/ad/delete_flg/$1';


$route['manager/ad/banner/edit/(:num)'] = 'admin/ad/edit_banner/$1';
$route['manager/ad/text/edit/(:num)'] = 'admin/ad/edit_text/$1';
$route['manager/ad/partner/edit/(:num)'] = 'admin/ad/edit_partner/$1';
$route['manager/ad/job_right_navi/edit/(:num)'] = 'admin/ad/edit_job_right_navi/$1';
$route['manager/ad/job_content_upper/edit/(:num)'] = 'admin/ad/edit_job_content_upper/$1';
$route['manager/ad/job_content_lower/edit/(:num)'] = 'admin/ad/edit_job_content_lower/$1';

$route['manager/ad/banner/update'] = 'admin/ad/update_banner';
$route['manager/ad/text/update'] = 'admin/ad/update_text';
$route['manager/ad/partner/update'] = 'admin/ad/update_partner';
$route['manager/ad/job_right_navi/update'] = 'admin/ad/update_job_right_navi';
$route['manager/ad/job_content_upper/update'] = 'admin/ad/update_job_content_upper';
$route['manager/ad/job_content_lower/update'] = 'admin/ad/update_job_content_lower';


$route['manager/ad/banner/add'] = 'admin/ad/add_banner';
$route['manager/ad/text/add'] = 'admin/ad/add_text';
$route['manager/ad/partner/add'] = 'admin/ad/add_partner';
$route['manager/ad/job_right_navi/add'] = 'admin/ad/add_job_right_navi';
$route['manager/ad/job_content_upper/add'] = 'admin/ad/add_job_content_upper';
$route['manager/ad/job_content_lower/add'] = 'admin/ad/add_job_content_lower';


$route['manager/ad/banner/create'] = 'admin/ad/create_banner';
$route['manager/ad/text/create'] = 'admin/ad/create_text';
$route['manager/ad/partner/create'] = 'admin/ad/create_partner';
$route['manager/ad/job_right_navi/create'] = 'admin/ad/create_job_right_navi';
$route['manager/ad/job_content_upper/create'] = 'admin/ad/create_job_content_upper';
$route['manager/ad/job_content_lower/create'] = 'admin/ad/create_job_content_lower';

//U_21
$route['user/job/(:num)/agent_info']                    = "user/job/agent_info/$1";
//U_20
$route['user/job/(:num)/nursery_info']                  = "user/job/nursery_info/$1";
//$route['default_controller']                          = 'welcome';
/* End of file routes.php */

//redirect three job email login
$route['mail/login']                                    = 'user/shortcut/login';
