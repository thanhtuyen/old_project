<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once 'User_abstract.php';

class Job extends User_abstract
{
    const RESPONSE_CODE_ERROR   = 0;    // Ajax Response : ERROR
    const RESPONSE_CODE_SUCCESS = 1;    // Ajax Response : SUCCESS

    public function __construct() {
        parent::__construct();
        //service
        $this->load->model('Service_job');
        $this->load->model('Service_nursery');
        $this->load->model('Service_tag');
        $this->load->model('Service_bookmark');
        $this->load->model('Service_agent');
        $this->load->model('Service_nursery');
        $this->load->model('Service_area');
        $this->load->model('Service_ad');
        $this->load->model('Service_search');

        //helper
        $this->load->helper('List');
        $this->load->helper('job');
        $this->load->helper('image');
        $this->load->helper('string');
    }

    public function search_area(){
        $uri = $_SERVER['REQUEST_URI'];
        //generate uri
        $get_string = strstr($uri, '?');
        if(empty($get_string)){
            $segment = explode('/',ltrim($uri,'/'));
        }else{
            $trimmed = str_replace($get_string, "", $uri);
            $segment = explode('/',ltrim($trimmed,'/'));
        }

        if($segment[0] == "index.php"){
            unset($segment[0]);
            if(!empty($segment[1])){
                $alt = $segment[1];
                $segment = array();
                $segment[0] = $alt;
            }
        }else{
            if(stristr($segment[0],'p_')){
                $area_str = str_replace('p_','',$segment[0]);

                $this->config->load('prefecture_seo_config',TRUE);
                $seo_text = $this->config->item($area_str,'prefecture_seo_config');

                if(empty($seo_text))redirect($this->config->config['base_url'].'search');

                $this->smarty->assign('seo_text',$seo_text);
                $this->smarty->assign('pref_str',$segment[0]);
            }

        }
        $param_array = $this->Service_job->generate_search_param($segment);
        $pref_id = $param_array['pref_id'];
        $related_area = $this->Service_job->get_related_area($pref_id);
        $this->smarty->assign('related_areas',$related_area);
        $user_data  = $this->_get_user_session();

        $search_param["pref_id"] = $pref_id;
        $search_param['job_status']     =  $this->config->item('public','job_config');
        $search_param['nursery_status'] =  $this->config->item('public','nursery_config');
        $search_param['delete_flg']     =  $this->config->item('not_deleted','common_config');
        //count job
        $city_job  = $this->Service_job->get_each_city_job_count_by_pref($search_param);
        $city_job_count_list = array();
        if(!empty($city_job)){
            foreach ($city_job as $key => $value) {
                $city_job_count_list[$value['area_id']] = $value;
            }
        }
        $this->smarty->assign('city_job_count_list',$city_job_count_list);
        $uri = ltrim($uri,'/');
        $page = $this->input->get('page');

        if($page > 0){
            $param['page'] = $page;
        }
        $chk_ajax = $this->input->post('is_ajax');
        if(!empty($chk_ajax)){
            $param['is_ajax'] = true;
        }
        $param['get'] = $this->Service_job->generate_get_param($param_array,$page);

        //if over 2 kinds of tags inserted, use get parameter
        if($param['get']['double'] === true){
            unset($param['get']['double']);
            $get_parameter = "";
            $get_parameter = $param['get']['get_param'];
            $url = base_url().$get_parameter;
            unset($param['get']['get_param']);
            redirect($url);
        }else{
            unset($param['get']['double']);
        }
        //generate tag_url
        $tag_url = str_replace($get_string,"",$uri);
        $param['tag_url'] = base_url().$tag_url;
        $this->search($param, "search_area");
    }

    //any segments are parsed here.
    public function parse_search_segment(){
        $uri = $_SERVER['REQUEST_URI'];
        //generate uri
        $get_string = strstr($uri, '?');
        if(empty($get_string)){
            $segment = explode('/',ltrim($uri,'/'));
        }else{
            $trimmed = str_replace($get_string, "", $uri);
            $segment = explode('/',ltrim($trimmed,'/'));
        }

        if($segment[0] == "index.php"){
            unset($segment[0]);
            if(!empty($segment[1])){
                $alt = $segment[1];
                $segment = array();
                $segment[0] = $alt;
            }
        }
        $param_array = $this->Service_job->generate_search_param($segment);

        $uri = ltrim($uri,'/');
        $page = $this->input->get('page');

        if($page > 0){
            $param['page'] = $page;
        }
        $chk_ajax = $this->input->post('is_ajax');
        if(!empty($chk_ajax)){
            $param['is_ajax'] = true;
        }
        $param['get'] = $this->Service_job->generate_get_param($param_array,$page);

        //if over 2 kinds of tags inserted, use get parameter
        if($param['get']['double'] === true){
            unset($param['get']['double']);
            $get_parameter = "";
            $get_parameter = $param['get']['get_param'];
            $url = base_url().$get_parameter;
            unset($param['get']['get_param']);
            redirect($url);
        }else{
            unset($param['get']['double']);
        }
        //generate tag_url
        $tag_url = str_replace($get_string,"",$uri);
        $param['tag_url'] = base_url().$tag_url;
        $this->search($param);
    }
    /*
    this page is searching page , this page is same as index page.
    if user set some condition and search job , then user go to this page
    */

