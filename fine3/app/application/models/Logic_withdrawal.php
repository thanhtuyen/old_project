<?php
Class Logic_withdrawal extends MY_Model{
    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * withdrawal
     * 
     * @param   integer  $user_id  
     * @param   array    $data     [reason,message]
     * 
     * @return  boolean
     */
    public function withdrawal($user_id, $data)
    {
        $result = false;
        
        $arr = array();
        $created = date('Y-m-d H:i:s');
        $sql = "INSERT INTO withdrawal (user_id, reason, message, status, created, delete_flg) VALUES ";
        $reason = "";
        foreach ((array)$data['reason'] as $key => $reasons){
            $reason .= $reasons ;
        }

        $sql .= " ('$user_id', '".$reason."', '".$data['message']."', '1', '$created', '0') ";
        $result = $this->db->query($sql);
        
        if ($result){
            $salt = time().'_';
            $sql = "UPDATE user
            SET delete_flg = '1', updated = '$created'
            WHERE user_id = '$user_id'
            ";
        
            $result = $this->db->query($sql);
        }
        
        return $result;
    }

}
