<?php
App::uses('AppModel', 'Model');
/**
 * EvStat Model
 *
 */
class EvStat extends AppModel {

	/**
	* イベント参加履歴リスト
	* 
	* @param  int   $rec_company_id
	* @param  array $data
	* @return array $result
	* 
	**/
	public function getEvHistList( $rec_company_id, $data )
	{

		$param = array( $rec_company_id, $data['year'] );

		$sql = "
				SELECT job_votes.id, job_votes.title, ev_events.id, 
					   ev_events.name, ev_schedules.holding_date, ev_schedules.venue, 
				       SUM( CASE WHEN ev_stats.ev_history_status = 0 THEN ev_stats.count ELSE 0 END ) reserve_count,
				       SUM( CASE WHEN ev_stats.ev_history_status = 1 THEN ev_stats.count ELSE 0 END ) regist_count,
				       SUM( CASE WHEN ev_stats.ev_history_status IN ( 2,3 ) THEN ev_stats.count ELSE 0 END ) cancel_count,
				       SUM( CASE WHEN ev_stats.ev_history_status = 4 THEN ev_stats.count ELSE 0 END ) oarticipate_count,
				       SUM( CASE WHEN ev_stats.ev_history_status = 5 THEN ev_stats.count ELSE 0 END ) absence_count 
				FROM ev_stats 
				INNER JOIN ev_schedules ON ev_stats.ev_schedule_id = ev_schedules.id 
				INNER JOIN ev_events ON ev_schedules.ev_event_id = ev_events.id 
				INNER JOIN ev_personnels ON ev_events.id = ev_personnels.ev_event_id 
				LEFT JOIN job_votes ON ev_events.job_vote_id = job_votes.id 
				WHERE ev_personnels.rec_recruiter_id = ? 
				AND ev_events.status = 0 
				AND ev_personnels.status = 0 
				AND ( job_votes.wanted_year = ? OR job_votes.wanted_year IS NULL ) 
				GROUP BY ev_stats.ev_event_id, ev_stats.ev_schedule_id 
				ORDER BY job_votes.wanted_year 
		";

		$result = $this->query( $sql, $param );

		return $result;

	}

    /**
     * 
     * イベント一覧用の申し込み詳細数の取得
     * 
     * @param int
     * 
     * @return array
     * 
     **/
    public function getEventSearchData( $evSchedule_id )
    {   
    
        $this->recursive = -1;
        return $this->find('all',array( "conditions"=>array(
                                        'ev_schedule_id'=>$evSchedule_id )));
        
    }
    
    
    
}