    public function search($param = array(), $search_type = false) {

        // if you done set get param, please activate
        if(empty($param)){
            $get = $this->input->get();
        }elseif(isset($param['get'])){
            $get = $param['get'];
        }
        //assign selecter
        $selecter = $this->_format_get_parameter($get);

        $this->smarty->assign('selecter',$selecter);
        //reset pagenation data
        $this->load->model('Service_search');
        $search_parse = $this->Service_search->make_search_param($get,$param);

        if(!empty($search_parse['search_request'])){
            $search_request = $search_parse['search_request'];
        }

        if(!empty($search_parse['search_word'])){
            $search_word = $search_parse['search_word'];
        }else{
            $search_word = "";
        }
        $this->smarty->assign('search_word',$search_word);

        if(!empty($search_parse['search_param'])){
            $search_param = $search_parse['search_param'];
        }
        if(!empty($search_parse['ad_param'])){
            $ad_param = $search_parse['ad_param'];
        }
        if(!empty($search_parse['detail'])){
            $detail = $search_parse['detail'];
        }
        if(!empty($search_parse['page'])){
            $page = $search_parse['page'];
        }else{
            $page = 1;
        }
        if(!empty($search_parse['tdk'])){
            $tdk = $search_parse['tdk'];
        }
        //tag url generate
        if(!empty($param['tag_url'])){
            $tag_url = $this->Service_tag->generate_tag_url($param['tag_url']);
        }else{
            $tag_url = base_url();
        }
        $this->smarty->assign('tag_url',$tag_url);

        //2.get user_data
        $user_data  = $this->_get_user_session();

        //2. please get job list of this pref and city
        $search_param['user_id']        =  empty($user_data['user_id']) ? null : $user_data['user_id'];
        $search_param['job_status']     =  $this->config->item('public','job_config');
        $search_param['nursery_status'] =  $this->config->item('public','nursery_config');
        $search_param['delete_flg']     =  $this->config->item('not_deleted','common_config');
        //count job
        $job_all_count  = $this->Service_job->search_count($search_param);

        $this->smarty->assign('job_all_count',$job_all_count);
        //3. get current condition.
        //for display pagenation and how many will this get jobs
        if($this->template_path() == "sp"){
            $range = $this->config->item('search_result_rows_sp','job_config');
        }else{
            $range = $this->config->item('search_result_rows','job_config');
        }
        //set pagination
        $list_param['range']      = $range;
        $list_param['page']       = $page;
        $list_param['limit']      = $job_all_count;
        $this->smarty->assign('range',$list_param['range']);
        $this->smarty->assign('limit',$list_param['limit']);

        $pagination_param = $this->Service_search->pagination($list_param);

        //parse param
        $page = $pagination_param['result_page'];
        $this->smarty->assign('page',$page);
        $page_count = $pagination_param['page_count'];
        $search_param_alt = $pagination_param['search_param'];
        $search_param['limit_to'] = $search_param_alt['limit_to'];
        $this->smarty->assign('limit_to',$search_param['limit_to']);
        $search_param['limit_from'] = $search_param_alt['limit_from'];
        $this->smarty->assign('limit_from',$search_param['limit_from']);
        // $page_limit = 
        $pagination = $this->_get_pagination($page_count,$list_param['range'],'','',$pagination_param['page_limit']);
        $this->smarty->assign('pagination',$pagination);

        //new job judgement
        $new_date = date('Y-m-d H:i:s',strtotime('-10days'));
        $this->smarty->assign('new_date' , $new_date);

        //$this->load->helper('image');
        $this->smarty->assign('image_type', $this->config->item('job', 'image_config'));
        //finish to set param, get job_list for main content
        $job_list       = $this->Service_job->get_search_list($search_param);

        if(count($job_list) > $range){
            $job_list = array_slice($job_list, 0,$range);
        }
        $this->smarty->assign('job_list',$job_list);

        //if sp ajax, return.
        $chk_ajax = $this->input->post('is_ajax');
        if((!empty($chk_ajax))||(!empty($param['is_ajax']))){
            $chk_ajax = true;
        }
        if(!empty($chk_ajax)){
                    $html = $this->smarty->fetch('sp/user/common/_job_list.html');
                    $response["code"] = self::RESPONSE_CODE_SUCCESS;
                    $response["html"] = $html;
                    return $this->_response_view($response);
        }
        //get recommend list
        $search_param['job_tag_id'][]    = "85";//85 is recommend_flg
        $job_recommend_list = $this->_get_job_recommend_list($search_param);
        $this->smarty->assign('job_recommend_list',$job_recommend_list);

        //ads
        $ad = array();
        $ad_param['job_status']     =  $this->config->item('public','job_config');
        $ad_param['nursery_status'] =  $this->config->item('public','nursery_config');
        $ad_param['delete_flg'] = $this->config->item('not_deleted','common_config');
        $ad_param['status'] = $this->config->item('public','ad_config');
        $ad_area_id        = $this->Service_area->get_id_list($ad_param);
        if($ad_area_id){
            $ad_param['area_id'] = $ad_area_id;
            // $ad_param['area_id'] = $this->config->item('right_navi','ad_config');
            $ad = $this->Service_ad->get_group_detail_list($ad_param);
        }

        $this->smarty->assign('ad',$ad);
        $this->smarty->assign('user_data', $user_data);

        $this->Service_search->assign_searchbox_variables();

        //-------------
        // breadcrum
        if(array_key_exists('area_id', $search_param)){
                $current_area_id = $search_param['area_id'];
        }else{
            $current_area_id = false;
        }

        $this->load->model('Service_area');
        $area_datas = $this->Service_area->full_area($current_area_id);
        $param = array('pref','city');

        $bc_element['area_data']['pref_name'] = $area_datas['prefname'];
        $bc_element['area_data']['pref_id'] =  $area_datas['pref_id'];
        $bc_element['area_data']['city_id'] = $area_datas['city_id'];
        $bc_element['area_data']['city_name'] = $area_datas['cname'];
        //-------------
        // breadcrum

        $bc_element = array('job_search_current');
        $this->_bread_crumb['base_url'] = base_url();
        if (isset($search_param['area_id'])) {
            $current_area_id = $search_param['area_id'];
            $this->load->model('Service_area');
            $bc_element['area_datas'] = $this->Service_area->full_area($current_area_id);
        }
        $this->_bread_crumb['base_url'] = base_url();
        $this->_bread_crumb['content'] = get_breadcrumb('job_search',$bc_element);

        //imageヘルパーをviewで使うためにロード
        //$this->load->helper("image_helper");
        $this->smarty->assign('breadcrumb' , $this->_bread_crumb);

        /*if($page !== 1){ // canonical flg
            $canonical = current_url();
            $this->smarty->assign('canonical' , $canonical);
        }*/

        //tdk
        if($page == 1){
            $tdk_page = '';
        }else{
            $tdk_page = '('.$page.'ページ目)';
        }
        //都道府県トップか求人検索結果かでベースも出し分け
        $uri = substr($this->uri->segment(1),0,2);

        $tdk_head = "";
        $this->load->model('Service_area');
        $pref_name = (isset($get['pref']))? $this->Service_area->get_area_name($get['pref']) : false;
        
        $tdk_head = "";
        if($uri == 'p_' && isset($pref_name)){
            //都道府県トップ
            $tdk_array['title'] = $pref_name.'の保育士求人・募集を探す';
            $tdk_array['description'] = $pref_name.'の保育士求人・募集を探す。'.$pref_name.'の保育士求人・転職・募集情報を掲載するポータルサイトFINE!。あなたにぴったりの保育士・幼稚園の求人や募集情報を探せます。保育士の転職やお仕事探しに役立つ情報も満載！';
            $tdk_array['keyword'] = $pref_name;
            $this->smarty->assign('pref_name',$pref_name);
        } elseif(isset($tdk)) {
            //求人検索結果
            //市区町村ありなしで都道府県名を入れるかいれないか決まる
            $tdk_datas = implode(',',$tdk);
            if(isset($search_param['city_id'])){
                $tdk_head = $tdk_datas;
            }elseif(!empty($pref_name)){
                $tdk_head = $pref_name.'全域,'.$tdk_datas;
            }else{
                $tdk_head = $tdk_datas;
            }
            $tdk_array['title'] = $tdk_head.'全域の保育士求人・募集一覧('.$tdk_page.'ページ目)';
            $tdk_array['description'] = $tdk_head.'全域の保育士求人・募集一覧('.$tdk_page.'ページ目)。'.$tdk_head.'の保育士求人・転職・募集情報を掲載するポータルサイトFINE!。あなたにぴったりの保育士・幼稚園の求人や募集情報を探せます。保育士の転職やお仕事探しに役立つ情報も満載！';
            $tdk_array['keyword'] = $tdk_head;
        } else {
            $tdk_array = array();
        }

    $pref_kana = str_replace('p_', '', $this->uri->segment(1));
    $this->smarty->assign('pref_kana', $pref_kana);

    $this->smarty->assign('tdk_array',$tdk_array);

        $this->smarty->assign('action_search', $this->uri->segment(1) );

        //4. display U_2
        if ($search_type == 'search_area') {
            $this->smarty->display($this->template_path()."/user/job/areatop.html");
        }else{
            $this->smarty->display($this->template_path()."/user/job/search.html");
        }

    }






