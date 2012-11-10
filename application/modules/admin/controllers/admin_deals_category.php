<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_Deals_Category extends MX_Controller {
    public function __construct() {
        parent::__construct();
        $this->checkuser();
        session_start();      
        $this->load->model('Deals_Category_Model');
        $this->load->model('Audit_Trail_Model');
        $this->load->helper("green");
        $this->load->helper("gt++");
        $this->load->helper("gt");
    }
    //authenticator
    public function checkuser() {      
        if ( $this->session->userdata('login_state') <> TRUE ) {
             redirect(base_url().'user/login');
        }
    }
    //display
    function index() {   
        $table = "deal_category";  
        $data["page"] = "Deals Category";
        //--orginal
            #$data["sql"] = $this->Deals_Category_Model->displayCategory($table);
        //--
        //--mod
        $data["sql"] = $this->Deals_Category_Model->select_category_by_deleted_col($table);
        //--
        $this->load->view("layouts/admin_layout_header");
        $this->load->view("deals/deals_category/index_view", $data);    
        $this->load->view("layouts/admin_layout_footer");     
    }

    function edit_category() {
        $table = "deal_category";
        $category_where['category_id'] = $this->uri->segment(4);
        $data["page"] = "Edit Deal Category";
        $data["sql"] = $this->Deals_Category_Model->edit_category($table, $category_where);
        $this->load->view("layouts/admin_layout_header");
        $this->load->view("deals/deals_category/edit_view", $data);
        $this->load->view("layouts/admin_layout_footer");
    }
    //process
    function save_category() {
        $table = "deal_category";
        $customsize = array('height'=>'50','width'=>'50');
        $path1 = "assets/general/images/deals_category/inactive/";
        $path2 = "assets/general/images/deals_category/active/"; 
        $category_list['category_name'] = xss_cleaner($_POST["addDCN"]);
        if($_FILES["addDCIinactive"]["name"] != '') {                                                  
            $category_icon1 = _upload_photo("addDCIinactive",$path1,'default.jpg','true','true','','150',$customsize);
            $category_list['category_icon_inactive'] = $category_icon1;
        }
        if($_FILES["addDCIactive"]["name"] != '') {                                                  
            $category_icon2 = _upload_photo("addDCIactive",$path2,'default.jpg','true','true','','150',$customsize);
            $category_list['category_icon_active'] = $category_icon2;
        }
        $this->Deals_Category_Model->save_category($table, $category_list);
        //audit_trail start
        $insert = audit_trail("Save", "Deals Category Maintenance", "Add Category", $category_list['category_name'], $this->session->userdata('user_id'));
        $this->Audit_Trail_Model->save_audit("audit_trail", $insert);
        //audit_trail end
        redirect(base_url() . "admin/admin_deals_category");
    }
    function update_category() {
        $table = "deal_category";
        $category_where['category_id'] = $this->uri->segment(4);
        $category_list['category_name'] = xss_cleaner($_POST["editDCN"]);
        $this->Deals_Category_Model->update_category($table, $category_list, $category_where);
        //audit_trail start
        $insert = audit_trail("Update", "Deals Category Maintenance", "Edit Category", $category_list['category_name'], $this->session->userdata('user_id'));
        $this->Audit_Trail_Model->save_audit("audit_trail", $insert);
        //audit_trail end
        redirect(base_url() . "admin/admin_deals_category");
    }

    function delete_category() {
        $table = "deal_category";
        $category_where['category_id'] = $this->uri->segment(4);
        $sql =  $this->Deals_Category_Model->displayCategorySelected($table, $category_where); 
        foreach($sql as $row) { $category_name = $row->category_name; }
        //audit_trail start
        $insert = audit_trail("Delete", "Deals Category Maintenance", "Delete Category", $category_name, $this->session->userdata('user_id'));
        $this->Audit_Trail_Model->save_audit("audit_trail", $insert);
        //audit_trail end
        $this->Deals_Category_Model->delete_category($table, $category_where);
        redirect(base_url() . "admin/admin_deals_category");
    }

    //-------------------//
    //--added functions--//
    //-------------------//

    //--trashed view
    function trashed_category_view()
    {
        $table = "deal_category";  
        $data["page"] = "Deals Category";
        $data["sql"] = $this->Deals_Category_Model->select_category_by_deleted_col($table, 1);
        $this->load->view("layouts/admin_layout_header");
        $this->load->view("deals/deals_category/trash_view", $data);
        $this->load->view("layouts/admin_layout_footer"); 
    }
    //--end trashed view

    //--processes

    function trash_deals_category($multi = false, $category_id = '')//--params for multiple trash
    {
        $table = "deal_category";
        $category_where['category_id'] = ($multi === true)?$category_id:$this->uri->segment(4);//--if params are default, use uri segment variable
        $sql =  $this->Deals_Category_Model->displayCategorySelected($table, $category_where); 
        foreach($sql as $row) { $category_name = $row->category_name; }
        //audit_trail start
        $insert = audit_trail("Delete", "Deals Category Maintenance", "Delete Category", $category_name, $this->session->userdata('user_id'));
        $this->Audit_Trail_Model->save_audit("audit_trail", $insert);
        //audit_trail end
        $ret = $this->Deals_Category_Model->trash_restore_category($table, $category_where, 1);

        if ($multi === true)
        {
            $multi = false;
        } 
        else 
        {
            redirect(base_url() . "admin/admin_deals_category");
        }
        
        
    }

    function multi_trash_deals_category()
    {
        //--array of category_ids from checkboxes form
        $category_ids = $this->input->post('checkbox');
        
        //--if no category_id or checkbox is selected then redirect
        if ($category_ids === false) 
        {
            redirect(base_url() . "admin/admin_deals_category/trashed_category_view");

            //--if not redirected then exit
            exit();
        }

        //--begin loop trough category_ids
        foreach ($category_ids as $id) 
        {
            $this->trash_deals_category(true, $id);
        }

        //--after loop is finished then redirect
        redirect(base_url() . "admin/admin_deals_category");
    }
    
    function restore_deals_category($multi = false, $category_id = '')
    {
        $table = "deal_category";
        $category_where['category_id'] = ($multi === true)?$category_id:$this->uri->segment(4);
        $sql =  $this->Deals_Category_Model->displayCategorySelected($table, $category_where); 
        foreach($sql as $row) { $category_name = $row->category_name; }
        //audit_trail start
        $insert = audit_trail("Delete", "Deals Category Maintenance", "Delete Category", $category_name, $this->session->userdata('user_id'));
        $this->Audit_Trail_Model->save_audit("audit_trail", $insert);
        //audit_trail end
        $this->Deals_Category_Model->trash_restore_category($table, $category_where, 0);
        
        if ($multi === true)
        {
            $multi = false;
        } 
        else 
        {
            redirect(base_url() . "admin/admin_deals_category");
        }
    }
    
    function multi_restore_deals_category()
    {
        //--array of category_ids from checkboxes form
        $category_ids = $this->input->post('checkbox');
        
        if ($category_ids === false) 
        {
            redirect(base_url() . "admin/admin_deals_category/trashed_category_view");

            //--if not redirected then exit
            exit();
        }
        
        //--begin loop trough category_ids
        foreach ($category_ids as $id) 
        {
            $this->restore_deals_category(true, $id);
        }

        //--after loop is finished then redirect
        redirect(base_url() . "admin/admin_deals_category/trashed_category_view");
    }
}  
?>
