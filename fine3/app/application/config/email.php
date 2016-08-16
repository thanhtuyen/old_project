<?php 
defined('BASEPATH') OR exit('No direct script access allowed');


//config SES --------------------------------------------------------
$config['protocol']     = 'smtp';
//SMTP server address
// should add ssl:// 
// refer http://stackoverflow.com/questions/1555145/sending-email-with-gmail-smtp-with-codeigniter-email-library
// 
$config['smtp_host']    = 'ssl://email-smtp.us-east-1.amazonaws.com';
//SMTP user
$config['smtp_user']    = 'AKIAIR7DYG5CHCP6A3WA';
//SMTP password      
$config['smtp_pass']    = 'AgBuDJHDTW7OXENM+bBpvvlA34OBYLTU586VhDv8qcV8';
//SMTP port             
$config['smtp_port']    = '465';
//SMTP time limit
$config['smtp_timeout'] = '10';
$config['newline']      = "\r\n";
$config['crlf']         = "\r\n";
$config['mailtype']     = "text";
//config SES --------------------------------------------------------

//config mail setting --------------------------------------------------------
//M_0, Trigger:U_0(when user test it)
$config ['test_2user']['subject'] = 'test email';
$config ['test_2user']['tipps'] = 'false';

//M_1, Trigger:U_8,U_10(when user complete to creating account)
///controllers/user/Signup.php and controllers/user/Campaign.php
$config ['activation_account_2user'] ['subject']  = "仮登録完了のお知らせ【重要】";
$config ['activation_account_2user'] ['tipps']    = 'false';


$config ['account_info_2user'] ['subject']  = "会員登録が完了しました【重要】";
$config ['account_info_2user'] ['tipps']    = 'false';

//M_2, Trigger:U_2,U_18(when user complete to apply the job)
$config ['applicant_job_2user']['subject'] = '求人への応募が完了しました';
$config ['applicant_job_2user']['tipps'] = 'false';

//M_3, Trigger:U_2,U_18(when user complete to apply the job)
$config ['applicant_job_2client']['subject'] = '掲載中の求人へ応募がありました';
$config ['applicant_job_2client']['tipps'] = 'false';

//M_4, Trigger:U_18(When guest complete to apply for job and register at once)
$config ['applicant_signup_2user']['subject'] = '応募完了と仮登録完了のお知らせ【重要】';
$config ['applicant_signup_2user']['tipps'] = 'false';


//M_5_1, Trigger:U_13(When logged-user click "send this inquiry")
//controllers/user/Inquire.php
$config ['inquiry_2user']['subject'] = 'お問い合わせ送信完了のお知らせ';
$config ['inquiry_2user']['tipps'] = 'false';

//M_5_2, Trigger:U_13(When logged-client click "send this inquiry")
$config ['inquiry_2client']['subject'] = 'お問い合わせ送信完了のお知らせ';
$config ['inquiry_2client']['tipps'] = 'false';

//M_5_2_1, Trigger:U_13(When logged-client click "send this inquiry")
//controllers/user/Inquire.php 
$config ['inquiry_2admin']['subject'] = 'お問い合わせがきました';
$config ['inquiry_2admin']['tipps'] = 'false';


//M_5_3, Trigger:U_13,U_24(When anyone non-logged click "send this inquiry")
$config ['inquiry_2guest']['subject'] = 'お問い合わせ送信完了のお知らせ';
$config ['inquiry_2guest']['tipps'] = 'false';

//M_6, Trigger:U_13,U_24(When anyone click "send this inquiry")
$config ['inquiry_2admin']['subject'] = 'お問い合わせが届きました';
$config ['inquiry_2admin']['tipps'] = 'false';

//M_7, Trigger:UL_8(When user complete to withdrawal)
//controllers/user/Mypage.php
$config ['withdrawal_2user']['subject'] = '退会手続きが完了しました';
$config ['withdrawal_2user']['tipps'] = 'false';

//M_8, Trigger:UL_9(When user complete to apply for agency)
//controllers/user/Agent.php
$config ['applicant_agency_2client']['subject'] = '求人紹介希望の求職者様がいます';
$config ['applicant_agency_2client']['tipps'] = 'false';

