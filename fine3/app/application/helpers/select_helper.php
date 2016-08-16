<?php

/**
 * set dropdown list to be selected
 * @param array $items
 * @param string $field
 * @param array $args
 * @return array:
 */
function parseSelectedItem($items, $field, $args){
    if(empty($items)){
        return $items;
    }
    $data = [];
    foreach ((array) $items as $key => $val){

        $val['selected'] = '';
        if(isset($args[$field]) &&  $args[$field] == $val[$field]){
            $val['selected'] = 'selected="selected"';
        }
        $data[$key] = $val;
    }
    return $data;
}


/**
 * set checkbox list to be checked
 * @param array $items
 * @param string $field
 * @param array $args
 * @return array:
 */
function parseCheckedItem($items, $field, $args){
    if(empty($items)){
        return $items;
    }
    $data = [];
    foreach ((array) $items as $key => $val){

        $val['checked'] = '';

        if(isset($args[$field]) && isset($val[$field]) && in_array($val[$field], $args[$field] ) ){
            $val['checked'] = 'checked="checked"';
        }
        $data[$key] = $val;
    }
    return $data;
}
