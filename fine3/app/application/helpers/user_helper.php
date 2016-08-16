<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function status_text($status)
{
    $text = '';
    switch ($status) {
        case 0:
            $text = '仮登録';
            break;
        case 1:
            $text = '有効';
            break;
        case 2:
            $text = '凍結';
            break;
        default:
            break;
    }
    return $text;
}

function gender_text($status)
{
    $text = '';
    switch ($status) {
	case 1:
            $text = '女性';
            break;
        case 2:
            $text = '男性';
            break;
        default:
            break;
    }
    return $text;
}
