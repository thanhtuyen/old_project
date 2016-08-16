<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once 'User_abstract.php';

class Agent extends User_abstract
{
    public function __construct() {
        parent::__construct();
        if(!$this->is_login()){
            $this->_set_backurl($this->config->config["base_url"].$this->uri->uri_string);
            redirect($this->config->config["base_url"]."login");
        }

        // Count for menu
        // 1. bookmark
        // 2. applied job
        // 3. applied agent
        /*$this->load->model('Service_bookmark');
        $this->load->model('Service_agent');
        $this->load->model('Service_apply');
        $userdata = $this->session->userdata('user_data');
        $params= [
            'user_id' => $userdata['user_id'],
            'status' => 1,
            'delete_flg' => $this->config->item('not_deleted', 'common_config'),
        ];
        $CountBookmark = $this->Service_bookmark->count($params);
        $this->smarty->assign('CountBookmark', $CountBookmark);
        // Count Applied job
        $params= [
            'user_id' => $userdata['user_id'],
        ];
        $CountAppliedJob = $this->Service_apply->count_user_applied_job($params);
        $this->smarty->assign('CountAppliedJob', $CountAppliedJob);
        // Count Applied agent
        $params= [
            'user_id' => $userdata['user_id'],
            'status' => 1,
            'delete_flg' => $this->config->item('not_deleted', 'common_config'),
        ];
        $CountAppliedAgent = $this->Service_agent->count_agency_applied($params);
        $this->smarty->assign('CountAppliedAgent', $CountAppliedAgent);*/

    //service
        $this->load->model('Service_job');
        $this->load->model('Service_nursery');
        $this->load->model('Service_tag');
        $this->load->model('Service_nursery');
        $this->load->model('Service_area');
        $this->load->model('Service_ad');

        //helper
        $this->load->helper('List');
        $this->load->helper('job');
        $this->load->helper('image');
    }

    /*
    this page is agent list page
    */
    public function index() {
        //[U_5]

        $this->load->helper("image");
        $this->config->load("client_config", true);
        $this->config->load("image_config", true);
        $params["select"]                   = "client.*,image.name as image_name";
        $params["where"]["client.account_type"]     = $this->config->item("client_agency","client_config");
        $params["where"]["client.delete_flg"]       = $this->config->item("active","client_config");
        $params["where"]["image.type"]              = $this->config->item("client","image_config");
        $params["where"]["image.delete_flg"]        = $this->config->item("valid","image_config");
        $this->load->model("Service_agent");
        $agent_list = $this->Service_agent->get_agent_list($params);

        //please ask status to yamamoto

        $bc_param = array('agent_index_current');
        $this->_bread_crumb['base_url'] = base_url();
        $this->_bread_crumb['content'] = get_static_breadcrumb($bc_param);

        $this->smarty->assign('breadcrumb' , $this->_bread_crumb);

        // add more
        $this->smarty->assign('config_image_client', $this->config->item('client', 'image_config'));
        // end

        $this->smarty->assign("agent_list", $agent_list);

    //tdk
        $tdk_array['title'] = '紹介会社別に園を探す｜保育士の求人・転職・募集ならFINE!';
        $tdk_array['description'] = '紹介会社別に園を探すページです。全国の保育士求人／転職／募集情報を掲載するポータルサイトFINE!。あなたにぴったりの保育士・幼稚園の求人や募集情報を探せます。';
        $this->smarty->assign('tdk_array',$tdk_array);

        $this->smarty->display($this->template_path()."/user/agent/index.html");
    }

