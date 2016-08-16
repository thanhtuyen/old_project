<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');

require_once 'Client_abstract.php';

class Scout extends Client_abstract {

    /**
     * @var Service_scout
     */
    public $service_scout;

    public function __construct()
    {
        parent::__construct();
        if(!$this->_is_client_login() && strpos($this->uri->uri_string,"client/login") === false)redirect($this->config->config["base_url"]."client/login");
        $this->load->model('Service_scout');
    }

    /*
     * Ticket 1153 U_9
     * this page is 1st-step page.select Jobs and search Users
     */
    public function index()
    {
        $nursery_id = $this->input->get('nursery_id');
        $province_id = $this->input->get('province_id');
        $data['jobs'] = [];
        $data['jobData'] = [];
        $data['cities'] = [];
        $this->load->library('session');
        $this->load->helper('select');
        $this->load->helper('url');
        
        //login check
        $client_id = $this->_get_client_id();
        if($client_id === false){
            redirect(base_url().'client/');
        }
        $this->load->model('Service_scout');
        //nursery list
        $data['nurseries'] = $this->Service_scout->getNurseries($client_id);
        $data['nurseries'] = parseSelectedItem($data['nurseries'], 'nursery_id', $this->input->get());

        //job list
        if($nursery_id > 0){
            $data['jobs'] = $this->Service_scout->getJobs($nursery_id);
        }

        $data['jobs'] = parseSelectedItem($data['jobs'], 'job_id', $this->input->get());
        if(count($data['nurseries'] )){
            $data['jobData'] =  $this->Service_scout->getAllJobs(array_keys($data['nurseries']));
        }
        $data['provinces'] = $this->Service_scout->getProvinces();
        $data['provinces'] = parseSelectedItem($data['provinces'], 'province_id', $this->input->get());
        if($province_id>0){
            $data['cities'] = $this->Service_scout->getCities($province_id);

            $data['cities']  = parseCheckedItem($data['cities'] , 'area_id', $this->input->get());
        }

        $data['cityData']  = $this->Service_scout->getAllCities();
        $data['employ_tags'] = $this->Service_scout->getAllEmployTags();
        $data['employ_tags']  = parseCheckedItem($data['employ_tags'] , 'employ_tag_id', $this->input->get());
        $data['license_tags'] = $this->Service_scout->getAllLicenseTags();
        $data['license_tags']  = parseCheckedItem($data['license_tags'] , 'license_tag_id', $this->input->get());
        //need to validate
        $param =    $this->input->get();
       // $param =[];
       
        $limit = (int) (isset($_GET['limit']) ? $_GET['limit'] : 10);
        $limit = $limit > 0 ? $limit : 10;
        $page = (int) (isset($_GET['page']) ? $_GET['page'] : 1);
        $data['page'] = $page > 1 ? $page : 1;
        $param['limit'] = $limit;
        $param['offset'] = ($page - 1) *  $limit;
        $param['start_date'] = isset($param['start_date']) ? $param['start_date'] : date('Y-m-d', strtotime('-7 month'));
        $param['end_date'] = isset($param['end_date']) ? $param['end_date'] : date('Y-m-d');
        $searchData =['total' => 0, 'users' => []];
        $data['job_id'] = $this->input->get('job_id');
        if( $data['job_id']  > 0){
            $searchData = $this->Service_scout->searchUsers($param);
        }
        $data = array_merge($param, $data);
        $data = array_merge($data, $searchData);

        $data['from_item'] = 0;
        $data['to_item']   = 0;
        if($data['total'] > 0){
            $data['from_item'] =  ($data['limit'] * ($data['page'] - 1)) +1 ;
            $data['to_item'] =    ($data['from_item'] + $data['limit']) -1;
        }

        if($data['to_item'] > $data['total']){
            $data['to_item'] = $data['total'];
        }


        $page_config = $this->_get_pagination($data['total'], $limit);
        $this->smarty->assign('pagination',$page_config);

        //save users for comfirm check
        $this->session->set_userdata('scoutUsers', $data['users']);

        $this->smarty->assign($data);
        $this->smarty->display("pc/client/scout/index.html");
    }


