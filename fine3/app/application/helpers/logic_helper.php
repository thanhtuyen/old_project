<?php
/**
 * this func parse array into strings for sql
 * @param  array('user_id','user_name')
 * @return (str)`user_id`,`user_name`
 */
function array_to_select_str($array){

    if(is_array($array)){
        if($array[0] === "*"){
            $result = "*";
        }else{
            $str = '';
            foreach($array as $data){
                if(($data !== false)||(!empty($data))){
                    $str .= '`'.$data.'`,';
                }
            }
            $result = rtrim($str,',');
        }
    }else{
        $result = $array;
    }
    return $result;
}

/**
 * this func parse array into where strings for sql
 *
 * @param  [type] $array [description]
 * @return [type]        [description]
 */
function array_to_where($array){
    $str = "";
    $i   = 0;
    foreach($array as $key => $value){
        if($i !== 0){
            $str .= "\nAND ";
        }
        if(strpos($key,".")){
            $key_explode = explode(".",$key);
            $str .= '`'.$key_explode[0].'`.`'.$key_explode[1].'` = '.$value;
        }else{
            $str .= '`'.$key.'` = '.$value;
        }
        $i ++;
    }
    return $str;
}
/**
 * for service_area->get_area_list.
 *
 * @param  [type] $array [description]
 * @return [type]        [description]
 */
function array_to_where_in($param){
    $str = '`'.$param['name']."` IN (";
    foreach($param['value'] as $value){
        if(($value !== false)||(!empty($value))){
                $str .= $value.',';
        }
    }
    $result = rtrim($str,',');
    $result .= ")";
    return $result;
}

function array_to_comma_list($param){
    $str = "";
    foreach($param as $value){
        if(($value !== false)||(!empty($value))){
            $str .= $value.',';
        }
    }
    $result = rtrim($str,',');
    return $result;
}

function unite_where_in($array){
    $str = "";
    $i   = 0;
    foreach($array as $value){
        if($i !== 0){
            $str .= "\nAND ";
        }
        $str .= $value;
        $i ++;
    }
    return $str;
}
/**
 * for Logic_job->get_search_list.
 * @param  (array) ids
 * @return (str) comma separated string data.
 */
function array_to_where_in_val($array){
    $str = '';

    foreach($array['value'] as $data){
        if(($data !== false)||(!empty($data))){
            $str .= $data[$array['name']].',';
        }
    }
    $result = rtrim($str,',');
    return $result;
}

/**
 * this func parse array into where strings for sql
 *
 * @param  [type] $array [description]
 * @return [type]        [description]
 */
function array_to_update($array){
    $str = "";
    $i   = 0;
    foreach($array as $key => $value){
        if($i !== 0){
            $str .= "\n, ";
        }
        if(strpos($key,".")){
            $key_explode = explode(".",$key);
            $str .= '`'.$key_explode[0].'`.`'.$key_explode[1].'` = "'.$value.'"';
        }else{
            $str .= '`'.$key.'` = "'.$value.'"';
        }
        $i ++;
    }
    return $str;
}

/**
 * for Logic_job->get_search_list.
 * @param  (array) ids
 * @return (str) comma separated string data.
 */
function parse_array_val($array){
    $str = '';

    foreach($array['value'] as $data){
        if(($data !== false)||(!empty($data))){
            $str .= $data.',';
        }
    }
    $result = rtrim($str,',');
    return $result;
}

/**
 * parse Select in array to column names
 * @return string
 * @author Thanh
 * @since 15/4/14
 */
function parseSelect($data){
    return sprintf('`%s`',  implode('`, `' , $data));
}


/**
 * Parse data with keys in array to column names for insert
 * @return string
 * @author Thanh
 * @since 15/4/14
 */
function parseColumns($data){
    $keys = array_keys($data);
    return sprintf('(`%s`)',  implode('`, `' , $keys));
}

/**
 * Parse data with values and quote sql for insert
 * @return string
 * @author Thanh
 * @since 15/4/14
 */
function parseValues($data){
    $values = array_values($data);
    return sprintf("VALUES('%s')",  implode("', '" , $values));
}
