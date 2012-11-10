<?php
class User_Register extends MX_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model('User_Level_Model');
    }
    public function index()
    {
        if(strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox') == TRUE) {
            $tablex = "user_level";
            $data["sql"] = $this->User_Level_Model->displayLevel($tablex); 
            $this->load->view("user_register/index",/*""*/ $data);
        }
        else {
            redirect(base_url() . "user/login");
        }
    }
    public function saveregister()
    {
        if(!isset($_POST['cmdlogin']))
        {
            redirect('user/register');
        }
        
        $this->load->model("user_model");
        
        if($this->user_model->select_data_user3($_POST['txtUN']) == TRUE)
        {
            redirect('user/register?error=1');
        }
        
        $data['user_name'] = $_POST['txtUN'];
        $data['user_password'] = md5($_POST['txtPW']);
        $data['user_firstname'] = $_POST['txtFN'];
        $data['user_lastname'] = $_POST['txtLN'];
        $data['user_middlename'] = $_POST['txtMN'];
        $data['user_level'] = $_POST['txtUL'];
        $data['user_message'] = $_POST['txtMSG'];
        $data['user_email'] = $_POST['txtEA'];
        $data['user_no'] = $_POST['txtCN'];
        
        $row = $this->user_model->select_data_user2();
        
        if($row == FALSE)
        {
            $data['user_confirmed'] = 1;
        }
        
        $this->user_model->insert_data_user($data);
        
        redirect("user/login");
    }
}
?>
