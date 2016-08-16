<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_Abstract extends MY_Controller{

    protected $_bread_crumb ;

    public function __construct() {
        parent::__construct();

        parent::_assign_job_info();

        if($this->is_login())parent::_assign_common_params();

        //パンくずのユーザ側初期化
        $base_url = $this->config->config["base_url"];
        $this->_bread_crumb['base_url'] = $base_url;
        $this->smarty->assign('breadcrumb', $this->_bread_crumb);
        /* --サンプルコード-- */        
        // $uri = $_SERVER['REQUEST_URI'];
        // if(strstr($uri,'detail_') === false and strstr($uri,'complete') === false){
            $ga_tag = $this->_ga();
        // }else{
        //     $ga_tag = "";
        // }
        $this->smarty->assign("ga_tag",$ga_tag);
        $this->smarty->assign("login",parent::is_login());
        $this->save_visitor_data();
        $this->load->model("Service_column");
        $wp_category = $this->Service_column->get_wp_category();
        $this->smarty->assign("wp_category",$wp_category);
    }


    private function _ga(){
            //login check and output js
            $login = $this->_is_user_login();
            if($login){
                $str = "<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
  ga('create', 'UA-57341350-3', 'auto');
  ga('require', 'displayfeatures');
  ga('require', 'linkid', 'linkid.js');
  ga('set','dimension1','login');
  ga('send', 'pageview');
</script>";
            }else{
                $str = "<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
  ga('create', 'UA-57341350-3', 'auto');
  ga('require', 'displayfeatures');
  ga('require', 'linkid', 'linkid.js');
  ga('send', 'pageview');
</script>";
            }
            return $str;
    }
    /* save visitor data to Analyze table
     * for Admin analyze page @Aya
     */
    private function save_visitor_data(){
    $this->load->library('user_agent');
    $ads['source']   = $this->input->get('utm_source');
        $ads['medium']   = $this->input->get('utm_medium');
        $ads['campaign'] = $this->input->get('utm_campaign');
        $data['page']         = $this->uri->uri_string();
        $data['career_type']  = ($this->agent->is_mobile())? 1: 0;
        $data['ip']           = (isset($_SERVER["HTTP_X_FORWARDED_FOR"]))? $_SERVER["HTTP_X_FORWARDED_FOR"] : $_SERVER["REMOTE_ADDR"];
    $this->load->model('Service_analyze');
    $this->Service_analyze->save_visitor_info_for_analyze($data, $ads = "");
    }

    /**
     * Get user data session
     * @return session false/array
     */
    protected  function _get_user_session(){
        if(empty($this->session)){
            $this->load->library('session');
        }
        $user_session = $this->session->userdata("user_data");

        if(empty($user_session)){
            return false;
        }
        return $user_session;
    }
    /**
     * Get user id
     * @return false/int user_id
     *
     */
    protected function _get_user_id(){
        $user_session = $this->_get_user_session();
        if(empty($user_session)){
            return false;
        }

        if(! isset($user_session["user_id"])){
            return  false;
        }

        $user_id = (int) $user_session["user_id"];
        return $user_id;
    }


    /**
     * checking user login or not
     * return bool
     */
    protected function _is_user_login(){
        return (bool) $this->_get_user_id();
    }

    /**
     * set user sesssion as user_id
     * return bool
     *
     */
    protected function _set_user_session($user_id){
        $user_data['user_id'] = $user_id;
        $user_data['login'] = true;
        $ret = $this->session->set_userdata('user_data', $user_data);
        return $ret;
    }
}
?>
