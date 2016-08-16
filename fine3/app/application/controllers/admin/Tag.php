<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once 'Admin_Abstract.php';
Class Tag extends Admin_Abstract
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Service_tag');
    }

    public function add()
    {
        $groups = $this->Service_tag->get_tag_group();

        $this->smarty->assign('groups', $groups);
        $this->smarty->display($this->template_path().'/admin/tag/add.html');
    }

    public function create()
    {
        if (!$this->isPost()) {
            return redirect(base_url('manager/tag/add'));
        }

        $posts = $this->input->post(null, true);

         if ($this->Service_tag->save($posts)) {
            $this->session->set_flashdata('notice', 'success');
        }else {
            $this->session->set_flashdata('alert', 'fail');
        }

        redirect(base_url('manager/group'));

    }

    public function edit($id)
    {

        $groups = $this->Service_tag->get_tag_group();
        $tag = $this->Service_tag->get_detail($id);

        $this->smarty->assign('groups', $groups);
        $this->smarty->assign('tag', $tag);
        $this->smarty->display($this->template_path().'/admin/tag/edit.html');
    }

    public function update()
    {
        if (! $this->isPost()) {
            return redirect($_SERVER['HTTP_REFERER']);
        }

        $posts = $this->input->post(null, true);

        if ($this->Service_tag->update($posts)) {
            $this->session->set_flashdata('notice', 'success');
        }else {
            $this->session->set_flashdata('alert', 'fail');
        }

        redirect(base_url('manager/group'));
    }

    /**
     * delete tag by tag id
     */
    public function delete_flg($id)
    {
        if ($this->Service_tag->delete_flg($id)) {
            $this->session->set_flashdata('notice', 'success');
        }else {
            $this->session->set_flashdata('alert', 'fail');
        }
        redirect(base_url('manager/group'));
    }
}
