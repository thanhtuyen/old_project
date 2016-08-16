<?php
Class Service_token extends MY_Model{
    public function __construct(){
        parent::__construct();
    }

    /**
     * regist token record
     * @param $params["token_type"] : kind of token refer to spread sheet
     *               ["account_id"] : user_id or client_id
     *               ["target_type"]: for user => 1, for client => 2
     * @return boolean / regist token(str)
     */
    public function regist_token($params){

        $token_params["select"] = array("token");
        $token_params["where"] = array();
        $params["token"] = $this->_get_new_token($token_params);
        $params["created"] = date("Y-m-d H:i:s", time());

        $this->load->model("Logic_token");
        $result = $this->Logic_token->insert_token($params);
        if($result){
            return $params["token"];
        }else{
            return false;
        }
    }

    public function defeasance_token($token){

        $params["value"]["status"] = 1;
        $params["where"]["token"] = $token;

        $this->load->model("Logic_token");
        $result = $this->Logic_token->update_token($params);
        return $result;
    }

    public function get_token_list($params,$limit=false){
        $this->load->model("Logic_token");
        $token_list = $this->Logic_token->get_token_list($params);
        return $token_list;
    }

    private function _get_new_token($params){
        $this->load->model("Logic_token");
        $token_list = $this->Logic_token->get_token_list($params);
        do{
            $same_token = false;
            $tmp_token =  bin2hex(openssl_random_pseudo_bytes(32));
            foreach($token_list as $val){
                if($val["token"] === $tmp_token) $same_token = true;
            }
        }while($same_token);

        return $tmp_token;
    }
}