<?php

class Logic_contact extends MY_Model
{

    private $table = 'contact';

    public function __construct()
    {
        parent::__construct();

        if (empty($this->db)) {
            $this->load->database();
        }
    }

    public function create_info_mail($data){
	foreach($data['to'] as $val){
	    $date = date('Y-m-d H:i:s');
	    $query_param = array($data['account_type'], $data['title'], $data['content'], $val, $date, $date);
            $sql = <<<EOF
                INSERT INTO `contact`
		(`account_id`,`type`,`name`,`company_name`,`title`,`content`,`email`,`status`,`created`,`updated`,`delete_flg`)
		VALUES
		('',?,'admin','',?,?,?,0,?,?,0)
EOF;
	    $result[] = $this->db->query($sql, $query_param);
//var_dump($result);exit;
	}
//var_dump($result);exit;
	return $result;
    }

    /**
     * Create contact
     *
     * @since 15/4/14
     * @param $data array
     * @return false/int id
     *
     */
    public function create($data = [])
    {
        if (empty($data)) {
            return false;
        }

        $columns = parseColumns($data);

        $values = parseValues($data);

        $sql = sprintf('INSERT INTO `%s` %s %s', $this->table, $columns, $values);

        $result = $this->db->query($sql);

        if (! $result) {
            return false;
        }
        return $this->db->insert_id();
    }


    /**
     * [get contact list]
     * @param  [string] $condition
     * @param  [array] $param
     * @return [array]
     */
    public function get_contact_list($condition, $param)
    {
        $delete_flg = $param['delete_flg'];

        $query_param = array($delete_flg);

        $sql = <<<EOF
            SELECT *
            FROM `contact`
            WHERE `delete_flg` = ?
EOF;

	$type = implode(', ', $condition['type']);
        $sql .= ' AND `type` IN(' . $type . ')';

        if (! empty($condition['keyword'])) {
            $sql .= <<<EOF
             AND ( `title` LIKE ?
	           OR `content` LIKE ?
	           OR `created` LIKE ?)
EOF;
            $keyword = "%{$condition['keyword']}%";
            array_push($query_param, $keyword, $keyword, $keyword);
        }

        $sql .= <<<EOF
        LIMIT {$param['offset']}, {$param['limit']}
EOF;

        $query = $this->db->query($sql, $query_param);
//var_dump($sql);exit;

        return $query->result_array();
    }

    /*
     * display contact's detail in admin side
     * @author Aya
     * @param  [array] $param
     * @return [array]        array(id=>'test')
     */
    public function get_detail($param){
        $contact_id = $param['contact_id'];
        $delete_flg = $param['delete_flg'];

        $sql = <<<EOF
            SELECT *
            FROM `contact`
            WHERE `delete_flg` = ?
            AND `contact_id` = ?
EOF;

        $query = $this->db->query($sql, array($delete_flg, $contact_id));
        return $query->row_array();

    }

    /**
     * return total count
     * @param  [array] $condition
     * @return [int]
     */
    public function get_total_count($condition)
    {
        $delete_flg = $this->config->item('not_deleted','common_config');
        $query_param = array($delete_flg);
        $sql = <<<EOF
            SELECT count('*') AS total
            FROM `contact`
            WHERE `delete_flg` = ?
EOF;
	if(! empty($condition['type'])){
	    $type = implode(', ', $condition['type']);
	    $sql .= ' AND `type` IN(' . $type . ')';
	}

        if (! empty($condition['keyword'])) {
	    $sql .= <<<EOF
             AND ( `title` LIKE ?
                   OR `content` LIKE ?
                   OR `created` LIKE ?)
EOF;
            $keyword = "%{$condition['keyword']}%";
            array_push($query_param, $keyword, $keyword, $keyword);
        }

        $query = $this->db->query($sql, $query_param);
        return $query->row_array()['total'];

    }

    public function update_status($param){
	$status = (isset($param['status'])) ? '`status` = ' . $param['status'] : '`status` = 0';
	$sql = 'UPDATE contact SET ' . $status . ' WHERE `contact_id` = ' . $param['contact_id'];
	$result = $this->db->query($sql);
	return $result;
    }
}
