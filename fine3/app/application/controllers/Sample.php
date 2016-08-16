<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// suetake_test
class Sample extends MY_Controller {

    public function __construct(){

        parent::__construct();
        if (ENVIRONMENT != 'development') {
            $this->output->set_status_header('403');
            echo "403 - Forbidden";
        }

    }
    public function img_test () {
        $this->load->helper('image');

        $ret = getImageFromS3('1' , '5' , '1');
        exit;

    }

    public function test () {
        $user_id  = 119;
        $client_ids[]  = 19940;

        if($client_ids){
            $this->load->model('Service_agent');
            $result = $this->Service_agent->add_applicant_agency($user_id, $client_ids);
        }

        $user_id  = 119;
        $job_id = 83553;
        $this->load->model('Logic_applicant_job');
        $this->Logic_applicant_job->add_applicant_job([$user_id, $job_id, date('Y-m-d'), 0]);

    }

    public function mail_yamamoto_test () {
        $this->load->model('Service_email');
        $name = 'yamamoto';
        $email = 'jazttijaztti@yahoo.co.jp';
        $param = array('name' => $name , 'to' => $email);
        $this->Service_email->test_2user($param);
        echo "when you access ths action, i get one email";
        exit;

    }


    public function copy_image(){
        $url = 'https://s3-ap-northeast-1.amazonaws.com/hoiku-fine-s3-development/upload/job/115648_job_photo_1_1432091662.jpg';
        $this->load->model('Service_image');
        $fp = $this->Service_image->s3UrlToFileHandle($url);
        $upload = $this->Service_image->uploadImageDataToS3($fp,'00000',0,'1');
        var_dump($upload);
    }
    public function sign_up()
    {

        $param = array('pref' => '東京' ,'city'=>'中野');
        $tdk   = get_tdk('sign_up',$param);
        /*
        $tdk['title'] = 'タイトル';
        $tdk['description'] = 'disdis';
        $tdk['keyword'] = 'a,s,d,f,g,h';
        $tdk['author'] = 'FINE';
        */
/*
        //パンくず　動的部分なしの場合
        $bc_param = array('sign_up_current');
        $this->_bread_crumb['base_url'] = 'http://http://hoiku-yuya_yamamoto.fine.me/';
        $this->_bread_crumb['content'] = get_static_breadcrumb($bc_param);
*/

	//パンくず動的部分ありの場合
	//リンクをつけなくないセグメントには_currentをつけて返してください
	$param = array('pref','city','job_current');
	$bc_element['pref_id']   = '13';
	$bc_element['pref_name'] = 'あざらし県';
	$bc_element['city_id']   = '10' ;
	$bc_element['city_name'] = 'あざらし区';
        $bc_element['job_title'] = 'あざらっこ農園で健康な食材を購入しています';
        $bc_element['job_id']    = '1';

        $this->_bread_crumb['base_url'] = 'http://http://hoiku-yuya_yamamoto.fine.me/'; //これは実際はconfigなのでsampleだけ設定しています.
	$this->_bread_crumb['content'] = get_breadcrumb('job_detail',$bc_element);

        $this->smarty->assign('breadcrumb' , $this->_bread_crumb);
        $this->smarty->assign('tdk_array' , $tdk);
        $this->smarty->display($this->template_path()."/sample/sign_up.html");
    }

    public function ajax_sign_up()
    {

        $name = $this->input->post('name', TRUE);
        $email = $this->input->post('email', TRUE);
        $password = $this->input->post('password', TRUE);
        $photo_file = $_FILES["photo"];

        $this->load->model('Service_image');
        $result = $this->Service_image->uploadToS3($photo_file, 1, 0, 'test');

        if($result) {
          $this->load->helper('image');
          $photo_url = getImageFromS3(1, 0, 'test')['path'];
        } else {
          $photo_url = '';
        }

        $this->load->model('Service_email');


        $result = $this->Service_email->test(array('to' => $email, 'name' => $name));
        if($result === true) {
          $mail_sent = true;
        } else {
          $mail_sent = $result;
        }

        $data = array(
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'photo_file' => $photo_file,
            'photo_url' => $photo_url,
            'mail_sent' => $mail_sent
        );

        header('Content-Type: application/json');
        echo json_encode($data, JSON_PRETTY_PRINT);
    }

}
