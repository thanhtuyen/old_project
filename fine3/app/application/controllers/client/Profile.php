<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once ('Client_abstract.php');

class Profile extends Client_abstract
{
    //validate word setting
    private $_data = [
                'name_required' => '名前を入力してください。',
                'message_required' => 'メッセージを入力してください。',
                'image_id_required' => '写真を登録してください。'

    ];

    public function __construct() {
        parent::__construct();
        if(!$this->_is_client_login() && strpos($this->uri->uri_string,"client/login") === false)redirect($this->config->config["base_url"]."client/login");
        $this->load->helper('url');
        $this->load->model('Service_client');
        $this->load->model('Service_area');
        $this->load->helper('image');
        $this->smarty->assign('image_type', $this->config->item('nursery', 'image_config'));
    }

    /*
    this page show client infomation.
    */
    public function index() {
       //C_13

        //1. get info from client table bt client_id
        $client_id = $this->_get_client_id();
        $client = $this->Service_client->get_detail($client_id);

        $client["image"] = $this->_get_client_image($client_id);

        //get 得意エリア
        $param['client_id'] = $client_id;
        $param['delete_flg'] = 0;
        $client_area = $this->Service_area->get_list($param);

        $this->smarty->assign('client',$client);
        $this->smarty->assign('client_area',$client_area);
        $this->smarty->display("pc/client/profile/index.html");
    }

    /*
    this page is edit page of client info.
    */
    public function edit_info() {
        //C_23
        //get client data and set to value and show edit form
        $client_id = $this->_get_client_id();

        $client = $this->Service_client->get_detail($client_id);

        $client["display_pref_id"] = substr($client["display_area_id"],-5,-3);
        $client["display_city_id"] = substr($client["display_area_id"],-3,3);

        $client["image"] = $this->_get_client_image($client_id);

        if(!empty($client['tags']['type_job'])){
            foreach($client['tags']['type_job'] as $key => $val)$selected_tag[] = $val['tag_detail']['tag_id'];
            $client['selected_tags'] = $selected_tag;
        }

        //get 得意エリア
        $param['client_id'] = $client_id;
        $param['delete_flg'] = 0;
        $client_area = $this->Service_area->get_list($param);

        if(!empty($client_area)){
            foreach($client_area as $key => $val){
                $selected_area[] = $val['area_relation']['area_id'];
            }
            $client_area['selected_areas'] = $selected_area;
        }

        //get都道府県
        $necessary_info = $this->Service_client->get_necessary_client_info();
        $this->smarty->assign('necessary_info', $necessary_info);

        $this->load->model("Service_area");
        $area  = $this->Service_area->get_pref_city_list();

        $this->smarty->assign('area',$area);
        $this->smarty->assign('client',$client);
        $this->smarty->assign('client_area',$client_area);
        $this->smarty->display("pc/client/profile/edit.html");
    }


    public function update_info() {
        $data = $this->input->post();
        if(empty($data)) {
            redirect(base_url() . 'client/profile/edit_info');
        }

        $data['client_id'] = $this->_get_client_id();
        $result = $this->Service_client->update_pr($data, $_FILES);
        if($result){
            redirect(base_url() . 'client/profile/');
        }else{
            redirect(base_url() . 'client/profile/edit_info');
        }
    }


