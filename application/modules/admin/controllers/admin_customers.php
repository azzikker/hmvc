<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_Customers extends MX_Controller {
    public function __construct() {
        parent::__construct();
        $this->checkuser(); 
        session_start();  
        $this->load->model('Invite_Model');
        $this->load->model('Customer_Model');
        $this->load->model('Order_Model');
        $this->load->model('Companies_Model');
        $this->load->model('Deals_View_Model');
        $this->load->model('Deals_Model');
        $this->load->model('Deals_Selection_Model');
        $this->load->model('Deals_Option_Model');
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
        $tableX = "orders";
        $tableY = "customers";
        $tableZ = "gender";
        $table = "companies";
        $table1 = "deal_view";
        $table2 = "deals";
        $data["page"] = "Customers Reports";
        if($this->session->userdata("user_level") != 2) { 
            $data["sql1"] = $this->Companies_Model->displayCompanies($table);
        }
        else {
            $company_where["user_id"] = $this->session->userdata("user_id");
            $data["sql1"] = $this->Companies_Model->displaySelected($table, $company_where);
        }
        if($this->uri->segment(4) != "") {
            $deal_where["company_id"] = $this->uri->segment(4);
            $deal_company = $this->uri->segment(4);
            $data["sql2"] = $this->Deals_Model->displayGroupedCompanyID($table1, $table2, $deal_company);
            $data["sql3"] = $this->Companies_Model->displaySelected($table, $deal_where);
        }
        if($this->uri->segment(5) != ""){
            $order_where["deal_view_id"] = $this->uri->segment(5);
            $deal_subwhere["deal_id"] = $this->uri->segment(6);
            $sql = $this->Deals_View_Model->displaySelected($table1, $order_where);
            foreach($sql as $row) { $sub_where["deal_hash"] = $row->deal_hash; }
            $data["sql"] = $this->Order_Model->displaySelectedFullAvailable($tableX, $tableY, $table1, $table2, $table, $deal_subwhere);
            $data["sql4"] = $this->Deals_View_Model->displaySelected($table1, $order_where);
            $data["sql5"] = $this->Deals_Model->displaySelected($table2, $sub_where); 
            $data["sql6"] = $this->Deals_Model->displaySelected($table2, $deal_subwhere); 
        } 
        $this->load->view("layouts/admin_layout_header");
        $this->load->view("customers/index_view", $data);
        $this->load->view("layouts/admin_layout_footer");
    }
    function profile() {
        $tableW = "invite";
        $tableX = "orders";
        $tableY = "customers";
        $tableZ = "gender";
        $data["page"] = "Customers - Profile";
        $customer_where["customer_hash"] = $this->uri->segment(4);
        $data["sql"] = $this->Customer_Model->displaySelectedFull($tableY, $tableZ, $customer_where);
        $this->load->view("layouts/admin_layout_header");
        $this->load->view("customers/profile_view", $data);
        $this->load->view("layouts/admin_layout_footer");
    }
    //process
}
?>
