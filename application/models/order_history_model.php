<?php
  class order_history_model extends CI_Model
  {   
      //display
      function displayConfirmedWhere($tableW, $where) {
          $sql = $this->db->where($tableW, $where);
          return $sql;
      }
      //process
  }
?>
