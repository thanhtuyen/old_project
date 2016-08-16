<?php
trait ReadTrait{

    /**
     * Get rows
     *
     * @param $where array
     * @param $fields array columns to select
     * @return false/array
     */
    public function read($where =[], $fields = [])
    {
        if (empty($this->db)) {
            $this->load->database();
        }

        if (empty($this->table)) {
            return false;
        }

       $this->db->select($fields)
        ->where($where)
        ->get_compiled_select($this->table, FALSE);



       $results = $this->db->get()->result_array();

        if(! $results){
            return false;
        }


        return $results;
    }



}