<?php
App::uses('AppModel', 'Model');
/**
 * SelStat Model
 *
 */
class SelStat extends AppModel {

	/**
	* 選考状況の実数取得
	* 
	* @param  int   $rec_company_id
	* @return array $result
	* 
	***/
	public function getRealNumber( $rec_company_id )
	{
		$param = array( $rec_company_id );

		$sql = "SELECT sel_stats.job_vote_id, 
					   sel_stats.screening_stage_id, 
					   sel_stats.select_status_id, 
					   sel_stats.count 
				FROM sel_stats 
				INNER JOIN job_votes ON sel_stats.job_vote_id = job_votes.id
				INNER JOIN rec_departments ON job_votes.rec_department_id = rec_departments.id 
				INNER JOIN screening_stages ON sel_stats.screening_stage_id = screening_stages.id 
				WHERE rec_departments.rec_company_id = ?
				AND job_votes.status = 0 
				AND rec_departments.status = 0
				ORDER BY screening_stages.order ASC" ;

		$result = $this->query( $sql, $param );

		return $result;

	}

	/**
	* 採用担当者別 最終選考率リスト
	* 
	* @param  int    $rec_company_id
	* @param  array  $data
	* @return array  $result
	**/
	public function getLastSelRate( $rec_company_id, $data )
	{
		$param = array( $rec_company_id, $data['year'] );

		$sql = "
			SELECT SUM( sel_stats.count ) all_count,
			  SUM( CASE WHEN sel_stats.select_status_id = 4 THEN sel_stats.count ELSE 0 END ) pass_count,
			  SUM( CASE WHEN sel_stats.select_status_id = 5 THEN sel_stats.count ELSE 0 END ) fail_count, 
			  SUM( CASE WHEN sel_stats.select_status_id = 6 THEN sel_stats.count ELSE 0 END ) cancel_count,
			  rec_recruiters.id, rec_recruiters.last_name, rec_recruiters.first_name    
			FROM rec_recruiters 
			INNER JOIN rec_departments ON rec_recruiters.rec_department_id = rec_departments.id 
			INNER JOIN job_votes ON rec_departments.id = job_votes.rec_department_id
			INNER JOIN sel_stats ON job_votes.id = sel_stats.job_vote_id 
			WHERE rec_departments.rec_company_id = ? 
			AND rec_departments.status = 0 
			AND rec_recruiters.status = 0 
			AND job_votes.status = 0 
			AND job_votes.wanted_year = ? 
			AND sel_stats.last_sel_flag = 1 
			GROUP BY rec_recruiters.id
		";

		$result = $this->query( $sql, $param );

		return $result;

	}

	/**
	* 求人票別採用コスト
	* 
	* @param   int    $rec_company_id 
	* @param   array  $data 
	* @return  array  $result
	**/
	public function getRecruitCost( $rec_company_id, $data )
	{
		$param = array( $rec_company_id, $data['year'] );

		$sql = "
			SELECT job_votes.id, job_votes.title, 

			       count( sel_stats.count ) count ,
			       
			       CASE WHEN inf_contracts.contract_type = 1 THEN count( sel_stats.count )  END count1,
			       CASE WHEN inf_contracts.contract_type = 2 THEN count( sel_stats.count )  END count2,
			       CASE WHEN inf_contracts.contract_type = 3 THEN count( sel_stats.count )  END count3,

			        

			       COALESCE( inf_contracts.fixed_unit_price, 0 ) fixed_unit_price, 

			       COALESCE( sel_histories.annual_income, job_votes.start_salary, 0 ) income_ratio_val, 
			       COALESCE( inf_contracts.income_ratio, 0 ) income_ratio,  
			       

			       COALESCE( inf_contracts.unlimited_fixed_annual, 0 ) unlimited_fixed_annual, 

			       COALESCE( ev_schedules.holding_cost, 0 ) holding_cost,
			       
			       inf_job_vote_publics.inf_contract_id,

			       inf_contracts.contract_type,
			       can_candidates.inf_contract_id

			FROM job_votes 
			INNER JOIN sel_stats ON job_votes.id = sel_stats.job_vote_id 
			INNER JOIN inf_job_vote_publics ON job_votes.id = inf_job_vote_publics.job_vote_id 
			INNER JOIN referer_companies ON inf_job_vote_publics.referer_company_id = referer_companies.id 
			INNER JOIN inf_contracts ON referer_companies.id = inf_contracts.referer_company_id 
			INNER JOIN 
			  ( SELECT sel_histories.id, sel_histories.job_vote_id, sel_histories.select_status_id,
			  		   sel_histories.annual_income, sel_histories.screening_stage_id, sel_histories.can_candidate_id  
			  	FROM sel_histories ) AS sel_histories 
			  ON sel_stats.job_vote_id = sel_histories.job_vote_id 
			  AND sel_stats.screening_stage_id = sel_histories.screening_stage_id 
			  AND sel_stats.select_status_id = sel_histories.select_status_id 
			INNER JOIN screening_stages ON screening_stages.id = sel_histories.screening_stage_id 
										AND screening_stages.last_select_flag = sel_stats.last_sel_flag 
			LEFT JOIN 
			  ( SELECT ev_events.id, ev_events.rec_company_id, ev_events.job_vote_id FROM ev_events WHERE ev_events.status = 0 ) AS ev_events 
			  ON job_votes.id = ev_events.job_vote_id 
			LEFT JOIN ev_schedules ON ev_events.id = ev_schedules.ev_event_id 
			INNER JOIN can_candidates ON sel_histories.can_candidate_id = can_candidates.id 
			WHERE referer_companies.rec_company_id = ? 
			AND inf_job_vote_publics.status = 0 
			AND referer_companies .status = 0 
			AND job_votes.wanted_year = ? 
			AND sel_stats.last_sel_flag = 1 && sel_stats.select_status_id = 5
			GROUP BY job_votes.id 
			ORDER BY job_votes.id 
		";

		$result = $this->query( $sql, $param );

		return $result;


	}
    
    /**
     * 
     * 該当するデータとして、件数があるかを判断する。
     * 
     * 
     * @param int
     * @param int
     * @param int
     * 
     * @return bool
     * 
     **/
    public function isData( $jobvote_id, $screening_stage_id, $select_status_id ) 
    {
        switch ($select_status_id)
        {
            case 5:     //合格
            case 6:     //不合格
                $select_status_id =array( $select_status_id );
                break;
            default:    //
                $select_status_id = array( 0,1,2,3,4,7,8,9,10);
        }
        
        return ( bool ) $this->find("all", array( "conditions"=>
                                                array( "SelStat.job_vote_id"=>$jobvote_id ,
                                                       "SelStat.screening_stage_id"=>$screening_stage_id ,
                                                       "SelStat.select_status_id"=>$select_status_id ,
                                                       "SelStat.count >"=>0 )));
        
    }

}
