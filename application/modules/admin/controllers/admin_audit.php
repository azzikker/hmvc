<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_Audit extends MX_Controller {
    public function __construct() {
        parent::__construct();
        $this->checkuser();
        session_start();
        $this->load->model('Audit_Trail_Model');
        $this->load->helper("green_helper"); 
        $this->load->helper("gt++");
        $this->load->helper("gt");  
    }
    //authenticator
    public function checkuser() {     
        if ( $this->session->userdata('login_state') <> TRUE ) {
            redirect(base_url().'"layouts/admin_layout_footer"');
        }
    }
    //display
    function index() {
        $tableA = "audit_trail";
        $table1 = "users";
        $segment = strtotime($this->uri->segment(4) . "/" . $this->uri->segment(5) . "/" . $this->uri->segment(6) . "+ 1 day");
        $data["page"] = "Audit Trail";
        if($this->uri->segment(4)!="" || $this->uri->segment(5)!="" || $this->uri->segment(6)!="") {
            $where = strtotime($this->uri->segment(4) . "/" . $this->uri->segment(5) . "/" . $this->uri->segment(6));
            $data["sqlA"] = $this->Audit_Trail_Model->displaySelectedDate($tableA, $table1, $where, $segment);
        }
        else { 
            $where = strtotime(date("m/d/Y", time()));  
            $data["sqlA"] = $this->Audit_Trail_Model->displaySelectedDate($tableA, $table1, $where, $segment);
        }
        $this->load->view("layouts/admin_layout_header");
        $this->load->view("audit_trail/index_view", $data);
        $this->load->view("layouts/admin_layout_footer");
    }
    //proces    
}

?>
