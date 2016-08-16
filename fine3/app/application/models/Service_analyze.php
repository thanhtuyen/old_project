<?php

class Service_analyze extends MY_Model
{

    /**
     *
     * @var Logic_analyze
     * @since 15/04/16
     */
    public $logic_analyze;

    public function __construct()
    {
        parent::__construct();
	$this->load->model('Logic_analyze');
    }

    //$url = "http://hoiku.fine.me/kyujin/86711/?k=nnhJan32krwYhW8xvAlGzDNXMPLHtgofG%2FAFKFXnYdY%3D&utm_source=finedb&utm_medium=email&utm_campaign=recommend";
    public function get_ads_from_url(){
	if(isset($_REQUEST['utm_source'])){
            $ads['source'] = $_REQUEST['utm_source'];
        }
        if(isset($_REQUEST['utm_medium'])){
            $ads['medium'] = $_REQUEST['utm_medium'];
        }
        if(isset($_REQUEST['utm_campaign'])){
            $ads['campaign'] = $_REQUEST['utm_campaign'];
        }

        if(isset($ads)){
            return $ads;
        }
        return false;
    }

    public function save_visitor_info_for_analyze($data, $ads = ""){
	$value['ip']           = (isset($data['ip'])) ? $data['ip'] : '';
	$value['page']         = (isset($data['page'])) ? $data['page'] : '';
	$value['career_type']  = (isset($data['career_type'])) ? $data['career_type'] : 0;
	$value['utm_source']   = (isset($ads['source'])) ? $ads['source'] : '';
	$value['utm_medium']   = (isset($ads['medium'])) ? $ads['medium'] : '';
	$value['utm_campaign'] = (isset($ads['campaign'])) ? $ads['campaign'] : '';
	$value['created']      = date("Y-m-d H:i:s");
	$result = $this->Logic_analyze->save_to_analyze($value);
    }

    public function get_mail($date){
	$mail = $this->Logic_analyze->count_send_mail($date);
	$click = $this->Logic_analyze->count_click($date);
	$job = $this->Logic_analyze->count_send_job($date);

	$data['mail'] = $mail[0]->count;
	$data['click'] = $click[0]->count;
	$data['job'] = $job[0]->count;
	return $data;
    }

    public function get_sales($date){
	$data['job'] = $this->Logic_analyze->get_sales($date, 'applicant_job');
	$data['agent'] = $this->Logic_analyze->get_sales($date, 'applicant_agency');
	return $data;
    }

    public function count_sales_from_data($data){
	//get valid plan_group status
	$this->config->load('plan_group_config');

	$status_job = array($this->config->item('nursery_application_plan','plan_group_status'),$this->config->item('nursery_part_application_plan','plan_group_status'),$this->config->item('agent_application_plan','plan_group_status'),$this->config->item('private_nursery_application_plan','plan_group_status'),$this->config->item('private_nursery_part_application_plan','plan_group_status'),$this->config->item('private_agent_application_plan','plan_group_status'));

	$status_agent = array($this->config->item('agent_registration_plan','plan_group_status'),$this->config->item('private_agent_registration_plan','plan_group_status'));

	if(! isset($data['job'])){
	    return false;
	}	
	$price_job = 0;
	foreach($data['job'] as $key => $val){
	    if(in_array($val['status'],$status_job)){
		$list_job[] = $val;
		$price_job = $price_job + intval($val['unit_price']) - intval($val['discount']);
	    }
	}

	if(! isset($data['agent'])){
            return false;
        }
	$price_agent = 0;
        foreach($data['agent'] as $key => $val){
	    if(in_array($val['status'],$status_agent)){
                $list_agent[] = $val;
		$price_agent = $price_agent + intval($val['unit_price']) - intval($val['discount']);
            }
        }

	$sales['job'] = (isset($list_job))? $list_job : array();
	$sales['agent'] = (isset($list_agent))? $list_agent : array();
	$sales['price_job'] = $price_job;
	$sales['price_agent'] = $price_agent;
	
	return $sales;
    }

    public function get_applicant($date){
	$job_day = $this->Logic_analyze->count_applicant_per_day($date,'applicant_job');
	$agent_day = $this->Logic_analyze->count_applicant_per_day($date,'applicant_agency');
	$day_job_employ = $this->Logic_analyze->count_applicant_job_per_day_employ($date);
	$day_agent_employ = $this->Logic_analyze->count_applicant_agent_per_day_employ($date);

	foreach($day_job_employ as $key => $val){
            $employ = $val->name;
            $count = $val->count;
            $data_job_employ[$employ] = $count;
        }
	foreach($day_agent_employ as $key => $val){
            $employ = $val->name;
            $count = $val->count;
            $data_agent_employ[$employ] = $count;
        }

	$ret['job_day'] = $job_day[0]->count;
	$ret['agent_day'] = $agent_day[0]->count;
	$ret['day_job_employ'] = (isset($data_job_employ))? $data_job_employ : array();
	$ret['day_agent_employ'] = (isset($data_agent_employ))? $data_agent_employ : array();
	return $ret;
    }


