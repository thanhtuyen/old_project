<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function get_job_tag_text($tags, $tag_type)
{
    $tag_name_array = array();
    foreach ($tags as $value) {
        if($value['tag_group_detail']['description'] == $tag_type){
            $tag_name_array[] = $value['tag_detail']['name'];
        }
    }

    if($tag_name_array){
        return implode($tag_name_array, ',');
    } else {
        return null;
    }   
}

function status_text($status)
{
    $text = '';
    switch ($status) {
        case 0:
            $text = '下書き';
            break;
        case 1:
            $text = '公開';
            break;
        case 2:
            $text = '公開終了';
            break;
        case 9:
            $text = '強制非公開';
            break;
        default:
            break;
    }
    return $text;
}