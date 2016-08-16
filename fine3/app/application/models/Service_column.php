<?php
Class Service_column extends MY_Model{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_wp_category(){
        $this->load->model("Logic_column");
        return $this->Logic_column->get_category();
    }

}
?>