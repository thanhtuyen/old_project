<?php

/**
 * 
 * enjin 新卒　プロジェクト用　view　helper
 * 
 * 
 * 
 * 
 **/

App::uses('AppHelper', 'View/Helper');

class EnjinHelper extends AppHelper {
    public $helpers = array("Html");
    
    /**
     * 
     * getAfterScoreName
     * イベント参加履歴（参加後評価スコア）テキストの取得
     * 
     * @param int
     * @return string
     * 
     **/
    public function getAfterScoreName( $index = 0 )
    {
        return $this->getConfigIndexData( "after_score" , $index );
        
    }
    /**
     * 
     * getAddForeignLanguageName
     * 語学（外国語）テキストの取得
     * 
     * @param int
     * @return string
     * 
     **/
    public function getAddForeignLanguageName( $index = 0 )
    {
        return $this->getConfigIndexData( "add_foreign_language" , $index );
        
    }

    /**
     * 
     * getEvHistoryStatusName
     * イベント参加履歴（ステータス）テキストの取得
     * 
     * @param int
     * @return string
     * 
     **/
    public function getEvHistoryStatusName( $index = 0 )
    {
        return $this->getConfigIndexData( "ev_history_status" , $index );
        
    }

    /**
     * 
     * getSelStatusName
     * ステータステキストの取得
     * 
     * @param int
     * @return string
     * 
     **/
    public function getSelStatusName( $index = 0 )
    {
        return $this->getConfigIndexData( "select_judgment_type" , $index );
        
    }
    
    /**
     * 
     * getBunriClassName
     * 文理テキストの取得
     * 
     * @param int
     * @return string
     * 
     **/
    public function getBunriClassName( $index = 0 )
    {
        return $this->getConfigIndexData( "bunri_class" , $index );
        
    }
    
    /**
     * 
     * getAddLevelName
     * 語学レベルテキストの取得
     * 
     * @param int
     * @return string
     * 
     **/
    public function getAddLevelName( $index = 0 )
    {
        return $this->getConfigIndexData( "add_level" , $index );
        
    }

    
    /**
     * 
     * getQualificationsName
     * 資格テキストの取得
     * 
     * @param int
     * @return string
     * 
     **/
    public function getQualificationsName( $index = 0 )
    {
        return $this->getConfigIndexData( "qualifications" , $index );
        
    }
    
    /**
     * 
     * getFocalPointTypeName
     * 採用担当者/面接官の設定値の値を取得する
     * 
     * @param int
     * @return string
     * 
     **/
    public function getFocalPointTypeName( $index = 0 )
    {
        return $this->getConfigIndexData( "focal_point_type" , $index );
        
    }
    
    /**
     * 
     * getApprovalFlagName
     * 決裁者フラグの状況により、決裁者テキストを返す
     * 
     * @param int
     * @return string
     * 
     **/
    public function getApprovalFlagName( $index = 0 )
    {
        return $this->getConfigIndexData( "approval_flag" , $index );
        
    }
    
    /**
     * 
     * 性別テキストの取得
     * 
     * @param int
     * @return string
     * 
     **/
    public function getSexName( $index = 0 )
    {
        return $this->getConfigIndexData( "sex" , $index );
    }
    
    /**
     * 
     * 職種テキストの取得
     * 
     * 
     * @param int
     * @return string
     * 
     **/
    public function getJobTypeName( $index = 0 )
    {
        return $this->getConfigIndexData( "job_type" , $index );
        
    }
    
    /**
     * 
     * 職種テキストの取得
     * 
     * 
     * @param int
     * @return string
     * 
     **/
    public function getJudgmentTypeName( $index = 0 )
    {
        return $this->getConfigIndexData( "select_judgment_type" , $index );
    }
    
    /**
     * 
     * 公開判定の取得
     * 
     * 
     * @param int
     * @return string
     * 
     **/
    public function getOpenProprietyName( $index = 0 )
    {
        return $this->getConfigIndexData( "open_propriety" , $index );
        
    }
    
    /**
     * 
     * 公開判定の取得
     * 
     * 
     * @param int
     * @return string
     * 
     **/
    public function getSelectOptionName( $index = 0 )
    {
        return $this->getConfigIndexData( "select_option" , $index );
        
    }
    
