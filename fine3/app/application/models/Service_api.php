<?php
// if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once 'User_abstract.php';

class Api extends User_abstract{

    public function __construct()
    {
        parent::__construct();
    }
    /**
     * send json from param and recieve response as json
     * @param  $param['url']  -> target url path
     *         $param['data'] -> array data to send as json
     * @return $json raw json data
     */
    private function send_json($param){
        $url  = $param['url'];
        $data = $param['data'];
        $ch = curl_init( $url );
                    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json; charset=utf-8","Accept:application/json"));
                    curl_setopt( $ch, CURLOPT_POST, TRUE );
                    curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode($data) );
                    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, TRUE);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $json =     curl_exec( $ch );
        $info = curl_getinfo($ch);//この関数で取得
        curl_close( $ch );
        if(empty($json)){
            return false;
        }else{
            return $json;
        }
    }
}
?>
