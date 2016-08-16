<?php
/**
 * For Ajax controller
 */
class Ajax extends MY_Controller
{
    const RESPONSE_CODE_ERROR	= 0;	// Ajax Response : ERROR
    const RESPONSE_CODE_SUCCESS	= 1;	// Ajax Response : SUCCESS

    public function __construct() {
        parent::__construct();

        /* ajaxリクエスト以外をはじくバリデーション
        if($this->_is_ajax_process() === FALSE){
            header("location:".$this->config->config["base_url"]);
            exit();
        }*/
    }

    public function get_navbar(){

        $job_data = $this->session->userdata("job_data");
        if(empty($job_data["common"])){
            $this->load->model("Service_job");
            $job_data["common"] = $this->Service_job->get_now_job_info();
            $this->session->set_userdata(array("job_data"=>$job_data));
        }
        $this->smarty->assign("common_job_info",$job_data["common"]);

        if($this->is_login()){
            $job_data = $this->session->userdata("job_data");
            if(empty($job_data["entry"])){
                $this->load->model("Service_job");
                $job_data["entry"] = $this->Service_job->get_entry_job_count();
                $this->session->set_userdata(array("job_data"=>$job_data));
            }
            $this->smarty->assign("entry_job_count",$job_data["entry"]);
            $user_data = $this->session->userdata("user_data");
            if(empty($user_data["user_name"])){
                $this->load->model("Service_user");
                $user_data["user_name"] = $this->Service_user->get_user_name($user_data["user_id"]);
                if($user_data["user_name"] === false){
                    $this->report_to_administrator(array("subject"=>"【FINE!3.0 BUG_REPORT】nameのないユーザーレコードが発生中","message"=>$user_data));
                    redirect($this->config->config["base_url"]);
                    exit;
                }
                $this->session->set_userdata(array("user_data"=>$user_data));
            }
            $this->smarty->assign("user_name",$user_data["user_name"]);
        }

        $this->load->model("Service_column");
        $wp_category = $this->Service_column->get_wp_category();
        $this->smarty->assign("wp_category",$wp_category);

        $this->smarty->assign("login",parent::is_login());

        $path = $this->template_path();

        $html["headbar"] = $this->smarty->fetch($path."/user/common/headbar.html", null, null, null, false);

        $html["navbar"] = $this->smarty->fetch($path."/user/common/navbar.html", null, null, null, false);

        $html["right_nav"] = $this->smarty->fetch($path."/user/common/right_nav.html", null, null, null, false);

        $html["footer"] = $this->smarty->fetch($path."/user/common/footer.html", null, null, null, false);

        header('Content-Type: text/json; charset=utf-8');
        echo json_encode($html);
        exit;
    }

    protected function is_login(){
        $user_data = $this->session->userdata("user_data");
        if(empty($user_data["login"])){
            $user_data["login"] = false;
            $this->session->set_userdata(array("user_data"=>$user_data));
            return false;
        }else{
            return $user_data["login"];
        }
    }

    public function get_job_count(){
        $input = $this->_check_input(array("select"));

        if($input === false){
            redirect($this->config->config["base_url"]);
            exit;
        }

        $select["pref"]     = $input["select"]["select_pref"] * 1000;
        $select["city"]     = $input["select"]["select_city"];
        $select["job"]      = $input["select"]["select_job"];
        $select["nursery"]  = $input["select"]["select_nursery"];
        $select["employee"] = $input["select"]["select_employee"];
        $select["tag"]      = $input["select"]["select_tag"];

        $this->load->model("Service_job");
        $search_request = $this->Service_job->parse_search_request($select);

        $data = $this->Service_job->process_request($search_request,'pref_id');
        if($data !== false){
            $search_param['pref_id']            = $data;
        }
        $data = $this->Service_job->process_request($search_request,'city_id');
        if($data !== false){
            $search_param['city_id']            = $data;
        }
        $data = $this->Service_job->process_request($search_request,'j_tag_id');
        if($data !== false){
            $search_param['job_tag_id']         = $data;
        }
        $data = $this->Service_job->process_request($search_request,'n_tag_id');
        if($data !== false){
            $search_param['nursery_tag_id']     = $data;
        }
        $user_session  = $this->session->userdata("user_data");

        $search_param['user_id']        = empty($user_session['user_id']) ? null : $user_session['user_id'];
        $search_param['job_status']     = $this->config->item('public','job_config');
        $search_param['nursery_status'] = $this->config->item('public','nursery_config');
        $search_param['delete_flg']     = $this->config->item('not_deleted','common_config');

        $count = $this->Service_job->search_count($search_param);

        return $this->_response_view($count);
    }