    /**
     * 
     * 学校ランクのリスト取得
     * 
     * 
     * @params void
     * @return array
     * 
     **/
    public function getSchoolsRank()
    {
        
        $array =  $this->getConfigData('school_rank');
        $non = $array[9];
        
        unset( $array[9] );
        array_unshift($array, array(''=>$non ) );
        
        return $array;
    }
    
    
    /**
     * 
     * 公立、私立区分の取得
     * 
     * 
     * 
     * 
     **/
    public function getPublicPrivateClass()
    {
        
        $array =  $this->getConfigData('public_private_class');
        array_unshift($array, array( ''=>"指定なし") );
        
        return $array;
        
    }
    
    /**
     * 
     * getDateTime
     * 日付を変換する処理
     * 
     * @param string
     * @returun string
     * 
     * 
     **/
    public function getDateTime( $dt )
    {
        
        list( $ymd, $time ) = explode( " ",$dt );
        
        list( $y, $m, $d ) = explode("-", $ymd );
        
        return sprintf( "%04d年%02d月%02d日 %s", $y,$m,$d,$time);
        
        
    }

    /**
     * 
     * getDate
     * 日付を変換する処理
     * 
     * @param string
     * @returun string
     * 
     * 
     **/
    public function getDate( $dt )
    {
        
        list( $ymd, $time ) = explode( " ",$dt );
        
        list( $y, $m, $d ) = explode("-", $ymd );
        
        return sprintf( "%04d年%02d月%02d日", $y,$m,$d);
        
        
    }

    /**
     * 
     * getDateYm
     * 日付を変換する処理
     * 
     * @param string  yyyy/mm/dd
     * @returun string
     * 
     * 
     **/
    public function getDateYm( $ymd )
    {
        
        list( $y, $m, $d ) = explode("-", $ymd );
        
        return sprintf( "%04d年%02d月", $y,$m);
        
        
    }
    /**
     * 
     * getSelectStatus
     * 
     * @param array
     * @param int
     * @param int
     *
     * @return array
     * 
     **/
    public function getSelectStatus( $stage_data, $stage_id,  $val )
    {
        $val = (int) $val;

        $data_array = $this->getAvailableStatus( $stage_data, $stage_id,  $val );
        
        $result = array();
        
        $status = Configure::read( 'select_judgment_type' );
        
        foreach ( $data_array as $row ){
            $result[$row] = $status[ $row ];
            
        }
        
        return $result;
    }

    /**
     * 
     * 業種テキストの取得
     * 
     * @param int
     * @return string
     * 
     **/
    public function getBusinessName( $index = 0 )
    {
        return $this->getConfigIndexData( "business" , $index );
    }

    /**
     * 
     * 業種テキストの取得
     * 
     * @param int
     * @return string
     * 
     **/
    public function getMarketName( $index = 0 )
    {
        return $this->getConfigIndexData( "market" , $index );
    }



    /**
     * getAvailableStatus
     * 遷移可能なステータスを返却する
     *
     * @param array
     * @param int
     * @param int
     *
     * @return array
    */
    public function getAvailableStatus( $stage_data, $stage_id,  $val ) {

        if ( empty( $val ) ) $val = 0;
        
        switch ($val)
        {
            case 1:     //候補者スケジュール確認済
                    return array( 1, 3 );
            case 2:     //採用担当者スケジュール確認済
                    return array( 2, 3 );
            case 3:     //スケジュールFix
                    return array( 3, 4, 8, 9, 10 );
            case 4:     //面接済/評価待ち
                    return array( 4, 5, 6 );
            case 5:     //合格
                    if ( $this->isStageLast($stage_data, $stage_id ) ){
                        return array( 5, 7 );
                    }else{
                        return array( 5 );
                    }
            case 6:     //不合格
                    return array(6);
            case 7:     //内定辞退
                    return array(7);
            case 8:     //求人都合キャンセル
                    return array(8);
            case 9:     //候補者都合キャンセル
                    return array(9);
            case 10:    //ペンディング
                    return  array( 1, 2, 8, 9 );
            default:
                if ( $this->isStageFirst( $stage_data, $stage_id ) )
                {
                    return array( 0, 5, 6, 8, 9, 10);
                }else{
                    return array( 0, 1, 2, 8, 9, 10);
                }
        }
    }

    /**
     * isDeleteBtn
     * 削除ボタンを表示させるかを返却
     *
     * @param array  $stage_data  選考段階リスト
     * @param int    $stage_id    候補者の現在の選考段階
     * @param int    $status         候補者の現在の選考ステータスID
     *
     * @return array
    */
    public function isDeleteBtn( $stage_data, $stage_id,  $status ) {

        if( $status != 0 ) {
            return false;

        } else if( !$this->isStageFirst( $stage_data, $stage_id ) ) {
            return false;
        
        } 

        return true;

    }

