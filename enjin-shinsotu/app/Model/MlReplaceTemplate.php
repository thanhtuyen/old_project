<?php
App::uses('AppModel', 'Model');
App::uses('MailTemplate', 'Model');
App::uses('SystemMailTemplate', 'Model');
App::uses('RecRecruiter', 'Model');
App::uses('RecDepartment', 'Model');
App::uses('CanCandidate', 'Model');
App::uses('InfStaff', 'Model');
App::uses('EvEvent', 'Model');
App::uses('SelHistory', 'Model');

/**
 * MlReplaceTemplate Model
 *
 * @property EvEvent $EvEvent
 * @property JobVote $JobVote
 * @property ScreeningStage $ScreeningStage
 * @property Purpose $Purpose
 * @property RecCompany $RecCompany
 * @property RecRecruiter $RecRecruiter
 * @property MlAttachment $MlAttachment
 * @property MlSendHistory $MlSendHistory
 */
class MlReplaceTemplate extends AppModel {
	public $useTable = false;
	public $replaceInfo = array();
	public $actsAs = array('Containable');

	public function __get($name){
		return " ";
	}

	/**
	* テンプレート内の設定文字列を置換して返す
	*/
	public function replaceTemplate($sendHistory, $selHistoryId) {

		$this->replaceInfo = array();

		// メールテンプレートの呼び出し
		$mailTemplate = $this->setMailTemplate($sendHistory);

		if ( empty($mailTemplate) ||
			( $sendHistory['mail_template_id'] > 0 && $mailTemplate['rec_company_id'] != $this->getUserInfo('rec_company_id'))) {
			return array();			
		}

		$this->setReplaceInfo($sendHistory, $mailTemplate, $selHistoryId);

		$rplMessage = array();
		$message = array('subject' => $mailTemplate['subject'], 'body' => $mailTemplate['body']);
		foreach ($message as $target => $text) {
			$rplMessage[$target] =  $this->replaceWord($sendHistory,  $text);
		}
		return $rplMessage;
	}
	/*
	* テンプレートを呼び出して置換元のメッセージをセットする
	*/
	private function setMailTemplate($sendHistory){

		if ($sendHistory['mail_template_id'] > 0){
			$this->MailTemplate = new MailTemplate();
			$this->MailTemplate->recursive = -1;
			$tmpTemplate = $this->MailTemplate->findById($sendHistory['mail_template_id']);
			$mailTemplate = (empty($tmpTemplate))? array() : $tmpTemplate['MailTemplate'];
		}else{
			$this->SystemMailTemplate = new SystemMailTemplate();
			$this->SystemMailTemplate->recursive = -1;
			$tmpTemplate = $this->SystemMailTemplate->findById($sendHistory['system_mail_template_id']);
			$mailTemplate = (empty($tmpTemplate))? array() :$tmpTemplate['SystemMailTemplate'];
		}
		return $mailTemplate; 
	}

	/**
	* 置換内容のデータ取得
	* @param array sendHistory 
	* @return array
	*
	*/
	private function setReplaceInfo($sendHistory, $mailTemplate, $selHistoryId) {

		$refererInfo = array();
		if (!empty($sendHistory['inf_staff_id'])) {
			$refererInfo   = $this->getRefererInfo($sendHistory['inf_staff_id']);
		}
		$eventInfo = array();
		if ( $sendHistory['mail_template_id'] > 0 ) {
			$eventInfo     = $this->getEventInfo($mailTemplate);
		}

		$candidateInfo = $this->getCandidateInfo($sendHistory['can_candidate_id']);
		$recruiterInfo = $this->getRecruiterInfo($sendHistory['rec_recruiter_id']);
		$historyInfo   = $this->getSelHistoryInfo($selHistoryId);
		$senderInfo['Sender']    = $this->getUserInfo();

		$this->replaceInfo = array_merge($candidateInfo, $recruiterInfo, $refererInfo, $eventInfo, $historyInfo, $senderInfo);
	}

	/**
	* 文字列の置換処理を行う
	* @return string
	*/
	private function replaceWord($sendHistory, $message = null){

		$replaceWords = Configure::read('replace_word');

		foreach ($replaceWords as $key => $word) {
			if (!strstr($message, $word)) {
				continue;
			}
			// 置換単語の抽出
			$replace = $this->wordReplace($key);
			// 置換処理
			$message = str_replace($word, $replace, $message);
		}
		return $message;
	}

