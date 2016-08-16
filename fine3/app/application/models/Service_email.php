<?php
Class Service_email extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }


    /**
     * @param array['to']         send to address
     * @param array['cc']         cc
     * @param array['subject']    email subject
     * @param array['message']    email message
     * @param array['from']       email from who
     * @param array['from_name']  email from who's name
     *@return  bool
     *
     */
    protected function sendMail($array)
    {
        $this->config->load('email', true);
        $config = $this->config->item('email');
        $this->config->load('admin', true);
        $admin_config  = $this->config->item('admin');
        $to        = $array['to'];
        $subject   = $array['subject'];
        $message   = $array['message'];

        if (isset($array['mailtype'])) {
          $config['mailtype'] = $array['mailtype'];
        }

        if($config['mailtype'] == 'html'){
            $config['charset'] = 'iso-2022-jp';
            $message = mb_convert_encoding($message,'iso-2022-jp',"auto");
        }else{
            $config['charset'] = 'UTF-8';
            $message = mb_convert_encoding($message,'UTF-8',"auto");
        }


        $this->load->library('email', $config);

        $this->email->to($to);

        $from = $admin_config['email'];
        $from_name = 'FINE';
        if (isset($array['from'])) {
            $from = $array['from'];
        }
        if (isset($array['from_name'])) {
            $from = $array['from_name'];
        }
        $this->email->from($from, $from_name);

        $cc = isset($array['cc']) ? $array['cc'] : '';
        if ($cc) {
            $this->email->cc($cc);
        }

        //
        // pre delete
        //
        // mb_language("uni");
        // mb_internal_encoding("utf-8");
        // $subject = mb_convert_encoding($subject, 'utf-8', mb_detect_encoding($subject));
        // $subject = mb_encode_mimeheader($subject, 'iso-2022-jp');

        $this->email->subject($subject);
        $this->email->message($message);

        // writeLog($message);

        if ($this->email->send()){
            return true;
        } else {
            // writeLog($this->email->print_debugger());
            return false;
        }
    }

    public function __call ($func ,$args) {

        $this->config->load('admin', true);
        $admin_config  = $this->config->item('admin');

        $args = $args[0];
        //config/email.php  setting
        $email_setting = $this->_set_config_email($func);

        //get subject of this mail
        $subject       = '【FINE!】' . $email_setting['subject'];

        //make array to assing template
        $assing_array  = $this->_tips($email_setting['tipps'],$args);
        $assing_array['admin_login_url'] = $admin_config['admin_login_url'];
        $assing_array['base_url'] = $this->config->config["base_url"];
        //admin case
        $res = $this->_check_adminmail($func, $args);

        $to = $res['to'];

        //get template
        $message = $this->_getBodyFromTemplete($email_setting['mail_template_path'], $assing_array);
        //send email
        return $this->sendMail(array(
            'to' => $to,
            'subject' => $subject,
            'message' => $message
        ));

   }

    /*
     * @$args
     * @return : if funcname include _admin , we send email to admin email
     */
    private function _check_adminmail($func , $args) {

        if(strpos($func, 'admin')){
            $this->config->load('admin', true);
            $admin_config  = $this->config->item('admin');
            $args['to'] = $admin_config['email'];
        }else{
            if(empty($args['to'])&&!empty($args['mail'])){
                $args['to'] = $args['mail'];
            }
        }
        return $args;
    }

    /*
     * @$tips  false or tipps name
     * @return array  .  this array is assing to template
     */
    private function _tips($tipps , $args) {
        if ($tipps == "false" || $tipps == false) {
              return $args;
        }
        // config/email.phpのtippsに自由に値を入力して好きに追加して。
    }

    /**
     * @param template_name  html template 's file name
     * @param $data          data
     * @return string
     */
    protected function _getBodyFromTemplete($templete_name, $data)
    {
        $html = $this->load->view('html_mail/' . $templete_name . '.html', $data, TRUE);

        return $html;
    }




    /*
     * @param  func name(string)
     * @return array
     *           subject
     *           to
     *           tipps
     */
    private function _set_config_email($func) {
        $this->config->load('email', true);
        $config  = $this->config->item('email');
        $ret     = $email_setting = $config[$func];
        //関数名がそのままテンプレート名になっている
        $ret['mail_template_path'] = $func;
        return $ret ;
    }


    public function scout($data){
        return $this->sendMail($data);
    }


}
