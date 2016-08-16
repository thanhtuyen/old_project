<?php
class Api extends CI_Controller
{
    public function __construct() {
        parent::__construct();
    }

    /*
    API for LP register
    @param json user regist data
    */
    public function lp_hv() {
        //get json
        $user_json = $this->input->post();
        //parse json as array
        $user_regist_info = json_decode($user_json);
        echo('<pre>');
        var_dump($user_json);
        var_dump($user_regsit_info);
        exit;
        //
        //call user regist function
        $user_id = $this->service_user->regist($user_regist_info);
        //set return url and result
        $param['url'] = '';
        if(!empty($user_id)){
            $param['data'] = array('result'=>'true');
        }else{
            $param['data'] = array('result'=>'false');
        }
        //return back with json responce
        $this->service_api->send_json($param);
    }
}
