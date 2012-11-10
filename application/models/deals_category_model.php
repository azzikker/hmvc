<?php
class deals_category_model extends CI_Model
{
    //display
    function displayCategory($table) {
        $sql = $this->db->get($table);
        return $sql->result();
    }
    function displayCategorySelected($table, $category_where) {
        $sql = $this->db->get_where($table, $category_where);
        return $sql->result();
    }
    function displayCategoryUnselected($table, $category_where) {
        $sql = $this->db->get_where($table, "category_id != $category_where");
        return $sql->result();
    }
    function edit_category($table, $category_where) {
        $sql = $this->db->get_where($table, $category_where);
        return $sql->result();
    }
    //process
    function save_category($table, $category_list) {
        $sql = $this->db->insert($table, $category_list);
    }
    function update_category($table, $category_list, $category_where) {
        $this->db->where($category_where);
        $sql = $this->db->update($table, $category_list);
    }
    function delete_category($table, $category_where) {
        $this->db->where($category_where);
        $sql = $this->db->delete($table);
    }

    function select_data_deal_category()
    {
        $query = $this->db->get("deal_category");
        return $query;
    }

    //added functions

    //----restore or trash category
    function trash_restore_category($table, $category_where, $action)
    {
        $this->db->where($category_where);

        $this->db->update($table, array('deleted' => $action));

        return $this->db->affected_rows();//--testing purpose
    }

    //---- get current or trashed category
    function select_category_by_deleted_col($table, $deleted = 0)
    {
        $query = $this->db->get_where('deal_category', array('deleted' => $deleted));
        
        return $query->result();
    }
}
?>
