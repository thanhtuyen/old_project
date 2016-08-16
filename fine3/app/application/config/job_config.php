<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//open_status
$config['draft']                    = 0;
$config['public']                   = 1;
$config['closed']                   = 2;
$config['force_closed']             = 9;
//common_status
$config['enabled']                  = 1;
$config['disabled']                 = 0;
//search result
$config['search_result_rows']       = 10;

$config['job_description_limit']    = 60;

//job type
//this type related with user application related plan function
$config['fulltime']                 = 19;
$config['parttime']                 = 20;
$config['temp']                     = 21;
$config['dispatch']                 = 22;
$config['future_dispatch']          = 23;