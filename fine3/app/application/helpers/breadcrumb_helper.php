<?php

//THIS METHOD IS CALLED FROM HTML
//keyに_currentとついているものはリンクをつけない
function display_breadcrumb($bc = null) {
    if (!$bc or !isset($bc['base_url'])) {
        //セットされていない場合はdefault
        $html = "<p>国内最大級の保育士求人サイト FINE！（ファイン） TOP";
        $html .= "</p>";
        $ret = "<div class=\"breadcrumbs\">
            ".$html."
            <!-- /.breadcrumbs --></div>
            ";
        return $ret;
    }
    $base_url = $bc['base_url'];
    $html = "<p><a href=\"".$base_url."\">国内最大級の保育士求人サイト FINE！（ファイン）</a>";
    if (isset($bc['content'])) {
        foreach ($bc['content'] as $key => $val) {
            if (strstr($key, 'current')) {
                $html .= " &gt; ".$val['word'];
            } else {
                $html .= " &gt; <a href=\"".$base_url.$val['url']."\">".$val['word']."</a>";
            }
        }
        $html .= "</p>";
    } else {
        //セットされていない場合はdefault
        $html = "<p><a href=\"".$base_url."\">国内最大級の保育士求人サイト FINE！（ファイン） TOP</a>";
        $html .= "</p>";
    }
    //HTMLに返す値を生成
    $ret = "<div class=\"breadcrumbs\">
       ".$html."
       <!-- /.breadcrumbs --></div>
       ";
    return $ret;

}

//call this function in controller
//複雑な処理な処理は第二引数にパラメータをいれ第一引数にユーザ定義関数名
//簡単な処理は第一引数に生成したいセグメント名を配列で渡し、第二引数は無視
function get_breadcrumb($triger , $args = false) {

    if($args != false and !is_array($triger) ) {
        //特別な処理の場合なのでユーザ定義関数を呼ぶ
        $func = "get_breadcrumb_for_".$triger;

        //$bc['$sample']['url'] =  "sample";
        //$bc['$sample']['word'] = "sample";
        $bc  = call_user_func($func, $args);
        return $bc;
    } elseif (is_array($triger) and $args == false) {
        //キーを見て単純なパンくずを生成する
        $bc = get_static_breadcrumb($triger);
        return $bc;
    } else {
        echo "この関数の使い方を間違えています";
        exit;
    }
}