    public function get_register_count($date,$date_month){
	$day = $this->Logic_analyze->count_register_per_day($date);
	$month = $this->Logic_analyze->count_register_per_day($date_month);

	$all = $this->Logic_analyze->count_all_register();

	$pre_day_service = $this->Logic_analyze->count_register_per_day_service($date);
	$pre_month_service = $this->Logic_analyze->count_register_per_day_service($date_month);
	$pre_all_service = $this->Logic_analyze->count_register_per_day_service();

	foreach($pre_day_service as $key => $val){
	    $channel = $val->channel;
	    $count = $val->count;
	    $data_day[$channel] = $count;
	}
	foreach($pre_month_service as $key => $val){
            $channel = $val->channel;
            $count = $val->count;
            $data_month[$channel] = $count;
        }
	foreach($pre_all_service as $key => $val){
            $channel = $val->channel;
            $count = $val->count;
            $data_all[$channel] = $count;
        }

	$ret['day'] = $day[0]->count;
	$ret['month'] = $month[0]->count;
	$ret['all'] = $all[0]->count;
	$ret['day_service']   = (isset($data_day))? $data_day : array();
	$ret['month_service'] = (isset($data_month))? $data_month : array();
	$ret['all_service']   = (isset($data_all))? $data_all : array();
	return $ret;
    }

    public function get_analyze_job($date){
	$result = $this->Logic_analyze->get_analyze_job($date);

	$data['open_jobs_number']       = ($result['open_jobs_number']!=null)? $result['open_jobs_number']:0;
        $data['closed_jobs_number']     = ($result['closed_jobs_number']!=null)? $result['closed_jobs_number']:0;
        $data['active_clients_number']  = ($result['active_clients_number']!=null)? $result['active_clients_number']:0;
        $data['passive_clients_number'] = ($result['passive_clients_number']!=null)? $result['passive_clients_number']:0;
	return $data;
    }

    public function get_register_graph($date){
	$ret = array();
	$ret = $this->Logic_analyze->count_register_per_day_hour($date);
	foreach($ret as $key => $val){
	    $data[$key] = $val[0]->count;
	}
	return $data;
    }

    public function get_visitor_count($date,$date_month){
	$ret['day'] = 0;
        $ret['day_service'] = 0;
        $ret['all'] = 0;

	$day = $this->Logic_analyze->count_visitor_per_day($date);
	$month = $this->Logic_analyze->count_visitor_per_day($date_month);
	$all = $this->Logic_analyze->count_all_visitor();

	$day_service = $this->Logic_analyze->count_visitor_per_day_service($date);
	foreach($day_service as $key => $val){
            $count = $val[0]->count;
            $data[$key] = $count;
        }

	$ret['day'] = $day[0]->count;
	$ret['month'] = $month[0]->count;
        $ret['all'] = $all[0]->count;
        $ret['day_service'] = $data;
	return $ret;
    }

    public function get_visitor_graph($date){
	$ret = array();
        $ret = $this->Logic_analyze->count_visitor_per_day_hour($date);
	foreach($ret as $key => $val){
            $data[$key] = $val[0]->count;
        }
        return $data;
    }

    /**
     * ticket 1147
     *
     *
     * @since 15/04/16
     * @param $data array
     *            reference
     * @return boolean
     */
    public function campaign(&$data)
    {
        /**
         * Check data before using
         * 1.
         * Load model
         * 2. Prepare for inital/default data
         * 3. Insert data into table
         * 4. return
         */
        // Check data before using
        if (empty($data)) {
            return false;
        }
        // 1. Load model
        $this->load->model('Logic_analyze');

        // 2. Prepare for inital/default data
        $data['created'] = date('Y-m-d H:i:s');

        // 3. Insert data into table
        $result = $this->Logic_analyze->create($data);
        // 4. return if fail
        if ($result === false) {
            return false;
        }

        /**
         * Set id
         */
        $data['analyze_id'] = $result;

        return (bool) $result;
    }

    public function save_daily_job_client($param){
	$open_jobs_number       = (isset($param['open_jobs']))? $param['open_jobs'] : 0;
	$closed_jobs_number     = (isset($param['closed_jobs']))? $param['closed_jobs'] : 0;
	$active_clients_number  = (isset($param['active_clients']))? $param['active_clients'] : 0;
	$passive_clients_number = (isset($param['passive_clients']))? $param['passive_clients'] : 0;
	$created		= date('Y-m-d H:i:s');

	$sql = "INSERT INTO `analyze_job` (`open_jobs_number`,`closed_jobs_number`,`active_clients_number`,`passive_clients_number`,`created`) VALUES (".$open_jobs_number.",".$closed_jobs_number.",".$active_clients_number.",".$passive_clients_number.",'".$created."')";

	$this->db->query($sql);
    }
}
