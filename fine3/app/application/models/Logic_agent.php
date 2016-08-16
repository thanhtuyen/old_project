<?php
require_once 'ReadTrait.php';
require_once 'CreateTrait.php';
require_once 'UpdateTrait.php';

class Logic_agent extends MY_Model
{

    // use CreateTrait;

    // use ReadTrait;

    // use UpdateTrait;


    public $table = 'career_adviser';

    const DELETE_FLG_FALSE = 0;

    const DELETE_FLG = 1;

    const STATUS_PUBLIC = 0;

    const STATUS_PRIVATE = 1;

    public function __construct()
    {
        parent::__construct();
    }
    /**
     *  get_career_adviser list
     * @param  [type] $param [description]
     * @return [type]        [description]
     */
    public function get_count($param)
    {
        $delete_flg = $param['delete_flg'];
        $client_id = $param['client_id'];
        $sql = "SELECT COUNT(1) AS `count_agent`
FROM `career_adviser`
JOIN `image` ON `career_adviser`.`career_adviser_id` = `image`.`account_id`
WHERE `career_adviser`.`delete_flg` = ".$delete_flg."
AND `career_adviser`.`client_id` = ".$client_id."
AND `image`.`delete_flg` = ".$delete_flg;

        return $this->db->query($sql)->result_array();
    }
    /**
     *  get_career_adviser info
     * @param  [type] $param [description]
     * @return [type]        [description]
     */
    public function get_detail($param)
    {
        $delete_flg = $param['delete_flg'];
        $career_adviser_id = $param['career_adviser_id'];
        $sql = "SELECT *
                FROM `career_adviser`
                WHERE `career_adviser`.`delete_flg` = ".$delete_flg."
                AND `career_adviser`.`career_adviser_id` = ".$career_adviser_id;

        return $this->db->query($sql)->result_array();
    }
    /**
     *  get_career_adviser list
     * @param  [type] $param [description]
     * @return [type]        [description]
     */
    public function get_own_list($param)
    {
        $delete_flg = $param['delete_flg'];
        $client_id = $param['client_id'];
        $type = $param['type'];
        $offset = $param['limit_from'];
        $limit = $param['offset'];

        // $query_param = array($type, $client_id, $delete_flg, $client_id, $offset, $limit);
        // $query_param = array($delete_flg, $client_id, $status, $limit);

        $select = '`career_adviser`.*, `image`.`name` as file_name, `client`.`name` as agent_name, `client`.`client_id`';

        $sql = "SELECT ".$select."
FROM `career_adviser`
LEFT JOIN `image`
ON `career_adviser`.`career_adviser_id` = `image`.`account_id`
AND `image`.`type` = ".$type."
JOIN `client`
ON `client`.`client_id` = ".$client_id."
WHERE `career_adviser`.`delete_flg` = ".$delete_flg."
AND `career_adviser`.`client_id` = ".$client_id."
AND `image`.`delete_flg` = ".$delete_flg."
ORDER BY `career_adviser`.`updated` DESC
LIMIT ".$limit."
OFFSET ".$offset;
     $result = $this->db->query($sql)->result_array();
return $result;
    }
    /**
     *  get_career_adviser list
     * @param  [type] $param [description]
     * @return [type]        [description]
     */
    public function get_list($param)
    {
        $delete_flg = $param['delete_flg'];
        $client_id = $param['client_id'];
        $type = $param['type'];
        $status = $param['status'];
        $limit = $param['limit'];

        $query_param = array($type, $delete_flg, $client_id, $delete_flg, $client_id, $status, $limit);
        // $query_param = array($delete_flg, $client_id, $status, $limit);

        $select = '`career_adviser`.*, `image`.`name` as file_name, `image`.`image_id`, `client`.`name` as agent_name, `client`.`client_id`';

        $sql = <<<EOF
SELECT {$select}
FROM `career_adviser`
LEFT JOIN `image`
ON `career_adviser`.`career_adviser_id` = `image`.`account_id`
AND `image`.`type` = ?
AND `image`.`delete_flg` = ?
JOIN `client`
ON `client`.`client_id` = ?
WHERE `career_adviser`.`delete_flg` = ?
AND `career_adviser`.`client_id` = ?
AND `career_adviser`.`status` = ?
LIMIT ?
EOF;
        return $this->db->query($sql, $query_param)->result_array();
    }

