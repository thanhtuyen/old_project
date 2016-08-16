<?php

Class Logic_template extends MY_Model{
    const DELETE_FLG_FALSE = 0;

    const DELETE_FLG = 1;

    /**
     * @var string table Name
     */
    public $table = 'template';

    public function __construct()
    {
        parent::__construct();
    }
    public function get_list($param){
        $select      = array_to_select_str($param['select']);
        $delete_flg  = $param['delete_flg'];
        $client_id   = $param['client_id'];
        $sql         = "SELECT ".$select." FROM `template`
                        WHERE `client_id` = ".$client_id."\n
                        AND `delete_flg` = ".$delete_flg."
                        ORDER BY `created` DESC";
        $query       = $this->db->query($sql);
        $result      = $query->result_array();
        return $result;
    }
    /**
     * get single template data from template_id
     * @param  [type] $param [description]
     * @return [type]        [description]
     */
    public function get_detail($param){
        $select      = array_to_select_str($param['select']);
        $delete_flg  = $param['delete_flg'];
        $template_id = $param['template_id'];
        $sql         = "SELECT ".$select." FROM `template`
                        WHERE `template_id` = ".$template_id."\n
                        AND `delete_flg` = ".$delete_flg;
        $query       = $this->db->query($sql);
        $result      = $query->result_array();
        return $result;
    }

    public function insert($param){
        $sql         = "INSERT INTO `template`(`template_id`, `client_id`, `title`, `content`, `created`, `updated`, `delete_flg`)
                        VALUES (NULL, ".$param['client_id']." ,
                         '".html_escape($param['title'])."',
                          '".html_escape($param['content'])."',
                            '".$param['created']."',
                             '".$param['updated']."',
                              '".$param['delete_flg']."')";
        $result       = $this->db->query($sql);
        return $result;
    }
    public function update($param){
        #
        $sql         = "UPDATE `template`
                             SET `title`        =    '".html_escape($param['title'])."' ,
                                      `content` =    '".html_escape($param['content'])."'
                             WHERE `template_id` = ".$param['template_id'];
        $result    = $this->db->query($sql);
        return $result;
    }
    public function delete($param){
        $sql         = "UPDATE `template`
                             SET `delete_flg`        =    '".html_escape($param['delete_flg'])."' ,
                                      `updated`           =    '".html_escape($param['updated'])."'
                             WHERE `template_id` = ".$param['template_id']."
                             AND `client_id`          =    ".$param['client_id'];
        $result    = $this->db->query($sql);
        return $result;
    }
}
?>