<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once 'Admin_Abstract.php';
Class Area extends Admin_Abstract
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Service_area");
    }

    public function get_city_by_pref()
    {
        $pref_id = $this->input->post('pref_id', true);
        $city_list = $this->Service_area->get_city_by_pref($pref_id);
        $html = '<option value="">市区町村を選択</option>';
        foreach ($city_list as $key => $city) {
            $html .= '<option value="'.$city['area_id'].'">'.$city['name'].'</option>';
        }
        $data = array('option' => $html);
        header('Content-Type: application/json');
        echo json_encode($data, JSON_PRETTY_PRINT);
    }


}