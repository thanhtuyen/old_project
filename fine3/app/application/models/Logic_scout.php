<?php
// require_once 'CreateTrait.php';

class Logic_scout extends MY_Model
{
    // use CreateTrait;

    public $table = 'scout';

    public function __construct()
    {
        parent::__construct();

        if (empty($this->db)) {
            $this->load->database();
        }
    }
    public function create($param)
    {
        $sql = "INSERT `scout`
                SET `user_id` = '".$param['user_id']."',
                    `job_id` = '".$param['job_id']."',
                    `template_id` = '".$param['template_id']."',
                    `cpgr_id` = '".$param['cpgr_id']."',
                    `created` = '".$param['created']."'";
        $this->db->query($sql);

        return $this->db->insert_id();
    }
    public function get_detail($param){
        $scout_id = $param['scout_id'];

        $sql = <<<EOF
	    SELECT `s`.`scout_id`,`s`.`job_id`,`j`.`title`,`s`.`user_id`,`u`.`name` AS username,`c`.`client_id`,`c`.`name` AS companyname,`c`.`display_name`,`s`.`template_id`,`t`.`content`,`s`.`created`
            FROM ((`scout` `s` INNER JOIN `job` `j` ON `s`.`job_id` = `j`.`job_id`)
            INNER JOIN `nursery` `n` ON `j`.`nursery_id` = `n`.`nursery_id`)
            INNER JOIN `client` `c` ON `n`.`client_id` = `c`.`client_id`
            INNER JOIN `template` `t` ON `s`.`template_id` = `t`.`template_id`
            INNER JOIN `user` `u` ON `s`.`user_id` = `u`.`user_id`
	    WHERE `s`.`scout_id` = ?
EOF;

        $query = $this->db->query($sql, array($scout_id));
        return $query->row_array();

    }

    /**
     * return total count
     * @param  [array] $condition
     * @return [int]
     */
    public function get_total_count($condition)
    {
        $query_param = array();
        $sql = <<<EOF
	    SELECT count('*') AS total
	    FROM ((`scout` `s` INNER JOIN `job` `j` ON `s`.`job_id` = `j`.`job_id`)
	    INNER JOIN `nursery` `n` ON `j`.`nursery_id` = `n`.`nursery_id`)
	    INNER JOIN `client` `c` ON `n`.`client_id` = `c`.`client_id`
	    INNER JOIN `template` `t` ON `s`.`template_id` = `t`.`template_id`
	    INNER JOIN `user` `u` ON `s`.`user_id` = `u`.`user_id`
EOF;

        if (! empty($condition['keyword'])) {
            $sql .= <<<EOF
             WHERE `t`.`content` LIKE ?
		   OR `c`.`display_name` LIKE ?
		   OR `c`.`name` LIKE ?
		   OR `u`.`name` LIKE ?
EOF;
            $keyword = "%{$condition['keyword']}%";
            array_push($query_param, $keyword, $keyword, $keyword, $keyword);
        }

        $query = $this->db->query($sql, $query_param);
        return $query->row_array()['total'];

    }

    /* Get all scout list for admin side
     * @author Aya
     */
    public function get_scout_list($condition, $param)
    {
        $delete_flg = $param['delete_flg'];

        $query_param = array($delete_flg);

        $sql = <<<EOF
	    SELECT `s`.`scout_id`,`s`.`job_id`,`j`.`title`,`s`.`user_id`,`u`.`name` AS username,`c`.`client_id`,`c`.`name` AS companyname,`c`.`display_name`,`s`.`template_id`,`t`.`content`,`s`.`created`
            FROM ((`scout` `s` INNER JOIN `job` `j` ON `s`.`job_id` = `j`.`job_id`)
            INNER JOIN `nursery` `n` ON `j`.`nursery_id` = `n`.`nursery_id`)
            INNER JOIN `client` `c` ON `n`.`client_id` = `c`.`client_id`
            INNER JOIN `template` `t` ON `s`.`template_id` = `t`.`template_id`
	    INNER JOIN `user` `u` ON `s`.`user_id` = `u`.`user_id`
EOF;

        if (! empty($condition['keyword'])) {
            $sql .= <<<EOF
	    WHERE `t`.`content` LIKE ?
                   OR `c`.`display_name` LIKE ?
                   OR `c`.`name` LIKE ?
                   OR `u`.`name` LIKE ?
EOF;
            $keyword = "%{$condition['keyword']}%";
            array_push($query_param, $keyword, $keyword, $keyword, $keyword);
        }

        $sql .= <<<EOF
        LIMIT {$param['offset']}, {$param['limit']}
EOF;

        $query = $this->db->query($sql, $query_param);
//var_dump($sql);exit;

        return $query->result_array();
    }


