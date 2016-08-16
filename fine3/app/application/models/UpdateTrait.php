<?php

/**
 * Support for update data array
 *
 * @since 15/04/14
 *
 *
 */
trait UpdateTrait
{

    /**
     * update
     * @param $data array
     * @param $where array
     * @return bool
     */
    public function update($data = [], $where)
    {
        if (empty($this->db)) {
            $this->load->database();
        }


        if (empty($this->table) || empty($data)) {
            return false;
        }

        $this->db->where($where);
      return (bool) $this->db->update($this->table, $data);
    }
}