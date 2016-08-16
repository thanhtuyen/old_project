<?php
Class Service_area extends MY_Model{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Logic_area");
    }

    public function get_area_id($pref_name,$city_name){
        $this->load->model("Logic_area");
        $pref_id = $this->Logic_area->get_pref_id_by_name($pref_name);
        $area_id = $this->Logic_area->get_area_id_by_name($pref_id,$city_name);
        return $area_id;
    }

    /**
     * @param array(
     *              ""
     * @return array():
     */
    public function get_pref_list(){
        $this->load->model("Logic_area");

        $record = $this->Logic_area->get_pref();
        return $record;
    }
    public function get_pref_name($pref = ""){
        $name = "";
        $pref = str_replace('p_','',$pref);
        if(!empty($pref)){
            $return = $this->Logic_area->get_kana_name($pref);
            if(!empty($return[0]['name'])){
                $pref_name = $return[0]['name'];
            }else{
                $pref_name = "";
            }
        }else{
            $pref_name = "";
        }
        // $city = str_replace('c_','',$city);
        // if(!empty($city)){
        //     $return = $this->Logic_area->get_kana_name($city);
        //     if(!empty($return[0]['name'])){
        //         $city_name = $return[0]['name'];
        //     }else{
        //         $city_name = "";
        //     }
        // }else{
        //     $city_name = "";
        // }
        // $name = $pref_name . $city_name;
        return $pref_name;
    }
    public function get_city_list(){
        $this->load->model("Logic_area");

        $record = $this->Logic_area->get_city();
        return $record;
    }

    public function get_pref_city_list(){
        $area_array["pref"] = $this->get_pref_list();
        $area_array["city"] = $this->get_city_list();
        return $area_array;
    }

    /**
     * @param none
     * @return array():
     */
    public function get_pref_exist_jobs(){
        $this->load->model('Logic_job');

        $param['job_id'] = $job_id;
        $record = $this->Logic_job->get_detail($param);
        return $record;
    }

    /**
     * [get area info from entity related function.]
     *       $param  = array('client_id'  =>  $client_id,
     *                       'delete_flg' =>  $this->config->item('','common_config'),
     *                       );
     * @return array[]['area_relation'],['area_detail']
     */
    public function get_list($param){
        $area_relation    = $this->_get_relation_list($param);
        $result = array();
        $i = 0;
        foreach($area_relation as $area){
            $result[$i]['area_relation']     = $area;
            $area_detail                     = $this->get_detail($area['area_id']);
            $result[$i]['area_detail']       = $area_detail;
            $i ++;
        }
        return $result;
    }

    /**
     * [get_relation] is a function that get area_relation info
     * @param  $id      [user_job_nursery_id]
     * @return array
     */
    private function _get_relation_list($param){
       $record = $this->Logic_area->get_relation_list($param);
       return $record;
    }
    /**
     * [get_detail] is a function that get tag information
     * @param  $tag_id      [tag.tag_id]
     * @return array
     */
    public function get_detail($area_id){
       $this->load->model("Logic_area");

       $param['area_id']     = $area_id;
       $param['delete_flg']  = $this->config->item('not_deleted','common_config');
       $record    = $this->Logic_area->get_detail($param);
       if(!empty($record[0])){
          return $record[0];
       }else{
          return false;
       }
    }

    public function get_pref_detail($pref_id){
       $param['pref_id']     = $pref_id;
       $param['delete_flg']  = $this->config->item('not_deleted','common_config');
       $record    = $this->Logic_area->get_pref_detail($param);
       if(!empty($record[0])){
          return $record[0];
       }else{
          return false;
       }
    }
    /*
     * get area_ids from pref ,city and region id
     * @param  [type] $pref_param [description]
     * @return $array area_ids; or false;
     */
    public function get_id_list($pref_param){
    //pref pref_id
    //city city_id
    //region region_id
    //area area_id
        $area_ids = array();
       if(array_key_exists('region_id',$pref_param)){
         $region_id           = $pref_param['region_id'];
         $area_param          = array('region_id'   =>  $region_id,
                                      'delete_flg'  =>  $pref_param['delete_flg']);
         $area_ids            = $this->get_area_list($area_param);
       }else if(array_key_exists('pref_id',$pref_param)){
         $pref_id             = $pref_param['pref_id'];
         $area_param          = array('pref_id'     =>  $pref_id,
                                      'delete_flg'  =>  $pref_param['delete_flg']);
         $area_ids            = $this->get_area_list($area_param);
       }else if(array_key_exists('city_id',$pref_param)){
         $city_id             = $pref_param['city_id'];
         $area_param          = array('city_id'     =>  $city_id,
                                      'delete_flg'  =>  $pref_param['delete_flg']);
         $area_ids            = $this->get_area_list($area_param);
       }
       if(array_key_exists('area_id',$pref_param)){
         $area          = $pref_param['area_id'];
       }else{
         $area            = false;
       }
        if(empty($area_ids)){
            $area_ids              = $area;
         }else if(!empty($area)){
            $area_ids              = array_merge($area_ids,$area);
         }else{
            $area_ids = false;
         }
       return $area_ids;
    }

    public function get_around_ids($area_id){
        $area_info = $this->get_detail($area_id);
        $pref_id   = $area_info['pref_id'];
        $search_param['pref_id'][]    = $pref_id;
        $search_param['delete_flg'] = $this->config->item('not_deleted','common_config');
        $result    = $this->get_area_list($search_param);
        return $result;
    }
    /**
     * sasa for sql version of get_area_list
     * return area_id_array from single pref_id, city_id,region_id.
     * @param  [type] $param [description]
     * @return [type]        [description]
     */
    public function get_area_list($param){

        $this->load->model("Logic_area");


        $where      = array();

        if(array_key_exists('region_id',$param)){
            $region_param = array('name'    =>  'region_id',
                                  'value'   =>  $param['region_id']);
            $where['region_id']    = array_to_where_in($region_param);
        }
        if(array_key_exists('pref_id',$param)){
            $pref_param = array('name'  =>  'pref_id',
                                'value' =>   $param['pref_id']);

            $where['pref_id']    = array_to_where_in($pref_param);
        }
        if(array_key_exists('city_id',$param)){
            $city_param = array('name'  =>  'city_id',
                                'value' =>  $param['city_id']);
            $where['city_id']    = array_to_where_in($city_param);
        }
        if(array_key_exists('delete_flg',$param)){
            $where['delete_flg']    = $param['delete_flg'];
        }
        $result = $this->Logic_area->get_area_list($where);
        if(empty($result)){
            return false;
        }

        foreach ($result as $data){
            $result_row[] = $data['area_id'];
        }
        return $result_row;
    }

    /**
     * Get full area (state, province, city)
     * @param int $area_id
     * @return false/array
     */
    public function full_area($area_id){
        $params = [
            'area_id' => intval($area_id),
            'delete_flg' => $this->config->item('not_deleted','common_config')
        ];
        $this->load->model("Logic_area");
        return $this->Logic_area->full_area($params);
    }


    public function get_province()
    {
        $param = array(
            'delete_flg' => $this->config->item('not_deleted','common_config')
        );
        return $this->Logic_area->get_province($param);
    }



    /**
     * this function is making condition about searching.
     * the logic is depended on whole job search
     * @param  [type] $search_param [from U_2]
     * @return [type]               [description]
     */
    //todo-thinh search list
    public function search_list($search_param){
        $area_array = $this->_area_array($search_param);
        $result = $this->_process_array($area_array);
        //if area_id exist, insert from here
        if(array_key_exists("area_id",$search_param)){
            foreach($search_param['area_id'] as $data){
                $result[] = $data;
            }
        }
        return $result;
    }
    private function _area_array($search_param){
        $logic_param = array();
        $result = array();
        if(array_key_exists('region_id',$search_param)){
            $logic_param['target'] = 'region_id';
            $result['region_id'] = $this->_parse_area_list($search_param['region_id'],$logic_param);
        }
        if(array_key_exists('pref_id',$search_param)){
            $logic_param['target'] = 'pref_id';
            $result['pref_id'] = $this->_parse_area_list($search_param['pref_id'],$logic_param);
        }
        if(array_key_exists('city_id',$search_param)){
            $result['city_id'] = $search_param['city_id'];
        }
        return $result;
    }
    private function _parse_area_list($param,$logic_param){
         foreach($param as $id){
            $logic_param['id'] = $id;
            $result[$id]     = $this->_area_list($logic_param);
         }
        return $result;
    }
    private function _area_list($param){
        $this->load->model("Logic_area");
        if($param['target'] === 'region_id'){
            $array = $this->Logic_area->get_related_region_list($param['id']);
        }else if($param['target'] === 'pref_id'){
            $array = $this->Logic_area->get_related_pref_list($param['id']);
        }

        foreach($array as $data){
            $result[] = $data['area_id'];
        }
        if(!empty($result[0])){
            return $result;
        }else{
            return false;
        }
    }
    private function _process_array($array){
        $result = array();
      if(array_key_exists('region_id',$array)){
        $region_ids = $array['region_id'];
      }else{
        $region_ids = array();
      }
      if(array_key_exists('pref_id',$array)){
        $pref_ids   = $array['pref_id'];
      }else{
        $pref_ids = array();
      }
      if(array_key_exists('city_id',$array)){
        $city_ids   = $array['city_id'];
      }else{
        $city_ids = array();
      }
    // echo('<pre>');
    // echo('<br>[region]<br>');
    // var_dump($region_ids);
    // echo('<br>[pref]<br>');
    // var_dump($pref_ids);
    // echo('<br>[city]<br>');
    // var_dump($city_ids);
    // echo('</pre>');
      //evaluate region and pref
      foreach($region_ids as $key=>$data){
      $judge_result = false;
        if($data !== false){
            foreach($data as $region_id){
                $judge = array_key_exists($region_id,$pref_ids);
                if($judge){
                    $judge_result  = true;
                    $drop_target[] = $key;
                }
            }
        }
          if($judge_result === true){
            foreach($drop_target as $key){
                unset($region_ids[$key]);

            }
            $pref_ids = $region_ids;    //remember that it may cause a bug.
          }
      }

    // echo('<pre><br>[region_checkd]<br>');
    // var_dump($region_ids);
    // var_dump($pref_ids);
    // echo('</pre>');
    //     //evaluate pref and city
    // echo('<pre>[pref_id]');
    // var_dump($pref_ids);
    // var_dump($city_ids);
    // echo('</pre>');
    // $serialize = serialize($city_ids);

      foreach($pref_ids as $key=>$data){
      $judge_result = false;
        if($data !== false){
            foreach($data as $pref_id){
                $judge = array_search($pref_id,$city_ids);
                // $judge = strpos($serialize, $pref_id);
                if($judge !== false){
                    $judge_result  = true;
                    $drop_target[] = $key;
                }
            }
        }
        if($judge_result === true){

            foreach($drop_target as $key){
                unset($pref_ids[$key]);
            }
        }
      }
      //decided which area_ids to use.
    // echo('<pre><br>[pref_checkd]<br>');
    // var_dump($pref_ids);
    // var_dump($city_ids);
    // echo('</pre>');
    //merge array
    $i = 0;
    foreach($region_ids as $data){
        if(is_array($data)){
            foreach($data as $id){
                $result[$i] = $id;
                $i++;
            }
        }else{
                $result[$i] = $data;
                $i++;
        }
    }
    foreach($pref_ids as $data){
        if(is_array($data)){
            foreach($data as $id){
                $result[$i] = $id;
                $i++;
            }
        }else{
                $result[$i] = $data;
                $i++;
        }
    }
    foreach($city_ids as $data){
        if(is_array($data)){
            foreach($data as $id){
                $result[$i] = $id;
                $i++;
            }
        }else{
                $result[$i] = $data;
                $i++;
        }
    }
    return $result;
    }


    public function get_area_name($area_id){
        $param['area_id']     = $area_id;
        $param['delete_flg']  = $this->config->item('not_deleted','common_config');
        $this->load->model("Logic_area");
        $area_arr = $this->Logic_area->get_detail($param);
        if(empty($area_arr)){
            return false;
        }elseif($area_arr[0]["city_id"]==="0"){
            return $area_arr[0]["name"];
        }else{
            $pref_arr = $this->Logic_area->get_pref_by_id($area_arr[0]["pref_id"]);
            return $pref_arr[0]["name"].$area_arr[0]["name"];
        }
    }

    public function get_pref_by_id($pref_id){
        $list = $this->Logic_area->get_pref_by_id($pref_id);
        if (count($list)>0) return $list[0];
        return false;
    }

    public function get_city_by_pref($pref_id)
    {
        return $this->Logic_area->get_city_by_pref($pref_id);
    }


}

