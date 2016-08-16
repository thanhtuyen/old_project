<?php
Class Service_welcome extends MY_Model{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_welcome_message()
    {
      $message = 'welcome_message';
      return $message;
    }
}
?>
