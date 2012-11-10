<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_Companies extends MX_Controller{
    public function __construct() {
        parent::__construct();
        $this->checkuser(); 
        session_start();
        $this->load->model('Web_Model'); 
        $this->load->model('Deals_Category_Model');
        $this->load->model('Deals_View_Model');  
        $this->load->model('Deals_Model');
        $this->load->model('Deals_Location_Model');  
        $this->load->model('Companies_Model');
        $this->load->model('Companies_Contact_Model');
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
    
    function index() {
        $table = "companies"; 
        $table1 = "deal_view"; 
        $table2 = "users"; 
        $user_where["user_level"] = 2;
        $field = "company_name";
        if($this->uri->segment(4) == "maintenance") {
            $data["page"] = "Current Companies";
        }
        elseif($this->uri->segment(4) == "trashed")
        {
            $data["page"] = "Trashed Companies";
        }
        else 
        {
            $data["page"] = "Company Reports";
        }
        
        if($this->session->userdata('user_level') == 2) {
            $company_where["user_id"] = $this->session->userdata('user_id');
            if($this->uri->segment(5) == "search") {
                $like = $_POST["search_here"];
                $data["sql"] = $this->Companies_Model->displaySelectedLike($table, $field, $like);
            }
            else {
                $data["sql"] = $this->Companies_Model->displayCompanies($table);
            }
        }
        else {
            if($this->uri->segment(5) == "search") {
                $like = $_POST["search_here"];
                $data["sql"] = $this->Companies_Model->displayCompaniesLike($table, $field, $like);
            }
            else {
                if($this->uri->segment(4) == "trashed")
                {
                    $data["sql"] = $this->Companies_Model->displayCompanies_by_deleted($table, 1);
                }else{
                    $data["sql"] = $this->Companies_Model->displayCompanies_by_deleted($table, 0);
                }
                
            }
        }
        //$data["sql1"] = $this->Companies_Model->displayCompanies_by_deleted($table, 0);
        $data["sql1"] = ($this->uri->segment(4) === "trashed")?$this->Companies_Model->displayCompanies_by_deleted($table, 1):$this->Companies_Model->displayCompanies_by_deleted($table, 0);
        $data["sql2"] = $this->User_Model->displayUserConfirmedMerchant($table2, $user_where);
        $this->load->view("layouts/admin_layout_header");
        $this->load->view("companies/index_view", $data); 
        $this->load->view("layouts/admin_layout_footer");    
    }
    function profileCompany() {
        $tableWeb = "web_setting";
        $table = "deal_category";
        $table0 = "users"; 
        $table1 = "deal_view";
        $table2 = "deals";
        $table8 = "deal_location";
        $table9 = "companies";
        $company_hash = $this->uri->segment(4); 
        $company_where["company_hash"] = $company_hash;
        $sqlWeb = $this->Web_Model->displayAll($tableWeb, $this->db->order_by("setting_count", "asc"));
        foreach($sqlWeb->result() as $rowWeb) { $webWhere = $rowWeb->accounting_income; }
        $sql1 = $this->Deals_View_Model->displaySelected($table1, $company_where);
        foreach($sql1 as $row1) { $deal_hash["deal_hash"] = $row1->deal_hash; }
        $sql9 = $this->Companies_Model->displaySelected($table9, $company_where);
        foreach($sql9 as $row9) { $where['company_hash'] = $row9->company_hash; }
        $sql10 = $this->Deals_Location_Model->displayCompanyMerchants($table8, $company_where["company_hash"]);
        if($sql10->num_rows()==0) {
            $user_where['user_id'] = 0;
        }
        else {
            foreach($sql10->result() as $row10) { $user_where['user_id'] = $row10->user_id; }
        }
        $deal_where = time();    
        $data["page"] = "Companies"; 
        $data["webcall"] = $webWhere;
        $data["sql0"] = $this->Companies_Model->displaySelected($table9, $company_where);
        $data["sql1"] = $this->Deals_Category_Model->displayCategory($table); 
        //date filtering area start
        if($this->uri->segment(5) == "current") {
            $data["sql2"] = $this->Deals_Model->displayGroupedCompanyIDCurrent($table1, $table2, $deal_where, $where['company_hash']);
        }
        elseif($this->uri->segment(5) == "future") {
            $data["sql2"] = $this->Deals_Model->displayGroupedCompanyIDFuture($table1, $table2, $deal_where, $where['company_hash']);
        }
        elseif($this->uri->segment(5) == "past") {
            $data["sql2"] = $this->Deals_Model->displayGroupedCompanyIDPast($table1, $table2, $deal_where, $where['company_hash']);
        }
        //date filtering area end      
        //$data["sql2"] = $this->Deals_Model->displayGroupedCompanyID($table1, $table2, $where['company_id']);
        $data["sql4"] = $this->User_Model->displaySelected($table0, $user_where); 
        $data["sql9"] = $this->Companies_Model->displaySelected($table9, $company_where);
        $data["sql10"] = $this->Deals_Location_Model->displayCompanyMerchants($table8, $company_where["company_hash"]);
        $this->load->view("layouts/admin_layout_header");
        $this->load->view("companies/company_profile_view", $data);
        $this->load->view("layouts/admin_layout_footer");
    }
    function editCompany() {
        $tableA = "company_contact";
        $table = "companies";
        $table2 = "users";
        $table8 = "deal_location";
        $user_where["user_level"] = 2;
        $company_hash = $this->uri->segment(4); 
        $company_where["company_hash"] = $company_hash; 
        $data["page"] = "Companies";
        $sql = $this->Companies_Contact_Model->displaySelected($table, $company_where);
        foreach($sql as $row) { $contact_where["company_hash"] = $row->company_hash; }
        $data["sql"] = $this->Companies_Model->displaySelected($table, $company_where);
        $data["sql2"] = $this->User_Model->displayUserConfirmedMerchant($table2, $user_where);
        $data["sql3"] = $this->Companies_Contact_Model->displaySelected($tableA, $contact_where);
        //$data["sql10"] = $this->Deals_Location_Model->displayCompanyMerchants($table2, $table8, $company_where["company_hash"]);
        $this->load->view("layouts/admin_layout_header");
        $this->load->view("companies/company_edit_view", $data);
        $this->load->view("layouts/admin_layout_footer"); 
    }
    
    function reportCompany() {
        $tableWeb = "web_setting";
        $table = "deal_category";
        $table1 = "deal_view";
        $table2 = "deals";
        $table9 = "companies";
        //segment_6 = future, past of false
        $segment_6 = $this->uri->segment(5, 0);
        if($segment_6 != false) {
            if($segment_6 == 'future') {
                //segment future  
                if($segment_6 == 'past') {
                    //segment past
                }
            }
        }    
        $company_hash = $this->uri->segment(4); 
        $company_where["company_hash"] = $company_hash;
        $sqlWeb = $this->Web_Model->displayAll($tableWeb);
        foreach($sqlWeb->result() as $rowWeb) { $webWhere = $rowWeb->accounting_income; }
        $sql1 = $this->Deals_View_Model->displaySelected($table1, $company_where);
        foreach($sql1 as $row1) { $deal_hash["deal_hash"] = $row1->deal_hash; }
        $sql9 = $this->Companies_Model->displaySelected($table9, $company_where);
        foreach($sql9 as $row9) { $where['company_hash'] = $row9->company_hash; } 
        $deal_where = time();
        $data["page"] = "Company Reports";
        $data["webcall"] = $webWhere;
        $data["sql1"] = $this->Deals_Category_Model->displayCategory($table); 
        $data["sql2"] = $this->Deals_Model->displayGroupedCompanyID($table1, $table2, $where['company_hash']);
        $data["sql9"] = $this->Companies_Model->displaySelected($table9, $company_where);
        $this->load->view("layouts/admin_layout_header");
        $this->load->view("companies/company_report_view", $data);
        $this->load->view("layouts/admin_layout_footer"); 
    }
    //process
    function saveCompany() {
        if($this->Companies_Model->company_similarity(xss_cleaner($_POST['addCN'])) == TRUE) {
            redirect(base_url() . 'admin/admin_companies/index/maintenance?error=1');
        }
        $tableA = "company_contact";
        $table = "companies";
        $table8 = "deal_location";
        $customsize = array('height'=>'150','width'=>'150');
        $path = "assets/general/images/companies/";
        $company_list['company_name'] = xss_cleaner(ucfirst($_POST["addCN"]));
        $company_list['company_address'] = xss_cleaner($_POST["addCA"]);
        $company_list['company_email'] = xss_cleaner($_POST["addCE"]);
        $company_list['company_website'] = xss_cleaner($_POST["addCW"]);
        $company_list['company_pr'] = xss_cleaner($_POST["addCPR"]); 
        $company_list['company_hash'] = md5(xss_cleaner($_POST["addCN"]) . time()); 
        if($_FILES["addCL"]["name"] != '') {
            $image_size_filter = image_size_filter($_FILES["addCL"]["tmp_name"], 550, "null", 350, "null");
            $image_type_filter = image_type_filter($_FILES["addCL"]["name"]);
            
            if($image_type_filter == "unidentified") {
                    redirect(base_url() . 'admin/admin_companies/index/maintenance?error2=1');
            }
            else {
                if($image_size_filter == "large" || $image_size_filter == "small") {
                    redirect(base_url() . 'admin/admin_companies/index/maintenance?error1=1');
                }
                //upload new icon                                             
                $company_logo = _upload_photo("addCL",$path,'default.jpg','true','true','','150',$customsize);
                $company_list['company_logo'] = $company_logo;
            }
        }
        $cc_count = $this->db->escape_str($_POST["nCCONTACT"]);
        for($ix=1;$ix<=$cc_count;$ix++) {
            $contact_list['contact_no'] = xss_cleaner($_POST["addCCN" . $ix]);
            $contact_list['company_hash'] = $company_list['company_hash'];
            $this->Companies_Contact_Model->saveCompanyContact($tableA, $contact_list);
        }
        
        $this->Companies_Model->saveCompany($table, $company_list);
        $sql = $this->Companies_Model->displayCompaniesMax($table); 
        foreach($sql as $row) { echo $company_id = $row->company_id; }
        //audit_trail start
        $insert = audit_trail("Save", "Companies Maintenance", "Add New Company", $company_list['company_name'], $this->session->userdata('user_id'));
        $this->Audit_Trail_Model->save_audit("audit_trail", $insert);                                                            
        //audit_trail end 
        redirect(base_url() . "admin/admin_companies/profileCompany/" . $company_list['company_hash'] . "/branches");   
    }
    function updateC() {
        $tableA = "company_contact";
        $table = "companies";
        $table8 = "deal_location";
        $customsize = array('height'=>'150','width'=>'150');
        $path = "assets/general/images/companies/";
        $company_hash = $this->uri->segment(4); 
        $company_where["company_hash"] = $company_hash;
        $company_list['company_name'] = xss_cleaner(ucfirst($_POST["editCN"]));          
        $company_list['company_fax'] = xss_cleaner($_POST["editCFN"]);
        $company_list['company_address'] = xss_cleaner($_POST["editCA"]);
        $company_list['company_email'] = xss_cleaner($_POST["editCE"]);
        $company_list['company_website'] = xss_cleaner($_POST["editCW"]);
        $company_list['company_pr'] = xss_cleaner($_POST["editCPR"]);
        $sql = $this->Companies_Model->displaySelected($table, $company_where);
        foreach($sql as $row) { $filename = $row->company_logo; }
        if($_FILES["editCL"]["name"] != '') {
            $image_size_filter = image_size_filter($_FILES["editCL"]["tmp_name"], 550, "null", 350, "null");
            $image_type_filter = image_type_filter($_FILES["editCL"]["name"]);
            
            if($image_type_filter == "unidentified") {
                    redirect(base_url() . 'admin/admin_companies/editCompany/' . $this->uri->segment(4) . '/' . $this->uri->segment(5) . '?error2=1');
            }
            else {
                if($image_size_filter == "large" || $image_size_filter == "small") {
                    redirect(base_url() . 'admin/admin_companies/editCompany/' . $this->uri->segment(4) . '/' . $this->uri->segment(5) . '?error1=1');
                }
                //delete old icon
                unlink($path . "customize/$filename");
                unlink($path . "optimize/$filename");
                unlink($path . "thumbnail/$filename");
                unlink($path . "$filename");
                //upload new icon                                             
                $company_logo = _upload_photo("editCL",$path,'default.jpg','true','true','','150',$customsize);
                $company_list['company_logo'] = $company_logo;
            }
        }
        $cc_count_old = xss_cleaner($_POST["mCCONTACT"]);
        $cc_count = xss_cleaner($_POST["nCCONTACT"]);
        for($ix=1;$ix<=$cc_count_old;$ix++) {
            //start of contact_id decryption
            $cc_length = strlen(xss_cleaner($_POST["editCCNHash$ix"])); 
            $cc_character = xss_cleaner($_POST["editCCNNo$ix"]); 
            $cc_start = $cc_length - $cc_character;
            $cc_code = substr(xss_cleaner($_POST["editCCNHash$ix"]) , $cc_start ,$cc_character);
            $contact_id = (($cc_code)-8)/8;
            //end of contact_id decryption
            $contact_where['contact_id'] = $contact_id;
            $contact_list['contact_no'] = xss_cleaner($_POST["editCCN$ix"]);
            $this->Companies_Contact_Model->updateCompanyContact($tableA, $contact_where, $contact_list);
        }
        for($jx=$cc_count_old+1;$jx<=$cc_count;$jx++) {
            $contact_list['contact_no'] = xss_cleaner($_POST["editCCN$jx"]);
            $contact_list['company_hash'] = $company_hash;       
            $this->Companies_Contact_Model->saveCompanyContact($tableA, $contact_list);
        }
        $this->Companies_Model->updateCompany($table, $company_where, $company_list);
        //audit_trail start
        $insert = audit_trail("Update", "Companies Maintenance", "Edit Company", $company_list['company_name'], $this->session->userdata('user_id'));
        $this->Audit_Trail_Model->save_audit("audit_trail", $insert);
        //audit_trail end
        redirect(base_url() . "admin/admin_companies/editCompany/" . $this->uri->segment(4) . '/' . $this->uri->segment(5));
    }                          
    function updateCompany() {
        if($_POST['editCN_old']!=$_POST['editCN']) {  
            if($this->Companies_Model->company_similarity(xss_cleaner($_POST['editCN'])) == TRUE) {
                redirect(base_url() . 'admin/admin_companies/editCompany/' . $this->uri->segment(4) . '/' . $this->uri->segment(5) . '?error=1');
            }
            else {
                $this->updateC();
            }
        }                   
        else {
            $this->updateC();
        } 
    }        
    function deleteCompany() {//function is disalbed
        $table = "companies";
        $path = "assets/general/images/companies/";
        //start of user_id decryption
        $c_length = strlen($this->uri->segment(5)); 
        $c_character = $this->uri->segment(4);
        $c_start = $c_length - $c_character;
        $c_code = substr($this->uri->segment(5) , $c_start ,$c_character);
        $company_id = (($c_code)-8)/8;
        $company_where["company_id"] = $company_id;
        //end of user_id decryption
        $sql = $this->Companies_Model->displaySelected($table, $company_where);
        foreach($sql as $row) { $filename = $row->company_logo; $company_name = $row->company_name; }
        //delete old icon
        unlink($path . "customize/$filename");
        unlink($path . "optimize/$filename");
        unlink($path . "thumbnail/$filename");
        unlink($path . "$filename");
        $this->Companies_Model->deleteCompany($table, $company_where);
        //audit_trail start
        $insert = audit_trail("Delete", "Companies Maintenance", "Delete Company", $company_name, $this->session->userdata('user_id'));
        $this->Audit_Trail_Model->save_audit("audit_trail", $insert);
        //audit_trail end
        redirect(base_url() . "admin/admin_companies/index/maintenance");
    }
    
    /*
    //--added functions--//
    
    function trash_company($multi = false, $lenght='', $character='')
    {
        $table = "companies";
        $path = "assets/general/images/companies/";
        //start of user_id decryption
        $c_length = ($multi == true)?strlen($lenght):strlen($this->uri->segment(5)); 
        $c_character = ($multi == true)?$character:$this->uri->segment(4);
        $c_start = $c_length - $c_character;
        $c_code = substr((($multi == true)?$lenght:$this->uri->segment(5)) , $c_start ,$c_character);
        $company_id = (($c_code)-8)/8;
        $company_where["company_id"] = $company_id;
        $this->Companies_Model->trashed_restore_company($table, $company_id);
        //end of user_id decryption
        //audit_trail start
        //audit_trail end
        //var_dump($multi);
        $redirect = ($multi === true)?'':redirect(base_url() . "admin/admin_companies/index/maintenance");
        //if($multi === false){redirect(base_url() . 'admin/admin_companies/index/maintenance');}
        
        $multi = false;
        /*
         if($multi == false){
            echo "false <br>";
         }else{
            echo "true <br>";
         }
         
         $multi = false;
    }
    =*/
    
    function trash_company($multi = false, $id='')
    {
        $table = 'companies';
        $path = 'assets/general/images/companies/';

        $company_id = !$multi?$this->uri->segment(4):$id;//(($c_code)-8)/8;
        
        $this->Companies_Model->trashed_restore_company($table, $company_id);

        $redirect = ($multi === true)?'':redirect(base_url() . 'admin/admin_companies/index/maintenance');

        $multi = false;
    }
    
    function multi_trash_company()
    {
        $company_ids = $this->input->post('checkbox');
        
        //if post is false or nothing is posted, redirect or echo nothing is selected
        $redirect = (!$company_ids)?redirect(base_url() . 'admin/admin_companies/index/maintenance'):'';
        
        //loop thru $company_ids
        foreach($company_ids as $id)
        {
            $this->trash_company(true, $id);
        }
        redirect(base_url() . 'admin/admin_companies/index/maintenance');
    }
    
    /*
    function restore_company($multi = false, $lenght, $character)
    {
        $table = "companies";
        $path = "assets/general/images/companies/";
        //start of user_id decryption
        $c_length = ($multi === true)?strlen($lenght):strlen($this->uri->segment(5)); 
        $c_character = ($multi === true)?$character:$this->uri->segment(4);
        $c_start = $c_length - $c_character;
        $c_code = substr((($multi === true)?$lenght:$this->uri->segment(5)) , $c_start ,$c_character);
        $company_id = (($c_code)-8)/8;
        $company_where["company_id"] = $company_id;
        $this->Companies_Model->trashed_restore_company($table, $company_id, 0);
        //end of user_id decryption
        //audit_trail start
        //audit_trail end
        //var_dump($multi);
        $redirect = ($multi === true)?'':redirect(base_url() . "admin/admin_companies/index/trashed");
        //if($multi === false){redirect(base_url() . 'admin/admin_companies/index/maintenance');}
        
        $multi = false;
    }
    */
    
    function restore_company($multi=false, $id='')
    {
        $table = 'companies';
        $path = 'assets/general/images/companies/';
        
        $company_id = !$multi?$this->uri->segment(4):$id;

        $this->Companies_Model->trashed_restore_company($table, $company_id, 0);

        $redirect = ($multi === true)?'':redirect(base_url() . 'admin/admin_companies/index/trashed');
        
        $multi = false;
    }
    
    function multi_restore_company()
    {
        $company_ids = $this->input->post('checkbox');
        
        //if post is false, redirect or echo nothing is selected
        $redirect = (!$company_ids)?redirect(base_url() . 'admin/admin_companies/index/maintenance'):'';
        
        //loop thru $company_ids
        foreach($company_ids as $id)
        {
            $this->restore_company($multi = true, $id);
        }
        redirect(base_url() . 'admin/admin_companies/index/trashed');
    }
    
    function deleteContact() { 
        $tableA = "company_contact";
        $table = "companies";
        //start of contact_id decryption
        $bc_length = strlen($this->uri->segment(5)); 
        $bc_character = $this->uri->segment(6); 
        $bc_start = $bc_length - $bc_character;
        $bc_code = substr($this->uri->segment(5) , $bc_start ,$bc_character);
        $contact_id = (($bc_code)-8)/8; 
        //end of contact_id decryption
        $company_where["company_hash"] = $this->uri->segment(4);
        $contact_where["contact_id"] = $contact_id;
        
        $sql1 = $this->Companies_Model->displaySelected($table, $company_where);
        
        foreach($sql1 as $row1) { $company_name = $row1->company_name; }
        
        //audit_trail start
        $insert = audit_trail("Delete Contact No.", "Companies Maintenance", "Edit Company", $company_name, $this->session->userdata('user_id'));
        $this->Audit_Trail_Model->save_audit("audit_trail", $insert);
        //audit_trail end
        $this->Companies_Contact_Model->deleteCompanyContact($tableA, $contact_where);
        redirect(base_url() . "admin/admin_companies/editCompany/" . $this->uri->segment(4));
    }
    
    //--index back up--//
        /*
    function index() {
        $table = "companies"; 
        $table1 = "deal_view"; 
        $table2 = "users"; 
        $user_where["user_level"] = 2;
        $field = "company_name";
        if($this->uri->segment(4) == "maintenance") {
            $data["page"] = "Companies";
        }
        else {
            $data["page"] = "Company Reports";
        }
        if($this->session->userdata('user_level') == 2) {
            $company_where["user_id"] = $this->session->userdata('user_id');
            if($this->uri->segment(5) == "search") {
                $like = $_POST["search_here"];
                $data["sql"] = $this->Companies_Model->displaySelectedLike($table, $company_where["user_id"], $field, $like);
            }
            else {
                $data["sql"] = $this->Companies_Model->displaySelected($table, $company_where);
            }
        }
        else {
            if($this->uri->segment(5) == "search") {
                $like = $_POST["search_here"];
                $data["sql"] = $this->Companies_Model->displayCompaniesLike($table, $field, $like);
            }
            else {
                $data["sql"] = $this->Companies_Model->displayCompanies($table);
            }
        }
        $data["sql1"] = $this->Companies_Model->displayCompanies($table);
        $data["sql2"] = $this->User_Model->displayUserConfirmedMerchant($table2, $user_where);
        $this->load->view("layouts/admin_layout_header");
        $this->load->view("companies/index_view", $data); 
        $this->load->view("layouts/admin_layout_footer");    
    }
        */
    //--end index backup--//  
    
}
?>
