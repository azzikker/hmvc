<?php
class deals_term_model extends CI_Model
{
    //display
    function displaySelected($table7, $deal_where) {
        $sql = $this->db->get_where($table7, $deal_where);
        return $sql->result();
    }
    //process
    function save_term($table7, $term_list) {
        $sql = $this->db->insert($table7, $term_list);
    }
    function update_term($table7, $deal_where, $term_where, $term_list) {
        $this->db->where($deal_where);
        $this->db->where($term_where);
        $sql = $this->db->update($table7, $term_list); 
    }
    function delete_term($table7, $term_where) {
        $this->db->where($term_where);
        $sql = $this->db->delete($table7);
    }
    //new
    function get_where($where)
    {
        $query = $this->db->get_where("deal_fineprint",$where);
        return $query;
    }
}
?>
