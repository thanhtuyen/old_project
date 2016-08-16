<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once 'Admin_Abstract.php';
Class Group extends Admin_abstract
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Service_tag');
    }

    public function index()
    {
        $categories = $this->Service_tag->get_categories();

        $this->smarty->assign('categories', $categories);
        $this->smarty->display($this->template_path().'/admin/group/index.html');
    }


    /**
     * add tag group
     */
    public function add()
    {
        $this->smarty->display($this->template_path().'/admin/group/add.html');
    }
    /**
     * save tag group
     *
     */
    public function create()
    {
        if (! $this->isPost()) {
            return redirect(base_url('manager/group/add'));
        }

        $posts = $this->input->post(null, true);

        try {

            if ($this->Service_tag->save_tag_group($posts)) {
                $this->session->set_flashdata('notice', 'success');
            }else {
                $this->session->set_flashdata('alert', 'fail');
            }

            return redirect(base_url('manager/group'));

        } catch (Exception $e) {
            $this->session->set_flashdata('alert', $e->getMessage());

            return redirect(base_url('manager/group/add'));
        }

    }
    /**
     * edit tag group page
     * @param  [string] $id
     */
    public function edit($id)
    {
        $group = $this->Service_tag->get_tag_group_detail($id);

        $this->smarty->assign('group', $group);
        $this->smarty->display($this->template_path().'/admin/group/edit.html');
    }

    /**
     * update tag group
     *
     */
    public function update()
    {
        if (! $this->isPost()) {
            return redirect($_SERVER['HTTP_REFERER']);
        }

        $posts = $this->input->post(null, true);

        if ($this->Service_tag->update_for_tag_group($posts)) {
            $this->session->set_flashdata('notice', 'success');
        }else {
            $this->session->set_flashdata('alert', 'fail');
        }

        return redirect(base_url('manager/group'));;
    }

    /**
     * group delete_flg
     */
    public function delete_flg($id)
    {
        if ($this->Service_tag->delete_for_tag_group($id)) {
            $this->session->set_flashdata('notice', 'success');
        }else {
            $this->session->set_flashdata('alert', 'fail');
        }
        redirect(base_url('manager/group'));
    }

    public function batch_delete()
    {

        $group_id = $this->input->post('groupid', TRUE);
        $tag_id = $this->input->post('tagid', TRUE);

        if ($this->Service_tag->batch_delete($group_id, $tag_id)) {
            $this->session->set_flashdata('notice', 'success');
        }else {
            $this->session->set_flashdata('alert', 'fail');
        }
        redirect(base_url('manager/group'));

    }


}
