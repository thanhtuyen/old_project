<?php
class Analyze extends MY_Controller {

    public function count_all_job()
    {
        $this->load->model("Service_job", "job");
        $this->job->count_alljob();
    }

    public function save_job_client_number(){
	$this->load->model('Service_job');
	$this->load->model('Service_client');
	$this->load->model('Service_analyze');
	$this->load->config('client_config');
	$this->load->config('common_config');
	$this->load->config('nursery_config');
	$this->load->config('job_config');

	//count open job
	$client_status  = $this->config->item('enabled', 'client_config');
	$nursery_status = $this->config->item('public', 'nursery_config');
	$job_status     = $this->config->item('public', 'job_config');
	$delete_flg     = $this->config->item('not_deleted', 'common_config');

	$job_param = array(
		      'client_status'  => (isset($client_status))? $client_status : 0,
		      'nursery_status' => (isset($nursery_status))? $nursery_status : 0,
		      'job_status'     => (isset($job_status))? $job_status : 1,
		      'delete_flg'     => (isset($delete_flg))? $delete_flg : 0,
			);

	$data['open_jobs']   = 0;
	$all_jobs            = 0;
	$data['closed_jobs'] = 0;

	$data['open_jobs']   = $this->Service_job->search_count($job_param);
	$all_jobs            = $this->Service_job->count_alljob();
	$data['closed_jobs'] = $all_jobs - $data['open_jobs'];

	//count active client
	$all_clients             = 0;
	$data['active_clients']  = 0;
	$data['passive_clients'] = 0;

	$all_clients             = $this->Service_client->get_total_count();
	$data['active_clients']  = $this->Service_client->count_active_client($job_param);
	$data['passive_clients'] = $all_clients - $data['active_clients'];

	//save to analyze_job table
	$this->Service_analyze->save_daily_job_client($data);
    }

}
