<?php
class user_level_model extends CI_Model
{
    //display
    function displayLevel($tablex) {
        $sql1 = $this->db->get($tablex);
        return $sql1->result();
    }
    function displaySelected($tablex, $user_where) {
        $this->db->select("*");
        $this->db->from($tablex);
        $this->db->where($user_where);
        $sql = $this->db->get();
        return $sql->result();
    }
    function displayUnselected($tablex, $user_where) {
        $sql = $this->db->get_where($tablex, "level_id != $user_where");
        return $sql->result();
    }
    //process
}
?>
