<?php
  class deals_gender_model extends CI_Model
  {
      function select_data_gender()
      {
          $query = $this->db->get("gender");
          return $query;
      }
  }
?>
