<?php
class Batch extends CI_Controller {

    public function make_3job_list()
    {
        try
        {
            $this->load->model("Service_job", "job");
            $this->load->model("Service_user", "user");
            $users = $this->user->get_threemail_target();
            $ret = $this->job->make_three_job($users);
        }catch(Exception $e){
             echo $e->getMessage();
             echo $e->getTraceAsString();
        }

    }
    public function send_3job_mail()
    {
        try
        {
            $manager = new \Comos\Qpm\Pid\Manager(APPPATH . '../tmp/send_3job_mail.pid');
            $manager->start();
            $this->load->model("Service_send_job");
            $this->Service_send_job->send_three_mail();
        }catch(Exception $e){
             echo $e->getMessage();
             echo $e->getTraceAsString();
        }
    }

}
