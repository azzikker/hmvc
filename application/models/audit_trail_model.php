<?php

class Audit_Trail_Model extends CI_Model
{
    //display
    function display_all($tableA, $table1) {
        $this->db->select("*");
        $this->db->from($tableA);
        $this->db->join($table1, $table1 . ".user_id = " . $tableA . ".user_id");
        $this->db->order_by("audit_date", "desc"); 
        $sql = $this->db->get();
        return $sql->result();
    }
    function displaySelectedDate($tableA, $table1, $where, $segment) {
        $this->db->select("*");
        $this->db->from($tableA);
        $this->db->join($table1, $table1 . ".user_id = " . $tableA . ".user_id");
        $this->db->where("audit_date <=", $segment);
        $this->db->where("audit_date >=", $where);
        $this->db->order_by("audit_date", "desc"); 
        $sql = $this->db->get();
        return $sql->result();
    }
    function displaySelectedPayment($table1, $where) {
        $this->db->select("*");
        $this->db->from($table1);
        $this->db->join("companies","companies.company_id = " . $table1 . ".company_id");
        $this->db->join("deal_payment","deal_payment.deal_hash = " . $table1 . ".deal_hash");
        $this->db->where("" . $table1 . ".deal_hash = '" . $where . "'");
        $sql = $this->db->get();
        return $sql;
    }
    function displaySelectedCompany($table1, $where) {
        $sql = $this->db->get_where($table1, "company_name = \"" . $where . "\"");
        return $sql;
    }
    function displaySelectedBranch($table1, $where) {
        $sql = $this->db->get_where($table1, "location_name = \"" . $where . "\"");
        return $sql;
    }
    //function display_like_date() {}
    //process
    function save_audit($tableA, $insert) {
        $sql = $this->db->insert($tableA, $insert);
    }

}
?>
