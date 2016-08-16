<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');

require_once 'User_abstract.php';

class Campaign extends User_abstract
{

    /**
     * @var Service_analyze
     */
    public $service_analyze;

    public function __construct() {
        parent::__construct();

        $this->load->model('Service_account');
        $this->load->model('Service_email');
        $this->load->library('session');

        $this->load->helper(['form', 'url']);
        $this->load->library('form_validation');
    }

    public function rules(){

        $yearMin = date('Y') - 70;
        $yearMax = date('Y') - 10;

        return array(
                array(
                    'field' => 'name',
                    'label' => 'Name',
                    'rules' => 'trim|required|max_length[50]',
                    'errors' => array(
                        'required' => '<span class="help-block form-error"><div style="color:red">※入力してください</div></span>',
                        'max_length' => '<span class="help-block form-error"><div style="color:red">ふりがなは必須項目です</div></span>',
                    ),
                ),
                array(
                    'field' => 'fullname',
                    'label' => 'Fullname',
                    'rules' => 'trim|required|max_length[50]',
                    'errors' => array(
                        'required' => '<span class="help-block form-error"><div style="color:red">※入力してください</div></span>',
                        'max_length' => '<span class="help-block form-error"><div style="color:red">お名前は必須項目です</div></span>',
                    ),
                ),
                array(
                    'field' => 'email',
                    'label' => 'Email',
                    'rules' => 'trim|required|valid_email|callback_validateEmail',
                    'errors' => array(
                        'required' => '<span class="help-block form-error"><div style="color:red">このメールアドレスは既に登録されています。</div></span>',
                        'valid_email' => '<span class="help-block form-error"><div style="color:red">このメールアドレスは既に登録されています。</div></span>',
                        'validateEmail' => '<span class="help-block form-error"><div style="color:red">このメールアドレスは既に登録されています。</div></span>'
                    )
                ),
                array(
                    'field' => 'gender',
                    'label' => 'Gender',
                    'rules' => 'required',
                    'errors' => array(
                        'required' => '<span class="help-block form-error"><div style="color:red">性別を選択してください。</div></span>',
                    )
                ),
                array(
                    'field' => 'year',
                    'label' => 'Year',
                    'rules' => 'required|greater_than['.$yearMin.']|less_than['.$yearMax.']',
                    'errors' => array(
                        'required' => '<span class="help-block form-error"><div style="color:red">年は必須項目です.</div></span>',
                        'greater_than' => '<span class="help-block form-error"><div style="color:red">年を選択してください。</div></span>',
                        'less_than' => '<span class="help-block form-error"><div style="color:red">年を選択してください。</div></span>'
                    )
                ),
                array(
                    'field' => 'month',
                    'label' => 'Month',
                    'rules' => 'required',
                    'errors' => array(
                        'required' => '<span class="help-block form-error"><div style="color:red">月は必須項目です.</div></span>',
                    )
                ),
                array(
                    'field' => 'day',
                    'label' => 'Day',
                    'rules' => 'required',
                    'errors' => array(
                        'required' => '<span class="help-block form-error"><div style="color:red">日は必須項目です.</div></span>',
                    )
                ),
                array(
                    'field' => 'phone',
                    'label' => 'Phone',
                    'rules' => 'required',
                    'errors' => array(
                        'required' => '<span class="help-block form-error"><div style="color:red">電話番号は必須項目です</div></span>',
                    )
                ),
                array(
                        'field' => 'zip1',
                        'label' => 'Zip1',
                        'rules' => 'required',
                        'errors' => array(
                                'required' => '<span class="help-block form-error"><div style="color:red">郵便番号は必須項目です</div></span>',
                        )
                ),
                array(
                        'field' => 'zip2',
                        'label' => 'Zip2',
                        'rules' => 'required',
                        'errors' => array(
                                'required' => '<span class="help-block form-error"><div style="color:red">郵便番号は必須項目です</div></span>',
                        )
                ),
//                 array(
//                     'field' => 'province',
//                     'label' => 'Province',
//                     'rules' => 'required|callback_validateProvince',
//                     'errors' => array(
//                         'required' => '<span class="help-block form-error"><div style="color:red">※選択してください</div></span>',
//                         'validateProvince' => '<span class="help-block form-error"><div style="color:red">※選択してください</div></span>'
//                     )
//                 ),
                array(
                    'field' => 'city',
                    'label' => 'City',
                    'rules' => 'required|callback_validateCity',
                    'errors' => array(
                        'required' => '<span class="help-block form-error"><div style="color:red">※選択してください</div></span>',
                        'validateCity' => '<span class="help-block form-error"><div style="color:red">※選択してください</div></span>'
                    )
                ),
                array(
                        'field' => 'address_detail',
                        'label' => 'Adderss_detail',
                        'rules' => 'required',
                        'errors' => array(
                                'required' => '<span class="help-block form-error"><div style="color:red">マンション・番地は必須項目です</div></span>',
                        )
                ),
                array(
                    'field' => 'certifications[]',
                    'label' => 'Certifications',
                    'rules' => 'required|callback_validateCertification',
                    'errors' => array(
                        'required' => '<span class="help-block form-error"><div style="color:red">※選択してください</div></span>',
                        'validateCertification' => '<span class="help-block form-error"><div style="color:red">※選択してください</div></span>'
                    )
                ),
                array(
                    'field' => 'jobtype',
                    'label' => 'Job type',
                    'rules' => 'required|callback_validateJobtype',
                    'errors' => array(
                        'required' => '<span class="help-block form-error"><div style="color:red">ご希望の雇用形態を選択してください。</div></span>',
                        'validateJobtype' => '<span class="help-block form-error"><div style="color:red">ご希望の雇用形態を選択してください。</div></span>'
                    )
                )
        );

    }


