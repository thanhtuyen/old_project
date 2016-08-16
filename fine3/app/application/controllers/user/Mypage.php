<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once 'User_abstract.php';

class Mypage extends User_abstract
{
    public function __construct() {
        parent::__construct();
        if(!parent::is_login())redirect($this->config->config["base_url"]."login");
        $this->load->library('form_validation');
        $this->load->helper("image_helper");
    }
    /*
    this page is logined top page, this page shows recommend job
    recomend means job near by user's city's
    */
    public function index() {
        //[UL_1]
        //$this->Service_user->get_recommend_job($area_id)

        $bc_param = array('mypage_current');
        $this->_bread_crumb['base_url'] = base_url();
        $this->_bread_crumb['content'] = get_static_breadcrumb($bc_param);

        $this->smarty->assign('breadcrumb' , $this->_bread_crumb);
        $user_id = $this->_get_user_id();
        if(empty($user_id)){
            redirect(base_url().'login/');
        }
        $user_param["select"] = "";
        $user_param["where"]  = array('user_id'=>$user_id);
        $this->load->model('Service_user');
        $user_data = $this->Service_user->get_user_data($user_param);
        if(empty($user_data)){
            redirect(base_url().'login/');
        }
        $user_area_id = $user_data[0]['area_id'];
        $search_param['user_id']        = $user_id;
        $search_param['job_status']     =  $this->config->item('public','job_config');
        $search_param['nursery_status'] =  $this->config->item('public','nursery_config');
        $search_param['delete_flg']     =  $this->config->item('not_deleted','common_config');
        $search_param['area_id']        = $this->Service_area->get_around_ids($user_area_id);
        $search_param['tag']            = $this->Service_user->get_user_related_tag($user_id);
        $search_param['limit_from']     = 0;
        $search_param['limit_to']       = 4;
        $job_list       = $this->Service_job->get_search_list($search_param);

        $this->load->helper('image');
        $this->smarty->assign('job_list', $job_list);
        $this->smarty->assign('image_type', $this->config->item('job', 'image_config'));

    //tdk
        $tdk_array['title'] = 'あなたにオススメの求人｜保育士の求人・転職・募集ならFINE!';
        $tdk_array['description'] = 'あなたにオススメの求人のページです。全国の保育士求人／転職／募集情報を掲載するポータルサイトFINE!。あなたにぴったりの保育士・幼稚園の求人や募集情報を探せます。';
        $this->smarty->assign('tdk_array',$tdk_array);

        $this->smarty->display($this->template_path()."/user/mypage/index.html");
    }

    /**
     * this page is apply job 's list of user
     */
    public function apply_job_history() {
        //[UL_2]
        $userdata = $this->session->userdata('user_data');

        if (empty($userdata)){
             redirect(base_url().'/login');
             exit;
        }

        $user_id = $userdata['user_id'];

        $perpage = $this->input->get('limit');
        $perpage = $perpage ? $perpage : $this->config->item('search_result_rows','job_config');
        $curpage = $this->input->get('page');
        $curpage = $curpage ? $curpage : 1;

        $this->load->model('Service_user');
        $data = $this->Service_user->get_applyed_job($user_id, $perpage, $curpage);
        $pagination = $this->_get_pagination($data['total'], $data['perpage']);

        $bc_param = array('mypage', 'applylist_job_current');
        $this->_bread_crumb['base_url'] = base_url();
        $this->_bread_crumb['content'] = get_static_breadcrumb($bc_param);

        $this->smarty->assign('breadcrumb' , $this->_bread_crumb);
        $this->smarty->assign('curpage' , $curpage);
        $this->smarty->assign('image_type', $this->config->item('image_config'));
        $this->smarty->assign('data', $data);

        $this->smarty->assign('pagination', $pagination);

    //tdk
        $tdk_array['title'] = '求人への応募履歴｜保育士の求人・転職・募集ならFINE!';
        $tdk_array['description'] = '求人への応募履歴のページです。全国の保育士求人／転職／募集情報を掲載するポータルサイトFINE!。あなたにぴったりの保育士・幼稚園の求人や募集情報を探せます。';
        $this->smarty->assign('tdk_array',$tdk_array);

        $this->smarty->display($this->template_path()."/user/mypage/apply_job_history.html");
    }

