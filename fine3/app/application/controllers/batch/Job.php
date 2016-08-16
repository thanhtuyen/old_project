<?php
class Job extends MY_Controller {

    //close expire dated job
    public function close_job()
    {
        $this->load->model('Service_job');
        $jobs = $this->Service_job->pickup_expired();
        if(empty($jobs)){
            echo "no jobs to expire today.";
            exit;            
        }
        foreach($jobs as $data){
            $result[] = $data['job_id'];
        }
        $rows = $this->Service_job->expire($result);

        //this function is for reporting.
        if(count($result) == $rows){
            //success
        }else{
            //false
        }
    }
}