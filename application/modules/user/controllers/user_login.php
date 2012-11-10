<?php
    class User_Login extends MX_Controller
    {
        function __construct()
        {
            parent::__construct();
            session_start();
            $this->load->helper("green");
        }
        public function index()
        {
            $this->load->view("user_login/index","");
        }
        public function checklogin()
        {
            if(!isset($_POST['cmdlogin'])):
                $this->index();;
            endif;

            $username = $_POST['txtusername'];
            $password = md5($_POST['txtpassword']);

            $this->load->library('form_validation');

            $this->form_validation->set_rules('txtusername', 'Username', 'required');
            $this->form_validation->set_rules('txtpassword', 'Password', 'required');
            if($this->form_validation->run() == FALSE):
                $this->index();
            else:
                $this->load->model("user_model");
                $row = $this->user_model->select_data_user($username,$password);
                $numrow = $row->num_rows();
                if($numrow == 0):
                    $data['error'] = "Username or Password doesn't exist";
                    $this->load->view("user_login/index",$data); 
                else:
                    $row = $row->row();
                    $this->session->set_userdata(array('login_state' => TRUE, 'user_id' => $row->user_id, 'user_name' => $row->user_name, 'user_lastname' => $row->user_lastname , 'user_firstname' => $row->user_firstname, 'user_level' => $row->user_level));
                    //if($this->session->userdata("user_id")=="27" || $this->session->userdata("user_id")=="25" || $this->session->userdata("user_id")=="39" || $this->session->userdata("user_id")=="31" ) {
                    //audit_trail start
                    $this->load->helper("green"); 
                    $this->load->model('Audit_Trail_Model');
                    $insert = audit_trail("Log In", "Admin", "none", "none", $this->session->userdata('user_id'));
                    $this->Audit_Trail_Model->save_audit("audit_trail", $insert);
                    //audit_trail end
                    redirect(base_url().'admin');
                    /*}
                    else {
                        echo "<br><br><br><br><br><br><br><center><img src=\"".base_url()."/assets/admin/images/system/WIP_meme.png\" border=\"0\" width=\"311\" height=\"323\" alt=\"WIP_meme.png (6,775 bytes)\"><br><br><br><br><h1>WORK IN PROGRESS!</h1></center>";
                    } */
                endif;
            endif;
        }
        public function dologout()
        {
            //audit_trail start
            $this->load->helper("green"); 
            $this->load->model('Audit_Trail_Model');
            $insert = audit_trail("Log Out", "Admin", "none", "none", $this->session->userdata('user_id'));
            $this->Audit_Trail_Model->save_audit("audit_trail", $insert);
            //audit_trail end
            $this->session->unset_userdata(array('login_state' => '','user_id' => '','user_name' => '','user_lastname' => '','user_firstname' => '','user_level' => ''));
            redirect(base_url()."user/login");
        }
    }
?>
