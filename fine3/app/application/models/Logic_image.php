<?php
require_once 'ReadTrait.php';
require_once 'CreateTrait.php';

require_once 'UpdateTrait.php';

Class Logic_image extends MY_Model{

    use ReadTrait;
    use CreateTrait;
    use UpdateTrait;

    const DELETE_FLG_FALSE = 0;

    const DELETE_FLG = 1;

    const TYPE_CAREER_ADVISER = 4;

    /**
     * @var string table Name
     */
    public $table = 'image';

    public function __construct()
    {
        parent::__construct();
    }
    /**
     * [get images from entity related function.]
     * @param $image_param    = array('account_id' => $job_param['job_id'],
     *                           'type'       => $this->config->item('job','image_config'),
     *                           'status'     => $this->config->item('vaild','image_config'),
     *                           'delete_flg' => $this->config->item('not_deleted','common_config'));
     * @return array[]
     * if you check where to show tag in the views, please use tag config and $tag['tag_group'][0]['tag_group_id'];
     */
    public function get_list($param){
        $account_id = $param['account_id'];
        $type = $param['type'];
        $delete_flg = $param['delete_flg'];

        $query_param = array($account_id,$type,$delete_flg);

        if(empty($param['select'])){
            $select = '*';
        }else{
            $select = join(',',$param['select']);
        }

        $sql = "SELECT {$select} FROM `image`
                WHERE `account_id` = ?
                AND type = ?
                AND delete_flg = ?
                ORDER BY created DESC";

        $query = $this->db->query($sql, $query_param);
        $result = $query->result_array();
        return $result;
    }

    public function get_all(){

        $sql = "SELECT * FROM `image`
                WHERE delete_flg = 0";

        $query = $this->db->query($sql);
        $result = $query->result_array();
        return $result;
    }

    public function delete_flg($param)
    {
        $delete_flg = $param['delete_flg'];
        $account_id = $param['account_id'];
        $type = $param['type'];
        $query_param = array($delete_flg, $account_id, $type);

        $sql = <<<EOF
UPDATE `image`
SET `delete_flg` = ?
WHERE `account_id` = ?
AND `type` = ?
EOF;

        $this->db->query($sql, $query_param);

        return (bool) $this->db->affected_rows();
    }

    public function save($param)
    {
        $fields = implode(',', array_map(function($k){
                return '`'. $k .'`';
            }, array_keys($param))
        );

        $query_param = array_values($param);
        $bind_str = rtrim(str_repeat('?, ', count($query_param)), ', ');

        $sql = <<<EOF
INSERT INTO `image` ({$fields})
VALUES ({$bind_str})
EOF;

        $this->db->query($sql, $query_param);
        return (bool) $this->db->insert_id();
    }

    public function save_batch($param)
    {
        $account_id = $param['account_id'];
        $names = $param['name'];
        $ordereds = $param['ordered'];
        $type = $param['type'];
        $created = $param['created'];

        $query_param = call_user_func_array('array_merge', array_map(
            function($name, $ordered) use($account_id, $type, $created){
                return array((int) $account_id, $name, $type, $ordered);
            }, $names, $ordereds)
        );

        $bind_str = rtrim(str_repeat('(?, ?, ?, ?),', count($query_param) / 4), ', ');

        $sql = <<<EOF
INSERT INTO `image` (`account_id`, `name`, `type`, `ordered`)
VALUES {$bind_str}
EOF;


        $this->db->query($sql, $query_param);
        return (bool) $this->db->insert_id();
    }

    public function delete_batch($param)
    {
        $delete_flg = $param['delete_flg'];
        $account_id = $param['account_id'];
        $type = $param['type'];
        $ordered = $param['ordered'];
        $query_param = array($delete_flg, $ordered, $account_id, $type);

        $sql = <<<EOF
UPDATE `image`
SET `delete_flg` = ?
WHERE `ordered` IN ?
AND `account_id` = ?
AND `type` = ?
EOF;

        $this->db->query($sql, $query_param);

        return (bool) $this->db->affected_rows();
    }

    /**
     * get image name
     */
    public function get_image_name($param)
    {
        $account_id = $param['account_id'];
        $type = $param['type'];
        $delete_flg = $param['delete_flg'];
        $query_param = array($account_id, $delete_flg, $type,);

        $sql = <<<SQL
SELECT * FROM `image`
WHERE `account_id` = ?
AND delete_flg = ?
AND type = ?
SQL;
        return $this->db->query($sql, $query_param)->row_array()['name'];

    }





    /**
     * insert into image
     * @param $params    = array('account_id' => xx,
     *                           'name'       => xx,
     *                           'type'     => xx,
     *                           'created' => xx
     */
    public function insert_image($params)
    {
        $query_params = array($params['account_id'], $params['name'], $params['type'], $params['ordered'], $params['created']);
        $sql = "INSERT INTO image(account_id, name, type, ordered, created) VALUES(?, ?, ?, ?, ?)";
        $this->db->query($sql, $query_params);
    }

    /**
     * insert into image
     * @param $params delete_flg
     * @param $params image_id
     */
    public function update_image_to_delete($image_id, $delete_flg)
    {
        $sql = "UPDATE image SET delete_flg = $delete_flg WHERE image_id = $image_id";
        $this->db->query($sql);
    }

    public function delete_image($account_id, $type)
    {
        $sql = "DELETE from image WHERE account_id = $account_id AND type = $type";
        $this->db->query($sql);
    }

    public function update_ordered($account_id, $type, $count)
    {
        $sql = "UPDATE image SET ordered = $count WHERE account_id = $account_id AND type = $type";
        $this->db->query($sql);
    }

    public function update_name($account_id, $type, $name)
    {
        $sql = "UPDATE image SET name = '$name' WHERE account_id = $account_id AND type = $type";
        $this->db->query($sql);
    }
}
?>
