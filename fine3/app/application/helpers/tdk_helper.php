<?php

//THIS METHOD IS CALLED FROM HTML
function display_tdk($tdk = null) {

    //明示的に変数に格納
    //$tdk_array   = get_tdk($template_name,$args);
    if (isset($tdk)) {
        if (!isset($tdk['title'])) {
            $title       = '【FINE】日本最大級の保育士の求人・情報ならFINE';
        } else {
            $title       = $tdk['title'];
        }
        if (!isset($tdk['description'])) {
            $description = '【FINE】日本最大級の保育士の求人・情報ならFINE';
        } else {
            $description = $tdk['description'];
        }
        if (!isset($tdk['keyword'])) {
            $keyword     = 'fine,FINE,ファイン,保育士　求人, 保育士　仕事';
        } else {
            $keyword     = $tdk['keyword'];
        }
        if (!isset($tdk['author'])) {
            $author      = 'FINE';
        } else {
            $author      = $tdk['author'];
        }
    } else {
        //セットされていない場合はこちらがdefault TDK
        $title       = '【FINE】日本最大級の保育士の求人・情報ならFINE';
        $description = '【FINE】日本最大級の保育士の求人・情報ならFINE';
        $keyword     = 'fine,FINE,ファイン,保育士　求人, 保育士　仕事';
        $author      = 'FINE';
    }

    //マーケティング用
    $title = '&#x2600'.$title;

    //HTMLに返す値を生成
    $ret = "
        <meta name='description' content='$description'>
        <meta name='keywords' content='$keyword'>
        <meta name='author' content='$author'>
        <title>$title</title>    
    ";
    return $ret;
}

//call this function in cantroller
function get_tdk($template_name , $args) {
    $func = "get_tdk_for_".$template_name;
    $tdk  = call_user_func($func, $args);
    return $tdk;
}

function get_tdk_for_sign_up($param) {
    $pref = $param['pref'];
    $city = $param['city'];
    $ret['title']       = $pref.'の求人ならFINEですよー';
    $ret['description'] = $pref.'の求人ならFINEですよー';
    $ret['keyword']     = $pref.$city;
    $ret['author']      = 'FINEたち';
    return $ret;
}


