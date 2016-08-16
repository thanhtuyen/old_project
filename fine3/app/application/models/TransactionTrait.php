<?php

trait TransactionTrait{
    /**
     * Start transaction
     *
     * @since 15/04/15
     */
    public function transaction_start()
    {
        if (empty($this->db)) {
            $this->load->database();
        }
        $this->db->trans_start();
    }

    /**
     * Commit transaction
     *
     * @since 15/04/15
     */
    public function transaction_commit()
    {
        if (empty($this->db)) {
            $this->load->database();
        }
        $this->db->trans_complete();
    }

    /**
     * transaction_rollback
     */
    public function transaction_rollback()
    {
        if (empty($this->db)) {
            $this->load->database();
        }
         $this->db->trans_rollback();
    }


}
