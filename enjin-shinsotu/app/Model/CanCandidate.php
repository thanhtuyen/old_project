<?php
App::uses('AppModel', 'Model');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');

/**
 * CanCandidate Model
 *
 * @property RecCompany $RecCompany
 * @property Country $Country
 * @property Prefecture $Prefecture
 * @property RefererCompany $RefererCompany
 * @property InfContract $InfContract
 * @property InfStaff $InfStaff
 * @property RecRecruiter $RecRecruiter
 * @property CanCustomAttribute $CanCustomAttribute
 * @property CanDocument $CanDocument
 * @property CanEducation $CanEducation
 * @property CanLanguage $CanLanguage
 * @property CanNotice $CanNotice
 * @property CanQualification $CanQualification
 * @property EvHistory $EvHistory
 * @property MlSendHistory $MlSendHistory
 * @property SelHistory $SelHistory
 */
class CanCandidate extends AppModel {
	// ユニークID作成時の最小文字長
	const LENGTH_MIN_UNIQUE_ID = 8;
    
    private $unLockID = array();

    private $lockID = array();

    public $displayField = 'name';

    public $virtualFields = array(
        'name' => 'CONCAT(CanCandidate.last_name, CanCandidate.first_name)'
    );
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'last_name' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'first_name' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'mail_address' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'email' => array(
				'rule' => array('email'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'unique_id' => array(
                        'isUnique' => array(
                                'rule' => 'isUnique',
                                //'message' => 'Your custom message here',
                        ),
		),
		'password' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'rec_company_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'cell_mail' => array(
			'email' => array(
				'rule' => array('email'),
				//'message' => 'Your custom message here',
				'allowEmpty' => true,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'country_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'prefecture_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'home_country_id' => array(

		),
		'home_prefecture_id' => array(
			
		),
		'birthday' => array(
			'date' => array(
				'rule' => array('date'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'sex' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'referer_company_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'inf_contract_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				'allowEmpty' => true,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'join_possible_date' => array(
			'date' => array(
				'rule' => array('date'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'mynavi_id' => array(
			'isUnique' => array(
				'rule' => array('isUnique'),
				//'message' => 'Your custom message here',
				'allowEmpty' => true,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'rikunavi_id' => array(
			'isUnique' => array(
				'rule' => array('isUnique'),
				//'message' => 'Your custom message here',
				'allowEmpty' => true,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'status' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'last_modified_type' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'inf_staff_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'rec_recruiter_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'updatable_flag' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'lock_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'student_regist_date' => array(
			'datetime' => array(
				'rule' => array('datetime'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'student_modified_date' => array(
			'datetime' => array(
				'rule' => array('datetime'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'last_login_date' => array(
			'date' => array(
				'rule' => array('date'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

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
			'conditions' => 'RecCompany.status = 0',
			'fields' => '',
			'order' => ''
		),
		'Country' => array(
			'className' => 'Country',
			'foreignKey' => 'country_id',
			'conditions' => 'Country.status = 0',
			'fields' => '',
			'order' => ''
		),
		'Prefecture' => array(
			'className' => 'Prefecture',
			'foreignKey' => 'prefecture_id',
			'conditions' => 'Prefecture.status = 0',
			'fields' => '',
			'order' => ''
		),
		'Country' => array(
			'className' => 'Country',
			'foreignKey' => 'home_country_id',
			'conditions' => 'Country.status = 0',
			'fields' => '',
			'order' => ''
		),
		'Prefecture' => array(
			'className' => 'Prefecture',
			'foreignKey' => 'home_prefecture_id',
			'conditions' => 'Prefecture.status = 0',
			'fields' => '',
			'order' => ''
		),
		'RefererCompany' => array(
			'className' => 'RefererCompany',
			'foreignKey' => 'referer_company_id',
			'conditions' => 'RefererCompany.status = 0',
			'fields' => '',
			'order' => ''
		),
		'InfContract' => array(
			'className' => 'InfContract',
			'foreignKey' => 'inf_contract_id',
			'conditions' => 'InfContract.status != 9',
			'fields' => '',
			'order' => ''
		),
		'InfStaff' => array(
			'className' => 'InfStaff',
			'foreignKey' => 'inf_staff_id',
			'conditions' => 'InfStaff.status = 0',
			'fields' => '',
			'order' => ''
		),
		'RecRecruiter' => array(
			'className' => 'RecRecruiter',
			'foreignKey' => 'rec_recruiter_id',
			'conditions' => 'RecRecruiter.status = 0',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'CanCustomAttribute' => array(
			'className' => 'CanCustomAttribute',
			'foreignKey' => 'can_candidate_id',
			'dependent' => false,
			'conditions' => 'CanCustomAttribute.status = 0',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'CanDocument' => array(
			'className' => 'CanDocument',
			'foreignKey' => 'can_candidate_id',
			'dependent' => false,
			'conditions' => 'CanDocument.status = 0',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'CanEducation' => array(
			'className' => 'CanEducation',
			'foreignKey' => 'can_candidate_id',
			'dependent' => false,
			'conditions' => 'CanEducation.status = 0',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'CanLanguage' => array(
			'className' => 'CanLanguage',
			'foreignKey' => 'can_candidate_id',
			'dependent' => false,
			'conditions' => 'CanLanguage.status = 0',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'CanNotice' => array(
			'className' => 'CanNotice',
			'foreignKey' => 'can_candidate_id',
			'dependent' => false,
			'conditions' => 'CanNotice.status = 0',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'CanQualification' => array(
			'className' => 'CanQualification',
			'foreignKey' => 'can_candidate_id',
			'dependent' => false,
			'conditions' => 'CanQualification.status = 0',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'EvHistory' => array(
			'className' => 'EvHistory',
			'foreignKey' => 'can_candidate_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'MlSendHistory' => array(
			'className' => 'MlSendHistory',
			'foreignKey' => 'can_candidate_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'SelHistory' => array(
			'className' => 'SelHistory',
			'foreignKey' => 'can_candidate_id',
			'dependent' => false,
			'conditions' => 'SelHistory.status = 0',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'CanSelJob' => array(
			'className' => 'CanSelJob',
			'foreignKey' => 'can_candidate_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
	);
    
	/*
	*  before filter
	*/
    public function beforeSave( $options = array() )
    {
    	// ユーザー企業IDの自動登録
        $userinfo = $this->getUserInfo();
        $this->data[$this->alias]['rec_company_id'] = $userinfo["rec_company_id"];
        
        //ロックフラグを解除状態に設定
        if(empty($this->data[$this->alias]['lock_role_flag'])){
            $this->data[$this->alias]['lock_role_flag'] = 0;
            $this->data[$this->alias]['lock_id'] = NULL;
        }

        // unique idの作成（送られてこない場合のみ作成）
        if (empty( $this->data[$this->alias]['unique_id'] ) ) {
            $this->data[$this->alias]['unique_id'] = $this->getUniqueId();
        }

        //ログインしているユーザ毎に最終更新者タイプを自動で設定
        $userInfo = $this->getUserInfo();

        switch($userInfo['role_type']){
            case ROLE_TYPE_RECRUITER:
                //ログインしているユーザが採用担当者の場合のみ採用担当者Idを最終更新採用担当者IDに設定
                $this->data[$this->alias]['rec_recruiter_id'] = $userInfo['id'];
                $this->data[$this->alias]['last_modified_type'] = 1;
                break;
            case ROLE_TYPE_REFERER:
                //ログインしているユーザが流入元担当者の場合のみ流入元担当者Idを最終更新流入元担当者IDに設定
                $this->data[$this->alias]['inf_staff_id'] = $userInfo['id'];
                $this->data[$this->alias]['last_modified_type'] = 0;
                break;
            default :
                //上記以外の場合は候補者が更新したので最終更新者タイプを候補者にセット
                $this->data[$this->alias]['last_modified_type'] = 2;
                break;
        }
        
        //学生登録日時の設定
        if(empty( $this->data[$this->alias]['id'] ) ){
            $this->data[$this->alias]['student_regist_date'] = date('Y-m-d H:i:s');
        }
        //学生更新日時の設定
        $this->data[$this->alias]['student_modofied_date'] = date('Y-m-d H:i:s');
        
        return;
    }
    
    /**
     *  データの変更をしようとした際に、変更しようしているデータが自社のデータか確認
     *　一件のみ使用可
     * @param int $id
     * @return booleam
     */
    public function isUses($id = NULL){
        switch($this->getUserInfo('role_type')){
            
            case ROLE_TYPE_RECRUITER:
                return $this->checkUseRecruiter( $id );
            
            case ROLE_TYPE_REFERER:
                $reslut = $this->checkRefererCompanyId($id);
                return $reslut;
            
            default:
                return false; 
        }
    }
    
    /**
     * データの変更をしようとした際に、変更しようとしているデータがロックされているか確認
     *　一件のみ使用可
     * @param int $id
     * @return booleam
     */
    public function isEdit( $id )
    {
        $id = (int) $id;
        
        return (bool) $this->find('count',array(
            'conditions' => array(
                'CanCandidate.id' => $id ,
                'or'=>array(
                    'and' => array(
                        'CanCandidate.lock_role_flag' => $this->getLockRoleType() ,
                        'CanCandidate.lock_id' => $this->getUserInfo('id') ,
                    ),
                    'CanCandidate.lock_role_flag' => 0 ,
                )
            )
        ));
        
    }
    
    /**
     * 
     * setLockFlag
     * ロックをONにする処理
     * 
     * @param int
     * @return bool
     * 
     **/
    public function setLockFlag( $id )
    {        
        $data['id'] = $id;
        $data['lock_role_flag'] = $this->getLockRoleType();
        $data['lock_id'] = $this->getUserInfo('id');
        
        return $this->save($data);
    }
    
    /**
     * 
     * setLockFlgMany
     * 
     * 【CSV保存専用】
     * 複数のデータに対して一度にロックを行う処理
     * unLockIDにロックが取得できなかったIDが保存される
     * 
     * @param  array
     * @param  bool     リクナビのIDの場合、true マイナビの場合 false
     *
     * @return array
     * 
     **/
    public function setCSVLockFlg( $ids, $naviKey )
    {
        //ロックが取れないデータ
        $this->getUnLockId( $ids, $naviKey );
        
        //同じ件数であれば、既にすべてロックされている状態になっているので処理終了
        if ( count ( $ids ) === count( $this->unLockID ) ) return true;
        
        //ロック実行処理
        $this->setCSVLock( $ids, $naviKey);
        
        return true;
    }

    /**
     * 
     * setUnlockFlgMany
     * 
     * 【CSV保存専用】
     * 複数のデータに対して一度にロックを行う処理
     * LockIDにロックが取得できなかったIDが保存される
     * 
     * @param  array
     * @param  bool     リクナビのIDの場合、true マイナビの場合 false
     *
     * @return array
     * 
     **/
    public function unsetCSVLockFlg( $ids, $naviKey )
    {
        //ロックが取れないデータ
        $this->getLockId( $ids, $naviKey );
        //ロック実行処理
        $this->unsetCSVLock( $ids, $naviKey);
        
        return true;
    }

    /**
     * 
     * ロックできなかったデータを取得する(CSV用）
     * 
     * @return array
     * 
     ***/
    public function getUnlockNaviID()
    {
        
        return $this->unLockID;
        
    }
    
    /**
     * 
     * ロックできなかったデータなのかを判断する
     * 
     * 
     * @params id
     * 
     * @return bool
     * 
     **/
    public function existsNaviID( $id )
    {
        
        return (bool) in_array( $id, $this->unLockID );
        
    }
    
    /**
     * 
     * 一覧などで利用するデータの検索条件を取得する
     * （採用担当者ロール用）
     * 
     * @return array
     * 
     **/
    public function getListDefaultConditions()
    {
        return array( 'conditions'=>array(
                            'CanCandidate.rec_company_id' => $this->getUserInfo('rec_company_id'),
                            'CanCandidate.status'=>0
                        )
                );
        
    }

    /**
    * イベント評価後スコア別　候補者×選考履歴リストアップ情報取得
    * 
    * @param  int    $rec_company_id
    * @param  array  $data
    * @return array  $result
    * 
    **/
    public function getHistByEvScore( $rec_company_id, $data )
    {	

    		if( $data['sel_check'] == 0 || !isset( $data['sel_check'] ) ) {
    			$str = 'LEFT JOIN can_sel_job ON can_candidates.id = can_sel_job.can_candidate_id 
    										  AND job_votes.id = can_sel_job.job_vote_id ';
    			$str_where = 'AND can_sel_job.sel_history_id IS NULL';

    		} else if( $data['sel_check'] == 1 ) {
    			$str = 'INNER JOIN can_sel_job ON can_candidates.id = can_sel_job.can_candidate_id 
    										  AND job_votes.id = can_sel_job.job_vote_id  ';
    			$str_where = '';
    		}
    			$param = array( $rec_company_id, $data['year'], $data['ev_event'], $data['after_score'] );


    	$sql = "
  			SELECT can_candidates.id, can_candidates.last_name, can_candidates.first_name, 
			       can_sel_job.screening_stage_id, 
   			       can_sel_job.select_status_id, ev_histories.after_score, 
			       job_votes.id, job_votes.title 
			FROM can_candidates 
			INNER JOIN ( SELECT ev_histories.can_candidate_id, ev_histories.ev_schedule_id, 
			             ev_histories.after_score 
			             FROM ev_histories ) as ev_histories 
			             ON can_candidates.id = ev_histories.can_candidate_id 
			INNER JOIN ev_schedules ON ev_histories.ev_schedule_id = ev_schedules.id 
			INNER JOIN ev_events ON ev_schedules.ev_event_id = ev_events.id 
			INNER JOIN job_votes ON ev_events.job_vote_id = job_votes.id 
			";
			
			$sql .= $str;

			$sql .= "WHERE ev_events.rec_company_id = ? 
			AND ev_events.status = 1 
			AND job_votes.status = 0
			AND can_candidates.status = 0
			AND job_votes.wanted_year = ? 
			AND ev_events.id = ? 
			AND ev_histories.after_score = ? 
    	";
    		$sql .= $str_where;
    	$result = $this->query( $sql, $param );

    	return $result;

    }
    


    /*-*-*-*-*-*-*-*-*-*- 以下　private　 -*-*-*-*-*-*-*-*-*-*/

    /**
     *
     * データにロックを行う処理
     *
     * @param  array    リクナビIDもしくは、マイナビIDの配列
     * @param  bool     リクナビのIDの場合、true マイナビの場合 false
     * 
     * @return bool
     *
     **/
    private function setCSVLock( $ids, $naviKey )
    {
    	if (count($ids) == 0) return;
        $query = 'UPDATE can_candidates SET lock_role_flag = 1 , lock_id = %d WHERE rec_company_id = %d AND lock_role_flag = 0 AND status = 0';
                 
        $id = implode("," ,$ids );
        
        $query.=" AND ".$naviKey." in ( %s )";
        
        $query = sprintf( $query, $this->getUserInfo('id'), $this->getUserInfo('rec_company_id') , $id );
        
        $this->query($query);
    
        return;
    }

    /**
     *
     * データのロックを解除する処理
     *
     * @param  array    リクナビIDもしくは、マイナビIDの配列
     * @param  bool     リクナビのIDの場合、true マイナビの場合 false
     * 
     * @return bool
     *
     **/
    private function unsetCSVLock( $ids, $naviKey )
    {    
    	if (count($ids) == 0) return;
        $query = 'UPDATE can_candidates SET lock_role_flag = 0 , lock_id = 0 WHERE rec_company_id = %d AND status = 0';

        $id = implode("," ,$ids );

        $query.=" AND ".$naviKey." in ( %s )";

        $query = sprintf( $query, $this->getUserInfo('rec_company_id') , $id );

        $this->query($query);

        return;
    }
    
    /**
     * 
     * getUnLockId
     * ロック済みのデータを取得する
     * 
     * @param  array    リクナビIDもしくは、マイナビIDの配列
     * @param  bool     リクナビのIDの場合、true マイナビの場合 false
     * 
     * @return bool
     **/
    private function getUnLockId( $ids , $naviKey )
    {
    
        $this->unLockID = array();
        
        $condition['CanCandidate.rec_company_id'] = $this->getUserInfo('rec_company_id');
        $condition['NOT']['CanCandidate.lock_role_flag'] = 0;
        $condition['NOT']['CanCandidate.lock_id'] = 0;
        $condition['NOT']['CanCandidate.lock_id'] = null;
        $condition['CanCandidate.status'] = 0;
                
        $display = $this->displayField;

        $condition['CanCandidate.'.$naviKey] = $ids;
        $this->displayField = $naviKey;

        $this->recursive = -1;
        
        $this->unLockID = $this->find( 'list',array( 'conditions'=>$condition ));
        $this->displayField = $display;
        
    }

    /**
     * 
     * getLockId
     * ロックしたデータを取得する
     * 
     * @param  array    リクナビIDもしくは、マイナビIDの配列
     * @param  bool     リクナビのIDの場合、true マイナビの場合 false
     * 
     * @return bool
     **/
    private function getLockId( $ids , $naviKey )
    {

        $this->LockID = array();
        
        $condition['CanCandidate.rec_company_id'] = $this->getUserInfo('rec_company_id');
        $condition['CanCandidate.lock_role_flag >='] = 1;
        $condition['CanCandidate.status'] = 0;
        
        $condition['lock_id'] = $this->getUserInfo('id');
        
        $display = $this->displayField;

        $condition['CanCandidate.'.$naviKey] = $ids;
        $this->displayField = $naviKey;

        $this->recursive = -1;
        
        $this->LockID = $this->find( 'list',array( 'conditions'=>$condition ));
        $this->displayField = $display;
        
    }
    
    
    
    /**
     * 
     * ログインユーザー（採用担当者）が該当する候補者データを利用できるかチェックする
     * 
     * 
     * 
     * 
     **/
    private function checkUseRecruiter( $id )
    {   
        $this->recursive = -1;
        return (bool) $this->find('count', array( 'conditions'=>
                        array( 
                                'CanCandidate.rec_company_id'=>$this->getUserInfo('rec_company_id'),
                                'CanCandidate.id'=>$id )
                        ));
    }


    /**
     *  流入元担当者がデータの変更をしようとした際に、変更しようしているデータが自社のデータか確認
     *　
     * @param int $id
     * @return booleam
     */
    private function checkRefererCompanyId($id = null){
        $checkRefererCompanyId = $this->getUserInfo('referer_company_id');
        return (boolean) $this->find('first',array(
            'fields' => array('CanCandidate.referer_company_id'),
            'conditions' => array(
                'CanCandidate.id' => $id ,
                'CanCandidate.referer_company_id' => $checkRefererCompanyId),
            )
        );
    }
    
    /**
     * 
     * 候補者をロックするときに利用するロックタイプの取得
     * 
     * @return int
     * 
     **/
    private function getLockRoleType()
    {
        switch($this->getUserInfo('role_type')){
            case ROLE_TYPE_RECRUITER:   //採用担当者
                return 1;
                break;
            case ROLE_TYPE_REFERER:   //流入元担当者
                return 2;
                break;
            default :
                return 0;
                break;
        }
    }
    
    /**
     * 
     * ユニークIDの作成
     * 
     * @return string
     * 
     **/
    private function getUniqueId()
    {

        // UniqueIDの作成
        while (true) {
            $uniqueId = $this->createRandomId();
            
            // '.'と'/'の削除 ８文字に満たなければもう一回取得
            $uniqueId = str_replace('/', '',$uniqueId);
            $uniqueId = str_replace('.', '',$uniqueId);
            if (strlen($uniqueId) < self::LENGTH_MIN_UNIQUE_ID){
                continue;
            }
            
            $result = $this->find('list', array( 'recursive' => -1, 'conditions' => array('unique_id' => $uniqueId ))) ;
            
            if ( empty( $result ) ) return $uniqueId;
            
        }
    }

    /**
     * check CanCandidate by rec_company_id
     * @param null $id
     * @return bool
     */
    public function checkRecCompanyId($id = NULL)
    {

        $this->recursive = 1;
        return (boolean) $this->find('first',array(
                'conditions' => array(
                    'CanCandidate.id' => $id ,
                    'CanCandidate.rec_company_id' => $this->getUserInfo('rec_company_id'),
                    'CanCandidate.status'=>0,
                    'RecCompany.status' => 0),
            )
        );
    }
}
