<?php

function getFlashInfo()
{
    $CI   = &get_instance();
    $CI->load->library('session');
    $success_info = @$CI->session->flashdata('notice');
    $error_info   = @$CI->session->flashdata('alert');
    $retrun = '';
    if($success_info) {
        $retrun .=   "<div class='alert alert-success alert-dismissible fade in' role='alert'><button data-dismiss='alert' class='close' type='button'><span aria-hidden='true'>×</span><span class='sr-only'>Close</span></button>{$success_info}</div>";
    }
    if($error_info) {
        $retrun .=   "<div class='alert alert-danger alert-dismissible fade in' role='alert'><button data-dismiss='alert' class='close' type='button'><span aria-hidden='true'>×</span><span class='sr-only'>Close</span></button>{$error_info}</div>";
    }
    return $retrun;
}

function GenerateSql($param)
{
    $CI   = &get_instance();
    $CI->db->update_batch('ads222', $param, 'ads_id');
}