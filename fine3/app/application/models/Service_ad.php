<?php
require_once 'AdminUploadPhotoTrait.php';

Class Service_ad extends MY_Model
{
    use AdminUploadPhotoTrait;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Logic_ads');
    }
    /**
     * get ad information
     * @param  [type] $param [description]
     * @return [type]        [description]
     */
    public function get_group_detail_list($param){
        $ids = array();
        $i = 0;
        foreach($param['area_id'] as $data){
          $ids['name']       = 'area_id';
          if(!is_array($data)){
            $ids['value'][$i]  = $data;
          }else if(array_key_exists('area_id',$data)){
            $ids['value'][$i]  = $data['area_id'];
          }else{
            $ids['value'][$i]  = $data;
          }
          $i ++;
        }
        //set param for ad_group
        $group_param['select']    = array('ads_group_id');
        $group_param['status']    = $param['status'];
        $group_param['area_id']  = $ids;
        $group_id                = $this->get_area_group($group_param);
        if(!$group_id){
            // get no-area_id related ad here.
            return false;
        }
        //set param for ad.
        $ad_param['ads_group_id'] = $group_id;
        $ad_param['status']       = $param['status'];
        $ad_param['delete_flg']   = $this->config->item('not_deleted','common_config');
        $ad_param['select'] = array('job_id',
                                    'title',
                                    'url',
                                    'content',
                                    'ads_group_id');
        //foreach for each group related info
        foreach($param['area_id'] as $data){
            $parts_name            = $this->config->item($data,'ad_config');
            $get   = $this->_get_list($ad_param);
            if(is_array($get)){
                $result[$parts_name] = $get;
            }
        }
        return $result;
    }
    public function get_area_group($param){
        $data = $this->Logic_ads->get_group_list($param);
        if(!empty($data[0])){
            foreach($data as $value){
                $result[] = $value['ads_group_id'];
            }
            return $result;
        }else{
            return false;
        }
    }
    private function _get_list($param){


        $list = $this->Logic_ads->get_list($param);
        $result = array();
        if(is_array($list)){
            foreach($list as $data){
                if(array_key_exists($data['ads_group_id'], $this->config->item('job_related','ad_config'))){
                    $result[] = $this->_get_detail($data['job_id']);
                }else{
                    $result[] = $data;
                }
            }
            return $result;
        }else{
            return false;
        }
    }
    private function _get_detail($job_id){
        $this->load->model('Service_job');

        $result = $this->Service_job->get_detail($job_id);
        return $result;
    }

    /**
    * get ads_group for top page
    * @param  $param [status, type]
    * @return $result [ads_group_id, name]
    */
    public function get_top_adsgroup($param){


        //set param for ads_group
        $group_param['select']    = array('ads_group_id', 'name');
        $group_param['status']    = $param['status'];
        $group_param['type']      = $param['type'];
        $result                = $this->Logic_ads->get_adsgroup_bytype($group_param);
        if(!$result){
            // get no-type related ad here.
            return false;
        }
        return $result;
    }

    /**
    * get ads for top page
    * @param  $param [status, type], $ads_group(result of get_top_adsgroup)
    * @return $result [job_id, title, url, content]
    */
    public function get_top_ads($param, $ads_group){
        $this->load->model('Logic_ads');

        if(!$ads_group){
            // get no-type related ad here.
            return false;
        }

        //set param for ad.
        $ad_param['ads_group_id'] = $ads_group[0]['ads_group_id'];
        $ad_param['status']       = $param['status'];
        $ad_param['delete_flg']   = $this->config->item('not_deleted','common_config');
        $ad_param['select'] = array('ads_id',
                                    'job_id',
                                    'title',
                                    'url',
                                    'content');
        $result = $this->Logic_ads->get_list($ad_param);
        if(!$result){
            return false;
        }
        return $result;
    }

    /**
    * get banner ads for top page
    * @param  $ads_id
    * @return $result [job_id, title, url, content]
    */
    public function get_banner_ads($ads_id){
        $this->load->model('Service_image');

        $image_param = array('account_id' => $ads_id,
                             'type'       => $this->config->item('ads','image_config'),
                             'status'     => $this->config->item('vaild','image_config'),
                             'delete_flg' => $this->config->item('not_deleted','common_config')
                            );
        $result = $this->Service_image->get_list($image_param);
        return $result;
    }

    /*---------------------------admin side--------------------------*/
    public function get_total_count($condition)
    {
        $group_id = $this->type_change_group_id($condition['type']);
        if (empty($group_id)) {
            return 0;
        }

        $param = array(
            'delete_flg' => $this->config->item('not_deleted','common_config'),
            //'status' => $this->config->item('public','ad_config'),
            'keyword' => isset($condition['keyword']) ? $condition['keyword'] : null,
            'group_id' => $group_id,
        );

        return $this->Logic_ads->get_total_count($param);
    }

    public function get_list_of_admin($condition, $param)
    {
        if ($param['total'] == 0) {
            return array();
        }
        $group_id = $this->type_change_group_id($condition['type']);
        $param = array(
            'offset' => $param['offset'],
            'limit' => $param['limit'],
            'keyword' => isset($condition['keyword']) ? $condition['keyword'] : null,
            //'status' => $this->config->item('public','ad_config'),
            'delete_flg' => $this->config->item('not_deleted','common_config'),
            'group_id' => $group_id,
            'type' => $this->config->item('ads','image_config'),
        );
       $results = $this->Logic_ads->get_list_of_admin($param);
       $results = array_map(function($result){
            $photo = $this->getS3Url($result['ads_id'], $result['type'], $result['photo']);
            return array_merge($result, array('photo' => $photo));
       }, $results);
       return $results;
    }

    public function get_text_list()
    {
        $group_id = $this->type_change_group_id('text');

        $param = array(
            'status' => $this->config->item('public','ad_config'),
            'delete_flg' => $this->config->item('not_deleted','common_config'),
            'group_id' => $group_id,
            'type' => $this->config->item('ads','image_config'),
        );
        return $this->Logic_ads->get_list_of_admin($param);
    }


    public function get_ads_photo($ads_id)
    {
        $this->load->model('Service_image');
        $type = $this->config->item('ads','image_config');
        $param = array(
            'account_id' => $ads_id,
            'type' => $type,
            'delete_flg' => $this->config->item('not_deleted','common_config'),

        );
        $name = $this->Service_image->get_image_name($param);

        return $this->getS3Url($ads_id, $type, $name);

    }

    public function get_detail_of_admin($ads_id)
    {
        $param = array(
            // 'status' => $this->config->item('public','ad_config'),
            'delete_flg' => $this->config->item('not_deleted','common_config'),
            'ads_id' => $ads_id,
        );
        return $this->Logic_ads->get_detail_of_admin($param);
    }


    public function get_position_group()
    {
        $param = array(
            'ads_group_id' => $this->config->item('banner','ad_config'),
            // 'delete_flg' => $this->config->item('not_deleted','common_config'),
        );

        return $this->Logic_ads->get_position_group($param);
    }
    public function update_job_contents($param){
        $status = isset($param['status'])
        ? $this->config->item('public','ad_config')
        : $this->config->item('private','ad_config');
        $type = $this->config->item('ads','image_config');
        $ad_param = array(
            'ads_id' => $param['ads_id'],
            'ads_group_id' => $param['ads_group_id'],
            'title' => "",
            'job_id' => $param['job_id'],
            'content' => '',
            'url' => '',
            'start_date' => $param['start_date'],
            'end_date' => $param['end_date'],
            'status' => $status,
            'ordered' => 1,
        );

        $ad_group = array(
            'ads_group_id'=> $param['ads_group_id'],
            'area_id'=> $param['area_id'],
        );

        $delete_flg = array('delete_flg' => $this->config->item('deleted','common_config'));

        $CI   = &get_instance();
        $CI->db->trans_begin();

        $this->Logic_ads->update($ad_param);
        $this->Logic_ads->update_group($ad_group);

        if ($CI->db->trans_status() === FALSE) {
            $CI->db->trans_rollback();
            return ;
        } else {
            $CI->db->trans_commit();
            return true;
        }


    }

    public function update_banner($param)
    {
        $status = isset($param['status'])
        ? $this->config->item('public','ad_config')
        : $this->config->item('private','ad_config');

        $ad_param = array(
            'ads_id' => $param['ads_id'],
            'ads_group_id' => $param['ads_group_id'],
            'title' => $param['title'],
            'job_id' => 1,
            'content' => '',
            'url' => $param['url'],
            'start_date' => $param['start_date'],
            'end_date' => $param['end_date'],
            'status' => $status,
            'ordered' => 1,
        );

        $group_param = array(
            'ads_group_id' => $param['ads_group_id'],
            'area_id' => $param['area_id'],
        );

        $file = $_FILES['photo'];
        $type_origin = $this->config->item('ads', 'image_config');

        if( !empty($file['tmp_name'] )) {
            $image_name = 'ads_banner_1_';
            $name = $this->upload_photo($file, $param['ads_id'], $type_origin, $image_name);
        }

        if(! empty($name) ) {
            $image_param = array(
                'name' => $name,
                'account_id' => $param['ads_id'],
                'type' => $this->config->item('ads','image_config'),
            );
        } else {
            $image_param = array();
        }

        $delete_flg = array('delete_flg' => $this->config->item('deleted','common_config'));

        $CI   = &get_instance();
        $CI->db->trans_begin();

        $this->Logic_ads->update($ad_param);
        $this->Logic_ads->update_group($group_param);

        if (!empty($image_param)) {
            $this->Logic_image->delete_flg(array_merge($image_param, $delete_flg));
            $this->Logic_image->save($image_param);
        }

        if ($CI->db->trans_status() === FALSE) {
            $CI->db->trans_rollback();
            return ;
        } else {
            $CI->db->trans_commit();
            return true;
        }

    }

    public function create_banner($param)
    {
        $status = isset($param['status'])
        ? $this->config->item('public','ad_config')
        : $this->config->item('private','ad_config');

        $ad_param = array(
            'ads_group_id' => $param['ads_group_id'],
            'title' => $param['title'],
            'job_id' => 1,
            'content' => '',
            'url' => $param['url'],
            'start_date' => $param['start_date'],
            'end_date' => $param['end_date'],
            'status' => $status,
            'ordered' => 1,
            'created' => current_time(),
        );

        $file = $_FILES['photo'];
        $type_origin = $this->config->item('ads', 'image_config');

        $CI   = &get_instance();
        $CI->db->trans_begin();

        $ads_id = $this->Logic_ads->save($ad_param);

        if( !empty($file['tmp_name'] )) {
            $image_name = 'ads_banner_1_';
            $name = $this->upload_photo($file, $ads_id, $type_origin, $image_name);
        }

        if(! empty($name) ) {
            $image_param = array(
                'name' => $name,
                'account_id' => $ads_id,
                'type' => $type_origin,
            );
        } else {
            $image_param = array();
        }

        if (!empty($image_param)) {
            $this->Logic_image->save($image_param);
        }

        if ($CI->db->trans_status() === FALSE) {
            $CI->db->trans_rollback();
            return ;
        } else {
            $CI->db->trans_commit();
            return true;
        }

    }

    public function create_job_contents($param) {
        $status = isset($param['status'])
        ? $this->config->item('public','ad_config')
        : $this->config->item('private','ad_config');

        $ad_param = array(
            'ads_group_id' => $param['ads_group_id'],
            'job_id' =>$param['job_id'],
            'title'  =>'',
            'url'    =>'',
            'content'=>'', 
            'start_date' => $param['start_date'],
            'end_date' => $param['end_date'],
            'status' => $status,
            'ordered' => 1,
            'created' => current_time(),
        );
        //トランザクションいらないけど＾＾
        $CI   = &get_instance();
        $CI->db->trans_begin();
        $ads_id = $this->Logic_ads->save($ad_param);
        if ($CI->db->trans_status() === FALSE) {
            $CI->db->trans_rollback();
            return false;
        } else {
            $CI->db->trans_commit();
            return true;
        }


    }
    public function create_text($param)
    {

        $ads_group = $param['g'];
        $status = isset($ads_group['status'])
            ? $this->config->item('public','ad_config')
            : $this->config->item('private','ad_config');

        $ads_group_id = $ads_group['ads_group_id'];
        $start_date = $ads_group['start_date'];
        $end_date = $ads_group['end_date'];

        $ordered = $param['ordered'];
        $title = $param['title'];
        $url = $param['url'];

/*        $ad_group = array(
            'ads_group_id'=> $ads_group_id,
            'status' => $status,
        );*/

        $param = array(
            'ads_group_id' => $ads_group_id,
            'job_id' => 1,
            'content' => '',
            'start_date' => $start_date,
            'end_date' => $end_date,
            'status' => $status,
            'created' => current_time(),
        );

        $ad_param = array_map(function ($o, $t, $u) use($param) {
            return array_merge($param, array('title' => $t,  'ordered' => $o, 'url' => $u,));
        }, $ordered, $title, $url);

        $CI   = &get_instance();
        $CI->db->trans_begin();

        $this->Logic_ads->save_batch($ad_param);

        if ($CI->db->trans_status() === FALSE) {
            $CI->db->trans_rollback();
            return ;
        } else {
            $CI->db->trans_commit();
            return true;
        }

    }

    public function update_text($param)
    {
        $ads_group = $param['g'];
        $status = isset($ads_group['status'])
            ? $this->config->item('public','ad_config')
            : $this->config->item('private','ad_config');

        $ads_group_id = $ads_group['ads_group_id'];
        $area_id = $ads_group['area_id'];
        $start_date = $ads_group['start_date'];
        $end_date = $ads_group['end_date'];


        $ads_id = $param['ads_id'];
        $ordered = $param['ordered'];
        $title = $param['title'];
        $url = $param['url'];

        $ad_group = array(
            'ads_group_id'=> $ads_group_id,
            'area_id'=> $area_id,
            'status' => $status,
        );
        $batch_param = array_map(
            function ($a, $o, $t, $u) use ($start_date, $end_date) {
                return array(
                    'ads_id' => $a,
                    'ordered' => $o,
                    'title' => $t,
                    'url' => $u,
                    'start_date' => $start_date,
                    'end_date' => $end_date,
                );
            } , $ads_id, $ordered, $title, $url);

        $CI   = &get_instance();
        $CI->db->trans_begin();

        $this->Logic_ads->update_text($batch_param);
        $this->Logic_ads->update_group($ad_group);

       if ($CI->db->trans_status() === FALSE) {
           $CI->db->trans_rollback();
           return ;
       } else {
           $CI->db->trans_commit();
           return true;
       }

    }

    public function create_partner($param)
    {

        $status = isset($param['status'])
        ? $this->config->item('public','ad_config')
        : $this->config->item('private','ad_config');

        $ad_param = array(
            'ads_group_id' => $param['ads_group_id'],
            'title' => '',
            'job_id' => 1,
            'content' => '',
            'url' => $param['url'],
            'start_date' => $param['start_date'],
            'end_date' => $param['end_date'],
            'status' => $status,
            'ordered' => $param['ordered'],
            'created' => current_time(),
        );

        $file = $_FILES['photo'];
        $type_origin = $this->config->item('ads', 'image_config');

        $CI   = &get_instance();
        $CI->db->trans_begin();

        $ads_id = $this->Logic_ads->save($ad_param);

        if( !empty($file['tmp_name'] )) {
            $image_name = 'ads_partner_1_';
            $name = $this->upload_photo($file, $ads_id, $type_origin, $image_name);
        }

        if(! empty($name) ) {
            $image_param = array(
                'name' => $name,
                'account_id' => $ads_id,
                'type' => $type_origin,
            );
        } else {
            $image_param = array();
        }

        if (!empty($image_param)) {
            $this->Logic_image->save($image_param);
        }

        if ($CI->db->trans_status() === FALSE) {
            $CI->db->trans_rollback();
            return ;
        } else {
            $CI->db->trans_commit();
            return true;
        }

    }

    public function update_partner($param)
    {
        $status = isset($param['status'])
        ? $this->config->item('public','ad_config')
        : $this->config->item('private','ad_config');

        $ad_param = array(
            'ads_id' => $param['ads_id'],
            'ads_group_id' => $param['ads_group_id'],
            'title' => '',
            'job_id' => 1,
            'content' => '',
            'url' => $param['url'],
            'start_date' => $param['start_date'],
            'end_date' => $param['end_date'],
            'status' => $status,
            'ordered' => $param['ordered'],
            'created' => current_time(),
        );

        // $group_param = array(
        //     'ads_group_id' => $param['ads_group_id'],
        //     'area_id' => $param['area_id'],
        // );

        $file = $_FILES['photo'];
        $type_origin = $this->config->item('ads', 'image_config');

        if( !empty($file['tmp_name'] )) {
            $image_name = 'ads_partner_1_';
            $name = $this->upload_photo($file, $param['ads_id'], $type_origin, $image_name);
        }

        if(! empty($name) ) {
            $image_param = array(
                'name' => $name,
                'account_id' => $param['ads_id'],
                'type' => $this->config->item('ads','image_config'),
            );
        } else {
            $image_param = array();
        }

        $delete_flg = array('delete_flg' => $this->config->item('deleted','common_config'));

        $CI   = &get_instance();
        $CI->db->trans_begin();

        $this->Logic_ads->update($ad_param);


        if (!empty($image_param)) {
            $this->Logic_image->delete_flg(array_merge($image_param, $delete_flg));
            $this->Logic_image->save($image_param);
        }

        if ($CI->db->trans_status() === FALSE) {
            $CI->db->trans_rollback();
            return ;
        } else {
            $CI->db->trans_commit();
            return true;
        }
    }

    public function delete_flg($ads_id)
    {
        $param = array(
            'ads_id' => $ads_id,
            'delete_flg' => $this->config->item('deleted', 'common_config'),
        );

        return $this->Logic_ads->delete_flg($param);
    }

    private function type_change_group_id($type)
    {
        $group_type = $this->config->item($type, 'ad_config');
        $group_status = $this->config->item('public','ad_config');
        $group_id = $this->Logic_ads->get_group_id_by_type(
            array(
                'type' => $group_type,
                'status' => $group_status,
            )
        );
        return $group_id;

    }

    /*---------------------------admin side end--------------------------*/






    /*
    public function get_top_ads_group($param){
      $this->load->model('Logic_ads');

      $result = $this->Logic_ads->get_adsgroup_bytype($param);
      if(!empty($result[0])){
        return $result;
      }else{
        return false;
      }
    }*/
    /*
    private function get_ads_list($param){
      $this->load->model('Logic_ads');

      $result = $this->Logic_ads->get_list($param);
      if(!empty($result[0])){
        return $result;
      }else{
        return false;
      }
          return false;
        }
    }*/
}
?>
