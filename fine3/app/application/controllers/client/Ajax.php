<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends MY_Controller
{
    const RESPONSE_CODE_ERROR  = 0;    // Ajax Response : ERROR
    const RESPONSE_CODE_SUCCESS = 1;    // Ajax Response : SUCCESS

    public function __construct() {
        parent::__construct();
        if($this->_is_ajax_process() === FALSE);
    }

    /*
    please use to delete some job which has client .
    */
    public function delete_clientsjob() {
        //1. get job_id
        //2. $this-Service_job->delete()
        //   please change delete_flg of job
    }

    public function delete_template(){
        $param['client_id'] = $this->_get_client_id();
        $this->input->post();
        if((empty($post['template_id']))&&(empty($param['client_id']))){
            return false;
        }
        $param['template_id'] = $post['template_id'];
        $this->load->model('Service_scout');
        $result = $this->Service_scout->delete($param);

        return $result;
    }

    public function check_client_exist(){
        $params["where"] = $this->input->post();

        $response["code"] = self::RESPONSE_CODE_ERROR;

        if(!empty($params)){
            $response["code"] = self::RESPONSE_CODE_SUCCESS;

            $params["select"] = array("client_id","name");
            $params["where"]["status"] = 0;
            $params["where"]["delete_flg"] = 0;

            if(isset($params["where"]["password"]))$params["where"]["password"] = md5($params["where"]["password"]);
            $unique = false;
            if(isset($params["where"]["unique"])){
                $unique = $params["where"]["unique"];
                unset($params["where"]["unique"]);
            }

            $this->load->model("Service_client");
            $response["result"] = $this->Service_client->get_client_data($params);

            if($unique && count($response["result"]) > 1){
                parent::report_to_administrator(array("subject"=>"【FINE!3.0 BUG_REPORT】同じメールアドレスの有効ユーザーレコードが複数存在","message"=>$response["result"]));
                $response["code"] = self::RESPONSE_CODE_ERROR;
            }
        }

        $this->_response_view($response);
    }


    /**
     * ThinhNH
     * Get lon, lat by nursery address
     * @param $strAddr
     * @return array|string
     */
    public function get_lon_lat_by_address()
    {
        $response["code"] = self::RESPONSE_CODE_ERROR;
        $address = $this->input->post('address');
        $app_id = "dj0zaiZpPXREMlI3a1BXWFVJYiZzPWNvbnN1bWVyc2VjcmV0Jng9YzY-";

        $strRes = file_get_contents(
            'http://geo.search.olp.yahooapis.jp/OpenLocalPlatform/V1/geoCoder?output=json'
            . '&appid=' . $app_id
            . '&query=' . urlencode(mb_convert_encoding($address, 'UTF-8'))
        );

        $aryGeo = json_decode($strRes, TRUE);

        if (($aryGeo['ResultInfo']['Count'] == 0)){

            $point = false;
            $list_station = false;
        } else {
            $response["code"] = self::RESPONSE_CODE_SUCCESS;
            $strGeo = $aryGeo['Feature'][0]['Geometry']['Coordinates'];
            $strLngLat = explode(",",$strGeo);
            $point = array(
                'lon' => $strLngLat[0],
                'lat' => $strLngLat[1],
            );

            // get list stations
            $radius = 1;
            $this->load->model('Service_station');
            $list_station = $this->Service_station->get_station_list_near_point($point['lon'],$point['lat'], $radius);

        }
        $response["point"] = $point;
        $response['list_stations'] = $list_station;

        $this->_response_view($response);
    }

    /**
     * ThinhNH
     * Get more station near the point
     * In 2 km radius
     */
    public function get_more_station_near_point(){
        $lon = $this->input->post('lon');
        $lat = $this->input->post('lat');
        $radius = 2; //2 km
        $this->load->model('Service_station');
        $list_station = $this->Service_station->get_station_list_near_point($lon,$lat, $radius);
        $data = array(
            'code' => self::RESPONSE_CODE_SUCCESS,
            'list_stations' => $list_station
        );
        $this->_response_view($data);
    }


    /**
     * check ajax request
     * @param none
     * @return boolean
     */
    private function _is_ajax_process() {
        if((!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === "xmlhttprequest")||strpos($_SERVER['HTTP_ACCEPT'], 'text/plain') !== false) {
            return TRUE;
        }else{
            return FALSE;
        }
    }

    private function _response_view($response){
        header('Content-Type: text/json; charset=utf-8');
        echo json_encode($response);
        exit;
    }
}