    /*
    this page is apply to agent of user
    */
    public function apply_agent_history() {
        //$this->Service_user->get_applyagent($user_id);
        //[UL_3]
        $userdata = $this->session->userdata('user_data');
        if (empty($userdata) || ! $userdata['login']){
             redirect(base_url().'/login');
             exit;
        }

        $client_status_active = 0;

        // Count all row apply for agency of current user
        $params= [
            'user_id' => $userdata['user_id'],
            'status' => $client_status_active,
            'delete_flg' => $this->config->item('not_deleted', 'common_config'),
        ];
        $this->load->model('Service_agent');
        $total_row = $this->Service_agent->count_agency_applied($params);

        // List all row applied agency of current user
        $rowAppliedAgency = false;
        $linkPage       = false;
        $count_view     = false;
        // If exist count row applied agency
        // will find each row
        if( $total_row ){
            $params = [
                'select' => '*',
                'delete_flg' => $this->config->item('not_deleted', 'common_config'),
                'status' => $client_status_active,
                'user_id' => $userdata['user_id'],
            ];

            // Config Pagination start
            $limit = $this->config->item('search_result_rows', 'job_config');
            $per_page   = $this->input->get('per_page', 1);
            $per_page   = (($per_page)? $per_page: 1);
            $offset     = ($per_page - 1) * $limit;
            $linkPage   = $this->_get_pagination($total_row, $limit);

            $count_view['limit']        = $limit;
            $count_view['total']        = $total_row;
            $count_view['from_item']    = ($limit * ($per_page - 1)) +1 ;
            $count_view['to_item']      = ($count_view['from_item'] + $limit) -1;
            if($count_view['to_item'] > $total_row) $count_view['to_item'] = $total_row;
            // End

            $rowAppliedAgency = $this->Service_agent->get_all_applied_agency($params, $offset, $limit);
        }


        $bc_param = array('mypage', 'applylist_agent_current');
        $this->_bread_crumb['base_url'] = base_url();
        $this->_bread_crumb['content'] = get_static_breadcrumb($bc_param);

        $this->smarty->assign('breadcrumb' , $this->_bread_crumb);

        $this->smarty->assign('count_view', $count_view);
        $this->smarty->assign('rowAppliedAgency', $rowAppliedAgency);
        $this->smarty->assign('linkPage', $linkPage);

    //tdk
        $tdk_array['title'] = '紹介会社への応募履歴｜保育士の求人・転職・募集ならFINE!';
        $tdk_array['description'] = '紹介会社への応募履歴のページです。全国の保育士求人／転職／募集情報を掲載するポータルサイトFINE!。あなたにぴったりの保育士・幼稚園の求人や募集情報を探せます。';
        $this->smarty->assign('tdk_array',$tdk_array);

        $this->smarty->display($this->template_path()."/user/mypage/apply_agent_history.html");
    }
    /**
     * Pagination agency use ajax for sp
     * @since 2015/04/22
     */
    public function agency_ajax_page(){
        $userdata = $this->session->userdata('user_data');
        if (empty($userdata) || ! $userdata['login']){
             redirect(base_url().'/login');
        }
        $data = ['content' => '','status' => 0, 'pagination' => '', 'count_page' => ''];
        // Config Pagination start
        $limit = $this->config->item('search_result_rows', 'job_config');
        $content = [];
        $pagination = [];

        $page = intval( $this->input->post('page',true) );

        // Count all row apply for agency of current user
        $params= [
            'user_id' => $userdata['user_id'],
            'status' => 1,
            'delete_flg' => $this->config->item('not_deleted', 'common_config'),
        ];
        $this->load->model('Service_agent');
        $total_row = $this->Service_agent->count_agency_applied($params);

        // Total Count & compare result;
        $offset                = $page * $limit;

        $count_view['limit']        = $limit;
        $count_view['total']        = $total_row;
        $count_view['from_item']    = ($limit * $page) +1 ;
        $count_view['to_item']      = ($count_view['from_item'] + $limit) -1;
        $to_item                    = $count_view['to_item'];
        if($count_view['to_item'] > $total_row) $count_view['to_item'] = $total_row;

        $count_view['offset']       = $page + 1;

        $countTmp = $to_item-$limit;
        if($total_row && ($countTmp <= $total_row)){
            // Load parser library
            $this->load->library('parser');

            $compareTotal = $count_view['to_item'];
            if($compareTotal < $total_row){
                // Load pagination bookmark
                $argParam = array(
                    'count_view' => $count_view,
                    'base_url' => $this->config->item('base_url'),
                    'csrf_token_name' => $this->config->item('csrf_token_name'),
                    'csrf_token_value' => $this->security->get_csrf_hash()
                );
                foreach ( (array) $argParam as $key => $item){
                    $this->smarty->assign($key, $item);
                }

                $pagination = $this->smarty->fetch('sp/user/mypage/pagination_agency.html');
            }

            // Load count page
            $this->smarty->assign('count_view', $count_view);
            $count_page = $this->smarty->fetch('sp/user/mypage/count_page.html');

            // Config params for select result
            $params = [
                'select' => '*',
                'delete_flg' => $this->config->item('not_deleted', 'common_config'),
                'status' => '1',
                'user_id' => $userdata['user_id'],
            ];
            $rowAppliedAgency = $this->Service_agent->get_all_applied_agency($params, $offset, $limit);

            if($rowAppliedAgency && ! empty($rowAppliedAgency)){
                // Load item bookmark
                $argParam = array(
                    'records' => $rowAppliedAgency,
                    'base_url' => $this->config->item('base_url')
                );
                foreach ( (array) $argParam as $key => $item){
                    $this->smarty->assign($key, $item);
                }

                $content = $this->smarty->fetch('sp/user/mypage/item_agency.html');
            }
            $data = ['content' => $content,'status' => 1, 'pagination' => $pagination, 'count_page' => $count_page];
        }
        return $this->output->set_output(json_encode($data));
    }
    /*
    this page showes user's bookmark
    */
    public function bookmark() {

        $userdata = $this->session->userdata('user_data');
        if (empty($userdata) || ! $userdata['login']){
             redirect(base_url().'/login');
        }

        $this->load->model('Service_bookmark');
        $total_row = $this->Service_bookmark->count($userdata['user_id']);

        // List job had bookmarked of current user
        $rowBookmarks   = false;
        $linkPage       = false;
        $count_view     = false;

        if( $total_row ){
            $params = [
                'select' => '*, n.*, n.name as nursery_name,area.name as nursery_city,province.name as nursery_province, n.address as nursery_address',
                'delete_flg' => $this->config->item('not_deleted', 'common_config'),
                'status' => '1',
                'user_id' => $userdata['user_id'],
            ];

            // Config Pagination start
            $limit = $this->config->item('search_result_rows', 'job_config');
            $per_page   = $this->input->get('page', 1);
            $per_page   = (($per_page)? $per_page: 1);
            $offset     = ($per_page - 1) * $limit;
            $linkPage   = $this->_get_pagination($total_row, $limit);

            $count_view['limit']        = $limit;
            $count_view['total']        = $total_row;
            $count_view['from_item']    = ($limit * ($per_page - 1)) +1 ;
            $count_view['to_item']      = ($count_view['from_item'] + $limit) -1;
            if($count_view['to_item'] > $total_row) $count_view['to_item'] = $total_row;
            // End
            $rowBookmarks = $this->Service_bookmark->get_bookmark($params, $offset, $limit);
        }

        $bc_param = array('mypage', 'bookmark_current');
        $this->_bread_crumb['base_url'] = base_url();
        $this->_bread_crumb['content'] = get_static_breadcrumb($bc_param);

        $this->smarty->assign('breadcrumb' , $this->_bread_crumb);

        $this->smarty->assign('count_view', $count_view);
        $this->smarty->assign('limit', $limit);
        $this->smarty->assign('total_count', $total_row);

        $this->smarty->assign('bookmarks', $rowBookmarks);
        $this->smarty->assign('linkPage', $linkPage);

        $this->load->helper('image');
        $this->smarty->assign('image_type', $this->config->item('image_config'));

    //tdk
        $tdk_array['title'] = 'お気に入り求人｜保育士の求人・転職・募集ならFINE!';
        $tdk_array['description'] = 'お気に入り求人のページです。全国の保育士求人／転職／募集情報を掲載するポータルサイトFINE!。あなたにぴったりの保育士・幼稚園の求人や募集情報を探せます。';
        $this->smarty->assign('tdk_array',$tdk_array);

        //UL_4 by aya
        $this->smarty->display($this->template_path()."/user/mypage/bookmark.html");
    }
    /**
     * Pagination bookmark use ajax for sp
     * @since 2015/04/22
     */
    public function bookmark_ajax_page(){
        $userdata = $this->session->userdata('user_data');
        if (empty($userdata) || ! $userdata['login']){
             redirect(base_url().'/login');
        }
        $data = ['content' => '','status' => 0, 'pagination' => '', 'count_page' => ''];
        // Config Pagination start
        $limit = $this->config->item('search_result_rows', 'job_config');
        $content = [];
        $pagination = [];

        $page = intval( $this->input->post('page',true) );

        // Count all row bookmarked of current user
        $params= [
            'user_id' => $userdata['user_id'],
            'status' => 1,
            'delete_flg' => $this->config->item('not_deleted', 'common_config'),
        ];
        $this->load->model('Service_bookmark');
        $total_row = $this->Service_bookmark->count($params);

        // Total Count & compare result;
        $offset                = $page * $limit;

        $count_view['limit']        = $limit;
        $count_view['total']        = $total_row;
        $count_view['from_item']    = ($limit * $page) +1 ;
        $count_view['to_item']      = ($count_view['from_item'] + $limit) -1;
        $to_item                    = $count_view['to_item'];
        if($count_view['to_item'] > $total_row) $count_view['to_item'] = $total_row;

        $count_view['offset']       = $page + 1;

        $countTmp = $to_item-$limit;

        if($total_row && ($countTmp <= $total_row)){
            // Load parser library
            $this->load->library('parser');

            $compareTotal = $count_view['to_item'];
            if($compareTotal < $total_row){
                // Load pagination bookmark
                $argParam = array(
                        'count_view' => $count_view,
                        'base_url' => $this->config->item('base_url'),
                        'csrf_token_name' => $this->config->item('csrf_token_name'),
                        'csrf_token_value' => $this->security->get_csrf_hash()
                    );
                foreach ( (array) $argParam as $key => $item){
                    $this->smarty->assign($key, $item);
                }

                $pagination = $this->smarty->fetch('sp/user/mypage/pagination_bookmark.html');
            }

            // Load count page
            $this->smarty->assign('count_view', $count_view);
            $count_page = $this->smarty->fetch('sp/user/mypage/count_page.html');

            // Config params for select result
            $params = [
                'select' => '*, n.*, n.name as nursery_name,area.name as nursery_city,province.name as nursery_province, n.address as nursery_address',
                'delete_flg' => $this->config->item('not_deleted', 'common_config'),
                'status' => '1',
                'user_id' => $userdata['user_id'],
            ];
            $rowBookmarks = $this->Service_bookmark->get_bookmark($params, $offset, $limit);

            if($rowBookmarks && ! empty($rowBookmarks)){
                // Load item bookmark
                $argParam = array(
                        'records' => $rowBookmarks,
                        'base_url' => $this->config->item('base_url'),
                        'csrf_token_name' => $this->config->item('csrf_token_name'),
                        'csrf_token_value' => $this->security->get_csrf_hash()
                    );
                foreach ( (array) $argParam as $key => $item){
                    $this->smarty->assign($key, $item);
                }
                $this->smarty->assign('image_type', $this->config->item('image_config'));
                $content = $this->smarty->fetch('sp/user/mypage/item_bookmark.html');
            }
            $data = [
                'content' => $content,
                'status' => 1,
                'pagination' => $pagination,
                'count_page' => $count_page,
                'current_page' => $page,
                'current_item' => $count_view['to_item'],
            ];
        }
        return $this->output->set_output(json_encode($data));
    }