    public function prefecture($prefecture){
        $this->smarty->display($this->template_path()."/user/job/areatop.html");
    }










    protected function _response_view($response){
        header('Content-Type: text/json; charset=utf-8');
        echo json_encode($response);
        exit;
    }
    /*
    this page is job detail page.
    if client type ==1 , this is agent
    if client type ==2 , this is nursery
    */
    public function detail($job_id){
        if(!is_numeric($job_id)){
             $this->general_error(404);
            exit;
        }

        //get user_id;
        $job_param["user_id"] = $this->_get_user_id();
        $job_param["job_id"]  = $job_id;


    //最近みた求人
    $userdata = $this->_get_session();
    if(!empty($userdata['recent_job'])){
        $recent_job = $userdata['recent_job'];
        $this->_remove_session('recent_job',$recent_job);
    }else{
        $recent_job = array();
    }
    //既に見ているかどうか？見ていたらその時のjob_idを削除、歯抜けをつめる
    $already_seen_job = array_search($job_id, $recent_job);
    if($already_seen_job){
        unset($recent_job[$already_seen_job]);
        $recent_job = array_values($recent_job);
    }
    $recent_job[] = $job_id;
    $this->_set_session('recent_job',$recent_job);


        $job_detail_info = $this->Service_job->get_detail_info($job_param);
        if(empty($job_detail_info)){
             $this->general_error(404);
            exit;
        }

        $this->load->model("Service_agent");
        $data = $this->Service_agent->get_agent_detail_all($job_detail_info["client_detail"]["client_id"]);
        if(empty($data["agent"])){
             $this->general_error(404);
            exit;
        }

        $this->load->helper("image_helper");
        $this->load->helper("display_helper");

        foreach($data as $assign_name => $assign_val)$this->smarty->assign($assign_name,$assign_val);

        //check if unpublished status.if
        $status_param = array('job_status'          =>  $job_detail_info['job_detail']['job']['status'],
            'job_delete_flg'      =>  $job_detail_info['job_detail']['job']['delete_flg'],
            'nursery_status'      =>  $job_detail_info['nursery_detail']['status'],
            'nursery_delete_flg'  =>  $job_detail_info['nursery_detail']['delete_flg'],
            'client_delete_flg'   =>  $job_detail_info['client_detail']['delete_flg']
        );
        $open_status = $this->_check_input_detail($status_param);
        if($open_status === false){
            //redirect false
             $this->general_error(404);
            exit;
        }

        //add same area jobs
        $detail_area_id    =    $job_detail_info['nursery_detail']['area_id'];
        $selected_job_id   =    $job_detail_info['job_detail']['job']['job_id'];
        $job_related_list  =    $this->Service_job->get_related_area_list($detail_area_id, $selected_job_id);

        $this->load->helper('job');

        // breadcrum
        $current_area_id = $job_detail_info['nursery_detail']['area_id'];
        $this->load->model('Service_area');
        $area_datas = $this->Service_area->full_area($current_area_id);
        $param = array('pref','city','job_current');
        $bc_element['pref_name'] = $area_datas['prefname'];
        $bc_element['pref_romaji'] = $area_datas['pref_romaji'];
        $bc_element['city_romaji'] = $area_datas['c_romaji'];
        $bc_element['pref_id'] = $area_datas['pref_id'];
        $bc_element['city_id'] = $area_datas['city_id'];
        $bc_element['city_name'] = $area_datas['cname'];
        $bc_element['job_title'] = $job_detail_info['job_detail']['job']['title'];
        $bc_element['job_id']    = $job_detail_info['job_detail']['job']['job_id'];
        $this->_bread_crumb['base_url'] = base_url();
        $this->_bread_crumb['content'] = get_breadcrumb('job_detail',$bc_element);
        $this->smarty->assign('breadcrumb' , $this->_bread_crumb);
        $this->smarty->assign('job_related_list',$job_related_list);
        $this->smarty->assign('job_detail_info',$job_detail_info);
        /*$isApplied = 0;
        if ($this->is_login()){

            // ThinhNH: get user apply this job status
            $params = [
                'user_id' => $job_param["user_id"],
                'job_id' => $job_id
            ];
            $this->load->model('Service_apply');
            $isApplied = $this->Service_apply->already_apply($params);
        }*/
        $this->smarty->assign('image_type', $this->config->item('image_config'));
        //$this->smarty->assign('isApplied', $isApplied);
        $this->smarty->assign('user_id', $job_param["user_id"]);
        $this->smarty->assign('login', $this->is_login());

    //tdk
    $tdk_parts = array();
    if(!empty($job_detail_info['job_detail']['tags']['tag_job'])){
        foreach($job_detail_info['job_detail']['tags']['tag_job'] as $data){
        $tdk_parts[] = html_escape($data['tag_detail']['name']);
        }
    }
    $tdk_tag_nursery = array();
    if(!empty($job_detail_info['nursery_detail']['tags']['tag_nursery'])){
        foreach($job_detail_info['nursery_detail']['tags']['tag_nursery'] as $data){
        $tdk_parts[] = html_escape($data['tag_detail']['name']);
        }
    }
    $tdk_job_type = array();
    if(!empty($job_detail_info['job_detail']['tags']['type_job'])){
        foreach($job_detail_info['job_detail']['tags']['type_job'] as $data){
            $tdk_parts[] = html_escape($data['tag_detail']['name']);
        }
    }
    $tdk_employ_type = array();
    if(!empty($job_detail_info['job_detail']['tags']['type_employ'])){
        foreach($job_detail_info['job_detail']['tags']['type_employ'] as $data){
        $tdk_parts[] = html_escape($data['tag_detail']['name']);
        }
    }
    $tdk_keyword = implode(',',$tdk_parts).',';

    $tdk_array['title'] = $job_detail_info['job_detail']['job']['title'].'｜保育士求人サイトFINE!';
    $tdk_array['description'] = $job_detail_info['job_detail']['job']['title'].'。保育士求人／転職／募集情報を掲載するポータルサイトFINE!。あなたにぴったりの保育士・幼稚園の求人や募集情報を探せます。';
    $tdk_array['keyword'] = $tdk_keyword;
    $this->smarty->assign('tdk_array',$tdk_array);
        $this->smarty->display($this->template_path()."/user/job/detail.html");
    }

