<?php

Class Service_image extends MY_Model
{

    public function __construct() {
        parent::__construct();
        $this->load->model('Logic_image');
    }



    /* param
     *   $file : array : photo infomation
     *   target_id : each ids depended on type
     *   type :  please look image_helper
     *   orderd : this is sort number
     * return
     *   bool: fail
     *   array: success
     */
    public function uploadToS3($file, $target_id , $type_origin , $ordered)
    {
        $data = fopen($file['tmp_name'], 'r');
        return $this->uploadImageDataToS3($data, $target_id, $type_origin, $ordered);
    }
    /**
     * [get images from entity related function.]
     * @param $image_param    = array('account_id' => $job_param['job_id'],
     *                           'type'       => $this->config->item('job','image_config'),
     *                           'status'     => $this->config->item('vaild','image_config'),
     *                           'delete_flg' => $this->config->item('not_deleted','common_config'));
     * @return array[]
     * if you check where to show tag in the views, please use tag config and $tag['tag_group'][0]['tag_group_id'];
     */
    public function get_list($param)
    {
        $account_id = $param['account_id'];
        $type = $param['type'];
        $delete_flg = $param['delete_flg'];
        //check parameter
        if((is_null($account_id))||(is_null($type))||(is_null($delete_flg))){
          //var_dump($param);
          return false;
        }
       $record = $this->Logic_image->get_list($param);
       if(!empty($record)){
          return $record;
       }else{
          return false;
       }
    }

    public function get_image_name($param)
    {
        return $this->Logic_image->get_image_name($param);
    }



    public function get_photos($param)
    {
        $photos = $this->Logic_image->get_list($param);
        d($photos);
    }





    /* param
     *   $data : binay data
     *   target_id : each ids depended on type
     *   type :  please look image_helper
     *   orderd : this is sort number
     * return
     *   bool: fail
     *   array: success
     */
    public function uploadImageDataToS3($data, $target_id , $type_origin , $ordered)
    {
        if ($type_origin == '1') {
            $type = 'nursery';
        } elseif ($type_origin == '2') {
            $type = 'job';
        } elseif ($type_origin == '3') {
            $type = 'client';
        } elseif ($type_origin == '4') {
            $type = 'careeradviser';
        } elseif ($type_origin == '5') {
            $type = 'ads';
        } else {
            $type = 'tmp';
        }
        $CI = & get_instance();
        $CI->load->library('AppUploader');

        $photo_path['path'] = 'upload/' . $type . '/' . $target_id . '_' . $ordered . '.jpg';

        $result = $CI->appuploader->putObject(array(
            'Key'    => $photo_path['path'],
            'Body'   => $data,
        ));

        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    /* param
     *   source_id : copy source's id
     *   target_id : each ids depended on type
     *   type_origin :  image's type
     *   now : datetime
     * return
     *   bool
     */
    public function copyImageDataToS3andDB($source_id, $target_id, $image, $now, $index)
    {
        if ($image['type'] == '1') {
            $type = 'nursery';
        } elseif ($image['type'] == '2') {
            $type = 'job';
        } elseif ($image['type'] == '3') {
            $type = 'client';
        } elseif ($image['type'] == '4') {
            $type = 'careeradviser';
        } elseif ($image['type'] == '5') {
            $type = 'ads';
        } else {
            $type = 'tmp';
        }
        $CI = & get_instance();
        $CI->load->library('AppUploader');

        $source_dir = 'upload/' . $type;
        $source_key = $source_dir . '/' . $image['account_id']. '_' . $image['name'] . '.jpg';

        $ordered = $type . '_photo_' . $index . '_' . time();
        $path = $source_dir . '/' . $target_id . '_' . $ordered . '.jpg';

        $result = $CI->appuploader->copyObject(array(
            'Key'    => $path,
            'SourceKey' => $source_key,
        ));

        if($result) {
            $image_param = array(
                'account_id' => $target_id,
                'name' => $ordered,
                'type' => $image['type'],
                'ordered' => $image['ordered'],
                'created' => $now
            );
            $this->Logic_image->insert_image($image_param);
        }

        return $result;
    }


    public function batchRenameImagePathWithS3(){
        $dir = "upload";

        $CI = & get_instance();
        $CI->load->library('AppUploader');
        $result = $CI->appuploader->listObjects($dir);
        if ($result['Contents']) {
            foreach ($result['Contents'] as $key) {
                if( preg_match('/^upload\/(job|nursery|client|careeradviser|ads|tmp)\/([\d]+)_([\d])+(\.(jpg))$/', $key['Key'], $matches) ){
                    $from_path = $key['Key'];
                    $back_up_to_path = sprintf("upload_bak/%s/%s_%s%s",
                        $matches[1],
                        $matches[2],
                        $matches[3],
                        $matches[4]
                    );

                    $to_path = sprintf("upload/%s/%s_%s_photo_%s_%s%s",
                        $matches[1],
                        $matches[2],
                        $matches[1],
                        $matches[3],
                        '1420041600',
                        $matches[4]
                    );

                    $bk_copy_result =  $CI->appuploader->copyObject(array(
                                                'MetadataDirective' => 'COPY',
                                                "SourceKey" => $from_path,
                                                "Key"       => $back_up_to_path
                                            ));

                    $copy_result =  $CI->appuploader->copyObject(array(
                                                'MetadataDirective' => 'COPY',
                                                "SourceKey" => $from_path,
                                                "Key"       => $to_path
                                            ));

                    $del_result = $CI->appuploader->deleteObject(array(
                        'Key'    => $from_path,
                    ));
                }
                continue;
            }
        }

    }


    public function batchRenameLocalImage(){
        // $base_dir = "/home/shane/test/";
        $base_dir = APPPATH."../upload/";
        $dir_arr =array("ads","careeradviser","client","job","nursery","nursery");
        foreach ($dir_arr as $key => $n_dir) {
            $dir = $base_dir.$n_dir;
            if (!is_dir($dir)) {
                continue;
            }
            $directory = new RecursiveDirectoryIterator($dir);
            foreach (new RecursiveIteratorIterator($directory) as $filename=>$current) {
                $src = $current->getPathName();
                $file_name = $current->getFileName();
                if($file_name !="." && $file_name!=".."){
                    if( preg_match('/^([\d]+)_([\d])+(\.(jpg))$/', $file_name, $matches) ){

                        $new_file_name = sprintf("%s_%s_photo_%s_%s%s",
                            $matches[1],
                            $n_dir,
                            $matches[2],
                            '1420041600',
                            $matches[3]
                        );
                        // echo $dir.'/'.$file_name;
                        rename($dir.'/'.$file_name,$dir.'/'.$new_file_name);
                    }

                }
            }
        }

    }

    public function batchRenameImagePathWithDB(){
        $this->load->model('Logic_image');
        $image_list = $this->Logic_image->get_all();
        foreach ($image_list as $image) {
            // var_dump($image['name']);
            if( preg_match('/^([\d]+)_([\d])+(\.(jpg))$/', $image['name'], $matches) ){

                if ($image['type'] == '1') {
                    $type = 'nursery';
                } elseif ($image['type'] == '2') {
                    $type = 'job';
                } elseif ($image['type'] == '3') {
                    $type = 'client';
                } elseif ($image['type'] == '4') {
                    $type = 'careeradviser';
                } elseif ($image['type'] == '5') {
                    $type = 'ads';
                } else {
                    $type = 'tmp';
                }
                // upload/job/100000_job_photo_1_1430409600.jpg
                $new_name = sprintf("%s_photo_%s_%s",
                    $type,
                    $matches[2],
                    '1420041600'
                );
                $this->Logic_image->update_name($image['account_id'],$image['type'],$new_name);
            }
            continue;
        }
    }

    public function renameImagePathWithS3($path)
    {
        if ($image['type'] == '1') {
            $type = 'nursery';
        } elseif ($image['type'] == '2') {
            $type = 'job';
        } elseif ($image['type'] == '3') {
            $type = 'client';
        } elseif ($image['type'] == '4') {
            $type = 'careeradviser';
        } elseif ($image['type'] == '5') {
            $type = 'ads';
        } else {
            $type = 'tmp';
        }
        $CI = & get_instance();
        $CI->load->library('AppUploader');

        $source_dir = 'upload/' . $type;
        $source_key = $source_dir . '/' . $image['account_id']. '_' . $image['name'] . '.jpg';

        $ordered = $type . '_photo_' . $index . '_' . time();
        $path = $source_dir . '/' . $target_id . '_' . $ordered . '.jpg';

        $result = $CI->appuploader->copyObject(array(
            'Key'    => $path,
            'SourceKey' => $source_key,
        ));

        if($result) {
            $image_param = array(
                'account_id' => $target_id,
                'name' => $ordered,
                'type' => $image['type'],
                'ordered' => $image['ordered'],
                'created' => $now
            );
            $this->Logic_image->insert_image($image_param);
        }

        return $result;
    }


    /**
     * array $params["account_id"]
     *              ["type"]
     */
    public function delete_image($params){

        $this->load->config("image_config");
        $params["delete_flg"] = $this->config->item("invalid","image_config");

        return $this->Logic_image->delete_flg($params);

    }

    /*
    url: 'https://s3-ap-northeast-1.amazonaws.com/hoiku-fine-s3-development/upload/job/115648_job_photo_1_1432091662.jpg'
    */
    public function s3UrlToFileHandle($url){
        $this->config->load('s3', TRUE);
        $s3_config = $this->config->item('s3');
        $context = stream_context_create(array('http' => $s3_config['http']));
        
        $fpTmp = fopen($url, 'r', false, $context);
        $fp = fopen('php://temp', 'wb');
        fwrite($fp, stream_get_contents($fpTmp));
        rewind($fp);
        return $fp;
    }
  }
?>
