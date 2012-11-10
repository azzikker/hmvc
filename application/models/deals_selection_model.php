<?php
class deals_selection_model extends CI_Model
{
    //display
    function displaySelected($table4, $select_where) {
        $sql = $this->db->get_where($table4, $select_where);
        return $sql->result();
        return $sql->num_rows();
    }
    function displaySelectedFiltered($table4, $table5, $select_where) {
        $this->db->select('*');
        $this->db->from($table4);
        $this->db->join($table5, $table5 . '.selection_hash = ' . $table4 . '.selection_hash');
        $this->db->select_sum('deal_original_stock'); 
        $this->db->select_sum('deal_current_stock');
        $this->db->select_sum('deal_returned');
        $this->db->where($select_where);
        $sql = $this->db->get();
        return $sql->result();
    } 
    //process
    function save_select($table4, $select_list) {
        $sql = $this->db->insert($table4, $select_list);
    }
    function update_select($table4, $deal_where, $select_where, $select_list) {
        $this->db->where($deal_where);
        $this->db->where($select_where);
        $sql = $this->db->update($table4, $select_list);
    }
    function delete_select($table4, $select_where) {
        $this->db->where($select_where);
        $sql = $this->db->delete($table4);
    }
    
    
    
    
    
    function select_data_selection($dsh)
    {   
        $this->db->select("deal_selection.selection_name,deal_selection.selection_hash");
        $this->db->from("deal_selection");
        $this->db->where("deal_subhash",$dsh);
        $query = $this->db->get();
        return $query;
    }
    
    //new
    function get_where($where)
    {
        $this->db->where($where);
        $query = $this->db->get("deal_selection");
        return $query;
    }
}
?>