    /*
    this page is for profile of user
    //UL_5
    */
    public function profile() {
        $user_id = $this->_get_user_id();
        if(empty($user_id)){
            redirect(base_url().'login/');
        }
        $this->smarty->assign('user_id',$user_id);


        $user_param["select"] = "";
        $user_param["where"]['user_id'] = $user_id;
        $this->load->model('Service_user');
        $user_data_arr = $this->Service_user->get_user_data($user_param);

        $user_data = $user_data_arr[0];
        $user_data["tag"] = $this->Service_user->get_user_related_tag($user_id);

        $bc_param = array('mypage', 'profile_current');
        $this->_bread_crumb['base_url'] = base_url();
        $this->_bread_crumb['content'] = get_static_breadcrumb($bc_param);

        $this->smarty->assign('breadcrumb' , $this->_bread_crumb);
        $this->smarty->assign('user_data' , $user_data);

    //tdk
        $tdk_array['title'] = '登録情報｜保育士の求人・転職・募集ならFINE!';
        $tdk_array['description'] = '登録情報のページです。全国の保育士求人／転職／募集情報を掲載するポータルサイトFINE!。あなたにぴったりの保育士・幼稚園の求人や募集情報を探せます。';
        $this->smarty->assign('tdk_array',$tdk_array);

        $this->smarty->display($this->template_path()."/user/mypage/profile.html");
    }