    /**
     * Task -
     * analyze advertisement and insert to analyze table
     *
     * @since 15/04/16
     *
     *
     *
     */
    private function analyze($method)
    {




        /**
         * 1. Check method will be inserted value         *
         * 2. Prepare data
         * 3. validate data
         * 4. load service
         * 5. call insert data
         * 6. return
         */
        //3. Check method will be inserted value if method is not in array return
        if(! in_array($method, ['proto_a', 'proto_b', 'proto_c'])){
            return false;
        }

        /**
         * Use for validation
         */
        $_POST = array_merge($_POST, $_GET);
        $this->load->helper(array('form', 'url'));
        $this->config->load('config', true);
        $config  = $this->config->item('config');

        $config['csrf_protection'] = false;
        $this->config->set_item('config', $config);


/*
        $this->load->library('form_validation');


         //2. Prepare data
        $data['utm_source']= $this->input->get('utm_source');
        $data['utm_medium']= $this->input->get('utm_medium');
        $data['utm_campaign']= $this->input->get('utm_campaign');
        $data['page'] = $method;
        $data['career_type'] = $this->get_ua();
        $data['ip'] = $this->input->ip_address();


        $this->load->model('service_analyze');


        //2. validate data
       $result = $this->form_validation->max_length($data['utm_source'], 255);
       if(!$result){
           return false;
       }

       $result = $this->form_validation->max_length($data['utm_medium'], 255);
       if(!$result){
           return false;
       }

       $result = $this->form_validation->max_length($data['utm_campaign'], 255);
       if(!$result){
           return false;
       }

        $result = $this->service_analyze->campaign($data);

        return $result;
        */
    }

    /*
     * now you dont need make this page .
     */
    public function index()
    {}



    /**
     * this page is proto_a. just be showed.
     */
    public function proto_a() {
        $this->analyze(__FUNCTION__);

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

        // render proto_a
        return $this->smarty->display($this->template_path()."/user/campaign/proto_a.html");
    }




    /*
     * this page is proto_b. just be showed.
     */
    public function proto_b()
    {
        $this->analyze(__FUNCTION__);


        $this->smarty->display($this->template_path()."/user/campaign/proto_c.html");
    }

