<?php
defined('BASEPATH') OR exit('No direct script access allowed');
    if(isset($_SERVER['HTTPS'])){
        $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
    }
    else{
        $protocol = 'http';
    }
    $protocol = $protocol . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    $protocol = "Location: ". $protocol . "error/";
header("Location: ",false,404);