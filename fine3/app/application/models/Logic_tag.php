<?php
require_once 'ReadTrait.php';

Class Logic_tag extends MY_Model{
    use ReadTrait;

    const DELETE_FLG_FALSE = 0;

    const TAG_GROUP_ID_EMPLOY = 3;

    const TAG_GROUP_ID_LICENSE = 4;

    const TAG_RELATION_TYPE_USER = 0;

    const TAG_RELATION_DELETE_FLG_FALSE = 0;

    /**
     * @var string table Name
     */
    public $table = 'tag';

    public $table_tag_relation = 'tag_relation';

    public function __construct()
    {
        parent::__construct();
    }

    public function get_display($param, $select){
        $select_str = implode(',',$select['tag_relation']).",".implode(',',$select['tag']).",".implode(',',$select['tag_group']);
        $sql = "SELECT ".$select_str." 
                    FROM tag_relation 
                    INNER JOIN tag ON tag_relation.tag_id = tag.tag_id
                    INNER JOIN tag_group ON tag.tag_group_id = tag_group.tag_group_id
                    WHERE tag_relation.account_id = ".$param['id']."
                    AND tag_relation.type = ".$param['type']."
                    AND tag_relation.delete_flg = ".$param['delete_flg']."
                    AND tag.delete_flg = 0
                    AND tag_group.delete_flg = 0";
        $query       = $this->db->query($sql);
        $result      = $query->result_array();

        return $result;
    }
    public function get_list_char($name,$prefix){
        $sql         = "SELECT `tag`.`tag_id`,`tag_group`.`description`
                        FROM `tag`
                        INNER JOIN `tag_group`
                        ON `tag`.`tag_group_id`=`tag_group`.`tag_group_id`
                        WHERE `tag`.`link_name` LIKE '".$name."'
                        AND `tag_group`.`prefix` LIKE '".$prefix."'";
        $query       = $this->db->query($sql);
        $result      = $query->result_array();
        return $result;
    }
    public function get_detail($param){
        $tag_id = $param['tag_id'];
        $delete_flg = $param['delete_flg'];
        $query_param = array($tag_id,$delete_flg);
        $sql = "SELECT * FROM `tag`
                WHERE `tag_id` = ?
                AND `delete_flg` = ?";
        $query = $this->db->query($sql, $query_param);
        $result      = $query->result_array();
        return $result;
    }

    public function get_group_detail($param){
        $tag_group_id = $param['tag_group_id'];
        $delete_flg = $param['delete_flg'];
        $query_param = array($tag_group_id,$delete_flg);
        $sql = "SELECT * FROM `tag_group`
                WHERE `tag_group_id` = ?
                AND `delete_flg` = ?";
        $query = $this->db->query($sql, $query_param);
        $result      = $query->result_array();
        return $result;
    }

    /*
    param['id'] -> account_id
    return: array
    meaning get  relation array
    */
    public function get_relation_list($param){
        $id          = $param['id'];
        $type        = $param['type'];
        $delete_flg  = $param['delete_flg'];
        $sql         = "SELECT * FROM `tag_relation`
                        WHERE `account_id` = ".$id."
                        AND `type` = ".$type."
                        AND `delete_flg` = ".$delete_flg;

        $query       = $this->db->query($sql);
        $result      = $query->result_array();
        return $result;
    }

    /**
     * [get tag group ]
     * @param  [array] $param
     * @return [array]
     */
    public function get_tag_group($param)
    {
        $delete_flg  = $param['delete_flg'];
        $sql = <<<EOF
        SELECT * FROM `tag_group`
        WHERE `delete_flg` = ?
EOF;
        return $this->db->query($sql, array($delete_flg))->result_array();
    }

    public function get_tag_group_detail($param)
    {
        $tag_group_id = $param['tag_group_id'];
        $delete_flg = $param['delete_flg'];
        $query_param = array($tag_group_id,$delete_flg);
        $sql = <<<SQL
            SELECT * FROM `tag_group`
            WHERE `tag_group_id` = ?
            AND `delete_flg` = ?
SQL;
        return $this->db->query($sql, $query_param)->row_array();

    }

    public function get_list($param)
    {
        $delete_flg  = $param['delete_flg'];
        $group_id = $param['group_id'];
        $sql = <<<EOF
        SELECT * FROM `tag`
        WHERE `delete_flg` = ?
        AND  `tag_group_id` IN ?
EOF;
	$result = $this->db->query($sql, array($delete_flg, $group_id))->result_array();
        return $result;
    }

    /**
     * save tag_group
     * @param  [array] $param [name, ordered]
     * @return [bool]
     */
    public function save_tag_group($param)
    {
        $sql = <<<SQL
            INSERT INTO `tag_group` (`name`, `description`, `ordered`)
            VALUES (?, ?, ?)
SQL;

         $this->db->query($sql, array($param['name'], $param['description'], $param['ordered']));
         return (bool) $this->db->insert_id();
    }

    /**
     * save tag
     * @param  [array] $param [name, ordered...]
     * @return [bool]
     */
    public function save($param)
    {
        $sql = <<<SQL
        INSERT INTO `tag` (`tag_group_id`, `name`, `description`, `ordered`)
        VALUES (?, ?, ?, ?)
SQL;

         $this->db->query($sql, $param);
         return (bool) $this->db->insert_id();
    }

    /**
     * [delete the group tag by id]
     * @param  [array] $param
     * @return [bool]
     */
    public function delete_for_tag_group($param)
    {
        $tag_group_id = $param['tag_group_id'];
        $delete_flg = $param['delete_flg'];
        $sql = <<<EOF
            UPDATE `tag_group`
            SET `delete_flg` = ?
            WHERE `tag_group_id` = ?
EOF;

        $this->db->query($sql, array($delete_flg, $tag_group_id));

        return (bool) $this->db->affected_rows();


    }
    /**
     * update tag_group info
     * @param  [type] $param [description]
     * @return [type]        [description]
     */
    public function update_for_tag_group($param)
    {

        $tag_group_id = $param['tag_group_id'];
        $name = $param['name'];
        $ordered = $param['ordered'];
        $description = $param['description'];
        $sql = <<<EOF
                UPDATE `tag_group`
                SET `name` = ? ,
                `description` = ?,
                `ordered` = ?
                WHERE `tag_group_id` = ?
EOF;
        $this->db->query($sql, array($name, $description, $ordered, $tag_group_id));

        return (bool) $this->db->affected_rows();

    }
    /**
     * update tag info
     * @param  [array] $param
     * @return [bool]
     */
    public function update($param)
    {

        $sql = <<<EOF
                UPDATE `tag`
                SET `tag_group_id` =?,
                `name` = ? ,
                `description` = ?,
                `ordered` = ?
                WHERE `tag_id` = ?
EOF;
        $this->db->query($sql, $param);

        return (bool) $this->db->affected_rows();

    }

    /**
     * [delete the tag by id]
     * @param  [array] $param
     * @return [bool]
     */
    public function delete_flg($param)
    {
        $tag_id = $param['tag_id'];
        $delete_flg = $param['delete_flg'];
        $updated = $param['updated'];

        $sql = <<<EOF
            UPDATE `tag`
            SET `delete_flg` = ?
            WHERE `tag_id` = ?
EOF;

        $this->db->query($sql, array($delete_flg, $tag_id));
        return (bool) $this->db->affected_rows();
    }
    /**
     * [delete_batch the tag or tag_group ]
     * @param  [array] $param
     * @return [bool]
     */
    public function batch_delete_group($group)
    {
        $where = '';
        $group_id = array();
        foreach ($group as $value) {
            $where .= 'WHEN `tag_group_id` = ' . $value['tag_group_id']. ' THEN 1 ';
            $group_id[] = $value['tag_group_id'];
        }

        $sql = <<<EOF
        UPDATE `tag_group`
        SET `delete_flg` = CASE
        {$where}
        ELSE `delete_flg` END WHERE `tag_group_id` IN ?
EOF;
        $this->db->query($sql, array($group_id));
        return (bool) $this->db->affected_rows();
    }

        /**
         * [delete_batch the tags]
         * @param  [array] $param
         * @return [bool]
         */
        public function batch_delete_tag($tag)
        {
            $where = '';
            $tag_id = array();
            foreach ($tag as $value) {
                $where .= 'WHEN `tag_id` = ' . $value['tag_id']. ' THEN 1 ';
                $tag_id[] = $value['tag_id'];
            }
            $sql = <<<EOF
            UPDATE `tag`
            SET `delete_flg` = CASE
            {$where}
            ELSE `delete_flg` END WHERE `tag_id` IN ?
EOF;
            $this->db->query($sql, array($tag_id));
            return (bool) $this->db->affected_rows();
        }

        /**
         * get user tag by tag_id
         * @param  [int] $user_id
         * @param  [int] $tag_id
         * @return [bool]
         */
        public function is_user_have_tag($user_id, $tag_id)
        {
            $query_param = array(
                $user_id,
                $tag_id,
                $this->config->item('not_deleted', 'common_config')
            );
            $sql         = "SELECT COUNT(*) AS num FROM `tag_relation`
                            WHERE `account_id` = ?
                            AND `tag_id` = ?
                            AND `delete_flg` = ?";
            $query       = $this->db->query($sql, $query_param);
            $result      = $query->row_array();
            return $result['num'] > 0;
        }



        public function get_occupation_list($param)
        {
            $query_param = array(
                $param['tag_group_id'],
                $param['delete_flg'],
                $param['delete_flg'],
            );
            $sql = <<<SQL
SELECT `tag`.`tag_id`, `tag`.`name`, `tag_group`.`tag_group_id`
FROM `tag`
JOIN `tag_group` ON `tag_group`.`tag_group_id` = `tag`.`tag_group_id`
AND `tag_group`.`tag_group_id` = ?
WHERE `tag_group`.`delete_flg` = ?
AND `tag`.`delete_flg` = ?
SQL;
            return $this->db->query($sql, $query_param)->result_array();
        }




    public function get_tag_by_group_id($tag_group_id, $delete_flg = 0){
        $sql = "SELECT * FROM `tag`
                WHERE `tag_group_id` IN (".$tag_group_id.")
                AND `delete_flg` = $delete_flg";
        return $this->db->query($sql)->result_array();
    }


    /**
    * get tag by tag group
    * @param  [array] [tag_group_id, delete_flg]
    * @return [array]
    */
    public function get_tag_by_tag_group($param)
    {
        $tag_group_id = $param['tag_group_id'];
        $delete_flg = $param['delete_flg'];
        $query_param = array($tag_group_id, $delete_flg);
        $sql = "SELECT * FROM `tag`
                WHERE `tag_group_id` = ?
                AND `delete_flg` = ?
                ";
        return $this->db->query($sql, $query_param)->result_array();
    }
    public function get_tag_job_list(){
        $sql = "SELECT
    `tag_group`.`tag_group_id`,
    `tag_group`.`name` AS `tag_group_name`,
    `tag`.`name`,`tag`.`link_name`,
    `tag_group`.`prefix`,
    COUNT(DISTINCT(`job_id`)) AS `job_total`
 FROM
    `tag_relation`
INNER JOIN `tag` ON `tag_relation`.`tag_id`=`tag`.`tag_id`
INNER JOIN `tag_group` ON `tag_group`.`tag_group_id`=`tag`.`tag_group_id`
INNER JOIN `job` ON `tag_relation`.`account_id` = `job`.`job_id`
INNER JOIN `nursery` ON `job`.`nursery_id` = `nursery`.`nursery_id`
INNER JOIN `client` ON `nursery`.`client_id` = `client`.`client_id`
WHERE `job`.`delete_flg` = 0
AND `job`.`status` = 1
AND `nursery`.`status` = 0
AND `nursery`.`delete_flg` = 0
AND `client`.`status` = 0
AND `client`.`delete_flg` = 0
AND (
        `tag_relation`.`tag_id` IN (
            SELECT DISTINCT `tag_relation`.`tag_id` FROM `tag_relation`
            LEFT JOIN `job` ON `tag_relation`.`account_id`=`job`.`job_id`
            WHERE `job`.`status` = 1
            AND `job`.`delete_flg` = 0
            AND `tag_relation`.type = 2
        )
        OR `tag_relation`.`tag_id` IN (
            SELECT DISTINCT `tag_relation`.`tag_id` FROM `tag_relation`
            LEFT JOIN `nursery` ON `tag_relation`.`account_id`=`nursery`.`nursery_id`
            INNER JOIN `job` ON `nursery`.`nursery_id`=`job`.`nursery_id`
            WHERE `nursery`.`status` = 0
            AND `nursery`.`delete_flg` = 0
            AND `job`.`status` = 1
            AND `job`.`delete_flg` = 0
            AND `tag_relation`.type = 1
        )
    )
GROUP BY `tag_relation`.`tag_id`";
        $result =  $this->db->query($sql)->result_array();
        return $result;
    }
public function get_all_tag(){
        $sql = "SELECT `tag_group`.`tag_group_id`,`tag_group`.`name` AS `tag_group_name`,`tag`.`name`,`tag`.`link_name`,`tag_group`.`prefix`
                    FROM `tag`
                    LEFT JOIN `tag_group` ON `tag_group`.`tag_group_id`=`tag`.`tag_group_id`";
        $result =  $this->db->query($sql)->result_array();
        return $result;
    }

    public function get_relation_by_job($param){
       extract($param);

        $sql         = "SELECT tag_relation.type, tag_relation.tag_id  FROM `tag_relation`
                        LEFT JOIN `tag` ON `tag_relation`.`tag_id`=`tag`.`tag_id`
                        LEFT JOIN `tag_group` ON `tag_group`.`tag_group_id`=`tag`.`tag_group_id`
                        WHERE tag_relation.`account_id` = ".$id."
                        AND tag_group.`tag_group_id` = ".$tag_group_id."
                        AND tag_relation.`delete_flg` = ".$delete_flg;

        $query       = $this->db->query($sql);
        $result      = $query->result_array();
        if($result){
            return array_shift($result);
        }
        return false;
    }
}