    /*
     * //[U_6]
     * this page is agent detail page
     */
    public function detail($client_id = null){
        if(!is_numeric($client_id)){
            redirect($this->config->config["base_url"]."agent");
            exit;
        }

        $data = $this->Service_agent->get_agent_detail_all($client_id);

        if(empty($data["agent"])){
             $this->general_error(404);
            exit;
        }

        $this->load->helper("image_helper");
        $this->load->helper("display_helper");

        $bc_element['item'] = array('agent_index', 'agent_detail_current');
        $bc_element['client_id'] = $data['agent']['client_id'];
        $bc_element['agent_name'] = $data['agent']['display_name'];
        $this->_bread_crumb['base_url'] = base_url();
        $this->_bread_crumb['content'] = get_breadcrumb('agent_detail',$bc_element);

        $this->smarty->assign('breadcrumb' , $this->_bread_crumb);

        // if you done set get param, please activate
        if(empty($param)){
            $get = $this->input->get();
        }elseif(array_key_exists('get',$param)){
            $get = $param['get'];
        }
        $this->load->model('Service_job');

        //reset pagenation data
        $page = 1;
        //check unexpected get parameter
        if(empty($get)){
            $search_request = array();
            $search_word = "全ての求人";
        }else{
            $search_request = $this->Service_job->parse_search_request($get);
            // make search keyword to display
            if(!empty($param['word'])){
                $search_word = $param['word'];
            }else{
                $search_word = $this->Service_job->get_search_word($search_request);
            }
            //pagenation here
            if(!empty($search_request['page'])){
                $page = $search_request['page'];
            }
        }
        $this->smarty->assign('search_word',$search_word);

        //2.get user_data
        $user_data  = $this->_get_user_session();

        //2. please get job list of this pref and city
        $search_param['user_id']        =  empty($user_data['user_id']) ? null : $user_data['user_id'];
        $search_param['client_id']        =  empty($client_id) ? null : $client_id;
        $search_param['job_status']     =  $this->config->item('public','job_config');
        $search_param['nursery_status'] =  $this->config->item('public','nursery_config');
        $search_param['delete_flg']     =  $this->config->item('not_deleted','common_config');
        //count job
        $job_all_count  = $this->Service_job->search_count($search_param);
        $this->smarty->assign('job_all_count',$job_all_count);

        //3. get current condition.
        //for display pagenation and how many will this get jobs

        $list_param['range']      = $this->config->item('search_result_rows','job_config');
        $list_param['page']       = $page;
        $list_param['limit']      = $job_all_count;

        //set display job limitation
        $search_param['limit_to']   = next_endpoint($list_param);
        $this->smarty->assign('limit_to',$search_param['limit_to']);
        $search_param['limit_from'] = next_startpoint($list_param,$search_param['limit_to'],$page);
        $this->smarty->assign('limit_from',$search_param['limit_from']);
        //make pagenation
        $page_count = 0;
        if($job_all_count > 1000){
            $page_count = 1000;
        }else{
            $page_count = $job_all_count;
        }
        $pagination = $this->_get_pagination($page_count,$list_param['range']);

        $this->smarty->assign('pagination',$pagination);

        //finish to set param, get job_list for main content
        $job_list       = $this->Service_job->get_search_list($search_param);
        $this->smarty->assign('job_list',$job_list);

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
        //below assigns are for search box.
        // assign area data array
        $this->load->model("Service_area");
        $area = $this->Service_area->get_pref_city_list();
        $this->smarty->assign("area",$area);
        // assign tag data array
        $this->load->model("Service_tag");
        $tags = $this->Service_tag->get_tag_list_all();
        $this->smarty->assign("tags",$tags);

        $this->smarty->assign('ad',$ad);
        $this->smarty->assign('user_data', $user_data);

        //assing breadcrumb
        $bc_element['area'] = $area;
        $bc_element['tags'] = $tags;
        $this->_bread_crumb['content'] = get_breadcrumb('job_search',$bc_element);
        $this->smarty->assign('breadcrumb' , $this->_bread_crumb);

        //new job judgement
        $new_date = date('Y-m-d H:i:s',strtotime('-10days'));
        $this->smarty->assign('new_date' , $new_date);

        //4. U_2
        $this->smarty->assign("tags",$this->Service_tag->get_tag_list_all());
        $this->smarty->assign('user_data', $user_data);

        //imageヘルパーをviewで使うためにロード
        $this->load->helper("image_helper");

        $this->smarty->assign('breadcrumb' , $this->_bread_crumb);
        //$this->load->helper('image');
        $this->smarty->assign('image_type', $this->config->item('job', 'image_config'));

        //for sp autoload
        $totle_page = ceil($job_all_count/$list_param['range']);
        if($totle_page > $page) {
            $next_page = ($page + 1) > $totle_page ? $totle_page : ($page + 1);
            $data['next_page'] = $next_page;
        }
        $data['range'] = $list_param['range'];

        foreach($data as $assign_name => $assign_val){
            $this->smarty->assign($assign_name,$assign_val);
        }

    //tdk
        $tdk_array['title'] = html_escape($data["agent"]["display_name"]).'｜保育士の求人・転職・募集ならFINE!';
        $tdk_array['description'] = html_escape($data["agent"]["display_name"]).'のページです。全国の保育士求人／転職／募集情報を掲載するポータルサイトFINE!。あなたにぴったりの保育士・幼稚園の求人や募集情報を探せます。';
        $this->smarty->assign('tdk_array',$tdk_array);

        $this->smarty->display($this->template_path()."/user/agent/detail.html");
    }

