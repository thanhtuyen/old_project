<?php
trait UploadTrait {

    /**
     * do nothing
     */
    public function upload() {
        die('true');

        define('UPLOAD_DIR', 'images/');
        $img = $_POST['img'];
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        $file = UPLOAD_DIR . uniqid() . '.png';
        $success = file_put_contents($file, $data);
        print $success ? $file : 'Unable to save the file.';

    }


    /**
     * Check data type is image base 64
     */
    protected function isImageBase64($imageBase64){
        return preg_match('/^(data:image)\/(png|jpg|gif)(;base64,)/i', $imageBase64);
    }

    protected function getImageBase64Data($imageBase64){
        $img = str_replace('data:image/png;base64,', '', $imageBase64);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        return $data;
    }
}

