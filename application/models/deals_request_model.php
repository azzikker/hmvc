<?php
  class deals_request_model extends CI_Model
  {
      function save_data_request($data)
      {
          $this->db->insert("deal_request",$data);
      }
      function select_data_request($vid,$cid)
      {
          $this->db->where("deal_hash",$vid);
          $this->db->where("customer_id",$cid);
          $query = $this->db->get("deal_request");
          return $query;
      }
      function select_data_request2($cid)
      {
          $this->db->where("customer_id",$cid);
          $query = $this->db->get("deal_request");
          return $query;
      }
      //
      function get_where($where)
      {
          $query = $this->db->get_where("deal_request",$where);
          return $query;
      }
  }
?>
