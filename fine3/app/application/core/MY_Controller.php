<?php

class MY_Controller extends CI_controller
{
    public function __construct() {
        parent::__construct();
        if(isset($_SERVER['HTTP_X_FORWARDED_PROTO'])){
            $base_url = "https://".$_SERVER["HTTP_HOST"]."/";
        }else{
            $base_url = "http://".$_SERVER["HTTP_HOST"]."/";
        }
        $this->smarty->assign('base_url', $base_url);
        $this->smarty->assign('static_url', $base_url."static/");

        //for default tdk
        $this->load->helper('tdk');
        $this->smarty->assign('tdk_array' , "");

        //breadcrumb look User_abstruct and Client_abstruct
        $this->load->helper('breadcrumb');

        //config
        $this->config->load('common_config', TRUE);
        $this->config->load('job_config', TRUE);
        $this->config->load('nursery_config', TRUE);
        $this->config->load('client_config', TRUE);
        $this->config->load('tag_config', TRUE);
        $this->config->load('apply_config', TRUE);
        $this->config->load('bookmark_config', TRUE);
        $this->config->load('career_adviser_config', TRUE);


        $this->config->load('export_column_config', TRUE);
        $this->config->load('plan_config', TRUE);
        $this->config->load('image_config', TRUE);
        $this->config->load('user_config', TRUE);
        $this->config->load('pref_config', TRUE);
        $this->config->load('ad_config', TRUE);

        //service
        $this->load->model('Service_job');
        $this->load->model('Service_nursery');
        $this->load->model('Service_client');
        $this->load->model('Service_tag');
        $this->load->model('Service_image');
        //csrf
        $this->smarty->assign('csrf_token_name', $this->config->item('csrf_token_name'));
        $this->smarty->assign('csrf_token_value', $this->security->get_csrf_hash());

    }

    protected function check_pc(){
        if($this->agent->is_mobile){
            return 0;
        }else{
            return 1;
        }
    }

    protected function template_path(){
        //return "sp";
        if (isset($_GET['tp'])){
            return $_GET['tp'];
        }

        if(self::check_pc() === 0){
            return "sp";
        }else{
            return "pc";
        }
    }

    protected function isPost()
    {
        return $this->input->server('REQUEST_METHOD') == 'POST';
    }

    /**
     * [get export file format ]
     * @return [string]
     */
    protected function get_format()
    {
        $format = $this->input->get('format');
        if (empty($format)) {
            $format = 'csv';
        }
        $format = ltrim($format, '.');
        return strtolower($format);
    }

    protected function send_file($filepath, $filename=null)
    {
        if (empty($filename)) {
            $filename = basename($filepath);
        }
        $this->load->library('XSendfile');
        if(ENVIRONMENT != 'development'){
            $this->xsendfile->sendfile($filepath, $filename, 'Apache');
        } else {
            $this->xsendfile->sendfile($filepath, $filename);
        }
    }

