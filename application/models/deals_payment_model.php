<?php
class deals_payment_model extends CI_Model
{
    //display
    /*function displaySelected($table1, $table10, $hash_where, $company_where) {
        $sql = $this->db->query(" SELECT * from " . $table1 . ", " . $table10 . "
                                  WHERE " . $table1 . ".deal_hash=" . $table10 . ".deal_hash
                                  AND " . $table10 . ".deal_hash='" . $hash_where . "'
                                  AND " . $table10 . ".company_id='" . $company_where . "'");
        return $sql->result();
    }*/
    function displaySelected($table1, $table10, $hash_where, $company_where) {
        $this->db->select('*');
        $this->db->from($table1);
        $this->db->join($table10,$table10 . ".deal_hash = " . $table1 . ".deal_hash");                              
        $this->db->where($table10 . ".deal_hash = '" . $hash_where . "'");
        $this->db->where($table10 . ".company_id = " . $company_where);
        $this->db->limit(1);  
        $sql = $this->db->get();
        return $sql->result();
    }
    //process
    function save_view($table10, $payment_list) {
        $sql = $this->db->insert($table10, $payment_list);
    }
}
?>
