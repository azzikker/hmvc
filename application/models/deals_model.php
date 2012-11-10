<?php
class deals_model extends CI_Model
{
    //display
    function displayDeals() {
        $sql = $this->db->query("select * from deals");
        return $sql->result();   
    }
    function displaySelected($table2, $deal_where) {
        $sql = $this->db->get_where($table2, $deal_where);
        return $sql->result();
    }
    function displayDealsMax($table) {
        $this->db->select_max('deal_id');
        $sql = $this->db->get($table);
        return $sql->result();
    }
    function displaySelectedSub($table2, $deal_where) {
        $sql = $this->db->get_where($table2, $deal_where);
        return $sql->result();
    }
    function displaySelectedSubFull($table1, $table2, $deal_subhash) {
        $this->db->select('*');
        $this->db->from($table2);
        $this->db->join($table1, $table1 . '.deal_hash = ' . $table2 . '.deal_hash');
        $this->db->where($table2 . ".deal_subhash", $deal_subhash);
        $sql = $this->db->get();
        return $sql->result();
    }                         
    function displayGrouped($table1, $table2, $deal_hash) {
        $this->db->select('*');
        $this->db->from($table1);
        $this->db->join($table2, $table2 . '.deal_hash = ' . $table1 . '.deal_hash');
        $this->db->where($table1 . ".deal_hash", $deal_hash);
        $sql = $this->db->get();
        return $sql->result();
    }
    function displayGroupedCompanyID($table1, $table2, $deal_company) {
        $this->db->select('*');
        $this->db->from($table2);
        $this->db->join($table1, $table1 . '.deal_hash = ' . $table2 . '.deal_hash'); 
        $this->db->where($table1 . ".company_id", $deal_company);
        $this->db->where($table2 . ".deal_select = 1");
        $this->db->order_by("deal_view.deal_view_id", "desc");
        $sql = $this->db->get();
        return $sql->result();
    }
    function displayGroupedCompanyIDCurrent($table1, $table2, $deal_where, $deal_company) {
        $this->db->select('*');
        $this->db->from($table2);
        $this->db->join($table1, $table1 . '.deal_hash = ' . $table2 . '.deal_hash');
        $this->db->where("deal_view.deal_view_start <=" . $deal_where);
        $this->db->where("deal_view.deal_view_end >= " . $deal_where);
        $this->db->where($table1 . ".company_hash", $deal_company);
        $this->db->where($table2 . ".deal_select = 1");
        $this->db->order_by("deal_view.deal_view_id", "desc");
        $sql = $this->db->get();
        return $sql->result();
    }
    function displayGroupedCompanyIDFuture($table1, $table2, $deal_where, $deal_company) {
        $this->db->select('*');
        $this->db->from($table2);
        $this->db->join($table1, $table1 . '.deal_hash = ' . $table2 . '.deal_hash'); 
        $this->db->where("deal_view.deal_view_start >=" . $deal_where);
        $this->db->where($table1 . ".company_hash", $deal_company);
        $this->db->where($table2 . ".deal_select = 1");
        $this->db->order_by("deal_view.deal_view_id", "desc");
        $sql = $this->db->get();
        return $sql->result();
    }
    function displayGroupedCompanyIDPast($table1, $table2, $deal_where, $deal_company) {
        $this->db->select('*');
        $this->db->from($table2);
        $this->db->join($table1, $table1 . '.deal_hash = ' . $table2 . '.deal_hash'); 
        $this->db->where("deal_view.deal_view_end <= " . $deal_where);
        $this->db->where($table1 . ".company_hash", $deal_company);
        $this->db->where($table2 . ".deal_select = 1");
        $this->db->order_by("deal_view.deal_view_id", "desc");
        $sql = $this->db->get();
        return $sql->result();
    }
    function displayBranched($table0, $table1, $table2, $deal_hash) {
        $this->db->select('*');
        $this->db->from($table1);
        $this->db->join($table2, $table2 . '.deal_hash = ' . $table1 . '.deal_hash');
        $this->db->join($table0, $table0 . '.deal_subhash = ' . $table2 . '.deal_subhash');
        $this->db->where($table1 . ".deal_hash", $deal_hash);
        $sql = $this->db->get();
        return $sql->result();
    }
    function displaySumDeals($table2, $deal_where) { 
        $this->db->select('*');
        $this->db->select_sum('deal_original_stock');
        $this->db->select_sum('deal_current_stock');
        $this->db->select_sum('deal_discounted_price'); 
        $this->db->select_sum('deal_returned');
        $this->db->from($table2);
        //$this->db->join('deal_view', 'deal_view.deal_hash = ' . $table2 . '.deal_hash');
        //$this->db->where($table2 . ".deal_hash = '" . $deal_where . "'");
        $sql = $this->db->get();
        return $sql->result(); 
    }
    function displaySelectedSum($table2, $deal_where) {
        $this->db->select_sum('deal_discounted_price'); 
        $this->db->select_sum('deal_original_stock'); 
        $this->db->select_sum('deal_current_stock');
        $this->db->select_sum('deal_returned');
        $this->db->where($deal_where); 
        $sql = $this->db->get_where($table2);
        return $sql->result();
    }
    //process
    function save_single_deal($table2, $deal_list) {
        $sql = $this->db->insert($table2, $deal_list);
    }
    function save_group_deal($table2, $deal_list) {
        $sql = $this->db->insert($table2, $deal_list);
    }
    function update_deal($table2, $deal_where, $deal_list) {
        $this->db->where($deal_where);
        $sql = $this->db->update($table2, $deal_list);
    }
    function delete_deal($table2, $deal_where) {
        $this->db->where($deal_where);
        $sql = $this->db->delete($table2);
    }
    
    
    
