<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Systems_controller extends MX_Controller {
    public function __construct() {
        parent::__construct();
        $this->checkuser(); 
        session_start(); 
         
    }
    //authenticator
    public function checkuser() {     
        if ( $this->session->userdata('login_state') <> TRUE ) {
             redirect(base_url().'user/login');
        }
    }
    //display
    function index() {
        $data["page"] = "Work In Progress";
        $this->load->view("layouts/admin_layout_header");
        $this->load->view("systems/work_in_progress", $data);
        $this->load->view("layouts/admin_layout_footer");
    }
    //process
}

?>