	/**
	* 置換後の文字列を返す
	* 
	*
	**/
	private function wordReplace($key) {
			switch ($key) {
				case 0: //候補者名
					return $this->createName($this->replaceInfo['CanCandidate']['last_name'],
												  $this->replaceInfo['CanCandidate']['first_name'],
												  $this->replaceInfo['CanCandidate']['mid_name']);
					break;
				case 1: //大学名
					return $this->replaceInfo['CanEducation']['school'];
				case 2: //企業情報
					return $this->createCompanyInfo($this->replaceInfo['RecCompany']);
				case 3: //企業名
					return $this->replaceInfo['RecCompany']['company_name'];
				case 4: //親部署名(求人担当者)
					return $this->getParentDepartmentsName($this->replaceInfo['RecDepartment']); 
				case 5: //部署名
					return $this->replaceInfo['RecDepartment']['department_name'];
				case 6: //送信者情報
					return $this->createRecruiterInfo($this->replaceInfo['Sender']);
				case 7: //送信者名
					return $this->createName($this->replaceInfo['Sender']['last_name'], $this->replaceInfo['Sender']['first_name']);
				case 8: //送信者電話番号
					return $this->replaceInfo['Sender']['tel'];
				case 9: //送信者メールアドレス
					return $this->replaceInfo['Sender']['mail'];
				case 10: //求人担当者情報
					return $this->createRecruiterInfo($this->replaceInfo['RecRecruiter']);
				case 11: //求人担当者名
					return $this->createName($this->replaceInfo['RecRecruiter']['last_name'], $this->replaceInfo['RecRecruiter']['first_name']);
				case 12: //求人担当者メールアドレス
					return $this->replaceInfo['RecRecruiter']['mail'];
				case 13: //求人担当者電話番号
					return $this->replaceInfo['RecRecruiter']['tel'];
				case 14: //選考段階
					return $this->replaceInfo['ScreeningStage']['name'];
				case 15: //イベント情報
					return $this->createEventInfo();
				case 16: //イベント名
					return $this->replaceInfo['EvEvent']['name'];
				case 17: //イベント開催日時
					return $this->createEventDate('holding_date',$this->replaceInfo['EvSchedule']);
				case 18: //イベント終了日時
					return $this->createEventDate('end_date',$this->replaceInfo['EvSchedule']);
				case 19: //イベント開催場所
					return $this->createEventVenue($this->replaceInfo['EvSchedule']);
				case 20: //求人票名
					return $this->replaceInfo['JobVote']['title'];
				case 21: //流入元担当者名
					if (empty($this->replaceInfo['InfStaff'])){
						return "";
					}
					return $this->createName($this->replaceInfo['InfStaff']['last_name'], $this->replaceInfo['InfStaff']['first_name']);
				case 22: //流入元企業名
					if (empty($this->replaceInfo['RefererCompany'])){
						return "";
					}
					return $this->replaceInfo['RefererCompany']['name'];
				default:
					return '';
			}
	}

	/**
	* 姓名の結合メソッド
	* @param string
	* @param string
	* @param string
	* @return string
	*/
	private function createName($lastName, $firstName, $middleName = ""){
		if (empty($lastName) || empty($firstName)) return "";

		$middleName = (empty($middleName))? "" : $middleName." ";
		return $lastName." ".$middleName.$firstName;
	}

	/**
	* 企業情報の結合メソッド
	* @param array
	* @return string
	*/
	private function createCompanyInfo($company){
		if (empty($company)) return "";


		$companyInfo = $company['company_name']."\r\n"
						."代表電話番号：".$company['represent_tel']."\r\n"
						."代表メールアドレス：".$company['represent_mail'];

		return $companyInfo;
	}

	/**
	* 採用担当者情報の結合メソッド
	* @param string
	* @return string
	*/
	private function createRecruiterInfo($recruiter){
		if (empty($recruiter)) return "";

		$recruiterInfo = $recruiter['last_name'].' '.$recruiter['first_name']."\r\n"
					."TEL：".$recruiter['tel']."\r\n"
					."MAIL：".$recruiter['mail'];
		return $recruiterInfo;

	}

	/**
	* イベント情報の結合メソッド
	* @param string
	* @param string
	* @param string
	* @return string
	*/
	private function createEventInfo(){
		if (empty($this->replaceInfo['EvEvent'])) return "";

		$resInfo = $this->replaceInfo['EvEvent']['name']."\r\n";
		$lastVenue = "";
		foreach ($this->replaceInfo['EvSchedule'] as $schedule) {

			if ($lastVenue !== $schedule['venue']) {
				$lastVenue = $schedule['venue'];
				$resInfo .= "開催場所 ： ".$lastVenue."\r\n";
				$resInfo .= "開催日時 ： \r\n";
			}
			$resInfo .= $schedule['holding_date']." ～ ".$schedule['holding_date']."\r\n";

		}

		return $resInfo;
	}

	/**
	* イベント日付の結合メソッド
	* @param string
	* @param array
	* @return string
	*/
	private function createEventDate($keyName, $schedules){
		if (empty($schedules)) return "";
		$tmpDate = '';
		foreach ($schedules as $schedule) {
			$tmpDate[] = date('Y/m/d H:i:s', strtotime( $schedule[$keyName]));
		}
		$resDate = implode("\r\n", $tmpDate);
		return $resDate;

	}