    /*
    this page is for editing user profile
    */
    public function profile_edit() {
        //get from profile action
        //UL_6
        $user_id = $this->_get_user_id();
        if(empty($user_id)){
            redirect(base_url().'login/');
        }
        $user_param["select"] = "";
        $user_param["where"]['user_id'] = $user_id;
        $this->load->model('Service_user');
        $user_data_arr = $this->Service_user->get_user_data($user_param);

        $data["user_data"] = $user_data_arr[0];
        $data["user_data"]["tag"] = $this->Service_user->get_user_related_tag($user_id);

        $this->load->model("Service_area");
        $data["area"]  = $this->Service_area->get_pref_city_list();

        $this->config->load("signup");
        $age_limit = $this->config->item("signup_age_limit");
        $year = date('Y') - $age_limit["lower"];
        $count = $age_limit["upper"] - $age_limit["lower"];
        while($count >= 0){
            $data["year"][] = $year;
            --$year;
            --$count;
        }

        $this->load->model('Service_signup');
        $data["employee"] = $this->Service_signup->getTagsByGroups(array(3));
        $data["license"] = $this->Service_signup->getTagsByGroups(array(4));

        foreach($data as $assign_key => $assign_val)$this->smarty->assign($assign_key,$assign_val);

        $bc_param = array('mypage', 'profile', 'profile_edit_current');
        $this->_bread_crumb['base_url'] = base_url();
        $this->_bread_crumb['content'] = get_static_breadcrumb($bc_param);

        $this->smarty->assign('breadcrumb' , $this->_bread_crumb);

        //tdk
        $tdk_array['title'] = '登録情報の変更｜保育士の求人・転職・募集ならFINE!';
        $tdk_array['description'] = '登録情報の変更のページです。全国の保育士求人／転職／募集情報を掲載するポータルサイトFINE!。あなたにぴったりの保育士・幼稚園の求人や募集情報を探せます。';
        $this->smarty->assign('tdk_array',$tdk_array);

        $this->smarty->display($this->template_path()."/user/mypage/profile_edit.html");
    }

