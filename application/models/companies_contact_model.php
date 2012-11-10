<?php
    class companies_contact_model extends CI_Model    
    {
        //display
        function displaySelected($tableA, $contact_where) {
            $sql = $this->db->get_where($tableA, $contact_where);
            return $sql->result();
        }
        //process
        function saveCompanyContact($tableA, $contact_list) {
            $sql = $this->db->insert($tableA, $contact_list);
        }
        function updateCompanyContact($tableA, $contact_where, $contact_list) {
            $this->db->where($contact_where);
            $sql = $this->db->update($tableA, $contact_list);
        }
        function deleteCompanyContact($tableA, $contact_where) {
            $this->db->where($contact_where);
            $sql = $this->db->delete($tableA);
        }
    }
?>