	/**
	* イベント開催場所の結合メソッド
	* @param string
	* @return string
	*/
	private function createEventVenue($schedules){
		if (empty($schedules)) return "";
		foreach ($schedules as $schedule) {
			$tmpVenue[] = $schedule['venue'];
		}
		$resVenue = implode("\r\n", $tmpVenue);
		return $resVenue;

	}

    /**
    *  すべての親部署名を取得して、連結して返す
    *  @return String
    */
    private function getParentDepartmentsName($department) {
		if (empty($department)) return "";

    	$parentId = $department['parent_id'];
        if (empty($parentId)) {
            return '';
        }
        $this->RecDepartment = new RecDepartment;

        $option = array();
        $option['recursive'] = -1; 
        $option['fields'] = array('id', 'department_name', 'parent_id'); 

        $names = array();
        $existId[] = $department['id'];
        while (true) {
            
            $option['conditions'] = array('id' => $parentId );
	        $tmpDpt = $this->RecDepartment->find('first', $option);


	        $names[]   = $tmpDpt['RecDepartment']['department_name'];
	        $parentId  = $tmpDpt['RecDepartment']['parent_id'];
	        if (empty($tmpDpt['RecDepartment']['parent_id'])){
	        	break;
	        }
	        if (in_array($parentId, $existId)){
	        	break;
	        }
	        $existId[] = $tmpDpt['RecDepartment']['id'];
        }
        rsort($names);
        $resName = implode(" ", $names);
        return $resName;
    }

    /**
    * 採用担当者情報をDBから取得
	* @param int 
	* @return mixed 
    */
    private function getRecruiterInfo($id) {

        $this->RecRecruiter = new RecRecruiter;
        $option = array();

        $option['recursive'] =-1;
        $option['fields'] = array('*');
        $option['joins'][] = array(
            'type'       => 'LEFT',
            'table'      => 'rec_departments',
            'alias'      => 'RecDepartment',
            'conditions' => '`RecRecruiter`.`rec_department_id` = `RecDepartment`.`id`',
        );
        $option['joins'][] = array(
            'type'       => 'LEFT',
            'table'      => 'rec_companies',
            'alias'      => 'RecCompany',
            'conditions' => '`RecDepartment`.`rec_company_id` = `RecCompany`.`id`',
        );
        $option['conditions'] = array('RecRecruiter.id' => $id);

        return $this->RecRecruiter->find('first', $option);
    }
    
    /**
    * 候補者情報をDBからの取得
	* @return mixed 
    */
    private function getCandidateInfo($id) {

        $this->CanCandidate = new CanCandidate;
        $option = array();
        $option['recursive'] =-1;
        $option['fields'] = array('*');
        $option['joins'][] = array(
            'type'       => 'LEFT',
            'table'      => 'can_educations',
            'alias'      => 'CanEducation',
            'conditions' => '`CanCandidate`.`id` = `CanEducation`.`can_candidate_id`',
        );
        $option['joins'][] = array(
            'type'       => 'LEFT',
            'table'      => 'schools',
            'alias'      => 'School',
            'conditions' => '`CanEducation`.`school_id` = `School`.`id`',
        );
        $option['conditions'] = array('CanCandidate.id' => $id);

        return $this->CanCandidate->find('first', $option);

    }
    /**
    * 流入元担当者情報をDBからの取得
	* @return mixed 
    */
    private function getRefererInfo($id) {

        $this->InfStaff = new InfStaff;

        $option = array();
        $option['recursive'] =-1;
        $option['fields'] = array('*');
        $option['joins'][] = array(
            'type'       => 'LEFT',
            'table'      => 'referer_companies',
            'alias'      => 'RefererCompany',
            'conditions' => '`InfStaff`.`referer_company_id` = `RefererCompany`.`id`',
        );
        $option['conditions'] = array('InfStaff.id' => $id);

        return $this->InfStaff->find('first', $option);
    }


	/**
	* イベント情報の取得
	* @param array
	* @return mixed 
	*/
	private function getEventInfo($mailTemplate) {
        $this->EvEvent = new EvEvent;

        $this->EvEvent->Behaviors->load('Containable');
        $option = array();
        $option['recursive'] =-1;
        $option['fields']  = array('*');
        $option['contain'] = 'EvSchedule';
        $option['conditions'] = array('EvEvent.id' => $mailTemplate['ev_event_id']);

        return $this->EvEvent->find('first', $option);
	}

	/**
	* 選考段階情報をDBからの取得
	* @return mixed 
	*/
	private function getSelHistoryInfo($selHistoryId) {
        $this->SelHistory = new SelHistory;

        $option = array();
        $option['fields']  = array('*');
        $option['contain'] = array('JobVote', 'ScreeningStage');
        $option['recursive'] =-1; 
        $option['conditions'] = array('SelHistory.id' => $selHistoryId);

        return $this->SelHistory->find('first', $option);
	}

}