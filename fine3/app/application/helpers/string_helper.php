<?php

function shortenString($str, $length = 60, $more='...'){
    $str = strip_tags($str);
    $str = str_replace("\n", '', $str);
    $words =   preg_split('/(?<!^)(?!$)/u', $str);
    if(count($words) > $length ){
        $words =  array_slice($words,0, $length);
         return implode('', $words) . $more;
    }else{
        return $text;
    }
}