    public function update($param)
    {
        $career_adviser_id = $param['career_adviser_id'];
        unset($param['career_adviser_id']);
        $fields = implode(',', array_map(function($k){
                return '`'. $k .'` = ?';
            }, array_keys($param))
        );
        $query_param = array_merge(array_values($param), array($career_adviser_id));

        $sql = <<<EOF
UPDATE `career_adviser`
SET {$fields}
WHERE `career_adviser_id` = ?
EOF;

        $this->db->query($sql, $query_param);

        return (bool) $this->db->affected_rows();
    }


    public function create($param)
    {
        unset($param['career_adviser_id']);
        $fields = implode(',', array_map(function($k){
                return '`'. $k .'` = ?';
            }, array_keys($param))
        );

        $sql = <<<EOF
INSERT `career_adviser`
SET {$fields}
EOF;

        $this->db->query($sql, $param);

        return $this->db->insert_id();
    }
    public function update_agent_info($param)
    {
        $career_adviser_id = $param['career_adviser_id'];
        $set_data = array_to_update($param['info']);
        $sql = "UPDATE `career_adviser`
                    SET ".$set_data."
                    WHERE `career_adviser_id` = ".$career_adviser_id;

        $this->db->query($sql);
        return (bool) $this->db->affected_rows();
    }

    public function delete_flg($param)
    {
        $career_adviser_id = $param['career_adviser_id'];
        unset($param['career_adviser_id']);
        $fields = implode(',', array_map(function($k){
                return '`'. $k .'` = ?';
            }, array_keys($param))
        );
        $query_param = array_merge(array_values($param), array($career_adviser_id));

        $sql = <<<EOF
UPDATE `career_adviser`
SET {$fields}
WHERE `career_adviser_id` = ?
EOF;

        $this->db->query($sql, $query_param);

        return (bool) $this->db->affected_rows();
    }

    /*
     * meaning get career adviser list
     * return: $array
     * meaning get career adviser list

    public function get_list($param)
    {
        $client_id = $param['client_id'];
        $status = $param['status'];
        $delete_flg = $param['delete_flg'];
        $limit = $param['limit'];
        $query_param = array(
            $client_id,
            $status,
            $delete_flg,
            $limit
        );
        $sql = "SELECT * FROM `career_adviser`
                WHERE `client_id` = ?
                AND `status`      = ?
                AND `delete_flg`  = ?
                LIMIT ?";
        $query = $this->db->query($sql, $query_param);
        $result = $query->result_array();
        return $result;

    }*/

    public function get_display_list($client_id, $limit, $offset)
    {
        $this->db->select([
            'career_adviser_id',
            'name',
            'message'
        ]);
        $this->db->from($this->table);
        $this->db->where([
            'client_id' => $client_id,
            'delete_flg' => self::DELETE_FLG_FALSE
        ]);

        $countDb = clone $this->db;

        $count = $countDb->count_all_results();

        $this->db->limit($limit);
        $this->db->offset($offset);

        $this->db->order_by(sprintf("`updated`", $this->table), "desc");

        $cas = $this->db->get()->result_array();

        $data['cas'] = [];
        $data['total'] = 0;
        if ($cas && ! empty($cas)) {
            $data['cas'] = $cas;
            $data['total'] = $count;
        }
        return $data;
    }

    public function delete($client_id, $career_adviser_id)
    {
        $where = [
            'client_id' => $client_id,
            'career_adviser_id' => $career_adviser_id,
            'delete_flg' => self::DELETE_FLG
        ];
      return   $this->update($where);
    }


    public function get_relation_area($career_adviser_id){
        $sql = "SELECT area.area_id,area.name FROM `career_adviser_area_relation`
                JOIN area ON `career_adviser_area_relation`.`area_id` = `area`.`area_id`
                WHERE `career_adviser_area_relation`.`career_adviser_id` = '".$career_adviser_id."'
                  AND `career_adviser_area_relation`.`delete_flg` = 0
                  AND `area`.`delete_flg` = 0";
        return $this->db->query($sql)->result_array();
    }


}
?>
