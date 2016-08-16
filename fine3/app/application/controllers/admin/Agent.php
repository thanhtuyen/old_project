<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once 'Admin_Abstract.php';
Class Agent extends Admin_Abstract
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Service_agent");
        $this->load->model("Service_area");
        $this->load->model("Service_tag");
    }

    public function detail($agent_id)
    {
        list($agent, $career_adviser, $plan, $photo) = $this->Service_agent->get_agent_detail($agent_id);

        $this->smarty->assign('plans', $plan);
        $this->smarty->assign('agent', $agent);
        $this->smarty->assign('photo', $photo);
        $this->smarty->assign('cas', $career_adviser);
        $this->smarty->display($this->template_path().'/admin/client/agent-detail.html');

    }

    public function edit($agent_id)
    {
        $agent = $this->Service_agent->agent_info($agent_id);
        $photo = $this->Service_agent->get_photo($agent_id);
        $states = $this->Service_area->get_pref_list();
        $occupations = $this->Service_tag->get_occupation_list();
        $checked_occupation = $this->Service_agent->get_job_array($agent_id);
        $checked_state = $this->Service_agent->get_area_array($agent_id);

        $this->smarty->assign('agent', $agent);
        $this->smarty->assign('photo', $photo);
        $this->smarty->assign('states', $states);
        $this->smarty->assign('occupations', $occupations);
        $this->smarty->assign('checked_state', $checked_state);
        $this->smarty->assign('checked_occupation', $checked_occupation);
        $this->smarty->display($this->template_path().'/admin/client/agent-edit.html');
    }

    public function update()
    {

        if (! $this->isPost()) {
            // return $this->edit();
            return redirect($_SERVER['HTTP_REFERER']);
        }
        $post = $this->input->post(null, true);

        if ($this->Service_agent->update($post)) {
            $this->session->set_flashdata('notice', 'success');
        }else {
            $this->session->set_flashdata('alert', 'fail');
        }
         return redirect(base_url('manager/agent/detail') . '/' . $post['client_id']);

    }

    public function update_pr()
    {
        if (! $this->isPost()) {
            // return $this->edit();
            return redirect($_SERVER['HTTP_REFERER']);
        }
        $post = $this->input->post(null, true);

        if ($this->Service_agent->update_pr($post)) {
            $this->session->set_flashdata('notice', 'success');
        }else {
            $this->session->set_flashdata('alert', 'fail');
        }
        return redirect(base_url('manager/agent/detail') . '/' . $post['client_id']);

    }
    public function dammy_agent_login($agent_id)
    {
        $agent = $this->Service_agent->get_agent_detail($agent_id);
        /*
        if ($agent[0]['status'] == '0') {
            redirect($this->config->config["base_url"]."admin/agent/detail".$agent_id);
        }
        */
        $client_data['client_id'] = $agent[0]['client_id'];
        $this->session->set_userdata(array("client_data"=>array("client_id"=>$client_data['client_id'])));
        redirect($this->config->config["base_url"]."client");
    }
}