    /**
    * 
    * メール送信履歴一覧画面
    * 送信先分岐処理を行いデータを返却
    * @param  array  $data
    * @return array  $result
    * 
    **/
    public function getSendTo( $data )
    {
        $result = array( 'id' => 0, 'sendTo' => '', 'belong' => '' );



        if( !empty( $data['CanCandidate']['id'] ) ) {
                $candidate = $data['CanCandidate'];
                
                $key = $this->getKeyByYear( $candidate );

                $result['id'] = $candidate['id'];
                $result['sendTo'] = $candidate['last_name']. ' '. 
                                    $candidate['first_name'];

            if( empty( $candidate['CanEducation'][$key]['School']['id'] ) ) {

                if( !empty( $candidate['CanEducation'][$key]['school'] ) ) {

                    $result['belong'] = $candidate['CanEducation'][$key]['school'];
                }

            }else {

                $result['belong'] = $candidate['CanEducation'][$key]['School']['name'];
            }


        } else if( !empty( $data['InfStaff']['id'] ) ) {
            $infStaff = $data['InfStaff'];
            $result['id'] = $infStaff['id'];
            $result['sendTo'] = $infStaff['last_name']. ' '. 
                                $infStaff['first_name'];
            $result['belong'] = $infStaff['RefererCompany']['name'];

        }else if( !empty( $data['RecRecruiter']['id'] ) ) {
            $recRecruiter = $data['RecRecruiter'];
            $result['id'] = $recRecruiter['id'];
            $result['sendTo'] = $recRecruiter['last_name']. ' '. 
                                $recRecruiter['first_name'];
            $result['belong'] = $recRecruiter['RecDepartment']['RecCompany']['company_name'];  

        }  

        return $result;


    }

    /**
     * 
     * 
     * 削除可能かを判断する
     * 
     * @param array
     * @param int
     * 
     * @return bool
     * 
     **/
    public function isSelHistoryDelete( $stage_data, $stage_id )
    {
        return $this->isStageFirst( $stage_data, $stage_id );
        
        
    }
    
    /**
     * 
     * メニューの切り替え
     * 
     * @return string
     **/
    public function getMenu()
    {   
        
        switch ( SessionComponent::read('Auth.User.role_type') )
        {
            case ROLE_TYPE_RECRUITER:
                return 'menu/recruiter';
            case ROLE_TYPE_MANAGER:
                return 'menu/manager';
            
            default:
                return;
        }
    }

    /**
     * 
     * Controller特有の css読み込み
     * 
     * @return string
     **/
    public function getCssOrigin($controller, $action)
    {
        $controller = strtolower($controller);
        $action = strtolower($action);
        $base_dir = 'css';
        $origin_dir = 'enjin';
        $css_path = WWW_ROOT . DS . $base_dir . DS . $origin_dir;
        $files = array(
            $controller . '.css',
            $controller . $action . '.css',
        );
        $return = array();
        foreach($files as $css){
            if(file_exists($css_path. DS . $css)){
                $return[] = $this->Html->css($origin_dir . '/' . $css);
            }
        }
        return implode("", $return);
    }

