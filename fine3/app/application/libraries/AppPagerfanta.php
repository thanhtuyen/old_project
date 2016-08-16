<?php

require_once APPPATH."/third_party/MyPagerfanta/Adapter/EmptyArrayAdapter.php";
require_once APPPATH."/third_party/MyPagerfanta/View/Template/UserThemeTemplate.php";
require_once APPPATH."/third_party/MyPagerfanta/View/UserTheme.php";

class AppPagerfanta {

    public static function paging($total_count, $page, $theme, $options){
        $adapter = new \MyPagerfanta\Adapter\EmptyArrayAdapter($total_count);
        $pagerfanta = new \Pagerfanta\Pagerfanta($adapter);

        $pre_page = isset($options['per_page']) && $options['per_page'] ? $options['per_page'] : 10;
        $pagerfanta->setMaxPerPage($options['per_page']);

        $maxPage =$pagerfanta->getNbPages();
        $page = (int)$page;
        if ($page <= 0) {$page = 1;}
        if ($page > $maxPage) {$page = $maxPage;}
        $pagerfanta->setCurrentPage($page);

        if ($theme == 'User') {
            $pageView = new \MyPagerfanta\View\UserTheme();
        } else {
            $pageView = new \Pagerfanta\View\DefaultView();
        }

        if (isset($options['urlQuery'])) {
            $urlQuery = $options['urlQuery'];
        }else{
            $_query_string = isset($_SERVER['QUERY_STRING']) ? $_SERVER['QUERY_STRING'] : '';
            parse_str($_query_string, $urlQuery);
        }
        $routeGenerator = function($page) use($urlQuery) {
            $currentUrl = $_SERVER['REQUEST_URI'];
            $urlQuery['page'] = $page;
            $pageUrl = http_build_url($currentUrl, array("query" => http_build_query($urlQuery)));
            return $pageUrl;
        };

        $options = array('proximity' => 3);
        $pagerfantahtml = $pageView->render($pagerfanta, $routeGenerator, $options);
        return array($pagerfanta, $pagerfantahtml);
    }

}