    public function profile_update(){

        $this->config->load('input_config');

        $params["check_input"] = $this->input->post(null,true);
        $params["check_column"] = $this->config->item("input_update_user");
        $params["redirect"] = "/";

        $post = $this->check_input($params);

        $this->load->model("Service_user");
        $result = $this->Service_user->update($post);

        if($result){
	    $user_data = $this->session->userdata('user_data');
	    $user_data['user_name'] = $post['name'];
	    $this->session->set_userdata('user_data', $user_data);

            redirect($this->config->config["base_url"]."mypage/profile_finished");
            exit;
        }else{
            redirect($this->config->config["base_url"]."server_error");
        }
    }

    /*
    this page is update profile
    */
    public function profile_finished() {

        //[UL_10]
        $bc_param = array('mypage', 'profile', 'profile_edit', 'profile_finished_current');
        $this->_bread_crumb['base_url'] = base_url();
        $this->_bread_crumb['content'] = get_static_breadcrumb($bc_param);

        $this->smarty->assign('breadcrumb' , $this->_bread_crumb);

    //tdk
        $tdk_array['title'] = '登録情報の変更完了｜保育士の求人・転職・募集ならFINE!';
        $tdk_array['description'] = '登録情報の変更完了のページです。全国の保育士求人／転職／募集情報を掲載するポータルサイトFINE!。あなたにぴったりの保育士・幼稚園の求人や募集情報を探せます。';
        $this->smarty->assign('tdk_array',$tdk_array);

        $this->smarty->display($this->template_path()."/user/mypage/profile_finished.html");
    }

