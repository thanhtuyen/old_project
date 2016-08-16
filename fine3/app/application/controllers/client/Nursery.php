<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once 'Client_abstract.php';


class Nursery extends Client_abstract
{
    public function __construct() 
    {
        parent::__construct();
        if(!$this->_is_client_login() && strpos($this->uri->uri_string,"client/login") === false)redirect($this->config->config["base_url"]."client/login");
        $this->load->helper('image');
        $this->smarty->assign('image_type', $this->config->item('nursery', 'image_config')); 
    }

    /*
    this page is list of nurserys [C_6]
    */
    public function index()
    {

        $user_data = $this->session->userdata('client_data');

        $page = $this->getParam('page', 1);
        $key_words = $this->getParam('key_words');
        $start_time = $this->getParam('start_time');
        $end_time = $this->getParam('end_time');

        $params = array(
            'page' => $page,
            'client_id' => $user_data['client_id'],
            'key_words' => $key_words,
            'start_time' => $start_time,
            'end_time' => $end_time,
            'delete_flg' => $this->config->item('not_deleted', 'common_config'),
            'page_size' => $this->config->item('search_result_rows','nursery_config')
        );

        $result = $this->Service_nursery->get_nursery_list($params);

        $this->load->helper('nursery');

        $pagination = $this->_get_pagination($result['nursery_count'], $params['page_size']);
        $this->smarty->assign('pagination', $pagination);
        $this->smarty->assign('result', $result);
        $this->smarty->assign('params', $params);
        $this->smarty->display("pc"."/client/nursery/index.html");
    }

    /*
    this page is edit page of a nursery [C_17]
    */
    public function edit($nursery_id)
    {

        $this->check_nursery($nursery_id);
        
        $this->load->helper('image');


        $this->assign_edit_informations($nursery_id);

        $this->smarty->display("pc"."/client/nursery/create.html");

    }


    /*
    this page is for update nursery info [C_17]
    */
    public function update() {
        $data = $this->input->post();
        if(empty($data)) {
            redirect(base_url() . 'client/nursery/input');
        }
        //validate
        $this->check_input_data($data);

        if ($this->form_validation->run() == FALSE){
            $this->assign_edit_informations($data['edit_nursery_id']);
            $this->smarty->display("pc".'/client/nursery/create.html');
        }else{
            $this->load->model('Service_nursery');
            $user_data = $this->session->userdata('client_data');
            $data['client_id'] = $user_data['client_id'];
            $result = $this->Service_nursery->insert_or_update($data, $_FILES);
            
            redirect(base_url() . 'client/nursery');
        }
    }

    /*
    this page is for input infomaiton of a nursery [C_18]
    */
    public function input() {
        $necessary_info = $this->Service_nursery->get_necessary_nursery_info();
        $this->smarty->assign('necessary_info', $necessary_info);
        $this->smarty->assign('operation', 'add');
        $this->smarty->assign('images', array());
        $this->smarty->display("pc"."/client/nursery/create.html");
    }
    
    /*
    this page is for insert info of a nursery
    */
    public function create_new()
    {
        $data = $this->input->post();
        if(empty($data)) {
            redirect(base_url() . 'client/nursery/input');
        }
        
        //validate
        $this->check_input_data($data);

        if ($this->form_validation->run() == FALSE){
            $necessary_info = $this->Service_nursery->get_necessary_nursery_info();

            $this->smarty->assign('necessary_info', $necessary_info);
            $area = array(
                'pref_id' => $data['pref_id'],
                'city_id' => $data['city_id']
            );
            $this->smarty->assign('area', $area);
            $this->smarty->assign('post_data', $data);
            $this->smarty->assign('operation', 'add');
            $this->smarty->display("pc".'/client/nursery/create.html');
        }else{
            $this->load->model('Service_nursery');
            $user_data = $this->session->userdata('client_data');
            $data['client_id'] = $user_data['client_id'];
            $result = $this->Service_nursery->insert_or_update($data, $_FILES);

            redirect(base_url() . 'client/nursery');
        }
    }
    