    /*
    this page is for agent page
    */
    public function service_flow() {
        //[U_22]
        //1. get agent_id
        //2. get service info of this agent
        //   $this->Service_agent->get_service_detail($agent_id);
        $bc_element['item'] = array('agent_index', 'agent_detail_current');
        $bc_element['client_id'] = $client_id;//client_idを入れる
        $bc_element['agent_name'] = $agent['name'];//会社名を入れる
        $this->_bread_crumb['base_url'] = base_url();
        $this->_bread_crumb['content'] = get_breadcrumb('agent_detail',$bc_element);

        $this->smarty->assign('breadcrumb' , $this->_bread_crumb);

        $this->smarty->display($this->template_path()."/user/agent/service_flow.html");
    }

    /*
    this page is for staff of agent
    */
    public function intro_staff() {
        //[U_23]
        //1. get agent_id
        //2. get agent's staff
        //$this->Service_agent->get_list($status);

        //$this->smarty->assign($sample, $sample);

        $bc_element['item'] = array('agent_index', 'agent_detail_current');
        $bc_element['client_id'] = $client_id;//client_idを入れる
        $bc_element['agent_name'] = $agent['name'];//会社名を入れる
        $this->_bread_crumb['base_url'] = base_url();
        $this->_bread_crumb['content'] = get_breadcrumb('agent_detail',$bc_element);

        $this->smarty->display($this->template_path()."/user/agent/intro_staff.html");
    }

    /*
    this page show list of agency
    */
    public function applicantlist()
    {
        $user_data  = $this->_get_user_session();
        $user_id  = $this->_get_user_id();

        $this->load->model('Service_agent');
        $client_list = $this->Service_agent->get_client_list($user_id);
        if(empty($client_list )){
            $client_exist = false;
        }else{
            $client_exist = true;
        }
        $this->smarty->assign('client_exist' , $client_exist);
        $bc_param = array('mypage', 'applicantlist_current');
        $this->_bread_crumb['base_url'] = base_url();
        $this->_bread_crumb['content'] = get_static_breadcrumb($bc_param);

        $this->smarty->assign('breadcrumb' , $this->_bread_crumb);
        $this->smarty->assign('image_type', $this->config->item('client', 'image_config'));
        $this->smarty->assign('client_list', $client_list);

    //tdk
        $tdk_array['title'] = '求人を紹介してもらう｜保育士の求人・転職・募集ならFINE!';
        $tdk_array['description'] = '紹介会社に求人を紹介してもらうページです。全国の保育士求人／転職／募集情報を掲載するポータルサイトFINE!。あなたにぴったりの保育士・幼稚園の求人や募集情報を探せます。';
        $this->smarty->assign('tdk_array',$tdk_array);

        $this->smarty->display($this->template_path()."/user/agent/applicant_list.html");
    }

    public function apply_agency()
    {
        $result = false;
        $client_ids = $this->input->post('apply_client_id',true);

        $user_id  = $this->_get_user_id();
        $user_data  = $this->_get_user_session();

        if($client_ids){
            $this->load->model('Service_agent');
            $result = $this->Service_agent->add_applicant_agency($user_id, $client_ids);

        if($result){
        $this->load->model('Service_user');
        $user = $this->Service_user->getDetail($user_id, 1, 0);
        $age = intval((date('Ymd')-str_replace("-","",$user['birthdate']))/10000);
        $user['age'] = ($age)? $age : "";

        $user["tag"] = $this->Service_user->get_user_related_tag($user_id);
        if(empty($user['tag'])){
            $result = false;
            redirect(base_url() . 'user/agent/applicantlist');
        }
        $employee = implode('、' ,$this->array_flatten($user['tag']['employee']));
        $license = implode('、' ,$this->array_flatten($user['tag']['license']));
        $this->load->model('Service_area');
        $full_area = $this->Service_area->full_area($user['area_id']);

        $this->load->model('Service_client');
        $this->load->model('Service_email');
        foreach($client_ids as $client_id){
            $data = $this->Service_client->get_detail($client_id);

            $clients[] = '会社名：'.$data['name']."\r\n紹介の流れ：".$data['process'];

            $params_client = [
                    'client_name' => $data['name'],
                    'client_contact_name' => $data['contact_name'],
                    'client_process' => $data['process'],
                    'licence' => $license,
                    'age' => $user['age'],
                    'employee' => $employee,
                    'address' => $full_area['prefname'].$full_area['cname'],
                    'to' => $data['mail']
                    ];

            $this->Service_email->applicant_agency_2client($params_client);
        }

        $content = "";
        foreach($clients as $key){
            $content .= $key."\r\n-------------------------------\r\n";
        }

        $params_user = [
                    'content' => $content,
                    'user_name' => $user['name'],
                    'to' => $user['mail']
                    ];
        $this->Service_email->applicant_agency_2user($params_user);
        $result = true;
        }
        }else{
        $result = false;
    }

    if($result){
            redirect(base_url() . 'user/agent/apply_complete');
    }else{
        redirect(base_url() . 'user/agent/applicantlist');
    }
    }

