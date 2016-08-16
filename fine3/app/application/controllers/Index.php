<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once 'user/User_abstract.php';

class Index extends User_abstract
{
    public function __construct() {
        parent::__construct();

        $this->load->model("Service_ad");
        $this->load->model("Service_job");
        $this->load->helper("image");
        $this->load->helper("string");
    }

    /*
    this page is top page
    */
    public function index() {
        //latest_job

        $search_param['user_id']        =  empty($user_data['user_id']) ? null : $user_data['user_id'];
        $search_param['job_status']     =  $this->config->item('public','job_config');
        $search_param['nursery_status'] =  $this->config->item('public','nursery_config');
        $search_param['delete_flg']     =  $this->config->item('not_deleted','common_config');
        $search_param['limit_from'] = 0;
        $search_param['limit_to']   = 4;
        $this->load->model('Service_job');
        $job_list       = $this->Service_job->get_search_list($search_param);
        $this->smarty->assign('job_list',$job_list);

        if($this->template_path() === "pc"){
            //search tag
            $searchbox_params['area'] = 1;
            $searchbox_params['count'] = 1;
            $this->load->model('Service_search');
            $this->Service_search->assign_searchbox_variables($searchbox_params);
        }


        //ad
        $ad_param['status'] = $this->config->item('public','ad_config');

        for($adtype = 1; $adtype <= 9; $adtype++){
            // 1 right_navi
            if($adtype == 1){
                $ad_param['type'] = $adtype;
                $adsgroup = $this->Service_ad->get_top_adsgroup($ad_param);
                $ads = $this->Service_ad->get_top_ads($ad_param, $adsgroup);
                if(!empty($adsgroup)){
                    foreach($adsgroup as $row){
                        $this->smarty->assign('job_right_navi_name', $row['name']);
                    }
                }else{
                    $this->smarty->assign('job_right_navi_name', null);
                }
                if(!empty($ads)){
                    $job_detail = array();
                    foreach($ads as $row){
                        $job_detail[]  = $this->Service_job->get_detail_info($row);
                    }
                    if((count($job_detail) == 1) && !$job_detail[0]){
                        $this->smarty->assign('job_right_navi_content', null);
                    }else{
                        $this->smarty->assign('job_right_navi_content', $job_detail);

                        $index = 0;
                        foreach($job_detail as $job){
                            // for sp or pc
                            if($this->template_path() == "sp"){
                                if(!empty($job['job_detail']['tags']['type_employ'])){
                                    $typeemploy_array = array();
                                    foreach($job['job_detail']['tags']['type_employ'] as $typeemploy){
                                        $typeemploy_array[] = $typeemploy;
                                    }
                                    $this->smarty->assign('right_job_type_employ_'.$index, $typeemploy_array);
                                }else{
                                    $this->smarty->assign('right_job_type_employ_'.$index, null);
                                }
                            }
                            $index++;
                        }
                    }
                }else{
                    $this->smarty->assign('job_right_navi_content', null);
                }
            }

            // 2 content_upper
            if($adtype == 2){
                $viewtext = 'upper';
                $ad_param['type'] = $adtype;
                $this->contents_display($ad_param, $viewtext);
            }

            // 3 content_lower
            if($adtype == 3){
                $viewtext = 'lower';
                $ad_param['type'] = $adtype;
                $this->contents_display($ad_param, $viewtext);
            }

            // 4 right_navi textlinks
            if($adtype == 4){
                $ad_param['type'] = $adtype;
                $adsgroup = $this->Service_ad->get_top_adsgroup($ad_param);
                $ads = $this->Service_ad->get_top_ads($ad_param, $adsgroup);
                if(!empty($adsgroup)){
                    foreach($adsgroup as $row){
                        $this->smarty->assign('text_right_navi_name', $row['name']);
                    }
                }else{
                    $this->smarty->assign('text_right_navi_name', null);
                }
                if(!empty($ads)){
                    $this->smarty->assign('text_right_navi_content', $ads);
                }else{
                    $this->smarty->assign('text_right_navi_content', null);
                }
            }

            // 5 right_navi partners
            if($adtype == 5){
                $ad_param['type'] = $adtype;
                $adsgroup = $this->Service_ad->get_top_adsgroup($ad_param);
                $ads = $this->Service_ad->get_top_ads($ad_param, $adsgroup);
                if(!empty($adsgroup)){
                    foreach($adsgroup as $row){
                        $this->smarty->assign('partner_name', $row['name']);
                    }
                }else{
                    $this->smarty->assign('partner_name', null);
                }

                if(!empty($ads)){
                    $partner_info = array(array());
                    $index = 0;
                    foreach($ads as $row){
                        $partner_info[$index]['url'] = $row['url'] ;
                        $partner_banner = $this->Service_ad->get_banner_ads($row['ads_id']);
                        if(!empty($partner_banner)){
                            foreach($partner_banner as $adsimage){
                                $banner_path = getImageFromS3($adsimage['account_id'], $adsimage['type'], $adsimage['name'])['path'];
                                $partner_info[$index]['path'] = $banner_path;
                            }
                            $this->smarty->assign('partner_banner', $partner_info);
                        }
                        $index++;
                    }
                }else{
                    $this->smarty->assign('partner_banner', null);
                }
            }

            // 6 content_upper_banner
            if($adtype == 6){
                $viewtext = 'content_upper';
                $ad_param['type'] = $adtype;
                $this->banner_display($ad_param, $viewtext);
            }

            // 7 content_lower_banner
            if($adtype == 7){
                $viewtext = 'content_lower';
                $ad_param['type'] = $adtype;
                $this->banner_display($ad_param, $viewtext);
            }

            // 8 right_navi(upper)
            if($adtype == 8){
                $viewtext = 'right_upper';
                $ad_param['type'] = $adtype;
                $this->banner_display($ad_param, $viewtext);
            }

            // 9 right_navi(lower)
            if($adtype == 9){
                $viewtext = 'right_lower';
                $ad_param['type'] = $adtype;
                $this->banner_display($ad_param, $viewtext);
            }
        }


    //tdk
    $tdk_array['description'] = '全国の保育士求人・転職・募集情報を掲載するポータルサイトFINE!。あなたにぴったりの保育士・幼稚園の求人や募集情報を探せます。保育士の転職やお仕事探しに役立つ情報も満載！';
    $this->smarty->assign('tdk_array',$tdk_array);

    //pref job count SP view
    $a = 1;
    $area_count = array();
    while($a <= 47){
        $pref_param["pref_id"]        =  $a;
            $pref_param['job_status']     =  1;
            $pref_param['nursery_status'] =  0;
            $pref_param['client_status']  =  0;
            $pref_param['delete_flg']     =  0;
            $pref_param['date']     	  =  date('Y-m-d H:i:s');

        $area_count[$a] = $this->Service_job->count_pref_job($pref_param);
        $a ++;
    }
    $this->smarty->assign('area_count', $area_count);

    //area list
    $area = $this->Service_area->get_pref_list();
    $this->smarty->assign('area', $area);

        $this->smarty->display($this->template_path()."/user/index.html");
    }

