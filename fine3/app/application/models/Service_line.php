<?php
Class Service_line extends MY_Model{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Logic_line');
    }



    public function get_detail($line_id){
        $param = array(
            'line_id' => $line_id,
            'delete_flg' =>0,
            'select' => ' line_id, line_cd, line_name_h'
        );
        $station = $this->Logic_line->get_detail($param);
        return $station;
    }
}    
    