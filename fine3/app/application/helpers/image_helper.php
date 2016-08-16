<?php

/*
 * param
 *  $account_id-  are client_id or nursery_id or job_id which are decided by type
 *  $type      -  1:nursery  2:job 3:client 4:careeradviser
 *  $orderd    -  this is sort number of photo .
 * return
 *  array
 *   key
 *      :path
 *      :thumbnail
 *   value
 *      valuestring's photo path
 *      e.g.
 *        upload/$type/$target_id_$orderd.'jpg'
 *        upload/$type/$target_id.$ordered_thumnail.jpg'
 */
function getImageFromS3($target_id, $type_origin = 0, $ordered = 1) {

    $CI = & get_instance();
    $CI->load->library('AppUploader');
    $path = '';
    if ($type_origin == '1') {
        $type = 'nursery';
        $path = 'upload/nursery/default.jpg';
    } elseif ($type_origin == '2') {
        $type = 'job';
        $path = 'upload/job/default.jpg';
    } elseif ($type_origin == '3') {
        $type = 'client';
        $path = 'upload/client/default.jpg';
    } elseif ($type_origin == '4') {
        $type = 'careeradviser';
        $path = 'upload/careeradviser/default.jpg';
    } elseif ($type_origin == '5') {
        $type = 'ads';
    }else {
        $type = 'tmp';
    }
    if ($ordered) {
        $path = 'upload/' . $type . '/' . $target_id . '_' . $ordered . '.jpg';
    }

    $ret['path']      = $CI->appuploader->getObjectUrl($path);

    // TODO
    // $thumnail         = 'upload/' . $type . '/' . $target_id . '_' . $ordered . '_thumbnail.jpg';
    // $ret['thumbnail'] = $CI->appuploader->getObjectUrl($thumnail);

    return $ret;
}

function getImageUrlFromS3($target_id, $type_origin = 0, $ordered = 1) {
    $result_array = getImageFromS3($target_id, $type_origin, $ordered);
    if(empty($result_array["path"])){
        return null;
    }else{
        return $result_array["path"];
    }
}

/**
  * Check data type is image base 64
  */
function isImageBase64($imageBase64){
     return preg_match('/^(data:image)\/(png|jpg|gif)(;base64,)/i', $imageBase64);
}

function getImageBase64Data($imageBase64){
    $img = str_replace('data:image/png;base64,', '', $imageBase64);
    $img = str_replace(' ', '+', $img);
    $data = base64_decode($img);
    return $data;
}