    /**
     * get users for scout sending email
     */
    public function getUsers($user_ids, $fields = ['user_id', 'name', 'mail'])
    {
        $this->load->model('Logic_user');

        $fields = (array) $fields;

        $select = sprintf('`%s`.`', $this->Logic_user->table) . implode(sprintf('`, `%s`.`', $this->Logic_user->table), $fields) . '`';

        $this->db->select($select);

        $this->db->from($this->Logic_user->table);

        $where = sprintf("`%s`.`status` = %d AND `%s`.`delete_flg` = %d ", $this->Logic_user->table, Logic_user::STATUS_ACTIVE, $this->Logic_user->table, Logic_user::DELETE_FLG_FALSE);
        $where .= sprintf(" AND `%s`.`user_id` IN (%s) ", $this->Logic_user->table, implode(',', $user_ids));

        $this->db->where($where);

        $users = $this->db->get()->result_array();

        return $users;
    }

    /**
     * Search users
     *
     * @param $param array
     *            ['area_id' =>[], 'start_date'=>'Y-m-d', 'end_date' =>'Y-m-d', 'employ_tag_id' =>[], 'license_tag_id' =>[] ]
     *
     */
    public function searchUsers($param, $fields = ['user_id', 'birthdate','area_id'])
    {
        $this->load->model('Logic_user');
        $this->load->model('Logic_tag');
        $this->load->helper('date');

        $fields = (array) $fields;

        $select = sprintf('`%s`.`', $this->Logic_user->table) . implode(sprintf('`, `%s`.`', $this->Logic_user->table), $fields) . '`';

        $this->db->select($select);
        $this->db->from($this->Logic_user->table);

        $where = sprintf("`%s`.`status` = %d AND `%s`.`delete_flg` = %d ", $this->Logic_user->table, Logic_user::STATUS_ACTIVE, $this->Logic_user->table, Logic_user::DELETE_FLG_FALSE);

        if (isset($param['area_id'])) {
            // join and where with city_id = job.area_id
            array_filter($param['area_id'], 'is_numeric');
            $where .= sprintf(" AND `%s`.`area_id` in (%s)", $this->Logic_user->table, implode(',', $param['area_id']));
        }

        if (isset($param['start_date']) && checkDateFormat($param['start_date'])) {
            // join and where with start_date = job.updated
            $where .= sprintf(" AND DATE(`%s`.`updated`) >= '%s'", $this->Logic_user->table, $param['start_date']);
        }

        if (isset($param['end_date']) && checkDateFormat($param['end_date'])) {
            // join and where with start_date = job.updated
            $where .= sprintf(" AND DATE(`%s`.`updated`) <= '%s'", $this->Logic_user->table, $param['end_date']);
        }

        if (isset($param['employ_tag_id'])) {
            // join tag, type and account_id and where with license_tag_id = tag.tag_id and tag_group_id = 3
            $this->db->join($this->Logic_tag->table_tag_relation, sprintf('`%s`.`account_id` = `%s`.`user_id`', $this->Logic_tag->table_tag_relation, $this->Logic_user->table));
            $this->db->join($this->Logic_tag->table, sprintf('`%s`.`tag_id` = `%s`.`tag_id`', $this->Logic_tag->table_tag_relation, $this->Logic_tag->table));

            // trim all tags are not numeric
            array_filter($param['employ_tag_id'], 'is_numeric');
            if (! empty($param['employ_tag_id'])) {
                $where .= sprintf(" AND `%s`.`type` = %d AND `%s`.`delete_flg` = %d ", $this->Logic_tag->table_tag_relation, Logic_tag::TAG_RELATION_TYPE_USER, $this->Logic_tag->table_tag_relation, Logic_tag::TAG_RELATION_DELETE_FLG_FALSE);

                $where .= sprintf(" AND `%s`.`tag_id` in (%s)", $this->Logic_tag->table_tag_relation, implode(',', $param['employ_tag_id']));

                $where .= sprintf(" AND `%s`.`tag_group_id` = %d AND `%s`.`delete_flg` = %d ", $this->Logic_tag->table, Logic_tag::TAG_GROUP_ID_EMPLOY, $this->Logic_tag->table, Logic_tag::DELETE_FLG_FALSE);
            }
        }

        if (isset($param['license_tag_id'])) {
            // join tag, type and account_id and where with license_tag_id = tag.tag_id and tag_group_id = 4
            $table_tag_relation_licenseAlias = 'trla';
            $table_tag_licenseAlias = 'tla';

            $this->db->join(sprintf('`%s` AS `%s`', $this->Logic_tag->table_tag_relation, $table_tag_relation_licenseAlias), sprintf('`%s`.`account_id` = `%s`.`user_id`', $table_tag_relation_licenseAlias, $this->Logic_user->table));
            $this->db->join(sprintf('`%s` AS `%s`', $this->Logic_tag->table, $table_tag_licenseAlias), sprintf('`%s`.`tag_id` = `%s`.`tag_id`', $table_tag_relation_licenseAlias, $table_tag_licenseAlias));

            // trim all tags are not numeric
            array_filter($param['license_tag_id'], 'is_numeric');
            if (! empty($param['license_tag_id'])) {
                $where .= sprintf(" AND `%s`.`type` = %d AND `%s`.`delete_flg` = %d ", $table_tag_relation_licenseAlias, Logic_tag::TAG_RELATION_TYPE_USER, $table_tag_relation_licenseAlias, Logic_tag::TAG_RELATION_DELETE_FLG_FALSE);

                $where .= sprintf(" AND `%s`.`tag_id` in (%s)", $table_tag_relation_licenseAlias, implode(',', $param['license_tag_id']));

                $where .= sprintf(" AND `%s`.`tag_group_id` = %d AND `%s`.`delete_flg` = %d ", $table_tag_licenseAlias, Logic_tag::TAG_GROUP_ID_LICENSE, $table_tag_licenseAlias, Logic_tag::DELETE_FLG_FALSE);
            }
        }
        $this->db->where($where);

        $countDb = clone $this->db;

        $count = $countDb->count_all_results();

        if (isset($param['limit']) && $param['limit'] > 0) {
            $offset = (int) isset($param['offset']) ? $param['offset'] : 0;
            $this->db->limit($param['limit']);
            $this->db->offset($offset);
        }

        $this->db->group_by(sprintf('`%s`.`user_id`', $this->Logic_user->table));

        $this->db->order_by(sprintf("`%s`.`updated`", $this->Logic_user->table), "desc");

        $users = $this->db->get()->result_array();

        $data['users'] = [];
        $data['total'] = 0;
        if ($users && ! empty($users)) {
            $data['users'] = $users;
            $data['total'] = $count;
        }
        return $data;
    }

