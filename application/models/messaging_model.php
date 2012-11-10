<?php
  Class Messaging_model extends CI_Model
  {
      function insert_data_messaging($data)
      {
          $this->db->insert("messaging",$data);
      }
  }
?>
