<?php
    class Vigdeals extends MX_Controller
    {
        function __construct()
        {
            parent::__construct();
            $this->load->library("CLLibrary"); 
            $this->load->helper("green");
            $this->load->model("deals_view_model"); 
            $this->load->model("deals_category_model");
            $this->load->model("deals_model");
            $this->load->model("customer_model");
            $this->load->model("deals_view_model");
            $this->load->model('deals_location_model');
            $this->load->model('order_model');
            $this->load->model("deals_gallery_model");
            $this->load->model("deals_video_model");
            $this->load->model("deals_request_model");
            $this->load->model("invite_model");
            $this->load->model("deals_selection_model");
            $this->load->model("deals_option_model");
            $this->load->model("reward_model");
            $this->load->model("messaging_model");
            $this->load->model("recommend_model");
            
            session_start();
            $this->vdcheckuser();
        }
        private function vdcheckuser()
        {
            $auth_id = $this->vauth->get_id();
            $deals_user_data = $this->customer_model->get_where(array('customer_id'=>$auth_id));
            if(!$deals_user_data->row('customer_id'))
            {
                if($this->vauth->get_gender() == "male") $gender = 1;
                else $gender = 2;
                $insert['customer_id'] = $this->vauth->get_id();
                $insert['customer_firstname'] = $this->vauth->get_first_name();
                $insert['customer_lastname'] = $this->vauth->get_last_name();
                $insert['customer_email'] = $this->vauth->get_email();
                $insert['customer_photo'] = $this->vauth->get_picture('large');
                $insert['customer_photosmall'] = $this->vauth->get_picture('small');
                $insert['customer_hash'] = md5($this->vauth->get_id());
                $insert['customer_gender'] = $gender;
                $insert['customer_date'] = time();
                $this->db->insert('customers',$insert);
            }
            else
            {
                if($this->session->userdata('vigdeals_login_state') == FALSE || $this->session->userdata('vigdeals_login_state') == "")
                {
                    $setState = true;
                    $firstname = $deals_user_data->row('customer_firstname');
                    $lastname = $deals_user_data->row('customer_lastname');
                    $loginname = $firstname . " " . $lastname;
                    $customerid = $this->vauth->get_id();
                    $fbemail = $deals_user_data->row('customer_email');
                    
                    $session['vigdeals_login_state'] = $setState;
                    $session['vigdeals_login_name'] = $loginname;
                    $session['vigattin_id'] = $customerid;
                    $session['vigattin_email'] = $fbemail;
                    $session['vigattin_firstname'] = $firstname;
                    $session['vigattin_lastname'] = $lastname;
                    $this->session->set_userdata($session);
                }
            }
        }
        function index()
        {
            //background
            $this->load->model("web_model");
            $data['backgroundimage'] = $this->web_model->get()->row();
            //background
            if(strtolower($this->uri->segment(1)) <> "category")
            {
                $query = $this->deals_view_model->select_data_dealsview()->result();
                $i=0;
                $sd = 0;
                foreach($query as $rows)
                {
                    if(strtolower($rows->deal_view_type) == "group deal")
                    {
                        $dh[$i] = $rows->deal_hash;
                        $dhtype[$i] = strtolower($rows->deal_view_type);
                        $i++;
                    }
                    else
                    {
                        $dh[$i] = 0;
                        $dhtype[$i] = strtolower($rows->deal_view_type);
                        $i++;

                        if($rows->deal_option == 0)
                        {
                            $dsr = $this->deals_selection_model->select_data_selection($rows->deal_subhash)->row();
                            $do = $this->deals_option_model->select_data_option($dsr->selection_hash)->result();
                            $o = 0;
                            foreach($do as $dor)
                            {
                                $sd2[$sd][$o] = array("dos" => $dor->deal_original_stock, "dcs" => $dor->deal_current_stock);
                                $o++;
                            }
                            $sd3[$sd] = array("sel" => $dsr->selection_name, "optl" => $o) + $sd2[$sd];
                        }
                        else
                        {
                            $sd3[$sd] = 0;
                        }
                    }
                    $sd++;
                }
                for($o=0;$o<$i;$o++)
                {
                    if($dhtype[$o] == "group deal")
                    { 
                        $ostocks = 0;
                        $cstocks = 0;
                        $dpcnt = 0;
                        foreach($this->deals_model->select_data_deals4($dh[$o])->result() as $dhqr)
                        {
                            $cstocks = $cstocks + $dhqr->deal_current_stock;
                            $ostocks = $ostocks + $dhqr->deal_original_stock;
                            if($dpcnt < $dhqr->deal_discount)
                            {
                                $dpcnt = $dhqr->deal_discount;
                            }
                        }
                        $gdo = $this->deals_model->select_data_deals_with_option($dh[$o])->result();
                        foreach($gdo as $gdor)
                        {
                            if($gdor->deal_option == 0)
                            {
                                $do = $this->deals_option_model->select_data_option2($gdor->deal_hash)->result();
                                $dcs = 0;
                                $dos = 0;
                                foreach($do as $dor)
                                {
                                    $dos = $dos + $dor->deal_original_stock;
                                    $dcs = $dcs + $dor->deal_current_stock;
                                }
                                $ostocks = $ostocks + $dos;
                                $cstocks = $cstocks + $dcs;
                            }
                        }
                        $s[] = array("ostocks" => $ostocks, "cstocks" => $cstocks);
                        $t[] = array("prcnt" => $dpcnt);
                        $data["stocks"] = $s;
                        $data['dpcnt'] = $t;
                    }
                }
                if(isset($sd3))
                {
                    $data["deal_option"] = $sd3;
                }
                $data["deals_view"] = $query;
            }
            else
            {
                $uri2 = $this->uri->segment(2);
                $strpos = stripos($uri2,"-");
                $cat_id = substr($uri2,0, $strpos);
                $query = $this->deals_view_model->select_data_dealsview_category($cat_id)->result();
                $i=0;
                $sd=0;
                foreach($query as $rows)
                {
                    if(strtolower($rows->deal_view_type) == "group deal")
                    {
                        $dh[$i] = $rows->deal_hash;
                        $dhtype[$i] = strtolower($rows->deal_view_type);
                        $i++;
                    }
                    else
                    {
                        $dh[$i] = 0;
                        $dhtype[$i] = strtolower($rows->deal_view_type);
                        $i++;

                        if($rows->deal_option == 0)
                        {
                            $dsr = $this->deals_selection_model->select_data_selection($rows->deal_subhash)->row();
                            $do = $this->deals_option_model->select_data_option($dsr->selection_hash)->result();
                            $o = 0;
                            foreach($do as $dor)
                            {
                                $sd2[$sd][$o] = array("dos" => $dor->deal_original_stock, "dcs" => $dor->deal_current_stock);
                                $o++;
                            }
                            $sd3[$sd] = array("sel" => $dsr->selection_name, "optl" => $o) + $sd2[$sd];
                        }
                        else
                        {
                            $sd3[$sd] = 0;
                        }
                    }
                    $sd++;
                }
                for($o=0;$o<$i;$o++)
                {
                    if($dhtype[$o] == "group deal")
                    { 
                        $ostocks = 0;
                        $cstocks = 0;
                        $dpcnt = 0;
                        foreach($this->deals_model->select_data_deals4($dh[$o])->result() as $dhqr)
                        {
                            $cstocks = $cstocks + $dhqr->deal_current_stock;
                            $ostocks = $ostocks + $dhqr->deal_original_stock;
                            if($dpcnt < $dhqr->deal_discount)
                            {
                                $dpcnt = $dhqr->deal_discount;
                            }
                        }
                        $gdo = $this->deals_model->select_data_deals_with_option($dh[$o])->result();
                        foreach($gdo as $gdor)
                        {
                            if($gdor->deal_option == 0)
                            {
                                $do = $this->deals_option_model->select_data_option2($gdor->deal_hash)->result();
                                $dcs = 0;
                                $dos = 0;
                                foreach($do as $dor)
                                {
                                    $dos = $dos + $dor->deal_original_stock;
                                    $dcs = $dcs + $dor->deal_current_stock;
                                }
                                $ostocks = $ostocks + $dos;
                                $cstocks = $cstocks + $dcs;
                            }
                        }
                        $s[] = array("ostocks" => $ostocks, "cstocks" => $cstocks);
                        $t[] = array("prcnt" => $dpcnt);
                        $data["stocks"] = $s;
                        $data['dpcnt'] = $t;
                    }
                }
                if(isset($sd3))
                {
                    $data["deal_option"] = $sd3;
                }
                $data["deals_view"] = $this->deals_view_model->select_data_dealsview_category($cat_id)->result();
            }
            $data["page"] = "";
            $data["deals_category"] = $this->deals_category_model->select_data_deal_category();

            $this->load->view("layouts/vd_layout_h", $data);
            $this->load->view("vigdeals/vigdeals/index_view", $data);
            $this->load->view("layouts/vd_layout_f");
        }
        //VIEW
        function view()
        {
            if($this->deals_view_model->select_data_dealsview2($this->uri->segment(2))->num_rows() > 0)
            {
                $q = $this->deals_view_model->select_data_dealsview2($this->uri->segment(2))->row();
                $data["location_limit"] = $this->deals_location_model->displaylocation_limit($this->uri->segment(2))->result();
                $data["location"] = $this->deals_location_model->displaylocation($this->uri->segment(2))->result();
                if(strtolower($q->deal_view_type) == "single deal")
                {
                    $dvq = $this->deals_view_model->select_data_dealsview2($this->uri->segment(2));
                    $sd = 0;
                    foreach($dvq->result() as $sdqr)
                    {
                        if($sdqr->deal_option == 0)
                        {
                            $dsr = $this->deals_selection_model->select_data_selection($sdqr->deal_subhash)->row();
                            $do = $this->deals_option_model->select_data_option($dsr->selection_hash)->result();
                            $o = 0;
                            foreach($do as $dor)
                            {
                                $sd2[$sd][$o] = array("dos" => $dor->deal_original_stock, "dcs" => $dor->deal_current_stock);
                                $o++;
                            }
                            $sd3[$sd] = array("sel" => $dsr->selection_name, "optl" => $o) + $sd2[$sd];
                        }
                        else
                        {
                            $sd3[$sd] = 0;
                        }
                        $sd++;
                    }
                    if(isset($sd3))
                    {
                        $data["deal_option"] = $sd3;
                    }
                    $data["deals_view"] = $dvq->result();
                    $data["random_deals"] = $this->deals_view_model->select_data_dealsview3()->result();
                    //info
                    $sh = $q->deal_subhash;
                    $data['galleries'] = $this->deals_gallery_model->select_data_gallery($sh)->result();
                    //$data['video'] = $this->deals_video_model->select_data_video($sh)->result();
                    $data["fineprint"] = $this->deals_view_model->select_data_fineprint($sh)->result();
                    $data["highlight"] = $this->deals_view_model->select_data_higlight($sh)->result();
                    $data['desc'] = $this->deals_model->select_data_deal_fb($sh)->row();
                }
                elseif($this->uri->segment(3) == "")
                {   
                    $sdq = $this->deals_model->select_data_deals($this->uri->segment(2));
                    $data["deals"] = $sdq->result();
                    $data['banner'] = $this->deals_view_model->get_where(array("deal_hash"=>$this->uri->segment(2)))->result();
                    $sd = 0;
                    foreach($sdq->result() as $sdqr)
                    {
                        $db = array("bgimg" => $sdqr->deal_background, "bgcolor" => $sdqr->deal_Bcolor, "bposition" => $sdqr->deal_Bposition, "brepeat" => $sdqr->deal_Brepeat, "battach" => $sdqr->deal_Battach);
                        if($sdqr->deal_option == 0)
                        {
                            $dsr = $this->deals_selection_model->select_data_selection($sdqr->deal_subhash)->row();
                            $do = $this->deals_option_model->select_data_option($dsr->selection_hash)->result();
                            $o = 0;
                            foreach($do as $dor)
                            {
                                $sd2[$sd][$o] = array("dos" => $dor->deal_original_stock, "dcs" => $dor->deal_current_stock);
                                $o++;
                            }
                            $sd3[$sd] = array("sel" => $dsr->selection_name, "optl" => $o) + $sd2[$sd];
                        }
                        else
                        {
                            $sd3[$sd] = 0;
                        }
                        $sd++;
                    }
                    if(isset($sd3))
                    {
                        $data["deal_option"] = $sd3;
                    }
                    $data['deal_background'] = $db;
                }
                else
                {
                    $sdquery = $this->deals_model->select_data_deals3($this->uri->segment(2),abs($this->uri->segment(3)));
                    $sd = 0;
                    foreach($sdquery->result() as $sdqr)
                    {
                        if($sdqr->deal_option == 0)
                        {
                            $dsr = $this->deals_selection_model->select_data_selection($sdqr->deal_subhash)->row();
                            $do = $this->deals_option_model->select_data_option($dsr->selection_hash)->result();
                            $o = 0;
                            foreach($do as $dor)
                            {
                                $sd2[$sd][$o] = array("dos" => $dor->deal_original_stock, "dcs" => $dor->deal_current_stock);
                                $o++;
                            }
                            $sd3[$sd] = array("sel" => $dsr->selection_name, "optl" => $o) + $sd2[$sd];
                        }
                        else
                        {
                            $sd3[$sd] = 0;
                        }
                        $sd++;
                    }
                    if($sdquery->num_rows() > 0)
                    {
                        $sdq = $sdquery->row();
                        $sdid = $sdq->deal_id;
                        if($sdq->deal_option <> 0)
                        {
                            $data["subdeals"] = $this->deals_model->select_data_deals2($sdid)->result();
                        }
                        else
                        {
                            $data["subdeals"] = $this->deals_model->select_data_deals2($sdid)->result();
                            //$data["subdeals"] = $this->deals_model->select_data_deals5($sdid)->result();
                        }
                        $data["random_deals"] = $this->deals_view_model->select_data_dealsview3()->result();
                        //info
                        $sh = $sdq->deal_subhash;
                        $data['galleries'] = $this->deals_gallery_model->select_data_gallery($sh)->result();
                        //$data['video'] = $this->deals_video_model->select_data_video($sh)->result();
                        $data["fineprint"] = $this->deals_view_model->select_data_fineprint($sh)->result();
                        $data["highlight"] = $this->deals_view_model->select_data_higlight($sh)->result();
                        $data['desc'] = $this->deals_model->select_data_deal_fb($sh)->row();
                    }
                    else
                    {
                        redirect(base_url()."deal/".$this->uri->segment(2)."?e=notfound");
                    }
                    if(isset($sd3))
                    {
                        $data["deal_option"] = $sd3;
                    }
                }
                $this->load->view("layouts/vd_layout_h",$data);
                $this->load->view("vigdeals/vigdeals_view/index_view", $data);
                $this->load->view("layouts/vd_layout_f");
            }
            else
            {
                redirect(base_url()."?e=notfound");
            }
        }
        //ABOUT US
        function aboutus() {
            //background
            $this->load->model("web_model");
            $data['backgroundimage'] = $this->web_model->get()->row();
            //background
            $this->load->view("layouts/vd_layout_h",$data);
            $this->load->view("vigdeals/aboutus/index_view");
            $this->load->view("layouts/vd_layout_f");
        }
        //HOW IT WORKS
        function howitworks()
        {
            //background
            $this->load->model("web_model");
            $data['backgroundimage'] = $this->web_model->get()->row();
            //background
            $this->load->view("layouts/vd_layout_h",$data);
            $this->load->view("vigdeals/howitworks/index_view");
            $this->load->view("layouts/vd_layout_f");
        }
        function order()
        {
            $this->orderpage();
        }
        function orderpage()
        {
            $this->vdcheckuser();
            if($this->uri->segment(2) == "page" || $this->uri->segment(2) == "")
            {
                $this->load->library('pagination');
                $config['base_url'] = base_url()."order/page";
                $cnt = 5;
                $page = $this->uri->segment(3);
                if($page == "")
                {
                    $page == 0;
                }
                else
                {
                    $page == $page * $cnt;
                }

                $oq = $this->order_model->select_data_order($this->session->userdata("vigattin_id"));
                $pq = $this->order_model->select_data_order_pagination($this->session->userdata("vigattin_id"),$cnt,$page);

                $config['total_rows'] = $oq->num_rows();
                $config['per_page'] = $cnt;
                $config['uri_segment'] = 3;
                $config['num_links'] = 5;
                $config['num_tag_open'] = '<div>';
                $config['num_tag_close'] = '</div>';
                $config['cur_tag_open'] = '<div id="voucher-c-page-active"><strong>';
                $config['cur_tag_close'] = '</strong></div>';
                $config['next_link'] = '>>';
                $config['next_tag_open'] = '<div id="voucher-c-page-np">';
                $config['next_tag_close'] = '</div>';
                $config['prev_link'] = '<<';
                $config['prev_tag_open'] = '<div id="voucher-c-page-np">';
                $config['prev_tag_close'] = '</div>';
                $config['first_tag_open'] = '<div id="voucher-c-page-fl">';
                $config['first_tag_close'] = '</div>';
                $config['last_tag_open'] = '<div id="voucher-c-page-fl">';
                $config['last_tag_close'] = '</div>';
                $this->pagination->initialize($config);

                $data['o_rows'] = $oq->num_rows();
                $data['o_res'] = $pq->result();
                $data["random_deals"] = $this->deals_view_model->select_data_dealsview3()->result();
                $this->load->view("layouts/vd_layout_h");
                $this->load->view("vigdeals/order/index_view",$data);
                $this->load->view("layouts/vd_layout_f");
            }
            elseif($this->uri->segment(2) == "pending")
            {
                $this->load->library('pagination');
                $config['base_url'] = base_url()."order/pending/page";
                $cnt = 5;
                $page = $this->uri->segment(4);
                if($page == "")
                {
                    $page == 0;
                }
                else
                {
                    $page == $page * $cnt;
                }

                $oq = $this->order_model->select_data_order22($this->session->userdata("vigattin_id"),$cnt,$page);
                $pq = $this->order_model->select_data_order_pagination2($this->session->userdata("vigattin_id"),$cnt,$page);

                $config['total_rows'] = $oq->num_rows();
                $config['per_page'] = $cnt;
                $config['uri_segment'] = 4;
                $config['num_links'] = 5;
                $config['num_tag_open'] = '<div>';
                $config['num_tag_close'] = '</div>';
                $config['cur_tag_open'] = '<div id="voucher-c-page-active"><strong>';
                $config['cur_tag_close'] = '</strong></div>';
                $config['next_link'] = '>>';
                $config['next_tag_open'] = '<div id="voucher-c-page-np">';
                $config['next_tag_close'] = '</div>';
                $config['prev_link'] = '<<';
                $config['prev_tag_open'] = '<div id="voucher-c-page-np">';
                $config['prev_tag_close'] = '</div>';
                $config['first_tag_open'] = '<div id="voucher-c-page-fl">';
                $config['first_tag_close'] = '</div>';
                $config['last_tag_open'] = '<div id="voucher-c-page-fl">';
                $config['last_tag_close'] = '</div>';
                $this->pagination->initialize($config);

                $data['o_rows'] = $oq->num_rows();
                $data['o_res'] = $pq->result();
                $data["random_deals"] = $this->deals_view_model->select_data_dealsview3()->result();
                $this->load->view("layouts/vd_layout_h");
                $this->load->view("vigdeals/order/index_view",$data);
                $this->load->view("layouts/vd_layout_f");
            }
            elseif($this->uri->segment(2) == "expired")
            {
                $this->load->library('pagination');
                $config['base_url'] = base_url()."order/expired/page";
                $cnt = 5;
                $page = $this->uri->segment(4);
                if($page == "")
                {
                    $page == 0;
                }
                else
                {
                    $page == $page * $cnt;
                }

                $oq = $this->order_model->select_data_order33($this->session->userdata("vigattin_id"));
                $pq = $this->order_model->select_data_order_pagination3($this->session->userdata("vigattin_id"),$cnt,$page);

                $config['total_rows'] = $oq->num_rows();
                $config['per_page'] = $cnt;
                $config['uri_segment'] = 4;
                $config['num_links'] = 5;
                $config['num_tag_open'] = '<div>';
                $config['num_tag_close'] = '</div>';
                $config['cur_tag_open'] = '<div id="voucher-c-page-active"><strong>';
                $config['cur_tag_close'] = '</strong></div>';
                $config['next_link'] = '>>';
                $config['next_tag_open'] = '<div id="voucher-c-page-np">';
                $config['next_tag_close'] = '</div>';
                $config['prev_link'] = '<<';
                $config['prev_tag_open'] = '<div id="voucher-c-page-np">';
                $config['prev_tag_close'] = '</div>';
                $config['first_tag_open'] = '<div id="voucher-c-page-fl">';
                $config['first_tag_close'] = '</div>';
                $config['last_tag_open'] = '<div id="voucher-c-page-fl">';
                $config['last_tag_close'] = '</div>';
                $this->pagination->initialize($config);

                $data['o_rows'] = $oq->num_rows();
                $data['o_res'] = $pq->result();
                $data["random_deals"] = $this->deals_view_model->select_data_dealsview3()->result();
                $this->load->view("layouts/vd_layout_h");
                $this->load->view("vigdeals/order/index_view",$data);
                $this->load->view("layouts/vd_layout_f");
            }
            elseif($this->uri->segment(2) == "available")
            {
                $this->load->library('pagination');
                $config['base_url'] = base_url()."order/available/page";
                $cnt = 5;
                $page = $this->uri->segment(4);
                if($page == "")
                {
                    $page == 0;
                }
                else
                {
                    $page == $page * $cnt;
                }

                $oq = $this->order_model->select_data_order44($this->session->userdata("vigattin_id"));
                $pq = $this->order_model->select_data_order_pagination4($this->session->userdata("vigattin_id"),$cnt,$page);

                $config['total_rows'] = $oq->num_rows();
                $config['per_page'] = $cnt;
                $config['uri_segment'] = 4;
                $config['num_links'] = 5;
                $config['num_tag_open'] = '<div>';
                $config['num_tag_close'] = '</div>';
                $config['cur_tag_open'] = '<div id="voucher-c-page-active"><strong>';
                $config['cur_tag_close'] = '</strong></div>';
                $config['next_link'] = '>>';
                $config['next_tag_open'] = '<div id="voucher-c-page-np">';
                $config['next_tag_close'] = '</div>';
                $config['prev_link'] = '<<';
                $config['prev_tag_open'] = '<div id="voucher-c-page-np">';
                $config['prev_tag_close'] = '</div>';
                $config['first_tag_open'] = '<div id="voucher-c-page-fl">';
                $config['first_tag_close'] = '</div>';
                $config['last_tag_open'] = '<div id="voucher-c-page-fl">';
                $config['last_tag_close'] = '</div>';
                $this->pagination->initialize($config);

                $data['o_rows'] = $oq->num_rows();
                $data['o_res'] = $pq->result();
                $data["random_deals"] = $this->deals_view_model->select_data_dealsview3()->result();
                $this->load->view("layouts/vd_layout_h");
                $this->load->view("vigdeals/order/index_view",$data);
                $this->load->view("layouts/vd_layout_f");
            }
            elseif($this->uri->segment(2) == "used")
            {
                $this->load->library('pagination');
                $config['base_url'] = base_url()."order/used/page";
                $cnt = 5;
                $page = $this->uri->segment(4);
                if($page == "")
                {
                    $page == 0;
                }
                else
                {
                    $page == $page * $cnt;
                }

                $oq = $this->order_model->select_data_order55($this->session->userdata("vigattin_id"));
                $pq = $this->order_model->select_data_order_pagination5($this->session->userdata("vigattin_id"),$cnt,$page);

                $config['total_rows'] = $oq->num_rows();
                $config['per_page'] = $cnt;
                $config['uri_segment'] = 4;
                $config['num_links'] = 5;
                $config['num_tag_open'] = '<div>';
                $config['num_tag_close'] = '</div>';
                $config['cur_tag_open'] = '<div id="voucher-c-page-active"><strong>';
                $config['cur_tag_close'] = '</strong></div>';
                $config['next_link'] = '>>';
                $config['next_tag_open'] = '<div id="voucher-c-page-np">';
                $config['next_tag_close'] = '</div>';
                $config['prev_link'] = '<<';
                $config['prev_tag_open'] = '<div id="voucher-c-page-np">';
                $config['prev_tag_close'] = '</div>';
                $config['first_tag_open'] = '<div id="voucher-c-page-fl">';
                $config['first_tag_close'] = '</div>';
                $config['last_tag_open'] = '<div id="voucher-c-page-fl">';
                $config['last_tag_close'] = '</div>';
                $this->pagination->initialize($config);

                $data['o_rows'] = $oq->num_rows();
                $data['o_res'] = $pq->result();
                $data["random_deals"] = $this->deals_view_model->select_data_dealsview3()->result();
                $this->load->view("layouts/vd_layout_h");
                $this->load->view("vigdeals/order/index_view",$data);
                $this->load->view("layouts/vd_layout_f");
            }
            else
            {
                redirect(base_url()."order");
            }
        }
        function pastdeals_view()
        {
            if($this->deals_view_model->select_data_dealsview6($this->uri->segment(2))->num_rows() > 0)
            {
                $q = $this->deals_view_model->select_data_dealsview6($this->uri->segment(2))->row();
                $data["location_limit"] = $this->deals_location_model->displayLocation_limit($this->uri->segment(2))->result();
                $data["location"] = $this->deals_location_model->displaylocation($this->uri->segment(2))->result();
                if(strtolower($q->deal_view_type) == "single deal")
                {
                    $data["deals_view"] = $this->deals_view_model->select_data_dealsview6($this->uri->segment(2))->result();
                    $data["random_deals"] = $this->deals_view_model->select_data_dealsview3()->result();
                    //info
                    $sh = $q->deal_subhash;
                    //$data['video'] = $this->deals_video_model->select_data_video($sh)->result();
                    $data['galleries'] = $this->deals_gallery_model->select_data_gallery($sh)->result();
                    $data["fineprint"] = $this->deals_view_model->select_data_fineprint($sh)->result();
                    $data["highlight"] = $this->deals_view_model->select_data_higlight($sh)->result();
                    $data['desc'] = $this->deals_model->select_data_deal_fb($sh)->row();
                }
                elseif($this->uri->segment(3) == "")
                {
                    $data["deals"] = $this->deals_model->select_data_deals($this->uri->segment(2))->result();
                    $data['banner'] = $this->deals_model->image($this->uri->segment(2))->result(); 
                }
                else
                {
                    $sdquery = $this->deals_model->select_data_deals3($this->uri->segment(2),abs($this->uri->segment(3)));
                    if($sdquery->num_rows() > 0)
                    {
                        $q = $sdquery->row();
                        $sdid = $q->deal_id;
                        $data["subdeals"] = $this->deals_model->select_data_deals2($sdid)->result();
                        $data["random_deals"] = $this->deals_view_model->select_data_dealsview3()->result();
                        //info
                        $sh = $q->deal_subhash;
                        //$data['video'] = $this->deals_video_model->select_data_video($sh)->result();
                        $data['galleries'] = $this->deals_gallery_model->select_data_gallery($sh)->result();
                        $data["fineprint"] = $this->deals_view_model->select_data_fineprint($sh)->result();
                        $data["highlight"] = $this->deals_view_model->select_data_higlight($sh)->result();
                        $data['desc'] = $this->deals_model->select_data_deal_fb($sh)->row();
                    }
                    else
                    {
                        redirect(base_url()."deal/".$this->uri->segment(2)."?e=notfound");
                    }
                }
                $this->load->view("layouts/vd_layout_h",$data);
                $this->load->view("vigdeals/pastdeals/pastdeal_view",$data);
                $this->load->view("layouts/vd_layout_f");
            }
            else
            {
                redirect(base_url()."past_deals?e=pastnotfound");
            }
        }
    }
?>
