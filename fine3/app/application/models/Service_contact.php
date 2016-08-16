<?php
Class Service_contact extends MY_Model{



    public function __construct()
    {
        parent::__construct();
	$this->config->load('contact_config');
    }

    public function set_info_to($type){
	if(! isset($type)){
	    return false;
	}

	if($type === 'info_user'){
	    $this->load->model('Logic_user');
	    $data = $this->Logic_user->get_mail_for_info();
	}elseif($type === 'info_agency' OR $type === 'info_employer'){
	    $this->load->model('Logic_client');
	    $data = $this->Logic_client->get_mail_for_info($type);
	}else{
	    return false;
	}
	if(isset($data)){
            $result = array();
            foreach($data as $key => $val){
                if(isset($result) AND $result != null){
                    $result[] = $val['mail'];
                }else{
                    $result = array($val['mail']);
                }
            }
        }else{
	    $result = false;
	}
	return $result;
    }

    public function create_info_mail($post,$mail){
	$data['title'] = $post['title'];
	$data['content'] = $post['content'];
	$data['account_type'] = $this->config->item($post['type']);
	$data['to'] = $mail;
//var_dump($data);exit;
	$this->load->model('Logic_contact');
	return $this->Logic_contact->create_info_mail($data);
    }

    /**
     * Client send contact from client side
     *
     * @since 15/04/14
     * @param $param array
     *            ['content' => '']
     *            contact.name = client.contact_name
     *            contact.company = client.name
     *            contact.email = client.mail
     *            contact.title = ''
     *            contact.status = 0
     *            contact.delete_flg = 0
     *            contact.content = from client inputted
     *            contact.type = client.account_type OR = 0
     *            contact.account_id = client.client_id
     * @return false/int id
     */

    public function client_contact($contact)
    {
        if (! isset($contact['content'])) {
            return false;
        }
        // 1. load client id from session
        $this->load->library('session');
        $client_id = $this->session->userdata('client_login');

        if (! ($client_id > 0)) {
            return false;
        }

        // 2. Query client info
        $clientParam['client_id'] = $client_id;
        $clientParam['status'] = 0;
        $clientParam['delete_flg'] = 0;
        $clientParam['select'] = [
            'name',
            'contact_name',
            'mail',
            'account_type'
        ];
        $client = $this->Logic_client->get($clientParam);

        if (! $client) {
            return false;
        }

        // 3. setup Contact data before inserting
        $contact['name'] = $client['contact_name'];
        $contact['company_name'] = $client['name'];
        $contact['email'] = $client['mail'];
        $contact['type'] = (int) $client['account_type'];
        $contact['account_id'] = $client_id;
        $contact['title'] = '';
        $contact['status'] = 0;
        $contact['delete_flg'] = 0;
        $contact['updated'] = date('Y-m-d H:i:s');
        $contact['created'] = date('Y-m-d H:i:s');

        // 4. load model
        $this->load->model('Logic_contact');

        // 5. Save contact
        $result = $this->Logic_contact->create($contact);
        return $result;
    }




    /**
     * U_13
     * Create businessoffer
     *
     * @since 15/04/15
     * @param array $data
     * @return false/int id
     */
    public function businessoffer($data)
    {
        // 3. setup Contact data before inserting
        $record = $this->loadCreateValue($data);
        if(!empty($data['account_id'])){
            $record['account_id'] = $data['account_id'];
        }
        // 4. load model
        $this->load->model('Logic_contact');

        //5. Save contact

        $result = $this->Logic_contact->create($record);
        return $result;
    }


    /**
     * U_14 - user side - inquire
     * Client send contact from user side
     *
     * @since 15/04/14


     * @param $param array

     * @param $param array ['content' => '']
     * contact.name =
     * contact.company =
     * contact.email =
     * contact.title = ''
     * contact.status = 0
     * contact.delete_flg = 0
     * contact.content =
     * contact.type =  = 0
     * contact.account_id = 0
     * @return false/int id
     */
    public function inquire(&$data){
        $this->load->library('session');

        if($data['account_id'] > 0){
            $data['type'] = 2;
            $data['account_id'] = $data['account_id'];
        }else{
            $data['type'] = 1;
        }

        unset($data['account_id']);

        //3. setup Contact data before inserting
        $data['company_name'] = '';
        $data = $this->loadCreateValue($data);

        // 4. load model
        $this->load->model('Logic_contact');

        //5. Save contact
        $result = $this->Logic_contact->create($data);
        return $result;
    }

    /**
     *
     * @since 15/04/15
     *        Support for U_14
     *        Default value and initial values
     */
    private function loadCreateValue($data)
    {
        $data['account_id'] = '';
        $data['status'] = 0;
        $data['delete_flg'] = 0;
        $data['updated'] = date('Y-m-d H:i:s');
        $data['created'] = date('Y-m-d H:i:s');
        return $data;
    }

    /**
     * Start transaction
     *
     * @since 15/04/15
     */
    public function transaction_start()
    {
        $this->db->trans_start();
    }

    /**
     * Commit transaction
     *
     * @since 15/04/15
     */
    public function transaction_commit()
    {
        $this->db->trans_complete();
    }

    /*
     * For admin side.
     * @author Aya
     */
    public function get_list_of_contact($condition, $parameters){
	if ($parameters['total'] == 0) {
            return array();
        }
	$param = array(
            'offset'     => $parameters['offset'],
            'limit'      => $parameters['limit'],
	    'type'     => $condition['type'],
            'delete_flg' => 0 //$this->config->item('not_deleted','common_config')
        );

	$this->load->model('Logic_contact');
	$data = $this->Logic_contact->get_contact_list($condition, $param);
	//カテゴリの整形
	$contact = $this->translate_category_to_jp($data);
	return $contact;
    }

    /*
     * For admin side.
     * @author Aya
     */
    public function get_list_of_info($condition, $parameters){
        if ($parameters['total'] == 0) {
            return array();
        }

        $param = array(
            'offset'     => $parameters['offset'],
            'limit'      => $parameters['limit'],
            'type'     => array(5,6,7),
				  //$this->config->item('info_user', 'contact_config'),
                                  //$this->config->item('info_employer', 'contact_config'),
                                  //$this->config->item('info_agency', 'contact_config')),
            'delete_flg' => $this->config->item('not_deleted','common_config')
        );

        $this->load->model('Logic_contact');
        $data = $this->Logic_contact->get_contact_list($condition, $param);
        //カテゴリの整形
        $info = $this->translate_category_to_jp($data);
//var_dump($data);exit;
        return $info;
    }

    /**
     * translate integer to string
     */
    private function translate_category_to_jp($data){
	$category = array(0 => '不明',
			  1 => 'アカウント未登録',
			  2 => '求職者',
			  3 => '事業所',
			  4 => '掲載申込み',
			  5 => '求職者へのお知らせ',
			  6 => '園法人へのお知らせ',
			  7=> '紹介会社へのお知らせ'); 
			  //$this->config->item('none')           => '不明',
                          //$this->config->item('guest')          => 'アカウント未登録',
                          //$this->config->item('logged_user')    => '求職者',
                          //$this->config->item('logged_client')  => '事業所',
                          //$this->config->item('business_offer') => '掲載申込み',
                          //$this->config->item('info_user')      => '求職者へのお知らせ',
                          //$this->config->item('info_employer')  => '園法人へのお知らせ',
                          //$this->config->item('info_agency')    => '紹介会社へのお知らせ');

	$status = array($this->config->item('send')     => '未対応',
			$this->config->item('answered') => '対応済');
	$button = array($this->config->item('send')     => '対応済に変更する',
                        $this->config->item('answered') => '未対応に変更する');

        foreach($data as $key => $val){
            $num_ctg = intval($val['type']);
            $val['type']   = (isset($category[$num_ctg])) ? $category[$num_ctg] : '該当なし';
	    $val['button'] = "";
	    if(isset($val['status'])){
		$num_st = intval($val['status']);
		$val['status'] = (isset($status[$num_st])) ? $status[$num_st] : '';
		$val['button'] = (isset($button[$num_st])) ? $button[$num_st] : ''; 
	    }

            $data[$key] = $val;
        }
        return $data;
    }

    /**
     * get contact detail
     * @param  [string] $id = user_id
     * @return [array]
     */
    public function get_detail($id)
    {
	$this->load->model('Logic_contact');
        $param = array(
            'contact_id' => $id,
            'delete_flg' => 0 //$this->config->item('not_deleted','common_config')
        );
        $data[] = $this->Logic_contact->get_detail($param);
	if(isset($data[0])){
	    //整形
	    $contact = $this->translate_category_to_jp($data);
            if(isset($contact[0])){
	        return $contact[0];
	    }
	}
	return false;
    }

    public function  get_total_count($condition){
	$this->load->model('Logic_contact');
//var_dump($condition);exit;
        return $this->Logic_contact->get_total_count($condition);
    }

    public function update_status($get){
	//$get = array(2) { ["contact_id"]=> string(2) "25" ["status"]=> string(2) "on" }
	if(isset($get['contact_id'])){
	    $param['contact_id'] = $get['contact_id'];
	    if(isset($get['status']) && $get['status'] == '未対応'){
		$param['status'] = 1; //$this->config->item('answered','contact_config');
	    }else{
		$param['status'] = 0; //$this->config->item('send','contact_config');
	    }
	    $this->load->model('Logic_contact');
            return $this->Logic_contact->update_status($param);
	}else{
	    return false;
	}
    }

    /**
     * Get contact.type value
     * @param string $typeName
     * @return  number
     */
    public function getTypeNumber($typeName){
        $types = [
            'guest'  => $this->config->item('guest'),
            'user'   => $this->config->item('logged_user'),
            'client' => $this->config->item('logged_client'),
        ];
        return $types[$typeName];
    }

    /**
     * Get type name to send email config
     * @param string $typeName
     * @return  number
     */
    public function getTypeName($typeNumber){
        $types = [
            $this->config->item('guest')         => 'guest',
            $this->config->item('logged_user')   => 'user',
            $this->config->item('logged_client') => 'client',
            $this->config->item('business_offer') => 'business_offer',
        ];
        return $types[$typeNumber];
    }
}
