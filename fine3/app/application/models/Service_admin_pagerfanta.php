<?php
Class Service_admin_pagerfanta extends MY_Model
{
    /**
     * [get_parameters description]
     * @param  [total_count]
     * @return [array]
     */
    public function get_data($total_count)
    {
        $this->load->library('AppPagerfanta');
        $page = $this->input->get('page');

        if (empty($prePage)) {
          $perPage = $this->input->get('per_page', TRUE );
        }

        $perPage = $this->input->get('limit', TRUE);

        if (empty($perPage)) {
          $perPage = 10;
        }

        if ($total_count <= 0) {
            return [
                'pagerfanta' => null,
                'pagerfantaHtml' => null,
                'offset' => null,
                'limit' => null,
                'start' => 0,
                'end' => 0,
                'total' => 0,
                'per_page' => $perPage,
            ];
        }

        $options = ['per_page' => $perPage];

        list($pagerfanta, $pagerfantaHtml) = AppPagerfanta::paging($total_count, $page, 'User', $options);

        $limit = $pagerfanta->getMaxperPage();
        $offset = $pagerfanta->getCurrentPageOffsetStart() - 1;

        return [
            'pagerfantaHtml' => $pagerfantaHtml,
            'offset' => $offset,
            'limit' => $limit,
            'start' => $pagerfanta ->getCurrentPageOffsetStart(),
            'end' => $pagerfanta ->getCurrentPageOffsetEnd(),
            'total' => $total_count,
            'per_page' => $perPage,
        ];
    }


}