    /**
    * サマリ表作成
    * 
    * @param  array   $summary_data
    * @return string  $summary
    **/
    public function getSummary( $summaryData ) 
    {

        $config['screening_stage_type'] = Configure::read( 'screening_stage_type' );
        $config['select_judgment_type'] = Configure::read('select_judgment_type');
        $str = '';

        foreach( $summaryData['target'] as $key => $value ) { 
            $tg_order = array(); 
            $res_order = array();

            $str .= "<table class='table table-bordered white-bg'>
            <tr>
            <th class='cl-bg-f5f'>選考段階</th>";
        
            foreach ($summaryData['screening_stage'] as $ky => $val) { 
                $tg_order[] = $ky; 
                $res_order[] = $ky;
                
                $str .= '<th class="cl-bg-f5f" colspan="3">'. $summaryData['screening_stage'][$ky]['name']. '</th>';
            }

            $str .= '</tr>';

            $order_count = count( $tg_order );
            $target_count = count( $value );

            for ($j=0; $j < $target_count; $j++) { 
                 $str .= '<tr>';

                if( $j == 0 ){
                $str .= "<th class='cl-bg-f5f' rowspan='".$target_count."'>目標</th>";
                }
                $flg = 0;


                for( $i=0; $i<$order_count; $i++ ) { 
                    
                    $order_key = $tg_order[$i];

                    
                    if( !empty( $value[$order_key] ) ) {

                        $select_judgment_type = $value[$order_key]['select_judgment_type'];    
                        $screening_stage_type = $value[$order_key]['target_select_id'];
                        
                        $str .= $this->switchSelJudgeType( $select_judgment_type );
            
                        foreach ($value[$order_key]['date'] as $ky => $val) { 
                           if( $flg == 0 ) { 

                                $str .= $ky.'までに'.$value[$order_key]['name'].
                                $config['screening_stage_type'][$screening_stage_type].'の'.
                                $config['select_judgment_type'][$select_judgment_type].'を'.
                                $val.'人';
                                $tg_order[$i] = null;
                                $flg = 1;
                            }
                        }
                    } else {
                        $str .= '<td colspan="3">';
                    }
                    $str .= '</td>';
                }

                $str .= '</tr>';
            }

            $str.="<tr>";
             $str .= "<th class='cl-bg-f5f' rowspan='2'>実数</th>";
            for( $i=0; $i<$order_count; $i++ ) { 
                 $str .= '<td>合格</td>';
                $str .= '<td>不合格</td>';
                $str .= '<td>その他</td>';
            }
            $str.="</tr>";

            $str .= '<tr>';
           
     
            $order_count = count($res_order);

            for( $i=0; $i<$order_count; $i++ ) { 

            $order_key = $res_order[$i]; 
            $crear = 0;
            $no_crear = 0;
            $other = 0;

            if( !empty( $summaryData['result'][$key][$order_key] ) ) { 
                foreach ($summaryData['result'][$key][$order_key] as $ky => $val) {
                    if( $ky == 4 ) {
                        $crear += $val;
                    } else if( $ky == 5 ) {
                        $no_crear += $val;
                    } else {
                        $other += $val;
                    }
                }


             }
                $str .= '<td>'.$crear .'</td>';
                $str .= '<td>'.$no_crear .'</td>';
                $str .= '<td>'.$other.'</td>';
            }
            $str .= '</tr>';

            $str .= '</table>';
        }


        return $str;

    }

    public function nl2brh($text)
    {
        return h( nl2br( $text ) );
    }


    /**
     * 
     * getAfterScoreName
     * イベント参加履歴（参加後評価スコア）テキストの取得
     * 
     * @param int
     * @return string
     * 
     **/
    public function getTypeName( $index = 0 )
    {
        return $this->getConfigIndexData( "type" , $index );
        
    }

    /**
     * 
     * イベント検索一覧のイベント開催日程の日付作成
     * 
     * @param array
     * @return string
     * 
     * 
     **/
    public function getEventListScheduleBlock( $data )
    {
        if ( empty( $data['id'] ))
        {
            return '<td class="button_cen">&nbsp;</td><td class="button_cen">&nbsp;</td>';
        }
        
        return sprintf( '<td class="button_cen">%s</td><td class="button_cen">%s</td>',
                        $data['holding_date'] ,
                        $data['end_date']
                        );
        
        
    }
    
    /**
     * 
     * 定員数を取得する
     * 
     * @param array
     * @return srting
     * 
     **/
    public function getCapacity( $data )
    {

        if ( empty( $data['capacity'] ))
        {
            return '<td class="button_cen">&nbsp;</td>';
        }

        $capacity= sprintf( "%s名", number_format( $data['capacity'] ));
        
        return sprintf( '<td class="button_cen">%s</td>', $capacity);
        
    }
    
    /**
     * 
     * 該当するステータスのカウントを取得して戻す処理
     * 
     * @param array
     * @param int
     * 
     * @return int
     * 
     **/
    public function getEvStatStatus( $data, $index )
    {
        if ( empty( $data[0] )) return 0;
        
        $count = 0;
        
        foreach( $data as $row ) 
        {
            if ( $row['EvStat']['ev_history_status'] == $index )
            {
                $count = $row['EvStat']['count'];
            }
        }
        
        return $count;
        
    }
    
    /**
     * 
     * 申し込み人数の統計を取得する
     * 
     * @param array
     * @return int
     * 
     **/
    public function getEvStatStatusTotal( $data )
    {
        if ( empty( $data[0] ) ) return 0;
        
        $count = 0;
        foreach( $data as $row )
        {
            $count += $row['EvStat']['count'];
        }
        
        return $count;
        
    }
    
