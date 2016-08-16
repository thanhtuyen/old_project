<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//auto_extend
$config['true']     =     1;
$config['false']    =     0;

// $this->config->load('plan_config');
// $plan_group_status                                                   = $this->config->item('plan_group_status','plan_config');
// $plan_group_status['disable'];
$config['plan_group_status']['disable']                                 = 0;   //disable
$config['plan_group_status']['publish_plan']                            = 1;   //掲載課金型公開プラン
$config['plan_group_status']['nursery_application_plan']                = 2;   //応募課金型（正社員・契約社員）
$config['plan_group_status']['nursery_part_application_plan']           = 3;   //応募課金型（パート・アルバイト）
$config['plan_group_status']['agent_application_plan']                  = 4;   //応募課金型（正社員・パート）
$config['plan_group_status']['agent_registration_plan']                 = 5;   //一括登録型（正社員・パート）
$config['plan_group_status']['nursery_option']                          = 6;   //追加オプション(園向け）
$config['plan_group_status']['agent_option']                            = 7;   //追加オプション(人材会社向け）
$config['plan_group_status']['private_publish_plan']                    = 8;   //(非公開)掲載課金型公開プラン
$config['plan_group_status']['private_nursery_application_plan']        = 9;   //(非公開)応募課金型（正社員・契約社員）
$config['plan_group_status']['private_nursery_part_application_plan']   = 10;  //(非公開)応募課金型（パート・アルバイト）
$config['plan_group_status']['private_agent_application_plan']          = 11;  //応募課金型（正社員・パート）
$config['plan_group_status']['private_agent_registration_plan']         = 12;  //一括登録型（正社員・パート）
$config['plan_group_status']['private_nursery_option']                  = 13;  //追加オプション(園向け）
$config['plan_group_status']['private_agent_option']                    = 14;  //追加オプション(人材会社向け）
$config['account_type']['disable']                                      = 0;   //disable
$config['account_type']['publish_plan']                                 = 1;   //掲載課金型公開プラン
$config['account_type']['nursery_application_plan']                     = 1;   //応募課金型（正社員・契約社員）
$config['account_type']['nursery_part_application_plan']                = 1;   //応募課金型（パート・アルバイト）
$config['account_type']['agent_application_plan']                       = 2;   //応募課金型（正社員・パート）
$config['account_type']['agent_registration_plan']                      = 2;   //一括登録型（正社員・パート）
$config['account_type']['nursery_option']                               = 1;   //追加オプション(園向け）
$config['account_type']['agent_option']                                 = 2;   //追加オプション(人材会社向け）
$config['account_type']['private_publish_plan']                         = 0;   //(非公開)掲載課金型公開プラン
$config['account_type']['private_nursery_application_plan']             = 0;   //(非公開)応募課金型（正社員・契約社員）
$config['account_type']['private_nursery_part_application_plan']        = 0;   //(非公開)応募課金型（パート・アルバイト）
$config['account_type']['private_agent_application_plan']               = 0;   //応募課金型（正社員・パート）
$config['account_type']['private_agent_registration_plan']              = 0;   //一括登録型（正社員・パート）
$config['account_type']['private_nursery_option']                       = 0;   //追加オプション(園向け）
$config['account_type']['private_agent_option']                         = 0;   //追加オプション(人材会社向け）
$config['basic_plan']['isable']                                         = 0;   //disable
$config['basic_plan']['ublish_plan']                                    = 1;   //掲載課金型公開プラン
$config['basic_plan']['ursery_application_plan']                        = 1;   //応募課金型（正社員・契約社員）
$config['basic_plan']['ursery_part_application_plan']                   = 1;   //応募課金型（パート・アルバイト）
$config['basic_plan']['gent_application_plan']                          = 1;   //応募課金型（正社員・パート）
$config['basic_plan']['gent_registration_plan']                         = 1;   //一括登録型（正社員・パート）
$config['basic_plan']['ursery_option']                                  = 0;   //追加オプション(園向け）
$config['basic_plan']['gent_option']                                    = 0;   //追加オプション(人材会社向け）
$config['basic_plan']['rivate_publish_plan']                            = 1;   //(非公開)掲載課金型公開プラン
$config['basic_plan']['rivate_nursery_application_plan']                = 1;   //(非公開)応募課金型（正社員・契約社員）
$config['basic_plan']['rivate_nursery_part_application_plan']           = 1;   //(非公開)応募課金型（パート・アルバイト）
$config['basic_plan']['rivate_agent_application_plan']                  = 1;   //応募課金型（正社員・パート）
$config['basic_plan']['rivate_agent_registration_plan']                 = 1;   //一括登録型（正社員・パート）
$config['basic_plan']['rivate_nursery_option']                          = 0;   //追加オプション(園向け）
$config['basic_plan']['rivate_agent_option']                            = 0;   //追加オプション(人材会社向け）