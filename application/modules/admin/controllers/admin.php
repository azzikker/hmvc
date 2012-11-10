<?php
class Admin extends MX_Controller
{
    public function __construct() {
        parent::__construct();
        $this->checkuser();
        session_start();
        $this->load->model('User_Model'); 
        $this->load->model('Web_Model');
        $this->load->model('Audit_Trail_Model');
        $this->load->helper("green");
        $this->load->helper("gt++");
        $this->load->helper("gt");
    }
    //authenticator
    function checkuser() {      
        if ( $this->session->userdata('login_state') <> TRUE ) {
             redirect(base_url().'user/login');
        }
    }
    //display
    function index() {    
        $data["page"] = "";
        $this->load->view("layouts/admin_layout_header");
        $this->load->view("admin/index_view", $data);
        $this->load->view("layouts/admin_layout_footer");     
    }
    function settings() {
        $tableWeb = "web_setting";
        $tableContent = "web_content";
        $tableFaq = "web_faq";
        $data["page"] = "Web Settings";
        $data["sqlWeb"] = $this->Web_Model->displayAll($tableWeb, "");
        $data["sqlContent"] = $this->Web_Model->displayAll($tableContent, "");
        if($this->uri->segment(6) == "edit") {
            //start of contact_id decryption
            $faq_length = strlen($this->uri->segment(7)); 
            $faq_character = $this->uri->segment(8); 
            $faq_start = $faq_length - $faq_character;
            $faq_code = substr($this->uri->segment(7) , $faq_start ,$faq_character);
            $faq_id = (($faq_code)-8)/8;
            //end of contact_id decryption
            $WebWhere["faq_id"] = $faq_id;
            $data["sqlFaq"] = $this->Web_Model->displaySelected($tableFaq, $WebWhere);
            $data["sqlFaqAll"] = $this->Web_Model->displayAll($tableFaq, $this->db->order_by("faq_position", "asc")); 
        }
        else { 
            $data["sqlFaq"] = $this->Web_Model->displayAll($tableFaq, $this->db->order_by("faq_position", "asc")); 
        }
        $this->load->view("layouts/admin_layout_header");
        $this->load->view("admin/web_settings/web_settings", $data);
        $this->load->view("layouts/admin_layout_footer"); 
    }
    //process
    function update() {
        $tableWeb = "web_setting";
        $tableContent = "web_content";
        $tableFaq = "web_faq";
        $path = "assets/general/images/web_setting/";
        $customsize = array('height'=>'260','width'=>'105');
        if($this->uri->segment(3) == "background") {
            $WebWhere["background_color"] = $_POST["Scolor"];
            $WebWhere["background_position"] = $_POST["SIposition"];
            $WebWhere["background_repeat"] = $_POST["SIrepetition"];
            $WebWhere["background_attach"] = $_POST["SIattachment"];
            
            $sql = $this->Web_Model->displayAll($tableWeb);
            foreach($sql->result() as $row) {$filename = $row->background_image;}
            if($_FILES["Simage"]["name"] != "") {
                if($filename != "") {
                    //delete photo
                    unlink($path . "customize/$filename");
                    unlink($path . "optimize/$filename");
                    unlink($path . "thumbnail/$filename");
                    unlink($path . "$filename");
                }
                //insert new photo
                $backgroun_image = _upload_photo("Simage",$path,'','true','true','','150',$customsize);
                $WebWhere["background_image"] = $backgroun_image;
            }
            $this->Web_Model->updateAll($tableWeb, $WebWhere);
        }
        elseif($this->uri->segment(3) == "maintenance") {
            if($this->uri->segment(4) != "faq") { $web_content = $_POST["web_content"]; }
            if($this->uri->segment(4) == "about_us") { $content_list['au'] = $web_content; $this->Web_Model->updateAll($tableContent, $content_list); }
            elseif($this->uri->segment(4) == "contact_us") { $content_list['cu'] = $web_content; $this->Web_Model->updateAll($tableContent, $content_list); }
            elseif($this->uri->segment(4) == "privacy_policy") { $content_list['pp'] = $web_content; $this->Web_Model->updateAll($tableContent, $content_list); }
            elseif($this->uri->segment(4) == "terms_of_use") { $content_list['tu'] = $web_content; $this->Web_Model->updateAll($tableContent, $content_list); }
            elseif($this->uri->segment(4) == "return_and_exchange") { $content_list['re'] = $web_content; $this->Web_Model->updateAll($tableContent, $content_list); }
            elseif($this->uri->segment(4) == "terms_of_sale") { $content_list['ts'] = $web_content; $this->Web_Model->updateAll($tableContent, $content_list); }
            elseif($this->uri->segment(4) == "faq") {
                if($_POST["faq_status"] == "add") {
                    $content_list['faq_question'] = xss_cleaner($_POST["addQ"]);
                    $content_list['faq_answer'] = xss_cleaner($_POST["addA"]);
                    $content_list['faq_position'] = xss_cleaner($_POST["faq_count"]);
                    $this->Web_Model->saveWeb($tableFaq, $content_list);
                }
                elseif($_POST["faq_status"] == "edit") {
                    //start of faq_id decryption
                    $faq_length = strlen($this->uri->segment(5)); 
                    $faq_character = $this->uri->segment(6); 
                    $faq_start = $faq_length - $faq_character;
                    $faq_code = substr($this->uri->segment(5) , $faq_start ,$faq_character);
                    $faq_id = (($faq_code)-8)/8;
                    //end of faq_id decryption
                    $faq_old = xss_cleaner($_POST["editP_old"]);
                    $faq_new = xss_cleaner($_POST["editP_new"]);
                    
                    $Faq_ID["faq_position"] = $faq_new;
                    $sql = $this->Web_Model->displaySelected($tableFaq, $Faq_ID);
                    foreach($sql->result() as $row) { $FaqWhere["faq_id"] = $row->faq_id; }
                    
                    $WebWhere["faq_id"] = $faq_id;
                    $content_list['faq_question'] = xss_cleaner($_POST["editQ"]);
                    $content_list['faq_answer'] = xss_cleaner($_POST["editA"]);
                    $content_list['faq_position'] = $faq_new; 
                    $faq_list['faq_position'] = $faq_old;
                    $this->Web_Model->updateSelected($tableFaq, $FaqWhere, $faq_list); 
                    $this->Web_Model->updateSelected($tableFaq, $WebWhere, $content_list);
                } 
            }
        }
        elseif($this->uri->segment(3) == "accounting") {
            $WebWhere["accounting_income"] = $_POST["updateIP"];
            $WebWhere["accounting_remittance"] = $_POST["updateRP"];
            
            $this->Web_Model->updateAll($tableWeb, $WebWhere);
        }             
        //audit_trail start
        $insert = audit_trail("Update", "Web Settings", ucwords($this->uri->segment(3)), ($this->uri->segment(3) == "maintenance" ? $this->uri->segment(3) . " [ <span class=\"blue\">" . str_ireplace("_", " ", $this->uri->segment(4)) . "</span> ] " : $this->uri->segment(3)), $this->session->userdata('user_id'));
        $this->Audit_Trail_Model->save_audit("audit_trail", $insert);
        //audit_trail end
        redirect(base_url() . "admin/admin/settings/" . $this->uri->segment(3) . ($this->uri->segment(3) == "maintenance" ? "/" . $this->uri->segment(4) : ""));
    }
    function remove() {
        $tableWeb = "web_setting";
        $path = "assets/general/images/web_setting/";
        $sql = $this->Web_Model->displayAll($tableWeb, "");
        foreach($sql->result() as $row) {$filename = $row->background_image;}
        //delete photo
        unlink($path . "customize/$filename");
        unlink($path . "optimize/$filename");
        unlink($path . "thumbnail/$filename");
        unlink($path . "$filename");
        $WebWhere["background_image"] = "";
        $this->Web_Model->updateAll($tableWeb, $WebWhere);
        redirect(base_url() . "admin/admin/settings/" . $this->uri->segment(3));
    }
}                                
