<?php
class deals_gallery_model extends CI_Model
{
    //display
    function displaySelected($table3, $deal_where) {
        $sql = $this->db->get_where($table3, $deal_where);
        return $sql->result();
        return $sql->num_rows();
    }
    function displaySelectedGallery($table3, $deal_where) {
        $sql = $this->db->get_where($table3, $deal_where);
        return $sql->result();
    }
    function displaySelectedLIMIT($table3, $deal_where) {
        $sql = $this->db->get_where($table3, $deal_where);
        $this->db->limit(1);
        return $sql->result();
    }
    //process
    function save_gallery($table3, $gallery_list) {
        $sql = $this->db->insert($table3, $gallery_list);
    }
    function update_gallery($table3, $deal_where, $gallery_list) {
        $this->db->where($deal_where);
        $sql = $this->db->update($table3, $gallery_list);
    }
    function delete_gallery($table3, $gallery_where) {
        $this->db->where($gallery_where);
        $sql = $this->db->delete($table3);
    }

    //---------------------------------
    function select_data_gallery($dsh)
    {
        $this->db->where("deal_subhash",$dsh);
        $this->db->order_by("gallery_main","desc");
        $query = $this->db->get("deal_gallery");
        return $query;
    }
    function select_data_gallery2($dsh)
    {
        $this->db->where("deal_subhash",$dsh);
        $this->db->limit(1);
        $query = $this->db->get("deal_gallery");
        return $query;
    }
    
    ///////////////////////////////////////
    /////////added functions///////////////
    ///////////////////////////////////////
    function save_croppped_image_file_name($file_name, $hash, $table = 'deal_gallery')
    {
        $arr = array(
            'gallery_filename' => $file_name,
            'deal_hash' => $hash,
            'deal_subhash' => $hash
        );
        $this->db->insert($table, $arr);
        
        return $this->db->affected_rows();
    }
    
    function count_saved_image_of_hash($hash, $table = 'deal_gallery')
    {
        $query = $this->db->get_where($table, array('deal_hash' => $hash, 'deal_subhash' => $hash));
        
        return $query->num_rows();
    }
    
    function get_single_deal_image_info($hash, $file_name, $table = 'deal_gallery')
    {
        $query = $this->db->get_where($table, array('gallery_filename' => $file_name, 'deal_hash' => $hash, 'deal_subhash' => $hash));
        
        if($query->num_rows() > 0)
        {
            return $query->row();
        }
        else
        {
            return false;
        }
    }
    
}
?>