    /**
     * @param array $params["check_input"]: want to check array keys
     *                     ["check_column"]: require column   ex){"key1","key2","key3",....}
     *                     ["redirect"]: <not required> specified redirect link
     * @return boolean | redirect | input_arrays
     * @author shobu
     */
    protected function check_input($params){

        foreach($params["check_column"] as $column){
            if(empty($params["check_input"][$column])){
                if(!empty($params["redirect"])){
                    header("location: ".$params["redirect"]);
                    exit();
                }else{
                    return false;
                }
            }
        }
        return $params["check_input"];
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

    protected function _set_backurl($url){
        $user_data = $this->session->userdata("user_data");
        $user_data["backurl"] = $url;
        $this->session->set_userdata(array("user_data"=>$user_data));
    }

    /**
     *
     * @param int    $total_rows        : total number of paginate contents
     * @param int    $limit             : number of display contents on a page
     * @param array  $pagination_config : CI_pagination config  refer to config/pagination.php
     * @param string $url               : current url
     * @return pagination html code
     */

    protected function _get_pagination($total_rows, $limit, $pagination_config = "", $url = ""){
        $this->load->library('pagination');
        if(empty($url)) $url = current_url();

        if(empty($pagination_config)){
            $this->config->load("pagination",true);
            $pagination_config = $this->config->item("default","pagination");
        }

        $pagination_config['base_url'] = $url;
        $pagination_config["per_page"] = $limit;
        $pagination_config['total_rows'] = $total_rows;

        $this->pagination->initialize($pagination_config);
        $pagination = $this->pagination->create_links();

        return $pagination;
    }

    /**
     * @param array $report_data["subject"] : mail title
     *                          ["message"] : message(it will be serialized in sending)
     */
    protected function report_to_administrator($report_data){
        $this->load->config("admin");
        $destination = $this->config->item("report","admin");
        foreach($destination as $admin_to)mail($admin_to,$report_data["subject"],serialize($report_data["message"]));
    }


    public function getParam($key = null, $defaultValue = null)
    {
        if (null === $key) {
            return $this->input->get(null, true);
        }

        $param = $this->input->get($key, true);
        if (empty($param) && !empty($defaultValue)) {
            return $defaultValue;
        }
        return $param;
    }

    public function getPost($key = null, $defaultValue = null)
    {
        if (null === $key) {
            return $this->input->post(null, true);
        }

        $param = $this->input->post($key, true);
        if (empty($param) && !empty($defaultValue)) {
            return $defaultValue;
        }
        return $param;
    }

    protected function _assign_job_info(){
        $job_data = $this->session->userdata("job_data");
        $this->load->model("Service_job");
        $job_data["common"] = $this->Service_job->get_now_job_info();
        $this->session->set_userdata(array("job_data"=>$job_data));
        $this->smarty->assign("common_job_info",$job_data["common"]);
    }

    protected function _assign_common_params(){
        $userdata = $this->session->userdata('user_data');

        $this->load->model("Service_bookmark");

        $entry_count["bookmark"] = $this->Service_bookmark->count($userdata['user_id']);

        $params['user_id']    = $userdata['user_id'];
        $this->load->model("Service_apply");
        $entry_count["apply_job"] = $this->Service_apply->count_user_applied_job($params);

        $params['status']     = 0;
        $params['delete_flg'] = $this->config->item('not_deleted', 'common_config');
        $this->load->model("Service_agent");
        $entry_count["apply_agent"] = $this->Service_agent->count_agency_applied($params);

        $this->smarty->assign('entry_count', $entry_count);

        if(empty($userdata["user_name"])){
            $this->load->model("Service_user");
            $userdata["user_name"] = $this->Service_user->get_user_name($userdata["user_id"]);

            if($userdata["user_name"] === false){
                $this->report_to_administrator(array("subject"=>"【FINE!3.0 BUG_REPORT】nameのないユーザーレコードが発生中","message"=>$user_data));
                redirect($this->config->config["base_url"]);
                exit;
            }
            $this->session->set_userdata(array("user_data"=>$userdata));
        }
        $this->smarty->assign("user_name",$userdata["user_name"]);
    }

    protected function _get_session($key = null,$value = false){
        if(empty($this->session))$this->load->library('session');

        $session = $this->session->userdata($key);

        if(empty($session))return false;

        if($value === false) return $session;

        if(empty($session[$value]))return false;

        return $session[$value];
    }

    protected function _set_session($key,$array){
        $session = $this->_get_session($key);
        foreach($array as $array_key=>$array_val){
            $session[$array_key] = $array_val;
        }
        $return = $this->session->set_userdata($key,$session);
        return $return;
    }

    protected function _remove_session($key,$array){
        $session = $this->_get_session($key);
        foreach($array as $array_key=>$array_val){
            unset($session[$array_key]);
        }
        $return = $this->session->set_userdata($key,$session);
        return $return;
    }
}



