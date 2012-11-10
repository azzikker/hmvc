<?php
  class Customer_Model extends CI_Model
  {
      //display
      function displayCustomers($tableY) {
          $sql = $this->db->get_where($tableY);
          return $sql->result();
      }
      function displaySelected($table11, $customer_where) {
          $sql = $this->db->get_where($table11, $customer_where);
          return $sql->result();
      }
      function displaySelectedFull($tableY, $tableZ, $customer_where) {
          $this->db->select('*');
          $this->db->from($tableY);
          $this->db->join($tableZ, $tableZ . '.gender_id = ' . $tableY . '.customer_gender');
          $this->db->where($customer_where);
          $sql = $this->db->get();
          return $sql->result();
      }
      //process
      
      
      
      
      //----------------------------------
      function insert_data_customer($data)
      {
          $this->db->insert("customers",$data);
      }
      function select_data_customer_id_boolean($id)
      {
          $this->db->where("customer_id",$id);
          $query = $this->db->get("customers")->num_rows();
          if($query > 0)
          {
              return true;
          }
          else
          {
              return false;
          }
      }
      function select_data_customer_email_boolean($email)
      {
          $this->db->where("customer_email",$email);
          $query = $this->db->get("customers")->num_rows();
          if($query > 0)
          {
              return true;
          }
          else
          {
              return false;
          }
      }
      function select_data_customer_id($id)
      {
          $this->db->select("*");
          $this->db->from("customers");
          $this->db->where("customers.customer_id",$id);
          $query = $this->db->get();
          return $query;
      }
      function select_data_customer_hash($id)
      {
          $this->db->where("customer_hash",$id);
          $query = $this->db->get("customers");
          return $query;
      }
      function update_data_customer_id($data,$id)
      {
          $this->db->where("customer_id",$id);
          $this->db->update("customers",$data);
      }
      function select_data_customer_info($vid)
      {
          $this->db->where("customer_id",$vid);
          $this->db->where("customer_hash !=","");
          $query = $this->db->get("customers");
          if($query->num_rows() > 0)
          {
              return true;
          }
          else
          {
              return false;
          }
      }
      // dummy only
      function update_data_customer_hash($data,$hash)
      {
          $this->db->where("customer_hash",$hash);
          $this->db->update("customers",$data);
      }
      function update_data_customer_id2($data,$hash)
      {
          $this->db->where("customer_id",$hash);
          $this->db->update("customers",$data);
      }
      //new
      function update($update,$where)
      {
          $this->db->where($where);
          $this->db->update("customers",$update);
      }
      function get_where($where)
      {
          $query = $this->db->get_where("customers",$where);
          return $query;
      }
  }
?>
