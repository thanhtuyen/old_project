<?php
App::uses('AppModel', 'Model');
App::uses('CanCandidate', 'Model');
App::uses('CanEducation', 'Model');
App::uses('RefererCompany', 'Model');
App::uses('Prefecture', 'Model');
App::uses('EvHistory', 'Model');
/**
 * CsvInport Model
 */
class CsvImport extends AppModel {

	// CSVカラム数
	const COULUMN_COUNT_RIKUNAVI    = 104;
	const COULUMN_COUNT_MYNAVI      = 57;

	const COULUMN_COUNT_EV_RIKUNAVI1 = 85;
	const COULUMN_COUNT_EV_RIKUNAVI2 = 101;
	const COULUMN_COUNT_EV_MYNAVI   = 54;

	const NAVIGATOR_TYPE_RIKUNAVI   = 7;
	const NAVIGATOR_TYPE_MYNAVI     = 8;

	public $useTable = false;
	public $errorMessege = "";
	public $joinPossibleDate = "";
	public $csvFileData = array();
	public $naviKey = "";
	public $naviType = 0;
	public $naviIds = array();
	public $errors = array();

  function __construct()
  {
    parent::__construct();
	    $this->CanCandidate = new CanCandidate();
	    $this->CanEducation = new CanEducation();
	    $this->RefererCompany = new RefererCompany();
	    $this->Prefecture   = new Prefecture();
	    $this->EvHistory    = new EvHistory();
  }

	/*
	* 登録されたファイルのエンコード変換
	*/
	public function fileEncode($fileData) {
		$res = array();

		$buf = mb_convert_encoding(file_get_contents($fileData), 'utf-8', 'shift-jis');
		$tmp = tmpfile();
		fwrite($tmp, $buf);
		rewind($tmp);
		while($line = fgetcsv($tmp)) {
			$res[] = $line;
		}
		fclose($tmp);

		return $res;
	}
	/**
	* カラム名の格納
	* @param int
	* @return int 
	*/
	public function checkNavigator($naviType) {
		switch ((int)$naviType) {
			case self::NAVIGATOR_TYPE_RIKUNAVI:
				$this->naviKey = 'rikunavi_id';
				break;
			case self::NAVIGATOR_TYPE_MYNAVI:
				$this->naviKey = 'mynavi_id';
				break;
			default:
				return false;
				break;
		}
		return $this->naviType = (int)$naviType;
	}
	/**
	* DB登録用にCSVデータの変換
	*
	* @param array $csvData
	* @param array $dataList
	* @param int $navigator
	* @return array
	*/
	public function candidateConverter($csvData, $dataLists, $navigator, $isEvent = false) {

        if ($navigator == self::NAVIGATOR_TYPE_RIKUNAVI) {
            $record = $this->rikunaviConverter($csvData, $dataLists, $isEvent);
        } else {
            $record = $this->mynaviConverter($csvData, $dataLists, $isEvent);
        }
        return $record;
	}
	/**
	* setCsvFile
	* @param mixed
	*/
	public function setCsvFile($csvFile) {
		$this->csvFileData = $csvFile;
	}

	/**
	* getCsvFile
	* @param mixed
	* @return mixed
	*/
	public function getCsvFile( $name = null　) {
		if (!empty($name)) {
			if (isset($this->csvFileData[$name])){
				return $this->csvFileData[$name];
			}
			return false;
		}
		return $this->csvFileData;
	}

	/**
	* ファイル型式チェック
	* @return mixed
	*/
	public function isFileError() {

		$fileName = $this->getCsvFile('name');
		// ファイル形式の確認
		$file_type = pathinfo($fileName, PATHINFO_EXTENSION);
		if ($file_type !== "csv") {
			$this->errorMessege = "ファイル形式がCSV型式ではありません。";
			return true;
		}

		return false;
	}

	/**
	* setErrorMessege
	* ファイル形式等データ構造上のエラーに使用
	* @param mixed
	*/
	public function setErrorMessege($messege) {
		$this->errorMessege = $messege;
	}

	/**
	* getErrorMessege
	* ファイル形式等データ構造上のエラーに使用
	* @param string
	* @return mixed
	*/
	public function getErrorMessege() {
		return $this->errorMessege;
	}

