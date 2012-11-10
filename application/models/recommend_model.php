<?php
  Class Recommend_Model extends CI_Model
  {
      function insert_data_recommend($data)
      {
          $this->db->insert("recommend",$data);
      }
      function select_data_recommend($datas)
      {
          $query = $this->db->get_where("recommend",$datas);
          return $query;
      }
      function update_data_recommend($rid,$data)
      {
          $this->db->where("recommend_id",$rid);
          $this->db->update("recommend",$data);
      }
  }
?>
