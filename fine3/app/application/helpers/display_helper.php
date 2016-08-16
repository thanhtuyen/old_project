<?php

function get_string_list($raw_array, $key, $delimiter = ",", $cond_key = "" , $cond_val = ""){
    $ret_str = "";
    if(!empty($raw_array)){
        if($cond_key === ""){
            foreach($raw_array as $val){
                $ret_str .= $val[$key].$delimiter;
            }
        }else{
            foreach($raw_array as $val){
                if($val[$cond_key] == $cond_val){
                    $ret_str .= $val[$key].$delimiter;
                }
            }
        }
        $ret_str = rtrim($ret_str,$delimiter);
    }
    return $ret_str;
}
function get_age($bithdate){
    $date = new DateTime($bithdate);
    $now = new DateTime();
    $interval = $now->diff($date);
    return $interval->y;
}

function shortenString($string, $num = 100){
    if(mb_strlen($string) >= $num){
        $result = mb_substr($string,0,$num) . '...';
    }else{
	$result = $string;
    }
    return $result;
}

/**
 * TUYENNT
 * use in user/jobController
 * sort by total job DESC
 */
function sortByTotal($a, $b) {
    return $a["total"] - $b["total"];
}