<?php
  class deals_cart_model extends CI_Model
  {
      function select_data_cart($cid)
      {
          $this->db->distinct();
          $this->db->select("*");
          $this->db->from("deal_cart");
          $this->db->join("deals","deals.deal_id = deal_cart.deal_id");
          $this->db->join("deal_view","deals.deal_hash = deal_view.deal_hash");
          $this->db->join("deal_gallery","deals.deal_subhash = deal_gallery.deal_subhash");
          $this->db->where("deal_cart.customer_id",$cid);
          $this->db->where("deal_gallery.gallery_main !=0");
          $this->db->where("deal_view.deal_view_start < ".time()."");
          $this->db->where("deal_view.deal_view_end > ".time()."");
          $this->db->order_by("deal_cart.deal_cart_date","desc");
          $query = $this->db->get();
          return $query;
      }
      //new
      function delete($where)
      {
          $this->db->where($where);
          $this->db->delete("deal_cart");
      }
      function get_where($where)
      {
          $query = $this->db->get_where("deal_cart",$where);
          return $query;
      }
      function get_where2()
      {
          $where = array("deal_cart.customer_id"=>$this->session->userdata("vigattin_id"),"deal_cart.order"=>1,"deal_gallery.gallery_main !="=>0);
          $this->db->join("deals","deals.deal_id = deal_cart.deal_id");
          $this->db->join("deal_gallery","deal_gallery.deal_subhash = deals.deal_subhash");
          $query = $this->db->get_where("deal_cart",$where);
          return $query;
      }
      function update($update,$where)
      {
          $this->db->where($where);
          $this->db->update("deal_cart",$update);
      }
      function insert($insert)
      {
          $this->db->insert("deal_cart",$insert);
      }
  }
?>