    /*
     * contents display function : ads_group.type 2,3
     * @param $param[status, type], $temptext
     * @return
     *
    */
    private function contents_display($param, $temptext){
        $adsgresult = $this->Service_ad->get_top_adsgroup($param);
        $adsresult = $this->Service_ad->get_top_ads($param, $adsgresult);
        if(!empty($adsgresult)){
            foreach($adsgresult as $row){
                $this->smarty->assign('job_content_'.$temptext.'_name', $row['name']);
            }
        }else{
            $this->smarty->assign('job_content_'.$temptext.'_name', null);
        }
        if(!empty($adsresult)){
            $job_details = array();
            foreach($adsresult as $row){
                $job_detail_info  = $this->Service_job->get_detail_info($row);

                if($job_detail_info){
                    $job_details[] = $job_detail_info;
                }
            }
            $this->smarty->assign('job_content_'.$temptext.'_content', $job_details);

            $index = 0;
            foreach($job_details as $job){

                if(!empty($job['job_detail']['tags']['type_employ'])){
                    $typeemploys = array();
                    foreach($job['job_detail']['tags']['type_employ'] as $typeemploy){
                        $typeemploys[] = $typeemploy;
                    }
                    $this->smarty->assign($temptext.'_job_type_employ_'.$index, $typeemploys);
                }else{
                    $this->smarty->assign($temptext.'_job_type_employ_'.$index, null);
                }
                // for sp or pc
                if($this->template_path() == "pc"){
                    if(!empty($job['job_detail']['tags']['type_job'])){
                        $tagjobs = array();
                        foreach($job['job_detail']['tags']['type_job'] as $tagjob){
                            $tagjobs[] = $tagjob;
                        }
                        $this->smarty->assign($temptext.'_job_type_job_'.$index, $tagjobs);
                    }else{
                        $this->smarty->assign($temptext.'_job_type_job_'.$index, null);
                    }
                }
                $index++;
            }
        }else{
            $this->smarty->assign('job_content_'.$temptext.'_content', null);
        }
    }

    /*
     * banner display function : ads_group.type 6 - 9 banners
     * @param $param[status, type], $temptext
     * @return
     *
    */
    private function banner_display($param, $temptext){
        $adsgresult = $this->Service_ad->get_top_adsgroup($param);
        $adsresult = $this->Service_ad->get_top_ads($param, $adsgresult);
        if(!empty($adsresult)){
            foreach($adsresult as $row){
                $this->smarty->assign($temptext.'_banner_url', $row['url']);
                $banners = $this->Service_ad->get_banner_ads($row['ads_id']);
            }
            if(!empty($banners)){
                foreach($banners as $row){
                    $banner_path = getImageFromS3($row['account_id'], $row['type'], $row['name'])['path'];
                    $this->smarty->assign($temptext.'_banner_path', $banner_path);
                }
            }
        }else{
            $this->smarty->assign($temptext.'_banner_path', null);
        }
    }

    /*
    this is login page
    */
    public function login($error = array()) {
        //render U_15

        $this->smarty->display($this->template_path()."/user/login.html");
    }

    /*
    this action is execute login function
    */
    public function login_exe(){

        $params["check_input"] = $this->input->post();
        $params["check_column"] = array("mail","password");
        $params["redirect"] = "/";

        $post = $this->check_input($params);

        $this->load->model("Service_user");
        $user_id = $this->Service_user->check_user_account($post);

        if($user_id === false){
            $this->login(array("error"=>true));
        }else{
            $session["user_id"] = $user_id;
            $session["login"] = true;
            $this->session->set_userdata(array("user_data"=>$session));
             redirect(base_url()."/mypage/index");
        }

    }

}
