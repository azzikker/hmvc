<?php
class deals_option_model extends CI_Model
{
    //display
    function displaySelected($table5, $deal_where, $option_where) {
        $this->db->where($deal_where);
        $this->db->where($option_where);
        $sql = $this->db->get($table5);
        return $sql->result();
    }
    function displaySelectedID($table5, $option_where) {
        $sql = $this->db->get_where($table5, $option_where);
        return $sql->result();
    }
    function displaySelectedSum($table5, $option_where) {
        $this->db->select_sum('deal_original_stock'); 
        $this->db->select_sum('deal_current_stock');
        $this->db->select_sum('deal_returned');
        $this->db->where($option_where); 
        $sql = $this->db->get_where($table5);
        return $sql->result();
    }
    //process
    function save_option($table5, $option_list) {
        $sql = $this->db->insert($table5, $option_list);
    }
    function update_option($table5, $deal_where, $option_where, $option_list) {
        $this->db->where($deal_where);
        $this->db->where($option_where);
        $sql = $this->db->update($table5, $option_list);
    }
    function update_option_order($table5, $option_where, $option_list) {
        $this->db->where($option_where);
        $sql = $this->db->update($table5, $option_list);
    }
    function delete_option($table5, $option_where) {
        $this->db->where($option_where);
        $sql = $this->db->delete($table5);
    }
    
    
    
    function select_data_option($sh)
    {
        $this->db->select("option_name,deal_original_stock,deal_current_stock,option_id,selection_hash");
        $this->db->from("deal_option");
        $this->db->where("selection_hash",$sh);
        $query = $this->db->get();
        return $query;
    }
    function select_data_option2($dh)
    {
        $this->db->select("option_name,deal_original_stock,deal_current_stock");
        $this->db->from("deal_option");
        $this->db->where("deal_hash",$dh);
        $query = $this->db->get();
        return $query;
    }
    function update_data_option($oid,$data)
    {
        $this->db->where("option_id",$oid);
        $this->db->update("deal_option",$data);
    }
    
    //new
    function get_where($where)
    {
        $query = $this->db->get_where("deal_option",$where);
        return $query;
    }
    function update($update,$where)
    {
        $this->db->where($where);
        $this->db->update("deal_option",$update);
    }
}
?>
