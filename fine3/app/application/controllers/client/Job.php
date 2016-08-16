<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once 'Client_abstract.php';

class Job extends Client_abstract
{
    private $_client_id = null;
    private $_client_data = null;

    public function __construct() {
        parent::__construct();
        if(!$this->_is_client_login() && strpos($this->uri->uri_string,"client/login") === false)redirect($this->config->config["base_url"]."client/login");

        $this->_client_data = $this->session->userdata('client_data');
        $this->_client_id = $this->_client_data['client_id'];
        $this->load->helper('image');
        $this->smarty->assign('image_type', $this->config->item('job', 'image_config'));
    }

    /*
    this page is list of job //[C_5]
    if user search freeword , get parameter and search
    */
    public function index() {
        $page = $this->getParam('page', 1);
        $key_words = $this->getParam('key_words');
        $start_time = $this->getParam('start_time');
        $end_time = $this->getParam('end_time');
        $status = $this->getParam('status');
        $employ_tag = $this->getParam('employ_tag');
        $job_tag = $this->getParam('job_tag');

        $params = array(
            'page' => $page,
            'client_id' => $this->_client_id,
            'key_words' => $key_words,
            'start_time' => $start_time,
            'end_time' => $end_time,
            'status' => $status,
            'employ_tag' => $employ_tag,
            'job_tag' => $job_tag,
            'delete_flg' => $this->config->item('not_deleted', 'common_config'),
            'page_size' => $this->config->item('search_result_rows', 'job_config')
        );
        $result = $this->Service_job->get_job_list($params);

        //雇用形態
        $this->load->model('Logic_tag');
        $tags_params = array(
            'tag_group_id' => $this->config->item('type_employ', 'tag_config'),
            'delete_flg' => $this->config->item('not_deleted', 'common_config'),
        );
        $employ_tags = $this->Logic_tag->get_tag_by_tag_group($tags_params);

        $tags_params = array(
            'tag_group_id' => $this->config->item('type_job', 'tag_config'),
            'delete_flg' => $this->config->item('not_deleted', 'common_config'),
        );
        $job_tags = $this->Logic_tag->get_tag_by_tag_group($tags_params);

        $this->load->helper('job');
        $pagination = $this->_get_pagination($result['job_count'], $params['page_size']);
        $this->smarty->assign('pagination', $pagination);
        $this->smarty->assign('result', $result);
        $this->smarty->assign('params', $params);
        $this->smarty->assign('employ_tags', $employ_tags);
        $this->smarty->assign('job_tags', $job_tags);

        $this->smarty->display($this->template_path() . "/client/job/index.html");
    }

    /*
    this page is edit page of a job [C_15]
    */
    public function edit($job_id) {
        $this->smarty->assign('nurseryId', null);
        $this->smarty->assign('ownNurseryId', null);

        $this->check_job($job_id);
        $this->load->helper('image');
        $this->assign_edit_informations($job_id);
        $this->smarty->display($this->template_path() . "/client/job/create.html");
    }

    /*
    this action update job info
    */
    public function update_job() {
        $data = $this->input->post();
        if(empty($data)) {
            redirect(base_url() . 'client/job');
        }

        //validate
        $this->check_input_data($data);

        if ($this->form_validation->run() == FALSE){
            $this->assign_edit_informations($data['edit_job_id']);
            $this->smarty->display($this->template_path().'/client/job/create.html');
        }else{
            $data['client_id'] = $this->_client_id;
            $result = $this->Service_job->create_or_update_job($data, $_FILES);
            if ($data['is_preview']) {
                header('Content-Type: application/json');
                echo json_encode(array('job_id'=>$result), JSON_PRETTY_PRINT);
                exit();
            }

            redirect(base_url() . 'client/job');
        }
    }


    /*
    this page is create job //[C_16]
    */
    public function input($nurseryId = null, $ownNurseryId = null) {
        $this->smarty->assign('nurseryId', $nurseryId);
        $this->smarty->assign('ownNurseryId', $ownNurseryId);

        $necessary_info = $this->Service_job->get_necessary_info($this->_client_id);

        $this->smarty->assign('operation', 'add');
        $this->smarty->assign('necessary_info', $necessary_info);
        $this->smarty->assign('images', array());
        $this->smarty->display($this->template_path() . "/client/job/create.html");
    }

    /*
    this action create new job
    */
    public function create() {
        $data = $this->input->post();
        $data['client_id'] = $this->_client_id;
        //validate
        $this->check_input_data($data);

        if ($this->form_validation->run() == FALSE){
            $this->input();
        } else {
            $result = $this->Service_job->create_or_update_job($data, $_FILES);
            if ($data['is_preview']) {
                header('Content-Type: application/json');
                echo json_encode(array('job_id'=>$result), JSON_PRETTY_PRINT);
                exit();
            }
            
            redirect(base_url() . 'client/job');
        }
    }


    /*
    Client can create a job by copying from the current job.
    */
    public function copy_job() {

        $jobIds = $this->input->post();
        if(!empty($jobIds)){
            $this->load->model('Service_image');
            $this->load->model('Service_job');
            $user_data = $this->session->userdata('client_data');
            $this->load->helper('image');

            foreach ($jobIds['job_ids'] as $key => $job_id) {
                $this->Service_job->copy($job_id,$this->_client_id);
            }
        }        
        redirect(base_url() . 'client/job');
    }


    /*
    delete job
    */
    public function delete($job_id)
    {
        $this->check_job($job_id);
        $this->Service_job->delete($job_id);
        redirect(base_url() . 'client/job');
    }

    public function assign_edit_informations($job_id)
    {
        $result = $this->Service_job->get_edit_information($this->_client_id, $job_id);

        $this->smarty->assign('necessary_info', $result['necessary_info']);
        $this->smarty->assign('job_info', $result['job_info']);
        $this->smarty->assign('images', $result['images']);
        $this->smarty->assign('operation', 'edit');
    }

    private function check_input_data($data)
    {
        $this->load->library('form_validation');

        //because the html has <p class="mt5 txt_attention"> tag
        $this->form_validation->set_error_delimiters('', '');

        $rules = array(
            array(
                'field'   => 'nursery_id',
                'label'   => '園名',
                'rules'   => 'required'
            ),
            array(
                'field'   => 'title',
                'label'   => 'タイトル',
                'rules'   => 'required'
            ),
            array(
                'field'   => 'description',
                'label'   => '仕事内容',
                'rules'   => 'required'
            ),
            array(
                'field'   => 'type_job',
                'label'   => '募集職種',
                'rules'   => 'required'
            ),
            array(
                'field'   => 'type_employ',
                'label'   => '雇用形態',
                'rules'   => 'required'
            ),
            array(
                'field'   => 'salary',
                'label'   => '給与',
                'rules'   => 'required'
            ),
            array(
                'field'   => 'worktime',
                'label'   => '勤務時間',
                'rules'   => 'required'
            ),
        );

        $this->form_validation->set_rules($rules);
    }

    private function check_job($job_id)
    {
        $param = array(
            'delete_flg' => $this->config->item('not_deleted', 'common_config'),
            'client_id' => $this->_client_id,
            'job_id' => $job_id
        );
        $this->load->model('Logic_job');
        $job = $this->Logic_job->get_one_job($param);
        if(empty($job)){
            redirect(base_url() . 'client/job');
        }
    }

    public function export_csv()
    {
        $job_ids = $this->input->get('job_ids');
        if($job_ids){
            $filepath = $this->Service_job->get_csv_data($job_ids, $this->get_format());
            $this->send_file($filepath);
            exit;
        }
    }
}
?>
