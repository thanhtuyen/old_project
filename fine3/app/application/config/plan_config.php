<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//limit_type
$config['job']                                                          = 0;
$config['scoutmail']                                                    = 1;
$config['recommendjob']                                                 = 2;
$config['banner']                                                       = 3;
$config['textlink']                                                     = 4;
$config['applicant_job_full']                                           = 5;
$config['applicant_job_part']                                           = 6;
$config['applicant_agency_full']                                        = 7;
$config['applicant_agency_part']                                        = 8;


//status
$config['draft']                                                        = 0;
$config['public']                                                       = 1;
$config['closed']                                                       = 2;


$config['limit_type'] = array(
    'job' => 0,
    'scoutmail' => 1,
    'recommendjob' => 2,
    'banner' => 3,
    'textlink' => 4,
    'applicant_job_full' => 5,
    'applicant_job_part' => 6,
    'applicant_agency_full' => 7,
    'applicant_agency_part' => 8,
);


$config['limit_type_job']                                               = 0;   //求人票作成数
$config['limit_type_scoutmail']                                         = 1;   //スカウトメール送信数
$config['limit_type_recommendjob']                                      = 2;   //オススメ求人設定数
$config['limit_type_banner']                                            = 3;   //バナー掲載数
$config['limit_type_textlink']                                          = 4;   //テキストリンク掲載数
$config['limit_type_applicant_job_full']                                = 5;   //求人応募者数（正社員）
$config['limit_type_applicant_job_part']                                = 6;   //求人応募者数（正社員以外）
$config['limit_type_applicant_agency_full']                             = 7;   //紹介会社応募者数（正社員）
$config['limit_type_applicant_agency_part']                             = 8;   //紹介会社応募者数（正社員以外）
$config['status_draft']                                                 = 0;   //下書き(default)
$config['status_public']                                                = 1;   //公開
$config['status_closed']                                                = 2;   //非公開
$config['auto_extend_TRUE']                                             = 1;   //自動延長する
$config['auto_extend_FALSE']                                            = 0;   //自動延長しない