	/**
	* setJoinPossibleDate
	* @param mixed
	*/
	public function setJoinPossibleDate($joinPossibleDate) {
		$this->joinPossibleDate = date('Y/m/d', strtotime($joinPossibleDate));
	}

	/**
	* getJoinPossibleDate
	* @return mixed
	*/
	public function getJoinPossibleDate() {
		return $this->joinPossibleDate;
	}

	/**
	* getErrors
	* 出力用エラーメッセージ用
	* @return mixed
	*/
	public function getErrors() {
		return $this->errors;
	}

	/**
	* 出力用のエラーをセットする
	* @param line     integer
	* @param name     String
	* @param messege  String
	**/
	public function setErrors($line, $name, $csv, $messege) {
		$this->errors[$line] = array(
			'name'    => $name,
			'messege' => $messege,
			'csv' 	  => $csv
		);
	}

	/**
	* convertSexToId
	* @param string
	* @return mixed
	*/
	public function convertSexToId($sex) {
		$baseSex = Configure::read('sex');
		foreach ($baseSex as $key => $name) {
			if (preg_match('/'.$name.'/', $sex)){
				return $key;
			}
			if ($name == "不明")	{
				$unknown = $key;
			}
		}
		return $unknown;
	}

	/**
	* getPrefectureIsoId
	*
	* @param Array
	* @param string
	* @return int
	*/
	public function getPrefectureIsoId($dataLists, $name) {

		$word = "/".$name."/";
		$prefecture = preg_grep($word, $dataLists);
		return key($prefecture);
	}

	/**
	* 存在している候補者のIDを取得
	*
	* @param　mixed
	*/
	public function getExistCandidates() {

		// 存在しているデータの取得
		return $this->CanCandidate->find('list',array(
				'recursive'  => -1,
				'conditions' => array(
					$this->naviKey  => $this->naviIds
					),
				'fields'     => array('id', $this->naviKey),
			)
		);
	}

	/**
	* 存在済みのデータにCanCandidate.idを追加
	* @param  mixed
	* @return array
	*/
	public function releaseLockRecord($data, $unLockId) {

		$saveCandidates = array();

		foreach ($data as $key => $candidate) {
			
			// 登録・更新しないレコードを解放
			if ($this->isReleaseRecord($candidate, $unLockId)) {
				continue;
			}
			$saveCandidates[] = $candidate;
		}
		return $saveCandidates;
	}

	/**
	* 登録更新しないデータのチェック
	*
	* @param array $record
	* @param array $unLockId
	* @return boolean
	*/
	private function isReleaseRecord($record, $unLockId) {
		// ロックがかかっていればtrue
		if ( array_search($record['CanCandidate'][$this->naviKey], $unLockId) ) {
			$name = $record['CanCandidate']['last_name']. " " .$record['CanCandidate']['first_name'];
			$this->setErrors($record['line'], $name, $record['csv_record'], "このデータはロックされています。");
			return true;
		}
		return false;
	}