    public function preview($job_id){
	$useragent = $this->template_path();
	if($useragent == "sp"){
	    $this->smarty->display('pc/user/error/sp.html');
	}

        $client_data = $this->session->userdata('client_data');
        if(!$client_data['client_id'] || empty($client_data['client_id'])){
            $this->tracker();
            redirect($this->config->config["base_url"]."client/login");
        }
        
        
        if(!is_numeric($job_id)){
            show_404();
            exit;
        }

        //get user_id;
        $job_param["user_id"] = $this->_get_user_id();
        $job_param["job_id"]  = $job_id;

        $job_detail_info = $this->Service_job->get_detail_info($job_param);

        if(empty($job_detail_info) || empty($client_data) || $client_data['client_id'] != $job_detail_info['client_detail']['client_id']){
            show_404();
            exit;
        }

        $this->load->model("Service_agent");
        $data = $this->Service_agent->get_agent_detail_all($job_detail_info["client_detail"]["client_id"]);

        if(empty($data["agent"])){
            show_404();
            exit;
        }

        $this->load->helper("image_helper");
        $this->load->helper("display_helper");

        foreach($data as $assign_name => $assign_val)$this->smarty->assign($assign_name,$assign_val);

        //check if unpublished status.if
        $status_param = array('job_status'          =>  $job_detail_info['job_detail']['job']['status'],
            'job_delete_flg'      =>  $job_detail_info['job_detail']['job']['delete_flg'],
            'nursery_status'      =>  $job_detail_info['nursery_detail']['status'],
            'nursery_delete_flg'  =>  $job_detail_info['nursery_detail']['delete_flg'],
            'client_delete_flg'   =>  $job_detail_info['client_detail']['delete_flg']
        );
        $open_status = $this->_check_preview_input($status_param);
        if($open_status === false){
            //redirect false
             redirect(base_url()."user/error/notfound/");
            exit;
        }

        //add same area jobs
        $detail_area_id    =    $job_detail_info['nursery_detail']['area_id'];
        $selected_job_id   =    $job_detail_info['job_detail']['job']['job_id'];
        $job_related_list  =    $this->Service_job->get_related_area_list($detail_area_id, $selected_job_id);

        $this->load->helper('job');

        // breadcrum
        $current_area_id = $job_detail_info['nursery_detail']['area_id'];
        $this->load->model('Service_area');
        $area_datas = $this->Service_area->full_area($current_area_id);
        $param = array('pref','city','job_current');
        $bc_element['pref_name'] = $area_datas['prefname'];
        $bc_element['pref_romaji'] = $area_datas['pref_romaji'];
        $bc_element['city_romaji'] = $area_datas['c_romaji'];
        $bc_element['pref_id'] = $area_datas['pref_id'];
        $bc_element['city_id'] = $area_datas['city_id'];
        $bc_element['city_name'] = $area_datas['cname'];
        $bc_element['job_title'] = $job_detail_info['job_detail']['job']['title'];
        $bc_element['job_id']    = $job_detail_info['job_detail']['job']['job_id'];
        $this->_bread_crumb['base_url'] = base_url();
        $this->_bread_crumb['content'] = get_breadcrumb('job_detail',$bc_element);

        $this->smarty->assign('breadcrumb' , $this->_bread_crumb);
        $this->smarty->assign('job_related_list',$job_related_list);
        $this->smarty->assign('job_detail_info',$job_detail_info);

        $this->smarty->assign('image_type', $this->config->item('image_config'));
        //$this->smarty->assign('isApplied', $isApplied);
        $this->smarty->assign('user_id', $job_param["user_id"]);
        $this->smarty->assign('login', $this->is_login());

    //tdk
    $tdk_parts = array();
    if(!empty($job_detail_info['job_detail']['tags']['tag_job'])){
        foreach($job_detail_info['job_detail']['tags']['tag_job'] as $data){
        $tdk_parts[] = html_escape($data['tag_detail']['name']);
        }
    }
    $tdk_tag_nursery = array();
    if(!empty($job_detail_info['nursery_detail']['tags']['tag_nursery'])){
        foreach($job_detail_info['nursery_detail']['tags']['tag_nursery'] as $data){
        $tdk_parts[] = html_escape($data['tag_detail']['name']);
        }
    }
    $tdk_job_type = array();
    if(!empty($job_detail_info['job_detail']['tags']['type_job'])){
        foreach($job_detail_info['job_detail']['tags']['type_job'] as $data){
            $tdk_parts[] = html_escape($data['tag_detail']['name']);
        }
    }
    $tdk_employ_type = array();
    if(!empty($job_detail_info['job_detail']['tags']['type_employ'])){
        foreach($job_detail_info['job_detail']['tags']['type_employ'] as $data){
        $tdk_parts[] = html_escape($data['tag_detail']['name']);
        }
    }
    $tdk_keyword = implode(',',$tdk_parts).',';

    $tdk_array['title'] = $job_detail_info['job_detail']['job']['title'].'｜保育士求人サイトFINE!';
    $tdk_array['description'] = $job_detail_info['job_detail']['job']['title'].'。保育士求人／転職／募集情報を掲載するポータルサイトFINE!。あなたにぴったりの保育士・幼稚園の求人や募集情報を探せます。';
    $tdk_array['keyword'] = $tdk_keyword;
    $this->smarty->assign('tdk_array',$tdk_array);

        $this->smarty->display("pc/user/job/preview.html");
    }


