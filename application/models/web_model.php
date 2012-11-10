<?php
class Web_Model extends CI_Model
{
     //display
     function displayAll($tableWeb, $query_line) {
         $query_line;
         $sql = $this->db->get($tableWeb);
         return $sql;
     }
     function displaySelected($tableWeb, $WebWhere) {
        $sql1 = $this->db->get_where($tableWeb, $WebWhere);
        return $sql1;
    } 
     //process
     function saveWeb($tableWeb, $WebList) {
        $sql1 = $this->db->insert($tableWeb, $WebList);
    }
     function updateAll($tableWeb, $WebWhere) {
         $sql = $this->db->update($tableWeb, $WebWhere);
     }
     function updateSelected($tableWeb, $WebWhere, $WebList) {
         $this->db->where($WebWhere);
         $sql = $this->db->update($tableWeb, $WebList);
     }
     //
     function get()
     {
         $sql = $this->db->get("web_setting");
         return $sql;
     }
}
?>