    public function getAllLicenseTagsByUser($user_id, $fields = ['tag_id', 'name'], $limit = 3)
    {
        $this->load->model('Logic_user');
        $this->load->model('Logic_tag');

        $fields = (array) $fields;

        $where = sprintf("`%s`.`status` = %d AND `%s`.`user_id` = %d", $this->Logic_user->table, Logic_user::STATUS_ACTIVE, $this->Logic_user->table, $user_id);

        $select = sprintf('`%s`.`', $this->Logic_tag->table) . implode(sprintf('`, `%s`.`', $this->Logic_tag->table), $fields) . '`';

        $this->db->select($select);
        $this->db->from($this->Logic_user->table);

        $this->db->join($this->Logic_tag->table_tag_relation, sprintf('`%s`.`account_id` = `%s`.`user_id`', $this->Logic_tag->table_tag_relation, $this->Logic_user->table));
        $this->db->join($this->Logic_tag->table, sprintf('`%s`.`tag_id` = `%s`.`tag_id`', $this->Logic_tag->table_tag_relation, $this->Logic_tag->table));

        $where .= sprintf(" AND `%s`.`type` = %d AND `%s`.`delete_flg` = %d ", $this->Logic_tag->table_tag_relation, Logic_tag::TAG_RELATION_TYPE_USER, $this->Logic_tag->table_tag_relation, Logic_tag::TAG_RELATION_DELETE_FLG_FALSE);

        $where .= sprintf(" AND `%s`.`tag_group_id` = %d AND `%s`.`delete_flg` = %d ", $this->Logic_tag->table, Logic_tag::TAG_GROUP_ID_LICENSE, $this->Logic_tag->table, Logic_tag::DELETE_FLG_FALSE);

        $this->db->where($where);
        $this->db->limit($limit);
        $results = $this->db->get()->result_array();
        return $results;
    }

