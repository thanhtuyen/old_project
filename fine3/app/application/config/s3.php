<?php defined('BASEPATH') OR exit('No direct script access allowed');

$config['credentials']['key'] = 'AKIAI3GQ4VJ5ADKO3MIQ';
$config['credentials']['secret'] = '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';
$config['region'] = 'ap-northeast-1';

$config['path_style'] = true;
$config['force_path_style'] = true;

$config['version'] = 'latest';

$config['http'] = array();
$config['http']['verify'] = false;
$config['http']['timeout'] = 30;
$config['http']['open_timeout'] = 30;

switch (ENVIRONMENT)
{
  case 'development':
    // $config['debug'] = true;
    // $config['http']['debug'] = true;
    $config['bucket'] = 'hoiku-fine-s3-development';

    //
    // using a proxy: http://docs.aws.amazon.com/aws-sdk-php/guide/latest/configuration.html#using-a-proxy
    //
    if (getenv('HTTP_PROXY')) {
        $config['http']['proxy'] = getenv('HTTP_PROXY');
    }
    break;
  case 'production':
    $config['bucket'] = 'hoiku-fine-s3-production';
    break;

}