    /*
    this page show career_adviser infomation.
    */
    // old name of function is [caeer_adviser]
    // i renamed to [career_adviser] by Jonny
    public function career_adviser() {
        $client_id = $this->_get_client_id();
        if($client_id === false){
            redirect(base_url().'client/');
        }

        //pagenation
        $page = 1;
        $get = $this->input->get();
        if(array_key_exists('page', $get)){
            if(is_numeric($get['page'])){
                $page = $get['page'];
            }
        }

        $this->load->model('Service_agent');
        $total = $this->Service_agent->get_count($client_id);

        $this->smarty->assign('total',$total);
        $list_param['range']      = 10;
        $list_param['page']       = $page;
        $list_param['limit']      = $total;
        $this->smarty->assign('total',$total);
        //set display job limitation
        $search_param['limit_to']   = next_endpoint($list_param);
        $this->smarty->assign('limit_to',$search_param['limit_to']);
        $search_param['limit_from'] = next_startpoint($list_param,$search_param['limit_to'],$page);
        $this->smarty->assign('limit_from',$search_param['limit_from']);
        $search_param['limit_to']   = next_endpoint($list_param);
        $search_param['offset'] = $search_param['limit_to'] - $search_param['limit_from'];
        $search_param['client_id']   = $client_id;
        $result =  $this->Service_agent->get_list($search_param);
        $this->smarty->assign('agent_list',$result);

        //make pagenation
        $page_count = 0;
        if($total > 1000){
            $page_count = 1000;
        }else{
            $page_count = $total;
        }
        $this->load->helper('image');
        $pagination = $this->_get_pagination($page_count,$list_param['range']);
        $this->smarty->assign('pagination',$pagination);

        $this->smarty->assign('list_param',$list_param);
        $this->smarty->assign('image_type', $this->config->item('career_adviser', 'image_config'));
       //CA_2
        //1. get info from career_adviser table by client_id
        //   $this->Service_client->get_careeradviser();
        $this->smarty->display("pc/client/career_adviser/index.html");
    }

    public function agent_edit($career_adviser_id){

        $client_id = $this->_get_client_id();
        if($client_id === false)redirect($this->config->config["base_url"].'client/');
        if(empty($career_adviser_id))redirect($this->config->config["base_url"].'client/profile/agent/');

        $this->load->model("Service_agent");
        $career_adviser_info = $this->Service_agent->get_career_adviser_info($career_adviser_id);

        if(empty($career_adviser_info) || $career_adviser_info["client_id"] !== $client_id ){
            $career_adviser_info['error'] = 'キャリアアドバイザーが見つかりません。';
        }else{
            $career_adviser_info['error'] = null;
            $this->load->config("image_config");
            $image_params['account_id'] = $career_adviser_id;
            $image_params['type']       = $this->config->item('career_adviser','image_config');
            $image_params['delete_flg'] = $this->config->item('not_deleted','common_config');
            $image_params['select'] = array('image_id','name','type');
            $this->load->model("Service_image");
            $image = $this->Service_image->get_list($image_params);

            if(!empty($image[0])){
                $career_adviser_info["image"] = $image[0];
            }

            $career_adviser_info['message_count_max'] = 40;
        }

        $this->smarty->assign("career_adviser_info",$career_adviser_info);

        //CA_6
        $this->smarty->display("pc/client/career_adviser/edit.html");
    }


    public function agent_update(){

        if(!preg_match("/client\/profile\/(agent_edit\/[0-9]+|create_career_adviser)/",$this->input->server('HTTP_REFERER')))redirect($this->config->config["base_url"].'client/profile/career_adviser');

        $data = $this->input->post();

        if(empty($data["name"]) || empty($data["message"]) || empty($_FILES["photo"]))redirect($this->config->config["base_url"].'client/profile/career_adviser');

        $data["client_id"] = $this->_get_client_id();
        if($data["client_id"] === false)redirect($this->config->config["base_url"].'client/login');

        if(empty($data['career_adviser_id'])){
            // create
            $params['client_id']         = $data['client_id'];
            $params['name']              = $data['name'];
            $params['message']           = $data['message'];
            $params['status']           = $data['status'];

            $this->load->model("Service_agent");
            $result = $this->Service_agent->create($params);
        }else{

            // update
            if(!empty($data['del_existing_image_flg']) && $data['del_existing_image_flg'] === '1'){
                $this->load->config('image_config');
                $img_del_param['account_id'] = $data['career_adviser_id'];
                $img_del_param['type']       = $this->config->item('career_adviser','image_config');
                $this->load->model('Service_image');
                $this->Service_image->delete_image($img_del_param);
            }

            $params['career_adviser_id'] = $data['career_adviser_id'];
            $params['name']              = $data['name'];
            $params['message']           = $data['message'];
            $params['status']           = $data['status'];

            $this->load->model("Service_agent");
            $result = $this->Service_agent->career_adviser_update($params);
        }

        if($result){
            redirect(base_url() . 'client/profile/career_adviser/');
        }else{
            redirect(base_url() . 'client/profile/agent_edit/$data["career_adviser_id"]');
        }
    }