    public function getAllEmployTagsByUser($user_id, $fields = ['tag_id', 'name'], $limit = 3)
    {
        $this->load->model('Logic_user');
        $this->load->model('Logic_tag');

        $fields = (array) $fields;

        $where = sprintf("`%s`.`status` = %d AND `%s`.`user_id` = %d", $this->Logic_user->table, Logic_user::STATUS_ACTIVE, $this->Logic_user->table, $user_id);

        $select = sprintf('`%s`.`', $this->Logic_tag->table) . implode(sprintf('`, `%s`.`', $this->Logic_tag->table), $fields) . '`';

        $this->db->select($select);
        $this->db->from($this->Logic_user->table);

        $this->db->join($this->Logic_tag->table_tag_relation, sprintf('`%s`.`account_id` = `%s`.`user_id`', $this->Logic_tag->table_tag_relation, $this->Logic_user->table));
        $this->db->join($this->Logic_tag->table, sprintf('`%s`.`tag_id` = `%s`.`tag_id`', $this->Logic_tag->table_tag_relation, $this->Logic_tag->table));

        $where .= sprintf(" AND `%s`.`type` = %d AND `%s`.`delete_flg` = %d ", $this->Logic_tag->table_tag_relation, Logic_tag::TAG_RELATION_TYPE_USER, $this->Logic_tag->table_tag_relation, Logic_tag::TAG_RELATION_DELETE_FLG_FALSE);

        $where .= sprintf(" AND `%s`.`tag_group_id` = %d AND `%s`.`delete_flg` = %d ", $this->Logic_tag->table, Logic_tag::TAG_GROUP_ID_EMPLOY, $this->Logic_tag->table, Logic_tag::DELETE_FLG_FALSE);

        $this->db->where($where);
        $this->db->limit($limit);
        $results = $this->db->get()->result_array();
        return $results;
    }


    public function getHostories($client_id, $limit = 10, $offset = 0)
    {
        $this->load->model('Logic_user');
        $this->load->model('Logic_job');
        $this->load->model('Logic_nursery');

        $select = sprintf('`s`.`scout_id`, DATE(`s`.`created`) AS created, `j`.`job_id`, `j`.`title` AS job_title, `n`.`name` AS nursery_name, `n`.`nursery_id`, `u`.`birthdate`');

        $this->db->select($select);
        $this->db->from(sprintf('`%s` AS s', $this->table));
        // join with job
        $this->db->join(sprintf('`%s` AS j', $this->Logic_job->table), '`s`.`job_id` = `j`.`job_id`');

        // join with nursery

        $this->db->join(sprintf('`%s` AS n', $this->Logic_nursery->table), '`n`.`nursery_id` = `j`.`nursery_id`');

        // join with user

        $this->db->join(sprintf('`%s` AS u', $this->Logic_user->table), '`u`.`user_id` = `s`.`user_id`');

        // check job and nursery is not deleted
        $where = sprintf("`j`.`delete_flg` = %d AND `n`.`delete_flg` = %d ", Logic_job::DELETE_FLG_FALSE, Logic_job::DELETE_FLG_FALSE);

        // check client id
        $where .= sprintf(" AND `n`.`client_id` = %d", $client_id);

        $this->db->where($where);

        $countDb = clone $this->db;
        $count = $countDb->count_all_results();

        $this->db->limit((int) $limit);
        $this->db->offset((int) $offset);

        $this->db->group_by(sprintf('`s`.`scout_id`'));
        $this->db->order_by("`s`.`created`", "desc");

        $scouts = $this->db->get()->result_array();

        $data['scouts'] = [];
        $data['total'] = 0;

        if ($scouts && ! empty($scouts)) {
            $data['scouts'] = $scouts;
            $data['total'] = $count;
        }
        return $data;
    }

    public function getScoutDetails($client_id, $scout_id)
    {
        $this->load->model('Logic_user');
        $this->load->model('Logic_job');
        $this->load->model('Logic_nursery');
        $this->load->model('Logic_template');

        $select = sprintf('`s`.`scout_id`, DATE(`s`.`created`) AS created, `j`.`job_id`, `j`.`title` AS job_title, `n`.`name` AS nursery_name, `n`.`nursery_id`, `u`.`birthdate`, `u`.`name` AS user_name, `t`.`title` AS template_title,  `t`.`content` AS template_content' );

        $this->db->select($select);
        $this->db->from(sprintf('`%s` AS s', $this->table));
        // join with job
        $this->db->join(sprintf('`%s` AS j', $this->Logic_job->table), '`s`.`job_id` = `j`.`job_id`');

        // join with nursery

        $this->db->join(sprintf('`%s` AS n', $this->Logic_nursery->table), '`n`.`nursery_id` = `j`.`nursery_id`');

        // join with user

        $this->db->join(sprintf('`%s` AS u', $this->Logic_user->table), '`u`.`user_id` = `s`.`user_id`');

        // join with template

        $this->db->join(sprintf('`%s` AS t', $this->Logic_template->table), '`t`.`template_id` = `s`.`template_id`');

        // check job and nursery is not deleted
        $where = sprintf("`j`.`delete_flg` = %d AND `n`.`delete_flg` = %d ", Logic_job::DELETE_FLG_FALSE, Logic_job::DELETE_FLG_FALSE);

        // check client id
        $where .= sprintf(" AND `n`.`client_id` = %d", $client_id);

        // check $scout_id
        $where .= sprintf(" AND `s`.`scout_id` = %d", $scout_id);

        $this->db->where($where);

        $scout = $this->db->get()->result_array();

        if ($scout == false) {
            return false;
        }
        $scout = array_shift($scout);
        return $scout;
    }

