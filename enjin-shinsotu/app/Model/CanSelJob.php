<?php
App::uses('AppModel', 'Model');
/**
 * CanSelJob Model
 *
 * @property RecCompany $RecCompany
 * @property JobVote $JobVote
 * @property CanCandidate $CanCandidate
 * @property SelHistory $SelHistory
 * @property ScreeningStage $ScreeningStage
 */
class CanSelJob extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'can_sel_job';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'RecCompany' => array(
			'className' => 'RecCompany',
			'foreignKey' => 'rec_company_id',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'type'=>'INNER'
		),
		'JobVote' => array(
			'className' => 'JobVote',
			'foreignKey' => 'job_vote_id',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'type'=>'INNER'
		),
		'CanCandidate' => array(
			'className' => 'CanCandidate',
			'foreignKey' => 'can_candidate_id',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'type'=>'INNER'
		),
		'SelHistory' => array(
			'className' => 'SelHistory',
			'foreignKey' => 'sel_history_id',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'type'=>'INNER'
		),
		'ScreeningStage' => array(
			'className' => 'ScreeningStage',
			'foreignKey' => 'screening_stage_id',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'type'=>'INNER'
		)
	);


    
    /**
     * 
     * getRefererDetail
     * 
     * @param int
     * @param array
     * @return array
     * 
     **/
    public function getRefererDetail( $ref_id ,$jobVote_id)
    {   
        $this->contain( 'ScreeningStage','CanCandidate','JobVote' );
        $data = $this->find('all', array( 'conditions'=>array(
                                                        'CanCandidate.status' => 0,
                                                        'CanCandidate.referer_company_id' => $ref_id,
                                                        'CanSelJob.job_vote_id'=>$jobVote_id
                                                        ),
                                          'fields'=>array('CanCandidate.id','CONCAT(CanCandidate.first_name, CanCandidate.last_name) as name',
                                                          'JobVote.id','JobVote.title',
                                                          'ScreeningStage.id','ScreeningStage.name',
                                          )
                                   )
                            );
        var_dump( $data );
        return $data;
    }


    /**
    * getCanSelJobByCandidateId
    * @param mixed
    * @return mixed
    **/
    public function getCanSelJobByCandidateId ($candidate_id) {

    	$this->recursive = -1;
    	return $this->find('all', array(
    			'conditions' => array(
    				'can_candidate_id' => $candidate_id
    			),
    		));
    }


	/**
	* getCanSelJobByCandidate
	* @param mixed
	* @return mixed
	*
	**/
	public function getCanSelJobByCandidate($candidate) {
		foreach ($candidate as $value){
			$candidate_ids[] = $value['CanCandidate']['id'];
		}
		$this->recursive = -1;
		return $this->find('all', array(
				'conditions' => array(
					'can_candidate_id' => $candidate_ids
					)
		));
	}

}