    /*
    this page is just showed
    */
    /**
     * Change password
     * @since 2015/05/05
     */
    public function change_password() {
    //[UL_7]
        $user_id = $this->_get_user_id();
        if(empty($user_id)){
            redirect(base_url().'login/');
        }

        $bc_param = array('mypage', 'profile','change_password_current');
        $this->_bread_crumb['base_url'] = base_url();
        $this->_bread_crumb['content'] = get_static_breadcrumb($bc_param);

        $this->smarty->assign('breadcrumb' , $this->_bread_crumb);
        /**
         * Post data
         */
        $post = $this->input->post(null,true);
        $result = false;
        if(isset($post) && $post && ! empty($post)){
            if( $this->rule_validate_change_password( $post ) ){
                $this->load->model('Service_user');
                $result = $this->Service_user->change_password($user_id, $post['pass']);
                if($result){
                    redirect(base_url().'user/mypage/change_password_execute/');
                }
            }

        }

    //tdk
        $tdk_array['title'] = 'パスワード変更｜保育士の求人・転職・募集ならFINE!';
        $tdk_array['description'] = 'パスワード変更のページです。全国の保育士求人／転職／募集情報を掲載するポータルサイトFINE!。あなたにぴったりの保育士・幼稚園の求人や募集情報を探せます。';
        $this->smarty->assign('tdk_array',$tdk_array);

        $this->smarty->display($this->template_path()."/user/mypage/change_password.html");
    }
    /**
     * Function rule validate change password
     * @param array $post
     * @since 2015/05/05
     */
    protected function rule_validate_change_password( $post ){
        $this->form_validation->set_rules('oldpass', 'Old password', 'required|callback_matches_password|callback_old_password',
            [
                'required' => '<div class="message"><div>※半角英数字で入力してください。</div></div>',
                'matches_password' => '<div class="message"><div>現在のパスワードを入力してください。</div></div>',
                'old_password' => '<div class="message"><div>現在のパスワードを入力してください。</div></div>',
            ]);
        $this->form_validation->set_rules('newpass', 'New password', 'required|min_length[6]|callback_matches_password',
            [
                'required' => '<div class="message"><div>※6文字以上の半角英数字で入力してください。</div></div>',
                'min_length' => '<div class="message"><div>※6文字以上の半角英数字で入力してください。</div></div>',
                'matches_password' => '<div class="message"><div>新しいパスワードを入力してください。</div></div>',
            ]);
        $this->form_validation->set_rules('pass', 'Password', 'required|min_length[6]|callback_confirm_password['.$post['newpass'].']|callback_matches_password',
            [
                'required' => '<div class="message"><div>※6文字以上の半角英数字で入力してください。</div></div>',
                'min_length' => '<div class="message"><div>※6文字以上の半角英数字で入力してください。</div></div>',
                'confirm_password' => '<div class="message"><div>新しいパスワード（確認用）を入力してください。</div></div>',
                'matches_password' => '<div class="message"><div>新しいパスワード（確認用）を入力してください。</div></div>',
            ]);

        return $this->form_validation->run();
    }
    /**
     * Check old password
     * @param string $pass
     * @return boolean
     * @since 2015/05/05
     */
    public function old_password($pass){
        $user_id = $this->_get_user_id();

        $this->load->model('Service_user');
        $user_param["select"] = "";
        $user_param["where"]  = array('user_id'=>$user_id);
        $user_data = $this->Service_user->get_user_data($user_param);
        if(md5($pass) != $user_data[0]['password']){
            return false;
        }
        return true;
    }
    /**
     * Check type password
     * @param string $pass
     * @return boolean
     * @since 2015/05/05
     */
    public function matches_password($pass){
        $pattern = '/^[A-Za-z0-9]+$/i';
        if(! preg_match($pattern, $pass) ){
            return false;
        }
        return true;
    }
    /**
     * Check confirm password
     * @param string $pass
     * @param string $newpass
     * @return boolean
     * @since 2015/05/05
     */
    public function confirm_password($pass, $newpass){
        if($pass != $pass){
            return false;
        }
        return true;
    }
    /*
    this page execute changing password
    */
    public function change_password_execute() {
        $user_id = $this->_get_user_id();
        if(empty($user_id)){
            redirect(base_url().'login/');
        }

        //$this->Service_account->change_pass_2user ($param);
        //$this->Service_mail->send_change_password_mail();
        //{UL_11}
        $bc_param = array('mypage', 'profile','change_password', 'change_password_execute_current');

        $this->_bread_crumb['base_url'] = base_url();
        $this->_bread_crumb['content'] = get_static_breadcrumb($bc_param);

        $this->smarty->assign('breadcrumb' , $this->_bread_crumb);

    //tdk
        $tdk_array['title'] = 'パスワード変更完了｜保育士の求人・転職・募集ならFINE!';
        $tdk_array['description'] = 'パスワード変更完了のページです。全国の保育士求人／転職／募集情報を掲載するポータルサイトFINE!。あなたにぴったりの保育士・幼稚園の求人や募集情報を探せます。';
        $this->smarty->assign('tdk_array',$tdk_array);

        $this->smarty->display($this->template_path()."/user/mypage/change_password_execute.html");
    }

