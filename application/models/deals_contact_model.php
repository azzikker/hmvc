<?php
    class deals_contact_model extends CI_Model    
    {
        //display
        function displaySelected($tableB, $contact_where) {
            $sql = $this->db->get_where($tableB, $contact_where);
            return $sql->result();
        }
        //process
        function saveDealsContact($tableB, $contact_list) {
            $sql = $this->db->insert($tableB, $contact_list);
        }
        function updateDealsContact($tableB, $contact_where, $contact_list) {
            $this->db->where($contact_where);
            $sql = $this->db->update($tableB, $contact_list);
        }
        function deleteDealsContact($tableB, $contact_where) {
            $this->db->where($contact_where);
            $sql = $this->db->delete($tableB);
        }
    }
?>
