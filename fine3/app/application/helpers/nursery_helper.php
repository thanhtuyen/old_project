<?php

function status_text($status)
{
    $text = '';
    switch ($status) {
        case 0:
            $text = '公開';
            break;
        case 1:
            $text = '非公開';
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