    /**
     * [check input status, delete_flg for each entity, ]
     * @param  [array] $status_param
     *         $status_param = array('job_status'    =>  $job_detail_info['job_detail'][0]['status'],
     *                         'job_delete_flg'      =>  $job_detail_info['job_detail'][0]['delete_flg'],
     *                         'nursery_status'      =>  $job_detail_info['nursery_detail'][0]['status'],
     *                         'nursery_delete_flg'  =>  $job_detail_info['nursery_detail'][0]['delete_flg'],
     *                         'client_delete_flg'   =>  $job_detail_info['client_detail'][0]['delete_flg']
     *                         );
     * @return [boolean]               [true:show false:do not show]
*/
    private function _check_input($status_param){
        if(($status_param['job_status']             == $this->config->item('public','job_config'))
            &&($status_param['job_delete_flg']      == $this->config->item('not_deleted','common_config'))
            &&($status_param['nursery_status']      == $this->config->item('public','nursery_config'))
            &&($status_param['nursery_delete_flg']  == $this->config->item('not_deleted','common_config'))
            &&($status_param['client_delete_flg']   == $this->config->item('not_deleted','common_config'))){
            return true;
        }else{
            return false;
        }
    }
    private function _check_input_detail($status_param){
        if(($status_param['job_delete_flg']      == $this->config->item('not_deleted','common_config'))
            &&($status_param['nursery_status']      == $this->config->item('public','nursery_config'))
            &&($status_param['nursery_delete_flg']  == $this->config->item('not_deleted','common_config'))
            &&($status_param['client_delete_flg']   == $this->config->item('not_deleted','common_config'))){
            return true;
        }else{
            return false;
        }
    }
    /**
     * [check input status, delete_flg for each entity, ]
     * @param  [array] $status_param
     *         $status_param = array('job_status'    =>  $job_detail_info['job_detail'][0]['status'],
     *                         'job_delete_flg'      =>  $job_detail_info['job_detail'][0]['delete_flg'],
     *                         'nursery_delete_flg'  =>  $job_detail_info['nursery_detail'][0]['delete_flg'],
     *                         'client_delete_flg'   =>  $job_detail_info['client_detail'][0]['delete_flg']
     *                         );
     * @return [boolean]               [true:show false:do not show]
*/
    private function _check_preview_input($status_param){
        if(($status_param['job_delete_flg']      == $this->config->item('not_deleted','common_config'))
            &&($status_param['nursery_status']      == $this->config->item('public','nursery_config'))
            &&($status_param['nursery_delete_flg']  == $this->config->item('not_deleted','common_config'))
            &&($status_param['client_delete_flg']   == $this->config->item('not_deleted','common_config'))){
            return true;
        }else{
            return false;
        }
    }
    /*
    this page is basically job detail page ,
    job detail page has several sheet , this is 園情報 's page
    */
    public function nursery_info() {
        $job_id = $this->uri->segment(3);
        //$user_data  = $this->session->userdata('userdata'); // It wrong
        $user_data = $this->session->userdata('user_data'); // Use this
        // $user_data = array('user_id' => 1, 'login' => true);
        /*$this->load->model("Service_agent");
        $data = $this->Service_agent->get_agent_detail_all($client_id);

        if(empty($data["agent"])){
            show_404();
            exit;
        }

        $this->load->helper("image_helper");
        $this->load->helper("display_helper");

        foreach($data as $assign_name => $assign_val)$this->smarty->assign($assign_name,$assign_val);*/


        $job_param  = array('job_id'     =>  $job_id,
            'user_id'     =>  $user_data['user_id']);
        $job_detail_info = $this->Service_job->get_detail_info($job_param);
        //1. get nursery_id
        $nursery_id = $job_detail_info['job_detail']['job']['nursery_id'];
        $nursery_info = $this->Service_nursery->get_detail($nursery_id);

        if ($nursery_info['account_type'] == $this->config->item('account_type_agent','client_config')) {
             redirect(base_url()."user/job/$job_id/agent_info");
        }
        $job_area_id   =  $job_detail_info['nursery_detail']['area_id'];
        $job_related_list =  $this->Service_job->get_related_area_list($job_area_id, $job_id);


        // breadcrum
        $current_area_id = $job_detail_info['nursery_detail']['area_id'];
        $this->load->model('Service_area');
        $area_datas = $this->Service_area->full_area($current_area_id);
        $param = array('pref','city','job_current');
        $bc_element['pref_name'] = $area_datas['prefname'];
        $bc_element['pref_id'] = $area_datas['pref_id'];
        $bc_element['city_id'] = $area_datas['city_id'];
        $bc_element['city_name'] = $area_datas['cname'];
        $bc_element['job_title'] = $job_detail_info['job_detail']['title'];
        $bc_element['job_id']    = $job_detail_info['job_detail']['job_id'];
        $this->_bread_crumb['base_url'] = base_url();
        $this->_bread_crumb['content'] = get_breadcrumb('job_detail',$bc_element);

        $this->smarty->assign('breadcrumb' , $this->_bread_crumb);


        //please search job which same Group_id==5 and 3 6's tag and same city 's job
        //4.U20

        $this->smarty->assign('job_detail_info',$job_detail_info);
        $this->smarty->assign('nursery_info',$nursery_info);
        $this->smarty->assign('job_related_list',$job_related_list);
        $this->smarty->assign('user_data', $user_data);
        //4.U20
        $this->smarty->display($this->template_path()."/user/job/nursery_info.html");
    }
    /*
    this page is basically job detail page.
    job detail has several sheet this is 紹介会社情報
    */
    public function agent_info() {

        $job_id = $this->uri->segment(4);
        //$user_data  = $this->session->userdata('userdata'); // It wrong
        $user_data = $this->session->userdata('user_data'); // Use this
        // $user_data = array('user_id' => 1, 'login' => true);
        $job_param  = array('job_id'     =>  $job_id,
            'user_id'     =>  $user_data['user_id']);
        $job_detail_info = $this->Service_job->get_detail_info($job_param);

        $agent_id = $job_detail_info['job_detail']['job']['nursery_id'];
        $agent_info = $this->Service_agent->get_detail($agent_id);
        // $this->Service_agent->get_pr_detail($agent_id);

        if ($agent_info['account_type'] == $this->config->item('account_type_nursery','client_config')) {
             redirect(base_url()."user/job/$job_id/nursery_info");
        }
        $careeradviser_list = $this->Service_agent->get_careeradviser_detail($agent_id);
        $job_area_id   =  $job_detail_info['nursery_detail']['area_id'];
        $job_related_list =  $this->Service_job->get_related_area_list($job_area_id, $job_id);

        // breadcrum
        $current_area_id = $job_detail_info['nursery_detail']['area_id'];
        $this->load->model('Service_area');
        $area_datas = $this->Service_area->full_area($current_area_id);
        $param = array('pref','city','job_current');
        $bc_element['pref_name'] = $area_datas['prefname'];
        $bc_element['pref_id'] = $area_datas['pref_id'];
        $bc_element['city_id'] = $area_datas['city_id'];
        $bc_element['city_name'] = $area_datas['cname'];
        $bc_element['job_title'] = $job_detail_info['job_detail']['title'];
        $bc_element['job_id']    = $job_detail_info['job_detail']['job_id'];
        $this->_bread_crumb['base_url'] = base_url();
        $this->_bread_crumb['content'] = get_breadcrumb('job_detail',$bc_element);

        $this->smarty->assign('breadcrumb' , $this->_bread_crumb);

        //please search job which same Group_id==5 and 3 6's tag and same city 's job
        //6.U21
        $this->smarty->assign('job_detail_info',$job_detail_info);
        $this->smarty->assign('agent_info',$agent_info);
        $this->smarty->assign('careeradviser_list',$careeradviser_list);
        $this->smarty->assign('user_data', $user_data);
        $this->smarty->assign('job_related_list',$job_related_list);
        $this->smarty->display($this->template_path()."/user/job/agent_info.html");
    }