//array(A , B , C_current) リンクをつけたくないものは_currentを入れて渡す
function get_static_breadcrumb($param) {
    foreach ($param as $key=> $segment) {
        $breadcrumb_key  = str_replace("_current", "", $segment);

        //トップ
        if ($breadcrumb_key == 'index') {
            $ret[$segment]['url'] = '';
            $ret[$segment]['word'] = '国内最大級の保育士求人サイト FINE！（ファイン） TOP';
        //会員登録
        } elseif ($breadcrumb_key == 'sign_up') {
            $ret[$segment]['url'] = 'signup/';
            $ret[$segment]['word'] = '会員登録';
        } elseif ($breadcrumb_key == 'sign_up_apply') {
            $ret[$segment]['url'] = 'signup/apply/';
            $ret[$segment]['word'] = '登録＆応募';
        } elseif ($breadcrumb_key == 'sign_up_complete') {
            $ret[$segment]['url'] = 'signup/complete/';
            $ret[$segment]['word'] = '会員登録完了';
        } elseif($breadcrumb_key == 'login') {  //written by Aya from this row
        $ret[$segment]['url'] = 'login/';
            $ret[$segment]['word'] = 'ログイン';
    } elseif($breadcrumb_key == 'agent_index'){
        $ret[$segment]['url'] = 'agent/';
            $ret[$segment]['word'] = '紹介会社別に探す';
    } elseif($breadcrumb_key == 'applicantlist'){
        $ret[$segment]['url'] = 'agent/applicantlist/';
            $ret[$segment]['word'] = '求人を紹介してもらう';
    } elseif($breadcrumb_key == 'agent_apply_complete'){
            $ret[$segment]['url'] = 'agent/apply_complete/';
            $ret[$segment]['word'] = '紹介会社への依頼完了';
    } elseif($breadcrumb_key == 'mypage'){
        $ret[$segment]['url'] = 'mypage/';
            $ret[$segment]['word'] = 'マイページ';
    } elseif($breadcrumb_key == 'applylist_job'){
        $ret[$segment]['url'] = 'mypage/apply_job_history/';
            $ret[$segment]['word'] = '求人への応募履歴';
    } elseif($breadcrumb_key == 'applylist_agent'){
        $ret[$segment]['url'] = 'mypage/apply_agent_history/';
            $ret[$segment]['word'] = '紹介会社への応募履歴';
    } elseif($breadcrumb_key == 'bookmark'){
        $ret[$segment]['url'] = 'mypage/bookmark/';
            $ret[$segment]['word'] = 'お気に入り求人';
    } elseif($breadcrumb_key == 'profile'){
        $ret[$segment]['url'] = 'mypage/profile/';
            $ret[$segment]['word'] = '登録情報';
    } elseif($breadcrumb_key == 'profile_edit'){
            $ret[$segment]['url'] = 'mypage/profile_edit/';
            $ret[$segment]['word'] = '登録情報の編集';
    } elseif($breadcrumb_key == 'profile_finished'){
            $ret[$segment]['url'] = 'mypage/profile_finished/';
            $ret[$segment]['word'] = '登録情報の編集完了';
    } elseif($breadcrumb_key == 'change_passsword'){
            $ret[$segment]['url'] = 'mypage/change_password/';
            $ret[$segment]['word'] = 'パスワードの変更';
    } elseif($breadcrumb_key == 'change_password_execute'){
            $ret[$segment]['url'] = 'mypage/change_password_execute/';
            $ret[$segment]['word'] = 'パスワードの変更完了';
    } elseif($breadcrumb_key == 'withdraw'){
            $ret[$segment]['url'] = 'mypage/withdraw/';
            $ret[$segment]['word'] = '退会される方へ';
    } elseif($breadcrumb_key == 'withdraw_complete'){
            $ret[$segment]['url'] = 'mypage/withdraw_complete/';
            $ret[$segment]['word'] = '退会手続きの完了';
    } elseif($breadcrumb_key == 'password_reset'){
            $ret[$segment]['url'] = 'password/';
            $ret[$segment]['word'] = 'パスワードを忘れた方へ';
    } elseif($breadcrumb_key == 'password_reset_comp'){
            $ret[$segment]['url'] = 'password/forgot/';
            $ret[$segment]['word'] = 'パスワード変更完了';
    } elseif($breadcrumb_key == 'error'){
        $ret[$segment]['url'] = 'error/';
            $ret[$segment]['word'] = 'エラー';
    } elseif($breadcrumb_key == 'notfound'){
        $ret[$segment]['url'] = 'error/notfound/';
            $ret[$segment]['word'] = 'お探しのページが見つかりません';
    } elseif($breadcrumb_key == 'mentenance'){
        $ret[$segment]['url'] = 'error/mentenance/';
            $ret[$segment]['word'] = 'メンテナンスのお知らせ';
    } elseif($breadcrumb_key == 'inquiry_index'){
        $ret[$segment]['url'] = 'inquiry/';
            $ret[$segment]['word'] = 'お問い合わせ';
    } elseif($breadcrumb_key == 'businessoffer'){
        $ret[$segment]['url'] = 'inquiry/businessoffer/';
            $ret[$segment]['word'] = '採用ご担当者様お問い合わせ';
    } elseif($breadcrumb_key == 'inquiry_complete'){
        $ret[$segment]['url'] = 'inquiry/complete/';
            $ret[$segment]['word'] = 'お問い合わせ完了';
    } elseif($breadcrumb_key == 'about'){
            $ret[$segment]['url'] = 'static/about/';
            $ret[$segment]['word'] = 'FINE!について';
    } elseif($breadcrumb_key == 'guide'){
            $ret[$segment]['url'] = 'static/guide/';
            $ret[$segment]['word'] = 'サイトの使い方';
    } elseif($breadcrumb_key == 'rule'){
            $ret[$segment]['url'] = 'static/rule/';
            $ret[$segment]['word'] = '利用規約';
    } elseif($breadcrumb_key == 'rule_company'){
            $ret[$segment]['url'] = 'static/rule_company/';
            $ret[$segment]['word'] = '利用規約(企業様向け)';
        } elseif($breadcrumb_key == 'search'){
            $ret[$segment]['url'] = 'search/';
            $ret[$segment]['word'] = '求人票検索';
        }
    }
    return $ret;
}


