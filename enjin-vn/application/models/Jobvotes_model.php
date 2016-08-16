<?php

/**
 * @author ThinhNH
 *
 */
class Jobvotes_model extends Enjin_Model {

	protected $_table = 'job_votes';

	protected $_primaryKeyField = 'id';

	protected $_labelsMap = array (
		'job_votes.id' => 'id',
		'job_votes.title' => 'title',
		'job_votes.rec_department_id' => 'rec_department_id',
		'job_votes.requirement' => 'requirement',
		'job_votes.jobtype_id' => 'jobtype_id',
		'job_votes.treatment' => 'treatment',
		'job_votes.qualification_require' => 'qualification_require',
		'job_votes.wanted_person' => 'wanted_person',
		'job_votes.wanted_deadline' => 'wanted_deadline',
		'job_votes.start_salary' => 'start_salary',
		'job_votes.start_date' => 'start_date',
		'job_votes.recruitment_area_id' => 'recruitment_area_id',
		'job_votes.wanted_year' => 'wanted_year',
		'job_votes.rec_recruiter_id' => 'rec_recruiter_id'
	);

	protected $_joinTables = array(
		array(
			'table' => 'rec_departments',
			'join' => 'rec_departments.id = job_votes.rec_department_id and rec_departments.status = 0',
			'type' => 'inner'
		), array(
			'table' => 'rec_companies',
			'join' => 'rec_departments.rec_company_id = rec_companies.id',
			'type' => 'left'
		),
	);
	/**
	 * construct
	 */
	public function __construct()
	{
		parent::__construct();
	}

    public function getRecCompanyIdByVoteJobId($job_vote_id = null, $recCompanyId = null) {
        $query = $this->db->select('rec_companies.id')
                ->join('rec_departments', 'rec_departments.id = job_votes.rec_department_id and rec_departments.status = 0', 'inner')
                ->join('rec_companies', 'rec_departments.rec_company_id = rec_companies.id and rec_companies.status = 0', 'inner')
                ->where('((`wanted_deadline` IS NOT NULL AND  `wanted_deadline` > NOW()) OR `wanted_deadline` IS NULL)')
                ->where('((`start_date` IS NOT NULL AND  `start_date` < NOW()) OR `start_date` IS NULL)')
                 ->where('rec_companies.id ='.$recCompanyId)
                 ->where('job_votes.status = 0')
                 ->where('job_votes.id', $job_vote_id)
            ;

//        print_r($this->db->get_compiled_select($this->_table));die;
        $data = $this->db->get($this->_table)->row_array();

        return $data;
    }

    public function getSearchJobVotes($filters = array())
    {
        $sql = "SELECT
                    job_votes.id as id, job_votes.title as title, job_votes.rec_department_id as rec_department_id,
                    job_votes.requirement as requirement, job_votes.jobtype_id as jobtype_id, job_votes.treatment as treatment,
                    job_votes.qualification_require as qualification_require, job_votes.wanted_person as wanted_person,
                    job_votes.wanted_deadline as wanted_deadline, job_votes.start_salary as start_salary,
                    job_votes.start_date as start_date, job_votes.recruitment_area_id as recruitment_area_id,
                    job_votes.wanted_year as wanted_year, job_votes.rec_recruiter_id as rec_recruiter_id
                FROM job_votes
                LEFT JOIN `rec_departments` ON `rec_departments`.`id` = `job_votes`.`rec_department_id`
                LEFT JOIN `rec_companies` ON `rec_departments`.`rec_company_id` = `rec_companies`.`id`
                WHERE  `rec_departments`.`status` = 0 AND `job_votes`.`status` = 0 AND `rec_departments`.`rec_company_id` = ".$filters['rec_company_id']."
                    AND ((`wanted_deadline` IS NOT NULL AND  `wanted_deadline` > NOW()) OR `wanted_deadline` IS NULL)
                    AND((`start_date` IS NOT NULL AND `start_date` < NOW() ) OR `start_date` IS NULL) ";


        if(!empty($filters['wanted_year'])) {
            $sql .= " AND(`wanted_year` = ".$filters['wanted_year']." )";
        }
        if(!empty($filters['jobtype_id'])) {
            $sql .= " AND jobtype_id =". $filters['jobtype_id'];
        }

        if(!empty($filters['recruitment_area_id'])){
            $sql .= " AND recruitment_area_id=" .$filters['recruitment_area_id'];
        }
        $sql .= " ORDER BY `id` desc";

        $query = $this->db->query($sql);
        return $query->result_array();


    }

}