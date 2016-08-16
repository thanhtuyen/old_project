<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once 'Admin_Abstract.php';
Class Nursery extends Admin_Abstract
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Service_nursery");
    }

    public function detail($client_id)
    {

        list($nursery, $plan, $photo) = $this->Service_nursery->get_nursery_detail($client_id);
        $this->smarty->assign('nursery', $nursery);
        $this->smarty->assign('plans', $plan);
        $this->smarty->assign('photo', $photo);
        $this->smarty->display($this->template_path().'/admin/client/nursery-detail.html');

    }

    public function create_plan($agent_id)
    {
        $this->smarty->display($this->template_path().'/admin/client/nursery-add-plan.html');
    }

    public function edit($client_id)
    {
        list($nursery, , $photo) = $this->Service_nursery->get_nursery_detail($client_id);

        $this->smarty->assign('nursery', $nursery);
        $this->smarty->assign('photo', $photo);
        $this->smarty->display($this->template_path().'/admin/client/nursery-edit.html');
    }

    public function update()
    {
        if (! $this->isPost()) {
            return redirect($_SERVER['HTTP_REFERER']);
        }
        $post = $this->input->post(null, true);

        if ($this->Service_nursery->update($post)) {
            $this->session->set_flashdata('notice', 'success');
        }else {
            $this->session->set_flashdata('alert', 'fail');
        }

        redirect(base_url('manager/nursery/detail') . '/' . $post['client_id']);
    }

    public function update_pr()
    {
        if (! $this->isPost()) {
            return redirect($_SERVER['HTTP_REFERER']);
        }
        $post = $this->input->post(null, true);

        if ($this->Service_nursery->update_pr($post)) {
            $this->session->set_flashdata('notice', 'success');
        }else {
            $this->session->set_flashdata('alert', 'fail');
        }
        redirect(base_url('manager/nursery/detail') . '/' . $post['client_id']);
    }

    public function dammy_nursery_login($client_id)
    {
        $client = $this->Service_nursery->get_nursery_detail($client_id);

        $client_data['client_id'] = $client[0]['client_id'];
        $this->session->set_userdata(array("client_data"=>array("client_id"=>$client_data['client_id'])));
        redirect($this->config->config["base_url"]."client");

    }
}