    /**
    * eventCsvSave
    * @param mixed candidate
    * @param int   scheduleId
    * @param int   status
    **/
    public function eventCsvSave($candidate, $scheduleId, $status ) {

        $result = 0;
        $datasource = $this->getDataSource();
    	try{
    		$datasource->begin();
    		// 存在チェック
    		$candidate = $this->isExsistCandidate($candidate);
    		// 候補者関連保存
            $this->CanCandidate->create();
            $res = $this->CanCandidate->saveAssociated($candidate);

            if (empty($res)) {
            	throw new Exception('candidate save faild.');
            }
    		// 候補者検索（ID）
			$cand = $this->getCandidateByNaviId($candidate['CanCandidate'][$this->naviKey]);

			// イベント参加履歴存在チェック 
			$history = $this->EvHistory->find('first', array(
					'recursive' => -1,
					'conditions' => array(
						'ev_schedule_id' => $scheduleId,
						'can_candidate_id' => $cand['CanCandidate']['id']
					),
					'fields' => array( 'id' )
				));

			// 整形
			if (empty($history)) {
				$evHistory = $this->trimEvHistory($cand['CanCandidate'], $scheduleId, $status);
			} else {
				$tmpStatus = array('status' => $status);
				$evHistory = array_merge( $history, $tmpStatus );
			}
			// 保存
			$this->EvHistory->create();
            $res = $this->EvHistory->save($evHistory);
            if (empty($res)) {
            	throw new Exception('ev_history save faild.');
            }
            $result = 1;
			$datasource->commit();
		}catch (Exception $e){
			$datasource->rollback();

            $candidateName = $candidate['CanCandidate']['last_name']."　".$candidate['CanCandidate']['first_name']; 
            $this->setErrors($candidate['line'], $candidateName, $candidate['csv_record'], "データが不足しているか、データ形式が異なっています。");
		}

   		return $result;

    }
/*
*  使用するデータを取得
*/
    public function getDataLists(){

        $userCompanyId = $this->getUserInfo('rec_company_id');

        $referercompany = $this->RefererCompany->find('first', array(
		        	'recursive' => -1,
		        	'conditions' => array(
		        		'rec_company_id' => $userCompanyId,
		        		'influx_original_type' => $this->naviType,
	        		),
	        		'fields'	=> array('id')
        	)
       	);
        // 都道府県
        $prefectures = $this->Prefecture->find('list', array(
                    'recursive'  => -1,
                    'fields'     => array('iso_id','name')
                )
            );
        // 学校
        $schools = $this->CanEducation->School->find('list', array(
                    'recursive'  => -1,
                    'conditions' => array('rec_company_id' => $userCompanyId),
                    'fields'     => array('name')
                )
            );

        // 学部
        $undergraduates = $this->CanEducation->Undergraduate->find('list', array(
                    'recursive'  => -1,
                    'conditions' => array('rec_company_id' => $userCompanyId),
                    'fields'     => array('name')
                )
            );

        return compact('prefectures', 'schools', 'undergraduates', 'referercompany');

    }
    /**
    * isExsistCandidate
    * @param mixed
    * @return mixed
    **/
    public function isExsistCandidate($candidate){

    	$cand = $this->getCandidateByNaviId($candidate['CanCandidate'][$this->naviKey]);
    	if (!empty($cand)) {
	    	$candidate['CanCandidate']['id'] = $cand['CanCandidate']['id'];
	    	$candidate['CanEducation'][0]['id'] = $cand['CanEducation'][0]['id'];
    	}
    	return $candidate;
    }

    /*-*-*-*-*-*-*-*-*-*- 以下　private　 -*-*-*-*-*-*-*-*-*-*/




    /**
    * trimEvHistory
    * @param mixed
    * @param int
    * @param int
    * @return mixed
    **/
    private function trimEvHistory($cand, $scheduleId, $status){
    	return $res['EvHistory'] = array(
    		'can_candidate_id' => $cand['id'],
    		'ev_schedule_id'   => $scheduleId,
    		'status'           => $status,
   		);

    }

    /**
    * getCandidateByNaviId
    * @param  int
    * @return mixed
    **/
    private function getCandidateByNaviId($naviId){

		return $this->CanCandidate->find('first', array(
						'recursive'  => -1,
						'contain'   => array('CanEducation'),
						'conditions' => array(
							'CanCandidate.'.$this->naviKey => $naviId,
						)
					)
				);
    }


    /**
    * 項目数の可変に対応する処理
    * 
    * 
    **/
    private function createIndex($csv, $conf) {
    	$idx = array();
    	foreach ($conf as $key => $value){
    		foreach($csv as $column => $title) {
    			$pattern = "*".$value."*";
    			if (preg_match($pattern, $title)) {
    				$idx[$key] = $column;
    				continue 2;
    			}
    		}
    	}
    	return $idx;
    }


