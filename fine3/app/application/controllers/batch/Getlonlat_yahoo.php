<?php
class Getlonlat_yahoo extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        
        $this->load->model('Service_nursery');
        $this->load->model('Logic_nursery');
        $this->load->model('Logic_area');
        set_time_limit(0);
    }
    
    // get geo information and update nursery's lon lat by batch
    public function getNurseryLonLat()
    {
        if (!$this->input->is_cli_request())
        {
            return NULL;
        }
        
        try
        {
            // for test
            /*
            $testdata = array(
                0 => 83567,
                1 => 83569,
            );*/
            
            $api_count = 0;
            $ok_count = 0;
            $ng_count = 0;
            
            //$nursery_areas = $this->Logic_nursery->get_all_nursery_address($testdata);
            $nursery_areas = $this->Logic_nursery->get_all_nursery_address();
           
            $delete_flg = $this->config->item('not_deleted','common_config');

            foreach($nursery_areas as $nursery_area)
            {
                // areas info
                $area_params = array(
                    'area_id' => $nursery_area['area_id'],
                    'delete_flg' => $delete_flg
                );
                $area = $this->Logic_area->get_detail($area_params);
                $pref = $this->Logic_area->get_pref_name($area[0]['pref_id']);
                
                if(empty($nursery_area['address']))
                {
                    $area_name = $pref[0]['name'] . $area[0]['name'];
                    $geoinfo = $this->strAddrToLatLngByYahoo($area_name);
                    $api_count++;
                }
                else
                {
                    $area_name = $pref[0]['name'] . $area[0]['name'] . $nursery_area['address'];
                    $geoinfo = $this->strAddrToLatLngByYahoo($area_name);
                    $api_count++;
                    
                    if($geoinfo == '')
                    {
                        $area_name = $pref[0]['name'] . $area[0]['name'];
                        $geoinfo = $this->strAddrToLatLngByYahoo($area_name);
                        $api_count++;
                    }
                }
                
                if($geoinfo == '')
                {
                    $ng_count++;
                    echo "request count : " . $api_count;
                    echo " : NG : " . $nursery_area['nursery_id'] . " : " . $area_name . PHP_EOL;
                }
                else
                {   
                    $ok_count++;
                    $this->Service_nursery->update_geoinfo($nursery_area['nursery_id'], $geoinfo);
                    echo "request count : " . $api_count;
                    echo " : OK : " . $nursery_area['nursery_id'] . " : " . $area_name . PHP_EOL;
                }
            }
            echo "batch finished : OK " . $ok_count . " : NG " . $ng_count . PHP_EOL;
            
        }catch(Exception $e){
             echo $e->getMessage();
             echo $e->getTraceAsString();
        }
    }
     
    // Yahoo!GeoCoderAPI get geoinfo
    function strAddrToLatLngByYahoo($strAddr)
    {
        // 5 requests per second
        usleep(200000);
        
        $app_id = "dj0zaiZpPXREMlI3a1BXWFVJYiZzPWNvbnN1bWVyc2VjcmV0Jng9YzY-";
        
        $strRes = file_get_contents( 
             'http://geo.search.olp.yahooapis.jp/OpenLocalPlatform/V1/geoCoder?output=json'
            . '&appid=' . $app_id
            . '&query=' . urlencode(mb_convert_encoding($strAddr, 'UTF-8'))
        );
        $aryGeo = json_decode($strRes, TRUE);
        
        if (($aryGeo['ResultInfo']['Count'] == 0)){
            return '';
        }
        
        $strGeo = $aryGeo['Feature'][0]['Geometry']['Coordinates'];
        $strLngLat = explode(",",$strGeo);
        
        return array(
            'lon' => $strLngLat[0],
            'lat' => $strLngLat[1],
        );
    }
}