    public function readmore_apply_job(){

        $userdata = $this->session->userdata('user_data');
        $response = array();

        if (empty($userdata)){
            $response["code"] = self::RESPONSE_CODE_ERROR;
            return $this->_response_view($response);
        }


        $input = $this->_check_input(array("curpage","perpage"));

        $response["code"] = self::RESPONSE_CODE_ERROR;

        if(!empty($input)){
            if(!empty($userdata["login"]) && $userdata["login"]){
                $user_id = $userdata['user_id'];
                $this->load->model('Service_user');
                $this->load->helper('image');
                $this->smarty->assign('image_type', $this->config->item('job', 'image_config'));
                $data = $this->Service_user->get_applyed_job($user_id, $input['perpage'], $input['curpage']);
                if($data && !empty($data['items'])){
                    $this->smarty->assign('data', $data);
                    $html = $this->smarty->fetch('sp/user/mypage/apply_job_history_item.html');
                    $response["code"] = self::RESPONSE_CODE_SUCCESS;
                    $response["html"] = $html;
                    $response["quantity"] = count($data['items']);
                    //csrf token name
                    $response["csrf_test_name"]  = $this->security->get_csrf_token_name();
                    $response["csrf_token_value"]  = $this->security->get_csrf_hash();
                }
            }
        }

        return $this->_response_view($response);
    }


    public function check_user_exist(){
        $params["where"] = $this->input->post(null,true);

        $response["code"] = self::RESPONSE_CODE_ERROR;

        if(!empty($params)){
            $response["code"] = self::RESPONSE_CODE_SUCCESS;

            $params["select"] = array("user_id","name","status");
            //$params["where"]["status"] = 1;
            $params["where"]["delete_flg"] = 0;

            if(isset($params["where"]["password"]))$params["where"]["password"] = md5($params["where"]["password"]);
            $unique = false;
            if(isset($params["where"]["unique"])){
                $unique = $params["where"]["unique"];
                unset($params["where"]["unique"]);
            }

            $this->load->model("Service_user");
            $response["result"] = $this->Service_user->get_user_data($params);

            if($unique && count($response["result"]) > 1){
                parent::report_to_administrator(array("subject"=>"【FINE!3.0 BUG_REPORT】同じメールアドレスの有効ユーザーレコードが複数存在","message"=>$response["result"]));
                $response["code"] = self::RESPONSE_CODE_ERROR;
            }
        }
        $this->_response_view($response);
    }

    public function apply_for_job(){
        $input = $this->_check_input(array("job_id","type"));
        $response["code"] = self::RESPONSE_CODE_ERROR;
        if($input !== false){
            $user_session = $this->session->userdata("user_data");
            if(!empty($user_session["login"]) && $user_session["login"]){
                $this->load->model("Service_job");

                $service = $input["type"]."_job";

                $result = $this->Service_job->$service($user_session["user_id"],$input["job_id"]);
                if($result){
                    $response["code"] = self::RESPONSE_CODE_SUCCESS;
                    $response["result"] = 1;
                }
            }else{
                $user_session["select_job"]["job_id"] = $input["job_id"];
                $user_session["select_job"]["type"]   = $input["type"];
                $this->_set_session('common',$user_session);

                $response["type"] = $input["type"];
                $response["code"] = self::RESPONSE_CODE_SUCCESS;
                $response["result"] = 2;
            }
        }else{
            $response["code"] = self::RESPONSE_CODE_ERROR;
            $response['result'] = 0;
        }
        $this->_response_view($response);
    }

