<?php
Class Service_inquire extends MY_Model{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Send email to user/client and admin
     * @param $account_type user|client
     * @return boolean
     */
    private function sendEmail($data)
    {

        $account_type = $this->service_contact->getTypeName($data['type']);
        $this->load->model('service_email');

        /**
         * mail id M_5
         * Sender to user
         */
        //
        $param = [
            'name' => $data['name'],
            'to' => $data['email'],
            'content' => $data['content']
        ];

        //ログイン済みユーザ
        if ($account_type == 'user') {
            $user_data = $this->session->userdata('user_data'); // Use this
            $user_name = '';
            if ($user_data){
                $user_name = $user_data['user_name'];
            }
            $param['user_name'] = $user_name;
            $result = $this->service_email->inquiry_2user($param);
        } elseif($account_type == 'client') {
        //ログイン済みクライアント
            $client_data = $this->session->userdata('client_data'); // Use this

            $client_name = (isset($data['company_name']))? $data['company_name'] : "";
	    $client_contact_name = (isset($data['name']))? $data['name'] : "";
            if ($client_data){
                $client_id = $client_data['client_id'];
                $this->load->model('Service_client');
                $client = $this->Service_client->get_detail($client_id);
                if ($client){
                    $client_name = $client['name'];
                    $client_contact_name = $client['contact_name'];
                }

            }
            $param['client_name'] = $client_name;
            $param['client_contact_name'] = $client_name." ".$client_contact_name;
            $result = $this->service_email->inquiry_2client($param);
        } elseif($account_type == 'business_offer') {
	    $param['client_name'] = (isset($data['company_name']))? $data['company_name'] : "";
	    $param['client_contact_name'] = (isset($data['name']))? $param['client_name']." ".$data['name'] : "";
	    $result = $this->service_email->inquiry_2client($param);
	} elseif($account_type == 'guest') {
        //ゲスト
            $result = $this->service_email->inquiry_2guest($param);
        }

        if (! $result) {
            return false;
        }

        /*
         * mail id M_6
         * trigger U_13
         */
        $param = [
            'name' => $data['name'],
            'content' => $data['content']
        ];

        $result = (bool) $this->service_email->inquiry_2admin($param);
        return $result;

    }

    /**
     * U_13
     *

     * @since 15/04/15
     *        1. Validate data
     *        2. Get data
     *        3. transaction start
     *        4. insert contact
     *        5. send email to user
     *        6. send emaill to admin
     *        7. if true all, transaction commit
     * @return boolean
     */
    private function _createInquire($value_form_view,$_data,$account_id)
    {
        $result = false;

        // validate data
        $data = $this->validateData($value_form_view,$_data);
        if ($data === false) {
            return false;
        }

        $this->load->model('service_contact');

        $this->service_contact->transaction_start();

        $data['account_id'] = $account_id;

        $result = (bool) $this->service_contact->inquire($data);

        if (! $result) {
            return false;
        }
        $result = $this->sendEmail($data);
        if ($result === true) {
            $this->service_contact->transaction_commit();
        }
        return $result;
    }

    /**
     * U_13 for client
     *

     * @since 15/04/15
     *        1. Validate data
     *        2. Get data
     *        3. transaction start
     *        4. insert contact
     *        5. send email to user
     *        6. send emaill to admin
     *        7. if true all, transaction commit
     * @return boolean
     */
    private function  _createBusinessoffer($value_form_view,$_data,$client_id)
    {
        $result = false;

        // validate data
        $data = $this->validateData($value_form_view,$_data);
        if ($data === false) {
            return false;
        }

        $this->load->model('service_contact');

        $this->service_contact->transaction_start();

        $data['account_id'] = $client_id;
        if($data['account_id'] > 0){

            $data['type'] = 3;
        } else {
            $data['type'] = 4;
        }

        // unset($data['account_id']);
        $data['title'] = '';

        $result = (bool) $this->service_contact->businessoffer($data);
        if (! $result) {
            return false;
        }
        $result = $this->sendEmail($data);
        if ($result === true) {
            $this->service_contact->transaction_commit();
        }
        return $result;
    }

    /**
     * Validate contact data for inquire and business Offer

     * @since 15/04/15
     */
    private function validateData($view,$_data)
    {
        $this->form_validation->set_rules('name', 'お名前', 'trim|required|max_length[255]', [
            'required' => $_data['name_required'],
            'max_length' => '255文字以内で入力してください。'
        ]);
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|max_length[255]', [
            'required' => $_data['email_required'],
            'valid_email' => $_data['valid_email'],
            'max_length' => '255文字以内で入力してください。'
        ]);

        $this->form_validation->set_rules('content', '内容', 'required|max_length[255]', [
            'required' => $_data['content_required'],
            'max_length' => '255文字以内で入力してください。'
        ]);

        if ($view == 'businessoffer') {
            $this->form_validation->set_rules('company_name', '法人名', 'required|max_length[255]', [
                'required' => $_data['company_name_required'],
                'max_length' => '255文字以内で入力してください。'
            ]);
            $data['company_name'] = $this->input->post('company_name',true);
        } else {
            $this->form_validation->set_rules('title', '件名', 'required|max_length[255]', [
                'required' => $_data['title_required'],
                'max_length' => '255文字以内で入力してください。'
            ]);
            $data['title'] = $this->input->post('title',true);
        }

        if ($this->form_validation->run() == FALSE) {

            return false;
        }

        $data['name'] = $this->input->post('name',true);
        $data['email'] = $this->input->post('email',true);
        $data['content'] = $this->input->post('content',true);

        return $data;
    }

    /**
     *
     * @since 15/04/15
     * @param $view function
     *            render view
     *            this page send お問合わせ to admin.
     *
     */
    public function check_flow($view,$_data,$account_id)
    {

        // render to screen[U_13]
        // 1. first check login or not login
        // 2. if logined , he is user or client
        // 3. if inquired , CONTACT table is inserted
        // if login , account_id is inserted ,
        // if logined user , $type = 'user'
        // if logined client, $type = 'client'
        // account_id is somethimes account_id somethimes client_id but we know ,by type
        // 4. email is send for user and admin $this->Service->email->inquire();
        // 5. redirect to complete
        $result = false;

        $this->load->helper(array(
            'form',
            'url'
        ));
        $this->load->library('form_validation');

        if (empty($this->input->post())) {
            return false;
        }

        if ($view == 'index') {
            $result = $this->_createInquire($view,$_data,$account_id);
        } else {
            $result = $this->_createBusinessoffer($view,$_data,$account_id);
        }

        if ($result === true) {
            return true;
        }
        return false;
    }

}
?>
