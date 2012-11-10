<?php
class deals_highlight_model extends CI_Model
{
    //display
    function displaySelected($table6, $deal_where) {
        $sql = $this->db->get_where($table6, $deal_where);
        return $sql->result();
    }
    //process
    function save_highlight($table6, $highlight_list) {
        $sql = $this->db->insert($table6, $highlight_list);
    }
    function update_highlight($table6, $deal_where, $highlight_where, $highlight_list) {
        $this->db->where($deal_where);
        $this->db->where($highlight_where);
        $sql = $this->db->update($table6, $highlight_list);
    }
    function delete_highlight($table6, $highlight_where) {
        $this->db->where($highlight_where);
        $sql = $this->db->delete($table6);
    }
}
?>
