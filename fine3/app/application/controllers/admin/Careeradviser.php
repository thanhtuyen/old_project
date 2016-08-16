<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once 'Admin_Abstract.php';
Class Careeradviser extends Admin_Abstract
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Service_agent");
    }

    public function index($agent_id)
    {
        list($career_advisers, $agent) = $this->Service_agent->career_adviser_index($agent_id);

        $this->smarty->assign('cas', $career_advisers);
        $this->smarty->assign('agent', $agent);
        $this->smarty->display($this->template_path().'/admin/careeradvise/index.html');

    }


    public function update()
    {

        if (! $this->isPost()) {
            return redirect($_SERVER['HTTP_REFERER']);
        }

        $post = $this->input->post(null, true);

        $param = array(
            'client_id' => $post['client_id'],
            'name' => $post['name'],
            'message' => $post['message'],
            'career_adviser_id' => $post['career_adviser_id'],
            'updated' => current_time(),
        );

        if ($this->Service_agent->career_adviser_update($param)) {
            $this->session->set_flashdata('notice', 'success');
        }else {
            $this->session->set_flashdata('alert', 'fail');
        }

        redirect($_SERVER['HTTP_REFERER']);

    }

    public function delete_flg($career_adviser_id)
    {
        if ($this->Service_agent->career_adviser_delete_flg($career_adviser_id)) {
            $this->session->set_flashdata('notice', 'success');
        }else {
            $this->session->set_flashdata('alert', 'fail');
        }

        redirect($_SERVER['HTTP_REFERER']);
    }








}