    public function apply_complete()
    {
    $bc_param = array('agent_index', 'agent_apply_complete_current');
        $this->_bread_crumb['base_url'] = base_url();
        $this->_bread_crumb['content'] = get_static_breadcrumb($bc_param);

    $this->smarty->assign('breadcrumb' , $this->_bread_crumb);

    //tdk
        $tdk_array['title'] = '応募完了｜保育士の求人・転職・募集ならFINE!';
        $tdk_array['description'] = '応募完了ページです。全国の保育士求人／転職／募集情報を掲載するポータルサイトFINE!。あなたにぴったりの保育士・幼稚園の求人や募集情報を探せます。';
        $this->smarty->assign('tdk_array',$tdk_array);

        $this->smarty->display($this->template_path()."/user/agent/apply_complete.html");
    }

    //多次元配列から単配列へ変換
    public function array_flatten($array){
    $result = array();
        foreach($array as $val){
            if(is_array($val)){
                $result = array_merge($result, array_flatten($val));
            }else{
                $result[]=$val;
            }
        }
    return $result;
    }

    private function _get_job_recommend_list($recommend_job_param){
        $recommend_job_param['limit_from']      = 0;
        $recommend_job_param['limit_to']        = 4;
        //unset nursery search condition
        if(array_key_exists('nursery_tag_id',$recommend_job_param)){
            unset($recommend_job_param['nursery_tag_id']);
        }
        $recommend_job_list = $this->Service_job->get_search_list($recommend_job_param);
        return $recommend_job_list;
    }


    public function next_page()
    {
        $client_id = $this->input->post('client_id',true);
        $page = $this->input->post('page',true);
        $user_data  = $this->_get_user_session();
        $search_param['user_id']        =  empty($user_data['user_id']) ? null : $user_data['user_id'];
        $search_param['client_id']        =  empty($client_id) ? null : $client_id;
        $search_param['job_status']     =  $this->config->item('public','job_config');
        $search_param['nursery_status'] =  $this->config->item('public','nursery_config');
        $search_param['delete_flg']     =  $this->config->item('not_deleted','common_config');

        $job_all_count  = $this->Service_job->search_count($search_param);

        $list_param['range']      = $this->config->item('search_result_rows','job_config');
        $list_param['page']       = $page;
        $list_param['limit']      = $job_all_count;

        //set display job limitation
        $search_param['limit_to']   = next_endpoint($list_param);
        $search_param['limit_from'] = next_startpoint($list_param,$search_param['limit_to'], $page);
        $job_list       = $this->Service_job->get_search_list($search_param);

        $totle_page = ceil($job_all_count/$list_param['range']);
        $next_page = 0;

        if($totle_page > $page) {
            $next_page = ($page + 1) > $totle_page ? $totle_page : ($page + 1);
        }

        $this->load->helper('image');
        $image_type = $this->config->item('job', 'image_config');
        foreach ($job_list as $key => $value) {
            $job_list[$key]['job_detail']['cover_image'] = getImageUrlFromS3($value['job_detail']['job']['job_id'],$image_type,$value['job_detail']['images'][0]['name']);
        }

        $result = array(
            'job_list' => $job_list,
            'next_page' => $next_page,
            'job_all_count' => $job_all_count,
            'limit_from' => $search_param['limit_from'],
            'limit_to' => $search_param['limit_to'],
        );
        header('Content-Type: text/json; charset=utf-8');
        echo json_encode($result);
        exit;
    }
}
