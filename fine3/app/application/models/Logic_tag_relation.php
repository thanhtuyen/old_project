<?php

Class Logic_tag_relation extends MY_Model
{
    const TYPE_RELATION_USER = 0;
    const TYPE_RELATION_JOB = 1;
    const TYPE_RELATION_NURSERY = 2;
    const TYPE_RELATION_CLIENT = 3;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     *
     * @param array $params["tag_ids"]     : array("tag_id_1","tag_id_2",...)
     *                     ["account_id"] : int  ralate account_id
     *                     ["type"]       : int  refer to tag_group
     */
    public function regist_tag_relation($params){

        $date = "'".date("Y-m-d H:i:s",time())."'";
        $inserts = "";
        foreach($params["tag_ids"] as $tag){
            $inserts .= "(".$tag.",".$params["account_id"].",".$params["type"].",".$date."),";
        }

        $sql = "INSERT INTO `tag_relation` (tag_id,account_id,type,created) VALUES ".rtrim($inserts,",");

        return $this->db->query($sql);

    }

    /**
     * get all tags by conditions in $params
     *
     * @param   array  $params
     *
     * @return  array
     */
    public function getTags($params)
    {
        $sql = "SELECT t.*,tg.*,tg.name AS tag_group_name, t.name AS name
                FROM tag_relation as tr
                INNER JOIN tag as t ON t.tag_id = tr.tag_id
                INNER JOIN tag_group as tg ON tg.tag_group_id = t.tag_group_id
                WHERE tr.type = '".$params['type']."'
                    AND tr.account_id = '".$params['account_id']."'
                    AND t.tag_group_id = '".$params['tag_group_id']."'
                    AND t.delete_flg = '0'
            ";

        $data = $this->db->query($sql)->result_array();

        return $data;
    }

    public function get_tag_list($params)
    {
        $sql = "SELECT t.*
                FROM tag_relation as tr
                INNER JOIN tag as t ON t.tag_id = tr.tag_id
                WHERE tr.type = '".$params['type']."'
                AND tr.account_id = '".$params['account_id']."'
                AND tr.delete_flg = '0'
                AND t.delete_flg = '0'
            ";

        $data = $this->db->query($sql)->result_array();

        return $data;
    }

    /**
     * user register: job type , certifications , province, city
     *
     * @param integer $user_id
     * @param array $tags
     *
     * @return boolean
     */
    public function saveTagRelationUser($user_id, $tags)
    {
        $result = false;
         $type = self::TYPE_RELATION_USER;

        //delete
        $sql = "DELETE FROM tag_relation
                WHERE account_id = ?
                    AND type = ? ";

        $this->db->query($sql, array($user_id, $type));



        // insert tags
        $created = date('Y-m-d H:i:s');

        $queryString = array();
        $sql = "INSERT INTO `tag_relation` ( `tag_id`, `account_id`, `type`, `created`, `delete_flg`) VALUES ";


        foreach ((array)$tags as $tag_id)
        {
            $queryString[] = "('$tag_id', '$user_id' , '$type' , '$created' , '0')";
        }

        if ($queryString){
            $sql = $sql . ' ' . implode(", ", $queryString);
        }


        $result = $this->db->query($sql);

        return $result;
    }

    public function get_tag_relation($account_id, $type, $tag_group = false)
    {
        $tag_group_where = "";
        if($tag_group !== false){
            $tag_group_where = "tag.tag_group_id IN (".implode(",",$tag_group).") AND";
        }

        $sql = "SELECT * FROM tag_relation
                JOIN tag ON tag_relation.tag_id = tag.tag_id
                WHERE {$tag_group_where} tag_relation.account_id = $account_id AND tag_relation.type = $type";

        return $this->db->query($sql)->result_array();
    }

    public function delete_tag_relation($account_id, $type)
    {
        $sql = "DELETE FROM tag_relation
                WHERE account_id = $account_id AND type = $type";
        return $this->db->query($sql);
    }
}