    /**
     * Delete user in comfirm list
     */
    public function delete(){
        $scoutUsers = $this->session->userdata("scoutUsers");
        $user_id = $this->input->post('user_id');
        $userKeyIds = array_keys($scoutUsers);
        if($user_id > 0 && in_array($user_id, $userKeyIds)){
            unset($scoutUsers[$user_id]);
            $this->session->set_userdata('scoutUsers', $scoutUsers);
            die('true');
        }
       die('false');
    }

    /*
     * this page is 2nd-step page. select template and click "send scout-mail" button
     */
    public function confirm()
    {
        $this->load->helper('select');

        $this->load->model('Service_scout');

        //login check
        $client_id = $this->_get_client_id();
        if($client_id === false){
            redirect(base_url().'client/');
        }

        $scoutUsers = $this->session->userdata("scoutUsers");
        if(empty($scoutUsers)){
             redirect(base_url().'client/scout', 'location', 301);
        }

        $user_ids = $this->input->post('user_id');
        $job_id = $this->input->post('job_id');

        $template_id =  $this->input->post('template_id');

        if(empty($user_ids) || empty($job_id)){
             redirect(base_url().'client/scout', 'location', 301);
        }

        $selectedUsers=[];
        $userKeyIds = array_keys($scoutUsers);
        foreach ((array)$user_ids as $user_id){
            if(in_array($user_id, $userKeyIds)){
               $selectedUsers[$user_id] = $scoutUsers[$user_id];
            }
        }

        if(empty($selectedUsers)){
             redirect(base_url().'client/scout', 'location', 301);
        }


        $data['job'] = $this->Service_scout->getJobTitle($job_id);

        if($data['job'] === false){
             redirect(base_url().'/client/scout', 'location', 301);
        }


        $data['editJobUrl'] = '/client/job/edit/' . $job_id;
        $data['createTemplateUrl'] = '/client/scout/create_template';

        $data['editTemplateUrl'] = null;
        if($template_id > 0){
            $data['editTemplateUrl'] = '/client/template/edit/' . $template_id;
        }

        $data['users'] = $selectedUsers;

        $data['templates'] = $this->Service_scout->getTemplates($client_id);

        $data['templates'] = parseSelectedItem($data['templates'], 'template_id', $this->input->post());

        $this->session->set_userdata("scoutUsers", $selectedUsers);

        $this->smarty->assign($data);
        $this->smarty->display("pc/client/scout/confirm.html");
    }

    /*
     * this action is execute scout
     */
    public function execute()
    {
        $this->load->helper('select');

        $this->load->model('Service_scout');

        //login check
        $client_id = $this->_get_client_id();
        if($client_id === false){
            redirect(base_url().'client/');
        }

        $user_ids = $this->input->post('user_id');
        $job_id = $this->input->post('job_id');
        $template_id =  $this->input->post('template_id');

        //plan validation inserted
        $count_param['send_count'] = count($user_ids);//this is will to send
        $count_param['client_id'] = $client_id;//id
        $this->load->model('Service_plan');
        $result = $this->Service_plan->calculate_scout($count_param);
        if($result['result'] === false){
            $this->session->set_flashdata('error', ' 「見てね！」送信可能件数を超過したため、送信できませんでした');
            echo('<pre><br>[count_param at '.$_SERVER["REQUEST_TIME_FLOAT"].']<br>');var_dump($count_param);echo('<br>[END count_param]<br></pre>');exit;
             redirect(base_url().'client/scout', 'location', 301);
        }
        $data['job'] = $this->Service_scout->getJobTitle($job_id);

        if(empty($user_ids) || empty($job_id) || $client_id == false ||$data['job'] ==false){
             redirect(base_url().'client/scout', 'location', 301);
        }

        $template =  $this->Service_scout->getTemplateDetails($template_id, $client_id);

        $users = $this->Service_scout->getUsers($user_ids);
       // $this->session->unset_userdata('scoutUsers');

        $this->load->model('service_email');

        $results = [];
        //ADD plan restriction here

        foreach ($users as $key => $user) {
            $content = $this->Service_scout->parseContent($data['job'], $user, $template);
            //send email
            $results[] = $this->service_email->scout($content['email']);
            //insert to scout table
            $results[] = $this->Service_scout->create($content['scout'],$client_id);

        }

          redirect(base_url().'client/scout/complete', 'location', 301);

        // 1. get all user info from confirm template
        // 2. send scout mail to all user that client checked
        // $param has user list as array and template id adn
        // insert scout talbe. $this->Service_scout->insert()
        // $this->Service_email->scout($param)
        // 3. redirect to compelte page
    }