    public function complete_apply($login_type,$apply_type,$job_id){

        $this->load->config('apply_config');
        $apply_config = $this->config->item('complete_apply','apply_config');

        if(empty($apply_config[$login_type]||empty($apply_config[$apply_type])))show_404();

        $this->load->model("Service_job");
        $job_detail = $this->Service_job->get_detail($job_id);

        if(empty($job_detail))show_404();

        //パンくず
        $bc_param = array($apply_config[$login_type] === 'signup' ? 'signup' : 'mypage', 'complete_apply_'.$apply_config[$login_type].'_'.$apply_config[$apply_type].'_current');
        $this->_bread_crumb['content'] = get_static_breadcrumb($bc_param);

        $this->smarty->assign('breadcrumb' , $this->_bread_crumb);

        $this->smarty->assign("job_detail",$job_detail);

        $this->smarty->display($this->template_path().'/user/'.$apply_config[$login_type].'/complete_'.$apply_config[$apply_type].'.html');
    }


    /*
    this page is for SEO 's drill link
    */
    public function links () {
        //$this->Service_tag->get_list();
        //$this->Service_job->get_list();

    }

    protected function _format_get_parameter($get_parameter){
        $select_parameter = array();
        foreach($get_parameter as $key=>$parameter){
            $parameter_array = explode(",",$parameter);
            foreach($parameter_array as $parameter_value){
                if(!empty($parameter_value)){
                    $select_parameter[$key][$parameter_value] = true;
                }
            }
        }
        return $select_parameter;
    }

