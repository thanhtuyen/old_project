<?php

/**
 * Support for insert data array
 *
 * @since 15/04/14
 *
 *
 */
trait CreateTrait
{

    /**
     * Insert into table
     *
     * @param array $data
     * @return false/int insert_id
     */
    public function create(&$data = [])
    {
        if (empty($this->db)) {
            $this->load->database();
        }

        if (empty($this->table) || empty($data)) {
            return false;
        }

        $columns = parseColumns($data);

        $values = parseValues($data);

        $sql = sprintf('INSERT INTO `%s` %s %s', $this->table, $columns, $values);



        $result = $this->db->query($sql);

        if (! $result) {
            return false;
        }
        return $this->db->insert_id();
    }
}