    public function getTemplateList($client_id, $limit = 10, $offset = 0)
    {
         $this->load->model('Logic_template');

        $select = '`template_id`, `title`, `content`, `created`';

        $this->db->select($select);
        $this->db->from($this->Logic_template->table);



        // check job and nursery is not deleted
        $where = sprintf("`delete_flg` = %d", Logic_template::DELETE_FLG_FALSE);

        // check client id
        $where .= sprintf(" AND `client_id` = %d", $client_id);

        $this->db->where($where);

        $countDb = clone $this->db;
        $count = $countDb->count_all_results();

        $this->db->limit((int) $limit);
        $this->db->offset((int) $offset);
        $this->db->order_by("`updated`", "desc");
        $templates = $this->db->get()->result_array();

        $data['templates'] = [];
        $data['total'] = 0;

        if ($templates && ! empty($templates)) {
            $data['templates'] = $templates;
            $data['total'] = $count;
        }
        return $data;
    }
    public function get_sent_count($cpgr_id){
        if(empty($cpgr_id)){
            return false;
        }
        $sql         = "SELECT COUNT(1) AS sent_count
                        FROM `scout` s
                        WHERE s.`cpgr_id` = ".$cpgr_id;
        $query       = $this->db->query($sql);
        $result      = $query->result_array();
        return $result;
    }

        public function get_export_data()
        {
            $relation_user = $this->config->item('type_relation_user', 'tag_config');
            $employ_type = $this->config->item('type_employ', 'tag_config');
            $license = $this->config->item('tag_license','tag_config');
            $sql = <<<EOF
                SELECT `scout`.*,
                `client`.`name`,
                `client`.`client_id`,
                `template`.`title`,
                `template`.`content`,
                `user`.`gender`,
                `user`.`birthdate`,
                `user`.`address`,
                `province`.`name` as `province`,
                `area`.`name` as `city`
                FROM `scout`
                LEFT JOIN `user` ON `user`.`user_id` = `scout`.`user_id`
                LEFT JOIN `area` ON `area`.`area_id` = `user`.`area_id`
                LEFT JOIN `area` AS `province` ON `province`.`area_id` = `area`.`region_id`
                LEFT JOIN `template` ON `template`.`template_id` = `scout`.`scout_id`
                LEFT JOIN `job` ON `job`.`job_id` = `scout`.`job_id`
                LEFT JOIN `nursery` ON `nursery`.`nursery_id` = `job`.`nursery_id`
                LEFT JOIN `client` ON `client`.`client_id` = `nursery`.`client_id`
EOF;

            $employ_type_sql = <<<SQL
            SELECT `tag`.`name` as `employ_type`, `scout`.`scout_id`
            FROM `scout`
             JOIN `tag_relation` ON `tag_relation`.`account_id` = `scout`.`user_id` AND `tag_relation`.type = {$relation_user}
             JOIN `tag`  ON `tag`.`tag_id` = `tag_relation`.`tag_id` AND `tag`.`tag_group_id` = {$employ_type}
SQL;
            $license_sql = <<<SQL
            SELECT `tag`.`name` as `license`, `scout`.`scout_id`
            FROM `scout`
             JOIN `tag_relation` ON `tag_relation`.`account_id` = `scout`.`user_id` AND `tag_relation`.type = {$relation_user}
             JOIN `tag`  ON `tag`.`tag_id` = `tag_relation`.`tag_id` AND `tag`.`tag_group_id` = {$license}
SQL;


            $result = $this->db->query($sql)->result_array();
            $employ_type = $this->db->query($employ_type_sql)->result_array();
            $license = $this->db->query($license_sql)->result_array();

            return array($result, $license, $employ_type);
        }

        public function get_template_export_data()
        {
            $sql = <<<EOF
                SELECT `template`.*,
                `client`.`name`,
                `client`.`client_id`
                FROM `template`
                LEFT JOIN `client` ON `client`.`client_id` = `template`.`client_id`
EOF;
            return $this->db->query($sql)->result_array();
        }

}
