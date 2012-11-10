<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_Accounting extends MX_Controller {
    public function __construct() {
        parent::__construct();
        $this->checkuser(); 
        session_start();
        $this->load->model('Web_Model');  
        $this->load->model('Deals_View_Model');
        $this->load->model('Order_Model');
        $this->load->model('Deals_Model');
        $this->load->model('Companies_Model');
        $this->load->model('Deals_Category_Model');
        $this->load->model('Deals_Option_Model');
        $this->load->model('Deals_Payment_Model');
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
        $tableWeb = "web_setting";
        $table = "companies";
        $table1 = "deal_view";
        $table2 = "deals";
        $table10 = "deal_payment";
        $deal_where = time();
        $company_where["user_id"] = $this->session->userdata('user_id');
        $data["page"] = "Payment";
        
        $sql1 = $this->Companies_Model->displaySelected($table, $company_where);
        $sqlWeb = $this->Web_Model->displayAll($tableWeb); 
        foreach($sql1 as $row1) { $deal_view_where["company_id"] = $row1->company_id; }
        foreach($sqlWeb->result() as $rowWeb) { $webWhere = $rowWeb->accounting_income; }
         
        $data["sql"] = $this->Deals_View_Model->displayViews($table1);
        $data["webcall"] = $webWhere;
        
        $this->load->view("layouts/admin_layout_header");
        $this->load->view("payment/index_view_vigattin", $data);
        $this->load->view("layouts/admin_layout_footer");
    }
    function merchant() {
        $tableWeb = "web_setting";     
        $table = "companies";
        $table1 = "deal_view";
        $table2 = "deals";          
        $table10 = "deal_payment";
        $deal_where = time();
        $company_where["user_id"] = $this->session->userdata('user_id');
        $data["page"] = "Payment";
        
        $sqlWeb = $this->Web_Model->displayAll($tableWeb);
        foreach($sqlWeb->result() as $rowWeb) { $webWhere = $rowWeb->accounting_income; } 
        
        $data["sql"] = $this->Deals_View_Model->displayUserBased($table, $table1, $company_where);
        $data["webcall"] = $webWhere;
         
        $this->load->view("layouts/admin_layout_header");
        $this->load->view("payment/index_view_merchant", $data);
        $this->load->view("layouts/admin_layout_footer");
    }
    function managePayment() {
        $table1 = "deal_view";
        $deal_where["deal_hash"] = $this->uri->segment(6);
        $data["page"] = "Manage Payment";
        $data["sql"] = $this->Deals_View_Model->displaySelected($table1, $deal_where);
        $this->load->view("layouts/admin_layout_header");
        $this->load->view("payment/manage_payment", $data);
        $this->load->view("layouts/admin_layout_footer");
    }
    //process
    function finished() {
        $table1 = "deal_view";
        $table10 = "deal_payment";
        $deal_where["deal_hash"] = $this->uri->segment(6);
        $view_list["deal_status"] = "Finished";
        $payment_list["receipt_no"] = $this->db->escape_str($_POST["RN"]);
        $payment_list["account_no"] = $this->db->escape_str($_POST["AN"]);
        $payment_list["bank_name"] = $this->db->escape_str($_POST["BN"]);
        $payment_list["date_paid"] = time();
        $payment_list["deal_hash"] = $this->uri->segment(6);
        $payment_list["company_id"] = $this->db->escape_str($_POST["CI"]);
        $this->Deals_Category_Model->update_category($table1, $view_list, $deal_where);
        $this->Deals_Payment_Model->save_view($table10, $payment_list, $deal_where);
        //audit_trail start
        $insert = audit_trail("Complete", "Payment Due", "Manage Payment", $payment_list["deal_hash"], $this->session->userdata('user_id'));
        $this->Audit_Trail_Model->save_audit("audit_trail", $insert);
        //audit_trail end
        redirect(base_url() . "admin/admin_accounting/index/" . $this->uri->segment(4) . "/" . $this->uri->segment(5));
    }
}

?>