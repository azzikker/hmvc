<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_Deals extends MX_Controller {   
    public function __construct() {
        parent::__construct();
        $this->checkuser(); 
        session_start();  
        $this->load->model('Deals_Category_Model');
        $this->load->model('Deals_Video_Model');
        $this->load->model('Deals_View_Model');  
        $this->load->model('Deals_Model');
        $this->load->model('Deals_Selection_Model');
        $this->load->model('Deals_Option_Model');
        $this->load->model('Deals_Highlight_Model');
        $this->load->model('Deals_Term_Model');
        $this->load->model('Deals_Location_Model');
        $this->load->model('Deals_Gallery_Model');
        $this->load->model('Companies_Model');
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
        $table = "deal_category"; 
        $table1 = "deal_view";
        $table2 = "deals";
        $table9 = "companies";
        $deal_where = time();
        $field = "deal_view_title";
        $data["page"] = "Deals";
        //$data["sqlx"] = $this->Deals_Category_Model->displayCategory($table);     
        $data["sqlx"] = $this->Deals_Category_Model->select_category_by_deleted_col($table);   
        //date filtering area start
        if($this->uri->segment(4) == "current") {
            if($this->session->userdata('user_level') == 2) {
                if($this->uri->segment(5) == "search") { 
                    $like = $_POST["search_here"];
                    $data["sql2"] = $this->Deals_View_Model->displayViewCurrentSelectedLike($table1, $deal_where, $field, $like);
                }
                else { 
                    $data["sql2"] = $this->Deals_View_Model->displayViewCurrentSelected($table1, $deal_where);
                }
            }
            else {
                if($this->uri->segment(5) == "search") {
                    $like = $_POST["search_here"];               
                    $data["sql2"] = $this->Deals_View_Model->displayViewCurrentLike($table1, $deal_where, $field, $like);
                }
                else {
                    $data["sql2"] = $this->Deals_View_Model->displayViewCurrent($table1, $deal_where);
                }
            }  
        }
        elseif($this->uri->segment(4) == "future") {
            if($this->session->userdata('user_level') == 2) {
                if($this->uri->segment(5) == "search") {
                    $like = $_POST["search_here"];
                    $data["sql2"] = $this->Deals_View_Model->displayViewFutureSelectedLike($table1, $deal_where);
                }
                else { 
                    $data["sql2"] = $this->Deals_View_Model->displayViewFutureSelected($table1, $deal_where);
                }
            }
            else {
                if($this->uri->segment(5) == "search") {
                    $like = $_POST["search_here"];
                    $data["sql2"] = $this->Deals_View_Model->displayViewFutureLike($table1, $deal_where, $field, $like);
                }
                else { 
                    $data["sql2"] = $this->Deals_View_Model->displayViewFuture($table1, $deal_where);
                }
            }
        }
        elseif($this->uri->segment(4) == "past") {
            if($this->session->userdata('user_level') == 2) {
                if($this->uri->segment(5) == "search") {
                    $like = $_POST["search_here"];
                    $data["sql2"] = $this->Deals_View_Model->displayViewPastSelectedLike($table1, $deal_where, $field, $like);
                }
                 else { 
                    $data["sql2"] = $this->Deals_View_Model->displayViewPastSelected($table1, $deal_where);
                }
            }
            else {
                if($this->uri->segment(5) == "search") {
                    $like = $_POST["search_here"];
                    $data["sql2"] = $this->Deals_View_Model->displayViewPastLike($table1, $deal_where, $field, $like);
                }
                else {                                                                          
                    $data["sql2"] = $this->Deals_View_Model->displayViewPast($table1, $deal_where);
                }
            }
        }
        //date filtering area end 
        $data["sql9"] = $this->Companies_Model->displayCompanies_by_deleted($table9);
        $this->load->view("layouts/admin_layout_header");
        $this->load->view("deals/index_view", $data);
        $this->load->view("layouts/admin_layout_footer");     
    }
    function profile_single_deal() {
        $table = "deal_category";
        $table0 = "deal_video"; 
        $table1 = "deal_view";
        $table2 = "deals";
        $table3 = "deal_gallery";
        $table4 = "deal_selection";
        $table5 = "deal_option";
        $table6 = "deal_highlight";
        $table7 = "deal_fineprint";
        $table8 = "deal_location";
        $table9 = "companies";
        $deal_where["deal_hash"] = $this->uri->segment(5);
        $data["page"] = "Deals - Profile";
        $data["sql1"] = $this->Deals_View_Model->displaySelected($table1, $deal_where);
        $data["sql2"] = $this->Deals_Model->displaySelected($table2, $deal_where);
        $data["sql4"] = $this->Deals_Selection_Model->displaySelected($table4, $deal_where);
        $data["sql6"] = $this->Deals_Highlight_Model->displaySelected($table6, $deal_where);
        $data["sql7"] = $this->Deals_Term_Model->displaySelected($table7, $deal_where);
        $this->load->view("layouts/admin_layout_header");
        $this->load->view("deals/profile_single_view", $data);
        $this->load->view("layouts/admin_layout_footer");
    }
    function profile_group_deal() {
        $table = "deal_category";
        $table0 = "deal_video"; 
        $table1 = "deal_view";
        $table2 = "deals";
        $table3 = "deal_gallery";
        $table4 = "deal_selection";
        $table5 = "deal_option";
        $table6 = "deal_highlight";
        $table7 = "deal_fineprint";
        $table8 = "deal_location";
        $table9 = "companies";
        $deal_where["deal_hash"] = $this->uri->segment(5);
        $deal_hash = $deal_where["deal_hash"];
        $data["page"] = "Deals - Profile";
        $data["sql1"] = $this->Deals_View_Model->displaySelected($table1, $deal_where);
        $data["sql2"] = $this->Deals_Model->displayGrouped($table1, $table2, $deal_hash);
        $data["sql8"] = $this->Deals_Location_Model->displaySelected($table8, $deal_where);
        $this->load->view("layouts/admin_layout_header");
        $this->load->view("deals/profile_group_view", $data);
        $this->load->view("layouts/admin_layout_footer");
    }
    function profile_sub_deal() {
        $table = "deal_category";
        $table0 = "deal_video"; 
        $table1 = "deal_view";
        $table2 = "deals";
        $table3 = "deal_gallery";
        $table4 = "deal_selection";
        $table5 = "deal_option";
        $table6 = "deal_highlight";
        $table7 = "deal_fineprint";
        $table8 = "deal_location";
        $table9 = "companies";
        $deal_subwhere["deal_subhash"] = $this->uri->segment(5);
        $deal_hash = $deal_subwhere["deal_subhash"];
        $gallery_where["deal_subhash"] = $deal_subwhere["deal_subhash"];
        $gallery_where["gallery_main"] = 2;
        $sql2 = $this->Deals_Model->displaySelected($table2, $deal_subwhere);
        foreach($sql2 as $row2) { $deal_where["deal_hash"] = $row2->deal_hash; }
        $data["page"] = "Deals - Profile";
        $data["sql1"] = $this->Deals_View_Model->displaySelected($table1, $deal_where);
        $data["sql2"] = $this->Deals_Model->displaySelected($table2, $deal_subwhere);
        $data["sql3"] = $this->Deals_Gallery_Model->displaySelected($table3, $gallery_where);
        $data["sql4"] = $this->Deals_Selection_Model->displaySelected($table4, $deal_subwhere);
        $data["sql6"] = $this->Deals_Highlight_Model->displaySelected($table6, $deal_subwhere);
        $data["sql7"] = $this->Deals_Term_Model->displaySelected($table7, $deal_subwhere);
        $data["sql8"] = $this->Deals_Location_Model->displaySelected($table8, $deal_where);
        $this->load->view("layouts/admin_layout_header");
        $this->load->view("deals/profile_sub_view", $data);
        $this->load->view("layouts/admin_layout_footer");
    }
    function edit_single_deal() {
        $table = "deal_category";
        $table1 = "deal_view";
        $table2 = "deals";
        $table3 = "deal_gallery";
        $table4 = "deal_selection";
        $table5 = "deal_option";
        $table6 = "deal_highlight";
        $table7 = "deal_fineprint";
        $table8 = "deal_location";
        $table9 = "companies";
        $data["page"] = "Deals - Edit";
        $deal_where["deal_hash"] = $this->uri->segment(5);
        //$deal_where = $view_where, select_where
        $sql = $this->Deals_View_Model->displaySelected($table1, $deal_where);
        $sql4 = $this->Deals_Selection_Model->displaySelected($table4, $deal_where);
        foreach($sql as $row) { $category_where["category_id"] = $row->category_id; $company_where["company_id"] = $row->company_id; }
        $data["sqla"] = $this->Deals_Category_Model->displayCategoryUnselected($table, $category_where["category_id"]);
        $data["sqlb"] = $this->Deals_Category_Model->displayCategorySelected($table, $category_where);
        $data["sql1"] = $this->Deals_View_Model->displaySelected($table1, $deal_where);
        $data["sql2"] = $this->Deals_Model->displaySelected($table2, $deal_where);
        $data["sql4"] = $this->Deals_Selection_Model->displaySelected($table4, $deal_where);
        foreach($sql4 as $row4) { 
            $option_where["selection_hash"] = $row4->selection_hash; 
            $data["sql5"] = $this->Deals_Option_Model->displaySelected($table5, $deal_where, $option_where);
        }
        $data["sql6"] = $this->Deals_Highlight_Model->displaySelected($table6, $deal_where);
        $data["sql7"] = $this->Deals_Term_Model->displaySelected($table7, $deal_where);
        $data["sql8"] = $this->Deals_Location_Model->displaySelected($table8, $deal_where);
        $data["sql9a"] = $this->Companies_Model->displayUnselected($table9, $company_where["company_id"]);
        $data["sql9b"] = $this->Companies_Model->displaySelected($table9, $company_where);
        $this->load->view("layouts/admin_layout_header");
        $this->load->view("deals/edit_single_view", $data);
        $this->load->view("layouts/admin_layout_footer");
    }
    function edit_group_deal() { 
        $table = "deal_category";
        $table1 = "deal_view";
        $table2 = "deals";
        $table4 = "deal_selection";
        $table8 = "deal_location";
        $table9 = "companies";
        $data["page"] = "Deals - Edit";
        $deal_where["deal_hash"] = $this->uri->segment(5);
        $deal_hash = $deal_where["deal_hash"];
        //$deal_where = $view_where, select_where
        $sql = $this->Deals_View_Model->displaySelected($table1, $deal_where);
        $sql4 = $this->Deals_Selection_Model->displaySelected($table4, $deal_where);
        foreach($sql as $row) { $category_where["category_id"] = $row->category_id; $company_where["company_id"] = $row->company_id; }
        $data["sqla"] = $this->Deals_Category_Model->displayCategoryUnselected($table, $category_where["category_id"]);
        $data["sqlb"] = $this->Deals_Category_Model->displayCategorySelected($table, $category_where);
        $data["sql1"] = $this->Deals_View_Model->displaySelected($table1, $deal_where);
        $data["sql2"] = $this->Deals_Model->displayGrouped($table1, $table2, $deal_hash);
        $data["sql8"] = $this->Deals_Location_Model->displaySelected($table8, $deal_where);
        $data["sql9a"] = $this->Companies_Model->displayUnselected($table9, $company_where["company_id"]);
        $data["sql9b"] = $this->Companies_Model->displaySelected($table9, $company_where);
        $this->load->view("layouts/admin_layout_header"); 
        $this->load->view("deals/edit_group_view", $data);
        $this->load->view("layouts/admin_layout_footer"); 
    }
    function edit_sub_deal() {
        $table2 = "deals";
        $table3 = "deal_gallery";
        $table4 = "deal_selection";
        $table5 = "deal_option";
        $table6 = "deal_highlight";
        $table7 = "deal_fineprint";
        $data["page"] = "Deals - Edit";
        $deal_where["deal_subhash"] = $this->uri->segment(5);
        $data["sql2"] = $this->Deals_Model->displaySelected($table2, $deal_where);
        $data["sql4"] = $this->Deals_Selection_Model->displaySelected($table4, $deal_where);
        $data["sql6"] = $this->Deals_Highlight_Model->displaySelected($table6, $deal_where);
        $data["sql7"] = $this->Deals_Term_Model->displaySelected($table7, $deal_where);
        $this->load->view("layouts/admin_layout_header");
        $this->load->view("deals/edit_sub_view", $data);
        $this->load->view("layouts/admin_layout_footer");
    }
    function renew_single_deal() {
        $table = "deal_category";
        $table0 = "deal_video";
        $table1 = "deal_view";
        $table2 = "deals";
        $table3 = "deal_gallery";
        $table4 = "deal_selection";
        $table5 = "deal_option";
        $table6 = "deal_highlight";
        $table7 = "deal_fineprint";
        $table8 = "deal_location";
        $table9 = "companies";
        $data["page"] = "Deals - Renew";
        $deal_where["deal_hash"] = $this->uri->segment(5);
        //$deal_where = $view_where, select_where
        $sql = $this->Deals_View_Model->displaySelected($table1, $deal_where);
        $sql4 = $this->Deals_Selection_Model->displaySelected($table4, $deal_where);
        foreach($sql as $row) { $category_where["category_id"] = $row->category_id; $company_where["company_id"] = $row->company_id; }
        $data["sqlb"] = $this->Deals_Category_Model->displayCategorySelected($table, $category_where);
        $data["sql0"] = $this->Deals_Video_Model->displaySelected($table0, $deal_where);
        $data["sql1"] = $this->Deals_View_Model->displaySelected($table1, $deal_where);
        $data["sql2"] = $this->Deals_Model->displaySelected($table2, $deal_where);
        $data["sql4"] = $this->Deals_Selection_Model->displaySelected($table4, $deal_where);
        foreach($sql4 as $row4) { 
            $option_where["selection_hash"] = $row4->selection_hash; 
            $data["sql5"] = $this->Deals_Option_Model->displaySelected($table5, $deal_where, $option_where);
        }
        $data["sql6"] = $this->Deals_Highlight_Model->displaySelected($table6, $deal_where);
        $data["sql7"] = $this->Deals_Term_Model->displaySelected($table7, $deal_where);
        $data["sql8"] = $this->Deals_Location_Model->displaySelected($table8, $deal_where);
        $data["sql9b"] = $this->Companies_Model->displaySelected($table9, $company_where);
        $this->load->view("layouts/admin_layout_header");
        $this->load->view("deals/renew_single_view", $data);
        $this->load->view("layouts/admin_layout_footer");
    }

    function multi_renew_single_deal()
    {
        $user_hashes = $this->input->post('checkbox');
        
        if ($user_hashes == false) {
            redirect(base_url() . "admin/admin_deals/index/current");
        } else { 
            foreach ($user_hashes as $user) {
                $this->delete_single_deal(true, $user);
            }
            redirect(base_url() . "admin/admin_deals/index/current");
        }
    }

    function renew_group_deal() {
        //copy image withoit hussle
        /*$old = base_url() . 'assets/general/images/deals_gallery/optimize/133823554496701.jpg';
        $filename = time() . rand(10000,99999) .  ".jpg";
        $new = 'assets/general/images/deals_gallery/optimize/' . $filename;
        copy($old, $new); */
        $table = "deal_category";
        $table0 = "deal_video";
        $table1 = "deal_view";
        $table2 = "deals";
        $table8 = "deal_location";
        $table9 = "companies";
        $data["page"] = "Deals - Renew";
        $deal_where["deal_hash"] = $this->uri->segment(5);
        $deal_hash = $deal_where["deal_hash"];
        //$deal_where = $view_where, select_where
        $sqll = $this->Deals_View_Model->displaySelected($table1, $deal_where);
        $sql2 = $this->Deals_Model->displaySelected($table2, $deal_where);
        foreach($sqll as $row1) { $category_where["category_id"] = $row1->category_id; $company_where["company_id"] = $row1->company_id; }
        foreach($sql2 as $row2) { $deal_subhash["deal_subhash"] = $row2->deal_subhash; }
        $data["sqlb"] = $this->Deals_Category_Model->displayCategorySelected($table, $category_where);
        $data["sql1"] = $this->Deals_View_Model->displaySelected($table1, $deal_where);
        $data["sql2"] = $this->Deals_Model->displayBranched($table0, $table1, $table2, $deal_hash);
        $data["sql8"] = $this->Deals_Location_Model->displaySelected($table8, $deal_where);
        $data["sql9b"] = $this->Companies_Model->displaySelected($table9, $company_where);
        $this->load->view("layouts/admin_layout_header"); 
        $this->load->view("deals/renew_group_view", $data);
        $this->load->view("layouts/admin_layout_footer");
    }
    //process
    function save_single_deal() {
        $table0 = "deal_video";    
        $table1 = "deal_view";
        $table2 = "deals";
        $table3 = "deal_gallery";
        $table4 = "deal_selection";
        $table5 = "deal_option";
        $table6 = "deal_highlight";
        $table7 = "deal_fineprint";
        $table9 = "companies";
        $customsize = array('height'=>'260','width'=>'105');
        $path = "assets/general/images/deals_gallery/";          
        //deal_view-----------------
        $view_list['deal_view_type'] = $this->db->escape_str($_POST["addDT"]);
        $view_list["deal_view_title"] = xss_cleaner($_POST["addMDN"]);
        $view_list["deal_view_statement"] = xss_cleaner($_POST["addMDS"]);
        $view_list['deal_hash'] = md5(xss_cleaner($_POST["addMDN"]) . time());
        $view_list['deal_view_start'] = strtotime(xss_cleaner($_POST["addSOD"])); 
        $view_list['deal_view_end'] = strtotime(xss_cleaner($_POST["addEOD"]));
        $view_list['deal_view_due'] = strtotime(xss_cleaner($_POST["addEOD"]) . "+ 15 days");
        /*if($_FILES["addMMC"]["name"] != '') {
            $image_size_filter = image_size_filter($_FILES["addMMC"]["tmp_name"], 750, 263, 690, 242);
            $image_type_filter = image_type_filter($_FILES["addMMC"]["name"]);
            
            if($image_type_filter == "unidentified") {
                redirect(base_url() . 'admin/admin_deals/index/' . $this->uri->segment(4) . '?error2=1');
            }
            else {
                if($image_size_filter == "large" || $image_size_filter == "small") {
                    redirect(base_url() . 'admin/admin_deals/index/' . $this->uri->segment(4) . '?error1=1');
                }
                $deal_view_main = _upload_photo("addMMC",$path,'default.jpg','true','true','','150',$customsize);
                $view_list['deal_image'] = $deal_view_main;
            }                                                
        }*/
        $view_list['category_id'] = xss_cleaner($_POST["addDC"]);
        $view_list['company_hash'] = xss_cleaner($_POST["addDCO"]);
        //deal_gallery-----------------
        $gallery_list['gallery_main'] = 0;
        $gallery_list['deal_hash'] = $view_list['deal_hash'];
        if($_POST["addDT"]=="Single Deal") {//If the deal type is in Single form 
            //deal-----------------
            $deal_list['deal_original_price'] = xss_cleaner($_POST["addOP"]);
            $deal_list['deal_discount'] = xss_cleaner($_POST["addD"]);
            $deal_list['deal_discounted_price'] = xss_cleaner($_POST["addDP"]);
            $deal_list['deal_hash'] = $view_list['deal_hash'];
            $deal_list['deal_subhash'] = md5(xss_cleaner($_POST["addMDN"]) . time());
            $deal_list["deal_title"] = xss_cleaner($_POST["addMDN"]);//reads main title
            $deal_list["deal_statement"] = xss_cleaner($_POST["addMDS"]);//reads main statement
            $deal_list["deal_content"] = xss_cleaner($_POST["addContent_single"]);
            $deal_list['deal_select'] = 1;
            //deal_video
            $video_list['video_embed'] = $_POST["addDV_single"];
            $video_list['deal_hash'] = $view_list['deal_hash'];
            $video_list['deal_subhash'] = $deal_list['deal_subhash'];
            //deal_gallery
            $gallery_list['deal_subhash'] = $deal_list['deal_subhash'];
            if($_FILES["addMMC"]["name"] != '') {
                $image_size_filter = image_size_filter($_FILES["addMMC"]["tmp_name"], 750, 263, 690, 242);
                $image_type_filter = image_type_filter($_FILES["addMMC  "]["name"]);
                if($image_type_filter == "unidentified") {
                    redirect(base_url() . 'admin/admin_deals/index/' . $this->uri->segment(4) . '?error2=1');
                }
                else {
                    if($image_size_filter == "large" || $image_size_filter == "small") {
                        redirect(base_url() . 'admin/admin_deals/index/' . $this->uri->segment(4) . '?error1=1');
                    }
                    echo "success";
                    $deal_view_main = _upload_photo("addMMC",$path,'default.jpg','true','true','','150',$customsize);
                    $view_list['deal_image'] = $deal_view_main;
                    
                    $gallery_list['gallery_filename'] = $view_list['deal_image'];
                    $gallery_list['gallery_main'] = 1;        
                } 
            }
             if($_POST["Oswitcher"] == 0) {
                $deal_list['deal_option'] = 0;
                //deal_selection & deal_option
                $s_count = $this->db->escape_str($_POST["nSELECTION_single"]);
                $o_count = $this->db->escape_str($_POST["nOPTION_single$s_count"]);
                If($this->db->escape_str($_POST["addDselect_single$s_count"]) != "") {
                    for($i1=1;$i1<=$s_count;$i1++) {
                        $select_list['selection_name'] = xss_cleaner($_POST["addDselect_single$i1"]);
                        $select_list['selection_hash'] = md5(xss_cleaner($_POST["addDselect_single$i1"]) . time());
                        $select_list['deal_hash'] = $view_list['deal_hash'];
                        $select_list['deal_subhash'] = $deal_list['deal_subhash'];
                        for($i2=1;$i2<=$o_count;$i2++) { 
                            $option_list['option_name'] = xss_cleaner($_POST["addDoption_single" . $i1 . "_". $i2]);
                            $option_list['selection_hash'] = $select_list['selection_hash'];
                            $option_list['deal_hash'] = $view_list['deal_hash'];
                            $option_list['deal_original_stock'] = xss_cleaner($_POST["addStock_single" . $i1 . "_". $i2]);
                            $option_list['deal_current_stock'] = $option_list['deal_original_stock'];
                            $this->Deals_Option_Model->save_option($table5, $option_list);
                        }
                        $this->Deals_Selection_Model->save_select($table4, $select_list);
                    }
                }
            }
            else {
                $deal_list['deal_option'] = 1;
                $deal_list['deal_original_stock'] = xss_cleaner($_POST["addStock"]);
                $deal_list['deal_current_stock'] = xss_cleaner($_POST["addStock"]);
            }
            //deal_highlight
            $h_count = $this->db->escape_str($_POST["nH_single"]);
            for($i3=1;$i3<=$h_count;$i3++) {
                $highlight_list["highlight_content"] = xss_cleaner($_POST["addH_single$i3"]);
                $highlight_list['deal_hash'] = $view_list['deal_hash'];
                $highlight_list['deal_subhash'] = $deal_list['deal_subhash'];
                $this->Deals_Highlight_Model->save_highlight($table6, $highlight_list);
            }
            //deal_term
            $t_count = $this->db->escape_str($_POST["nT_single"]);
            for($i4=1;$i4<=$t_count;$i4++) {
                $term_list['fineprint_content'] = xss_cleaner($_POST["addT_single$i4"]);
                $term_list['deal_hash'] = $view_list['deal_hash'];
                $term_list['deal_subhash'] = $deal_list['deal_subhash'];
                $this->Deals_Term_Model->save_term($table7, $term_list);
            }
            $this->Deals_Video_Model->save_video($table0, $video_list);
            $this->Deals_Model->save_single_deal($table2, $deal_list);
            $this->Deals_Gallery_Model->save_gallery($table3, $gallery_list);
        }
        else {//If the deal type is in Group form
            for($i=1;$i<$this->db->escape_str($_POST["nDEAL"])+1;$i++) {
                //deal-----------------
                $deal_list['deal_original_price'] = xss_cleaner($_POST["addOP$i"]);
                $deal_list['deal_discount'] = xss_cleaner($_POST["addD$i"]);
                $deal_list['deal_discounted_price'] = xss_cleaner($_POST["addDP$i"]);
                $deal_list['deal_hash'] = $view_list['deal_hash'];
                $deal_list['deal_subhash'] = md5(xss_cleaner($_POST["addDN$i"]) . time());
                $deal_list["deal_title"] = xss_cleaner($_POST["addDN$i"]);//reads sub title
                $deal_list["deal_statement"] = xss_cleaner($_POST["addDS$i"]);//reads sub statement
                $deal_list["deal_content"] = xss_cleaner($_POST["addContent_group$i"]);
                if($i==1) { $deal_list['deal_select'] = 1; }
                else { $deal_list['deal_select'] = 0; }
                //deal_video
                $video_list['video_embed'] = $_POST["addDV_group$i"];
                $video_list['deal_hash'] = $view_list['deal_hash'];
                $video_list['deal_subhash'] = $deal_list['deal_subhash'];
                //deal_gallery
                $gallery_list['deal_subhash'] = $deal_list['deal_subhash'];
                if($_FILES["addMC$i"]["name"] != '') {
                    $image_size_filter = image_size_filter($_FILES["addMC$i"]["tmp_name"], 750, 263, 690, 242);
                    $image_type_filter = image_type_filter($_FILES["addMC$i"]["name"]);
                    
                    if($image_type_filter == "unidentified") {
                        redirect(base_url() . 'admin/admin_deals/index/' . $this->uri->segment(4) . '?error4=1');
                    }
                    else {
                        if($image_size_filter == "large" || $image_size_filter == "small") {
                            redirect(base_url() . 'admin/admin_deals/index/' . $this->uri->segment(4) . '?error3=1');
                        }
                        $deal_view_sub = _upload_photo("addMC$i",$path,'default.jpg','true','true','','150',$customsize);
                        $gallery_list['gallery_filename'] = $deal_view_sub;
                        $gallery_list['gallery_main'] = 2;
                    }
                } 
                if($this->db->escape_str($_POST["Oswitcher$i"]) == 0) {
                    $deal_list['deal_option'] = 0;
                    //deal_selection & deal_option
                    $s_count = $this->db->escape_str($_POST["nSELECTION_group$i"]);
                    $o_count = $this->db->escape_str($_POST["nOPTION_group" . $i . "_" . $s_count]);
                    If($this->db->escape_str($_POST["addDselect_group" . $i . "_". $s_count]) != "") {
                        for($i1=1;$i1<=$s_count;$i1++) {
                            $select_list['selection_name'] = xss_cleaner($_POST["addDselect_group" . $i . "_" . $i1]);
                            $select_list['selection_hash'] = md5(xss_cleaner($_POST["addDselect_group" . $i . "_" . $i1]) . "" . time());
                            $select_list['deal_hash'] = $view_list['deal_hash'];
                            $select_list['deal_subhash'] = $deal_list['deal_subhash'];
                            for($i2=1;$i2<=$o_count;$i2++) {
                                $option_list['option_name'] = xss_cleaner($_POST["addDoption_group" . $i . "_" . $i1 . "_". $i2]);
                                $option_list['selection_hash'] = $select_list['selection_hash'];
                                $option_list['deal_hash'] = $view_list['deal_hash'];
                                $option_list['deal_original_stock'] = xss_cleaner($_POST["addStock_group" . $i . "_" . $i1 . "_". $i2]);
                                $option_list['deal_current_stock'] = $option_list['deal_original_stock'];
                                $this->Deals_Option_Model->save_option($table5, $option_list);
                            }
                            $this->Deals_Selection_Model->save_select($table4, $select_list);
                        }
                    }
                }
                else {
                    $deal_list['deal_option'] = 1;
                    $deal_list['deal_original_stock'] = $this->db->escape_str($_POST["addStock$i"]);
                    $deal_list['deal_current_stock'] = $this->db->escape_str($_POST["addStock$i"]);
                }
                //deal_highlight
                $h_count = $_POST["nH_group$i"];
                for($i3=1;$i3<=$h_count;$i3++) {
                    $highlight_list["highlight_content"] = xss_cleaner($_POST["addH_group" . $i . "_". $i3]);
                    $highlight_list['deal_hash'] = $view_list['deal_hash'];
                    $highlight_list['deal_subhash'] = $deal_list['deal_subhash'];
                    $this->Deals_Highlight_Model->save_highlight($table6, $highlight_list);
                }
                //deal_term
                $t_count = $_POST["nT_group$i"];
                for($i4=1;$i4<=$t_count;$i4++) {
                    $term_list["fineprint_content"] = xss_cleaner($_POST["addT_group" . $i . "_". $i4]);
                    $term_list['deal_hash'] = $view_list['deal_hash'];
                    $term_list['deal_subhash'] = $deal_list['deal_subhash'];
                    $this->Deals_Term_Model->save_term($table7, $term_list);
                }
                $this->Deals_Video_Model->save_video($table0, $video_list);
                $this->Deals_Model->save_single_deal($table2, $deal_list);
                $this->Deals_Gallery_Model->save_gallery($table3, $gallery_list);     
            }
        }
        $this->Deals_View_Model->save_view($table1, $view_list);
        //audit_trail start
        $insert = audit_trail("Save", "Deals Maintenance", "Add New Deal", $view_list['deal_view_title'], $this->session->userdata('user_id'));
        $this->Audit_Trail_Model->save_audit("audit_trail", $insert);
        //audit_trail end 
        redirect(base_url() . "admin/admin_deals/index/current");        
    }
    function save_group_deal() {
        $table0 = "deal_video";
        $table1 = "deal_view";
        $table2 = "deals";
        $table3 = "deal_gallery";
        $table4 = "deal_selection";
        $table5 = "deal_option";
        $table6 = "deal_highlight";
        $table7 = "deal_fineprint";
        $customsize = array('height'=>'260','width'=>'105');
        $path = "assets/general/images/deals_gallery/";
        //deal_view
        $view_list["deal_hash"] = $this->uri->segment(5);
        //deal
        $deal_list["deal_title"] = xss_cleaner($_POST["addMDN"]);
        $deal_list["deal_statement"] = xss_cleaner($_POST["addMDS"]);
        $deal_list['deal_original_price'] = xss_cleaner($_POST["addOP"]);
        $deal_list['deal_discount'] = xss_cleaner($_POST["addD"]);
        $deal_list['deal_discounted_price'] = xss_cleaner($_POST["addDP"]);
        $deal_list['deal_hash'] = $view_list['deal_hash'];
        $deal_list['deal_subhash'] = md5(xss_cleaner($_POST["addMDN"]) . time());
        $deal_list["deal_content"] = xss_cleaner($_POST["addContent_single"]);
        //deal_video
        $video_list['video_embed'] = $_POST["addDV_single"];
        $video_list['deal_hash'] = $view_list["deal_hash"];
        $video_list['deal_subhash'] = $deal_list['deal_subhash'];
        //deal_gallery
        if($_FILES["addMMC"]["name"] != '') {                                                  
            $deal_view_main = _upload_photo("addMMC",$path,'default.jpg','true','true','','150',$customsize);
           $gallery_list['gallery_filename'] = $deal_view_main;
           $gallery_list['gallery_main'] = 1;
        }
        $gallery_list['gallery_main'] = 2;
        $gallery_list['deal_hash'] = $view_list["deal_hash"];
        $gallery_list['deal_subhash'] = $deal_list['deal_subhash'];
        if($_POST["Oswitcher$i"] == 0) {
            $deal_list['deal_option'] = 0;
            //deal_selection & deal_option
            $s_count = xss_cleaner($_POST["nSELECTION_single"]);
            $o_count = xss_cleaner($_POST["nOPTION_single$s_count"]);
            If($this->db->escape_str($_POST["addDselect_single$s_count"]) != "") {
                for($i1=1;$i1<=$s_count;$i1++) {
                    $select_list['selection_name'] = xss_cleaner($_POST["addDselect_single$i1"]);
                    $select_list['selection_hash'] = md5(xss_cleaner($_POST["addDselect_single$i1"]) . time());
                    $select_list['deal_hash'] = $view_list['deal_hash'];
                    $select_list['deal_subhash'] = $deal_list['deal_subhash'];
                    for($i2=1;$i2<=$o_count;$i2++) {
                        $option_list['option_name'] = xss_cleaner($_POST["addDoption_single" . $i1 . "_". $i2]);
                        $option_list['selection_hash'] = $select_list['selection_hash'];
                        $option_list['deal_hash'] = $view_list['deal_hash'];
                        $this->Deals_Option_Model->save_option($table5, $option_list);
                    }
                    $this->Deals_Selection_Model->save_select($table4, $select_list);
                }
            }
        }
        else {
            $deal_list['deal_option'] = 1;
            $deal_list['deal_original_stock'] = xss_cleaner($_POST["addStock$i"]);
            $deal_list['deal_current_stock'] = xss_cleaner($_POST["addStock$i"]);
        }
        //deal_highlight
        $h_count = $this->db->escape_str($_POST["nH_single"]);
        for($i3=1;$i3<=$h_count;$i3++) {
            $highlight_list["highlight_content"] = xss_cleaner($_POST["addH_single$i3"]);
            $highlight_list['deal_hash'] = $view_list['deal_hash'];
            $highlight_list['deal_subhash'] = $deal_list['deal_subhash'];
            $this->Deals_Highlight_Model->save_highlight($table6, $highlight_list);
        }
        //deal_term
        $t_count = $this->db->escape_str($_POST["nT_single"]);
        for($i4=1;$i4<=$t_count;$i4++) {
            $term_list["fineprint_content"] = xss_cleaner($_POST["addT_single$i4"]);
            $term_list['deal_hash'] = $view_list['deal_hash'];
            $term_list['deal_subhash'] = $deal_list['deal_subhash'];
            $this->Deals_Term_Model->save_term($table7, $term_list);
        }
        $this->Deals_Video_Model->save_video($table0, $video_list);
        $this->Deals_Model->save_group_deal($table2, $deal_list);
        $this->Deals_Gallery_Model->save_gallery($table3, $gallery_list);
        $sql = $this->Deals_Model->displaySelected($table2, $view_list);
        foreach($sql as $row) { $deal_view_title = $row->deal_view_title; }
        //audit_trail start
        $insert = audit_trail("Save", "Deals Maintenance", "Add New Sub Deal", "<span id=\"green\">" . $deal_view_title . "</span><br>" . $deal_list['deal_title'], $this->session->userdata('user_id'));
        $this->Audit_Trail_Model->save_audit("audit_trail", $insert);
        //audit_trail end
        redirect(base_url() . "admin/admin_deals/edit_group_deal/" . $this->uri->segment(4) . "/" . $this->uri->segment(5));
    }
    function update_single_deal() {
        $table1 = "deal_view";
        $table2 = "deals";
        $table3 = "deal_gallery";
        $table4 = "deal_selection";
        $table5 = "deal_option";
        $table6 = "deal_highlight";
        $table7 = "deal_fineprint";
        $table8 = "deal_location";
        $table9 = "companies";
        //tables general where start
        $deal_where['deal_hash'] = $this->uri->segment(5);
        //tables general where end
        //deal_view                                                         
        $view_list["deal_view_title"] = xss_cleaner($_POST["editMDN"]);
        $view_list["deal_view_statement"] = xss_cleaner($_POST["editMDS"]);
        $view_list['deal_view_start'] = strtotime(xss_cleaner($_POST["editSOD"]));
        $view_list['deal_view_end'] = strtotime(xss_cleaner($_POST["editEOD"]));
        $view_list['deal_view_due'] = strtotime(xss_cleaner($_POST["editEOD"]) . "+ 15 days");
        $view_list['category_id'] = xss_cleaner($_POST["editDC"]);
        $view_list['company_id'] = xss_cleaner($_POST["editDCO"]);
        //deal
        $deal_list["deal_title"] = xss_cleaner($_POST["editMDN"]);
        $deal_list["deal_statement"] = xss_cleaner($_POST["editMDS"]);
        $deal_list['deal_original_price'] = xss_cleaner($_POST["editOP"]);
        $deal_list['deal_discount'] = xss_cleaner($_POST["editD"]);
        $deal_list['deal_discounted_price'] = xss_cleaner($_POST["editDP"]);
        if($this->uri->segment(6) == 1) {
            $deal_list['deal_original_stock'] = xss_cleaner($_POST["editOStock"]); 
            $deal_list['deal_current_stock'] = xss_cleaner($_POST["editCStock"]);
        }
        else {
            $deal_list['deal_original_stock'] = 0; 
            $deal_list['deal_current_stock'] = 0;
        } 
        $deal_list['deal_content'] = $_POST["editContent_solo"];
        //deal_selection
        if($this->uri->segment(6) == 0) {
            $s_count_old = xss_cleaner($_POST["mSELECTION_solo"]);
            $s_count = xss_cleaner($_POST["nSELECTION_solo"]);
            $s_value = $s_count - $s_count_old; 
            if($s_count_old == $s_count) {
                for($i1=1;$i1<=$s_count-$s_value;$i1++) {
                    //start of selection_id decryption
                    $s_length = strlen(xss_cleaner($_POST["editDselect_hashA$i1"])); 
                    $s_character = xss_cleaner($_POST["editDselectNo$i1"]); 
                    $s_start = $s_length - $s_character;
                    $s_code = substr(xss_cleaner($_POST["editDselect_hashA$i1"]) , $s_start ,$s_character);
                    $selection_id = (($s_code)-8)/8;
                    //end of selection_id decryption
                    $select_where['selection_id'] = $selection_id;
                    $select_list['selection_name'] = xss_cleaner($_POST["editDselect_solo$i1"]);
                    //deal_option
                    $o_count_old = xss_cleaner($_POST["mOPTION_solo$s_count"]);
                    $o_count = xss_cleaner($_POST["nOPTION_solo$s_count"]);
                    $o_value = $o_count - $o_count_old;
                    for($i2=1;$i2<=$o_count-$o_value;$i2++) {
                        //start of option_id decryption
                        $o_length = strlen(xss_cleaner($_POST["editDoption_hash" . $i1 . "_" . $i2])); 
                        $o_character = xss_cleaner($_POST["editDoptionNo" . $i1 . "_" . $i2]); 
                        $o_start = $o_length - $o_character;
                        $o_code = substr(xss_cleaner($_POST["editDoption_hash" . $i1 . "_" . $i2]) , $o_start ,$o_character);
                        $option_id = (($o_code)-8)/8;
                        //end of option_id decryption 
                        $option_where['option_id'] = $option_id;                   
                        $option_list['option_name'] = xss_cleaner($_POST["editDoption_solo" . $i1 . "_". $i2]);
                        $option_list['deal_original_stock'] = xss_cleaner($_POST["editOStock_solo" . $i1 . "_". $i2]);
                        $option_list['deal_current_stock'] = xss_cleaner($_POST["editCStock_solo" . $i1 . "_". $i2]);
                        $this->Deals_Option_Model->update_option($table5, $deal_where, $option_where, $option_list);
                    }
                    //records additional input for option
                    for($i2=$o_count_old+1;$i2<=$o_count;$i2++) {
                        $option_list['option_name'] = xss_cleaner($_POST["editDoption_solo" . $i1 . "_". $i2]);
                        $option_list['deal_original_stock'] = xss_cleaner($_POST["editOStock_solo" . $i1 . "_". $i2]);
                        $option_list['deal_current_stock'] = $option_list['deal_original_stock'];
                        $option_list['selection_hash'] = xss_cleaner($_POST["editDselect_hashB$i1"]);
                        $option_list['deal_hash'] = $deal_where['deal_hash'];
                        $this->Deals_Option_Model->save_option($table5, $option_list);
                    } 
                    $this->Deals_Selection_Model->update_select($table4, $deal_where, $select_where, $select_list); 
                } 
            }
        }
        if($s_count_old < $s_count) {
            if($s_count_old == 0) {
                //records additional input for selection
                for($i1=1;$i1<=$s_count;$i1++) {
                    $select_list['selection_name'] = xss_cleaner($_POST["editDselect_solo$i1"]); 
                    $select_list['selection_hash'] = md5(xss_cleaner($_POST["editDselect_solo$i1"]) . time());
                    $select_list['deal_hash'] = $deal_where['deal_hash'];
                    $select_list['deal_subhash'] = xss_cleaner($_POST['editSubH']);
                    //deal_option 
                    $o_count_old = xss_cleaner($_POST["mOPTION_solo$s_count"]);
                    $o_count = xss_cleaner($_POST["nOPTION_solo$s_count"]);
                    for($i2=1;$i2<=$o_count;$i2++) {
                        $option_list['option_name'] = xss_cleaner($_POST["editDoption_solo" . $i1 . "_". $i2]);
                        $option_list['deal_original_stock'] = xss_cleaner($_POST["editOStock_solo" . $i1 . "_". $i2]);
                        $option_list['deal_current_stock'] = $option_list['deal_original_stock']; 
                        $option_list['selection_hash'] = $select_list['selection_hash'];
                        $option_list['deal_hash'] = $deal_where['deal_hash'];
                        $this->Deals_Option_Model->save_option($table5, $option_list);
                    }
                    $this->Deals_Selection_Model->save_select($table4, $select_list);
                }
            }
            else {
                //records additional input for selection
                for($i1=$s_count_old+1;$i1<=$s_count;$i1++) {
                    $select_list['selection_name'] = xss_cleaner($_POST["editDselect_solo$i1"]);
                    $select_list['selection_hash'] = md5(xss_cleaner($_POST["editDselect_solo$i1"]) . time());
                    $select_list['deal_hash'] = $deal_where['deal_hash'];
                    $select_list['deal_subhash'] = xss_cleaner($_POST['editSubH']);
                    //deal_option 
                    $o_count_old = xss_cleaner($_POST["mOPTION_solo$s_count"]);
                    $o_count = xss_cleaner($_POST["nOPTION_solo$s_count"]);
                    for($i2=1;$i2<=$o_count;$i2++) {
                        $option_list['option_name'] = xss_cleaner($_POST["editDoption_solo" . $i1 . "_". $i2]);
                        $option_list['deal_original_stock'] = xss_cleaner($_POST["editOStock_solo" . $i1 . "_". $i2]);
                        $option_list['deal_current_stock'] = $option_list['deal_original_stock'];
                        $option_list['selection_hash'] = $select_list['selection_hash'];
                        $option_list['deal_hash'] = $deal_where['deal_hash'];
                        $this->Deals_Option_Model->save_option($table5, $option_list);
                    }
                    $this->Deals_Selection_Model->save_select($table4, $select_list);
                }
            }
            
        }
        //deal_highlight
        $h_count_old = xss_cleaner($_POST["mH_solo"]);
        $h_count = xss_cleaner($_POST["nH_solo"]);
        $h_value = $h_count - $h_count_old;
        for($i3=1;$i3<=$h_count-$h_value;$i3++) {
            //start of highlight_id decryption
            $h_length = strlen(xss_cleaner($_POST["editH_hash$i3"])); 
            $h_character = xss_cleaner($_POST["editHNo$i3"]); 
            $h_start = $h_length - $h_character;
            $h_code = substr(xss_cleaner($_POST["editH_hash$i3"]) , $h_start ,$h_character);
            $highlight_id = (($h_code)-8)/8;
            //end of highlight_id decryption 
            $highlight_where['highlight_id'] = $highlight_id;
            $highlight_list["highlight_content"] = xss_cleaner($_POST["editH_solo$i3"]);
            $this->Deals_Highlight_Model->update_highlight($table6, $deal_where, $highlight_where, $highlight_list);
        }
        //records additional input for highlight
        for($i3=$h_count_old+1;$i3<=$h_count;$i3++) {
            $highlight_list["highlight_content"] = xss_cleaner($_POST["editH_solo$i3"]);
            $highlight_list['deal_hash'] = $deal_where['deal_hash'];
            $highlight_list['deal_subhash'] = xss_cleaner($_POST['editSubH']);
            $this->Deals_Highlight_Model->save_highlight($table6, $highlight_list);
        }
        //deal_fineprint
        $t_count_old = xss_cleaner($_POST["mT_solo"]);
        $t_count = xss_cleaner($_POST["nT_solo"]);
        $t_value = $t_count - $t_count_old;
        for($i4=1;$i4<=$t_count-$t_value;$i4++) {
            //start of fineprint_id decryption
            $t_length = strlen(xss_cleaner($_POST["editT_hash$i4"])); 
            $t_character = xss_cleaner($_POST["editTNo$i4"]); 
            $t_start = $t_length - $t_character;
            $t_code = substr(xss_cleaner($_POST["editT_hash$i4"]) , $t_start ,$t_character);
            $term_id = (($t_code)-8)/8;
            //end of fineprint_id decryption 
            $term_where['fineprint_id'] = $term_id;
            $term_list["fineprint_content"] = xss_cleaner($_POST["editT_solo$i4"]);
            $this->Deals_Term_Model->update_term($table7,$deal_where, $term_where, $term_list);
        }
        //records additional input for fineprint 
        for($i4=$t_count_old+1;$i4<=$t_count;$i4++) {
            $term_list["fineprint_content"] = xss_cleaner($_POST["editT_solo$i4"]);
            $term_list['deal_hash'] = $deal_where['deal_hash'];
            $term_list['deal_subhash'] = xss_cleaner($_POST['editSubH']);
            $this->Deals_Term_Model->save_term($table7, $term_list); 
        }
        $this->Deals_View_Model->update_view($table1, $deal_where, $view_list);
        $this->Deals_Model->update_deal($table2, $deal_where, $deal_list);
        //audit_trail start
        $insert = audit_trail("Update", "Deals Maintenance", "Edit Deal", $view_list['deal_view_title'], $this->session->userdata('user_id'));
        $this->Audit_Trail_Model->save_audit("audit_trail", $insert);
        //audit_trail end
        redirect(base_url() . "admin/admin_deals/index/current");   
    }
    function update_group_deal() {
        $table1 = "deal_view";
        $table2 = "deals";
        $table3 = "deal_gallery";
        $table4 = "deal_selection";
        $table5 = "deal_option";
        $table6 = "deal_highlight";
        $table7 = "deal_fineprint";
        $table8 = "deal_location";
        $table9 = "companies";
        //tables general where start
        $deal_where['deal_subhash'] = $this->uri->segment(5);
        $deal_mainHash['deal_hash'] = xss_cleaner($_POST["editEncryptedHash"]);
        //tables general where end
        //deal
        $deal_list["deal_title"] = xss_cleaner($_POST["editMDN"]);
        $deal_list["deal_statement"] = xss_cleaner($this->input->post("editMDS"));
        $deal_list['deal_original_price'] = xss_cleaner($_POST["editOP"]);
        $deal_list['deal_discount'] = xss_cleaner($_POST["editD"]);
        $deal_list['deal_discounted_price'] = xss_cleaner($_POST["editDP"]);
        if($this->uri->segment(6) == 1) {
            $deal_list['deal_original_stock'] = xss_cleaner($_POST["editOStock"]); 
            $deal_list['deal_current_stock'] = xss_cleaner($_POST["editCStock"]);
        }
        else {
            $deal_list['deal_original_stock'] = 0; 
            $deal_list['deal_current_stock'] = 0;
        }
        $deal_list['deal_content'] = xss_cleaner($_POST["editContent_solo"]);
        //deal_selection
        if($this->uri->segment(6) == 0) {
            $s_count_old = xss_cleaner($_POST["mSELECTION_solo"]);
            $s_count = xss_cleaner($_POST["nSELECTION_solo"]);
            $s_value = $s_count - $s_count_old; 
            if($s_count_old == $s_count) {                     
                for($i1=1;$i1<=$s_count-$s_value;$i1++) {
                    //start of selection_id decryption
                    $s_length = strlen(xss_cleaner($_POST["editDselect_hashA$i1"])); 
                    $s_character = xss_cleaner($_POST["editDselectNo$i1"]); 
                    $s_start = $s_length - $s_character;
                    $s_code = substr(xss_cleaner($_POST["editDselect_hashA$i1"]) , $s_start ,$s_character);
                    $selection_id = (($s_code)-8)/8;
                    //end of selection_id decryption
                    $select_where['selection_id'] = $selection_id;
                    $select_list['selection_name'] = xss_cleaner($_POST["editDselect_solo$i1"]);
                    //deal_option
                    $o_count_old = xss_cleaner($_POST["mOPTION_solo$s_count"]);
                    $o_count = xss_cleaner($_POST["nOPTION_solo$s_count"]);
                    $o_value = $o_count - $o_count_old;
                    for($i2=1;$i2<=$o_count-$o_value;$i2++) {
                        //start of option_id decryption
                        $o_length = strlen(xss_cleaner($_POST["editDoption_hash" . $i1 . "_" . $i2])); 
                        $o_character = xss_cleaner($_POST["editDoptionNo" . $i1 . "_" . $i2]); 
                        $o_start = $o_length - $o_character;
                        $o_code = substr(xss_cleaner($_POST["editDoption_hash" . $i1 . "_" . $i2]) , $o_start ,$o_character);
                        $option_id = (($o_code)-8)/8;
                        //end of option_id decryption 
                        $option_where['option_id'] = $option_id;                   
                        $option_list['option_name'] = xss_cleaner($_POST["editDoption_solo" . $i1 . "_". $i2]);
                        $option_list['deal_original_stock'] = xss_cleaner($_POST["editOStock_solo" . $i1 . "_". $i2]);
                        $option_list['deal_current_stock'] =xss_cleaner($_POST["editCStock_solo" . $i1 . "_". $i2]);
                        $this->Deals_Option_Model->update_option($table5, $deal_mainHash, $option_where, $option_list);
                    }
                    //records additional input for option
                    for($i2=$o_count_old+1;$i2<=$o_count;$i2++) {
                        $option_list['option_name'] = xss_cleaner($_POST["editDoption_solo" . $i1 . "_". $i2]);
                        $option_list['deal_original_stock'] = xss_cleaner($_POST["editOStock_solo" . $i1 . "_". $i2]);
                        $option_list['deal_current_stock'] = $option_list['deal_original_stock'];
                        $option_list['selection_hash'] = xss_cleaner($_POST["editDselect_hashB$i1"]);
                        $option_list['deal_hash'] = $deal_mainHash['deal_hash'];
                        $this->Deals_Option_Model->save_option($table5, $option_list);
                    }
                    $this->Deals_Selection_Model->update_select($table4, $deal_where, $select_where, $select_list);
                } 
            }
        }
        if($s_count_old < $s_count) {
            if($s_count_old == 0) {
                //records additional input for selection
                for($i1=1;$i1<=$s_count;$i1++) {
                    $select_list['selection_name'] = xss_cleaner($_POST["editDselect_solo$i1"]);
                    $select_list['selection_hash'] = md5(xss_cleaner($_POST["editDselect_solo$i1"]) . time());
                    $select_list['deal_hash'] = $deal_mainHash['deal_hash'];
                    $select_list['deal_subhash'] = $deal_where['deal_subhash'];
                    //deal_option 
                    $o_count_old = xss_cleaner($_POST["mOPTION_solo$s_count"]);
                    $o_count = xss_cleaner($_POST["nOPTION_solo$s_count"]);
                    for($i2=1;$i2<=$o_count;$i2++) {
                        $option_list['option_name'] = xss_cleaner($_POST["editDoption_solo" . $i1 . "_". $i2]);
                        $option_list['deal_original_stock'] =xss_cleaner($_POST["editOStock_solo" . $i1 . "_". $i2]);
                        $option_list['deal_current_stock'] = $option_list['deal_original_stock']; 
                        $option_list['selection_hash'] = $select_list['selection_hash'];
                        $option_list['deal_hash'] = $deal_mainHash['deal_hash'];
                        $this->Deals_Option_Model->save_option($table5, $option_list);
                    }
                    $this->Deals_Selection_Model->save_select($table4, $select_list);
                }
            }
            else {
                //records additional input for selection
                for($i1=$s_count_old+1;$i1<=$s_count;$i1++) {
                    $select_list['selection_name'] = xss_cleaner($_POST["editDselect_solo$i1"]);
                    $select_list['selection_hash'] = md5(xss_cleaner($_POST["editDselect_solo$i1"]) . time());
                    $select_list['deal_hash'] = $deal_mainHash['deal_hash'];
                    $select_list['deal_subhash'] = $deal_where['deal_subhash'];
                    //deal_option 
                    $o_count_old = xss_cleaner($_POST["mOPTION_solo$s_count"]);
                    $o_count = xss_cleaner($_POST["nOPTION_solo$s_count"]);
                    for($i2=1;$i2<=$o_count;$i2++) {
                        $option_list['option_name'] = xss_cleaner($_POST["editDoption_solo" . $i1 . "_". $i2]);
                        $option_list['deal_original_stock'] = xss_cleaner($_POST["editOStock_solo" . $i1 . "_". $i2]);
                        $option_list['deal_current_stock'] = $option_list['deal_original_stock'];
                        $option_list['selection_hash'] = $select_list['selection_hash'];
                        $option_list['deal_hash'] = $deal_mainHash['deal_hash'];
                        $this->Deals_Option_Model->save_option($table5, $option_list);
                    }
                    $this->Deals_Selection_Model->save_select($table4, $select_list);
                }
            }
            
        }
        //deal_highlight
        $h_count_old = xss_cleaner($_POST["mH_solo"]);
        $h_count = xss_cleaner($_POST["nH_solo"]);
        $h_value = $h_count - $h_count_old;
        for($i3=1;$i3<=$h_count-$h_value;$i3++) {
            //start of highlight_id decryption
            $h_length = strlen(xss_cleaner($_POST["editH_hash$i3"])); 
            $h_character = xss_cleaner($_POST["editHNo$i3"]); 
            $h_start = $h_length - $h_character;
            $h_code = substr(xss_cleaner($_POST["editH_hash$i3"]) , $h_start ,$h_character);
            $highlight_id = (($h_code)-8)/8;
            //end of highlight_id decryption 
            $highlight_where['highlight_id'] = $highlight_id;
            $highlight_list["highlight_content"] = xss_cleaner($_POST["editH_solo$i3"]);
            $this->Deals_Highlight_Model->update_highlight($table6, $deal_mainHash, $highlight_where, $highlight_list);
        }
        //records additional input for highlight
        for($i3=$h_count_old+1;$i3<=$h_count;$i3++) {
            $highlight_list["highlight_content"] = xss_cleaner($_POST["editH_solo$i3"]);
            $highlight_list['deal_hash'] = $deal_mainHash['deal_hash'];
            $highlight_list['deal_subhash'] = $deal_where['deal_subhash'];
            $this->Deals_Highlight_Model->save_highlight($table6, $highlight_list);
        }
        //deal_fineprint
        $t_count_old = xss_cleaner($_POST["mT_solo"]);
        $t_count = xss_cleaner($_POST["nT_solo"]);
        $t_value = $t_count - $t_count_old;
        for($i4=1;$i4<=$t_count-$t_value;$i4++) {
            //start of fineprint_id decryption
            $t_length = strlen(xss_cleaner($_POST["editT_hash$i4"])); 
            $t_character = xss_cleaner($_POST["editTNo$i4"]); 
            $t_start = $t_length - $t_character;
            $t_code = substr(xss_cleaner($_POST["editT_hash$i4"]) , $t_start ,$t_character);
            $term_id = (($t_code)-8)/8;
            //end of fineprint_id decryption 
            $term_where['fineprint_id'] = $term_id;
            $term_list["fineprint_content"] = xss_cleaner($_POST["editT_solo$i4"]);
            $this->Deals_Term_Model->update_term($table7, $deal_mainHash, $term_where, $term_list);
        }
        //records additional input for fineprint
        for($i4=$t_count_old+1;$i4<=$t_count;$i4++) {
            $term_list["fineprint_content"] = xss_cleaner($_POST["editT_solo$i4"]);
            $term_list['deal_hash'] = $deal_mainHash['deal_hash'];
            $term_list['deal_subhash'] = $deal_where['deal_subhash'];
            $this->Deals_Term_Model->save_term($table7, $term_list);
        }
        $this->Deals_Model->update_deal($table2, $deal_where, $deal_list);
        $sql = $this->Deals_Model->displaySelected($table2, $deal_mainHash);
        foreach($sql as $row) { $deal_view_title = $row->deal_view_title; }
        //audit_trail start
        $insert = audit_trail("Update", "Deals Maintenance", "Update Sub Deal", "<span id=\"green\">" . $deal_view_title . "</span><br>" . $deal_list['deal_title'], $this->session->userdata('user_id'));
        $this->Audit_Trail_Model->save_audit("audit_trail", $insert);
        //audit_trail end
        redirect(base_url() . "admin/admin_deals/edit_group_deal/" . $this->uri->segment(4) . "/" . $deal_mainHash['deal_hash']);
    }
    function update_Maingroup_deal() {
        $table1 = "deal_view";
        $table8 = "deal_location";
        //tables general where start
        $deal_where['deal_hash'] = $this->uri->segment(5);
        //deal_view
        $view_list["deal_view_title"] = xss_cleaner($_POST["editMDN"]);
        $view_list["deal_view_statement"] = xss_cleaner($_POST["editMDS"]);
        $view_list['deal_view_start'] = strtotime(xss_cleaner($_POST["editSOD"]));
        $view_list['deal_view_end'] = strtotime(xss_cleaner($_POST["editEOD"]));
        $view_list['deal_view_due'] = strtotime(xss_cleaner($_POST["editEOD"]) . "+ 15 days");
        $view_list['category_id'] = xss_cleaner($_POST["editDC"]);
        $view_list['company_id'] = xss_cleaner($_POST["editDCO"]);
        //deal_location
        $l_count_old = xss_cleaner($_POST["mLOCATION"]);
        $l_count = xss_cleaner($_POST["nLOCATION"]); 
        for($ix=1;$ix<=$l_count_old;$ix++) {
            //start of location_id decryption
            $l_length = strlen(xss_cleaner($_POST["editHash$ix"])); 
            $l_character = xss_cleaner($_POST["editLinkNo$ix"]); 
            $l_start = $l_length - $l_character;
            $l_code = substr(xss_cleaner($_POST["editHash$ix"]) , $l_start ,$l_character);
            $location_id = (($l_code)-8)/8;
            //end of location_id decryption
            $location_where['location_id'] = $location_id;
            $location_list['location_address'] = xss_cleaner($_POST["editLocation$ix"]);
            $location_list['location_link'] = xss_cleaner($_POST["editLink$ix"]); 
            $this->Deals_Location_Model->update_location($table8, $deal_where, $location_where, $location_list);
        }
        //records additional input for lcoation
        for($jx=$l_count_old+1;$jx<=$l_count;$jx++) {
            $location_list['location_address'] = xss_cleaner($_POST["editLocation$jx"]);
            $location_list['location_link'] = xss_cleaner($_POST["editLink$jx"]);
            $location_list['deal_hash'] = $deal_where['deal_hash'];
            $this->Deals_Location_Model->save_location($table8, $location_list);
        }
        $this->Deals_View_Model->update_view($table1, $deal_where, $view_list);
        //audit_trail start
        $insert = audit_trail("Update", "Deals Maintenance", "Edit Deal", $view_list['deal_view_title'], $this->session->userdata('user_id'));
        $this->Audit_Trail_Model->save_audit("audit_trail", $insert);
        //audit_trail end
        redirect(base_url() . "admin/admin_deals/edit_group_deal/" . $this->uri->segment(4) . "/" . $this->uri->segment(5));
    }
    function resave_single_deal() {
        $table0 = "deal_video"; 
        $table1 = "deal_view";
        $table2 = "deals";
        $table3 = "deal_gallery";
        $table4 = "deal_selection";
        $table5 = "deal_option";
        $table6 = "deal_highlight";
        $table7 = "deal_fineprint";
        $table8 = "deal_location";
        $table9 = "companies";
        $customsize = array('height'=>'260','width'=>'105');
        $path = "assets/general/images/deals_gallery/";
        //deal_view-----------------
        $view_list['deal_view_type'] = xss_cleaner($_POST["addDT"]);
        $view_list["deal_view_title"] = xss_cleaner($_POST["addMDN"]);
        $view_list["deal_view_statement"] = xss_cleaner($_POST["addMDS"]);
        $view_list['deal_hash'] = md5(xss_cleaner($_POST["addMDN"]) . time());
        $view_list['deal_view_start'] = strtotime(xss_cleaner($_POST["addSOD"]));
        $view_list['deal_view_end'] = strtotime(xss_cleaner($_POST["addEOD"]));
        $view_list['deal_view_due'] = strtotime(xss_cleaner($_POST["addEOD"]) . "+ 15 days");
        $view_list['category_id'] = xss_cleaner($_POST["addDC"]);
        $view_list['company_id'] = xss_cleaner($_POST["addDCO"]);
        $deal_where['deal_hash'] = $this->uri->segment(5);
        $view_list_old['deal_renewed'] = 1; 
        //deal-----------------
        $deal_list['deal_original_price'] = xss_cleaner($_POST["addOP"]);
        $deal_list['deal_discount'] = xss_cleaner($_POST["addD"]);
        $deal_list['deal_discounted_price'] = xss_cleaner($_POST["addDP"]);
        $deal_list['deal_option'] = xss_cleaner($_POST["addOPT"]);
        if($this->db->escape_str($_POST["addOPT"]) == 1) {
            $deal_list['deal_original_stock'] = xss_cleaner($_POST["addCStock"]);
            $deal_list['deal_current_stock'] = xss_cleaner($_POST["addCStock"]);
        }
        $deal_list['deal_hash'] = $view_list['deal_hash'];
        $deal_list['deal_subhash'] = md5(xss_cleaner($_POST["addMDN"]) . time());
        $deal_list["deal_title"] = xss_cleaner($_POST["addMDN"]);//reads main title
        $deal_list["deal_statement"] = xss_cleaner($_POST["addMDS"]);//reads main statement
        $deal_list["deal_content"] = xss_cleaner($_POST["addContent_single"]);
        $deal_list['deal_select'] = 1;
        //deal_video
        $video_list['video_embed'] = $_POST["addDV_single"];
        $video_list['deal_hash'] = $view_list['deal_hash'];
        $video_list['deal_subhash'] = $deal_list['deal_subhash'];
        //photo copy start
        $sql = $this->Deals_Gallery_Model->displaySelectedGallery($table3, $deal_where);
        foreach($sql as $row) {
            //deal_gallery-----------------
            $gallery_list['deal_hash'] = $view_list['deal_hash'];
            $gallery_list['deal_subhash'] = $deal_list['deal_subhash'];
            $gallery_list['gallery_filename'] = time()+1 . rand(10000,99999) .  ".jpg";
            $gallery_list['gallery_main'] = $row->gallery_main;
            if($row->gallery_main == 1) { $view_list['deal_image'] = $gallery_list['gallery_filename']; }
            $gallery_old = $row->gallery_filename;
            //deal_galelry
            $old1 = $path . "customize/$gallery_old"; $new1 = $path . "customize/" . $gallery_list['gallery_filename'];
            $old2 = $path . "optimize/$gallery_old"; $new2 = $path . "optimize/" . $gallery_list['gallery_filename'];
            $old3 = $path . "thumbnail/$gallery_old"; $new3 = $path . "thumbnail/" . $gallery_list['gallery_filename']; 
            copy($old1, $new1); copy($old2, $new2); copy($old3, $new3);
            
            $this->Deals_Gallery_Model->save_gallery($table3, $gallery_list); 
        }
        //photo copy end
        if($_POST["addOPT"] == 0) {
            //deal_selection & deal_option
            $s_count = xss_cleaner($_POST["nSELECTION_single"]);
            $o_count = xss_cleaner($_POST["nOPTION_single$s_count"]);
            If($_POST["addDselect_single$s_count"] != "") {
                for($i1=1;$i1<=$s_count;$i1++) {
                    $select_list['selection_name'] = xss_cleaner($_POST["addDselect_single$i1"]);
                    $select_list['selection_hash'] = md5(xss_cleaner($_POST["addDselect_single$i1"]) . time());
                    $select_list['deal_hash'] = $view_list['deal_hash'];
                    $select_list['deal_subhash'] = $deal_list['deal_subhash'];
                    for($i2=1;$i2<=$o_count;$i2++) {
                        $option_list['option_name'] = xss_cleaner($_POST["addDoption_single" . $i1 . "_". $i2]);
                        $option_list['deal_original_stock'] = xss_cleaner($_POST["addStock_single" . $i1 . "_". $i2]);
                        $option_list['deal_current_stock'] = xss_cleaner($_POST["addStock_single" . $i1 . "_". $i2]);
                        $option_list['selection_hash'] = $select_list['selection_hash'];
                        $option_list['deal_hash'] = $view_list['deal_hash'];
                        $this->Deals_Option_Model->save_option($table5, $option_list);
                    }
                    $this->Deals_Selection_Model->save_select($table4, $select_list);
                }
            }
        }
        //deal_highlight
        $h_count = xss_cleaner($_POST["nH_single"]);
        for($i3=1;$i3<=$h_count;$i3++) {
            $highlight_list["highlight_content"] = xss_cleaner($_POST["addH_single$i3"]);
            $highlight_list['deal_hash'] = $view_list['deal_hash'];
            $highlight_list['deal_subhash'] = $deal_list['deal_subhash'];
            $this->Deals_Highlight_Model->save_highlight($table6, $highlight_list);
        }
        //deal_term
        $t_count = xss_cleaner($_POST["nT_single"]);
        for($i4=1;$i4<=$t_count;$i4++) {
            $term_list["fineprint_content"] = xss_cleaner($_POST["addT_single$i4"]);
            $term_list['deal_hash'] = $view_list['deal_hash'];
            $term_list['deal_subhash'] = $deal_list['deal_subhash'];
            $this->Deals_Term_Model->save_term($table7, $term_list);
        }
        $l_count = xss_cleaner($_POST["nLOCATION"]);
        for($ix=1;$ix<=$l_count;$ix++) {
            $location_list['location_address'] = xss_cleaner($_POST["addLocation$ix"]);
            $location_list['location_link'] = xss_cleaner($_POST["addLink$ix"]);
            $location_list['deal_hash'] = $view_list['deal_hash'];
            $this->Deals_Location_Model->save_location($table8, $location_list);
        }
        $this->Deals_Video_Model->save_video($table0, $video_list);
        $this->Deals_Model->save_single_deal($table2, $deal_list);
        $this->Deals_View_Model->save_view($table1, $view_list);
        $this->Deals_View_Model->update_view($table1, $deal_where, $view_list_old);
        //audit_trail start
        $insert = audit_trail("Renew", "Deals Maintenance", "Renew Deal", $view_list['deal_view_title'], $this->session->userdata('user_id'));
        $this->Audit_Trail_Model->save_audit("audit_trail", $insert);
        //audit_trail end
        redirect(base_url() . "admin/admin_deals/index/current");
    }
    function resave_group_deal() {
        $table0 = "deal_video"; 
        $table1 = "deal_view";
        $table2 = "deals";
        $table3 = "deal_gallery";
        $table4 = "deal_selection";
        $table5 = "deal_option";
        $table6 = "deal_highlight";
        $table7 = "deal_fineprint";
        $table8 = "deal_location";
        $table9 = "companies";
        $customsize = array('height'=>'260','width'=>'105');
        $path = "assets/general/images/deals_gallery/";
        //deal_view-----------------
        $view_list['deal_view_type'] = xss_cleaner($_POST["addDT"]);
        $view_list["deal_view_title"] = xss_cleaner($_POST["addMDN"]);
        $view_list["deal_view_statement"] = xss_cleaner($_POST["addMDS"]);
        $view_list['deal_hash'] = md5(xss_cleaner($_POST["addMDN"]) . time());
        $view_list['deal_view_start'] = strtotime(xss_cleaner($_POST["addSOD"]));
        $view_list['deal_view_end'] = strtotime(xss_cleaner($_POST["addEOD"])); 
        $view_list['deal_view_due'] = strtotime(xss_cleaner($_POST["addEOD"]) . "+ 15 days");                                               
        $view_list['deal_image'] = time() . rand(10000,99999) .  ".jpg";
        $view_list['category_id'] = xss_cleaner($_POST["addDC"]);
        $view_list['company_id'] = xss_cleaner($_POST["addDCO"]);
        $deal_where['deal_hash'] = $this->uri->segment(5);
        $view_list_old['deal_renewed'] = 1;
        //deal_gallery
        $gallery_list['gallery_main'] = 0;
        $gallery_list['deal_hash'] = $view_list['deal_hash'];
        //photo copy start
        $sql1 = $this->Deals_View_Model->displaySelected($table1, $deal_where);
        foreach($sql1 as $row1) { $deal_image_old = $row1->deal_image; }
        $old1 = $path . "customize/$deal_image_old"; $new1 = $path . "customize/" . $view_list['deal_image'];
        $old2 = $path . "optimize/$deal_image_old"; $new2 = $path . "optimize/" . $view_list['deal_image'];
        $old3 = $path . "thumbnail/$deal_image_old"; $new3 = $path . "thumbnail/" . $view_list['deal_image'];
        copy($old1, $new1); copy($old2, $new2); copy($old3, $new3);
        //photo copy end
        for($i=1;$i<xss_cleaner($_POST["nDEAL"])+1;$i++) {
            //deal-----------------
            $deal_list['deal_original_price'] = xss_cleaner($_POST["addOP$i"]);
            $deal_list['deal_discount'] = xss_cleaner($_POST["addD$i"]);
            $deal_list['deal_discounted_price'] = xss_cleaner($_POST["addDP$i"]);
            $deal_list['deal_option'] = xss_cleaner($_POST["addOPT$i"]);
            if(xss_cleaner($_POST["addOPT$i"]) == 1) {
                $deal_list['deal_original_stock'] = xss_cleaner($_POST["addCStock$i"]);
                $deal_list['deal_current_stock'] = xss_cleaner($_POST["addCStock$i"]);
            }
            $deal_list['deal_hash'] = $view_list['deal_hash'];
            $deal_list['deal_subhash'] = md5(xss_cleaner($_POST["addDN$i"]) . time());
            $deal_list["deal_title"] = xss_cleaner($_POST["addDN$i"]);//reads sub title
            $deal_list["deal_statement"] = xss_cleaner($_POST["addDS$i"]);//reads sub statement
            $deal_list["deal_content"] = xss_cleaner($_POST["addContent_group$i"]);
            if($i==1) { $deal_list['deal_select'] = 1; }
            else { $deal_list['deal_select'] = 0; }
            //deal_video
            $video_list['video_embed'] = $_POST["addDV_group$i"];
            $video_list['deal_hash'] = $view_list['deal_hash'];
            $video_list['deal_subhash'] = $deal_list['deal_subhash'];
            //deal_gallery
            $gallery_old = $_POST["addMC_old$i"];
            $gallery_list['deal_subhash'] = $deal_list['deal_subhash'];
            $gallery_list['gallery_filename'] = xss_cleaner($_POST["addMC$i"]);
            $gallery_list['gallery_main'] = 2;
            //photo copy start
            //deal_gallery        
            $old1 = $path . "customize/$gallery_old"; $new1 = $path . "customize/" . $gallery_list['gallery_filename'];
            copy($old2, $new2);
            $old2 = $path . "optimize/$gallery_old"; $new2 = $path . "optimize/" . $gallery_list['gallery_filename'];
            copy($old2, $new2);
            $old3 = $path . "thumbnail/$gallery_old"; $new3 = $path . "thumbnail/" . $gallery_list['gallery_filename'];
            copy($old1, $new1); copy($old2, $new2); copy($old3, $new3);
            //photo copy end 
            if($_POST["addOPT$i"] == 0) {
                //deal_selection & deal_option
                $s_count = xss_cleaner($_POST["nSELECTION_group$i"]);
                if($s_count != 0) {
                    $o_count = xss_cleaner($_POST["nOPTION_group" . $i . "_" . $s_count]);
                    If($_POST["addDselect_group" . $i . "_". $s_count] != "") {
                        for($i1=1;$i1<=$s_count;$i1++) {
                            $select_list['selection_name'] = xss_cleaner($_POST["addDselect_group" . $i . "_" . $i1]);
                            //i choose $i for selection subhas incase the name is thesame
                            $select_list['selection_hash'] = md5($i . "" . time());
                            $select_list['deal_hash'] = $view_list['deal_hash'];              
                            $select_list['deal_subhash'] = $deal_list['deal_subhash'];
                            for($i2=1;$i2<=$o_count;$i2++) {
                                $option_list['option_name'] = xss_cleaner($_POST["addDoption_group" . $i . "_" . $i1 . "_". $i2]);
                                $option_list['deal_original_stock'] = xss_cleaner($_POST["addStock_group" . $i . "_" . $i1 . "_". $i2]);
                                $option_list['deal_current_stock'] = xss_cleaner($_POST["addStock_group" . $i . "_" . $i1 . "_". $i2]);
                                $option_list['selection_hash'] = $select_list['selection_hash'];
                                $option_list['deal_hash'] = $view_list['deal_hash'];
                                $this->Deals_Option_Model->save_option($table5, $option_list);
                            }
                            $this->Deals_Selection_Model->save_select($table4, $select_list);
                        }
                    }
                }
            }
            //deal_highlight
            $h_count = xss_cleaner($_POST["nH_group$i"]);
            for($i3=1;$i3<=$h_count;$i3++) {
                $highlight_list["highlight_content"] = xss_cleaner($_POST["addH_group" . $i . "_". $i3]);
                $highlight_list['deal_hash'] = $view_list['deal_hash'];
                $highlight_list['deal_subhash'] = $deal_list['deal_subhash'];
                $this->Deals_Highlight_Model->save_highlight($table6, $highlight_list);
            }
            //deal_term
            $t_count = xss_cleaner($_POST["nT_group$i"]);
            for($i4=1;$i4<=$t_count;$i4++) {
                $term_list["fineprint_content"] = xss_cleaner($_POST["addT_group" . $i . "_". $i4]);
                $term_list['deal_hash'] = $view_list['deal_hash'];
                $term_list['deal_subhash'] = $deal_list['deal_subhash'];
                $this->Deals_Term_Model->save_term($table7, $term_list);
            }
            $this->Deals_Video_Model->save_video($table0, $video_list);
            $this->Deals_Model->save_single_deal($table2, $deal_list);
            $this->Deals_Gallery_Model->save_gallery($table3, $gallery_list);
        }  
        $l_count = xss_cleaner($_POST["nLOCATION"]);
        for($ix=1;$ix<=$l_count;$ix++) {
            $location_list['location_address'] = xss_cleaner($_POST["addLocation$ix"]);
            $location_list['location_link'] = xss_cleaner($_POST["addLink$ix"]);
            $location_list['deal_hash'] = $view_list['deal_hash'];
            $this->Deals_Location_Model->save_location($table8, $location_list);
        }
        $this->Deals_View_Model->save_view($table1, $view_list);
        $this->Deals_View_Model->update_view($table1, $deal_where, $view_list_old);
        //audit_trail start
        $insert = audit_trail("Renew", "Deals Maintenance", "Renew Deal", $view_list['deal_view_title'], $this->session->userdata('user_id'));
        $this->Audit_Trail_Model->save_audit("audit_trail", $insert);
        //audit_trail end
        redirect(base_url() . "admin/admin_deals/index/current");  
    }

    function delete_single_deal($multi = false, $user_hash = '') {
        $table0 = "deal_video";
        $table1 = "deal_view";
        $table2 = "deals";
        $table3 = "deal_gallery";
        $table4 = "deal_selection";
        $table5 = "deal_option";
        $table6 = "deal_highlight";
        $table7 = "deal_fineprint";
        $table8 = "deal_location";
        $path = "assets/general/images/deals_gallery/";
        $subhash_count = $this->uri->segment(6);
        $deal_type = str_replace("%20", " ", $this->uri->segment(4));
        //$deals_where is = $select_where, $option_where, $highlight_where, $term_where, $location_where of each tables' model
        $deal_where['deal_hash'] = ($multi)?$user_hash:$this->uri->segment(5);
        $sql1 = $this->db->get_where($table1, $deal_where);
        $sql2 = $this->db->get_where($table3, $deal_where);
        foreach($sql1->result() as $row1){ $filename1 = $row1->deal_image; }
        //deletes the images of a selected deal that was deleted
        if($deal_type=="Single Deal") {
            if($filename1 != "default.jpg") {
                //deal_view $ deal_gallery
                unlink($path . "customize/$filename1");
                unlink($path . "optimize/$filename1");
                unlink($path . "thumbnail/$filename1");
                //unlink($path . "$filename1");  
            } 
        }
        else {
            if($filename1 != "default.jpg") { 
                //deal_view
                unlink($path . "customize/$filename1");
                unlink($path . "optimize/$filename1");
                unlink($path . "thumbnail/$filename1");
                //unlink($path . "$filename1");       
            }
            foreach($sql2->result() as $row2) {
                $filename2 = $row2->gallery_filename;
                if($filename2 != "default.jpg") { 
                    //deal_gallery
                    unlink($path . "customize/$filename2");
                    unlink($path . "optimize/$filename2");
                    unlink($path . "thumbnail/$filename2");
                    //unlink($path . "$filename2");    
                }
            }
        }
        $sql =  $this->Deals_View_Model->displaySelected($table1, $deal_where); 
        foreach($sql as $row) { $deal_view_title = $row->deal_view_title; }
        //audit_trail start
        $insert = audit_trail("Delete", "Deals Maintenance", "Delete Deal", $deal_view_title, $this->session->userdata('user_id'));
        $this->Audit_Trail_Model->save_audit("audit_trail", $insert);
        //audit_trail end
        $this->Deals_Video_Model->delete_video($table0, $deal_where);
        $this->Deals_View_Model->delete_view($table1, $deal_where);
        $this->Deals_Model->delete_deal($table2, $deal_where);
        $this->Deals_Gallery_Model->delete_gallery($table3, $deal_where);
        $this->Deals_Selection_Model->delete_select($table4, $deal_where);
        $this->Deals_Option_Model->delete_option($table5, $deal_where);
        $this->Deals_Highlight_Model->delete_highlight($table6, $deal_where);
        $this->Deals_Term_Model->delete_term($table7, $deal_where);
        $this->Deals_Location_Model->delete_location($table8, $deal_where); 
        
        $redirect = ($multi === true)?'sex':redirect(base_url() . "admin/admin_deals/index/current");
    }

    function multi_delete_single_deal()
    {
        $user_hashes = $this->input->post('checkbox');
        
        if ($user_hashes == false) {
            redirect(base_url() . "admin/admin_deals/index/current");
        } else { 
            foreach ($user_hashes as $user) {
                $this->delete_single_deal(true, $user);
            }
            redirect(base_url() . "admin/admin_deals/index/current");
        }
    }

    function delete_group_deal() {
        $table1 = "deal_view";
        $table2 = "deals";
        $table3 = "deal_gallery";
        $table4 = "deal_selection";
        $table5 = "deal_option";
        $table6 = "deal_highlight";
        $table7 = "deal_fineprint";
        $table8 = "deal_location";
        $path = "assets/general/images/deals_gallery/";
        //$deals_where is = $select_where, $option_where, $highlight_where, $term_where of each tables' model
        $deal_where['deal_subhash'] = $this->uri->segment(5);
        $sql1 = $this->db->get_where($table2, $deal_where);
        $sql2 = $this->db->get_where($table3, $deal_where);
        $sql3 = $this->db->get_where($table4, $deal_where);
        foreach($sql1->result() as $row1) { $deal_option = $row1->deal_option; }
        foreach($sql2->result() as $row2) { $deal_mainHash['deal_hash'] = $row2->deal_hash; }
        foreach($sql3->result() as $row3) { $selection_hash['selection_hash'] = $row3->selection_hash; }
        foreach($sql2->result() as $row2) {
            $filename2 = $row2->gallery_filename;
            if($filename2 != "default.jpg") {
                //deal_galelry
                unlink($path . "customize/$filename2");
                unlink($path . "optimize/$filename2");
                unlink($path . "thumbnail/$filename2");
                unlink($path . "$filename2");
            }
        }
        $sql =  $this->Deals_Model->displaySelectedSubFull($table1, $table2, $deal_where['deal_subhash']); 
        foreach($sql as $row) { $deal_view_title = $row->deal_view_title; $deal_title = $row->deal_title; }
        //audit_trail start
        $insert = audit_trail("Delete", "Deals Maintenance", "Delete Sub Deal", "<span id=\"green\">" . $deal_view_title . "</pan><br>" . $deal_title, $this->session->userdata('user_id'));
        $this->Audit_Trail_Model->save_audit("audit_trail", $insert);
        //audit_trail end
        $this->Deals_Model->delete_deal($table2, $deal_where);
        $this->Deals_Gallery_Model->delete_gallery($table3, $deal_where);
        if($deal_option == 0) {
            $this->Deals_Selection_Model->delete_select($table4, $deal_where);
            $this->Deals_Option_Model->delete_option($table5, $selection_hash);
        }
        $this->Deals_Highlight_Model->delete_highlight($table6, $deal_where);
        $this->Deals_Term_Model->delete_term($table7, $deal_where); 
        redirect(base_url() . "admin/admin_deals/edit_group_deal/" . $this->uri->segment(4) . "/" . $deal_mainHash['deal_hash']);
    }
    
    /////////////////////////////////////////
    //added funtion for image manipulation//
    ///////////////////////////////////////
    function upload_temp_image()
    {
        $config['upload_path'] = FCPATH.'/assets/general/images/deals_gallery/temp/';
		$config['allowed_types'] = 'jpg';
        $config['max_size'] = 9999;
		$config['file_name'] = sha1(time().mt_rand());
        
        $this->load->library('upload', $config);
        $this->load->library('image_lib');
        
        if (!$this->upload->do_upload())
		{
            echo json_encode(array('error' => $this->upload->display_errors('', '')));
		}
		else
		{
            $img_properties = $this->upload->data();
            $img_web_path = base_url().'/assets/general/images/deals_gallery/temp/'.$img_properties['file_name'];

			$config2['image_library'] = 'gd2';
			$config2['source_image'] = $img_properties['full_path'];
			$config2['maintain_ratio'] = true;
			$config2['width'] = 800;
			$config2['height'] = 600;
			$config2['new_image'] = FCPATH.'/assets/general/images/deals_gallery/temp/';

			$this->image_lib->initialize($config2);
			
			$this->image_lib->resize();

			echo json_encode(array('path' => $img_web_path, 'file_name' => $img_properties['file_name'], 'error' => ""));
        }
    }
    
    function submit_crop()
	{
	   //cropping coords
        $file_name = $this->input->post('file_name', true);
        $x = $this->input->post('x', true);
        $y = $this->input->post('y', true);
        $tw = $this->input->post('tw', true);
        $th = $this->input->post('th', true);
        $w = $this->input->post('w', true);
        $h = $this->input->post('h', true);
        
		$jpeg_quality = 100;
	    $src = FCPATH.'/assets/general/images/deals_gallery/temp/'.$file_name;
	    $img_r = imagecreatefromjpeg($src);
	    $dst_r = imagecreatetruecolor($tw, $th);
        $cropped_filename = $file_name;
	 	$cropped_filename_path = FCPATH.'/assets/general/images/deals_gallery/cropped/'.$cropped_filename;
        $web_path = base_url().'/assets/general/images/deals_gallery/cropped/'.$cropped_filename;

	    imagecopyresampled($dst_r, $img_r, 0, 0, $x, $y, $tw, $th, $w, $h);
	    imagejpeg($dst_r, $cropped_filename_path, $jpeg_quality);

        //create thumb, optimize and customize(IDK library i created my own function)
        $this->image_save('thumbnail', $cropped_filename_path);
        $this->image_save('customize', $cropped_filename_path);
        $this->image_save('optimize', $cropped_filename_path);
        
        //remove original file
        @unlink($src);
        
        //remove other images on temp folder, ignore errors
        foreach(glob(FCPATH.'/assets/general/images/deals_gallery/temp/*.jpg') as $file_to_delete) 
        {
            @unlink(FCPATH.'/assets/general/images/deals_gallery/temp/'.$file_to_delete);
        }
        
        //output
        echo json_encode(array('path' => $web_path, 'file_name' => $cropped_filename));
	}
    
    function image_save($type, $img_src)
    {
        $this->load->library('image_lib');
        $config['image_library'] = 'gd2';
		$config['source_image'] = $img_src;
		$config['maintain_ratio'] = true;
        
        switch ($type)
        {
            case 'thumbnail':
                $config['width'] = 150;
                $config['height'] = 52;
                $config['new_image'] = FCPATH.'/assets/general/images/deals_gallery/thumbnail/';
                $this->image_lib->initialize($config);
                $this->image_lib->resize();
                break;
            case 'customize':
                $config['width'] = 260;
                $config['height'] = 105;
                $config['new_image'] =  FCPATH.'/assets/general/images/deals_gallery/customize/';
                $this->image_lib->initialize($config);
                $this->image_lib->resize();
                break;
            case 'optimize':
                $config['width'] = 750;
                $config['height'] = 263;
                $config['new_image'] =  FCPATH.'/assets/general/images/deals_gallery/optimize/';
                $this->image_lib->initialize($config);
                $this->image_lib->resize();
                break;
            default:
                die('error saving image!');
        }
    }
    
    function upload_from_url()
    {
        //address of url jpeg file
        $urlfile = $this->input->post('urlfile', true);
        
        //post urlfile is invalid
        if($urlfile == '' || $urlfile == false)
        {
            echo json_encode(array('error' => 'URL string is invalid'));
        }
        else
        {
            //replace spaces with proper url character
            $image_url_path = str_replace(' ', '%20', $urlfile );
            
            //get properties of image, ignore errors
            $img_properties = @getimagesize($image_url_path);
            
            //url file is not image 
            if (!$img_properties) 
            {
            	echo json_encode(array('error' => 'Invalid jpeg image file'));
            }
            else
            {
                //validation for image mime-type
                if($img_properties['mime'] != "image/jpeg")
                {
                    echo json_encode(array('error' => 'Image file not supported'));
                }
                else
                {
                    //validation for image size, size must not exceed 1024x768
                    if($img_properties[0] > 1024 || $img_properties[1] > 768)
                    {
                        echo json_encode(array('error' => 'Image file too big'));
                    }
                    else
                    {
                        //image is ok
                        $jpeg_quality = 100;
                        $file_name = sha1(time().mt_rand()).'.jpg';
                        $img = file_get_contents($urlfile);
                        $img = imagecreatefromstring($img);
                        $tmp_path = FCPATH.'/assets/general/images/deals_gallery/temp/';
                        $full_path = $tmp_path.$file_name;
                        $web_path = base_url().'assets/general/images/deals_gallery/temp/'.$file_name;
                        
                        if(!imagejpeg($img, $full_path, $jpeg_quality))
                        {
                            echo json_encode(array('error' => 'error in creating jpeg file'));
                        }
                        else
                        {
                            echo json_encode(array('error' => '', 'path' => $web_path, 'file_name' => $file_name));
                        }
                    }
                }
            }
        }
    }
    
    function change_image()
    {
        $file_name = $this->input->post('file_name', true);
        $paths[] = FCPATH.'assets\general\images\deals_gallery\cropped\\';
        $paths[] = FCPATH.'assets\general\images\deals_gallery\thumbnail\\';
        $paths[] = FCPATH.'assets\general\images\deals_gallery\optimize\\';
        $paths[] = FCPATH.'assets\general\images\deals_gallery\customize\\';
        
        foreach($paths as $path)
        {
            @unlink($path.$file_name);
        }
    }
	
	
}
?>
