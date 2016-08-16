<?php
/**
 * this func parse array into strings for sql 
 * @param  array('user_id','user_name') 
 * @return (str)`user_id`,`user_name`
 */
function parse_get($get){
        $array['pref']     = (array_key_exists('pref',$get))?      explode(',',$get['pref']):      array();
        $array['city']     = (array_key_exists('city',$get))?      explode(',',$get['city']):      array();
        $array['region']   = (array_key_exists('region',$get))?    explode(',',$get['region']):    array();
        $array['job']      = (array_key_exists('job',$get))?       explode(',',$get['job']):       array();
        $array['nursery']  = (array_key_exists('nursery',$get))?   explode(',',$get['nursery']):   array();
        $array['employee'] = (array_key_exists('employee',$get))?  explode(',',$get['employee']):  array();
        $array['tag']      = (array_key_exists('tag',$get))?       explode(',',$get['tag']):       array();
}
