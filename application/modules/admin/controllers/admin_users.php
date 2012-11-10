<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_Users extends MX_Controller {   
    public function __construct() {
        parent::__construct(); 
        $this->checkuser(); 
        session_start();
        $this->load->model('User_Model');
        $this->load->model('User_Level_Model');
        $this->load->model('Audit_Trail_Model'); 
        $this->load->helper("green");
    }
    //authenticator
    public function checkuser() {      
        if ( $this->session->userdata('login_state') <> TRUE ) {
             redirect(base_url().'user/login');
        }
    }
    //display
    function index() {
        $tablex = "user_level";    
        $table1 = "users";    
        $data["page"] = "User Maintenance";                 
        $data["sqlx"] = $this->User_Level_Model->displayLevel($tablex);
        $data["sql1"] = $this->User_Model->displayUserConfirmed_Unbanned($table1);
        $this->load->view("layouts/admin_layout_header");
        $this->load->view("users/index_view", $data);
        $this->load->view("layouts/admin_layout_footer");     
    }
    function unconfirmedUser() {
        $table1 = "users";    
        $data["page"] = "User Maintenance";
        $data["sql1"] = $this->User_Model->displayUserUnconfirmed($table1);
        $this->load->view("layouts/admin_layout_header");
        $this->load->view("users/unconfirmed_view", $data);
        $this->load->view("layouts/admin_layout_footer");
    }
    function bannedUser() {
        $table1 = "users";    
        $data["page"] = "User Maintenance";
        $data["sql1"] = $this->User_Model->displayUserBanned($table1);
        $this->load->view("layouts/admin_layout_header");
        $this->load->view("users/banned_view", $data);
        $this->load->view("layouts/admin_layout_footer");
    }
    function accountUser() {
        $tablex = "user_level";
        $table1 = "users";
        //start of user_id decryption
        $u_length = strlen($this->uri->segment(5)); 
        $u_character = $this->uri->segment(4); 
        $u_start = $u_length - $u_character;
        $u_code = substr($this->uri->segment(5) , $u_start ,$u_character);
        $user_id = (($u_code)-8)/8;
        $user_where["user_id"] = $user_id;
        $sql1 = $this->User_Model->displaySelected($table1, $user_where);
        foreach($sql1 as $row1) {
            $level_where["level_id"] = $row1->user_level;
        }
        //end of user_id decryption
        $data["page"] = "Your Profile"; 
        $data["sqlx"] = $this->User_Level_Model->displayLevel($tablex);             
        $data["sql1"] = $this->User_Model->displayUserAccount($table1, $user_where);
        $data["sqlxb"] = $this->User_Level_Model->displaySelected($tablex, $level_where);
        $this->load->view("layouts/admin_layout_header");
        $this->load->view("users/account_view", $data);
        $this->load->view("layouts/admin_layout_footer");
    }
    function editUser() {
        $tablex = "user_level";
        $table1 = "users";   
        //start of user_id decryption
        $u_length = strlen($this->uri->segment(5)); 
        $u_character = $this->uri->segment(4); 
        $u_start = $u_length - $u_character;
        $u_code = substr($this->uri->segment(5) , $u_start ,$u_character);
        $user_id = (($u_code)-8)/8;
        $user_where["user_id"] = $user_id;
        $sql1 = $this->User_Model->displaySelected($table1, $user_where);
        foreach($sql1 as $row1) {
            $level_where["level_id"] = $row1->user_level;
        }
        //end of user_id decryption
        $data["page"] = "User Profile";
        $data["sqlx"] = $this->User_Level_Model->displayLevel($tablex);
        $data["sqlxa"] = $this->User_Level_Model->displayUnselected($tablex, $level_where["level_id"] );
        $data["sqlxb"] = $this->User_Level_Model->displaySelected($tablex, $level_where);             
        $data["sql1"] = $this->User_Model->displayUserAccount($table1, $user_where);             
        $this->load->view("layouts/admin_layout_header");
        $this->load->view("users/edit_user_view", $data);
        $this->load->view("layouts/admin_layout_footer");
    }
    //process
    function confirmUser() {
        $table1 = "users";
        //start of user_id decryption
        $u_length = strlen($this->uri->segment(5)); 
        $u_character = $this->uri->segment(4); 
        $u_start = $u_length - $u_character;
        $u_code = substr($this->uri->segment(5) , $u_start ,$u_character);
        $user_id = (($u_code)-8)/8;
        $user_where["user_id"] = $user_id;
        //end of user_id decryption
        $user_list['user_confirmed'] = 1;
        $this->User_Model->updateUser($table1, $user_where, $user_list);
        $sql =  $this->User_Model->displaySelected($table1, $user_where); 
        foreach($sql as $row) { $user_firstname = $row->user_firstname; $user_middlename = $row->user_middlename; $user_lastname = $row->user_lastname; }
        //audit_trail start
        $insert = audit_trail("Confirm User", "Users Unconfirmed", "none", $user_lastname . ", " . $user_firstname . " " . $user_middlename, $this->session->userdata('user_id'));
        $this->Audit_Trail_Model->save_audit("audit_trail", $insert);
        //audit_trail end
        redirect("admin/admin_users/unconfirmedUser");
    }
    function unbanUser() {
        $table1 = "users";
        //start of user_id decryption
        $u_length = strlen($this->uri->segment(5)); 
        $u_character = $this->uri->segment(4); 
        $u_start = $u_length - $u_character;
        $u_code = substr($this->uri->segment(5) , $u_start ,$u_character);
        $user_id = (($u_code)-8)/8;
        $user_where["user_id"] = $user_id;
        //end of user_id decryption
        $user_list['user_banned'] = 0;
        $this->User_Model->updateUser($table1, $user_where, $user_list);
        $sql =  $this->User_Model->displaySelected($table1, $user_where); 
        foreach($sql as $row) { $user_firstname = $row->user_firstname; $user_middlename = $row->user_middlename; $user_lastname = $row->user_lastname; }
        //audit_trail start
        $insert = audit_trail("Unban User", "Users Banned", "none", $user_lastname . ", " . $user_firstname . " " . $user_middlename, $this->session->userdata('user_id'));
        $this->Audit_Trail_Model->save_audit("audit_trail", $insert);
        //audit_trail end
        redirect("admin/admin_users/bannedUser");
    }
    function banUser() {
        $table1 = "users";
        //start of user_id decryption
        $u_length = strlen($this->uri->segment(5)); 
        $u_character = $this->uri->segment(4); 
        $u_start = $u_length - $u_character;
        $u_code = substr($this->uri->segment(5) , $u_start ,$u_character);
        $user_id = (($u_code)-8)/8;
        $user_where["user_id"] = $user_id;
        //end of user_id decryption
        $user_list['user_banned'] = 1;
        $this->User_Model->updateUser($table1, $user_where, $user_list);
        $sql =  $this->User_Model->displaySelected($table1, $user_where); 
        foreach($sql as $row) { $user_firstname = $row->user_firstname; $user_middlename = $row->user_middlename; $user_lastname = $row->user_lastname; }
        //audit_trail start
        $insert = audit_trail("Ban User", "User Maintenance", "none", $user_lastname . ", " . $user_firstname . " " . $user_middlename, $this->session->userdata('user_id'));
        $this->Audit_Trail_Model->save_audit("audit_trail", $insert);
        //audit_trail end
        redirect("admin/admin_users");
    }
    function saveUser() {
        if(!isset($_POST['cmdlogin'])) {
            redirect('user/register');
        }
        $this->load->model("user_model");
        if($this->user_model->select_data_user3($this->db->escape_str($_POST['txtUN'])) == TRUE) {
            redirect('admin/admin_users?error=1');
        }
        $data['user_name'] = xss_cleaner($_POST['txtUN']);
        $data['user_password'] = md5($this->db->escape_str($_POST['txtPW']));
        $data['user_firstname'] = $this->db->escape_str($_POST['txtFN']);
        $data['user_lastname'] = xss_cleaner($_POST['txtLN']);
        $data['user_middlename'] = xss_cleaner($_POST['txtMN']);
        $data['user_level'] = xss_cleaner($_POST['txtUL']);
        $data['user_email'] = xss_cleaner($_POST['txtEA']);
        $data['user_no'] = xss_cleaner($_POST['txtCN']);
        
        $row = $this->user_model->select_data_user2();
        if($row == FALSE) {
            $data['user_confirmed'] = 1;
        }
        $this->user_model->insert_data_user($data);
        //audit_trail start
        $insert = audit_trail("Register User", "User Maintenance", "Add New User", ucfirst($data['user_lastname'] . ", " . $data['user_firstname'] . " " . $data['user_middlename']), $this->session->userdata('user_id'));
        $this->Audit_Trail_Model->save_audit("audit_trail", $insert);
        //audit_trail end
        redirect("admin/admin_users");
    }
    function updateUser() {
        $table1 = "users";
        //start of user_id decryption
        $u_length = strlen($this->db->escape_str($_POST['txtChash'])); 
        $u_character = $this->db->escape_str($_POST['txtCcount']); 
        $u_start = $u_length - $u_character;
        $u_code = substr( $this->db->escape_str($_POST['txtChash']) , $u_start ,$u_character);
        $user_id = (($u_code)-8)/8;
        $user_where["user_id"] = $user_id;
        //end of user_id decryption
        echo $user_list['user_firstname'] = xss_cleaner($_POST['txtFN']);
        $user_list['user_lastname'] = xss_cleaner($_POST['txtLN']);
        $user_list['user_middlename'] = xss_cleaner($_POST['txtMN']);
        $user_list['user_name'] = xss_cleaner($_POST['txtUN']);
        if($this->session->userdata("user_level") == 0) {
            $user_list['user_level'] = xss_cleaner($_POST['txtUL']);
        }
        if($_POST['txtPWold'] != "" && $_POST['txtPWnew'] != "") {
            $user_list['user_password'] = md5($_POST['txtPWnew']);
        }
        $user_list['user_email'] = xss_cleaner($_POST['txtEA']);
        $user_list['user_no'] = xss_cleaner($_POST['txtCN']);
        //checking area start
        $username['user_name'] = $user_list['user_name'];
        if($_POST['txtPWold'] != "" && $_POST['txtPWnew'] != "") {
            $password['user_password'] = $user_list['user_password'];
        }
        $sql1a = $this->User_Model->callSelectedUser($table1, $user_where["user_id"], $username);
        $sql1b = $this->User_Model->displaySelected($table1, $user_where);
        foreach($sql1b as $row1b) { $user_name = $row1b->user_name; $user_password = $row1b->user_password; }
        //username checking similarities
        if($sql1a == true) {
            redirect("admin/admin_users/editUser/" . $this->uri->segment(4) . "/" . $this->uri->segment(5) . "/" . $this->db->escape_str($_POST['txtCcount']) . "/" . $this->db->escape_str($_POST['txtChash']) . "?error1=1");
        }
        // password checking differences
        if($this->db->escape_str($_POST['txtPWold']) == "" && $this->db->escape_str($_POST['txtPWnew']) == "") {
            $this->User_Model->updateUser($table1, $user_where, $user_list);
            //audit_trail start
            $insert = audit_trail("Update User", "User Maintenance", "Edit User", ucfirst($user_list['user_lastname'] . ", " . $user_list['user_firstname'] . " " . $user_list['user_lastname']), $this->session->userdata('user_id'));
            $this->Audit_Trail_Model->save_audit("audit_trail", $insert);
            //audit_trail end 
            redirect("admin/admin_users/" . $_POST["txtForm"] . "/" . $this->uri->segment(4) . "/" . $this->uri->segment(5));
        }
        else {
            if(md5($this->db->escape_str($_POST['txtPWold'])) != $user_password || $this->db->escape_str($_POST['txtPWnew']) != $this->db->escape_str($_POST['txtCPW'])) {
                redirect('admin/admin_users/editUser/' . $this->db->escape_str($_POST['txtCcount']) . '/' . $this->db->escape_str($_POST['txtChash']) . '?error2=1');
            }
            else {
                $this->User_Model->updateUser($table1, $user_where, $user_list);
                //audit_trail start
                $insert = audit_trail("Update User", "User Maintenance", "Edit User", ucfirst($user_list['user_lastname'] . ", " . $user_list['user_firstname'] . " " . $user_list['user_lastname']), $this->session->userdata('user_id'));
                $this->Audit_Trail_Model->save_audit("audit_trail", $insert);
                //audit_trail end 
                redirect("admin/admin_users/" . $_POST["txtForm"] . "/" . $this->uri->segment(4) . "/" . $this->uri->segment(5));
            }
        }
        //checking area end
    }
    
    function deleteUser() {
        $table1 = "users";
        //start of user_id decryption
        $u_length = strlen($this->uri->segment(5)); 
        $u_character = $this->uri->segment(4); 
        $u_start = $u_length - $u_character;
        $u_code = substr($this->uri->segment(5) , $u_start ,$u_character);
        $user_id = (($u_code)-8)/8;
        $user_where["user_id"] = $user_id;
        //end of user_id decryption
        $sql =  $this->User_Model->displaySelected($table1, $user_where); 
        foreach($sql as $row) { $user_firstname = $row->user_firstname; $user_middlename = $row->user_middlename; $user_lastname = $row->user_lastname; }
        //audit_trail start
        $insert = audit_trail("Delete User", "User Maintenance", "none", $user_lastname . ", " . $user_firstname . " " . $user_middlename, $this->session->userdata('user_id'));
        $this->Audit_Trail_Model->save_audit("audit_trail", $insert);
        //audit_trail end
        $this->User_Model->deleteUser($table1, $user_where);
        if($this->uri->segment(3) == "confirmUser") {
            redirect("admin/admin_users/unconfirmedUser");
        }
        else {
            redirect("admin/admin_users");
        }
    }
    
          /////////////////////////////////
         ////--Added functions--//////////
        /////////////////////////////////
        
    function trashedUser() {
        $table1 = "users";    
        $data["page"] = "User Maintenance";
        $data["sql1"] = $this->User_Model->displayUserTrashed($table1);
        $this->load->view("layouts/admin_layout_header");
        $this->load->view("users/trashed_view", $data);
        $this->load->view("layouts/admin_layout_footer");
    }
    
    function trashUser()
    {
        $table1 = "users";
        //start of user_id decryption
        $u_length = strlen($this->uri->segment(5)); 
        $u_character = $this->uri->segment(4); 
        $u_start = $u_length - $u_character;
        $u_code = substr($this->uri->segment(5) , $u_start ,$u_character);
        $user_id = (($u_code)-8)/8;
        $user_where["user_id"] = $user_id;
        //end of user_id decryption
        $sql =  $this->User_Model->displaySelected($table1, $user_where); 
        foreach($sql as $row) { $user_firstname = $row->user_firstname; $user_middlename = $row->user_middlename; $user_lastname = $row->user_lastname; }
        //audit_trail start
        $insert = audit_trail("Trash User", "User Maintenance", "none", $user_lastname . ", " . $user_firstname . " " . $user_middlename, $this->session->userdata('user_id'));
        $this->Audit_Trail_Model->save_audit("audit_trail", $insert);
        //audit_trail end
        $this->User_Model->trash_restore_user($table1, $user_where);
        if($this->uri->segment(3) == "confirmUser") {
            redirect("admin/admin_users/unconfirmedUser");
        }
        else {
            redirect("admin/admin_users");
        }
    }
    
    function restoreUser($multi = false, $lenght, $character)
    {
        $table1 = "users";
        //start of user_id decryption
        $u_length = strlen(($multi)?$lenght:$this->uri->segment(5)); 
        $u_character = ($multi)?$character:$this->uri->segment(4); 
        $u_start = $u_length - $u_character;
        $u_code = substr(($multi)?$lenght:$this->uri->segment(5) , $u_start ,$u_character);
        $user_id = (($u_code)-8)/8;
        $user_where["user_id"] = $user_id;
        //end of user_id decryption
        $sql =  $this->User_Model->displaySelected($table1, $user_where); 
        foreach($sql as $row) { $user_firstname = $row->user_firstname; $user_middlename = $row->user_middlename; $user_lastname = $row->user_lastname; }
        //audit_trail start
        $insert = audit_trail("Trash User", "User Maintenance", "none", $user_lastname . ", " . $user_firstname . " " . $user_middlename, $this->session->userdata('user_id'));
        $this->Audit_Trail_Model->save_audit("audit_trail", $insert);
        //audit_trail end
        $this->User_Model->trash_restore_user($table1, $user_where, 0);
        
        if(!$multi){
            if($this->uri->segment(3) == "confirmUser") {
            redirect("admin/admin_users/unconfirmedUser");
            }
            else {
                redirect("admin/admin_users/trashedUser");
            }
        }else{
            $multi = false;
        }
        
    }
    
    function multi_restoreUser()
    {
        $checkbox = $this->input->post('checkbox');
        
        //var_dump($checkbox);
        //exit();
        $redirect = (!$checkbox)?redirect("admin/admin_users/trashedUser"):'';
        
        foreach($checkbox as $user_id)
        {
            list($character, $lenght) = explode("/", $user_id);
            $this->restoreUser(true, $lenght, $character);
        }
        
        redirect("admin/admin_users/trashedUser");
    }
    
    function multi_trashUser()
    {
        
    }
}
?>