//M_9, Trigger:UL_9(When user complete to apply for agency)
$config ['applicant_agency_2user']['subject'] = '紹介会社への応募が完了しました';
$config ['applicant_agency_2user']['tipps'] = 'false';

//M_10_1, Trigger:U_16(When user forgot their pass and click "generate new pass" button)
//controllers/user/Password.php
$config ['reset_pass_2user']['subject'] = 'パスワード再発行のお知らせ【重要】';
$config ['reset_pass_2user']['tipps'] = 'false';

//M_10_2, Trigger:C_3(When client forgot their pass and click "generate new pass" button)
//controllers/client/Account.php
$config ['reset_pass_2client']['subject'] = 'パスワード再発行のお知らせ【重要】';
$config ['reset_pass_2client']['tipps'] = 'false';

//M_11_1, Trigger:UL_7(When user change to new-pass by themselves in mypage)
//controllers/user/Mypage.php
$config ['change_pass_2user']['subject'] = 'パスワード変更のお知らせ【重要】';
$config ['change_pass_2user']['tipps'] = 'false';

//M_11_2, Trigger:C_29(When client change to new-pass by themselves in mypage)
//controllers/client/Account.php
$config ['change_pass_2client']['subject'] = 'パスワード変更のお知らせ【重要】';
$config ['change_pass_2client']['tipps'] = 'false';

//M_12, Trigger:C_19,CA_3(When client click "do except apply for this applicant")
$config ['except_apply_2admin']['subject'] = '新着の非課金申請があります';
$config ['except_apply_2admin']['tipps'] = 'false';

//M_13, Trigger:C_20(When client click "send scout mail to selected user" button in scout func)
//Title, Content is written by Client. This is default title
//controllers/client/Scout.php
$config ['scout_mail_2user']['subject'] = '求人からのスカウトが届きました';
$config ['scout_mail_2user']['tipps'] = 'false';

//M_14, Trigger:C_24(When client click "Buy this plan_group" button)
//controllers/client/Plan.php
$config ['buy_plan_2client']['subject'] = '新しいプランのお申込が完了しました';
$config ['buy_plan_2client']['tipps'] = 'false';

//M_15, Trigger:C_24(When client click "Buy this plan_group" button)
//controllers/client/Plan.php
$config ['buy_plan_2admin']['subject'] = 'プランへのお申込がありました';
$config ['buy_plan_2admin']['tipps'] = 'false';

//M_16, Trigger:C_24,C_25(When client click "quit this plan_group" button)
//controllers/client/Plan.php
$config ['quit_plan_2client']['subject'] = 'プランの終了申請が完了しました';
$config ['quit_plan_2client']['tipps'] = 'false';

//M_17, Trigger:C_24,C_25(When client click "quit this plan_group" button)
//controllers/client/Plan.php
$config ['quit_plan_2admin']['subject'] = 'プランの終了申請がありました';
$config ['quit_plan_2admin']['tipps'] = 'false';

//M_18, Trigger:AD_16(when admin create mail and click send button)
//Title, Content is written by Admin. This is default title
$config ['info_2user']['subject'] = '運営事務局からのお知らせ【重要】';
$config ['info_2user']['tipps'] = 'false';

//M_19, Trigger:AD_16(when admin create mail and click send button)
//Title, Content is written by Admin. This is default title
$config ['info_2client']['subject'] = '運営事務局からのお知らせ【重要】';
$config ['info_2client']['tipps'] = 'false';

//M_21, Trigger:AD_45(When admin create client's account and click submit button."
////controllers/client/Account.php
$config ['account_info_2client']['subject'] = 'アカウントを開設のお知らせ【重要】';
$config ['account_info_2client']['tipps'] = 'false';

//M_22, Trigger:(When user scceed to account activation"
////controllers/user/Account.php
$config ['account_info_2user']['subject'] = '会員登録が完了しました【重要】';
$config ['account_info_2user']['to']      = 'user';
$config ['account_info_2user']['tipps'] = 'false';


//send one email about  recommend three job  to user
$config ['send_three_mail_2user']['subject'] = 'の オススメ求人を 最大3件をお届け';
$config ['send_three_mail_2user']['to']      = 'user';
$config ['send_three_mail_2user']['tipps'] = 'false';