    /*
     * this page is complete page.just showing.
     */
    public function complete()
    {
        //login check
        $client_id = $this->_get_client_id();
        if($client_id === false){
            redirect(base_url().'client/');
        }
        // [C_29]i ==> [C_28]
        // $this->smarty->assign($sample, $sample);
        $this->smarty->display("pc/client/scout/complete.html");
    }

    /*

     * this page is history of scout
     */
    public function history()
    {
        $this->load->helper('url');
        $this->load->helper('select');

        $this->load->model('Service_scout');

        //login check
        $client_id = $this->_get_client_id();
        if($client_id === false){
            redirect(base_url().'client/');
        }

        /**対象求人-> job title
        求人元 -> nursery name
        スカウト日 -> scout create
        年齢 -> user table-> birthday
        ID scout -> scout ID
        */
       
        //need to validate
        $param =    $this->input->get();
        $data['total'] = 2;
        // $param =[];
        $limit = (int) (isset($_GET['limit']) ? $_GET['limit'] : 10);
        $limit = $limit > 0 ? $limit : 10;

        $page = (int) (isset($_GET['page']) ? $_GET['page'] : 1);
        $data['page'] = $page > 1 ? $page : 1;
        $data['limit'] = $limit;
        $data['offset'] = ($page - 1) *  $limit;

       $scoutData = $this->Service_scout->getHostories($client_id, $data['limit'], $data['offset']);
       $data = array_merge($data, $scoutData);

        $data['from_item'] = 0;
        $data['to_item']   = 0;
        if($data['total'] > 0){
            $data['from_item'] =  ($data['limit'] * ($data['page'] - 1)) +1 ;
            $data['to_item'] =    ($data['from_item'] + $data['limit']) -1;
        }

        if($data['to_item'] > $data['total']){
            $data['to_item'] = $data['total'];
        }

        $page_config = $this->_get_pagination($data['total'], $limit);
        $this->smarty->assign('pagination',$page_config);
        // $this->pagination->initialize($page_config);
        // $data['pagination'] = $this->pagination->create_links();
        $this->smarty->assign($data);

        // C_10
        // 1. get info from scout talbe
        $this->smarty->display("pc/client/scout/history.html");
    }


    public function detail($scout_id){
        $data['error'] = false;

        //login check
        $client_id = $this->_get_client_id();
        if($client_id === false){
            redirect(base_url().'client/');
        }

        $scout_id = (int) $scout_id;
        $this->load->model('Service_scout');
        $scout = $this->Service_scout->getScoutDetails($client_id, $scout_id);

         if(! $scout){
             $data['error'] = 'スカウト履歴が見つかりません。';
         }else{
             $data['scout'] = $scout;
         }


        $this->smarty->assign($data);
        $this->smarty->display("pc/client/scout/detail.html");
    }



