<?php
class Tool extends CI_Controller {
    public function renameS3ImagePath()
    {
        try
        {
            $this->load->model('Service_image');
            $this->Service_image->batchRenameImagePathWithS3();
        }catch(Exception $e){
             echo $e->getMessage();
             echo $e->getTraceAsString();
        }

    }

    public function renameDBImagePath()
    {
        try
        {
            $this->load->model('Service_image');
            $this->Service_image->batchRenameImagePathWithDB();
        }catch(Exception $e){
             echo $e->getMessage();
             echo $e->getTraceAsString();
        }

    }

    public function renameImageNameLocal()
    {
        try
        {
            $this->load->model('Service_image');
            $this->Service_image->batchRenameLocalImage();
        }catch(Exception $e){
             echo $e->getMessage();
             echo $e->getTraceAsString();
        }

    }
}