<?php
class Plan extends MY_Controller {

    public function extend(){
        $this->load->model('Service_plan');
        //extend plan check
        $plans = $this->Service_plan->check_extend();
        if(empty($plans)){
            echo "no plans to extend today.";
            exit;            
        }
        $id = array();
        //extend execute each data
        foreach($plans as $data){
            $extend = $this->Service_plan->extend($data['client_plan_group_relation_id']);
            if(!empty($extend)){
                $id[] = array('client_plan_group_relation_id' => $data['client_plan_group_relation_id']);
            }else{
                //send alert message
            }
        }
        //disable old plan only for extend_flg = 1
        if(!empty($id)){
                $result[]  = $this->Service_plan->expire($id,1);
        }
        exit;
    }

    //expire plan
    public function expire(){
        $this->load->model('Service_plan');
        $plans = $this->Service_plan->check_expire();
        if(empty($plans)){
            echo "no plans to expire today.";
            exit;            
        }
        foreach($plans as $data){
            $result[] = $data['client_plan_group_relation_id'];
        }
        //expire plan only for extend_flg = 0
        $rows = $this->Service_plan->expire($result,0);
        return $result;
    }

}