    function select_data_deals($did)
    {   
        $this->db->select("*");
        $this->db->from("deals");
        $this->db->join("deal_gallery","deals.deal_subhash = deal_gallery.deal_subhash");
        $this->db->join("deal_view","deals.deal_hash = deal_view.deal_hash");
        $this->db->join("deal_video","deal_video.deal_subhash = deals.deal_subhash");  
        /*under construction*/$this->db->where("deal_gallery.gallery_main = 2");
        $this->db->where("deal_view.deal_hash",$did);
        $this->db->order_by("deals.deal_id","asc");
        $query = $this->db->get();
        return $query;
    }
    function select_data_deals_selection($did)
    {   
        $this->db->select("deal_selection.selection_name,deal_selection.selection_hash");
        $query = $this->db->get();
        return $query;
    }
    function select_data_deals2($sdid)
    {
        $this->db->select("*");
        $this->db->from("deals");
        $this->db->join("deal_gallery","deals.deal_subhash = deal_gallery.deal_subhash");
        $this->db->join("deal_view","deals.deal_hash = deal_view.deal_hash");
        $this->db->join("deal_video","deal_video.deal_subhash = deals.deal_subhash");
        /*under construction*/$this->db->where("deal_gallery.gallery_main = 2");
        $this->db->where("deals.deal_id",$sdid);
        $query = $this->db->get();
        return $query;
    }
    function select_data_deals5($sdid)
    {
        $this->db->select("*");
        $this->db->from("deals");
        $this->db->join("deal_gallery","deals.deal_subhash = deal_gallery.deal_subhash");
        $this->db->join("deal_view","deals.deal_hash = deal_view.deal_hash");
        $this->db->join("deal_video","deal_video.deal_subhash = deals.deal_subhash");
        $this->db->join("deal_selection","deal_selection.deal_subhash = deals.deal_subhash");
        $this->db->join("deal_option","deal_option.selection_hash = deal_selection.selection_hash");
        /*under construction*/$this->db->where("deal_gallery.gallery_main = 2");
        $this->db->where("deals.deal_id",$sdid);
        $query = $this->db->get();
        return $query;
    }
    function select_data_deals3($dvid,$lim1)
    {
        $this->db->select("*");
        $this->db->from("deals");
        $this->db->join("deal_gallery","deals.deal_subhash = deal_gallery.deal_subhash");
        $this->db->join("deal_view","deals.deal_hash = deal_view.deal_hash");
        /*under construction*/$this->db->where("deal_gallery.gallery_main = 2");
        $this->db->where("deal_view.deal_hash",$dvid);
        $this->db->limit(1,$lim1);
        $this->db->order_by("deals.deal_id","asc");
        $query = $this->db->get();
        return $query;
    }
    function select_data_deals4($dh)
    {
        $this->db->select("deal_original_stock,deal_current_stock,deal_discount");
        $this->db->from("deals");
        $this->db->where("deal_hash",$dh);
        $query = $this->db->get();
        return $query;
    }
    function select_data_deals_with_option($dh)
    {
        $this->db->select("deal_option,deal_hash");
        $this->db->from("deals");
        $this->db->where("deal_hash",$dh);
        $query = $this->db->get();
        return $query;
    }
    function update_data_deals($data,$did)
    {
        $this->db->where("deal_id",$did);
        $this->db->update("deals",$data);
    }
    function select_data_deal_fb($dh)
    {
        $this->db->select("deal_statement,deal_title");
        $this->db->from("deals");
        $this->db->where("deal_subhash",$dh);
        $query = $this->db->get();
        return $query;
    }
    function select_data_deal_with_title($title)
    {
        $this->db->select("deals.deal_id,deals.deal_subhash");
        $this->db->from("deals");
        $this->db->join("deal_view","deals.deal_hash = deal_view.deal_hash");
        $this->db->where("deal_view.deal_view_start < ".time()."");
        $this->db->where("deal_view.deal_view_end > ".time()."");
        $this->db->where("deals.deal_title",$title);
        $query = $this->db->get();
        return $query;
    }
    
    //new
    function get_where($where)
    {
        $query = $this->db->get_where("deals",$where);
        return $query;
    }
    function get_where_join($where)
    {
        $this->db->select("deal_view.company_id");
        $this->db->from("deals");
        $this->db->join("deal_view","deals.deal_hash = deal_view.deal_hash");
        $this->db->where($where);
        $query = $this->db->get();
        return $query;
    }
    function update($update,$where)
    {
        $this->db->where($where);
        $this->db->update("deals",$update);
    }
}
?>
