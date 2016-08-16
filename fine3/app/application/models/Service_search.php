<?php
Class Service_search extends MY_Model{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Updated by ThinhNH
     * Add station id to search param
     * @param $get
     * @param $param
     * @return mixed
     */
    // todo-thinh (search function update) update make_search_param
    public function make_search_param($get, $param)
    {
        //process
        if (empty($get)) {
            $search_request = array();
            $search_word = "全ての求人";
        } else {
            $search_request = $this->Service_job->parse_search_request($get);
            // make search keyword to display
            if (array_key_exists('word', $param)) {
                $search_word = $param['word'];
            } else if (!empty($search_request)) {
                $search_word = $this->Service_job->get_search_word($search_request);
            } else {
                $search_word = '全ての求人';
            }

            $data = $this->Service_job->process_request($search_request, 'station_id');
            if ($data !== false) {
                $search_param['station_id'] = $data;
                $ad_param['station_id'] = $data;
            }
            $data = $this->Service_job->process_request($search_request, 'region_id');
            if ($data !== false) {
                $search_param['region_id'] = $data;
                $ad_param['region_id'] = $data;
            }
            $data = $this->Service_job->process_request($search_request, 'pref_id');
            if ($data !== false) {
                $search_param['pref_id'] = $data;
                $ad_param['pref_id'] = $data;

                //tdk用
                $pref_name = $this->Service_area->get_area_name($data[0]);
            }
            $data = $this->Service_job->process_request($search_request, 'city_id');
            if ($data !== false) {
                $search_param['city_id'] = $data;
                $ad_param['city_id'] = $data;

                //tdk用
                foreach ($data as $key => $val) {
                    $tdk_city = $this->Service_area->get_detail($val);
                    $tdk[] = $tdk_city['name'];
                }
            }
            $data = $this->Service_job->process_request($search_request, 'area_id');
            if ($data !== false) {
                $search_param['area_id'] = $data;
                $ad_param['area_id'] = $data;
            }
            $data = $this->Service_job->process_request($search_request, 'j_tag_id');
            if ($data !== false) {
                $search_param['job_tag_id'] = $data;

                //tdk
                foreach ($data as $key => $val) {
                    $detail = $this->Service_tag->get_detail($val);
                    $tdk[] = $detail['name'];
                }
            }
            $data = $this->Service_job->process_request($search_request, 'n_tag_id');
            if ($data !== false) {
                $search_param['nursery_tag_id'] = $data;

                //tdk
                foreach ($data as $key => $val) {
                    $detail = $this->Service_tag->get_detail($val);
                    $tdk[] = $detail['name'];
                }
            }

            //field
            $page = 1;
            //pagenation here
            if (!empty($param['page'])) {
                $page = $param['page'];
            } else if (array_key_exists('page', $search_request)) {
                $page = $search_request['page'];
            } else {
                $page = 1;
            }
        }

        //returning result

        if (!empty($search_request)) {
            $result['search_request'] = $search_request;
        }
        if (!empty($search_word)) {
            $result['search_word'] = $search_word;
        }
        if (!empty($search_param)) {
            $result['search_param'] = $search_param;
        }
        if (!empty($ad_param)) {
            $result['ad_param'] = $ad_param;
        }
        if (!empty($detail)) {
            $result['detail'] = $detail;
        }
        if (!empty($page)) {
            $result['page'] = $page;
        }
        if (!empty($tdk)) {
            $result['tdk'] = $tdk;
        }
        return $result;
    }
    public function pagination($list_param){
        //set display job limitation
        $search_param['limit_to']   = next_endpoint($list_param);
        $search_param['limit_from'] = next_startpoint($list_param,$search_param['limit_to'],$list_param['page']);
        //make pagenation
        $page_count = 0;
        if($list_param['limit'] > 1000){
            $page_count = 1000;
        }else{
            $page_count = $list_param['limit'];
        }
        $pagination_param['page_count'] = $page_count;
        $pagination_param['search_param'] = $search_param;
        return $pagination_param;
    }
}