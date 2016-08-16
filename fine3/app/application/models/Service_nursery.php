<?php
require_once 'AdminUploadPhotoTrait.php';
Class Service_nursery extends MY_Model{

    use AdminUploadPhotoTrait;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Logic_nursery');
        $this->load->model('Logic_client');


        $this->load->model('Logic_plan');
        $this->load->model('Logic_image');
        $this->load->model('Logic_nursery_station_relation');
        $this->load->model('Logic_station');
        $this->load->model('Logic_line');


    }

    /*
        $param : $nursery
        return : array()
        meaning: get one nursery detail info
    */
    public function get_detail($nursery_id){
        $param['select']    = array('nursery_id',
            'client_id',
            'own_nursery_id',
            'name',
            'area_id',
            'address',
            'capacity',
            'url',
            'station_name',
            'direction',
            'bus_time',
            'walk_time',
            'pr',
            'lat',
            'lon',
            'description',
            'status',
            'ordered',
            'created',
            'updated',
            'delete_flg');
        $param["nursery_id"]  = $nursery_id;
        $param["status"]     = $this->config->item('public','nursery_config');
        $param["delete_flg"] = $this->config->item('not_deleted','common_config');
        $detail_info = $this->Logic_nursery->get_detail($param);

        if(!empty($detail_info[0])){
            $nursery_info = $detail_info[0];
            //set display area name
            $area_name = "";
            $this->load->model('Service_area');
            if(!empty($nursery_info['area_id'])){
                $area_id = $nursery_info['area_id'];
                $area_detail = $this->Service_area->get_detail($area_id);
            }
            if(!empty($area_detail)){
                if($area_detail['city_id'] != 0){
                    //it seems require pref
                    $pref_detail = $this->Service_area->get_pref_detail($area_detail['pref_id']);
                    if(strpos($nursery_info['address'], $pref_detail['name'] . $area_detail['name']) !== false){
                        $nursery_info['address'] = str_replace($pref_detail['name'] . $area_detail['name'], "",$nursery_info['address']);
                    }
                    $nursery_info['display_address'] = $pref_detail['name'] . $area_detail['name'] . $nursery_info['address'];
                }else{
                    $nursery_info['display_address'] = $area_detail['name'] . $nursery_info['address'];
                }
            }else{
                $nursery_info['display_address'] = false;
            }

            //get nursery_tag
            $tag_param      = array('id'         =>  $nursery_id,
                'type'       =>  $this->config->item('type_relation_nursery','tag_config'),
                'delete_flg' =>  $this->config->item('not_deleted','common_config'),
            );

            $this->load->model('Service_tag');
            $this->load->model('Service_image');
            $tags = $this->Service_tag->get_list($tag_param);
            $nursery_info['tags'] = $this->Service_tag->sort_tag($tags);
            $image_param = array('account_id' => $nursery_id,
                'type'       => $this->config->item('nursery','image_config'),
                'status'     => $this->config->item('vaild','image_config'),
                'delete_flg' => $this->config->item('not_deleted','common_config')
            );
            $nursery_info['images'] = $this->Service_image->get_list($image_param);

            //get list station
            $stations = $this->Logic_nursery_station_relation->get_list_station_by_nursery_id($nursery_id, true, array('display_flg'=>1));
            $nursery_info['stations'] = $stations;

            return $nursery_info;
        }else{
            return false;
        }
    }


    public function plan_list($nursery_id)
    {
        $param = array(
            'client_id' => $nursery_id,
            'status'    => $this->config->item('public','plan_config'),
            'delete_flg' =>  $this->config->item('not_deleted','common_config'),
        );

        return $this->Logic_plan->get_related_plan_group($param);
    }

    public function get_photo($nursery_id)
    {
        $type = $this->config->item('client','image_config');
        $param = array(
            'account_id' => $nursery_id,
            'type'       => $type,
            'status'     => $this->config->item('vaild','image_config'),
            'delete_flg' => $this->config->item('not_deleted','common_config')
        );
        $results = $this->Logic_image->get_list($param);

        $photo = array();

        $photo = array_map(function($image) use ($nursery_id, $type){
            return  array( 'ordered' => $image['ordered'], 'url' => $this->getS3Url($nursery_id, $type, $image['name']));
        }, $results);

        $photo = array_column($photo, 'url', 'ordered');

        if (!isset($photo['1'])) {
            $photo['1'] = '';
        }
        if (!isset($photo['2'])) {
            $photo['2'] = '';
        }
        if (!isset($photo['3'])) {
            $photo['3'] = '';
        }
        return $photo;
    }

    /**
     * get admin side nursery detali
     * @return array [nursery info , plan]
     */
    public function get_nursery_detail($nursery_id)
    {
        $param = array(
            'client_id' => $nursery_id,
            'delete_flg' =>  $this->config->item('not_deleted','common_config'),
            // 'status' =>  $this->config->item('enabled','client_config'),
        );

        return array(
            $this->Logic_client->get_client_detail($param),
            $this->plan_list($nursery_id),
            $this->get_photo($nursery_id),
        );
    }

    public function update($param)
    {
        $client_id = $param['client_id'];

        $status = isset($param['status'])
            ? $this->config->item('enabled','client_config')
            : $this->config->item('disabled','client_config');

        $agent_param = array(
            'client_id' => $client_id,
            'name' => $param['name'],
            'department' => $param['department'],
            'contact_name' => $param['contact_name'],
            'mail' => $param['mail'],
            'phone' => $param['phone'],
            'zip_code' => $param['zip_code'],
            'address' => $param['address'],
            'url' => isset($param['url']) ? $param['url'] : '',
            'status' => $status,
            'updated' => current_time(),
        );
        return $this->Logic_client->update($agent_param);
    }

    public function update_pr($param)
    {
        $type_origin = $this->config->item('client', 'image_config');
        $primary = $this->config->item('primary', 'image_config');
        $secondary = $this->config->item('secondary', 'image_config');
        $thirdly = $this->config->item('thirdly', 'image_config');

        $client_id = $param['client_id'];

        $agent_param = array(
            'client_id' => $client_id,
            'establish_date' => isset($param['establish_date']) ? $param['establish_date'] : '1000-01-01 00:00:00',
            'description' => $param['description'],
            'process' => $param['process'],
            'updated' => current_time(),
        );

        $delete_flg = array( 'delete_flg' => $this->config->item('deleted','common_config'));



        $photo = array();

        if( !empty($_FILES['photo1']['tmp_name'] )) {
            $file = $_FILES['photo1'];
            $primary_image_name = 'client_nursery_'. $primary .'_';
            $photo[$primary] = $this->upload_photo($file, $client_id, $type_origin, $primary_image_name);
        }

        if( !empty($_FILES['photo2']['tmp_name'] )) {
            $file = $_FILES['photo2'];
            $secondary_image_name = 'client_nursery_'. $secondary .'_';
            $photo[$secondary] = $this->upload_photo($file, $client_id, $type_origin, $secondary_image_name);
        }

        if( !empty($_FILES['photo3']['tmp_name'] )) {
            $file = $_FILES['photo3'];
            $thirdly_image_name = 'client_nursery_'. $thirdly .'_';
            $photo[$thirdly] = $this->upload_photo($file, $client_id, $type_origin, $thirdly_image_name);
        }

        $is_update_photo = !empty($photo[$primary]) || !empty($photo[$secondary]) || !empty($photo[$thirdly]);

        if ( $is_update_photo ) {
            $photo_param = array(
                'account_id' => $client_id,
                'name' => array_values($photo),
                'type' => $type_origin,
                'ordered' => array_keys($photo),
                'created' => current_time(),
            );
        } else {
            $photo_param = array();
        }


        $CI   = &get_instance();
        $CI->db->trans_begin();

        $this->Logic_client->update($agent_param);

        if ($is_update_photo) {
            $this->Logic_image->delete_batch(array_merge($photo_param, $delete_flg));
            $this->Logic_image->save_batch($photo_param);
        }

        if ($CI->db->trans_status() === FALSE) {
            $CI->db->trans_rollback();
            return ;
        } else {
            $CI->db->trans_commit();
            return true;
        }
    }


    /*
        $param : $nursery
        return : array()
        meaning: get nursery list
    */
    public function get_nursery_list($params)
    {
        $page_size = $params['page_size'];
        $page = $params['page'];
        $start = ($page == 1) ? 0 : ($page * $page_size) - $page_size;
        $params['page_size'] = $page_size;
        $params['start'] = $start;

        $nursery_count = $this->Logic_nursery->get_nursery_count($params);
        $nursery_list = $this->Logic_nursery->get_nursery_list($params);

        return array(
            'nursery_count' => $nursery_count,
            'nursery_list' => $nursery_list,
            'start' => $start
        );
    }

    /*
        return : array()
        meaning: get nursery many infos when create nursery, include
        都道府県 市区町村 施設区分 登録タグ 福利厚生
    */
    public function get_necessary_nursery_info()
    {
        $this->load->model('Logic_area');
        //都道府県
        $prefs = $this->Logic_area->get_pref();
        //市区町村
        $citys = $this->Logic_area->get_city();

        $delete_flg = $this->config->item('not_deleted', 'common_config');

        $this->load->model('Logic_tag');
        //施設区分
        $type_nursery = $this->Logic_tag->get_tag_by_group_id($this->config->item('type_nursery', 'tag_config'));
        //登録タグ
        $tag_nursery = $this->Logic_tag->get_tag_by_group_id($this->config->item('tag_nursery', 'tag_config'));
        //福利厚生
        $tag_insurance = $this->Logic_tag->get_tag_by_group_id($this->config->item('tag_insurance', 'tag_config'));

        return array(
            'prefs' => $prefs,
            'citys' => $citys,
            'type_nursery' => $type_nursery,
            'tag_nursery' => $tag_nursery,
            'tag_insurance' => $tag_insurance,
        );
    }

    /*
        meaning: insert or update nursery
    */
    public function insert_or_update($data, $files, $source_id = null)
    {
        $this->load->model("Logic_tag_relation");
        $this->load->model('Logic_area');
        $delete_flg = $this->config->item('not_deleted', 'common_config');
        $deleted_flg = $this->config->item('deleted', 'common_config');
        $tag_relation_type = $this->config->item('type_relation_nursery', 'tag_config');
        $image_type = $this->config->item('nursery', 'image_config');
        $now = date('Y-m-d H:i:s');
        $area_params = array(
            'pref_id' => $data['pref_id'],
            'city_id' => $data['city_id'],
            'delete_flg' => $delete_flg
        );
        $area = $this->Logic_area->get_area_by_pref_and_city($area_params);

        if($data['lon'] == 0 && $data['lat'] == 0){
            $data['lon'] = 0;
            $data['lat'] = 0;
        }else{
            $data['lon'] = trim($data['lon']);
            $data['lat'] = trim($data['lat']);
        }

        $params = array(
            'client_id' => $data['client_id'],
            'own_nursery_id' => $data['own_nursery_id'] ? $data['own_nursery_id']: '',
            'name' => $data['name'],
            'name_furigana' => isset($data['name_furigana']) ? $data['name_furigana'] : '',
            'area_id' => $area['area_id'] ? $area['area_id'] : 0,
            'address' => $data['address'] ? $data['address']: '',
            'capacity' => $data['capacity'] ? $data['capacity']: 0,
            'url' => $data['url'] ? $data['url']: '',
            'direction' => $data['direction'] ? $data['direction']: '',
            'pr' => $data['pr'],
            'station_name' => $data['station_name'] ? $data['station_name']: '',
            'description' => !empty($data['description']) ? $data['description']: '',
            'status' => $data['status'],
            'ordered' => 0,
            'lon' => $data['lon'],
            'lat' => $data['lat'],
            'walk_time' => $data['walk_time'],
            'bus_time' => $data['bus_time'],
            'created' => $now,
            'updated' => $now,
        );
        
        $this->db->trans_start();

        $stations_insert = array();

        // status update
        if( ($data['status'] == "1")&&(!empty($data['edit_nursery_id'])) ){
            //after deleting. set job status 9 related nursery_id
            $this->load->model('Service_job');
            $this->Service_job->close_nursery($data['edit_nursery_id']);
        }
        if(!empty($data['edit_nursery_id'])){
            $nursery_id = $params['nursery_id'] = $data['edit_nursery_id'];

            // get current nursery info to check if we have any change lon or lat
            // then delete all current nearest stations and update new nearest stations
            $param_get['select']    = array('nursery_id','lon', 'lat' );
            $param_get['delete_flg']    = 0;
            $param_get['status']    = $this->config->item('public','nursery_config');;
            $param_get["nursery_id"]  = $nursery_id;
            $detail_nursery = $this->Logic_nursery->get_detail($param_get);
            $detail_nursery = $detail_nursery [0];
            if (!($params['lon']==$detail_nursery['lon']&&$params['lat']==$detail_nursery['lat'])){
                $this->Logic_nursery_station_relation->delete_all_nearest_station_by_nursery_id($nursery_id);
            }

            $this->Logic_nursery->update_nursery($params);
            $this->Logic_tag_relation->delete_tag_relation($nursery_id, $tag_relation_type);

            //check if the relation is exist then update
            $stations = $data['stations'];

            foreach ($stations as $key => $station){
                $station_data = array (
                    'station_id' => $key,
                    'main_flg' => isset($station['is_main'])?$station['is_main']:0,
                    'display_flg' => isset($station['display'])?$station['display']:1,
                    'delete_flg' => 0
                );
                //check if the relation is exist
                $nearest = $this->Logic_nursery_station_relation->get_relation($nursery_id, $station_data['station_id']);
                if ($nearest){
                    $this->Logic_nursery_station_relation->update_nearest_flag_relation($nearest['nearest_id'], $station_data);
                }else {
                    array_push($stations_insert, $station_data);
                }

            }
        } else {
            $nursery_id = $this->Logic_nursery->insert_nursery($params);

            //insert station near this nursery
            $stations = $data['stations'];

            foreach ($stations as $key => $station){
                $station_data = array (
                    'station_id' => $key,
                    'main_flg' => isset($station['is_main'])?$station['is_main']:0,
                    'display_flg' => isset($station['display'])?$station['display']:1,
                    'delete_flg' => 0
                );
                array_push($stations_insert, $station_data);
            }
        }
        if (count($stations_insert)>0){
            $nearest_relation = array(
                'nursery_id' => $nursery_id,
                'stations' => $stations_insert);
            $this->Logic_nursery_station_relation->regist_nursery_station_relation($nearest_relation);
        }

        //insert 施設区分
        $tag_relation = array(
            'tag_ids' => array($data['type_nursery']),
            'account_id' => $nursery_id,
            'type' => $tag_relation_type
        );
        $this->Logic_tag_relation->regist_tag_relation($tag_relation);
        // insert 福利厚生
        if(!empty($data['tag_insurance'])){
            $tag_relation = array(
                'tag_ids' => $data['tag_insurance'],
                'account_id' => $nursery_id,
                'type' => $tag_relation_type
            );
            $this->Logic_tag_relation->regist_tag_relation($tag_relation);
        }
        // insert 登録タグ
        if(!empty($data['tag_nursery'])){
            $tag_relation = array(
                'tag_ids' => $data['tag_nursery'],
                'account_id' => $nursery_id,
                'type' => $tag_relation_type
            );
            $this->Logic_tag_relation->regist_tag_relation($tag_relation);
        }

        //delete image when edit
        if(!empty($data['delete_image_ids'])){
            foreach(explode('_', $data['delete_image_ids']) as $image_id){
                $this->Logic_image->update_image_to_delete($image_id, $deleted_flg);
            }
        }

        //upload image to s3
        if($files){
            $this->load->model('Service_image');
            $this->load->model('Logic_image');
            $photo_fiels = array('nursery_photo_1', 'nursery_photo_2', 'nursery_photo_3');
            foreach ($photo_fiels as $key => $value) {
                if(!empty($files[$value]['name'])){
                    $rename = $value . '_' . time();
                    $result = $this->Service_image->uploadToS3($files[$value], $nursery_id, 1, $rename);
                    if($result) {
                        if ($value == 'nursery_photo_1') {
                            $ordered = 1;
                        }
                        if ($value == 'nursery_photo_2') {
                            $ordered = 2;
                        }
                        if ($value == 'nursery_photo_3') {
                            $ordered = 3;
                        }
                        $image_param = array(
                            'account_id' => $nursery_id,
                            'name' => $rename,
                            'type' => $image_type,
                            'ordered' => $ordered,
                            'created' => $now
                        );
                        $this->Logic_image->insert_image($image_param);
                    }
                }
            }
        }

        //copy image to s3 and DB
        if($source_id){

            // source nursery images
            $this->load->model('Logic_image');
            $source_image_param = array(
                'account_id' => $source_id,
                'type' => $this->config->item('nursery', 'image_config'),
                'delete_flg' => $delete_flg
            );

            $images = $this->Logic_image->get_list($source_image_param);

            foreach($images as $key => $img){
                $copy_result = $this->Service_image->copyImageDataToS3andDB($source_id, $nursery_id, $img, $now, $key + 1);
            }
        }
        $this->db->trans_complete();
        //update image and nursery ordered
        $image_type = $this->config->item('nursery','image_config');
        $image_param = array('account_id' => $nursery_id,
            'type'       => $image_type,
            'delete_flg' => $this->config->item('not_deleted','common_config'));
        $nursery_images = $this->Logic_image->get_list($image_param);
        $params['ordered'] = count($nursery_images);
        $this->Logic_nursery->update_nursery($params);
    }

    /*
    *   param: $target_id, $lonlat(array)
    *   meaning: update geo information to nursery
    *   return: bool
    */
    public function update_geoinfo($target_id, $lonlat)
    {
        $this->db->trans_start();

        $this->Logic_nursery->update_geo_nursery($target_id, $lonlat);

        $this->db->trans_complete();
    }

    /**
     *   delete nursery
     */
    public function delete($nursery_id)
    {
        $this->db->trans_start();

        //delete nursery
        $this->Logic_nursery->delete($nursery_id);

        //delete nursery image
        $this->Logic_image->delete_image($nursery_id, $this->config->item('nursery', 'image_config'));

        //delete nursery tag_relation
        $this->load->model('Logic_tag_relation');
        $this->Logic_tag_relation->delete_tag_relation($nursery_id, $this->config->item('type_relation_nursery', 'tag_config'));

        $this->db->trans_complete();
    }

    public function get_city_option($pref_id)
    {
        $this->load->model('Logic_area');
        $city_list = $this->Logic_area->get_city_by_pref($pref_id);
        $html = '<option value="">市区町村を選択</option>';
        foreach ($city_list as $key => $city) {
            $html .= '<option value="'.$city['city_id'].'">'.$city['name'].'</option>';
        }
        return $html;
    }

    public function get_csv_data($nursery_ids, $format)
    {
        $headers = $this->config->item('client_nursery', 'export_column_config');
        $this->load->helper('nursery');
        $nursery_array = explode('_', $nursery_ids);
        $nursery = $this->Logic_nursery->get_export_nursery($nursery_array);
        foreach ($nursery as $key => $value) {
            $nursery[$key]['status_text'] = status_text($value['status']);
        }

        $this->load->model('Service_export_file');
        return $this->Service_export_file->export($headers, $nursery, $format);
    }

    public function furigana_list($character = "a"){
        $result = $this->Logic_nursery->get_furigana_list($character);
        return $result;
    }
    public function get_branch_mapdata($client_id = false){
        if($client_id == false){
            return false;
        }
        $result = $this->Logic_nursery->get_branch_mapdata($client_id);
        return $result;
    }
    public function consonant_exist(){
        $this->load->config('phonetic_config');
        $char_array = array('a','ka','sa','ta','na','ha','ma','ya','ra','wa');
        foreach($char_array as $char){
            $character = $this->config->item($char,'phonetic');
            $result[$char] = $this->Logic_nursery->count_consonant($character);
        }
        return $result;
    }

    //$param['nursery_id']==nursery.nursery_id, $param['furigana']==nursery.name_furigana
    public function update_furigana($param){
	$param['updated'] = date('Y-m-d H:i:s');
	$this->Logic_nursery->update_furigana($param);
    }
    /**
     * Get list all nursery use in furigana
     * @return array
     */
    public function get_list_nursery_for_furigana($params)
    {
        $page_size = $params['page_size'];
        $page = $params['page'];
        $start = ($page == 1) ? 0 : ($page * $page_size) - $page_size;
        $params['page_size'] = $page_size;
        $params['start'] = $start;
    
        $nursery_count = $this->Logic_nursery->get_nursery_count_for_furigana($params);
        $nursery_list = $this->Logic_nursery->get_list_nursery_for_furigana($params);
    
        return array(
            'nursery_count' => $nursery_count,
            'nursery_list' => $nursery_list,
            'start' => $start
        );
    }
}
?>