    //this function is merged into edit
    public function career_adviser_detail($id) {
        //CA_6
        //1. $this->Service_client->get_career_adviser_detail();
        // get career_adviser data and set to value and show edit form
        // $detail = $this->Service_agent->agent_info($id);
        // $this->smarty->assign('detail',$detail);
        // $this->smarty->display("pc/client/career_adviser/create.html");

    }


    public function delete_career_adviser(){
        $client_id = $this->_get_client_id();
        if($client_id === false){
            redirect(base_url().'client/');
        }
        $career_adviser_id = (int)($this->input->post('career_adviser_id'));
        if($career_adviser_id > 0){
            $this->load->model('Service_agent');
            $result =  $this->Service_agent->delete($client_id, $career_adviser_id);
            echo $result; exit;
        }else{
             redirect(base_url().'/client/profile/career_adviser', 'location', 301);
        }
    }

    public function create_career_adviser(){

        $client_id = $this->_get_client_id();
        if($client_id === false)redirect($this->config->config["base_url"].'client/');

        $career_adviser_info['name'] = '';
        $career_adviser_info['message'] = '';
        $career_adviser_info['message_count_max'] = 40;

        $this->smarty->assign("career_adviser_info",$career_adviser_info);

        //CA_5
        $this->smarty->display("pc/client/career_adviser/edit.html");
    }

    /**
     * validateCreateData
     */
    private function validateCreateData()
    {
        $this->load->library('form_validation');
        $this->load->helper('image');

        $this->form_validation->set_rules('name', '名前必須', 'trim|required|max_length[255]', [
            'required' => $this->_data['name_required']
        ]);

        $this->form_validation->set_rules('message', 'メッセージ必須', 'trim|required|max_length[255]', [
            'required' => $this->_data['message_required']
        ]);

        $data['image'] =  $this->input->post('image');

        if(empty($data['image'])){
             $this->form_validation->set_rules('image_id', '写真必須', 'required|is_natural', [
                'required' => $this->_data['image_id_required']
            ]);

        }else if(!isImageBase64( $data['image'])){
            return false;
        }

        if ($this->form_validation->run() == FALSE) {

            return false;
        }

        /**
         * $img = str_replace('data:image/png;base64,', '', $img);
         *   $img = str_replace(' ', '+', $img);
         *   $data = base64_decode($img);
         */
        $data['image'] = getImageBase64Data($data['image']);
        $data['name'] = $this->input->post('name');
        $data['message'] = $this->input->post('message');
        $data['image_id'] = $this->input->post('image_id');
        return $data;
    }

    /*
    this page is proto_a. just be showed.
    */
    public function register_career_adovisor_info() {
        //1. get value
        //2. $this->Service_client->update_career_adviser_info();
        //3. rediect profile/index page
    }

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

    /**
     * to get client image function
     * client image is 0 or 1
     * return : single image data array or empty array
     */
    private function _get_client_image($client_id){
        $this->load->config("image_config");
        $image_param['account_id'] = $client_id;
        $image_param['type']       = $this->config->item("client","image_config");
        $image_param['delete_flg'] = $this->config->item("valid","image_config");

        $this->load->model('Service_image');
        $image = $this->Service_image->get_list($image_param);

        if(count($image) > 1){
            // TODO
            redirect($this->config->config["base_url"]."server_error");
            exit;
        }

        if(empty($image[0])){
            return array();
        }else{
            return $image[0];
        }
    }
}
