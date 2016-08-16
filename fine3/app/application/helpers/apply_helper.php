<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function status_text($status)
{
    $text = '';
    switch ($status) {
        case 0:
            $text = '未確定';
            break;
        case 1:
            $text = '申請中';
            break;
        case 2:
            $text = '非確定';
            break;
        case 3:
            $text = '確定';
            break;
        default:
            break;
    }
    return $text;
}
