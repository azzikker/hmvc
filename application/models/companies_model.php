<?php
class companies_model extends CI_Model
{
    //display
    //SELECT * FROM tablea WHERE "roger" LIKE '%field2%'
    function displayCompanies($table) {
        $this->db->order_by("company_name","asc"); 
        $sql = $this->db->get($table);
        return $sql->result();
    }
    function displayCompaniesLike($table, $field, $like) {
        $sql = $this->db->query("SELECT * FROM " . $table . " WHERE " . $field . " LIKE '%" . $like . "%'");
        return $sql->result();                                                  
    }
    function displayCompaniesMax($table) {
        $this->db->select_max('company_id');
        $sql = $this->db->get($table);
        return $sql->result();
    }
    function displayCompaniesDateBased($table, $company_where) {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->join("deal_view", "deal_view.company_id = " . $table . ".company_id"); 
        $this->db->order_by("deal_view_due","asc"); 
        $sql = $this->db->get();
        return $sql->result();
    }
    function displaySelected($table, $company_where) {
        $this->db->order_by("company_name","asc");
        $sql = $this->db->get_where($table, $company_where);
        return $sql->result();
    }
    function displaySelectedLike($table, $field, $like) {
        $sql = $this->db->query("SELECT * FROM " . $table . " WHERE " . $field . " LIKE '%" . $like . "%'");
        return $sql->result();                                                  
    }
    function dusplayCompaniesCount($table, $company_where) {
        $sql = $this->db->get_where($table, $company_where);
        return $sql;
    }
    function displayUnselected($table, $company_where) {
        $sql = $this->db->get_where($table, "company_id != $company_where");
        return $sql->result();
    }
    function displayCompaniesGrouped($table1, $table2, $where) {
        $this->db->select('*');
        $this->db->from($table1);
        $this->db->join($table2, $table2 . '.deal_hash = ' . $table1 . '.deal_hash');
        $this->db->where($where);
        $sql = $this->db->get();
        return $sql->result();
    }
    function company_similarity($where)
    {
        $this->db->where("company_name",$where);
        $sql = $this->db->get("companies")->num_rows();
        if($sql > 0):
            return true;
        else:
            return false;
        endif;
    } 
    //process
    function saveCompany($table, $company_list) {
        $sql = $this->db->insert($table, $company_list);
    }
    function updateCompany($table, $company_where, $company_list) {
        $this->db->where($company_where);
        $sql = $this->db->update($table, $company_list);
    }
    function deleteCompany($table, $company_where) {
        $this->db->where($company_where);
        $sql = $this->db->delete($table);
    }
    
    /////////////////////////
    ///Added Functions//////
    ///////////////////////
    
    function displayCompanies_by_deleted($table ,$deleted = 0) {
        $this->db->order_by("company_name","asc"); 
        $sql = $this->db->get_where($table, array('deleted' => $deleted));
        return $sql->result();
    }
    
    function trashed_restore_company($table, $company_id, $delete = 1)
    {
        $this->db->where('company_id', $company_id);
        $this->db->update($table, array('deleted' => $delete));
        return $this->db->affected_rows();
    }
    
    
    
    
}
?>