function get_breadcrumb_for_job_detail($dinamic_element) {
    //リンクをつけなくないセグメントには_currentをつけて返してください
    $param = array('pref','city','job_current');

    //動的要素は勝手に編集してください
    foreach ($param as $key=> $segment) {
        $breadcrumb_key  = str_replace("_current", "", $segment);

        //該当する都道府県での求人一覧ページ
        if ($breadcrumb_key == 'pref') {
            $pref_romaji   = $dinamic_element['pref_romaji'];  // = 'tokyo';
            $pref_name = $dinamic_element['pref_name'];// = 'あざらし県';
            $ret[$segment]['url'] = 'p_'.$pref_romaji.'/';
            $ret[$segment]['word'] = $pref_name;
        //該当する市区町村での求人一覧ページ
        } elseif ($breadcrumb_key == 'city') {
            $pref_romaji   = $dinamic_element['pref_romaji'];  // = 'tokyo';
           $city_romaji   = $dinamic_element['city_romaji']  ;// = 'minatoku' ;
            $city_name = $dinamic_element['city_name'];// = 'あざらし区'
            $ret[$segment]['url'] = 'p_'.$pref_romaji.'/list_c_'.$city_romaji.'/';
            $ret[$segment]['word'] = $city_name;
        //求人票詳細のページ
        } elseif ($breadcrumb_key == 'job') {
            $job_title = $dinamic_element['job_title'];// = 'あざらっこ農園で健康な食材を購入しています';
            $job_id    = $dinamic_element['job_id'];// = '1';
            $ret[$segment]['url'] = 'detail_'.$job_id.'/';
            $ret[$segment]['word'] = $job_title;
        }
    }
    return $ret;
}

function get_breadcrumb_for_job_search($dinamic_element) {
    if (isset($dinamic_element['area_data'])) {
        $bc_element['pref_name']  = $dinamic_element['area_data']['pref_name'];
        $bc_element['pref_id']    = $dinamic_element['area_data']['pref_id'];
        $bc_element['city_id']    = $dinamic_element['area_data']['city_id'];
        $bc_element['city_name']  = $dinamic_element['area_data']['city_name'];
    if(isset($bc_element['city_name'])){
            $param = array($bc_element['pref_name'],$bc_element['city_name'],'job_search_current');
    }else{
        $param = array($bc_element['pref_name'],'job_search_current');
    }
        //条件によって変えるtodo
    } else {
        $param = array('job_search_current');
    }
    foreach ($param as $key=> $segment) {
        $breadcrumb_key  = str_replace("_current", "", $segment);

        //該当する都道府県での求人一覧ページ
        if ($breadcrumb_key == 'job_search') {
            $ret[$segment]['url'] = 'search/';
            $ret[$segment]['word'] = '求人票検索';
        } elseif(isset($bc_element['pref_name'])){
        $ret[$segment]['url'] = 'search/?pref='.$bc_element['pref_id'];
            $ret[$segment]['word'] = $bc_element['pref_name'];
    } elseif(isset($bc_element['city_name'])){
        $ret[$segment]['url'] = 'search/?pref='.$bc_element['pref_id'].'&city='.$bc_element['city_id'];
            $ret[$segment]['word'] = $bc_element['city_name'];
    } else {
            $ret[$segment]['url'] = '';
            $ret[$segment]['word'] = '求人票検索';
        }
    }
    return $ret;
}

function get_breadcrumb_for_agent_detail($dinamic_element) {
    //リンクをつけなくないセグメントには_currentをつけて返してください
    $ret = false;
    $param = $dinamic_element['item'];

    //動的要素は勝手に編集してください
    foreach ($param as $key=> $segment) {
        $breadcrumb_key  = str_replace("_current", "", $segment);

        //紹介会社一覧ページ
        if ($breadcrumb_key == 'agent_index') {
        $ret[$segment]['url'] = 'agent/index/';
            $ret[$segment]['word'] = '紹介会社別に探す';
        //紹介会社詳細ページ
        } elseif ($breadcrumb_key == 'agent_detail') {
            $agent_name = $dinamic_element['agent_name'];// = 'あざらし株式会社';
            $client_id  = $dinamic_element['client_id'];
            $ret[$segment]['url'] = 'agent/detail/'.$client_id.'/';
            $ret[$segment]['word'] = $agent_name;
        //応募完了ページ
        } elseif ($breadcrumb_key == 'apply_agent_complete') {
            $ret[$segment]['url'] = 'agent/apply_complete';
            $ret[$segment]['word'] = '応募完了';
        }
    }
    return $ret;
}