    /*
    this page is for create scount template (and edit)
    get client id and template list , show all templates.
    */
    public function template_list($message = "") {
        $client_id = $this->_get_client_id();
        if($client_id === false){
            redirect(base_url().'client/');
        }
        $templates = $this->Service_scout->get_list($client_id);
        //pagenation
        if(!$templates){
            $total = 0;
        }else{
            $total = count($templates);
        }
        $this->smarty->assign('total',$total);
        $page = 1;
        $get = $this->input->get();
        if(array_key_exists('page', $get)){
            if(is_numeric($get['page'])){
                $page = $get['page'];
            }
        }
        $list_param['range']      = 10;
        $list_param['page']       = $page;
        $list_param['limit']      = $total;
        //set display job limitation
        $search_param['limit_to']   = next_endpoint($list_param);
        $this->smarty->assign('limit_to',$search_param['limit_to']);
        $search_param['limit_from'] = next_startpoint($list_param,$search_param['limit_to']);
        $this->smarty->assign('limit_from',$search_param['limit_from']);

        //make pagenation
        $page_count = 0;
        if($total > 1000){
            $page_count = 1000;
        }else{
            $page_count = $total;
        }

        $pagination = $this->_get_pagination($page_count,$list_param['range']);
        $this->smarty->assign('pagination',$pagination);


        // $success = "";    
        // if(!empty($message)){
        //     $success = $message;
        // }

        $this->smarty->assign('success','');
        $this->smarty->assign('error','');
        if(empty($templates)){
            $templates = false;
        }else{
            $templates = array_slice($templates, $search_param['limit_from'],$search_param['limit_to']);
        }
        $this->smarty->assign('templates',$templates);

        $this->smarty->display($this->template_path()."/client/scout/template_list.html");
    }


    /**
     * delete_template in template list
     */
    public function delete_template(){
        //login check
        $client_id = $this->_get_client_id();
        if($client_id === false){
            redirect(base_url().'client/');
        }

        $template_id = (int)$this->input->post('template_id');
        if($template_id > 0){
            $this->load->model('Service_scout');
          $result =  $this->Service_scout->deleteTemplate($client_id, $template_id);
        }
        redirect(base_url().'client/template_list/');
    }

    public function duplicate_template(){

        //login check
        $client_id = $this->_get_client_id();
        if($client_id === false){
            redirect(base_url().'client/template_list/');
        }
        $template_ids = (array) $this->input->post('template_id');

        $template_ids = array_filter($template_ids, 'is_numeric');

        $this->load->model('Service_scout');
        $results = [];

        foreach ((array) $template_ids as $template_id){
            $result =  $this->Service_scout->duplicateTemplate($client_id, $template_id);
            $results[] = (boolean)$result;
        }
        $results = array_filter($results, function($result){
            return $result;
        });

        if(count($results)){
            $this->session->set_flashdata('success', '<i class="fa fa-check"></i>コピーして新しいメールテンプレートを作成しました。');
        }else{
            $this->session->set_flashdata('error', ' コピーに失敗しました');
        }
        redirect(base_url().'client/scout/template_list/');
    }


    /*
     * this page is for create scount template
     */
    public function create_template(){
        //login check
        $client_id = $this->_get_client_id();
        if($client_id === false){
            redirect(base_url().'client/');
        }
        // C_12
        // 1. SASAKIIIIIIII 頼むわ。
        $this->smarty->display("pc/client/scout/create_template.html");
    }


    /*
    this page is comfirm page
    */
    public function confirm_template() {
        //login check
        $client_id = $this->_get_client_id();
        if($client_id === false){
            redirect(base_url().'client/');
        }
        $template_id = $this->uri->segment(3);
        $template = array();

        if((!empty($template_id))&&(is_numeric($template_id))){
            //get exist template
            $template = $this->Service_scout->get_detail_html($template_id);
            //validate is yours.
        }else{
            $this->create_template();
        }
        if(empty($template)){
            $this->create_template();
        }
        $this->smarty->assign('temp',$template);

        //C_22
        //1. SASAKIIIII please make it
        $this->smarty->display("pc/client/scout/confirm_template.html");
    }


    /*
    this page is complete page
    */
    public function complete_template() {
        $post = $this->input->post();
        //get login session
        $client_id = $this->_get_client_id();
        if($client_id === false){
            redirect(base_url().'client/template/');
        }
        $param['client_id'] = $client_id;
        if((array_key_exists('subject', $post))&&(array_key_exists('content', $post))){
            $param['title']         = $post['subject'];
            $param['content']   = $post['content'];
            if(array_key_exists('template_id', $post)){
                $param['template_id']   = $post['template_id'];
                $result = $this->Service_scout->update($param);
            }else{
                $result = $this->Service_scout->insert($param);
            }

            redirect($base_url.'client/scout/template_list/');
            //1. SASAKIIIII please make it
            //$this->smarty->display($this->template_path()."/client/scout/complete_template");
            
            //no needed by Aya
        }
    }
}
