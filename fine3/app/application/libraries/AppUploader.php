<?php

class AppUploader {

    public $s3_client;
    public $s3_bucket;

    public function __construct() {
        $CI = &get_instance();

        $CI->config->load('s3', TRUE);
        $s3_config = $CI->config->item('s3');

        $this->s3_bucket = $s3_config['bucket'];
        unset($s3_config['bucket']);

        $this->s3_client = \Aws\S3\S3Client::factory($s3_config);

        return $this;
    }

    public function putObject( array $args = array() )
    {
        $args['Bucket'] = $this->s3_bucket;
        $args['Body'] = $args['Body'];

        return $this->s3_client->putObject($args);
    }
    
    public function listObjects($dir)
    {
        $args = array(
          'Bucket' => $this->s3_bucket,
          'Prefix' => $dir,
        );
        
        return $this->s3_client->listObjects($args);
    }
    
    public function copyObject( array $args = array() )
    {
        $args['Bucket'] = $this->s3_bucket;
        $args['CopySource'] = $args['Bucket'] . '/' . $args['SourceKey'];
        
        return $this->s3_client->copyObject($args);
    }
    
    /* $key is path of photo
     * $expires is time of expire
     *
     */
    public function getObjectUrl($key, mixed $expires = null, array $args = array() )
    {
        return $this->s3_client->getObjectUrl($this->s3_bucket, $key, $expires, $args);
    }

    public function deleteObject( array $args = array() )
    {
        $args['Bucket'] = $this->s3_bucket;

        return $this->s3_client->deleteObject($args);
    }
}
