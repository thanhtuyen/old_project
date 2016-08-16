<?php
Class Service_except extends MY_Model{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Logic_except');
    }

    public function get_total_count($condition)
    {
            $param = array(
                'status' => $this->config->item('except','apply_config'),
                'delete_flg' => $this->config->item('not_deleted','common_config'),
            );
            return $this->Logic_except->get_total_count($condition, $param);
    }

    public function get_condition_list($condition, $parameters)
    {
        if ($parameters['total'] == 0) {
            return array();
        }

        $param = array(
            'offset' => $parameters['offset'],
            'limit' => $parameters['limit'],
            'status' => $this->config->item('except','apply_config'),
            'delete_flg' => $this->config->item('not_deleted','common_config'),
        );

        return $this->Logic_except->get_condition_list($condition, $param);
    }

    public function get_job_detail($id)
    {
        if(!empty($id)){
            $param = array(
                'delete_flg' => $this->config->item('not_deleted','common_config'),
                'applicant_job_id' => $id,
            );
        } else {
            return array();
        }

        return $this->Logic_except->get_job_detail($param);
    }
    public function get_agency_detail($id)
    {
        if(!empty($id)){
            $param = array(
                'delete_flg' => $this->config->item('not_deleted','common_config'),
                'applicant_agency_id' => $id,
            );
        } else {
            return array();
        }
        return $this->Logic_except->get_agency_detail($param);
    }

    public function confirm($param)
    {
        $param = array(
            'table' => $param['table'],
            'id' => $param['id'],
            'status' => $this->config->item($param['status'],'apply_config'),
        );
        return $this->Logic_except->confirm($param);
    }

    public function export_file($format, $config, $table)
    {
        $this->load->helper('apply');
        $headers = $this->config->item($config,'export_column_config');
        $results = $this->Logic_except->get_export_data($table);


        $agency_fn = function($results) {
            list($agencies, $license, $employ_type) = $results;
            $employ_types = array();
            $licenses = array();

            foreach ($license as $key => $value) {
                $licenses[$key][$value['applicant_agency_id']] = $value['license'];
                $applicant_agency_id[] = $value['applicant_agency_id'];
            }

            if (!empty($applicant_agency_id)) {
                $license = array_map(function($id) use($licenses){
                    return array('applicant_agency_id' => $id, 'license' => array_unique(array_column($licenses, (int) $id)));
                }, array_unique($applicant_agency_id));
            }

            unset($licenses);
            foreach ($license as $value) {
                $licenses[$value['applicant_agency_id']] = implode(' ', $value['license']);
            }

            foreach ($employ_type as $key => $value) {
                $employ_types[$key][$value['applicant_agency_id']] = $value['employ_type'];
                $applicant_agency_id[] = $value['applicant_agency_id'];
            }

            if (!empty($applicant_agency_id)) {
                $employ_type = array_map(function($id) use($employ_types){
                    return array('applicant_agency_id' => $id, 'employ_type' => array_unique(array_column($employ_types, (int) $id)));
                }, array_unique($applicant_agency_id));
            }

            unset($employ_types);
            foreach ($employ_type as $value) {
                $employ_types[$value['applicant_agency_id']] = implode(' ', $value['employ_type']);
            }


            foreach ($agencies as &$agency) {
                $agency['address'] = $agency['province'] . $agency['city'] . $agency['address'];
                $agency['employ_type'] = isset($employ_types[$agency['applicant_agency_id']]) ? $employ_types[$agency['applicant_agency_id']] : null;
                $agency['license'] = isset($licenses[$agency['applicant_agency_id']]) ? $licenses[$agency['applicant_agency_id']] : null;
                $agency['status'] = status_text($agency['status']);
            }
            unset($agency);
            return $agencies;
        };

        $job_fn = function($results) {
            list($jobs,  $license, $employ_type) = $results;
           $employ_types = array();
            $licenses = array();

            foreach ($license as $key => $value) {
                $licenses[$key][$value['applicant_job_id']] = $value['license'];
                $applicant_job_id[] = $value['applicant_job_id'];
            }

            if (!empty($applicant_job_id)) {
                $license = array_map(function($id) use($licenses){
                    return array('applicant_job_id' => $id, 'license' => array_unique(array_column($licenses, (int) $id)));
                }, array_unique($applicant_job_id));
            }

            unset($licenses);
            foreach ($license as $value) {
                $licenses[$value['applicant_job_id']] = implode(' ', $value['license']);
            }

            foreach ($employ_type as $key => $value) {
                $employ_types[$key][$value['applicant_job_id']] = $value['employ_type'];
                $applicant_job_id[] = $value['applicant_job_id'];
            }

            if (!empty($applicant_job_id)) {
                $employ_type = array_map(function($id) use($employ_types){
                    return array('applicant_job_id' => $id, 'employ_type' => array_unique(array_column($employ_types, (int) $id)));
                }, array_unique($applicant_job_id));
            }

            unset($employ_types);
            foreach ($employ_type as $value) {
                $employ_types[$value['applicant_job_id']] = implode(' ', $value['employ_type']);
            }


            foreach ($jobs as &$result) {
                $result['address'] = $result['province'] . $result['city'] . $result['address'];
                $result['employ_type'] = isset($employ_types[$result['applicant_job_id']]) ? $employ_types[$result['applicant_job_id']] : null;
                $result['license'] = isset($licenses[$result['applicant_job_id']]) ? $licenses[$result['applicant_job_id']] : null;
                $result['status'] = status_text($result['status']);
            }
            unset($result);
            return $jobs;
        };

        if ($table == 'agency') {
            $export_results = call_user_func($agency_fn, $results);
        } else {
            $export_results = call_user_func($job_fn, $results);
        }
        $this->load->model('Service_export_file');
        return $this->Service_export_file->export($headers, $export_results, $format);
    }

}