    /**
     * callback validate email on submit
     *
     * @return boolean
     */
    public function validateEmail($email)
    {
        $accountExists = $this->Service_account->check_user_account($email);
        return !$accountExists;

    }
    /**
     * callback validate Jobtype on submit
     *
     * @return boolean
     */
    public function validateJobtype($jobtype)
    {
        // Load tags service
        $this->load->model("Service_tag");
        $data = $this->Service_tag->get_single_detail($jobtype);
        if( ! $data || empty($data) || $data['tag_group_id'] != $this->config->item('type_employ', 'tag_config') ){
            return false;
        }
        return true;

    }
    /**
     * callback validate Certification on submit
     *
     * @return boolean
     */
    public function validateCertification($certifications)
    {
        // Load tags service
        $this->load->model("Service_tag");
        $data = $this->Service_tag->get_single_detail($certifications);
        if( ! $data || empty($data) || $data['tag_group_id'] != $this->config->item('tag_license', 'tag_config') ){
            return false;
        }
        return true;

    }
    /**
     * callback validate Province on submit
     *
     * @return boolean
     */
    public function validateProvince($province)
    {
        // Load tags service
        $this->load->model("Service_area");
        $pref_param = [
            'pref_id' => [$province],
            'delete_flg' => $this->config->item('not_deleted','common_config')
        ];
        $data = $this->Service_area->get_id_list($pref_param);
        if( ! $data || empty($data) ){
            return false;
        }
        return true;

    }
    /**
     * callback validate City on submit
     *
     * @return boolean
     */
    public function validateCity($city)
    {
        // Load tags service
        $this->load->model("Service_area");
        // function get_id_list($pref_param) not allow find area_id
        // Use function get_city_list() list all area to check validate
        $data = $this->Service_area->get_city_list();
        if( ! $data || empty($data) ){
            return false;
        }else{
            $result = false;
            foreach( (array) $data as $item){
                if($city == $item['area_id']){
                    $result = true;
                }
            }
            return $result;
        }
        return true;

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


    /**
     * this page is confirm screen.
     */
    public function confirm() {

        // Load province & city
        $this->load->model("Service_area");
        $data["area"] = $this->Service_area->get_pref_city_list();
        // Parse to json & send to view
        $city = json_encode(array());
        if($data["area"] && ! empty($data["area"]) && isset($data["area"]['city']) && ! empty($data["area"]['city'])){
            $all_cities = json_encode($data['area']['city']);
            $this->smarty->assign('all_cities', $all_cities);
            $this->smarty->assign('all_provinces', $data["area"]['pref']);
        }
        // Load tags
        $this->load->model("Service_tag");
        $param = [
            'id' => 3,
            'type' => $this->config->item('type_employ', 'tag_config'),
            'delete_flg' => $this->config->item('not_deleted','common_config')
        ];
        // Get all tags
        $all_tags = $this->Service_tag->get_categories();
        if($all_tags && ! empty($all_tags)){
            $arg = [
                $this->config->item('type_employ', 'tag_config'),
                $this->config->item('tag_license', 'tag_config')
            ];
            foreach( (array) $all_tags as $key => $value){
                if( in_array($value['tag_group_id'], $arg) && isset($value['tags']) ){
                    $this->smarty->assign('tags_'.$value['tag_group_id'], $value['tags']);
                }
            }
        }

        $post = $this->input->post(null,true);

        if ($post){
            //agree

            // check validate false when submit
            $validate = $this->validateFormSubmit();

            if ($validate){
                $post = $this->getPostData();
                $this->session->set_userdata($post);
                redirect(base_url()."user/campaign/register");
            }else{
                foreach((array)$post as $key=>$value){
                    $this->smarty->assign($key, $value);
                }

                return $this->smarty->display($this->template_path()."/user/campaign/confirm.html");
            }
        }else{

            // just render input data from proto_a
            $post = $this->session->userdata();

            if (!isset($post['email'])){
                $this->session->sess_destroy();
                redirect("/user/campaign/proto_a");
            }

            foreach((array)$post as $key=>$value){
                $this->smarty->assign($key, $value);
            }

            return $this->smarty->display($this->template_path()."/user/campaign/confirm.html");
        }

    }

    /*
     * this page is proto_a. just be showed.
     */
    public function proto_c()
    {
        $this->analyze(__FUNCTION__);

        // 1. please insert to analyzetable user access data like HV_LP
        // $this->Service_analyze->insert_accessdata();

        // $this->smarty->display('');

    }





    /*
     *

    this page is proto_a. just be showed.
    */
    public function register()
    {
        $result = false;

        //1. get access info like HV_LP (completely same)
        //2. get info of user's form
        $data = $this->session->userdata();
        //$this->session->sess_destroy();

        if (!isset($data['email'])){
            redirect(base_url()."user/campaign/proto_a");
        }


        //3. $this->Service_account->register_account($param)

        $data['password'] = $this->Service_account->getRandomPassword();
        //begin transaction
        $this->db->trans_begin();

        $register = $this->Service_account->register($data);

        if (isset($register['user_id']) && isset($register['token']) ){
            $user_id = $register['user_id'];
            $token = $register['token'];
            // save all tags
            $result = $this->Service_account->saveTags($user_id, $data);

            if ($result){
                //4. send email for register
                //activation_account
                $activation_url = $this->Service_account->getActivateUrl($token);

                $params = [
                    'to' => $data['email'],
                    'mail' => $data['email'],
                    'activation_url' => $activation_url,
                    'user_name' => $data['fullname'],
                    'password' => $data['password'],
                ];


                $result = $this->Service_email->activation_account_2user($params);
            }


        }

        //end transaction
        //5. rediect complete page
        if ($result){
            $this->db->trans_commit();
            redirect(base_url()."user/campaign/complete");
        }else{
            $this->db->trans_rollback();
             redirect(base_url()."user/campaign/proto_a");
        }

    }

    /**
     * this page is complete page.
     */
    public function complete() {
        $this->smarty->display($this->template_path()."/user/campaign/complete.html");
    }

    protected function getPostData(){
        //get user data from proto screen
        $params = array();
        $params["redirect"] = "/";

        $post = $this->input->post(null,true);

        if ($post){
            $params["check_input"] = $post;

            //refer this link : https://docs.google.com/spreadsheets/d/1LlD_ewuMVYRDZTQzwaL15lNWTNweidyb4IMsQITQdzg
            $params["check_column"] = array(
            'fullname',
            'name',
            'gender',
            'year', 'month', 'day',
            'phone',
            'email',
            'province', 'city',
            'certifications',
            'jobtype'
                );


            $post = $this->check_input($params);

            return $post;
        }

        header("location: ".$params["redirect"]);
        exit();



    }


}
