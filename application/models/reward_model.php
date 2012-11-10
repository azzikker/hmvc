<?php
  Class Reward_model extends CI_Model
  {
      function select_data_reward($via)
      {
          $this->db->where("reward_via",$via);
          $query = $this->db->get("reward");
          return $query;
      }
  }
?>
