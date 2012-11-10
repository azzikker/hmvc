<?php
  class Invite_model extends CI_Model
  {
     //display
     function displaySelected($tableV, $invite_where) {
         $sql = $this->db->get_where($tableV, $invite_where);
         return $sql->result();
     }
     //process 
      
      
      
      
      //---------------------------------
      function insert_invite_model($data)
      {
          $this->db->insert("invite",$data);
      }
      function select_invite_model($id,$email)
      {
          $this->db->where("invited_email",$email);
          $this->db->where("customer_hash",$id);
          $query = $this->db->get("invite");
          return $query;
      }
      function select_invite_model2($id)
      {
          $this->db->where("customer_hash",$id);
          $query = $this->db->get("invite");
          return $query;
      }
      function select_invite_model3($ln,$fn,$t,$me,$ch)
      {
          $this->db->where("invited_lname",$ln);
          $this->db->where("invited_fname",$fn);
          $this->db->where("invited_date",$t);
          $this->db->where("invited_email",$me);
          $this->db->where("customer_hash",$ch);
          $this->db->where("invited_registered",0);
          $query = $this->db->get("invite");
          return $query;
      }
      function update_invite_model($data,$ln,$fn,$t,$me,$ch)
      {
          $this->db->where("invited_lname",$ln);
          $this->db->where("invited_fname",$fn);
          $this->db->where("invited_date",$t);
          $this->db->where("invited_email",$me);
          $this->db->where("customer_hash",$ch);
          $this->db->update("invite",$data);
      }
  }
?>