    /*
    this page is for withdraw , just showing
    */
    public function withdraw() {
        //[UL_8]

        $userdata = $this->session->userdata('user_data');
        if (empty($userdata) || ! $userdata['login']){
             redirect(base_url().'/login');
        }

        //
        // withdrawal_config not already load yet
        // I load this config to use
        $this->config->load('withdrawal_config', TRUE);
        //
        // Load value withdraw_config, use in withdraw form
        $data = [
            'hard_use'      => $this->config->item('hard_use',      'withdrawal_config'),
            'no_job'        => $this->config->item('no_job',        'withdrawal_config'),
            'quit_change'   => $this->config->item('quit_change',   'withdrawal_config'),
            'finish_change' => $this->config->item('finish_change', 'withdrawal_config'),
        ];
        $this->smarty->assign('reason_value', $data);

        //
        //validate input data
        $this->form_validation->set_rules('reason[]', 'Reason', 'callback_validateReason');
        $this->form_validation->set_rules('message', 'その他ご意見', 'max_length[255]',
            [
                'max_length' => '255文字以内で入力してください。',
            ]);
        
        $post = $this->input->post(null,true);

        if($post){
            $result = $this->form_validation->run();

            if($result){
                $this->session->set_flashdata('withdraw', $post);
                return  redirect(base_url().'/user/mypage/withdraw_complete');
            }
        }

    $bc_param = array('mypage', 'withdraw_current');
        $this->_bread_crumb['base_url'] = base_url();
        $this->_bread_crumb['content'] = get_static_breadcrumb($bc_param);

        $this->smarty->assign('breadcrumb' , $this->_bread_crumb);

    //tdk
        $tdk_array['title'] = '退会｜保育士の求人・転職・募集ならFINE!';
        $tdk_array['description'] = '退会のページです。全国の保育士求人／転職／募集情報を掲載するポータルサイトFINE!。あなたにぴったりの保育士・幼稚園の求人や募集情報を探せます。';
        $this->smarty->assign('tdk_array',$tdk_array);

        return $this->smarty->display($this->template_path()."/user/mypage/withdraw.html");

    }



