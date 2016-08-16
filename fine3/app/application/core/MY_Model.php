<?php

class MY_Model extends CI_Model
{
    public function __construct() {
        parent::__construct();

            //config
            $this->config->load('common_config', TRUE);
            $this->config->load('job_config', TRUE);
            $this->config->load('nursery_config', TRUE);
            $this->config->load('client_config', TRUE);
            $this->config->load('tag_config', TRUE);
            $this->config->load('apply_config', TRUE);
            $this->config->load('bookmark_config', TRUE);
            $this->config->load('image_config', TRUE);
            $this->config->load('user_config', TRUE);
            $this->config->load('career_adviser_config', TRUE);
            $this->config->load('template_config', TRUE);
            $this->config->load('plan_config', TRUE);

        }
}
