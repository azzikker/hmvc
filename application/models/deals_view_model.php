<?php
class deals_view_model extends CI_Model
{
    //display
    function displayViews($table1) {
        $sql = $this->db->get($table1);
        return $sql->result();   
    }
    function displayCompaniesBased($table1, $company_where) {
        $this->db->select('*');
        $this->db->from($table1);
        $this->db->join("companies", "companies.user_id = " . $table1 . ".company_id"); 
        $sql = $this->db->get();
        return $sql->result();
    }
    function displayUserBased($table, $table1, $company_where) {
        $this->db->select('*');
        $this->db->from($table1);
        $this->db->join($table, $table . ".company_id = " . $table1 . ".company_id");
        $this->db->where($company_where);
        $sql = $this->db->get();
        return $sql->result();
    }
    function displayViewCurrent($table1, $deal_where) {
        $this->db->select("*");
        $this->db->from($table1);
        $this->db->join("deals","deals.deal_hash = deal_view.deal_hash");
        $this->db->where("deal_view.deal_view_start <=" . $deal_where);
        $this->db->where("deal_view.deal_view_end >= " . $deal_where);
        $this->db->where("deals.deal_select = 1");
        $this->db->order_by("deal_view.deal_view_id","desc");
        $sql = $this->db->get();
        return $sql->result();
    }
    function displayViewCurrentLike($table1, $deal_where, $field, $like) {
        $this->db->select("*");
        $this->db->from($table1);
        $this->db->join("deals","deals.deal_hash = deal_view.deal_hash");
        $this->db->where("deal_view.deal_view_start <=" . $deal_where);
        $this->db->where("deal_view.deal_view_end >= " . $deal_where);
        $this->db->like($field, $like);
        $this->db->where("deals.deal_select = 1");
        $this->db->order_by("deal_view.deal_view_id","desc");
        $sql = $this->db->get();
        return $sql->result();
    } 
    function displayViewBased($table1, $deal_where) {
        $this->db->select("*");
        $this->db->from($table1);
        $this->db->join("deals","deals.deal_hash = deal_view.deal_hash");
        $this->db->where("deal_view.deal_view_start <=" . $deal_where);
        $this->db->where("deal_view.deal_view_end >= " . $deal_where);
        $this->db->where("deals.deal_select = 1");
        $this->db->order_by("deal_view.deal_view_id","desc");
        $sql = $this->db->get();
        return $sql->result();
    }
    function displayViewCurrentSelected($table1, $deal_where) {
        $this->db->select("*");
        $this->db->from($table1);
        $this->db->join("deals","deals.deal_hash = deal_view.deal_hash");
        $this->db->join("companies","companies.company_id = deal_view.company_id");
        $this->db->where("deal_view.deal_view_start <=" . $deal_where);
        $this->db->where("deal_view.deal_view_end >= " . $deal_where);
        $this->db->where("deals.deal_select = 1");
        $this->db->where("companies.user_id = " . $this->session->userdata('user_id'));
        $this->db->order_by("deal_view.deal_view_id","desc");
        $sql = $this->db->get();
        return $sql->result();
    }
    function displayViewCurrentSelectedLike($table1, $deal_where, $field, $like) {
        $this->db->select("*");
        $this->db->from($table1);
        $this->db->join("deals","deals.deal_hash = deal_view.deal_hash");
        $this->db->join("companies","companies.company_id = deal_view.company_id");
        $this->db->where("deal_view.deal_view_start <=" . $deal_where);
        $this->db->where("deal_view.deal_view_end >= " . $deal_where);
        $this->db->like($field, $like);
        $this->db->where("deals.deal_select = 1");
        $this->db->where("companies.user_id = " . $this->session->userdata('user_id'));
        $this->db->order_by("deal_view.deal_view_id","desc");
        $sql = $this->db->get();
        return $sql->result();
    }
    function displayViewFuture($table1, $deal_where) {
        $this->db->select("*");
        $this->db->from($table1);
        $this->db->join("deals","deals.deal_hash = deal_view.deal_hash");
        $this->db->where("deal_view.deal_view_start >=" . $deal_where);
        $this->db->where("deals.deal_select = 1");
        $this->db->order_by("deal_view.deal_view_id","desc");
        $sql = $this->db->get();
        return $sql->result();
    }
    function displayViewFutureLike($table1, $deal_where, $field, $like) {
        $this->db->select("*");
        $this->db->from($table1);
        $this->db->join("deals","deals.deal_hash = deal_view.deal_hash");
        $this->db->where("deal_view.deal_view_start >=" . $deal_where);
        $this->db->like($field, $like);
        $this->db->where("deals.deal_select = 1");
        $this->db->order_by("deal_view.deal_view_id","desc");
        $sql = $this->db->get();
        return $sql->result();
    }
    function displayViewFutureSelected($table1, $deal_where) {
        $this->db->select("*");
        $this->db->from($table1);
        $this->db->join("deals","deals.deal_hash = deal_view.deal_hash");
        $this->db->join("companies","companies.company_id = deal_view.company_id");
        $this->db->where("deal_view.deal_view_start >=" . $deal_where);
        $this->db->where("deals.deal_select = 1");
        $this->db->where("companies.user_id = " . $this->session->userdata('user_id'));
        $this->db->order_by("deal_view.deal_view_id","desc");
        $sql = $this->db->get();
        return $sql->result();
    }
    function displayViewFutureSelectedLike($table1, $deal_where, $field, $like) {
        $this->db->select("*");
        $this->db->from($table1);
        $this->db->join("deals","deals.deal_hash = deal_view.deal_hash");
        $this->db->join("companies","companies.company_id = deal_view.company_id");
        $this->db->where("deal_view.deal_view_start >=" . $deal_where);
        $this->db->like($field, $like);
        $this->db->where("deals.deal_select = 1");
        $this->db->where("companies.user_id = " . $this->session->userdata('user_id'));
        $this->db->order_by("deal_view.deal_view_id","desc");
        $sql = $this->db->get();
        return $sql->result();
    }
    function displayViewPast($table1, $deal_where) {
        $this->db->select("*");
        $this->db->from($table1);
        $this->db->join("deals","deals.deal_hash = deal_view.deal_hash");
        $this->db->where("deal_view.deal_view_end <= " . $deal_where); 
        $this->db->where("deals.deal_select = 1");
        $this->db->order_by("deal_view.deal_view_id","desc");
        $sql = $this->db->get();
        return $sql->result();
    }
    function displayViewPastLike($table1, $deal_where, $field, $like) {
        $this->db->select("*");
        $this->db->from($table1);
        $this->db->join("deals","deals.deal_hash = deal_view.deal_hash");
        $this->db->where("deal_view.deal_view_end <= " . $deal_where); 
        $this->db->like($field, $like);
        $this->db->where("deals.deal_select = 1");
        $this->db->order_by("deal_view.deal_view_id","desc");
        $sql = $this->db->get();
        return $sql->result();
    }
    function displayViewPastSelected($table1, $deal_where) {
        $this->db->select("*");
        $this->db->from($table1);
        $this->db->join("deals","deals.deal_hash = deal_view.deal_hash");
        $this->db->join("companies","companies.company_id = deal_view.company_id");
        $this->db->where("deal_view.deal_view_end <= " . $deal_where);
        $this->db->where("deals.deal_select = 1");
        $this->db->where("companies.user_id = " . $this->session->userdata('user_id'));
        $this->db->order_by("deal_view.deal_view_id","desc");
        $sql = $this->db->get();
        return $sql->result();
    }
    function displayViewPastSelectedLike($table1, $deal_where, $field, $like) {
        $this->db->select("*");
        $this->db->from($table1);
        $this->db->join("deals","deals.deal_hash = deal_view.deal_hash");
        $this->db->join("companies","companies.company_id = deal_view.company_id");
        $this->db->where("deal_view.deal_view_end <= " . $deal_where);
        $this->db->like($field, $like);
        $this->db->where("deals.deal_select = 1");
        $this->db->where("companies.user_id = " . $this->session->userdata('user_id'));
        $this->db->order_by("deal_view.deal_view_id","desc");
        $sql = $this->db->get();
        return $sql->result();
    }
    function displaySelected($table1, $deal_where) {
        $sql = $this->db->get_where($table1, $deal_where);
        return $sql->result();
    }
    function displaySelectedDateBased($table1, $deal_where, $where_start, $where_end) {
        $this->db->select('*');
        $this->db->from($table1);                              
        $this->db->where("deal_view_due >= " . $where_start);
        $this->db->where("deal_view_due <= " . $where_end); 
        $this->db->order_by("deal_view_due","asc"); 
        $sql = $this->db->get();
        return $sql->result();                
    }
    function displayDealsMax($table) {
        $this->db->select_max('deal_view_id');
        $sql = $this->db->get($table);
        return $sql->result();
    }
    function displaySelectedDateBasedMerchant($table1, $deal_where, $where_start, $where_end) {
        $this->db->select('*');
        $this->db->from($table1);                              
        $this->db->where("deal_view_due >= " . $where_start);
        $this->db->where("deal_view_due <= " . $where_end);
        $this->db->where($deal_where);
        $this->db->order_by("deal_view_due","asc"); 
        $sql = $this->db->get();
        return $sql->result();                
    }
    function displayLastView() {
        $sql = $this->db->query("select * from deal_view where deal_view_id = (select max(deal_view_id)  from deal_view)");
        return $sql->result();
    }
    function displayFieldforDate($table1, $deal_where) {
        $this->db->select_min("deal_view_start");
        $this->db->select_min("deal_view_end");
        $this->db->where($deal_where);
        $sql = $this->db->get($table1);
        return $sql->result();
    }
    //process 
    function save_view($table1, $view_list) {
        $sql = $this->db->insert($table1, $view_list);
    }
    function update_view($table1, $deal_where, $view_list) {
        $this->db->where($deal_where);
        $sql = $this->db->update($table1, $view_list);
    }
    function delete_view($table1, $deal_where) {
        $this->db->where($deal_where);
        $sql = $this->db->delete($table1);
    }
    
    
    //-----------------------------
    function select_data_dealsview()
    {
        $this->db->distinct();
        $this->db->select("*");
        $this->db->from("deal_view");
        $this->db->join("deals","deals.deal_hash = deal_view.deal_hash");
        $this->db->join("deal_video","deal_video.deal_subhash = deals.deal_subhash");
        $this->db->where("deal_view.deal_view_start < ".time()."");
        $this->db->where("deal_view.deal_view_end > ".time()."");
        $this->db->where("deals.deal_select = 1");
        $this->db->order_by("deal_view.deal_view_start","desc");
        $query = $this->db->get();
        return $query;
    }
    function select_data_dealsview_gender($gid)
    {
        $this->db->distinct();
        $this->db->select("*");
        $this->db->from("deal_view");
        $this->db->join("deals","deals.deal_hash = deal_view.deal_hash");
        $this->db->join("deal_video","deal_video.deal_subhash = deals.deal_subhash");
        $where = "deal_view.deal_view_start < ".time()." and deal_view.deal_view_end > ".time()." and deals.deal_select = 1 and deal_view.gender_id = ".$gid."";
        $this->db->where($where);
        $this->db->order_by("deal_view.deal_view_start","desc");
        $query = $this->db->get();
        return $query;
    }
    function select_data_dealsview_category($cid)
    {
        $this->db->distinct();
        $this->db->select("*");
        $this->db->from("deal_view");
        $this->db->join("deals","deals.deal_hash = deal_view.deal_hash");
        $this->db->join("deal_video","deal_video.deal_subhash = deals.deal_subhash");
        $this->db->where("deal_view.deal_view_start < ".time()."");
        $this->db->where("deal_view.deal_view_end > ".time()."");
        $this->db->where("deals.deal_select = 1");
        $this->db->where("deal_view.category_id = '$cid'");
        $this->db->order_by("deal_view.deal_view_start","desc");
        $query = $this->db->get();
        return $query;
    }
    function select_data_dealsview_category2($cid)
    {
        $this->db->distinct();
        $this->db->select("*");
        $this->db->from("deal_view");
        $this->db->join("deals","deals.deal_hash = deal_view.deal_hash");
        $this->db->join("deal_video","deal_video.deal_subhash = deals.deal_subhash");
        $this->db->where("deal_view.deal_view_end < ".time()."");
        $this->db->where("deals.deal_select = 1");
        $this->db->where("deal_view.category_id = '$cid'");
        $this->db->order_by("deal_view.deal_view_start","desc");
        $query = $this->db->get();
        return $query;
    }
    function select_data_dealsview2($deal_id)
    {
        $this->db->select("*");
        $this->db->from("deal_view");
        $this->db->join("deals","deals.deal_hash = deal_view.deal_hash");
        $this->db->join("deal_video","deal_video.deal_subhash = deals.deal_subhash");
        $this->db->where("deals.deal_hash",$deal_id);
        $this->db->where("deal_view.deal_view_start < ".time()."");
        $this->db->where("deal_view.deal_view_end > ".time()."");
        $this->db->order_by("deal_view.deal_view_start","desc");
        $query = $this->db->get();
        return $query;
    }
    function select_data_dealsview3()
    {
        $this->db->select("*");
        $this->db->from("deal_view");
        $this->db->join("deals","deals.deal_hash = deal_view.deal_hash");
        $this->db->where("deal_view.deal_view_start < ".time()."");
        $this->db->where("deal_view.deal_view_end > ".time()."");
        $this->db->where("deals.deal_select = 1");
        $this->db->order_by("deal_view.deal_view_start","random");
        $this->db->limit(15);
        $query = $this->db->get();
        return $query;
    }
    function select_data_deals_view4($hash)
    {
        $this->db->select("deal_view_end");
        $this->db->from("deal_view");
        $this->db->where("deal_hash",$hash);
        $query = $this->db->get();
        return $query;
    }
    function select_data_dealsview5()
    {
        $this->db->distinct();
        $this->db->select("*");
        $this->db->from("deal_view");
        $this->db->join("deals","deals.deal_hash = deal_view.deal_hash");
        $this->db->join("deal_video","deal_video.deal_subhash = deals.deal_subhash");
        $where = "deal_view.deal_view_end < ".time()." and deals.deal_select = 1";
        $this->db->where($where);
        $this->db->order_by("deal_view.deal_view_start","desc");
        $this->db->limit(100);
        $query = $this->db->get();
        return $query;
    }
    function select_data_dealsview_month($som,$eom)
    {
        $this->db->distinct();
        $this->db->select("*");
        $this->db->from("deal_view");
        $this->db->join("deals","deals.deal_hash = deal_view.deal_hash");
        $this->db->join("deal_video","deal_video.deal_subhash = deals.deal_subhash");
        $where = "deal_view.deal_view_end < ".$eom." and deal_view.deal_view_start > ".$som." and deals.deal_select = 1";
        $this->db->where($where);
        $this->db->order_by("deal_view.deal_view_start","desc");
        $this->db->limit(100);
        $query = $this->db->get();
        return $query;
    }
    function select_data_dealsview6($deal_id)
    {
        $this->db->select("*");
        $this->db->from("deal_view");
        $this->db->join("deals","deals.deal_hash = deal_view.deal_hash");
        $this->db->join("deal_video","deal_video.deal_subhash = deals.deal_subhash");
        $this->db->where("deals.deal_hash",$deal_id);
        $this->db->where("deal_view.deal_view_end < ".time()."");
        $this->db->order_by("deal_view.deal_view_start","desc");
        $query = $this->db->get();
        return $query;
    }
    // fineprint
    function select_data_fineprint($sh)
    {
        $this->db->where("deal_subhash",$sh);
        $query = $this->db->get("deal_fineprint");
        return $query;
    }
    //highlights
    function select_data_higlight($sh)
    {
        $this->db->where("deal_subhash",$sh);
        $query = $this->db->get("deal_highlight");
        return $query;
    }
    //new
    function get_where($where)
    {
        $query = $this->db->get_where("deal_view",$where);
        return $query;
    }
}
?>
