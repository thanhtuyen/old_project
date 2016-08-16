<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once 'Admin_Abstract.php';
Class Analyze extends Admin_Abstract
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Service_analyze');
    }

    public function index(){
	$post = $this->input->post();
	$date = isset($post['date']) ? $post['date'] : date("Y-m-d");
	$month = isset($post['date']) ? substr($post['date'],0,7) : date("Y-m");

	//get client job data
	$analyze_job = $this->Service_analyze->get_analyze_job($date);

	//get register data
	$register = $this->Service_analyze->get_register_count($date,$month);
	//get register data for graph
	$register_graph = $this->Service_analyze->get_register_graph($date);

	//get visitor data
	$visitor = $this->Service_analyze->get_visitor_count($date,$month);

	//get visitor data for graph
	$visitor_graph = $this->Service_analyze->get_visitor_graph($date);

	//get applicant data
	$applicant = $this->Service_analyze->get_applicant($date);

	//get sales by apply
	$sales = $this->Service_analyze->get_sales($date);

	//get mail
	$mail = $this->Service_analyze->get_mail($date);

	$this->smarty->assign('analyze_job', $analyze_job);
	$this->smarty->assign('date', $date);
	$this->smarty->assign('register', $register);
	$this->smarty->assign('register_graph', $register_graph);
	$this->smarty->assign('visitor', $visitor);
	$this->smarty->assign('visitor_graph', $visitor_graph);
	$this->smarty->assign('applicant', $applicant);
	$this->smarty->assign('sales', $sales);
	$this->smarty->assign('mail', $mail);
	$this->smarty->display($this->template_path()."/admin/analyze/user.html");
    }

    public function client(){
	$this->smarty->display($this->template_path()."/admin/analyze/client.html");
    }

}
