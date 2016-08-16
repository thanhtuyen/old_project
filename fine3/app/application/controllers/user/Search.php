<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once 'Job.php';

class Search extends Job
{
    const RESPONSE_CODE_ERROR   = 0;    // Ajax Response : ERROR
    const RESPONSE_CODE_SUCCESS = 1;    // Ajax Response : SUCCESS

    public function __construct() {
        parent::__construct();

        $this->load->model('Service_station');

    }

    public function station_select($line_id=false){
        if (is_numeric($line_id)) {
            $line_id_str = $line_id;
        }else {
            $line_id_str = $this->input->get('line_id');
        }

        if ($this->input->get('pref_id')) {
            $pref_id = $this->input->get('pref_id');
        }else if(isset($_SESSION['pref_id'])) {
            $pref_id = $_SESSION['pref_id'];
        } else {
            $line = $this->Logic_line->get_pref_id_by_line_id($line_id_str);
            $pref_id = $line[0]['default_pref_id'];
        }
        $top_page_url ="";
        if($pref_id ) {
            $pref = $this->Service_area->get_pref_by_id($pref_id);
            $top_page_url = "/railway/".$pref['romaji'];
        }
        $list_lines = false;
        if (!empty($line_id_str)){
            $id_array = explode(",",$line_id_str);
            if (count($id_array)>0){
                $list_lines = $this->Service_station->get_list_line_by_many_line_id($id_array, $pref_id);
            }
        }
        if(empty($list_lines)){
             $this->general_error(404);
            exit;
        }

        $this->load->model("Service_tag");
        $this->smarty->assign("tags",$this->Service_tag->get_tag_list_all());

        $this->smarty->assign('top_page', $top_page_url);
        $this->smarty->assign('list_lines', $list_lines);
        $this->smarty->assign('pref', $pref);
        $this->smarty->display($this->template_path().'/user/job/station_select.html');
    }


    public function search_by_single_station($station_id){
        $uri = $_SERVER['REQUEST_URI'];
        //generate uri
        $get_string = strstr($uri, '?');
        if(empty($get_string)){
            $segment = explode('/',ltrim($uri,'/'));
        }else{
            $trimmed = str_replace($get_string, "", $uri);
            $segment = explode('/',ltrim($trimmed,'/'));
        }
        write_log($segment);

        if($segment[0] == "index.php"){
            unset($segment[0]);
            if(!empty($segment[1])){
                $alt = $segment[1];
                $segment = array();
                $segment[0] = $alt;
            }
        }
        $param_array = $this->Service_job->generate_search_param($segment);
        $uri = ltrim($uri,'/');
        $page = $this->input->get('page');

        if($page > 0){
            $param['page'] = $page;
        }
        $chk_ajax = $this->input->post('is_ajax');
        if(!empty($chk_ajax)){
            $param['is_ajax'] = true;
        }
        $param['get'] = $this->Service_job->generate_get_param($param_array,$page);
        $param['get']['station'] = $station_id;

        //if over 2 kinds of tags inserted, use get parameter
        if($param['get']['double'] === true){
            unset($param['get']['double']);
            $get_parameter = "";
            $get_parameter = $param['get']['get_param'];
            $url = base_url().$get_parameter;
            unset($param['get']['get_param']);
            redirect($url);
        }else{
            unset($param['get']['double']);
        }
        //generate tag_url
        $tag_url = str_replace($get_string,"",$uri);
        $param['tag_url'] = base_url().$tag_url;
        $this->smarty->assign('single_station', true);
        $get_param = $this->parse_segment_to_get_params($uri);
        if ($get_param){
            if (isset($param['get'])){
                $param['get'] = array_merge($param['get'], $get_param);
            }else {
                $param['get'] =  $get_param;
            }
        }
        $this->search($param);
    }

