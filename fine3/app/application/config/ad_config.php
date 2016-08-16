<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//status
$config['public']                           = 0;
$config['private']                          = 1;
//position
$config[0]                                  = 'none';
$config[1]                                  = 'job_right_navi';
$config[2]                                  = 'job_content_upper';
$config[3]                                  = 'job_content_lower';
$config[4]                                  = 'text_right_navi';
$config[5]                                  = 'partner_right_navi';
$config[6]                                  = 'banner_content_upper_banner';
$config[7]                                  = 'banner_content_lower_banner';
$config[8]                                  = 'banner_right_navi_upper';
$config[9]                                  = 'banner_right_navi_lower';
//package
$config['right_navi']                       = array(1,4,5,8,9);
$config['content']                          = array(2,3,6,7);
$config['job_related']                      = array(1,2,3);

//type
$config['text'] = array(4);
$config['partner'] = array(5);
$config['banner'] = array(6, 7, 8, 9);
