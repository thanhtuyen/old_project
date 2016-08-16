<?php
Class Service_tag extends MY_Model{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Logic_tag');
    }
    /**
     * [get tag info from entity related function.]
     *       $param  = array('id'         =>  $id,
     *                       'type'       =>  $this->config->item('','tag_config'),
     *                       'delete_flg' =>  $this->config->item('','common_config'),
     *                       );
     * @return array[]['tag_relation'],['tag_detail'],['tag_group_detail']
     * if you check where to show tag in the views, please use tag config and $tag['tag_group'][0]['tag_group_id'];
     * @deprecated use function get_list_relation below
     * (because param of get_single_detail($param) wrong, view detail tag: param = tag_id, not tag_relation_id)
     */
    // this is old version of get_list.
//     public function get_list($param,$select = null){
//         $parse_select = $this->_select_sort($select);
//         $time_start = microtime(true);
//         $tag_relation    = $this->_get_relation_list($param);
//         $result = array();
//         $i = 0;
//         $time_end = microtime(true);$time = $time_end - $time_start;echo "<br>>>>[tag_relation time]".$time."秒掛かりました。<br>";
//         $time_start = microtime(true);
//         if(!empty($tag_relation)){
//             foreach($tag_relation as $tag){
//                 $result[$i]['tag_relation']     = $tag;
//                 $tag_detail                   = $this->get_single_detail($tag['tag_id']);
//                 $result[$i]['tag_detail']       = $tag_detail;
//                 $tag_group_detail             = $this->_get_group_detail($tag_detail['tag_group_id']);
//                 $result[$i]['tag_group_detail'] = $tag_group_detail;
//                 $i ++;
//             }
//         }
//         $time_end = microtime(true);$time = $time_end - $time_start;echo "<br>>>>[tag processing time]".$time."秒掛かりました。<br>";
//         return $result;
//     }
//     
    public function get_list($param,$select = null){
        $result = false;
        $parse_select = $this->_select_sort($select);
        $tag_raw    = $this->Logic_tag->get_display($param,$parse_select);
        $i = 0;
        foreach ($tag_raw as $tag){
            if(!empty($tag)){
                foreach ($tag as $key=>$data){
                    if(strstr($key, 'tag_relation__') !== false){
                        $key_trimmed = str_replace('tag_relation__', '', $key);
                        $result[$i]['tag_relation'][$key_trimmed] = $data;
                    }
                    if(strstr($key, 'tag__') !== false){
                        $key_trimmed = str_replace('tag__', '', $key);
                        $result[$i]['tag_detail'][$key_trimmed] = $data;
                    }
                    if(strstr($key, 'tag_group__') !== false){
                        $key_trimmed = str_replace('tag_group__', '', $key);
                        $result[$i]['tag_group_detail'][$key_trimmed] = $data;
                    }
                }
                $i ++;
            }
        }
        return $result;
    }
    private function _select_sort($select){
        if(empty($select['tag_relation'])){
            $select['tag_relation'] = array('tag_relation.tag_id AS tag_relation__tag_id');
        }
        if(empty($select['tag'])){
            $select['tag'] = array('tag.tag_id AS tag__tag_id','tag.name AS tag__name' ,'tag.link_name AS tag__link_name','tag.tag_group_id AS tag__tag_group_id','tag.description AS tag__description');
        }
        if(empty($select['tag_group'])){
            $select['tag_group'] = array('tag_group.tag_group_id AS tag_group__tag_group_id','tag_group.name AS tag_group__name','tag_group.prefix AS tag_group__prefix','tag_group.description AS tag_group__description');
        }
        return $select;
    }

    //can set tag_group_id, account_id, type
    public function getTags($param){
	if(!isset($param['type']) OR !isset($param['tag_group_id']) OR !isset($param['account_id'])){
	    return false;
	}
	$this->load->model('Logic_tag_relation');
	$result = $this->Logic_tag_relation->getTags($param);
	return $result;
    }


    /**
     * [get tag info from entity related function.]
     *       $param  = array('id'         =>  $id,
     *                       'type'       =>  $this->config->item('','tag_config'),
     *                       'delete_flg' =>  $this->config->item('','common_config'),
     *                       );
     * @return array[]['tag_relation'],['tag_detail'],['tag_group_detail']
     * if you check where to show tag in the views, please use tag config and $tag['tag_group'][0]['tag_group_id'];
     * @since 2015/04/22
     * @return array
     */
    public function get_list_relation($param){
        $tag_relation    = $this->_get_relation_list($param);
        $result = array();
        $i = 0;
        foreach($tag_relation as $tag){
            $result[$i]['tag_relation']     = $tag;
            $tag_detail                   = $this->get_single_detail($tag['tag_id']);

            $result[$i]['tag_detail']       = $tag_detail;
            $tag_group_detail             = $this->_get_group_detail($tag_detail['tag_group_id']);
            $result[$i]['tag_group_detail'] = $tag_group_detail;
            $i ++;
        }
        return $result;
    }

    /**
     * get tag_group list
     * @param  [arrat]
     * @return [array]
     */
    public function get_tag_group()
    {
        $param = array(
            'delete_flg' => $this->config->item('not_deleted','common_config')
          );
        return $this->Logic_tag->get_tag_group($param);
    }

    /**
     * [get_categories]  get all tags according to the group
     * @return [array]
     */
    public function get_categories()
    {
      $param = array(
          'delete_flg' => $this->config->item('not_deleted','common_config')
        );
      $groups = $this->get_tag_group();

      if (empty($groups)) return array();

      $group_id = array_column($groups, 'tag_group_id');
      $param = array_merge($param, array('group_id' => $group_id));

      $tags = $this->Logic_tag->get_list($param);

      return $this->_generate_categories_param($groups, $tags);
    }

    public function get_detail($tag_id)
    {
        return $this->get_single_detail($tag_id);
    }

    /**
     * create tag
     * @param  [array] $param
     * @return [bool]
     */
    public function save($param)
    {
      list($tag_group_id, $description) = explode('*', $param['group']);
      $param = array(
        'tag_group_id' => $tag_group_id,
        'name' => $param['name'],
        'description' => $description,
        'ordered' => $param['ordered'],
      );

      return $this->Logic_tag->save($param);
    }

    public function save_tag_group($param)
    {

      if (empty($param['ordered'])) throw new Exception("ordered is required", 1);
      if (empty($param['description'])) throw new Exception("description is required", 1);

      $param = array(
          'name' => $param['name'],
          'ordered' => $param['ordered'],
          'description' => $param['description'],
      );
      return $this->Logic_tag->save_tag_group($param);
    }

    /**
     * update tag_group info
     * @param  [array] $param
     * @return [bool]
     */
    public function update_for_tag_group($param)
    {
        $param = array(
            'tag_group_id' => $param['tag_group_id'],
            'name' => $param['name'],
            'ordered' => $param['ordered'],
            'description' => $param['description'],
        );
        return $this->Logic_tag->update_for_tag_group($param);
    }
    /**
     * update tag info
     * @param  [array] $param
     * @return [bool]
     */
    public function update($param)
    {
        list($tag_group_id, $description) = explode('*', $param['group']);
        $param = array(
            'tag_group_id' => $tag_group_id,
            'name' => $param['name'],
            'description' => $description,
            'ordered' => $param['ordered'],
            'tag_id' => $param['tag_id'],
        );
        return $this->Logic_tag->update($param);
    }

    /**
     * [delete the tag_group by id]
     * @param  [str] $id
     * @return [bool]
     */
    public function delete_for_tag_group($id)
    {
        $param = array(
            'tag_group_id' => $id,
            'delete_flg' => $this->config->item('deleted', 'common_config'),
            'updated' => date('Y-m-d H:i:s', time())
        );

        return $this->Logic_tag->delete_for_tag_group($param);
    }

    /**
     * [delete the tag by id]
     * @param  [str] $id
     * @return [bool]
     */
    public function delete_flg($id)
    {
        $param = array(
            'tag_id' => $id,
            'delete_flg' => $this->config->item('deleted', 'common_config'),
            'updated' => date('Y-m-d H:i:s', time())
        );

        return $this->Logic_tag->delete_flg($param);
    }
    /**
     * batch delete info by group_id or tag_id
     * @param  [array] $group_id [description]
     * @param  [array] $tag_id   [description]
     * @return [bool]
     */
    public function batch_delete($group_id, $tag_id)
    {
        $delete_flg = $this->config->item('deleted', 'common_config');
        $group_arg = explode(',', $group_id);
        $tag_arg = explode(',', $tag_id);

        if ( ! empty($group_id)) {
            $group_data = array_map(function($id) use($delete_flg){
                    return array('tag_group_id' => $id, 'delete_flg' => $delete_flg);
            }, $group_arg);

        } else {
            $group_data = array();
        }

        if (!empty($tag_id)) {
            $tag_data = array_map(function($id) use($delete_flg){
                    return array('tag_id' => $id, 'delete_flg' => $delete_flg);
            }, $tag_arg);
        } else {
            $tag_data = array();
        }

        $param = array($group_data, $tag_data);
        $CI   = &get_instance();
        $CI->db->trans_begin();
        if (! empty($tag_data)) {
            $this->Logic_tag->batch_delete_tag($tag_data);
        }

        if (! empty($group_data)) {
            $this->Logic_tag->batch_delete_group($group_data);
        }

        if ($CI->db->trans_status() === FALSE) {
            $CI->db->trans_rollback();
            return ;
        } else {
            $CI->db->trans_commit();
            return true;
        }



    }

    /**
     * get tag_group detail by tag_group_id
     * @param  [string] $tag_group_id
     * @return [array]
     */
    public function get_tag_group_detail($tag_group_id)
    {
        $param['tag_group_id']     = $tag_group_id;
        $param['delete_flg'] = $this->config->item('not_deleted','common_config');
        return $this->Logic_tag->get_tag_group_detail($param);
    }


    /**
     * [get_relation] is a function that get tag_relation info
     * @param  $id      [account_id]
     * @param  $type    [relation_type see config]
     * @return array
     */
    private function _get_relation_list($param){
       $record = $this->Logic_tag->get_relation_list($param);
       return $record;
    }
    /**
     * [get_detail] is a function that get tag information
     * @param  $tag_id      [tag.tag_id]
     * @return array
     */
    public function get_single_detail($tag_id){
       $param['tag_id']     = $tag_id;
       $param['delete_flg'] = $this->config->item('not_deleted','common_config');
       $record    = $this->Logic_tag->get_detail($param);
       if(!empty($record[0])){
          return $record[0];
       }else{
          return false;
       }
    }
    /**
     * [get_group_detail] is a function that get tag group information
     * @param  $tag_group_id      [tag.tag_group_id]
     * @return array
     */
    private function _get_group_detail($tag_group_id){
       $param['tag_group_id']     = $tag_group_id;
       $param['delete_flg'] = $this->config->item('not_deleted','common_config');
       $record = $this->Logic_tag->get_group_detail($param);
       if(!empty($record[0])){
          return $record[0];
       }else{
          return false;
       }
    }

    public function sort_tag($tag_array){
        $result = array(array(array()));

        if(!is_array($tag_array)){
            return false;
        }
        $i = 0;
        $result = array();
        $keys = array();
        foreach($tag_array as $tag){
            $result[ $tag['tag_group_detail']['description'] ][$i]['tag_detail'] = $tag['tag_detail'];
            $result[ $tag['tag_group_detail']['description'] ][$i]['tag_group_detail'] = $tag['tag_group_detail'];
            if(!array_search($tag['tag_group_detail']['description'],$keys)){
                $keys[] = $tag['tag_group_detail']['description'];
            }
            $i ++;
        }
        $sort_result = array();
        foreach($keys as $data){
            $sort_result[$data] = array_merge($result[$data]);
        }
        return $result;
    }


    /**
     * [generate categories param]
     * @param  [array] $groups
     * @param  [array] $tags
     * @return [array]
     */
    private function _generate_categories_param($groups, $tags)
    {
        foreach ($groups as &$group) {
            foreach ($tags as $tag) {
                if ($group['tag_group_id'] == $tag['tag_group_id']) {
                    $group['tags'][] = $tag;
                }

            }
        }
        unset($group);
        return $groups;
    }
    /**
     * Get tag of job
     * view all tag relative job
     * @param array $param
     * @return multitype:Ambigous <multitype:, boolean, unknown> |boolean
     * @deprecated use function get_detail_only_tag($param)
     */
    public function get_tag_job($param){
        $tag_relation    = $this->_get_relation_list($param);


        $result = array();
        if($tag_relation && ! empty($tag_relation)){
            foreach( (array) $tag_relation as $item ){
                $tag_id = $item['tag_id'];
                $result[] = $this->get_single_detail($tag_id);
            }
            return $result;
        }

        return false;
    }

    /**
     * Get only tag detial
     * @param array $param
     * $param['account_id']
     * $param['type']
     * @return multitype:Ambigous <multitype:, boolean, unknown> |boolean
     */
    public function get_detail_only_tag($param){
        $tag_relation    = $this->_get_relation_list($param);


        $result = array();
        if($tag_relation && ! empty($tag_relation)){
            foreach( (array) $tag_relation as $item ){
                $tag_id = $item['tag_id'];
                $result[] = $this->get_single_detail($tag_id);
            }
            return $result;
        }

        return false;

    }
    public function get_tag_list_all(){
        $tag_list["nursery"] = $this->Logic_tag->get_tag_by_group_id(1);
        $tag_list["job"] = $this->Logic_tag->get_tag_by_group_id(2);
        $tag_list["employee"] = $this->Logic_tag->get_tag_by_group_id(3);
        $tag_list["license"] = $this->Logic_tag->get_tag_by_group_id(4);
        $tag_list["tag"] = $this->Logic_tag->get_tag_by_group_id('5 ,6');
        return $tag_list;
    }

    public function get_occupation_list()
    {
        $param = array(
            'delete_flg' => $this->config->item('not_deleted','common_config'),
            'tag_group_id' => $this->config->item('type_job','tag_config'),
        );

        return $this->Logic_tag->get_occupation_list($param);
    }
    public function get_tag_job_list()
    {
        $result =  $this->Logic_tag->get_tag_job_list();
        if(empty($result)){
            return false;
        }else{
            return $result;
        }
    }
    public function get_all_tag()
    {
        $result =  $this->Logic_tag->get_all_tag();
        if(empty($result)){
            return false;
        }else{
            return $result;
        }
    }

    public function  get_relation_by_job($param){
         return $this->Logic_tag-> get_relation_by_job($param);
    }

    public function generate_tag_url($source_url){    
            $tag_url = "";
            if(!empty($source_url)){
                $tag_url = $source_url;
            }else{
                $tag_url = base_url();
            }
        return $tag_url;
    }
}
?>



