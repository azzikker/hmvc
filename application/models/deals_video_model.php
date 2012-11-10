<?php
class deals_video_model extends CI_Model
{
    //display
    function displaySelected($table0, $deal_where) {
        $sql = $this->db->get_where($table0, $deal_where);
        return $sql->result();
    }
    //process
    function save_video($table0, $video_list) {
        $sql = $this->db->insert($table0, $video_list);
    }
    function update_video($table0, $deal_where, $video_list) {
        $this->db->where($deal_where);
        $sql = $this->db->update($table0, $video_list);
    }
    function delete_video($table0, $video_where) {
        $this->db->where($video_where);
        $sql = $this->db->delete($table0);
    }
    
    
    
    
    function select_data_video($sh)
    {
        $this->db->where("deal_subhash",$sh);
        $query = $this->db->get("deal_video");
        return $query;
    }
}
?>
