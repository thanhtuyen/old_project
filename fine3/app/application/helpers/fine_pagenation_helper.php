<?php

if ( ! function_exists('createStandardPagenation'))
{
  function createStandardPagenation($params, $flag = null)
  {
    $CI =& get_instance();
    $CI->load->library('pagination');

    $config['base_url']     = $params['base_url'];
    $config['total_rows']   = $params['total'];
    $config['per_page']     = $params['display'];
    $config['use_page_numbers'] = TRUE;
    $config['cur_page']     = $params['now_page'];
    $config['num_links']    = 4;

    $config['full_tag_open'] = '<ul class="pagenation">';
    $config['full_tag_close'] = '</ul>';

    $config['first_link'] = '≪ 最初へ';
    $config['first_tag_open'] = '<li>';
    $config['first_tag_close'] = '</li>';

    $config['last_link'] = '最後へ ≫';
    $config['last_tag_open'] = '<li>';
    $config['last_tag_close'] = '</li>';

    $config['prev_link']    = FALSE;
    $config['next_link']    = FALSE;

    $config['cur_tag_open'] = '<li>[ ';
    $config['cur_tag_close'] = ' ]</li>';

    $config['num_tag_open'] = '<li>';
    $config['num_tag_close'] = '</li>';

    if($flag == 'client_nursery_index') {
        $config['prefix'] = '?page=';
        if(isset($params['query']) && $params['query']){
            $config['suffix'] = '&'.$params['query'];
        }
    }

    $CI->pagination->initialize($config);

    if ($params['total'] != 0) {
        $pagenation = $CI->pagination->create_links();
    } else {
        $pagenation = '該当データなし';
    }

    return $pagenation;
  }
}