    /**
     *  for U_2 , get recommend list.
     * @param  [type] $recommend_job_param [description]
     * @return $recommend_job_list(3 jobs with detail info)
     */
    protected function _get_job_recommend_list($recommend_job_param){
        $recommend_job_param['limit_from']      = 0;
        $recommend_job_param['limit_to']        = 4;
        //unset nursery search condition
        if(!empty($recommend_job_param['nursery_tag_id'])){
            unset($recommend_job_param['nursery_tag_id']);
        }
        $recommend_job_list = $this->Service_job->get_search_list($recommend_job_param);
        return $recommend_job_list;
    }

    /**
     * TUYENNT
     * search line by pref_cd
     * @param array
     */
    //todo search line by pref_cd
    public function search_line()
    {
        $uri = $_SERVER['REQUEST_URI'];

        //generate uri
        $get_string = strstr($uri, '/');
        $segment = explode('/',ltrim($get_string,'/'));

        //get pref_id
        $pref_id = $this->Logic_area->get_pref_id_by_romaji($segment[1]);
        $pref_id = $pref_id->pref_id;
        $_SESSION['pref_id'] = $pref_id;

        //get pref info
        if($pref_id) {
            $pref = $this->Service_area->get_pref_by_id($pref_id);
        }

        //get all companies and all lines
        $companies = $this->Logic_line->get_all_company_and_all_line_by_pref_cd($pref_id);


        foreach( $companies as &$company )
        {
            foreach($company['lines'] as &$line) {
                //get total job by line_id

                $list_lines = $this->Logic_job->get_count_jobs_by_line_id($line['line_id'], $pref_id);
                $total_job = 0;
                if (count($list_lines)>0){
                    $total_job = $list_lines[0]['total_job'];
                }
                $line['total'] = $total_job;
            }
            //sort oder by total_job DESC
            usort($company['lines'], function($a, $b){
                return $a['total']<$b['total'];
            });
        }

        //get job list of this pref
        $user_data  = $this->_get_user_session();
        $area_id = $this->Service_area->get_area_id($pref['name'], $pref['name']);

        $search_param["pref_id"]        =  array($area_id);
        $search_param['user_id']        =  empty($user_data['user_id']) ? null : $user_data['user_id'];
        $search_param['job_status']     =  $this->config->item('public','job_config');
        $search_param['nursery_status'] =  $this->config->item('public','nursery_config');
        $search_param['delete_flg']     =  $this->config->item('not_deleted','common_config');
        //count job
        $job_all_count  = $this->Service_job->search_count($search_param);
        $this->smarty->assign('job_all_count', $job_all_count);

        //for display pagenation and how many will this get jobs
        if($this->template_path() == "sp"){
            $range = $this->config->item('search_result_rows_sp','job_config');
        }else{
            $range = $this->config->item('search_result_rows','job_config');
        }
        //set pagination
        $list_param['range']      = $range;
        $list_param['page']       = 1;
        $list_param['limit']      = $job_all_count;

        $pagination_param = $this->Service_search->pagination($list_param);

        //parse param
        $page = $pagination_param['result_page'];
        $page_count = $pagination_param['page_count'];
        $search_param_alt = $pagination_param['search_param'];
        $search_param['limit_to'] = $search_param_alt['limit_to'];
        $search_param['limit_from'] = $search_param_alt['limit_from'];
        $pagination = $this->_get_pagination($page_count,$list_param['range']);

        //$this->load->helper('image');
        $this->smarty->assign('image_type', $this->config->item('job', 'image_config'));

        //finish to set param, get job_list for main content
        $job_list       = $this->Service_job->get_search_list($search_param);

        if(count($job_list) > $range){
            $job_list = array_slice($job_list, 0,$range);
        }
        $this->smarty->assign('job_list',$job_list);

        $this->config->load('prefecture_seo_config',TRUE);
        $seo_text = $this->config->item($segment[1],'prefecture_seo_config');
        $this->smarty->assign('seo_text',$seo_text);

        $related_area = $this->Service_job->get_related_area($pref_id);
        $this->smarty->assign('related_areas',$related_area);

        $this->smarty->assign('pref_cd',$pref_id);
        $this->smarty->assign('pref',$pref);
        $this->smarty->assign('companies',$companies);
        $this->smarty->display($this->template_path()."/user/job/stationtop.html");
    }
    
    /**
     * Get Url before login
     */
    protected function tracker() {
        $this->load->helper('url');

        $tracker = $this->session->userdata('_tracker');
    
        if( !$this->input->is_ajax_request() && 
            ( ! preg_match("/logout/i", $this->uri->uri_string()) && 
                ! preg_match("/login_execute/i", $this->uri->uri_string())  && 
                ! preg_match("/login/i", $this->uri->uri_string()) ) 
        ) {
            if( count($tracker) >= 2 ){
                $this->session->set_userdata( '_tracker', null );
            }
            
            $tmpArg = array(
                'uri'   =>      $this->uri->uri_string(),
                'ruri'  =>      $this->uri->ruri_string(),
                'timestamp' =>  time()
            );
            
            if(count($tracker) >= 1 || 
                preg_match("/logout/i", $this->uri->uri_string()) &&
                preg_match("/login_execute/i", $this->uri->uri_string())  &&
                preg_match("/login/i", $this->uri->uri_string()) ){
                array_shift($tracker);
                array_push($tracker, $tmpArg);
            }else{
                $tracker[] = $tmpArg;
            }
        }
        $this->session->set_userdata( '_tracker', $tracker );
    }
}
