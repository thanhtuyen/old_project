<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once 'Client_abstract.php';

class Plan extends Client_abstract
{
    public function __construct() {
        parent::__construct();
        if(!$this->_is_client_login() && strpos($this->uri->uri_string,"client/login") === false)redirect($this->config->config["base_url"]."client/login");
    }

    /*
    please show ALL plan_group list
    */
    public function index(){
        $client_id = $this->_get_client_id();
        $this->load->model('Service_plan');
        $plan_list = $this->Service_plan->get_available_list($client_id);

        //3. get current condition.
        //for display pagenation and how many will this get jobs
        //
        //reset pagenation data
        $page = 1;
        $page_get = $this->input->get('page');
        if(!empty($page_get)){
            $page = $page_get;
        }
        $count = count($plan_list);
        $this->smarty->assign('count',$count);

        $list_param['range']      = $this->config->item('search_result_rows','job_config');
        $list_param['page']       = $page;
        $list_param['limit']      = $count;

        //set display job limitation
        $search_param['limit_to']   = next_endpoint($list_param);
        $this->smarty->assign('limit_to',$search_param['limit_to']);
        $search_param['limit_from'] = next_startpoint($list_param,$search_param['limit_to'],$page);
        $this->smarty->assign('limit_from',$search_param['limit_from']);

        //make pagenation
        $page_count = 0;
        if($count > 1000){
            $page_count = 1000;
        }else{
            $page_count = $count;
        }

        $pagination = $this->_get_pagination($page_count,$list_param['range']);

        $this->smarty->assign('pagination',$pagination);

        $plan_display_list = array_slice ( $plan_list , $search_param['limit_from'] ,$list_param['range']);
        $this->smarty->assign('plan_list',$plan_display_list);
    	//C_25
        $this->smarty->display("pc/client/plan/new_plan.html");
    }

    /*
    please show plan list that client have applyed .
    */
    public function applied_plan() {
        $get = $this->input->get();
        $client_id = $this->_get_client_id();
        $this->load->model('Service_plan');
        $plan_list = $this->Service_plan->get_list($client_id);
        //pagenation
        $range = 10;
        $count = count($plan_list);
        if(array_key_exists('page', $get)){
            $page = $get['page'];
            if(is_numeric($page)){
                $offset = ($page-1) * $range;
                $limit   = $offset + $range;
                if($limit > $count){
                    $limit = $count;
                }
            }else{
                $offset = 0;
                $limit = $range;
                if($limit > $count){
                    $limit = $count;
                }
            }
        } else{
                $offset = 0;
                $limit = $range;
                if($limit > $count){
                    $limit = $count;
                }
        }
        if(empty($plan_list)){
            $plan_list_show = false;
        }else{
            $plan_list_show = array_slice($plan_list, $offset,$limit);
        }
        $this->smarty->assign('plan_list',$plan_list_show);
        $url = base_url().'client/plan/applied_plan/';
        $pagination = $this->_get_pagination($count,$range,"",$url);
        $this->smarty->assign('pagination',$pagination);

        //C_14
        //0. get all plan from plan group  //Maybe all "plan_group" byAYA
        //1. get applyed id from "client_plan_group_relation"table
        $this->smarty->display("pc/client/plan/applied_plan.html");
    }
    public function detail($plan_group_id = null){
        $plan_group_id = $this->uri->segment(4);
        $client_id = $this->_get_client_id();
        //when unvisiable client id is selected, redirect
        if((empty($client_id))||(empty($plan_group_id))){
            redirect(base_url().'client/plan/');
        }
        $this->load->model('Service_plan');
        $param['client_id'] = $client_id;
        $param['plan_group_id'] = $plan_group_id;
        $plan_detail = $this->Service_plan->get_group_detail($param);
        if(empty($plan_detail)){
            redirect(base_url().'client/plan/');
        }
        $this->smarty->assign('plan_detail',$plan_detail);
        $plan_list = $this->Service_plan->get_plan_list($plan_detail['plan_group_id']);
        $this->smarty->assign('plan_list',$plan_list);

        $this->smarty->assign('status','not_applied');
        //C24
        $this->smarty->display("pc/client/plan/detail.html");
    }
    public function applied_detail($client_plan_group_relation_id = null){
        $client_id = $this->_get_client_id();
        //when unapplied plan is selected, redirect to plan root.
        if((empty($client_id))&&(empty($client_plan_group_relation_id))){
            redirect(base_url().'client/plan/');
        }
        $this->load->model('Service_plan');
        $param['client_id'] = $client_id;
        $param['client_plan_group_relation_id'] = $client_plan_group_relation_id;
        $plan_detail = $this->Service_plan->get_detail($param);
        if(empty($plan_detail)){
            redirect(base_url().'client/plan/');
        }
        $plan_detail['result_price'] = $this->_calc_discount($plan_detail);
        $this->smarty->assign('plan_detail',$plan_detail);
        $this->smarty->assign('status','applied');
    	//C24
        $this->smarty->display("pc/client/plan/applied_detail.html");
    }
    private function _calc_discount($plan_detail){
        $result = $plan_detail['price'] - $plan_detail['discount'];
        if($result > 0){
            return $result;
        }else{
            return 0;
        }
    }
    public function complete(){
        //C27
        $this->smarty->display("pc/client/plan/complete_plan.html");
    }

    /*
    this is page that client apply some plan
    */
/* Removed by AYA 
    public function input() {
        //C_25
        //1. get plan detail info
        //
        $this->smarty->display("pc/client/plan/create.html");
        //1. get plan detail info //don't need. just do "insert". ByAYA
        //$this->smarty->display(''); //don't need to display.just redirect to complete page ByAYA
    } 
*/

    /*
    this is page that client apply some plan
    */
    public function apply() {
        //1. get plan_group_id and client_id
        $post = $this->input->post();
        $client_id = $this->_get_client_id();
        //if there are some unexpected number
        if(empty($post['apply_id'])){
            redirect(base_url().'client/plan/');
        }
        $param['plan_group_id'] = $post['apply_id'];
        $param['client_id'] = $client_id;
        $this->load->model('Service_plan');
        $plan_detail = $this->Service_plan->get_group_detail($param);
        if(!$plan_detail){
            redirect(base_url().'client/plan/');
        }
        $param['plan_group'] = $plan_detail;
        // $param['auto_extend_flg'] = $plan_group[]
        //2. please insert plan_group_relation table
        $result = $this->Service_plan->apply($param);
        if(!$result){
            redirect(base_url().'client/plan/');
        }
        //3. send email to admin redirect complete page
        
        //4. redirect complete
        redirect(base_url().'client/plan/complete/');
    } 
    /*
    this is page that client delete some plan
    */
    public function stop() {
        //1. get plan_group_id and client_id
        $post = $this->input->post();
        $client_id = $this->_get_client_id();
        //if there are some unexpected number
        if(empty($post['apply_id'])){
            redirect(base_url().'client/plan/');
        }
        $param['client_plan_group_relation_id'] = $post['apply_id'];
        $param['client_id'] = $client_id;
        $this->load->model('Service_plan');
        // $param['auto_extend_flg'] = $plan_group[]
        //2. please insert plan_group_relation table
        $result = $this->Service_plan->stop($param);
        if(!$result){
            redirect(base_url().'client/plan/');
        }
        //3. send email to admin redirect complete page
        
        //4. redirect complete
        redirect(base_url().'client/plan/complete/');
    } 
    
}
