<?php
Class Service_bookmark extends MY_Model{
    public function __construct()
    {
        parent::__construct();

        $this->load->model("Logic_bookmark");
    }
    /**
     * is_done is the function that user already bookmarked status
     * @return boolean  false or true
     */
    public function is_done($param){
        $this->load->model('Logic_bookmark');

        $select         = array('bookmark_id');
        $user_id        = $param['user_id'];
        $job_id         = $param['job_id'];
        $status         = $this->config->item('done','apply_config');
        $delete_flg     = $this->config->item('not_deleted','common_config');
        $bookmark_param = array('select'       =>  $select,
                                'user_id'      =>  $user_id,
                                'job_id'       =>  $job_id,
                                'status'       =>  $status,
                                'delete_flg'   =>  $delete_flg);
        $record = $this->Logic_bookmark->get_detail($bookmark_param);
        if(!empty($record[0])){
          return true;
        }else{
          return false;
        }
    }
    /**
     * Get detail bookmark
     * @return array
     */
    public function get_detail_bookmark($param){
        $this->load->model('Logic_bookmark');

        $select         = array('bookmark_id', 'delete_flg');
        $user_id        = $param['user_id'];
        $job_id         = $param['job_id'];
        $status         = $this->config->item('done','apply_config');
        $bookmark_param = array('select'       =>  $select,
            'user_id'      =>  $user_id,
            'job_id'       =>  $job_id,
            'status'       =>  $status);
        $record = $this->Logic_bookmark->get_detail_bookmark($bookmark_param);
        return $record;
    }
    /**
     * Count all record bookmarked of current user
     * @param int $user_id']
     * @return number
     */
    public function count($user_id){
        if(!is_numeric($user_id)){
            if(!empty($user_id['user_id'])){
                $params["user_id"] = $user_id['user_id'];
            }
        }else{
            $params["user_id"] = $user_id;
        }
        $params["delete_flg"] = 0;
        $params["status"] = 1;

        return $this->Logic_bookmark->count($params);
    }
    /**
     * Get bookmark and pagination with current user
     * @param array $params
     * $params['select']
     * $params['delete_flg']    // delete_flg job
     * $params['status']        // status job
     * $params['delete_flg']    // delete_flg bookmark
     * $params['status']        // status job
     * $params['user_id']       // user_id
     * @return false/array object
     */
    public function get_bookmark($params, $offset = 0, $limit = 10){
        $result_bookmark = $this->Logic_bookmark->get_bookmark($params, $offset, $limit);

        if($result_bookmark && ! empty($result_bookmark)){
            foreach( (array) $result_bookmark as $key => $item ){
                // Get nursery for each job
                $this->load->model('Service_nursery');
                $nursery = $this->Service_nursery->get_detail($item['nursery_id']);
                if($nursery && ! empty($nursery)){
                    $result_bookmark[$key]['nursery'] = $nursery;

                    // Get full area nursery
                    $this->load->model('Service_area');
                    $area = $this->Service_area->full_area($nursery['area_id']);
                    if($area){
                        $result_bookmark[$key]['area'] = $area;
                    }
                }
                // Get Tag for each job
                $this->load->model('Service_tag');
                $paramTag = [
                    'id' => $item['job_id'],
                    'type' => $this->config->item('type_relation_job', 'tag_config'),
                    'delete_flg' => $this->config->item('not_deleted', 'common_config')
                ];
                $tag = $this->Service_tag->get_tag_job($paramTag);
                if($tag && ! empty($tag)){
                    $arg = array();
                    foreach( (array) $tag as $value ){
                        $arg[$value['tag_group_id']][] = $value;
                    }
                    $result_bookmark[$key]['tag'] = $arg;
                }
                // Get image job
                $this->load->model('Service_image');
                $paramImage = [
                    'account_id' => $item['job_id'],
                    'type' => $this->config->item('job', 'image_config'),
                    'delete_flg' => $this->config->item('not_deleted', 'common_config')
                ];
                $image = $this->Service_image->get_list($paramImage);
                if( $image && ! empty($image)){
                    $arg = array();
                    foreach( (array) $image as $value ){
                        $arg[$value['ordered']] = $value;
                    }
                    $result_bookmark[$key]['image'] = $arg;
                }

                // Get apply job
                // $this->load->model('Service_apply');
                // $paramApply = [
                //     'job_id' => $item['job_id'],
                //     'user_id' => $params['user_id']
                // ];
                // $apply_job = $this->Service_apply->already_apply($paramApply);
                $this->load->model('Logic_applicant_job');
                $apply_job = $this->Logic_applicant_job->check_apply($params['user_id'], $item['job_id']);
                $result_bookmark[$key]['apply_job'] = $apply_job;
            }

        }
        return $result_bookmark;
    }
    /**
     * Check bookmark
     * @param int $bookmark_id
     * @param int $user_id
     * @return boolean
     */
    public function check_bookmark( $bookmark_id, $user_id ){
        $data = false;

        foreach( (array) $bookmark_id as $item ){
            $params = [
                'user_id'       => $user_id,
                'job_id'   => $item
            ];
            $result = $this->Logic_bookmark->getByID( $params );

            if($result && ! empty($result)){
                $data = true;
            }else{
                $data = false;
                break;
            }
        }
        return $data;
    }
    /**
     * Remove bookmark
     * @param int $bookmark_id
     * @param int $user_id
     * @return boolean
     */
    public function remove_bookmark( $bookmark_id, $user_id ){

        $params = [
            'delete_flg' => $this->config->item('deleted', 'common_config'),
            'user_id'       => $user_id,
            'job_id'   => $bookmark_id
        ];
        $result = $this->Logic_bookmark->remove_bookmark( $params );

        return $result;
    }

}
?>