    /*
    copy info of a nursery
    */
    public function create_copy()
    {   
        $nurseryIds = $this->input->post();

        if(!empty($nurseryIds)){ 
            $this->load->model('Service_nursery');
            $user_data = $this->session->userdata('client_data');
            
            for($index = 0; $index < count($nurseryIds['nurseries']); $index++){
                $data['client_id'] = $user_data['client_id'];
                $data = $data + $this->copy_informations($nurseryIds['nurseries'][$index]);
                $result = $this->Service_nursery->insert_or_update($data, null, $nurseryIds['nurseries'][$index]);
                $data = null;
            }
        }        
        redirect(base_url() . 'client/nursery');
    }

    public function delete($nursery_id)
    {
        $this->check_nursery($nursery_id);
        //nursery deleting
        $this->Service_nursery->delete($nursery_id);
        //after deleting. set job status 9 related nursery_id
        $this->Service_job->close_nursery($nursery_id);

        redirect(base_url() . 'client/nursery');
    }

    public function ajax_get_city()
    {
        $this->load->model('Service_nursery');
        $pref_id = $this->input->post('pref_id', TRUE);
        $data = array();
        $data['option'] = $this->Service_nursery->get_city_option($pref_id);

        header('Content-Type: application/json');
        echo json_encode($data, JSON_PRETTY_PRINT);

    }

    private function check_input_data($data)
    {
        $this->load->library('form_validation');

        //because the html has <p class="mt5 txt_attention"> tag
        $this->form_validation->set_error_delimiters('', '');

        $rules = array(
            array(
                'field'   => 'name',
                'label'   => '園名',
                'rules'   => 'trim|required|max_length[255]'
            ),
            array(
                'field'   => 'pref_id',
                'label'   => '都道府県',
                'rules'   => 'required'
            ),
            array(
                'field'   => 'city_id',
                'label'   => '市区町村',
                'rules'   => 'required'
            ),
            array(
                'field'   => 'bus_time',
                'label'   => 'バス',
                'rules'   => 'numeric|trim|max_length[24]'
            ),
            array(
                'field'   => 'walk_time',
                'label'   => '徒歩',
                'rules'   => 'numeric|trim|max_length[24]'
            ),
            array(
                'field'   => 'capacity',
                'label'   => '園児数',
                'rules'   => 'numeric|trim|max_length[9]'
            ),
            array(
                'field'   => 'pr',
                'label'   => 'PR文',
                'rules'   => 'trim|required|max_length[1000]'
            )
        );

        $this->form_validation->set_rules($rules);

    }

    private function assign_edit_informations($nursery_id)
    {
        $delete_flg = $this->config->item('not_deleted','common_config');
        // necessary_info
        $necessary_info = $this->Service_nursery->get_necessary_nursery_info();

        //get list station
        $stations = $this->Logic_nursery_station_relation->get_list_station_by_nursery_id($nursery_id);

        // selected nursery info
        $nursery = $this->Logic_nursery->get_nursery($nursery_id);
        if (!isset($nursery['name_kana']))
        {
            $nursery['name_kana'] = '';
        }
        // nursery tags
        $tag_relation_type = $this->config->item('type_relation_nursery', 'tag_config');
        $this->load->model("Logic_tag_relation");
        $nursery_tags = $this->Logic_tag_relation->get_tag_relation($nursery_id, $tag_relation_type);
        foreach ($necessary_info['type_nursery'] as $key => $value) {
            foreach ($nursery_tags as $value_1) {
                if($value['tag_id'] == $value_1['tag_id']) {
                    $necessary_info['type_nursery'][$key]['should_checked'] = true;
                }
            }
        }

        foreach ($necessary_info['tag_insurance'] as $key => $value) {
            foreach ($nursery_tags as $value_1) {
                if($value['tag_id'] == $value_1['tag_id']) {
                    $necessary_info['tag_insurance'][$key]['should_checked'] = true;
                }
            }
        }

        foreach ($necessary_info['tag_nursery'] as $key => $value) {
            foreach ($nursery_tags as $value_1) {
                if($value['tag_id'] == $value_1['tag_id']) {
                    $necessary_info['tag_nursery'][$key]['should_checked'] = true;
                }
            }
        }

        // areas info
        $area_params = array(
            'area_id' => $nursery['area_id'],
            'delete_flg' => $delete_flg
        );
        $area = $this->Logic_area->get_detail($area_params);

        // nursery images
        $this->load->model('Logic_image');
        $image_param = array(
            'account_id' => $nursery_id,
            'type' => $this->config->item('nursery', 'image_config'),
            'delete_flg' => $delete_flg
        );

        $images = $this->Logic_image->get_list($image_param);

        $this->smarty->assign('necessary_info', $necessary_info);
        $this->smarty->assign('nursery', $nursery);
        $this->smarty->assign('area', $area[0]);
        $this->smarty->assign('operation', 'edit');
        $this->smarty->assign('images', $images);
        $this->smarty->assign('stations', $stations);
    }