    /**
     * 
     * 選考履歴ステータスの取得
     * 
     * @return array
     * 
     **/
    public function getEvHistoryStatus()
    {
        return Configure::read( "ev_history_status" );
    }
    
    /**
     * 
     * イベント選考履歴ステータスの取得（利用可能）
     * 
     * @return array
     * 
     **/
    public function getEvHistoryStatusUses( $status )
    {   
        
        $data =  Configure::read( "ev_history_status" );
        
        
        switch( (INT) $status ) {
        case 1:
            $array = array( 4, 5);
            break;
        case 2:
            $array = array( 2 );
            break;
        case 3:
            $array = array( 3 );
            break;
        case 4:
            $array = array( 4 );
            break;
        case 5:
            $array = array( 5);
            break;
        default:
            $array = array( 0,1,2,3,4,5,);
        }
        
        foreach( $data as $key => $val )
        {
            if ( in_array( $key , $array ) )  $result[$key] = $val;
        } 
        
        return $result;
    }
    
    
    /*
    * 学校名の取得用
    *
    */
    public function getSchoolName($data) {
        // 学歴がない
        if (empty($data)){
            return "";
        }

        // 学歴から大学名を取得する場合
        if (!empty($data[0]['school'])) {
            return $data[0]['school'];
        }
        // 学校から大学名を取得する場合
        if (!empty($data[0]['School'])){
            return $data[0]['School']['name'];
        }
        return "";

    }
        /*
    * 学部名の取得用
    *
    */
    public function getUnderGraduateName($data) {
        // 学歴がない
        if (empty($data)){
            return "";
        }

        // 学歴から大学名を取得する場合
        if (!empty($data[0]['undergraduate'])) {
            return $data[0]['undergraduate'];
        }
        // 学校から大学名を取得する場合
        if (!empty($data[0]['Undergraduate'])){
            return $data[0]['Undergraduate']['name'];
        }
        return "";

    }
    
    /**
     * 
     * 流入元タイプ
     * 
     * 
     * @param int
     * @return string
     * 
     **/
    public function getInfluxOriginalTypeName( $index = 0 )
    {
        return $this->getConfigIndexData( "influx_original_type" , $index );
    }
    
    
    /**
     * 
     * 曜日の取得
     * 
     * 
     **/
    public function getWeekDay( $index = -1 )
    {
        return $this->getConfigIndexData( "weekday" , $index );
    }
    
    /**
     * 
     * 時間の取得
     * 
     * @param string datetime
     * 
     * @retrun string
     * 
     **/
    public function getTime( $dateTime )
    {
        list( $date , $time ) = explode( " ", $dateTime );
        
        return $time;
        
    }
    
    /**
     * 
     * 選考段階比較タイプの取得
     * 
     * @param int
     * @return string
     * 
     **/
    public function getScreeningStageTypeName( $index = 0 )
    {
        return $this->getConfigIndexData( "screening_stage_type" , $index );
    }
     

    /**
     * 
     * 参加後評価スコアの取得
     * 
     * @return array
     * 
     **/
    public function getAfterScoreArray()
    {
        return Configure::read( "after_score" );
    }
    
    /**
     * 
     * getDateTime2String 
     * 
     * @param string datetime
     * @param bool
     * 
     * @return string
     * 
     **/
    public function getDateTime2String( $dateTime, $isDate = true )
    {   
        if ( empty( $dateTime ) ) return "";
    
        list( $date, $time ) = explode( " ", $dateTime );
        
        if ( $isDate ) {
            return $date;
        }else{
            return $time;
        }
        
    }
    