    public function same_mail_search(){
        $input = $this->_check_input(array("mail","type"));

        $response["code"] = self::RESPONSE_CODE_ERROR;

        if($input !== false){

            $params["select"] = array("user_id","mail");
            $params["where"]["mail"] = $input["mail"];
            $params["where"]["status"] = 1;
            $params["where"]["delete_flg"] = 0;

            $this->load->model("Service_user");
            $user_list = $this->Service_user->get_user_data($params);

            if(empty($user_list)){
                /* input mail is no record */
                $response["code"] = self::RESPONSE_CODE_SUCCESS;
                $response["result"] = 0;
            }elseif(count($user_list) > 1){
                /* ERROR! input mail is included some records*/
                $error_report["subject"] = "【fine3.0：BUGREPORT】同じメールアドレスのユーザーが複数レコード存在発見されました";
                $error_report["message"] = $user_list;
                $this->report_to_administrator($error_report);
            }else{
                $user_data = $this->session->userdata("user_data");
                if($input["type"] === "update" && $user_list[0]["user_id"] === $user_data["user_id"]){
                    /* input mail is own record */
                    $response["code"] = self::RESPONSE_CODE_SUCCESS;
                    $response["result"] = 0;
                }else{
                    /* input mail is included a record */
                    $response["code"] = self::RESPONSE_CODE_SUCCESS;
                    $response["result"] = 1;
                }
            }
        }
        $this->_response_view($response);
    }

    public function apply_job_multiple(){
        $input = $this->_check_input(array("job_str"));
        $user_session = $this->session->userdata("user_data");
        if($input === false || empty($user_session["user_id"])){
            redirect($this->config->config["base_url"]);
            exit;
        }

        $target_job_arr = explode(",",$input["job_str"]);

        $this->load->model("Service_job");
        foreach($target_job_arr as $job_id){
            $result[$job_id] = $this->Service_job->apply_job($user_session["user_id"],$job_id);
        }

        $response["code"] = self::RESPONSE_CODE_SUCCESS;
        $response["result"] = $result;

        $this->_response_view($response);

    }

    public function remove_bookmark_multiple(){
        $input = $this->_check_input(array("job_str"));
        $user_session = $this->session->userdata("user_data");
        if($input === false || empty($user_session["user_id"])){
            redirect($this->config->config["base_url"]);
            exit;
        }

        $this->load->model("Service_bookmark");
        $result = $this->Service_bookmark->remove_bookmark($input["job_str"],$user_session["user_id"]);

        if($result){
            $response["code"] = self::RESPONSE_CODE_SUCCESS;
        }else{
            $response["code"] = self::RESPONSE_CODE_ERROR;
        }

        $this->_response_view($response);
    }

    /**
     * check post parameters
     * @param array $params : required input keys
     * @return array $input : post values
     */
    private function _check_input($params = array()){
        $input = $this->input->post(null,true);

        foreach($params as $check_key){
            if(!isset($input[$check_key])){
                return false;
            }
        }
        return $input;
    }

    private function _response_view($response){
        header('Content-Type: text/json; charset=utf-8');
        echo json_encode($response);
        exit;
    }

    /**
     * check ajax request
     * @param none
     * @return boolean
     */
    private function _is_ajax_process() {
        if((!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === "xmlhttprequest")||strpos($_SERVER['HTTP_ACCEPT'], 'text/plain') !== false) {
            return TRUE;
        }else{
            return FALSE;
        }
    }


    /*
     in job detail page add bookmark
    */
    public function ajax_add_bookmark()
    {
        $job_id = intval($this->input->post('job_id',true));
        //$user_data  = $this->session->userdata('userdata'); // It wrong
        $user_data = $this->session->userdata('user_data'); // Use this
        $user_id = $user_data['user_id'];

        $this->output->set_content_type('application/json');
        $this->load->model('Service_job');
        $result = $this->Service_job->add_bookmark($user_id, $job_id);
        return $this->output->set_output(json_encode($result));
    }

    /*
     in job detail page add applicant_job
    */
    public function ajax_add_applicant_job()
    {
        $job_id = intval($this->input->post('job_id',true));
        //$user_data  = $this->session->userdata('userdata'); // It wrong
        $user_data = $this->session->userdata('user_data'); // Use this
        $user_id = $user_data['user_id'];
        $this->output->set_content_type('application/json');
        $this->load->model('Service_job');
        $result = $this->Service_job->add_applicant_job($user_id, $job_id);
        return $this->output->set_output(json_encode($result));
    }
}