    private function parse_segment_to_get_params($uri){
        $job_id = $this->get_id_from_string("job_", $uri);
        $nursery_id = $this->get_id_from_string("nursery_", $uri);
        $employee_id = $this->get_id_from_string("employee_", $uri);
        $tag_id = $this->get_id_from_string("tag_", $uri);
        $result = false;
        if ($job_id){ $result['job'] = $job_id; }
        if ($nursery_id){ $result['nursery'] = $nursery_id; }
        if ($employee_id){ $result['employee'] = $employee_id; }
        if ($tag_id){ $result['tag'] = $tag_id; }
        return $result;

    }

    /**
     * ThinhNH
     * Extract the ID from string like this "job_123"
     * It will return 123
     * @param $match_pre_string
     * @param $string
     * @return bool
     */
    private function get_id_from_string($match_pre_string, $string){
        preg_match('/'.$match_pre_string.'(\d+)/', $string, $matches);
        if (count($matches)==2){
            return $matches[1];
        }
        return false;
    }

    //todo-thinh search function
    public function search($param = array(), $search_type = false) {
        // if you done set get param, please activate
        if(empty($param)){
            $get = $this->input->get();
        }elseif(array_key_exists('get',$param)){
            $get = $param['get'];
        }
        //assign selecter
        $selecter = $this->_format_get_parameter($get);
        $this->smarty->assign('selecter',$selecter);

        //reset pagenation data
        $this->load->model('Service_search');

        $search_parse = $this->Service_search->make_search_param($get,$param);

        if(!empty($search_parse['search_request'])){
            $search_request = $search_parse['search_request'];
        }

        if(!empty($search_parse['search_word'])){
            $search_word = $search_parse['search_word'];
        }else{
            $search_word = "";
        }
        $this->smarty->assign('search_word',$search_word);

        if(!empty($search_parse['search_param'])){
            $search_param = $search_parse['search_param'];
        }
        if(!empty($search_parse['ad_param'])){
            $ad_param = $search_parse['ad_param'];
        }
        if(!empty($search_parse['detail'])){
            $detail = $search_parse['detail'];
        }
        if(!empty($search_parse['page'])){
            $page = $search_parse['page'];
        }else{
            $page = 1;
        }
        if(!empty($search_parse['tdk'])){
            $tdk = $search_parse['tdk'];
        }
        //tag url generate
        if(!empty($param['tag_url'])){
            $tag_url = $this->Service_tag->generate_tag_url($param['tag_url']);
        }else{
            $tag_url = base_url();
        }
        $this->smarty->assign('tag_url',$tag_url);

        //2.get user_data
        $user_data  = $this->_get_user_session();

        //2. please get job list of this pref and city
        $search_param['user_id']        =  empty($user_data['user_id']) ? null : $user_data['user_id'];
        $search_param['job_status']     =  $this->config->item('public','job_config');
        $search_param['nursery_status'] =  $this->config->item('public','nursery_config');
        $search_param['delete_flg']     =  $this->config->item('not_deleted','common_config');
        //count job
        $job_all_count  = $this->Service_job->search_count($search_param);
        $this->smarty->assign('job_all_count',$job_all_count);
        //3. get current condition.
        //for display pagenation and how many will this get jobs
        if($this->template_path() == "sp"){
            $range = $this->config->item('search_result_rows_sp','job_config');
        }else{
            $range = $this->config->item('search_result_rows','job_config');
        }
        //set pagination
        $list_param['range']      = $range;
        $list_param['page']       = $page;
        $list_param['limit']      = $job_all_count;
        $this->smarty->assign('range',$list_param['range']);
        $this->smarty->assign('page',$list_param['page']);
        $this->smarty->assign('limit',$list_param['limit']);

        $pagination_param = $this->Service_search->pagination($list_param);

        //parse param
        $page_count = $pagination_param['page_count'];
        $search_param_alt = $pagination_param['search_param'];
        $search_param['limit_to'] = $search_param_alt['limit_to'];
        $this->smarty->assign('limit_to',$search_param['limit_to']);
        $search_param['limit_from'] = $search_param_alt['limit_from'];
        $this->smarty->assign('limit_from',$search_param['limit_from']);
        $pagination = $this->_get_pagination($page_count,$list_param['range']);
        $this->smarty->assign('pagination',$pagination);

        //new job judgement
        $new_date = date('Y-m-d H:i:s',strtotime('-10days'));
        $this->smarty->assign('new_date' , $new_date);

        //finish to set param, get job_list for main content

        $job_list       = $this->Service_job->get_search_list($search_param);
        if(count($job_list) > $range){
            $job_list = array_slice($job_list, 0,$range);
        }

        $this->smarty->assign('job_list',$job_list);
        $this->smarty->assign('image_type', $this->config->item('job', 'image_config'));

        //if sp ajax, return.
        $chk_ajax = $this->input->post('is_ajax');
        if((!empty($chk_ajax))||(!empty($param['is_ajax']))){
            $chk_ajax = true;
        }
        if(!empty($chk_ajax)){
            $html = $this->smarty->fetch('sp/user/job/_job_list.html');
            $response["code"] = self::RESPONSE_CODE_SUCCESS;
            $response["total"] = count($job_list);
            $response["html"] = $html;
            return $this->_response_view($response);
        }
        //get recommend list
        //$search_param['job_tag_id'][]    = "85";//85 is recommend_flg
        $job_recommend_list = $this->_get_job_recommend_list($search_param);
        $this->smarty->assign('job_recommend_list',$job_recommend_list);

        //ads
        $ad = array();
        $ad_param['job_status']     =  $this->config->item('public','job_config');
        $ad_param['nursery_status'] =  $this->config->item('public','nursery_config');
        $ad_param['delete_flg'] = $this->config->item('not_deleted','common_config');
        $ad_param['status'] = $this->config->item('public','ad_config');
        $ad_area_id        = $this->Service_area->get_id_list($ad_param);
        if($ad_area_id){
            $ad_param['area_id'] = $ad_area_id;
            // $ad_param['area_id'] = $this->config->item('right_navi','ad_config');
            $ad = $this->Service_ad->get_group_detail_list($ad_param);
        }
        $this->smarty->assign('ad',$ad);

        $pref  = "";
        $stations_list = false;
        $top_page_url = "";
        $station_is_str = "";
        $line_page ="";
        if (isset($search_param['station_id'])){
            // get list stations by id array
            $station_is_str = implode(",", $search_param['station_id']);
            $stations_list = $this->Service_station->get_station_list_by_id_array($search_param['station_id']);

            if (count($stations_list)>0){
                // get pref name
                $pref = $this->Service_area->get_pref_by_id($stations_list[0]['pref_cd']);
                $top_page_url = "/railway/".$pref['romaji'];
                foreach($stations_list as $station){
                    $station_list_id[] = $station['station_id'];
                }

                $line_id = $this->Logic_line->get_list_line_by_many_station($station_list_id);
                $line_page = "/station_select?line_id=".$line_id;
            }else{
                $this->general_error(404);
                exit;
            }
        }
        $this->smarty->assign('line_page', $line_page);
        $this->smarty->assign('stations_list', $stations_list);
        $this->smarty->assign('pref', $pref);
        $this->smarty->assign('top_page', $top_page_url);
        $this->smarty->assign('station_is_str', $station_is_str);

        //4. U_2
        // assign tag data array
        $this->load->model("Service_tag");
        $this->smarty->assign("tags",$this->Service_tag->get_tag_list_all());
        $this->smarty->assign('user_data', $user_data);


//-------------
        // breadcrum
        if(array_key_exists('area_id', $search_param)){
            $current_area_id = $search_param['area_id'];
        }else{
            $current_area_id = false;
        }

        $this->load->model('Service_area');
        $area_datas = $this->Service_area->full_area($current_area_id);
        $param = array('pref','city');

        $bc_element['area_data']['pref_name'] = $area_datas['prefname'];
        $bc_element['area_data']['pref_id'] =  $area_datas['pref_id'];
        $bc_element['area_data']['city_id'] = $area_datas['city_id'];
        $bc_element['area_data']['city_name'] = $area_datas['cname'];
//-------------
        // breadcrum

        $bc_element = array('job_search_current');
        $this->_bread_crumb['base_url'] = base_url();
        if (isset($search_param['area_id'])) {
            $current_area_id = $search_param['area_id'];
            $this->load->model('Service_area');
            $bc_element['area_datas'] = $this->Service_area->full_area($current_area_id);
        }
        $this->_bread_crumb['base_url'] = base_url();
        $this->_bread_crumb['content'] = get_breadcrumb('job_search',$bc_element);

        //imageヘルパーをviewで使うためにロード
        //$this->load->helper("image_helper");
        $this->smarty->assign('breadcrumb' , $this->_bread_crumb);

        // canonical flg
        $canonical = $this->config->config["base_url"]."search";
        $this->smarty->assign('canonical' , $canonical);

        //$this->load->helper('image');


        //tdk
        if($page == 1){
            $tdk_page = '';
        }else{
            $tdk_page = '('.$page.'ページ目)';
        }
        //都道府県トップか求人検索結果かでベースも出し分け
        $uri = $this->uri->segment(2);
        if($uri == 'list_all' && isset($pref_name)){
            //都道府県トップ
            $tdk_array['title'] = $pref_name.'の保育士求人情報｜保育士の求人・転職・募集ならFINE!';
            $tdk_array['description'] = $pref_name.'の保育士求人情報。'.$pref_name.'の保育士求人／転職／募集情報を掲載するポータルサイトFINE!。あなたにぴったりの保育士・幼稚園の求人や募集情報を探せます。保育士転職やお仕事に役立つ情報も満載！';
            $tdk_array['keyword'] = $pref_name;
        } elseif(isset($tdk)) {
            //求人検索結果
            //市区町村ありなしで都道府県名を入れるかいれないか決まる
            $tdk_datas = implode(',',$tdk);
            if(isset($search_param['city_id'])){
                $tdk_head = $tdk_datas;
            }elseif(isset($pref_name)){
                $tdk_head = $pref_name.','.$tdk_datas;
            }else{
                $tdk_head = $tdk_datas;
            }
            $tdk_array['title'] = $tdk_head.'の保育士求人・転職・募集一覧'.$tdk_page.'｜保育士求人サイトFINE!'.$tdk_page;
            $tdk_array['description'] = $tdk_head.'の保育士求人一覧'.$tdk_page.'。'.$tdk_head.'の保育士求人／転職／募集情報を掲載するポータルサイトFINE!。あなたにぴったりの保育士・幼稚園の求人や募集情報を探せます。保育士転職やお仕事に役立つ情報も満載！';
            $tdk_array['keyword'] = $tdk_head;
        } else {
            $tdk_array = array();
        }
        $this->smarty->assign('tdk_array',$tdk_array);

        //4. display U_2
        if ($search_type == 'search_area') {
            $this->smarty->display($this->template_path()."/user/job/areatop.html");
        }else{
            $this->smarty->display($this->template_path()."/user/job/search_by_station.html");
        }

    }

    /**
     * ThinhNH
     * For Smart phone only
     * @param bool $station_id
     * @internal param array $param
     * @internal param bool $search_type
     */
    //todo-thinh search_condition for smart phone only
    public function search_condition($station_id = false) {

        $get_param = $this->input->get('station');
        if (is_numeric($station_id)){
            $station_id_str = $station_id;
            $station_id_array = array($station_id);
        }else {
            $station_id_str = $get_param ;
            if ($get_param){
                $station_id_array = explode(",", $get_param );
            }else {
                $station_id_array = array();
            }
        }

        $this->smarty->assign("tags",$this->Service_tag->get_tag_list_all());
        $stations_list = $this->Service_station->get_station_list_by_id_array($station_id_array);
        $pref = false;
        if (count($stations_list)>0){
            $pref = $this->Service_area->get_pref_by_id($stations_list[0]['pref_cd']);
        }

        $this->smarty->assign('stations_list', $stations_list);
        $this->smarty->assign('pref', $pref);
        $this->smarty->assign('station_id_str', $station_id_str);
        $this->smarty->display('sp/user/job/search_station_condition.html');

    }

}
