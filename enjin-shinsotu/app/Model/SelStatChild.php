<?php
App::uses('AppModel', 'Model');
/**
 * SelStatChild Model
 *
 */
class SelStatChild extends AppModel {


/**
* 指定された選考履歴情報を取得
* 
* @param   array $data
* @return  array $list
**/
	public function getCandidateIdBySummary( $data )
	{
		$param = array( $data['job_vote_id'], $data['year'], $data['screening_stage_id'], $data['select_status_id'] );

		$sql = "
			SELECT sel_stat_children.can_candidate_id 
			FROM sel_stat_children 
			INNER JOIN job_votes ON sel_stat_children.job_vote_id = job_votes.id 
			WHERE sel_stat_children.job_vote_id = ? 
			AND job_votes.status = 0 
			AND job_votes.wanted_year = ? 
			AND sel_stat_children.screening_stage_id = ? 
			AND sel_stat_children.select_status_id = ? ";

	    $result = $this->query( $sql, $param );

	    return $result;

	}


/**
* 学歴集計
* 
* @param   int   $rec_company_id
* @param   array $data
* @return  array $result 
* 
**/
	public function getSelEducationStats( $rec_company_id, $data )
	{
		$param = array( $rec_company_id, $data['year'] );

		$sql = "
			SELECT COUNT( sel_stat_children.select_status_id ) count, sel_stat_children.job_vote_id, 
    			   job_votes.title, schools.school_rank,  
       			   sel_stat_children.screening_stage_id, screening_stages.name, sel_stat_children.select_status_id 
			FROM sel_stat_children 
			INNER JOIN can_educations ON can_educations.can_candidate_id = sel_stat_children.can_candidate_id 
			LEFT JOIN schools ON can_educations.school_id = schools.id 
			INNER JOIN screening_stages ON sel_stat_children.screening_stage_id = screening_stages.id 
			INNER JOIN job_votes ON sel_stat_children.job_vote_id = job_votes.id 
			INNER JOIN rec_departments ON job_votes.rec_department_id = rec_departments.id 
			WHERE rec_departments.rec_company_id = ? 
			AND job_votes.status = 0 
			AND schools.status = 0
			AND job_votes.wanted_year = ? 
			GROUP BY sel_stat_children.job_vote_id, schools.school_rank, sel_stat_children.screening_stage_id, sel_stat_children.select_status_id 
			ORDER BY sel_stat_children.job_vote_id, schools.school_rank, sel_stat_children.screening_stage_id, sel_stat_children.select_status_id, screening_stages.order
		";

		$result = $this->query( $sql, $param );


		return $result;

	}


/**
* 語学集計
* 
* @param   int   $rec_company_id
* @param   array $data
* @return  array $result 
* 
**/
	public function getSelLanguageStats( $rec_company_id, $data )
	{

			$param = array( $rec_company_id, $data['year'] );


		$sql = "
			SELECT COUNT( sel_stat_children.select_status_id ) count, sel_stat_children.job_vote_id, 
    			   job_votes.title, can_languages.foreign_language_id, can_languages.foreign_language, 
       			   sel_stat_children.screening_stage_id, screening_stages.name, sel_stat_children.select_status_id 
			FROM sel_stat_children 
			INNER JOIN can_languages ON can_languages.can_candidate_id = sel_stat_children.can_candidate_id 
			INNER JOIN screening_stages ON sel_stat_children.screening_stage_id = screening_stages.id 
			INNER JOIN job_votes ON sel_stat_children.job_vote_id = job_votes.id 
			INNER JOIN rec_departments ON job_votes.rec_department_id = rec_departments.id 
			WHERE rec_departments.rec_company_id = ? 
			AND job_votes.status = 0 
			AND can_languages.status = 0 
			AND job_votes.wanted_year = ? 
			GROUP BY sel_stat_children.job_vote_id, can_languages.foreign_language_id, sel_stat_children.screening_stage_id, sel_stat_children.select_status_id 
			ORDER BY sel_stat_children.job_vote_id, can_languages.foreign_language_id, sel_stat_children.screening_stage_id, sel_stat_children.select_status_id, screening_stages.order
		";

		$result = $this->query( $sql, $param );

		return $result;

	}

/**
* 資格集計
* 
* @param   int   $rec_company_id
* @param   array $data
* @return  array $result 
* 
**/
	public function getSelQualificationStats( $rec_company_id, $data )
	{
		$param = array( $rec_company_id, $data['year'] );

		$sql = "
			SELECT COUNT( sel_stat_children.select_status_id ) count, sel_stat_children.job_vote_id, 
    			   job_votes.title, can_qualifications.qualification_id, coalesce( qualifications.name, can_qualifications.qualification ) name , 
       			   sel_stat_children.screening_stage_id, screening_stages.name, sel_stat_children.select_status_id 
			FROM can_qualifications 
			LEFT JOIN qualifications ON can_qualifications.qualification_id = qualifications.id 
			INNER JOIN sel_stat_children ON can_qualifications.can_candidate_id = sel_stat_children.can_candidate_id 
			INNER JOIN screening_stages ON sel_stat_children.screening_stage_id = screening_stages.id 
			INNER JOIN job_votes ON sel_stat_children.job_vote_id = job_votes.id 
			INNER JOIN rec_departments ON job_votes.rec_department_id = rec_departments.id 
			WHERE rec_departments.rec_company_id = ? 
			AND job_votes.status = 0 
			AND can_qualifications.status = 0 
			AND qualifications.status = 0 
			AND job_votes.wanted_year = ? 
			GROUP BY sel_stat_children.job_vote_id, can_qualifications.qualification_id, sel_stat_children.screening_stage_id, sel_stat_children.select_status_id 
			ORDER BY sel_stat_children.job_vote_id, can_qualifications.qualification_id, sel_stat_children.screening_stage_id, sel_stat_children.select_status_id, screening_stages.order 
		";

		$result = $this->query( $sql, $param );

		return $result;

	}

/**
* カスタム属性集計
* 
* @param   int   $rec_company_id
* @param   array $data
* @return  array $result 
* 
**/
	public function getSelCustomStats( $rec_company_id, $data )
	{
		$param = array( $rec_company_id, $data['year'] );

		$sql = "
			SELECT COUNT( sel_stat_children.select_status_id ) count, sel_stat_children.job_vote_id, 
    			   job_votes.title, can_custom_attributes.can_custom_field_id, can_custom_fields.field_name, 
       			   sel_stat_children.screening_stage_id, screening_stages.name, sel_stat_children.select_status_id 
			FROM sel_stat_children 
			INNER JOIN can_custom_attributes ON can_custom_attributes.can_candidate_id = sel_stat_children.can_candidate_id 
			INNER JOIN can_custom_fields ON can_custom_attributes.can_custom_field_id = can_custom_fields.id 
			INNER JOIN screening_stages ON sel_stat_children.screening_stage_id = screening_stages.id 
			INNER JOIN job_votes ON sel_stat_children.job_vote_id = job_votes.id 
			INNER JOIN rec_departments ON job_votes.rec_department_id = rec_departments.id 
			WHERE rec_departments.rec_company_id = ? 
			AND job_votes.status = 0 
			AND can_custom_attributes.status = 0 
			AND can_custom_fields.status = 0 
			AND job_votes.wanted_year = ? 
			GROUP BY sel_stat_children.job_vote_id, can_custom_attributes.can_custom_field_id, sel_stat_children.screening_stage_id, sel_stat_children.select_status_id 
			ORDER BY sel_stat_children.job_vote_id, can_custom_attributes.can_custom_field_id, sel_stat_children.screening_stage_id, sel_stat_children.select_status_id, screening_stages.order
		";

		$result = $this->query( $sql, $param );

		return $result;

	}


}