    /*
    this page is for withdraw complete
    */
    public function withdraw_complete() {

        //[UL_4] <- U_4 is correct by Aya
        $userdata = $this->session->userdata('user_data');
        $withdraw = $this->session->flashdata('withdraw');

        if (empty($userdata) || empty($withdraw)){
             redirect(base_url().'/');
        }

        if (isset($userdata['login']) && $userdata['login'] && $userdata['user_id'])
        {
            $user_id = (int)$userdata['user_id'];
            $this->load->model('Service_user');
            $user = $this->Service_user->getDetail($user_id, 1, 0);

            if (!$user){
                 redirect(base_url().'/');
            }

            $this->load->model('Service_account');
            $result = $this->Service_account->withdraw($user, $withdraw);


            if($result){
                $this->session->set_userdata('user_data', []);

        $bc_param = array('mypage', 'withdrawi', 'withdraw_complete_current');
        $this->_bread_crumb['base_url'] = base_url();
        $this->_bread_crumb['content'] = get_static_breadcrumb($bc_param);

        $this->smarty->assign('breadcrumb' , $this->_bread_crumb);

        //tdk
        $tdk_array['title'] = '退会手続き完了｜保育士の求人・転職・募集ならFINE!';
        $tdk_array['description'] = '退会手続き完了のページです。全国の保育士求人／転職／募集情報を掲載するポータルサイトFINE!。あなたにぴったりの保育士・幼稚園の求人や募集情報を探せます。';
        $this->smarty->assign('tdk_array',$tdk_array);

                return $this->smarty->display($this->template_path()."/user/mypage/withdraw_complete.html");
            }
        }

         redirect(base_url().'/user/mypage/withdraw');
    }

    /**
     * Validate Reason
     * @param array $reason
     * @return boolean
     */
    public function validateReason($reason){
        $result = false;
        $data = array(
                $this->config->item('hard_use',      'withdrawal_config'),
                $this->config->item('no_job',        'withdrawal_config'),
                $this->config->item('quit_change',   'withdrawal_config'),
                $this->config->item('finish_change', 'withdrawal_config')
            );

        foreach( (array) $data as $key => $value){
            if($reason == "$value"){
                $result = true;
                break;
            }
        }

        if(! $result){
            $this->form_validation->set_message('validateReason', '退会理由を選択してください。');
        }

        return $result;
    }

    /**
     * validate input data when submit
     *
     * @return boolean
     */
    protected function validateFormSubmit(){

        //validate input data
        $this->form_validation->set_rules($this->rules());

        $result = $this->form_validation->run();

        return $result;
    }
}