	/**
	* mynaviConverter
	* @param mixed 
	* @return array
	*/
	private function mynaviConverter($csvData, $dataLists, $isEvent) {

		$cnt = 0;
		$candidates = array();
		$educations = array();
		$data = array();
		$columns = Configure::read('mynavi_replace_candidate');
		$bunri = Configure::read('bunri_class');
		foreach ($csvData as $line => $value) {
			$cnt++;
			if ($cnt === 1){
				$conf = Configure::read('mynavi_csv_index');
				$idx = $this->createIndex($value, $conf);
				if (!isset($idx[0])) {
					$this->setErrorMessege('入力情報に誤りがあります。');
					return false;
				}
				// 最初はカラム名なのでスキップ
				continue;
			}
			$candidate = array();
			$education = array();

			// エラー格納
			if (empty($value[$idx[0]])) {
				$candidateName = $value[$idx[1]] . "　" . $value[$idx[2]];
				$this->setErrors($line, $candidateName, implode(',', $value), "学生管理IDが入っていません。");
				continue;
			}

			// 候補者
			foreach ($columns as $key => $name) {
				if (empty($value[$idx[$key]])){
					continue;
				}
				$candidate[$name] = $value[$idx[$key]];
			}
			//  加工が必要なもの
			$candidate['mynavi_id'] 			= $this->naviIds[] = $value[$idx[0]];
			$candidate['status'] 				= 0;
			$candidate['rec_recruiter_id'] 		= $this->getUserInfo('id');
			$candidate['residence'] 			= $value[$idx[23]].$value[$idx[24]].$value[$idx[25]].$value[$idx[26]];
			$candidate['home_residence'] 		= $value[$idx[33]].$value[$idx[34]].$value[$idx[35]].$value[$idx[36]];
			$candidate['rec_company_id']		= $this->getUserInfo('rec_company_id');
			$candidate['prefecture_id']			= $this->getPrefectureIsoId($dataLists['prefectures'], $value[$idx[22]]); 
			$candidate['join_possible_date']	= $this->getJoinPossibleDate();
			$candidate['sex']					= $this->convertSexToId($value[$idx[7]]);
			$candidate['referer_company_id']	= $dataLists['referercompany']['RefererCompany']['id'];
			empty($value[$idx[41]])? : $candidate['student_regist_date']   = $this->toDateTime($value[$idx[41]]);
			empty($value[$idx[43]])? : $candidate['student_modified_date']	= $this->toDateTime($value[$idx[43]]);

			// 学歴
			$education['department'] 				= $value[$idx[13]];
			$education['student_bunri_class_id'] 	= array_search($value[$idx[15]], $bunri);
			$education['manage_bunri_class_id'] 	= array_search($value[$idx[16]], $bunri);
			$education['seminar'] 					= $value[$idx[17]];
			$education['major_theme'] 				= $value[$idx[18]];
			$education['circle'] 					= $value[$idx[19]];

			$schoolId = array_search($value[$idx[11]], $dataLists['schools']);
			if ($schoolId) {
				$education['school_id'] = $schoolId;
			} else {
				$education['school']    = $value[$idx[11]];
				$education['school_id'] = 0;
			}

			$undergraduateId = array_search($value[$idx[12]], $dataLists['undergraduates']);
			if ($undergraduateId) {
				$education['undergraduate_id'] = $undergraduateId;
			} else {
				$education['undergraduate']    = $value[$idx[12]];
				$education['undergraduate_id'] = 0;
			}
			if ($isEvent) {
				$data['ev_status'] = $this->getMynaviEvStatus($value[$idx[51]]);
			}
			$data['CanCandidate']    = $candidate;
			$data['CanEducation'][0] = $education;
			$data['csv_record']      = implode(',', $value);
			$data['line']            = $cnt-1;
			$candidates[]            = $data;
		}

		return $candidates;
	}

