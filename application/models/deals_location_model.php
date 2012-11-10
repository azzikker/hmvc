<?php
class deals_location_model extends CI_Model
{
    //display 
    function displaySelected($table8, $deal_where) {
        $sql = $this->db->get_where($table8, $deal_where);
        return $sql->result();
    }
    function displayLocation_LIMIT($deal_hash) {   
        $this->db->limit(1);
        $this->db->where("deal_hash", $deal_hash);
        $sql = $this->db->get("deal_location");
        return $sql;   
    }
    function displayLocation($deal_hash) {   
        $this->db->where("deal_hash", $deal_hash);
        $sql = $this->db->get("deal_location");
        return $sql;   
    }
    function displayCompanyMerchants($table2, $where) {
        $this->db->select('*');
        $this->db->from($table2);
        $this->db->where($table2 . ".company_hash", $where);
        $sql = $this->db->get();
        return $sql;
    }
    //process
    function save_location($table8, $location_list) {
        $sql = $this->db->insert($table8, $location_list);
    }
    function update_location($table8, $location_where, $location_list) {
        $this->db->where($location_where);
        $sql = $this->db->update($table8, $location_list);
    }
    function delete_location($table8, $location_where) {
        $this->db->where($location_where);
        $sql = $this->db->delete($table8);
    }
    
    
    
    
    
    function select_data_location($hash,$lim)
    {
        $this->db->where("deal_hash",$hash);
        $this->db->limit(1,$lim);
        $query = $this->db->get("deal_location");
        return $query;
    }
    //new
    function get_where($where)
    {
        $query = $this->db->get_where("deal_location",$where);
        return $query;
    }
}
?>
