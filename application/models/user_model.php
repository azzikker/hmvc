<?php
class user_model extends CI_Model
{
    //display
    function displayUserAccount($table1, $user_where) {
        $sql1 = $this->db->get_where($table1, $user_where);
        return $sql1->result();
    }
    function displayUserMax($table1) {
        $this->db->select_max('user_id');
        $sql = $this->db->get($table1);
        return $sql->result();
    }
    function displayUserConfirmed_Unbanned($table1) {
        $unconfirmed['user_confirmed'] = 1;
        $banned['user_banned'] = 0;
        $deleted['deleted'] = 0;
        
        $this->db->select("*");
        $this->db->from($table1);
        $this->db->join("user_level", "user_level.level_id = " . $table1 . ".user_level");
        $this->db->where($unconfirmed);
        $this->db->where($banned);
        $this->db->where($deleted);
        $sql1 = $this->db->get();
        return $sql1->result();
    }
    function displayUserConfirmedMerchant($table1, $user_level) {
        $unconfirmed['user_confirmed'] = 1;
        
        $this->db->select("*");
        $this->db->from($table1);
        $this->db->where($unconfirmed);
        $this->db->where($user_level);
        $sql1 = $this->db->get();
        return $sql1->result();
    }
    function displayUserUnconfirmed($table1) {
        $unconfirmed['user_confirmed'] = 0;
        $sql1 = $this->db->get_where($table1, $unconfirmed);
        return $sql1->result();
    }
    function displayUserUnconfirmedCount($table1) {
        $unconfirmed['user_confirmed'] = 0;
        $sql1 = $this->db->get_where($table1, $unconfirmed)->num_rows();
        return $sql1;
    }
    function displayUserBanned($table1) {
        $banned['user_banned'] = 1;
        $sql1 = $this->db->get_where($table1, $banned);
        return $sql1->result();
    }
    function displayUserBannedCount($table1) {
        $banned['user_banned'] = 1;
        $sql1 = $this->db->get_where($table1, $banned)->num_rows();
        return $sql1;
    }
    function displaySelected($table1, $user_where) {
        $sql1 = $this->db->get_where($table1, $user_where);
        return $sql1->result();
    }
    function callSelectedUser($table1, $user_where, $username) {
        $this->db->where('user_id !=', $user_where);
        $this->db->where($username);
        $sql1 = $this->db->get($table1);
        if($sql1->num_rows() > 0) { return true; }
        else { return false; }
    }
    function editUser($table1, $user_where) {
        $sql1 = $this->db->get_where($table1, $user_where);
        return $sql1->result();
    }
    //process
    function saveUser($table1, $user_list) {
        $sql1 = $this->db->insert($table1, $user_list);
    }
    function updateUser($table1, $user_where, $user_list) {
        $this->db->where($user_where);
        $sql = $this->db->update($table1, $user_list);
    }
    function deleteUser($table1, $user_where) {
        $this->db->where($user_where);
        $sql = $this->db->delete($table1);
    }
    
    
    //---------------------------
    function select_data_user($un,$pw)
    {
        $this->db->where("user_name",$un);
        $this->db->where("user_password",$pw);
        $this->db->where("user_confirmed","1");
        $this->db->where("user_banned","0");
        $query = $this->db->get("users");
        return $query;
    }
    function select_data_user2()
    {
        $this->db->limit(1);
        $query = $this->db->get("users")->num_rows();
        if($query > 0):
            return true;
        else:
            return false;
        endif;
    }
    function select_data_user3($un)
    {
        $this->db->where("user_name",$un);
        $query = $this->db->get("users")->num_rows();
        if($query > 0):
            return true;
        else:
            return false;
        endif;
    }
    
    function insert_data_user($data)
    {
        $this->db->insert("users",$data);
        $this->db->affected_rows();
    }
    
    ///////////////////////////////////
    /////--Added functions--//////////
    /////////////////////////////////
    function displayUserTrashed($table1) {
        $deleted['deleted'] = 1;
        $sql1 = $this->db->get_where($table1, $deleted);
        return $sql1->result();
    }
    
    function trash_restore_user($table, $user_where, $delete = 1)
    {
        $this->db->where($user_where);
        $this->db->update($table, array('deleted' => $delete));
        return $this->db->affected_rows();
    }
}
?>
