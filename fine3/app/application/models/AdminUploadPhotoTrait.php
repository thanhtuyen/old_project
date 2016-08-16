<?php

trait AdminUploadPhotoTrait
{
    public function upload_photo($file, $account_id, $type_origin, $name)
    {
        $this->load->model('Service_image');
        $rename = $name . time();
        $result = $this->Service_image->uploadToS3($file, $account_id, $type_origin, $rename);

        if(! $result) {
            $rename = '';
        }

        return $rename;
    }

    public function getS3Url($account_id, $type, $name){
      return getImageFromS3($account_id, $type, $name)['path'];
    }
}