<?php

function getExportUrlPath($format)
{
    $CI   = &get_instance();
    $router = $CI->router;
    $klass = $router->fetch_class();
    $method = $router->fetch_method();
    $path = 'manager/'.$klass.'/'.$method.'/export?format='.$format;
    $urlPath = base_url($path);
    return $urlPath;
}

function generate_password()
{
    $chars = array_merge(range(0,9),
                     range('a','z'),
                     range('A','Z'),
                     array('!','@','$','%','^','&','*'));
    shuffle($chars);
    $password = '';
    for($i=0; $i<8; $i++) {
        $password .= $chars[$i];
    }
    return $password;
}

function current_time()
{
    return date('Y-m-d H:i:s', time());
}

function conversion_account_type($account_type)
{
    switch ($account_type) {
        case 'agent':
            return 2;
            break;
        case 'nursery':
            return 1;
            break;
        default:
            break;
    }
}


function plan_status($date)
{
    if ($date < date('Y-m-d')) {
        return '利用中';
    } else {
        return '終了';
    }
}

function conversion_plan_limit_type($name)
{
    switch ($name) {
        case 'job':
            return '求人票作成数';
            break;
        case 'scoutmail':
            return 'スカウトメール送信数';
            break;
        case 'recommendjob':
            return 'オススメ求人設定数';
            break;
        case 'banner':
            return 'バナー掲載数';
            break;
        case 'textlink':
            return 'テキストリンク掲載数';
            break;
        case 'applicant_job_full':
            return '求人応募者数（正社員）';
            break;
        case 'applicant_job_part':
            return '求人応募者数（正社員以外）';
            break;
        case 'applicant_agency_full':
            return '紹介会社応募者数（正社員）';
            break;
        case 'applicant_agency_part':
            return '紹介会社応募者数（正社員以外）';
            break;
        default:
            break;
    }
}

function is_radio($current, $checked)
{
    if ($current == $checked) {
        return 'checked';
    }
}

function is_switch($status)
{
    if ($status) {
        return 'checked';
    } else {
        return ;
    }
}
function is_selected($current, $checked)
{
        if ($current == $checked) {
            return 'selected';
        } else {
            return ;
        }

}

function plan_is_selected($array, $current)
{
    if (in_array($current, $array)) {
            return 'selected';
    }else {
        return ;
    }
}

function is_checked($checked, $array)
{
    if (in_array($checked, array_keys($array))) {
        return 'checked';
    } else {
        return ;
    }
}

function state_is_checked($current, $checked)
{
    if ($current == $checked) {
        return 'checked';
    } else {
        return ;
    }
}

function is_reccoment($id)
{
    if ($id == '87') {
        return 'star';
    } else {
        return 'normal';
    }
}

function job_status($status)
{
    switch ($status) {
        case 0:
            return 'draft';
            break;
        case 1:
            return 'public';
            break;
        case 2:
            return 'closed';
            break;
        case 9:
            return 'force_closed';
            break;
        default:
            return 'unknown';
            break;
    }
}

function client_status($status)
{
    if ($status == 0) {
        return '有効';
    } elseif ($status == 1) {
        return '無効';
    }else{
	return '不明';
    }
}

function ad_status($status)
{
    if ($status == 1) {
        return '非公開';
    } elseif ($status == 0) {
        return '公開';
    }
}



function d($var1,$var2 = 'XXX', $var3 = 'XXX')
{
    echo "<pre>";
    var_dump($var1,$var2,$var3);
    echo "</pre>";
exit;
}