	/**
	* rikunaviConverter
	* @param mixed 
	* @return array
	*/
	private function rikunaviConverter($csvData, $dataLists, $isEvent) {

		$cnt = 0;
		$candidates = array();
		$education = array();
		$columns = Configure::read('rikunavi_replace_candidate');
		$bunri = Configure::read('bunri_class');
		foreach ($csvData as $line => $value) {
			$cnt++;
			if ($cnt === 1){
				$conf = Configure::read('rikunavi_csv_index');
				$idx = $this->createIndex($value, $conf);
				if (!isset($idx[0])) {
					$this->setErrorMessege('入力情報に誤りがあります。');
					return false;
				}
				continue;
			}
			$candidate = array();
			$education = array();
			// エラー格納
			if (empty($value[$idx[0]])) {
				$candidateName = $value[$idx[1]] . "　" . $value[$idx[2]];
				$this->setErrors($line, $candidateName, implode(',', $value), "個人IDが入っていません。");
				continue;
			}
			// 候補者
			foreach ($columns as $key => $name) {
				if (empty($value[$idx[$key]])){
					continue;
				}
				$candidate[$name] = $value[$idx[$key]];
			}
			//  加工が必要なもの
			$candidate['rikunavi_id'] 			= $this->naviIds[] = $value[$idx[0]];
			$candidate['status'] 				= 0;
			$candidate['rec_recruiter_id'] 		= $this->getUserInfo('id');
			$candidate['residence'] 			= $value[$idx[15]].$value[$idx[16]].$value[$idx[17]];
			$candidate['home_residence'] 		= $value[$idx[25]].$value[$idx[26]].$value[$idx[27]];
			$candidate['rec_company_id']		= $this->getUserInfo('rec_company_id');
			$candidate['prefecture_id']			= $this->getPrefectureIsoId($dataLists['prefectures'], $value[$idx[14]]); 
			$candidate['home_prefecture_id']	= $this->getPrefectureIsoId($dataLists['prefectures'], $value[$idx[24]]); 
			$candidate['join_possible_date']	= $this->getJoinPossibleDate(); 
			$candidate['sex']					= $this->convertSexToId($value[$idx[11]]);
			$candidate['referer_company_id']	= $dataLists['referercompany']['RefererCompany']['id'];


			// 学歴
			$education['department'] 				= $value[$idx[38]];
			$education['student_bunri_class_id'] 	= array_search($value[$idx[40]], $bunri);
			$education['manage_bunri_class_id'] 	= array_search($value[$idx[41]], $bunri);
			$education['seminar'] 					= $value[$idx[42]];
			$education['major_theme'] 				= $value[$idx[46]].$value[$idx[43]].$value[$idx[44]];
			$education['circle'] 					= $value[$idx[47]];
			$education['admission_date'] 			= date('Y/m/d', strtotime($value[$idx[30]]));
			$education['graduation_year'] 			= $value[$idx[31]];

			$schoolId = array_search($value[$idx[36]], $dataLists['schools']);
			if ($schoolId) {
				$education['school_id'] = $schoolId;
			} else {
				$education['school'] 	 = $value[$idx[36]];
				$education['school_id']  = 0;
			}

			$undergraduateId = array_search($value[$idx[37]], $dataLists['undergraduates']);
			if ($undergraduateId) {
				$education['undergraduate_id'] = $undergraduateId;
			} else {
				$education['undergraduate']    = $value[$idx[37]];
				$education['undergraduate_id'] = 0;
			}
			if ($isEvent) {
				$data['ev_status'] = $this->getRekunaviEvStatus($value[$idx[68]]);
			}
			$data['CanCandidate']    = $candidate;
			$data['CanEducation'][0] = $education;
			$data['csv_record']      = implode(',', $value);
			$data['line']            = $cnt-1;
			$candidates[] = $data;
		}

		return $candidates;
	}


	/**
	* リクナビ用参加履歴のステータス更新用
	*
	* @param string
	* @return int
	**/
	private function getRekunaviEvStatus($ev_status) {
		if ($ev_status == "予約"){
			// 予約済み
			return 0;
		}elseif ($ev_status == "キャンセル"){
			// キャンセル
			return 2;
		}
	}

	/**
	* マイナビ用参加履歴のステータス更新用
	*
	* @param int
	* @return int
	**/
	private function getMynaviEvStatus($ev_status) {
		if ($ev_status == 0){
			// 予約済み
			return 0;
		}elseif ($ev_status == 1){
			// キャンセル
			return 2;
		}
	}



	/**
	*
	*
	*
	*
	*
	*/
	private function getCanEducationId($candidate) {


		$conditions = array();
		$conditions['CanEducation.can_candidate_id'] = $candidate['CanCandidate']['id'];

		if ($candidate['CanEducation'][0]['school_id'] != 0)
		{
			$conditions['CanEducation.school_id']   = $candidate['CanEducation'][0]['school_id'];
		}else{
			$conditions['CanEducation.school LIKE'] = $candidate['CanEducation'][0]['school'];
		}

		$res = $this->CanEducation->find('first', array( 
				'recursive' => -1,
				'conditions' => $conditions,
				'fields' => array('id')
			)
		);

		return $res["CanEducation"][0]["id"];

	}

}