    /**
     * 
     * 流入元企業の金額・割合取得
     * 
     * 
     * 
     * 
     * 
     **/
    public function getInfContactFee( $infContact )
    {
        
        switch( $infContact['contract_type'] ) {
            case 1: //固定
                    return sprintf( "%s円" , number_format( $infContact['fixed_unit_price'] ) );
                    break;

            case 2: //無制限
                    return sprintf( "%s円" , number_format( $infContact['unlimited_fixed_annual'] ) );
                    break;
            
            case 3: //年収割合
                    return sprintf( "%s％" , number_format( $infContact['income_ratio'] ) );
                    break;
            
        }
        return null;
    }
    
    
    public function getContractType( $index = 0 )
    {
        return $this->getConfigIndexData( "contract_type" , $index );
    }
    
    
    /**
     * 
     * 選考履歴（求人票）の選考ステータス取得（select option用）
     * 
     * @param int //現在の選考ステータス
     * @param bool //最初の選考段階
     * @param bool //最後の選考段階
     * @param bool //面接官かを判断
     * 
     * @return array
     * 
     * 
     **/
    public function getSelectJudgmentTypeOptions( $id = 0, $isFirst = false, $isLast = false , $isInterviewer = false )
    {
        if ( empty( $id ) ) $id = 0;
        
        switch( $id ) {
            case 0:
                $select = array( 0,1,2,8,9,10 );
                if ($isFirst){
                    $select = array( 0,5,6,8,9,10 );
                }
                break;
            case 1:
            case 2:
                $select = array( 1,2,3,10 );
                break;
            case 3:
                $select = array( 3,4,10 );
                if ( $isInterviewer ) $select = array( 3 );
                break;
            case 4:
                if ( $isInterviewer ) $select = array( 4 );
                $select = array( 4,5,6 );
                break;
            case 5:
                $select = array( 5 );
                if ( $isLast ) $select = array( 5, 7 );
                break;
            case 6:
                $select = array( 6 );
                break;
            case 7:
                $select = array( 7 );
                break;
            case 8:
                $select = array( 8 );
                break;
            case 9:
                $select = array( 9 );
                break;
            case 10:
                $select = ( $isFirst ) ? array( 5,6,8,9,10 ): array( 1,2,8,9,10 );
                break;
        }
        
        $options_data = $this->getConfigData('select_judgment_type');
        
        $options = array();
        foreach( $options_data as $key => $val ){
            if ( in_array( $key , $select ) ) $options[$key] = $val;
            
        }
        return $options;
        
    }
    
    /* -*-*-*-*-*-*-*-*-*- 以下private -*-*-*-*-*-*-*-*-*- */

    /**
     * 
     * getConfigData
     * コンフィグに設定されているデータを取得する
     * 
     * @param string
     * @return array
     * 
     **/
    private function getConfigData( $name )
    {
        
        $config = Configure::read( $name );

        if (empty( $config ) ) return array();
        
        return $config;
        
    }
    
    /**
     * 
     * getConfigIndexData
     * 
     * @param string
     * @param int
     * 
     * @return string
     *
     **/
    
    private function getConfigIndexData( $name , $index )
    {
        $data = $this->getConfigData( $name);
        
        if (empty( $data[$index] ) ) return "";
        
        return $data[$index];
        
    }
    

    /**
     * 
     * isStageFirst
     * 選考段階マスタの順序が一番最初の状態なのかを取得する
     * 
     * @param array
     * @param int
     * 
     * @return bool
     * 
     **/
    private function isStageFirst( $stage_data , $stage_id )
    {
        //一番小さいキー（並び順が順序になっている。)を取得
        $first = min( array_keys( $stage_data ) );
        
        return ( $first === $stage_id );
    }
    
    /**
     * 
     * isLastFirst
     * 選考段階マスタの順序が一番最後の状態なのかを取得する
     * 
     * @param array
     * @param int
     * 
     * @return bool
     * 
     **/
    private function isStageLast( $stage_data , $stage_id )
    {

        //一番小さいキー（並び順が順序になっている。)を取得
        $last = max( array_keys( $stage_data ) );
        
        return ( $last === $stage_id );
    }

    private function switchSelJudgeType( $select_judgment_type )
    {
        switch ( $select_judgment_type ) {
            case '0':
                $str = '<td colspan="3">';
                break;

            case '1':
                $target = ( $order_count - $i ) *3 ;
                $str = '<td colspan="'.$target.'">';
                break;
            
            default:
                $str = '<td colspan="3">';
                break;
        }

        return $str;

    }

    /**
    * 卒業年月が一番大きいもののkeyを返却
    * 
    * @param array $data
    * @param int   $key
    * 
    **/
    private function getKeyByYear( $data )
    {
        $date = array();
        if (!empty($data['CanEducation'])){
            foreach ( $data['CanEducation'] as $ky => $val ) {
                $year = date( 'Y', strtotime( $val['graduation_date'] ) );
                $date[$year] = $ky;
            }
        }
        if( empty( $date ) )  return 0;

        $key = max( array_keys( $date ) );

        return $date[$key];

    }
    
    
}