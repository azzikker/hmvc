<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Admin_Branches extends MX_Controller{
    public function __construct() {
        parent::__construct();
        $this->checkuser(); 
        session_start();
        $this->load->model('Web_Model');   
        $this->load->model('Companies_Model');
        $this->load->model('Deals_Location_Model');
        $this->load->model('Deals_Contact_Model');
        $this->load->model('User_Model');
        $this->load->model('User_Level_Model');
        $this->load->model('Audit_Trail_Model');
        $this->load->helper('green');
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
    function editBranches() {
        $table = "companies";
        $tableA = "deal_contact";
        $table8 = "deal_location";
        $data["page"] = "Branches";
        $branch_where["location_hash"] = $this->uri->segment(5);
        $sql1 = $this->Deals_Location_Model->displaySelected($table8, $branch_where);
        foreach($sql1 as $row1) { $company_where["company_hash"] = $row1->company_hash; $contact_where["location_hash"] = $row1->location_hash; }
        $data["sql0"] = $this->Companies_Model->displaySelected($table, $company_where);
        $data["sql1"] = $this->Deals_Location_Model->displaySelected($table8, $branch_where);
        $data["sql2"] = $this->Deals_Contact_Model->displaySelected($tableA, $contact_where);
        $this->load->view("layouts/admin_layout_header");
        $this->load->view("companies/branches/edit_branches", $data);
        $this->load->view("layouts/admin_layout_footer");
    }
    //process
    function saveBranches() {
        $tableA = "deal_contact";
        $table8 = "deal_location";
        $company_name = $_POST["addCompany"];
        $branch_list['location_name'] = xss_cleaner($_POST["addName"]);
        $branch_list['location_email'] = xss_cleaner($_POST["addEmail"]);
        $branch_list['location_fax'] = xss_cleaner($_POST["addFax"]);
        $branch_list['location_address'] = xss_cleaner($_POST["addLocation"]);
        $branch_list['location_link'] = xss_cleaner($_POST["addLink"]);
        $branch_list['location_hash'] = md5(xss_cleaner($_POST["addName"]) . time());
        $branch_list['company_hash'] = $this->uri->segment(4);
        
        $bc_count = $this->db->escape_str($_POST["nBCONTACT"]);
        for($ix=1;$ix<=$bc_count;$ix++) {
            $contact_list['contact_no'] = xss_cleaner($_POST["addBCN" . $ix]);
            $contact_list['location_hash'] = $branch_list['location_hash'];
            $this->Deals_Contact_Model->saveDealsContact($tableA, $contact_list);
        }
        $this->Deals_Location_Model->save_location($table8, $branch_list);
        //audit_trail start
        $insert = audit_trail("Save", "Companies Maintenance", "Add New Branch", $company_name . " [ <span class=\"blue\">" . $branch_list['location_name'] . "</span> ] ", $this->session->userdata('user_id'));
        $this->Audit_Trail_Model->save_audit("audit_trail", $insert);
        //audit_trail end
        redirect(base_url() . "admin/admin_companies/profileCompany/" . $this->uri->segment(4) . "/branches");
    }
    function updateBranches() {
        $tableA = "deal_contact";
        $table8 = "deal_location";
        $location_hash = $this->uri->segment(5);
        $company_where['company_hash'] = $this->uri->segment(4);
        $company_name = $_POST["editCompany"];
        $branch_where['location_hash'] = $location_hash;
        $branch_list['location_name'] = xss_cleaner($_POST["editName"]);
        $branch_list['location_email'] = xss_cleaner($_POST["editEmail"]);
        $branch_list['location_fax'] = xss_cleaner($_POST["editFax"]);
        $branch_list['location_address'] = xss_cleaner($_POST["editLocation"]);
        $branch_list['location_link'] = xss_cleaner($_POST["editLink"]);
        
        $bc_count_old = xss_cleaner($_POST["mBCONTACT"]);
        $bc_count = xss_cleaner($_POST["nBCONTACT"]);
        for($ix=1;$ix<=$bc_count_old;$ix++) {
            //start of contact_id decryption
            $bc_length = strlen(xss_cleaner($_POST["editBCNHash$ix"])); 
            $bc_character = xss_cleaner($_POST["editBCNNo$ix"]); 
            $bc_start = $bc_length - $bc_character;
            $bc_code = substr(xss_cleaner($_POST["editBCNHash$ix"]) , $bc_start ,$bc_character);
            $contact_id = (($bc_code)-8)/8;
            //end of contact_id decryption
            $contact_where['contact_id'] = $contact_id;
            $contact_list['contact_no'] = xss_cleaner($_POST["editBCN$ix"]);
            $this->Deals_Contact_Model->updateDealsContact($tableA, $contact_where, $contact_list);
        }
        for($jx=$bc_count_old+1;$jx<=$bc_count;$jx++) {
            $contact_list['contact_no'] = xss_cleaner($_POST["editBCN$jx"]);
            $contact_list['location_hash'] = $location_hash;       
            $this->Deals_Contact_Model->saveDealsContact($tableA, $contact_list);
        }
        
        $this->Deals_Location_Model->update_location($table8, $branch_where, $branch_list);
        //audit_trail start
        $insert = audit_trail("Update", "Companies Maintenance", "Edit Branch", $company_name . " [ <span class=\"blue\">" . $branch_list['location_name'] . "</span> ] ", $this->session->userdata('user_id'));
        $this->Audit_Trail_Model->save_audit("audit_trail", $insert);
        //audit_trail end
        redirect(base_url() . "admin/admin_branches/editBranches/" . $this->uri->segment(4) . "/" . $this->uri->segment(5) . "/branches");
    }
    function deleteContact() { 
        $tableA = "deal_contact";
        $table = "companies";
        $table8 = "deal_location";
        //start of contact_id decryption
        $bc_length = strlen($this->uri->segment(6)); 
        $bc_character = $this->uri->segment(7); 
        $bc_start = $bc_length - $bc_character;
        $bc_code = substr($this->uri->segment(6) , $bc_start ,$bc_character);
        $contact_id = (($bc_code)-8)/8; 
        //end of contact_id decryption
        $company_where["company_hash"] = $this->uri->segment(4);
        $branch_where["location_hash"] = $this->uri->segment(5);
        $contact_where["contact_id"] = $contact_id;
        
        $sql1 = $this->Companies_Model->displaySelected($table, $company_where);
        $sql2 = $this->Deals_Location_Model->displaySelected($table8, $branch_where);
        
        foreach($sql1 as $row1) { $company_name = $row1->company_name; }
        foreach($sql2 as $row2) { $location_name = $row2->location_name; }
        
        //audit_trail start
        $insert = audit_trail("Delete Contact No.", "Companies Maintenance", "Edit Branch", $company_name . " [ <span class=\"blue\">" . $location_name . "</span> ] ", $this->session->userdata('user_id'));
        $this->Audit_Trail_Model->save_audit("audit_trail", $insert);
        //audit_trail end
        $this->Deals_Contact_Model->deleteDealsContact($tableA, $contact_where);
        redirect(base_url() . "admin/admin_branches/editBranches/" . $this->uri->segment(4) . "/" . $this->uri->segment(5) . "/branches");
    }
}
  
?>
