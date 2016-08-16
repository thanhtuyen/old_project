<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['page_limit'] = 100;

$config["default"]['page_query_string']    = true;
$config["default"]['use_page_numbers']     = true;
$config["default"]['enable_query_strings'] = true;
$config["default"]['query_string_segment'] = "page";
$config["default"]['reuse_query_string']   = true;
$config["default"]['uri_segment']          = 5;
$config["default"]['num_links']            = 3;

$config["default"]['full_tag_open']        = '<ul class="pagenation mb0 mt20 mb20">';
$config["default"]['full_tag_close']       = '</ul>';
$config["default"]['first_link']           = '≪ 最初へ';
$config["default"]['last_link']            = '最後へ ≫';

$config["default"]['first_tag_open']       = '<li>';
$config["default"]['first_tag_close']      = '</li>';

$config["default"]['last_tag_open']        = '<li>';
$config["default"]['last_tag_close']       = '</li>';

$config["default"]['cur_tag_open']         = '<li>';
$config["default"]['cur_tag_close']        = '</li>';

$config["default"]['next_tag_open']        = '<li>';
$config["default"]['next_tag_close']       = '</li>';

$config["default"]['num_tag_open']         = '<li>';
$config["default"]['num_tag_close']        = '</li>';

$config["default"]['prev_tag_open']        = '<li>';
$config["default"]['prev_tag_close']       = '</li>';