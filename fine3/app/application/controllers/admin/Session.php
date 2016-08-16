<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once 'Admin_Abstract.php';
Class Session extends Admin_Abstract
{
    public function add()
    {
	if(parent::_is_admin_login())redirect(base_url('manager/statics'));
        $this->smarty->display($this->template_path().'/admin/session/add.html');
    }

    public function create()
    {
        if (! $this->isPost()) {
             return $this->add();
        }

        $email = $this->input->post('email', true);
        $password = $this->input->post('password', true);
        $code = 1;

        if ($email !== 'admin@hoikuvertical.jp' ) {
            $code = 'メールアドレスかパスワードが間違っています';
        }

        if (md5($password) !== '1adbb3178591fd5bb0c248518f39bf6d') {
            $code = 'メールアドレスかパスワードが間違っています';
        }
        if($code === 1) {
	    $session["login"] = true;
	    $this->session->set_userdata(array("admin_data"=>$session));
            redirect(base_url('manager/statics'));
        }else {
            $this->session->set_flashdata('alert', 'Error: ' . $code);
        }
        return $this->add();
    }

    public function delete()
    {
	$this->session->set_userdata(array("admin_data"=>array("login"=>false)));
        //$this->session->sess_destroy();
        $this->smarty->display($this->template_path().'/admin/session/add.html');
    }

    public function generate_url(){
	$post = $this->input->post();

	if(!empty($post)){
	    if($post['mail'] == ''){
		$error['mail'] = 'blank';
	    }else{
		$this->load->model('Service_user');
		$user_id = $this->Service_user->get_userid_from_mail($post['mail']);
		if($user_id){
		    $post['user_id'] = $user_id;
		}else{
		    $error['mail'] = 'noexist';
		}
	    }

	    if($post['job_id'] == ''){
		$error['job_id'] = 'blank';
	    }else{
		$this->load->model('Service_job');
		$job = $this->Service_job->get_detail($post['job_id']);
		if($job){
		    $post['job'] = $job;
	    }else{
		    $error['job_id'] = 'notexist';
		}
	    }

	    if(empty($error)){
		$this->session->unset_userdata('url_data');
		$url_data = array('url_data' => $post);
		$this->session->set_userdata($url_data);
		redirect('manager/session/generate_comp');
	    }else{
		$this->smarty->assign('error',$error);
	    }

	}

	$data['mail'] = (isset($post['mail']))? $post['mail']:"";
	$data['job_id'] = (isset($post['job_id']))? $post['job_id']:"";

	$this->smarty->assign('data',$data);
	$this->smarty->display($this->template_path().'/admin/session/generate_url.html');
    }

    public function create_url(){
	$data = $this->session->all_userdata();
	$this->session->unset_userdata('url_data');
	if(!isset($data['url_data'])){
	    redirect('admin/session/generate_url');
	}else{
	    $param = $data['url_data'];
	    $base_url = base_url();

	    $md5_before = $param['user_id'].$base_url.$param['job_id'];

	    //重複がないかチェック、あったら前のexpiredをupdate
	    $this->load->model('Service_send_job');
	    
	    $md5_after = md5($md5_before);
	    $is_same = $this->Service_send_job->is_exist_same_secret($md5_after);

//var_dump($is_same);exit;
	    if($is_same['count'] == "0"){
	        $url = $this->Service_send_job->generate_url($param,$md5_after);
	    }elseif($is_same['count'] == "1"){
		$url = $this->Service_send_job->update_old_expired($param,$md5_after);
	    }else{
		redirect('manager/session/generate_url');
	    }

	    $this->smarty->assign('url', $url);
	    $this->smarty->display($this->template_path().'/admin/session/generate_comp.html');
	}
    }

}
