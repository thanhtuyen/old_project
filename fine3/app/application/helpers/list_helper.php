<?php
/**
 * this func calcurate next endpoint
 * @param  array('now','range') 
 * @return (int)endpoint
 */
function next_endpoint($param){
    $page        = $param['page'];
    $range      = $param['range'];
    $endpoint   = $page * $range;
    if($endpoint > $param['limit']){
        return $param['limit'];
    }else{
        return $endpoint;        
    }
}
function next_startpoint($param,$endpoint,$page = 0){
    $range        = $param['range'];
    $startpoint = 0;
    if($page > 1){
        $paged = $page -1;
        $startpoint = $paged * $range;
    }else{
        $paged = 1;
        $startpoint   = $endpoint - $range;
    }
    if($startpoint > $endpoint){
        $startpoint = $endpoint;
    }
    if($startpoint < 0){
        return 0;
    }else{
        return $startpoint;        
    }
}
//without pagenation this func returns array to get parameter
function get_to_str($param){
    $data = "?";
    foreach($param as $key=>$val){
        if($key !=="page"){
            $data .= $key."=".$val."&";
        }
    }
    $result =$data."page=";
    return $result;
}