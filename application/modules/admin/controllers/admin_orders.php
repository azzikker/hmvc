<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_Orders extends MX_Controller {
    public function __construct() {
        parent::__construct();
        $this->checkuser(); 
        session_start();  
        $this->load->model('Customer_Model');
        $this->load->model('Order_Model');
        $this->load->model('Order_History_Model');
        $this->load->model('Companies_Model');
        $this->load->model('Deals_View_Model');
        $this->load->model('Deals_Model');
        $this->load->model('Deals_Selection_Model');
        $this->load->model('Deals_Option_Model');
        $this->load->model('Audit_Trail_Model');
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
        $data["page"] = "Orders";
        $field = "voucher_no"; 
        if($this->uri->segment(4) == "active") { $deal_where["order_show"] = 0; }
        else { $deal_where["order_show"] = 1; }
        $sql = $this->Order_Model->displaySelected($tableX, $tableY, $deal_where);
        if($this->uri->segment(5) == "pending") {
            $deal_where["order_status"] = "pending";
            if($this->uri->segment(6) == "search") {
                $like = $_POST["search_here"];
                $data["sql"] = $this->Order_Model->displaySelectedLike($tableX, $tableY, $deal_where, $field, $like);
            }
            else {
                $data["sql"] = $this->Order_Model->displaySelected($tableX, $tableY, $deal_where);
            }
        }
        elseif($this->uri->segment(5) == "used") { 
            $deal_where["order_status"] = "used";
            if($this->uri->segment(6) == "search") {
                $like = $_POST["search_here"];
                $data["sql"] = $this->Order_Model->displaySelectedLike($tableX, $tableY, $deal_where, $field, $like);
            }
            else {
                $data["sql"] = $this->Order_Model->displaySelected($tableX, $tableY, $deal_where);
            }
        }
        elseif($this->uri->segment(5) == "available") { 
            $deal_where["order_status"] = "available";
            if($this->uri->segment(6) == "search") {
                $like = $_POST["search_here"];
                $data["sql"] = $this->Order_Model->displaySelectedLike($tableX, $tableY, $deal_where, $field, $like);
            }
            else {
                $data["sql"] = $this->Order_Model->displaySelected($tableX, $tableY, $deal_where);
            } 
        }
        elseif($this->uri->segment(5) == "expired") { 
            $order_date = time(); 
            if($this->uri->segment(6) == "search") {
                $like = $_POST["search_here"];
                $data["sql"] = $this->Order_Model->displaySelectedDateLike($tableX, $tableY, $order_date, $deal_where, $field, $like);
            }
            else {
                $data["sql"] = $this->Order_Model->displaySelectedDate($tableX, $tableY, $order_date, $deal_where);
            }
        }
        else {
            if($this->uri->segment(6) == "search") {
                $like = $_POST["search_here"];
                $data["sql"] = $this->Order_Model->displaySelectedLike($tableX, $tableY, $deal_where, $field, $like);
            }
            else {
                $data["sql"] = $this->Order_Model->displaySelected($tableX, $tableY, $deal_where);
            }
        }
        $this->load->view("layouts/admin_layout_header");
        $this->load->view("orders/index_view", $data);
        $this->load->view("layouts/admin_layout_footer");     
    }
    function information() {
        $tableX = "orders";
        $tableY = "customers";
        $table1 = "deal_view";
        $table2 = "deals";
        $table3 = "companies";
        $table10 = "order_history";
        $data["page"] = "Orders - Information";
        $deal_where["order_id"] = $this->uri->segment(6);
        $data["sql"] = $this->Order_Model->displaySelectedFull($tableX, $tableY, $table1, $table2, $table3, $deal_where);
        $this->load->view("layouts/admin_layout_header");
        $this->load->view("orders/info_view", $data);
        $this->load->view("layouts/admin_layout_footer");
    }
    function manage_order() {
        $tableX = "orders";
        $tableY = "customers";
        $table1 = "deal_view";
        $table2 = "deals";
        $table3 = "companies";
        $data["page"] = "Orders - Manage";
        $deal_where["order_id"] = $this->uri->segment(6);
        $data["sql"] = $this->Order_Model->displaySelectedFull($tableX, $tableY, $table1, $table2, $table3, $deal_where);
        $this->load->view("layouts/admin_layout_header");
        $this->load->view("orders/manage_view", $data);
        $this->load->view("layouts/admin_layout_footer");
    }
    function manage_return() {
        $this->manage_order();
    }
    //process
    function update_manage_order() {
        $tableW = "order_history";
        $tableX = "orders";
        $tableY = "customers";
        $table1 = "deal_view";
        $table2 = "deals";
        $table3 = "companies";
        $table5 = "deal_option";
        $order_where["order_id"] = $this->uri->segment(6);
        $sql = $this->Order_Model->displaySelectedFull($tableX, $tableY, $table1, $table2, $table3, $order_where);
        foreach($sql as $row1) { 
            $order_returned = $row1->order_returned;
            $order_Cstock = $row1->deal_current_stock; 
            $order_quantity = $row1->order_quantity; 
            $selection_hash = $row1->selection_hash;
            $deal_where["deal_id"] = $row1->deal_id; 
            $option_where["option_id"] = $row1->option_id; 
        }
        $sql2 = $this->Deals_Option_Model->displaySelectedID($table5, $option_where);
        foreach($sql2 as $row2) { 
            $option_returned = $row2->deal_returned;
            $option_Cstock = $row2->deal_current_stock;
        }
        if($this->uri->segment(3) == "update_manage_order") {
            $order_list["order_status"] = $this->db->escape_str($_POST["editOS"]);
            $this->Order_Model->update_order($tableX, $order_where, $order_list);
            //audit_trail start
            $insert = audit_trail("Update", "Vouchers/Orders Maintenance", "Manage Order", $order_where["order_id"], $this->session->userdata('user_id'));
            $this->Audit_Trail_Model->save_audit("audit_trail", $insert);
            //audit_trail end
        }
        elseif($this->uri->segment(3) == "update_manage_return") {
            echo $_POST["editRC"];
        }
        die();
        redirect(base_url() . "admin/admin_orders/information/" . $this->uri->segment(4) . "/" . $this->db->escape_str($_POST["editOS"]) . "/" . $this->uri->segment(6));
    }
    function update_manage_return() {
        $this->update_manage_order();
    }
    function remove() {
        $tableX = "orders";
        $tableY = "customers";
        $table1 = "deal_view";
        $table2 = "deals";
        $table3 = "companies";
        $order_where["order_id"] = $this->uri->segment(6);
        $order_list["order_show"] = 0;
        $this->Order_Model->update_order($tableX, $order_where, $order_list);
        //audit_trail start
        $insert = audit_trail("Remove", "Vouchers/Orders Maintenance", "Manage Order", $order_where["order_id"], $this->session->userdata('user_id'));
        $this->Audit_Trail_Model->save_audit("audit_trail", $insert);
        //audit_trail end
        redirect(base_url() . "admin/admin_orders/index/" . $this->uri->segment(4) . "/" . $this->uri->segment(5));
    }
    function restore() {
        $tableX = "orders";
        $tableY = "customers";
        $table1 = "deal_view";
        $table2 = "deals";
        $table3 = "companies";
        $order_where["order_id"] = $this->uri->segment(6);
        $order_list["order_show"] = 1;
        $this->Order_Model->update_order($tableX, $order_where, $order_list);
        //audit_trail start
        $insert = audit_trail("Restore", "Vouchers/Orders Maintenance", "Manage Order", $order_where["order_id"], $this->session->userdata('user_id'));
        $this->Audit_Trail_Model->save_audit("audit_trail", $insert);
        //audit_trail end
        redirect(base_url() . "admin/admin_orders/index/" . $this->uri->segment(4) . "/" . $this->uri->segment(5));
    }
}  
?>