    private function copy_informations($nursery_id)
    {
        $delete_flg = $this->config->item('not_deleted','common_config');
        // necessary_info
        $necessary_info = $this->Service_nursery->get_necessary_nursery_info();
        // selected nursery info
        $nursery = $this->Logic_nursery->get_nursery($nursery_id);
        // nursery tags
        $tag_relation_type = $this->config->item('type_relation_nursery', 'tag_config');
        $this->load->model("Logic_tag_relation");
        $nursery_tags = $this->Logic_tag_relation->get_tag_relation($nursery_id, $tag_relation_type);
        
        $copyinfo = $nursery;
        $copyinfo['name'] = $copyinfo['name'] . ' - コピー';
        
        foreach ($necessary_info['type_nursery'] as $key => $value) {
            foreach ($nursery_tags as $value_1) {
                if($value['tag_id'] == $value_1['tag_id']) {
                    $copyinfo['type_nursery'] = $value_1['tag_id'];
                }
            }
        }

        foreach ($necessary_info['tag_insurance'] as $key => $value) {
            foreach ($nursery_tags as $value_1) {
                if($value['tag_id'] == $value_1['tag_id']) {
                    $copyinfo['tag_insurance'][] = $value_1['tag_id'];
                }
            }
        }

        foreach ($necessary_info['tag_nursery'] as $key => $value) {
            foreach ($nursery_tags as $value_1) {
                if($value['tag_id'] == $value_1['tag_id']) {
                    $copyinfo['tag_nursery'][] = $value_1['tag_id'];
                }
            }
        }

        // areas info
        $area_params = array(
            'area_id' => $nursery['area_id'],
            'delete_flg' => $delete_flg
        );
        $area = $this->Logic_area->get_detail($area_params);
        $copyinfo = $copyinfo + $area[0];

        //nursery station relation
        $this->load->model('Logic_nursery_station_relation');
        $stations = $this->Logic_nursery_station_relation->get_list_station_by_nursery_id($nursery_id);
        $station_array = array();
        foreach($stations as $key=>$value) {
            $station_id = $value['station_id'];
            $nursery_station['station_id'] = $value['station_id'];
            $nursery_station['display'] = $value['display_flg'];
            $nursery_station['is_main'] = $value['main_flg'];
            $station_array[$station_id] = $nursery_station;

        }

        $copyinfo['stations'] = $station_array;

        return $copyinfo;
    }

    private function check_nursery($nursery_id)
    {
        $param = array(
            'delete_flg' => $this->config->item('not_deleted', 'common_config'),
            'client_id' => $this->session->userdata('client_data')['client_id'],
            'nursery_id' => $nursery_id
        );
        $this->load->model('Logic_nursery');
        $nursery = $this->Logic_nursery->get_one_nursery($param);
        if(empty($nursery)){
            redirect(base_url() . 'client/nursery');
        }
    }

    public function export_csv()
    {
        $nursery_ids = $this->input->get('nursery_ids');
        if($nursery_ids){
            $filepath = $this->Service_nursery->get_csv_data($nursery_ids, $this->get_format());
            $this->send_file($filepath);
            exit;
        }
    }
}
