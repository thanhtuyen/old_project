<?php
App::uses('AppModel', 'Model');
/**
 * EvStatChild Model
 *
 */
class EvStatChild extends AppModel {

/**
* 候補者属性別イベント集計取得
* 
* @param   array $data
* @return  array $result 
* 
* 
**/
	public function getAttrEvStats( $rec_company_id, $data )
	{
		switch ( $data['attr'] ) {
			case 'education':
				$result = $this->getEducationStats( $rec_company_id, $data );
				break;

			case 'language':
				$result = $this->getLanguageStats( $rec_company_id, $data );
				break;

			case 'qualification':
				$result = $this->getQualificationStats( $rec_company_id, $data );
				break;

			case 'custom':
				$result = $this->getCustomStats( $rec_company_id, $data );			
				break;
								
			default:
				break;		

		}

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
	public function getEvEducationStats( $rec_company_id, $data )
	{
		$param = array( $rec_company_id, $data['year'] );

		$sql = "
			SELECT coalesce( sel_stats.job_vote_id, 0 ) job_vote_id, coalesce( ev_stats.ev_event_id, 0 ) ev_event_id, 
				   schools.school_rank, count( can_candidates.id ) can_count
			FROM can_candidates 
			LEFT JOIN ev_stat_children ON can_candidates.id = ev_stat_children.can_candidate_id 
			LEFT JOIN ev_stats ON ev_stats.ev_event_id = ev_stat_children.ev_event_id 
					AND ev_stats.ev_schedule_id = ev_stat_children.ev_schedule_id 
					AND ev_stats.ev_history_status = ev_stat_children.ev_history_status 
			LEFT JOIN sel_stat_children ON can_candidates.id = sel_stat_children.can_candidate_id 
			LEFT JOIN sel_stats ON sel_stats.job_vote_id = sel_stat_children.job_vote_id 
					AND sel_stats.screening_stage_id = sel_stat_children.screening_stage_id 
					AND sel_stats.select_status_id = sel_stat_children.select_status_id  
			INNER JOIN can_educations ON can_candidates.id = can_educations.can_candidate_id 
			INNER JOIN schools ON can_educations.school_id = schools.id 
			INNER JOIN job_votes ON sel_stats.job_vote_id = job_votes.id 
			WHERE can_candidates.rec_company_id = ? 
			AND can_candidates.status = 0 
			AND can_educations.status = 0 
			AND schools.status = 0 
			AND job_votes.wanted_year = ?
			GROUP BY sel_stats.job_vote_id, ev_stats.ev_event_id, schools.school_rank  
			ORDER BY sel_stats.job_vote_id, ev_stats.ev_event_id, schools.school_rank 

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
	public function getEvLanguageStats( $rec_company_id, $data )
	{

			$param = array( $rec_company_id, $data['year'] );

		$sql = "
			SELECT coalesce( sel_stats.job_vote_id, 0 ) job_vote_id, coalesce( ev_stats.ev_event_id, 0 ) ev_event_id, 
				   can_languages.foreign_language_id, count( can_candidates.id ) can_count
			FROM can_candidates 
			LEFT JOIN ev_stat_children ON can_candidates.id = ev_stat_children.can_candidate_id 
			LEFT JOIN ev_stats ON ev_stats.ev_event_id = ev_stat_children.ev_event_id 
					AND ev_stats.ev_schedule_id = ev_stat_children.ev_schedule_id 
					AND ev_stats.ev_history_status = ev_stat_children.ev_history_status 
			LEFT JOIN sel_stat_children ON can_candidates.id = sel_stat_children.can_candidate_id 
			LEFT JOIN sel_stats ON sel_stats.job_vote_id = sel_stat_children.job_vote_id 
					AND sel_stats.screening_stage_id = sel_stat_children.screening_stage_id 
					AND sel_stats.select_status_id = sel_stat_children.select_status_id  
			INNER JOIN can_languages ON can_candidates.id = can_languages.can_candidate_id 
			INNER JOIN job_votes ON sel_stats.job_vote_id = job_votes.id 
			WHERE can_candidates.rec_company_id = ? 
			AND can_candidates.status = 0 
			AND can_languages.status = 0 
			AND job_votes.wanted_year = ?
			GROUP BY sel_stats.job_vote_id, ev_stats.ev_event_id, can_languages.foreign_language_id  
			ORDER BY sel_stats.job_vote_id, ev_stats.ev_event_id, can_languages.foreign_language_id 
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
	public function getEvQualificationStats( $rec_company_id, $data )
	{
		$param = array( $rec_company_id, $data['year'] );

		$sql = "
		    SELECT coalesce( sel_stats.job_vote_id, 0 )  job_vote_id, coalesce( ev_stats.ev_event_id, 0 ) ev_event_id, 
				   can_qualifications.qualification_id, count( can_candidates.id ) can_count
			FROM can_candidates 
			LEFT JOIN ev_stat_children ON can_candidates.id = ev_stat_children.can_candidate_id 
			LEFT JOIN ev_stats ON ev_stats.ev_event_id = ev_stat_children.ev_event_id 
					AND ev_stats.ev_schedule_id = ev_stat_children.ev_schedule_id 
					AND ev_stats.ev_history_status = ev_stat_children.ev_history_status 
			LEFT JOIN sel_stat_children ON can_candidates.id = sel_stat_children.can_candidate_id 
			LEFT JOIN sel_stats ON sel_stats.job_vote_id = sel_stat_children.job_vote_id 
					AND sel_stats.screening_stage_id = sel_stat_children.screening_stage_id 
					AND sel_stats.select_status_id = sel_stat_children.select_status_id  
			INNER JOIN can_qualifications ON can_candidates.id = can_qualifications.can_candidate_id 
			INNER JOIN job_votes ON sel_stats.job_vote_id = job_votes.id 
			WHERE can_candidates.rec_company_id = ? 
			AND can_candidates.status = 0 
			AND can_qualifications.status = 0 
			AND job_votes.wanted_year = ?
			GROUP BY sel_stats.job_vote_id, ev_stats.ev_event_id, can_qualifications.qualification_id  
			ORDER BY sel_stats.job_vote_id, ev_stats.ev_event_id, can_qualifications.qualification_id 
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
	public function getEvCustomStats( $rec_company_id, $data )
	{
		$param = array( $rec_company_id, $data['year'] );

		$sql = "
		 SELECT coalesce( sel_stats.job_vote_id, 0 ) job_vote_id, coalesce( ev_stats.ev_event_id, 0 ) ev_event_id, 
				   can_custom_attributes.can_custom_field_id, count( can_candidates.id ) can_count
			FROM can_candidates 
			LEFT JOIN ev_stat_children ON can_candidates.id = ev_stat_children.can_candidate_id 
			LEFT JOIN ev_stats ON ev_stats.ev_event_id = ev_stat_children.ev_event_id 
					AND ev_stats.ev_schedule_id = ev_stat_children.ev_schedule_id 
					AND ev_stats.ev_history_status = ev_stat_children.ev_history_status 
			LEFT JOIN sel_stat_children ON can_candidates.id = sel_stat_children.can_candidate_id 
			LEFT JOIN sel_stats ON sel_stats.job_vote_id = sel_stat_children.job_vote_id 
					AND sel_stats.screening_stage_id = sel_stat_children.screening_stage_id 
					AND sel_stats.select_status_id = sel_stat_children.select_status_id  
			INNER JOIN can_custom_attributes ON can_candidates.id = can_custom_attributes.can_candidate_id 
			INNER JOIN job_votes ON sel_stats.job_vote_id = job_votes.id 
			WHERE can_candidates.rec_company_id = ? 
			AND can_candidates.status = 0 
			AND can_custom_attributes.status = 0 
			AND job_votes.wanted_year = ?
			GROUP BY sel_stats.job_vote_id, ev_stats.ev_event_id, can_custom_attributes.can_custom_field_id  
			ORDER BY sel_stats.job_vote_id, ev_stats.ev_event_id, can_custom_attributes.can_custom_field_id ";

		$result = $this->query( $sql, $param );

		return $result;

	}


}
