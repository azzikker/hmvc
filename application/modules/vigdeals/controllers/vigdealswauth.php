<?php
    class VigdealswAuth extends MX_Controller
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
            $this->load->model("deals_gender_model");
            $this->load->model("deals_cart_model");
            $this->load->model("deals_term_model");
            
            $this->load->library('form_validation');

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
        private function checkisonoff($func)
        {
            if($func <> "")
            {
                $check = 0;
                if($check == 0)
                {
                    $this->session->set_flashdata("message","Feature is currently off.");
                    redirect(base_url());
                }
            }
        }
        function profile()
        {
            //background
            $this->load->model("web_model");
            $data['backgroundimage'] = $this->web_model->get()->row();
            //background
            if($this->uri->segment(1) == "buy")
            {
                if($this->deals_view_model->select_data_dealsview2($this->uri->segment(2))->num_rows() == 0)
                {
                    $this->session->set_flashdata("message","Deal not found");
                    redirect(base_url());
                }
                $q = $this->deals_view_model->select_data_dealsview2($this->uri->segment(2))->row();
                if(strtolower($q->deal_view_type) == "group deal")
                {
                    if($this->uri->segment(3) == "")
                    {
                        $this->session->set_flashdata("message","Deal not found");
                        redirect(base_url()."deal/".$this->uri->segment(2));
                    }
                    else
                    {
                        $uri3 = abs($this->uri->segment(3));
                        $deals = $this->deals_model->select_data_deals3($this->uri->segment(2),$uri3);
                        if($deals->num_rows() > 0)
                        {
                            $q = $deals->row();
                            if($q->deal_option == 1)
                            {
                                if($q->deal_current_stock == 0)
                                {
                                    $this->session->set_flashdata("message","Deal is out of stock");
                                    redirect(base_url()."deal/".$this->uri->segment(2)."/".$uri3);
                                }
                                else
                                {
                                    $this->addtocart($this->uri->segment(2),$uri3);
                                }
                            }
                            else
                            {
                                $dsr = $this->deals_selection_model->select_data_selection($q->deal_subhash)->row();
                                $do = $this->deals_option_model->select_data_option($dsr->selection_hash)->result();
                                $dcs = 0;
                                foreach($do as $dor)
                                {
                                    $dcs = $dcs + $dor->deal_current_stock;
                                }
                                if($dcs == 0)
                                {
                                    $this->session->set_flashdata("message","Deal is out of stock");
                                    redirect(base_url()."deal/".$this->uri->segment(2)."/".$uri3);
                                }
                                else
                                {
                                    $this->addtocart($this->uri->segment(2),$uri3);
                                }
                            }
                            $cq = $this->customer_model->select_data_customer_id($this->session->userdata("vigattin_id"));
                            $cqq = $cq->num_rows();
                            if($cqq > 0)
                            {
                                $this->session->set_flashdata('post_data',true);
                                redirect(base_url()."review");
                            }
                            else
                            {
                                $this->profile_edit();
                            }
                        }
                        else
                        {
                            $this->session->set_flashdata("message","Deal not found");
                            redirect(base_url()."deal/".$this->uri->segment(2));
                        }
                    }
                }
                elseif(strtolower($q->deal_view_type) == "single deal")
                {
                    if($q->deal_option == 1)
                    {
                        if($q->deal_current_stock == 0)
                        {
                            $this->session->set_flashdata("message","Deal is out of stock");
                            redirect(base_url()."deal/".$this->uri->segment(2));
                        }
                        else
                        {
                            $this->addtocart($this->uri->segment(2));
                        }
                    }
                    else
                    {
                        $dsr = $this->deals_selection_model->select_data_selection($q->deal_subhash)->row();
                        $do = $this->deals_option_model->select_data_option($dsr->selection_hash)->result();
                        $dcs = 0;
                        foreach($do as $dor)
                        {
                            $dcs = $dcs + $dor->deal_current_stock;
                        }
                        if($dcs == 0)
                        {
                            $this->session->set_flashdata("message","Deal is out of stock");
                            redirect(base_url()."deal/".$this->uri->segment(2)."/".$uri3);
                        }
                        else
                        {
                            $this->addtocart($this->uri->segment(2));
                        }
                    }
                    if(!isset($_GET['buy2']))
                    {
                        $deals = $this->deals_view_model->select_data_dealsview2($this->uri->segment(2))->num_rows();
                        if($deals > 0)
                        {
                            $cq = $this->customer_model->select_data_customer_id($this->session->userdata("vigattin_id"));
                            $cqq = $cq->num_rows();
                            if($cqq > 0)
                            {
                                $this->session->set_flashdata('post_data',true);
                                redirect(base_url()."review");
                            }
                            else
                            {
                                $this->profile_edit();
                            }
                        }
                        else
                        {
                            $this->session->set_flashdata("message","Deal not found");
                            redirect(base_url());
                        }
                    }
                    else
                    {
                        $this->session->set_flashdata("message","Deal not found");
                        redirect(base_url());
                    }
                }
            }
            else
            {
                if($this->customer_model->select_data_customer_id($this->session->userdata("vigattin_id"))->num_rows() > 0)
                {
                    $data['profile_infos'] = $this->customer_model->select_data_customer_id($this->session->userdata("vigattin_id"))->result();
                    $this->load->view("layouts/vd_layout_h",$data);
                    $this->load->view("vigdeals/profile/index_view",$data);
                    $this->load->view("layouts/vd_layout_f");
                }
                else
                {
                    $this->profile_edit();
                }
            }
        }
        function profile_edit()
        {
            //background
            $this->load->model("web_model");
            $data['backgroundimage'] = $this->web_model->get()->row();
            //background
            if($this->customer_model->select_data_customer_id($this->session->userdata("vigattin_id"))->num_rows() > 0)
            {
                $data['profile_infos'] = $this->customer_model->select_data_customer_id($this->session->userdata("vigattin_id"))->result();
                $data['profile_gender'] = $this->deals_gender_model->select_data_gender()->result();
                $this->load->view("layouts/vd_layout_h",$data);
                $this->load->view("vigdeals/profile/edit_view",$data);
                $this->load->view("layouts/vd_layout_f");
            }
            else
            {
                $data['profile_gender'] = $this->deals_gender_model->select_data_gender()->result();
                $this->load->view("layouts/vd_layout_h",$data);
                $this->load->view("vigdeals/profile/edit_view",$data);
                $this->load->view("layouts/vd_layout_f");
            }
        }
        function order()
        {
            $this->orderpage();
        }
        function orderpage()
        {
            //background
            $this->load->model("web_model");
            $data['backgroundimage'] = $this->web_model->get()->row();
            //background
            //check all order status
            $allord = $this->order_model->select_data_order($this->session->userdata("vigattin_id"));
            foreach($allord->result() as $orders)
            {
                $txn = $orders->order_txn;
            }
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
                $this->load->view("layouts/vd_layout_h",$data);
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
                $this->load->view("layouts/vd_layout_h",$data);
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
                $this->load->view("layouts/vd_layout_h",$data);
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
                $this->load->view("layouts/vd_layout_h",$data);
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
                $this->load->view("layouts/vd_layout_h",$data);
                $this->load->view("vigdeals/order/index_view",$data);
                $this->load->view("layouts/vd_layout_f");
            }
            else
            {
                redirect(base_url()."order");
            }
        }
        function pastdeals()
        {
            //background
            $this->load->model("web_model");
            $data['backgroundimage'] = $this->web_model->get()->row();
            //background
            if(strtolower($this->uri->segment(1)) <> "past-category")
            {
                if(isset($_GET['m']))
                {
                    if($_GET['m'] == 0)
                    {
                        redirect(base_url()."past_deals");
                    }
                    else
                    {
                        if($_GET['m'] > 12 || $_GET['m'] < 0)
                        {
                            redirect(base_url()."past_deals");
                        }
                        else
                        {
                            $yn = date("Y",time());
                            if($_GET['m'] == 1)
                            {
                                $month = array("som" => "jan", "eom" => "feb");
                            }
                            elseif($_GET['m'] == 2)
                            {
                                $month = array("som" => "feb", "eom" => "mar");
                            }
                            elseif($_GET['m'] == 3)
                            {
                                $month = array("som" => "mar", "eom" => "apr");
                            }
                            elseif($_GET['m'] == 4)
                            {
                                $month = array("som" => "apr", "eom" => "may");
                            }
                            elseif($_GET['m'] == 5)
                            {
                                $month = array("som" => "may", "eom" => "jun");
                            }
                            elseif($_GET['m'] == 6)
                            {
                                $month = array("som" => "jun", "eom" => "jul");
                            }
                            elseif($_GET['m'] == 7)
                            {
                                $month = array("som" => "jul", "eom" => "aug");
                            }
                            elseif($_GET['m'] == 8)
                            {
                                $month = array("som" => "aug", "eom" => "sep");
                            }
                            elseif($_GET['m'] == 9)
                            {
                                $month = array("som" => "sep", "eom" => "oct");
                            }
                            elseif($_GET['m'] == 10)
                            {
                                $month = array("som" => "oct", "eom" => "nov");
                            }
                            elseif($_GET['m'] == 11)
                            {
                                $month = array("som" => "nov", "eom" => "dec");
                            }
                            elseif($_GET['m'] == 12)
                            {
                                $month = array("som" => "dec", "eom" => "jan");
                            }
                            $som = strtotime("".$month['som']." ".$yn."");
                            $eom = strtotime("".$month['eom']." ".$yn."");
                            $pd = $this->deals_view_model->select_data_dealsview_month($som,$eom);
                            $i=0;
                            foreach($pd->result() as $rows)
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
                                }
                            }
                            for($o=0;$o<$i;$o++)
                            {
                                if($dhtype[$o] == "group deal")
                                { 
                                    $ostocks = 0;
                                    $cstocks = 0;
                                    foreach($this->deals_model->select_data_deals4($dh[$o])->result() as $dhqr)
                                    {
                                        $cstocks = $cstocks + $dhqr->deal_current_stock;
                                        $ostocks = $ostocks + $dhqr->deal_original_stock;
                                    }
                                    $s[] = array("ostocks" => $ostocks, "cstocks" => $cstocks);  
                                    $data["stocks"] = $s;
                                }
                            }
                        }
                    }
                }
                else
                {
                    $pd = $this->deals_view_model->select_data_dealsview5();
                    $i=0;
                    foreach($pd->result() as $rows)
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
                        }
                    }
                    for($o=0;$o<$i;$o++)
                    {
                        if($dhtype[$o] == "group deal")
                        { 
                            $ostocks = 0;
                            $cstocks = 0;
                            foreach($this->deals_model->select_data_deals4($dh[$o])->result() as $dhqr)
                            {
                                $cstocks = $cstocks + $dhqr->deal_current_stock;
                                $ostocks = $ostocks + $dhqr->deal_original_stock;
                            }
                            $s[] = array("ostocks" => $ostocks, "cstocks" => $cstocks);  
                            $data["stocks"] = $s;
                        }
                    }
                }
            }
            else
            {
                $uri2 = $this->uri->segment(2);
                $strpos = stripos($uri2,"-");
                $cat_id = substr($uri2,0, $strpos);
                $pd = $this->deals_view_model->select_data_dealsview_category2($cat_id);
                $i=0;
                foreach($pd->result() as $rows)
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
                    }
                }
                for($o=0;$o<$i;$o++)
                {
                    if($dhtype[$o] == "group deal")
                    { 
                        $ostocks = 0;
                        $cstocks = 0;
                        foreach($this->deals_model->select_data_deals4($dh[$o])->result() as $dhqr)
                        {
                            $cstocks = $cstocks + $dhqr->deal_current_stock;
                            $ostocks = $ostocks + $dhqr->deal_original_stock;
                        }
                        $s[] = array("ostocks" => $ostocks, "cstocks" => $cstocks);  
                        $data["stocks"] = $s;
                    }
                }
            }
            $data["deals_category"] = $this->deals_category_model->select_data_deal_category();
            $data["pd_rows"] = $pd->num_rows();
            $data["past_deals"] = $pd->result();
            $data["random_deals"] = $this->deals_view_model->select_data_dealsview3()->result();
            $data["request_deals"] = $this->deals_request_model->select_data_request2($this->session->userdata("vigattin_id"))->result();
            $this->load->view("layouts/vd_layout_h",$data);
            $this->load->view("vigdeals/pastdeals/index_view", $data);
            $this->load->view("layouts/vd_layout_f");
        }
        function pastdeals_view()
        {
            //background
            $this->load->model("web_model");
            $data['backgroundimage'] = $this->web_model->get()->row();
            //background
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
                    $data['banner'] = $this->deals_view_model->get_where(array("deal_hash"=>$this->uri->segment(2)))->result(); 
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
                        $this->session->set_flashdata("message","Deal not found");
                        redirect(base_url()."deal/".$this->uri->segment(2));
                    }
                }
                $this->load->view("layouts/vd_layout_h",$data);
                $this->load->view("vigdeals/pastdeals/pastdeal_view",$data);
                $this->load->view("layouts/vd_layout_f");
            }
            else
            {
                $this->session->set_flashdata("message","Past deal not found");
                redirect(base_url()."past_deals");
            }
        }
        // STEP 1
        function review()
        {
            $my_cart = $this->deals_cart_model->select_data_cart($this->session->userdata("vigattin_id"));
            if($my_cart->num_rows() > 0)
            {
            $data['my_cart_view'] = 
            "
            <span style='color:#EE7312'>".$this->session->flashdata("val_err")."</span>
            <table>
                <thead>
                    <tr>
                        <td id=\"rpt-t-th-d\">Deal</td>
                        <td id=\"rpt-t-th-q\">Quantity</td>
                        <td id=\"rpt-t-th-rbst\">Redemption Branch/Send to</td>
                        <td id=\"rpt-t-th-up\">Unit Price</td>
                        <td id=\"rpt-t-th-tp\">Total Price</td>
                        <td id=\"rpt-t-th-cb\"><input type=\"checkbox\"></td>
                    </tr>
                </thead>
                <tbody>";
            //count carts
            $carts = 0;
            foreach($my_cart->result() as $my_crow)
            {
            $carts++;
            if($my_crow->deal_option == 1 && $my_crow->deal_current_stock > 0):
            $data['my_cart_view'] .=
            "
                    <!-- START OF CART -->
                    <tr>
                        <td id=\"rpt-t-tb-d\">
                            <div>
                            <img src=\"assets/general/images/deals_gallery/customize/".$my_crow->gallery_filename."\">
                            </div>
                            <div>".$my_crow->deal_title."</div>";
            //if has option
            $option = 0;
            $noption = 0;
            $option = $this->deals_model->get_where(array("deal_id"=>$my_crow->deal_id,"deal_option"=>1))->num_rows();
            if($option == 0)
            {
            $data['my_cart_view'] .=
            "
                            <div id=\"rpt-t-tb-d-opt\" class='rpt-t-tb-d-opt'>";
            //get selection
            $dcso = $this->deals_selection_model->get_where(array("deal_subhash"=>$my_crow->deal_subhash));
            $data['my_cart_view'] .=
            "
                                <span id=\"rpt-t-tb-d-opt-sel\">".$dcso->row("selection_name")."</span>:";
            $data['my_cart_view'] .=
            "
                                <br><br>";
            //get option
            $dcso = $this->deals_option_model->get_where(array("selection_hash"=>$dcso->row("selection_hash")))->result();
            $dcs = 0;
            foreach($dcso as $dcsor)
            {
            $data['my_cart_view'] .=
            "
                                <input type=\"radio\" name=\"option".$carts."\" value=\"".$noption."\" qty=\"".$dcsor->deal_current_stock."\">".$dcsor->option_name."<br>";
            $noption++;
            }
            $data['my_cart_view'] .=
            "
                            </div>
                            <span id='erroropt'></span>";
            }
            
            if($option == 1)
            {
                $dcs = $my_crow->deal_current_stock;
                $dcsd = "";
            }
            elseif($option == 0)
            {
                $dcs = 0;
                $dcsd = "disabled='disabled'";
            }
            $data['my_cart_view'] .=
            "
                        </td>
                        <td id=\"rpt-t-tb-q\" class=\"rpt-t-tb-q\">
                            <input type=\"number\" value=\"1\" min=\"1\" name=\"quantity".$carts."\" max=\"".$my_crow->deal_current_stock."\" ".$dcsd.">
                            <br />
                            <span id='errorquan'></span>
                            <br>
                            <br>
                            Quantity Left: <span id='ql'>".$dcs."</span><br />
                            (Type or use arrow)
                        </td>
                        <td id=\"rpt-t-tb-rbst\">
                            <span id='errorloc'></span><br /><br /><br />
                            <div>
                                <select name=\"loc".$carts."\">";
            //get location 
            $location = $this->deals_location_model->get_where(array("deal_hash"=>$my_crow->deal_hash));
            $locnum = $location->num_rows();
            $locr = $location->result();
            $loc = 0;
            if($locnum > 1)
            {
            $data['my_cart_view'] .= '
                                    <option value="0">Select Address</option>';
            }
            foreach($locr as $locr)
            {
                $loc++;
                $data['my_cart_view'] .= "
                                    <option value=\"".$loc."\">".$locr->location_address."</option>";
            }
            $data['my_cart_view'] .=
            "
                                </select>
                            </div>
                        </td>
                        <td id=\"rpt-t-tb-up\" class=\"rpt-t-tb-up\">
                            P ".number_format($my_crow->deal_discounted_price)."
                        </td>
                        <td id=\"rpt-t-tb-tp\" class=\"rpt-t-tb-tp\">
                            P ".number_format($my_crow->deal_discounted_price)."
                        </td>
                        <td id=\"rpt-t-tb-cb\" class=\"rpt-t-tb-cb\"><input type=\"checkbox\" name='addtocart".$carts."'></td>
                    </tr>
                    <!-- END OF CART -->";
            else:
            
            //with option(just like the top codes)
            if($my_crow->deal_option == 0):
            //get selection
            $where = "";
            $where['deal_subhash'] = $my_crow->deal_subhash;
            $dcso = $this->deals_selection_model->get_where($where)->row("selection_hash");
            //get option
            $where = array("selection_hash"=>$dcso);
            $dcso = $this->deals_option_model->get_where($where)->result();
            $wos = 0;
            foreach($dcso as $wosr)
            {
                $wos = $wos + $wosr->deal_current_stock;
            }
            if($wos > 0):
            $data['my_cart_view'] .=
            "
                    <!-- START OF CART -->
                    <tr>
                        <td id=\"rpt-t-tb-d\">
                            <div>
                            <img src=\"assets/general/images/deals_gallery/customize/".$my_crow->gallery_filename."\">
                            </div>
                            <div>".$my_crow->deal_title."</div>";
            //if has option
            $option = 0;
            $noption = 0;
            $option = $this->deals_model->get_where(array("deal_id"=>$my_crow->deal_id,"deal_option"=>1))->num_rows();
            if($option == 0)
            {
            $data['my_cart_view'] .=
            "
                            <div id=\"rpt-t-tb-d-opt\" class='rpt-t-tb-d-opt'>";
            //get selection
            $dcso = $this->deals_selection_model->get_where(array("deal_subhash"=>$my_crow->deal_subhash));
            $data['my_cart_view'] .=
            "
                                <span id=\"rpt-t-tb-d-opt-sel\">".$dcso->row("selection_name")."</span>:";
            $data['my_cart_view'] .=
            "
                                <br><br>";
            //get option
            $dcso = $this->deals_option_model->get_where(array("selection_hash"=>$dcso->row("selection_hash")))->result();
            $dcs = 0;
            foreach($dcso as $dcsor)
            {
            $data['my_cart_view'] .=
            "
                                <input type=\"radio\" name=\"option".$carts."\" value=\"".$noption."\" qty=\"".$dcsor->deal_current_stock."\">".$dcsor->option_name."<br>";
            $noption++;
            }
            $data['my_cart_view'] .=
            "
                            </div>
                            <span id='erroropt'></span>";
            }
            
            if($option == 1)
            {
                $dcs = $my_crow->deal_current_stock;
                $dcsd = "";
            }
            elseif($option == 0)
            {
                $dcs = 0;
                $dcsd = "disabled='disabled'";
            }
            $data['my_cart_view'] .=
            "
                        </td>
                        <td id=\"rpt-t-tb-q\" class=\"rpt-t-tb-q\">
                            <input type=\"number\" value=\"1\" min=\"1\" name=\"quantity".$carts."\" max=\"".$my_crow->deal_current_stock."\" ".$dcsd.">
                            <br />
                            <span id='errorquan'></span>
                            <br>
                            <br>
                            Quantity Left: <span id='ql'>".$dcs."</span><br />
                            (Type or use arrow)
                        </td>
                        <td id=\"rpt-t-tb-rbst\">
                            <span id='errorloc'></span><br /><br /><br />
                            <div>
                                <select name=\"loc".$carts."\">";
            //get location 
            $location = $this->deals_location_model->get_where(array("deal_hash"=>$my_crow->deal_hash));
            $locnum = 0;
            $locnum = $location->num_rows();
            $locr = $location->result();
            $loc = 0;
            if($locnum > 1)
            {
            $data['my_cart_view'] .= '
                                    <option value="0">Select Address</option>';
            }
            foreach($locr as $locr)
            {
                $loc++;
                $data['my_cart_view'] .= "
                                    <option value=\"".$loc."\">".$locr->location_address."</option>";
            }
            $data['my_cart_view'] .=
            "
                                </select>
                            </div>
                        </td>
                        <td id=\"rpt-t-tb-up\" class=\"rpt-t-tb-up\">
                            P ".number_format($my_crow->deal_discounted_price)."
                        </td>
                        <td id=\"rpt-t-tb-tp\" class=\"rpt-t-tb-tp\">
                            P ".number_format($my_crow->deal_discounted_price)."
                        </td>
                        <td id=\"rpt-t-tb-cb\" class=\"rpt-t-tb-cb\"><input type=\"checkbox\" name='addtocart".$carts."'></td>
                    </tr>
                    <!-- END OF CART -->";
            endif;
            endif;
            endif;
            }
            $data['my_cart_view'] .=
            "   </tbody>
            </table>";
            }
            else
            {
            $data['my_cart_view'] = 
            "
                <div id=\"empty-cart\">Empty Cart</div>";
            }
            //background
            $this->load->model("web_model");
            $data['backgroundimage'] = $this->web_model->get()->row();
            //background
            
            $this->load->view("layouts/vd_layout_h",$data);
            $this->load->view("vigdeals/review/index_view",$data);
            $this->load->view("layouts/vd_layout_f");
        }
        // STEP 2
        function payment()
        {
            $carts = $this->deals_cart_model->select_data_cart($this->session->userdata("vigattin_id"));
            $cartsnum = 0;
            $i = 1;
            foreach($carts->result() as $cartsrow)
            {
                $option = "";
                if(isset($_POST["addtocart$i"]))
                {
                    $this->form_validation->set_rules("quantity$i",'Quantity','numeric|trim|required|xss_clean');
                    $this->form_validation->set_rules("loc$i",'Location','numeric|trim|required|xss_clean');
                    $this->form_validation->set_rules("option$i",'Option','numeric|trim|xss_clean');
                    
                    if ($this->form_validation->run() == FALSE)
                    {
                        $this->session->set_flashdata("post_data",true);
                        $this->session->set_flashdata("message","Error found. Please try again.");
                        $this->session->set_flashdata("val_err",validation_errors());
                        redirect(base_url()."review");
                    }
                    else
                    {
                        $cartsnum++;
                        $location = $this->input->post("loc$i");
                        $quantity = $this->input->post("quantity$i");
                        //check location;
                        if($location == 0)
                        {
                            $this->session->set_flashdata("post_data",true);
                            $this->session->set_flashdata("message","Please select location.");
                            redirect(base_url()."review");
                        }
                        //check quantity
                        elseif($quantity == 0)
                        {
                            $this->session->set_flashdata("post_data",true);
                            $this->session->set_flashdata("message","Please input quantity.");
                            redirect(base_url()."review");
                        }
                        //has option
                        elseif($cartsrow->deal_option == 0)
                        {
                            if(isset($_POST["option$i"]))
                            {
                                $option = $this->input->post("option$i");
                            }
                            else
                            {
                                $this->session->set_flashdata("post_data",true);
                                $this->session->set_flashdata("message","Please select at least one option on the following deals with option.");
                                redirect(base_url()."review");
                            }
                        }
                        //check kung sya ba ay may option
                        if($option == "")
                        {
                            //CHECK KUNG MAY STOCK PA
                            $stock = $cartsrow->deal_current_stock;
                            if($stock == 0)
                            {
                                $this->session->set_flashdata("post_data",true);
                                $this->session->set_flashdata("message","Deal out of stock.");
                                redirect(base_url()."review");
                            }
                            //CHECK IF CUSTOMER QUANTITY IS GREATER THAN REMAINING STOCK(S)
                            elseif($stock < $quantity)
                            {
                                $this->session->set_flashdata("post_data",true);
                                $this->session->set_flashdata("message","Invalid Quantity. Please try again.");
                                redirect(base_url()."review");
                            }
                            else
                            {
                                $cid = $cartsrow->deal_id;
                                $where = array("deal_id"=>$cid,"customer_id"=>$this->session->userdata("vigattin_id"));
                                $update = "";
                                $update["order"] = 1;
                                $update["quantity"] = $this->input->post("quantity$i");
                                $update["location"] = $this->input->post("loc$i");
                                $this->deals_cart_model->update($update,$where);
                            }
                        }
                        else
                        {
                            $dcso = $this->deals_selection_model->get_where(array("deal_subhash"=>$cartsrow->deal_subhash))->row();
                            $dcso = $dcso->selection_hash;
                            $dcso = $this->deals_option_model->get_where(array("selection_hash"=>$dcso))->result();
                            $opt = 0;
                            foreach($dcso as $row)
                            {
                                if($opt == $option)
                                {
                                    $stock = $row->deal_current_stock;
                                }
                                $opt++;
                            }
                            if($opt == 0)
                            {
                                $this->session->set_flashdata("message","Option not exist.");
                                redirect(base_url()."review");
                            }
                            if($stock == 0)
                            {
                                $this->session->set_flashdata("message","Deal out of stock.");
                                redirect(base_url()."review");
                            }
                            //CHECK IF CUSTOMER QUANTITY IS GREATER THAN REMAINING STOCK(S)
                            elseif($stock < $quantity)
                            {
                                $this->session->set_flashdata("post_data",true);
                                $this->session->set_flashdata("message","Invalid Quantity. Please try again.");
                                redirect(base_url()."review");
                            }
                            $cid = $cartsrow->deal_id;
                            $where = array("deal_id"=>$cid,"customer_id"=>$this->session->userdata("vigattin_id"));
                            $update = "";
                            $update["order"] = 1;
                            $update["quantity"] = $this->input->post("quantity$i");
                            $update["location"] = $this->input->post("loc$i");
                            $update["option"] = $this->input->post("option$i");
                            $this->deals_cart_model->update($update,$where);
                        }
                    }
                }
                else
                {
                    $this->form_validation->set_rules("quantity$i",'Quantity','numeric|trim|xss_clean');
                    $this->form_validation->set_rules("loc$i",'Location','numeric|trim|required|xss_clean');
                    $this->form_validation->set_rules("option$i",'Option','numeric|trim|xss_clean');
                    
                    if ($this->form_validation->run() == FALSE)
                    {
                        $this->session->set_flashdata("post_data",true);
                        $this->session->set_flashdata("message","Error found. Please try again.");
                        $this->session->set_flashdata("val_err",validation_errors());
                        redirect(base_url()."review");
                    }
                    else
                    {
                        $cid = $cartsrow->deal_id;
                        $where = array("deal_id"=>$cid,"customer_id"=>$this->session->userdata("vigattin_id"));
                        $update = "";
                        $update["order"] = 0;
                        $update["quantity"] = $this->input->post("quantity$i");
                        $update["location"] = $this->input->post("loc$i");
                        $this->deals_cart_model->update($update,$where);
                    }
                }
                $i++;
            }
            //redirect if cart is empty
            if($cartsnum == 0)
            {
                $this->session->set_flashdata("message","Please check atleast one cart.");
                redirect(base_url()."review");
            }
            else
            {
                $cq = $this->customer_model->select_data_customer_id($this->session->userdata("vigattin_id"));
                $data['biladdress'] = $cq->result();
                $data['summary'] = '';
                $carts = $this->deals_cart_model->get_where2()->result();
                $total = 0;
                $saved = 0;
                foreach($carts as $row)
                {
                $tp = ($row->quantity * $row->deal_discounted_price);
                $total = $total + $tp;
                $saved = $saved + (($row->deal_original_price - $row->deal_discounted_price) * $row->quantity);
                //select true location
                $where = array("deal_hash"=>$row->deal_hash);
                $loc = $this->deals_location_model->get_where($where)->result();
                $loccnt = 0;
                $location = "";
                foreach($loc as $locr)
                {
                    $loccnt++;
                    if($loccnt == $row->location)
                    {
                        $location = $locr->location_address;
                    }
                }
                if($location == "")
                {
                    $this->session->set_flashdata("message","Error Occurred. Please try again.");
                    redirect(base_url()."review");
                }
                $data['summary'] .= 
                '<div id="rpc-rev-c">
                    <div id="rpc-rev-img" class="fleft">
                        <img src="assets/general/images/deals_gallery/customize/'.$row->gallery_filename.'" alt=""><br />
                        '.$row->deal_title.'
                    </div>
                    <div id="rpc-rev-info" class="fleft">
                        Redemption Branch/Send to: <span>'.$location.'</span><br />
                        Original Price: '.number_format($row->deal_original_price).'<br /><br />
                        Quantity: <span>'.$row->quantity.'</span><br />
                        Unit Price: <span>P '.number_format($row->deal_discounted_price).'</span><br /><br />
                        <span style="font-size:14px;">Total Price: P '.number_format($tp).'</span><br />
                    </div>
                </div>
                <div class="push"></div>';
                }
                $data['summary'] .= 
                '<div id="rpc-rev-total">
                    <div><span>Total:</span> P '.number_format($total).'</div>
                    <div style="font-style: italic; font-weight:normal;"><span>Saved from VigDeals:</span> P '.number_format($saved).'</div>
                </div>
                ';
                //background
                $this->load->model("web_model");
                $data['backgroundimage'] = $this->web_model->get()->row();
                //background
                $this->load->view("layouts/vd_layout_h",$data);
                $this->load->view("vigdeals/payment2/index_view",$data);
                $this->load->view("layouts/vd_layout_f");
            }
        }
        // STEP 3
        function payment2()
        {
            $id = $this->session->userdata("vigattin_id");
            //check user infos
            $this->form_validation->set_rules('fn','Full Name','trim|required|xss_clean');
            $this->form_validation->set_rules('pn','Phone Number','trim|required|xss_clean|numeric');
            $this->form_validation->set_rules('add1','Address','trim|required|xss_clean');
            $this->form_validation->set_rules('ct','City','trim|required|xss_clean');
            $this->form_validation->set_rules('prov','Province','trim|required|xss_clean');
            $this->form_validation->set_rules('zc','Zip Code','trim|required|xss_clean|numeric');
            
            if($this->form_validation->run() == false)
            {
                $this->session->set_flashdata("message","Please fill up all fields first");
                redirect(base_url()."account");
            }
            else
            {
                $fn = $this->input->post("fn");
                $pn = $this->input->post("pn");
                $add1 = $this->input->post("add1");
                $ct = $this->input->post("ct");
                $prov = $this->input->post("prov");
                $zc = $this->input->post("zc");
                //update user infos
                $update['customer_no'] = $pn;
                $update['customer_zipcode'] = $zc;
                $update['customer_address'] = $add1;
                $update['customer_city'] = $ct;
                $update['customer_province'] = $prov;
                $where = array("customer_id"=>$this->session->userdata("vigattin_id"));
                $this->customer_model->update($update,$where);
                //get user info
                $time = md5($id.time())."-cart";
                $txn = md5($time);
                $user = $this->customer_model->get_where(array("customer_id"=>$id))->row();
                //get amounts of all
                $cart = $this->deals_cart_model->get_where(array("customer_id"=>$id,"order"=>1));
                $amt = 0;
                $desc = "";
                $cartnumrow = $cart->num_rows();
                $cartnum = 0;
                foreach($cart->result() as $cartrow)
                {
                    $cartnum++;
                    $deal = $this->deals_model->get_where(array("deal_id"=>$cartrow->deal_id));
                    if($deal->num_rows() > 0)
                    {
                        $deal = $deal->row();
                    }
                    else
                    {
                        $this->session->set_flashdata("message","Unknown Error Occurred. Please try again.");
                        redirect(base_url()."review");
                    }
                    $amt = $amt + ($deal->deal_discounted_price * $cartrow->quantity);
                    if($cartnum == $cartnumrow)
                    {
                        $desc .= $deal->deal_title;
                    }
                    else
                    {
                        $desc .= $deal->deal_title.", ";
                    }
                    //get location id
                    $loc = $cartrow->location;
                    $locnum = 0;
                    $locval = 0;
                    $locr = $this->deals_location_model->get_where(array("deal_hash"=>$deal->deal_hash))->result();
                    foreach($locr as $locrow)
                    {
                        $locnum++;
                        if($locnum == $loc)
                        {
                            $locval = $locrow->location_id;
                        }
                    }
                    //send data to orders
                    $hrstopay = time()+172800;
                    
                    $quan = $cartrow->quantity;
                    $que = $this->deals_model->get_where(array("deal_id"=>$cartrow->deal_id))->row();;
                    $quer = $this->deals_model->get_where_join(array("deal_id"=>$cartrow->deal_id))->row();
                    $insert['customer_id'] = $this->session->userdata("vigattin_id");
                    $insert['order_quantity'] = $quan;
                    $insert['order_each_price'] = $que->deal_discounted_price;
                    $insert['order_total_price'] = ($quan * $que->deal_discounted_price);
                    $insert['deal_id'] = $que->deal_id;
                    $insert['order_date'] = $hrstopay;
                    $insert['order_hash'] = $time;
                    $insert['location_id'] = $locval;
                    $insert['selection_hash'] = "";
                    $insert['option_id'] = 0;
                    $insert['order_show'] = 0;
                    //check option
                    if($cartrow->option > -1 && $que->deal_option == 0)
                    {
                        $where = array("deal_subhash"=>$que->deal_subhash);
                        $sel = $this->deals_selection_model->get_where($where)->result();
                        foreach($sel as $selr)
                        {
                            $sels = $selr->selection_hash;
                        }
                        $opt = $this->deals_option_model->get_where(array("selection_hash"=>$sels))->row("option_id");
                        $insert['selection_hash'] = $sels;
                        $insert['option_id'] = $opt;
                    }
                    $vouchno = $this->order_model->select_data_order2($que->deal_id)->num_rows();
                    $insert['voucher_no'] = str_pad($quer->company_id, 4, '0', STR_PAD_LEFT) . str_pad($que->deal_id, 4, '0', STR_PAD_LEFT) . str_pad($vouchno+1, 4, '0', STR_PAD_LEFT);
                    $insert['order_txn'] = $txn;
                    $this->order_model->insert_data_order($insert);
                    //delete cart
                    $this->deals_cart_model->delete(array("deal_id"=>$cartrow->deal_id,"customer_id"=>$this->session->userdata("vigattin_id")));
                }
                //send data to pay
                $param = array(
                "clientid" => $id,
                "amount" => $amt,
                "name" => $time,
                "description" => $desc,
                "firstname" => $user->customer_firstname,
                "lastname" => $user->customer_lastname,
                "address" => $user->customer_address,
                "city" => $user->customer_city,
                "state" => $user->customer_province,
                "country" => "PH",
                "zipcode" => $user->customer_zipcode,
                "telno" => $user->customer_no,
                "email" => $user->customer_email,
                "order_txn" => $txn
                );
                Modules::run('pay',$param);
            }
        }
        //FINISH / CONFIRMATION
        function finish()
        {
            if($this->session->flashdata("order_status") == "")
            {
                $this->session->set_flashdata("message","No confirmation.");
                redirect(base_url());
                $data['order_msg'] = 
            "
            Your order is Invalid.<br />
            ";
            }
            elseif($this->session->flashdata("order_status") == 0)
            {
                $data['order_msg'] = 
            "
            Your order is Failed.<br />
            ";    
            }
            elseif($this->session->flashdata("order_status") == 1)
            {
                $data['order_msg'] = 
            "
            Thank you for buying in <span>VIGATTIN.org</span>. Your voucher is now ready to print.
            ";    
            }
            elseif($this->session->flashdata("order_status") == 2)
            {
                $data['order_msg'] = 
            "
            Thank you for buying in <span>VIGATTIN</span> DEALS.com.<br />
            Your order is now Pending.<br />
            Please check your e-mail to retrieve your confirmation.
            ";    
            }
            elseif($this->session->flashdata("order_status") == 3)
            {
                $data['order_msg'] = 
            "
            Sorry your purchased has been denied.
            ";
            }
            else
            {
                $data['order_msg'] = 
            "
            Unknown Error Ocurred<br />
            Status: ".$this->session->flashdata("order_status")."
            ";
            }
            //background
            $this->load->model("web_model");
            $data['backgroundimage'] = $this->web_model->get()->row();
            //background
            $this->load->view("layouts/vd_layout_h",$data);
            $this->load->view("vigdeals/payment/index_view",$data);
            $this->load->view("layouts/vd_layout_f");
        }
        function request()
        {
            if(isset($_POST['deal_id']))
            {
                $this->form_validation->set_rules("deal_id","DEAL ID","trim|xss_clean|numeric");
                if($this->form_validation->run() == false)
                {
                     
                }
                else
                {
                    $dealid = $this->input->post("deal_id");
                    if($this->deals_request_model->select_data_request($dealid,$this->session->userdata("vigattin_id"))->num_rows() == 0)
                    {
                        $data['deal_hash'] = $dealid;
                        $data['customer_id'] = $this->session->userdata("vigattin_id");
                        $data['deal_request_date'] = time();
                        $this->deals_request_model->save_data_request($data);
                    }
                }
            }
            else
            {
                echo "INVALID";
            }
        }
        function printvouch()
        {
            //background
            $this->load->model("web_model");
            $data['backgroundimage'] = $this->web_model->get()->row();
            //background
            $uri2 = $this->uri->segment(2);
            $oq = $this->order_model->get_where(array("voucher_no"=>$uri2,"customer_id"=>$this->session->userdata("vigattin_id")));
            if($oq->num_rows() == 1)
            {
                if($oq->row("order_status") == "available" || $oq->row("order_status") == "used")
                {
                    $print = $this->order_model->select_data_order3($uri2);
                    $data["random_deals"] = $this->deals_view_model->select_data_dealsview3()->result();
                    $this->load->library("bc");
                    $data["print"] = $print->row();
                    $data["customer"] = $this->customer_model->select_data_customer_id($this->session->userdata("vigattin_id"))->row();
                    $this->load->view("layouts/vd_layout_h",$data);
                    $this->load->view("vigdeals/print/index_view",$data);
                    $this->load->view("layouts/vd_layout_f");
                }
                else
                {
                    $this->session->set_flashdata("message","The voucher is not yet available to print.");
                    redirect(base_url()."order");
                }
            }
            else
            {
                $this->session->set_flashdata("message","Voucher Not Found.");
                redirect(base_url()."order");
            }
        }
        function invitefriends()
        {
            $data["customer"] = $this->customer_model->select_data_customer_id($this->session->userdata("vigattin_id"))->row();
            $data["random_deals"] = $this->deals_view_model->select_data_dealsview3()->result();
            $this->load->view("layouts/vd_layout_h");
            $this->load->view("vigdeals/invite/index_view",$data);
            $this->load->view("layouts/vd_layout_f");
        }
        function invitefriendsnow()
        {
            $this->checkisonoff("invitefriendsnow");
            $cq = $this->customer_model->select_data_customer_id($this->session->userdata("vigattin_id"))->row();
            $err = 0;
            for($i=0;$i<$_POST['inv-ni'];$i++)
            {
                $e = $_POST['inv-e'][$i];
                $fn = $_POST['inv-fn'][$i];
                $ln = $_POST['inv-ln'][$i];
                
                $this->form_validation->set_rules("inv-e[]","Email","valid_email|trim|xss_clean|required");
                $this->form_validation->set_rules("inv-fn[]","First Name","trim|xss_clean|required");
                $this->form_validation->set_rules("inv-ln[]","Last Name","trim|xss_clean|required");
                
                if($this->form_validation->run() == FALSE)
                {
                    $this->session->set_flashdata("message","Uknown Error. Some email might sent. Please try again.");
                    redirect(base_url()."invite");
                }
                else
                {
                if($this->invite_model->select_invite_model($cq->customer_hash,$e)->num_rows() == 0)
                {
                    if($e <> "" || $fn <> "" || $ln <> "")
                    {
                        $time = time();
                        $msg = "
                        <div style=\"background:url('".base_url()."assets/vigattin_deals/images/background.png') no-repeat; font-family:arial; height:305px; padding-top: 30px; padding-left: 130px\">
                            Good Day!<br />
                            <b>".strtoupper($fn)." ".strtoupper($ln)."!</b><br /><br />
                            <span style='color:#ff6b00; font-size:18px; font-weight:bold;'>".strtoupper($this->session->userdata("vigdeals_login_name"))."</span> wants you to join in our Vigattin Community.<br />
                            Don't miss it! By clicking 'Sign Up' button below.<br /><br /><br />
                            <div style='width:80px; background:#ff6b00; color:white; font-weight:bold; text-align:center;'><a href='".base_url()."vigdeals/vigdealswauth/signup?ref=".$cq->customer_hash."&myemail=".$e."&fn=".$fn."&ln=".$ln."&t=".$time."'>Sign Up</a></div>
                        </div>
                        ";
                        $this->load->library('email');
                        $config['mailtype'] = 'html';
                        $this->email->initialize($config);
                        $this->email->from("admin@vigattin.org");
                        $this->email->to($e);
                        $this->email->subject('Vigattin Deals Invitation');
                        $this->email->message($msg);
                        $this->email->send();

                        $cq = $this->customer_model->select_data_customer_id($this->session->userdata("vigattin_id"))->row();
                        $customerd = $cq;
                        $data['customer_hash'] = $customerd->customer_hash;
                        $data['invited_email'] = $e;
                        $data['invited_fname'] = $fn;
                        $data['invited_lname'] = $ln;
                        $data['invited_date'] = $time;
                        $data['invited_via'] = "mail";
                        $this->invite_model->insert_invite_model($data);
                    }
                }
                else
                {
                    $err++;
                }
                }
            }
            $error = array("ni" => $_POST['inv-ni'], "err" => $err);
            if($error["ni"] == 1 && $error["err"] == 1)
            {
                $this->session->set_flashdata("message","Email Not Sent. The email address might already exist.");
                redirect(base_url()."invite");
            }
            elseif($error["ni"] > 1 && $error["err"] > 0)
            {
                $this->session->set_flashdata("message","Some email might have been sent and others might already exist.");
                redirect(base_url()."invite");
            }
            elseif($error["ni"] > 1 && $error["err"] == 0)
            {
                $this->session->set_flashdata("message","Emails Sent");
                redirect(base_url()."invite");
            }
            elseif($error["ni"] == 1 && $error["err"] == 0)
            {
                $this->session->set_flashdata("message","Email Sent.");
                redirect(base_url()."invite");
            }
        }
        function invitedfriends()
        {
            $cq = $this->customer_model->select_data_customer_id($this->session->userdata("vigattin_id"))->row();
            $data['invited_r'] = $this->invite_model->select_invite_model2($cq->customer_hash)->result();
            $data["random_deals"] = $this->deals_view_model->select_data_dealsview3()->result();
            $this->load->view("layouts/vd_layout_h");
            $this->load->view("vigdeals/invite/invited_view",$data);
            $this->load->view("layouts/vd_layout_f");
        }
        function recommenddeal()
        {
            $data["random_deals"] = $this->deals_view_model->select_data_dealsview3()->result();
            $this->load->view("layouts/vd_layout_h");
            $this->load->view("vigdeals/recommend/index_view",$data);
            $this->load->view("layouts/vd_layout_f");
        }
        function vouchdel()
        {
            $vq = $this->order_model->select_data_order4($this->session->userdata("vigattin_id"),$this->input->post("vidd"));
            $vqq = $vq->row();
            $orurl = $this->input->post("orurl");
            if($vq->num_rows() == 1)
            {
                $this->order_model->delete_data_order($this->input->post("vidd"));
                echo
                '
                <base href="'.base_url().'">
                <script type="text/javascript" src="assets/general/js/jquery.js"></script> 
                <script>
                $(document).ready(function()
                {
                $("html,body",window.parent.document).scrollTop(0);
                $("#errormsg",window.parent.document).remove();
                $errormsg = "Voucher Successfully Deleted!";
                $("body",window.parent.document).prepend(\'<div id="errormsg">\'+$errormsg+\'</div>\');
                $("#errormsg",window.parent.document).css({"background":"green"});
                $("#navigation",window.parent.document).css({"top":"20px"});
                $("#recommendframe",window.parent.document).fadeOut(function()
                {
                $("body",window.parent.document).css({overflow:"auto"});
                });
                $("#errormsg",window.parent.document).delay(5000).animate({"margin-top":"-20px"},function()
                {
                $(this).remove();
                $("#navigation",window.parent.document).css({"top":"0px"});
                $("#recommendframe",window.parent.document).remove();
                });
                $("#voucher-c",window.parent.document).empty();
                $("#voucher-c",window.parent.document).append("<div style=\'text-align:center; font-size:14px;\'><img src=\'assets/vigattin_deals/images/loading2.gif\'><br />Please wait reloading your voucher...</div>");
                $("#voucher-c",window.parent.document).load("'.$orurl.' #voucher-c",function()
                {
                parent.$.getScript("assets/vigattin_deals/js/order.js");
                $("#iforders",window.parent.document).remove();
                $("iframe",window.parent.document).remove();
                });
                })
                </script>
                ';
            }
        }
        function recommendeddeals()
        {
            $cust = $this->customer_model->select_data_customer_id($this->session->userdata("vigattin_id"));
            $custg = $cust->row();
            $custg = $custg->customer_gender;
            $query = $this->deals_view_model->select_data_dealsview_gender($custg)->result();
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
            $this->load->view("layouts/vd_layout_h");
            $this->load->view("vigdeals/recommendeddeals/index_view",$data);
            $this->load->view("layouts/vd_layout_f");
        }


        function recommendnow()
        {
            $this->checkisonoff("recommendnow");
            $sf = $this->input->post("sf");
            $p = $this->input->post("p");
            $m = $this->input->post("m");
            $user1 = $this->session->userdata("vigattin_id");
            $user2 = 123456;//sample
            $rq = $this->deals_model->select_data_deal_with_title(str_replace("!","",$p));
            if($rq->num_rows() == 1)
            {
                $rqq = $rq->row();
                $key = md5($rqq->deal_id.$user1.$user2.time()."C@|2|_");
                $rhref = base_url()."recommended/".$rqq->deal_subhash."?ref=".$user1."&u=".$user2."&key=".$key."";
                $msg = 
                "Good Day!<br />
                ".$sf."!<br /><br />
                '".$m."'<br /><br />
                <a href='".$rhref."'>VIG IT NOW!</a>";
                $data['message'] = $msg;
                $data['user_1'] = $user1;
                $data['user_2'] = $user2;
                $this->messaging_model->insert_data_messaging($data);
                $data2['deal_id'] = $rqq->deal_id;
                $data2['user_1'] = $user1;
                $data2['user_2'] = $user2;
                $data2['recommend_key'] = $key;
                $this->recommend_model->insert_data_recommend($data2);
                echo
                '
                <script type="text/javascript" src="assets/general/js/jquery.js"></script> 
                <script>
                $(document).ready(function()
                {
                $("html,body",window.parent.document).scrollTop(0);
                $("#errormsg",window.parent.document).remove();
                $errormsg = "Recommend Message Sent!";
                $("body",window.parent.document).prepend(\'<div id="errormsg">\'+$errormsg+\'</div>\');
                $("#errormsg",window.parent.document).css({"background":"green"});
                $("#navigation",window.parent.document).css({"top":"20px"});
                $("#recommendframe",window.parent.document).fadeOut(function()
                {
                alert("Press CTRL+C or Highlight text then CTRL+C to copy the link on the next alert box. The link is the same to the link that has been sent to the receiver.");
                alert("'.$rhref.'");
                $("body",window.parent.document).css({overflow:"auto"});
                });
                $("#errormsg",window.parent.document).delay(5000).animate({"margin-top":"-20px"},function()
                {
                $(this).remove();
                $("#navigation",window.parent.document).css({"top":"0px"});
                $("#recommendframe",window.parent.document).remove();
                });
                })
                </script>
                ';
            }
            else
            {
                echo
                '
                <script type="text/javascript" src="assets/general/js/jquery.js"></script> 
                <script>
                $(document).ready(function()
                {
                $("html,body",window.parent.document).scrollTop(0);
                $("#errormsg",window.parent.document).remove();
                $errormsg = "Recommend Deal Not Found!";
                $("body",window.parent.document).prepend(\'<div id="errormsg">\'+$errormsg+\'</div>\');
                $("#navigation",window.parent.document).css({"top":"20px"});
                $("#recommendframe",window.parent.document).fadeOut(function()
                {
                $("body",window.parent.document).css({overflow:"auto"});
                });
                $("#errormsg",window.parent.document).delay(5000).animate({"margin-top":"-20px"},function()
                {
                $(this).remove();
                $("#navigation",window.parent.document).css({"top":"0px"});
                $("#recommendframe",window.parent.document).remove();
                });
                })
                </script>
                ';
            }
        }
        function recommended()
        {
            $dealh = $this->uri->segment(2);
            $ref = $_GET['ref'];
            $u = $_GET['u'];
            $key = $_GET['key'];
            $datas = array("user_1" => $ref, "user_2" => $u, "recommend_key" => $key, "recommend_confirm" => 0);
            $rq = $this->recommend_model->select_data_recommend($datas);
            if($rq->num_rows() == 1)
            {
                $rid = $rq->row();
                $rid = $rid->recommend_id;
                $data['recommend_confirm'] = 1;
                $this->recommend_model->update_data_recommend($rid,$data);
                $gold = $this->customer_model->select_data_customer_id($ref)->row();
                $gold = $gold->dummygold;
                $reward = $this->reward_model->select_data_reward("recommend")->row();
                $data2["dummygold"] = ($gold + $reward->reward_gold);
                $this->customer_model->update_data_customer_id2($data2,$ref);
                $this->session->set_flashdata("message","Thank you for buying the selected deal.");
                redirect(base_url());
            }
            else
            {
                $this->session->set_flashdata("message","The reward has been used or the deal might not exist.");
                redirect(base_url());
            };
        }
        function credits()
        {
            //$this->checkisonoff("credits");
            $data["random_deals"] = $this->deals_view_model->select_data_dealsview3()->result();
            $data["cg"] = $this->customer_model->select_data_customer_id($this->session->userdata("vigattin_id"))->row();
            $this->load->view("layouts/vd_layout_h");
            $this->load->view("vigdeals/dummycredits/index_view",$data);
            $this->load->view("layouts/vd_layout_f");
        }
        function link()
        {
            $this->checkisonoff("link");
            $id = $this->uri->segment(4);
            $gold = $this->customer_model->select_data_customer_id($this->session->userdata("vigattin_id"))->row();
            $gold = $gold->dummygold;
            $reward = $this->reward_model->select_data_reward("link")->row();
            $data["dummygold"] = ($gold + $reward->reward_gold);
            $this->customer_model->update_data_customer_hash($data,$id);
            $cq = $this->customer_model->select_data_customer_id($this->session->userdata("vigattin_id"))->row();
            $customerd = $cq;
            $data2['customer_hash'] = $customerd->customer_hash;
            $data2['invited_email'] = "sample@sample.com";
            $data2['invited_fname'] = "sample";
            $data2['invited_lname'] = "sample";
            $data2['invited_date'] = time();
            $data2['invited_via'] = "link";
            $data2['invited_registered'] = 1;
            $this->invite_model->insert_invite_model($data2);
            $this->session->set_flashdata("message","You are now officially registered! You are now Vigattin Member!");
            redirect(base_url());
        }
        function signup()
        {
            if($_GET['ref'] <> "" && $_GET['fn'] <> "" && $_GET['ln'] <> "" && $_GET['t'] <> "" && $_GET['myemail'] <> "")
            {
                $id = $_GET['ref'];
                $fn = $_GET['fn'];
                $ln = $_GET['ln'];
                $t = $_GET['t'];
                $ie = $_GET['myemail'];
                $iq = $this->invite_model->select_invite_model3($ln,$fn,$t,$ie,$id)->num_rows();
                if($iq == 1)
                {
                    $data2["invited_registered"] = 1;
                    $this->invite_model->update_invite_model($data2,$ln,$fn,$t,$ie,$id);
                    $gold = $this->customer_model->select_data_customer_hash($id)->row();
                    $gold = $gold->dummygold;
                    $reward = $this->reward_model->select_data_reward("mail")->row();
                    $data["dummygold"] = $gold + $reward->reward_gold;
                    $this->customer_model->update_data_customer_hash($data,$id);
                    $this->session->set_flashdata("message","You are now officially registered! You are now Vigattin Member!");
                    redirect(base_url());
                }
                else
                {
                    $this->session->set_flashdata("message","The info does not exist or maybe the following email is already registered.");
                    redirect(base_url());
                }
            }
            redirect(base_url());
        }
        //check cart
        public function checkcart($param)
        {
            if(isset($param))
            {
                if($param['status'] == 1)
                {
                    //send email
                    $fullname = $this->session->userdata("vigdeals_login_name");
                    $customer = $this->customer_model->get_where(array("customer_id"=>$this->session->userdata("vigattin_id")));
                    $time = date("F j, Y h:i a",$param['time']);
                    $reason = $param['reason'];
                    $name = $param['name'];
                    $payment = $this->order_model->get_where(array("order_hash"=>$name,"customer_id"=>$this->session->userdata("vigattin_id")));
                    $order_txn = $param['txnid'];
                    $order_txne = str_pad($order_txn, 10, '0', STR_PAD_LEFT);
                    $msg = 
                    "
                    <div style='width: 100%; background:#000000; color:white; font-family:arial; font-size:12px;'>
                        <div style='width:80%; background:#2b2b2b; margin:auto; border:1px solid #4d4d4d; padding:5px; overflow:auto;'>
                            <img src='".base_url()."assets/vigattin_deals/images/logo.png'><br />
                            <span style='font-weight:bold; font-size:16px;'>Hello, ".$fullname."</span>
                            <br /><br />
                            Thank you for your order from Vigattin Deals. Your voucher is now ready to print. If you have any questions about your order please contact us at support@vigattin.org or call us at 092721212121 Monday - Friday, 8am - 5pm PST.
                            <br />
                            Your order confirmation is below. Thank you again for your business.
                            <br /><br />
                            <span style='font-weight:bold; font-size:12px;'>Your Order #".$order_txne." (placed on '".$time."')</span>
                            <div style='margin-top:15px; width:100%; overflow:auto;'>
                                <div style='width:45%; border:1px solid #3F3F3F; padding:5px; float:left; margin-right:5px;'>
                                    <div style='background:#161616;text-indent:5px;'>Billing Information:</div>
                                    ".$fullname."<br />
                                    ".$customer->row("customer_address").",<br />
                                    ".$customer->row("customer_city").",<br />
                                    ".$customer->row("customer_province").",<br />
                                    Philippines<br />
                                    Contact #: ".$customer->row("customer_no")."
                                </div>
                                <div style='width:45%; border:1px solid #3F3F3F; padding:5px; float:left; margin-right:5px;'>
                                    <div style='background:#161616;text-indent:5px;'>Payment Method:</div>
                                    ".$reason."
                                </div>
                            </div>
                            <table style='color:white; font-size:12px; width:100%;margin-top:10px;'>
                                <thead style='background:#141414;'>
                                    <tr>
                                        <td style='width:40%;'>Item</td>
                                        <td style='width:30%;'>Qty</td>
                                        <td style='width:30%;'>Subtotal</td>
                                    </tr>
                                </thead>
                                <tbody>";
                                $totalprice = 0;
                                foreach($payment->result() as $row)
                                {
                                if($row->option_id == 0)
                                {
                                    $dcs = $this->deals_model->get_where(array("deal_id"=>$row->deal_id))->row("deal_current_stock");
                                    $dcs = $dcs - $row->order_quantity;
                                    //update current stock
                                    $update['deal_current_stock'] = $dcs;
                                    $where = array('deal_id'=>$row->deal_id);
                                    $this->deals_model->update($update,$where);
                                }
                                else
                                {
                                    $option = $row->option_id;
                                    $optiondcs = $this->deals_option_model->get_where(array("option_id"=>$option))->row("deal_currenct_stock");
                                    $optiondcs = $optiondcs - $row->order_quantity;
                                    //update current stock
                                    $update = "";
                                    $update['deal_current_stock'] = $optiondcs;
                                    $where = "";
                                    $where = array("option_id"=>$option);
                                    $this->deals_option_model->update($update,$where);
                                }
                                $dealid = $row->deal_id;
                                $deals = $this->deals_model->get_where(array("deal_id"=>$dealid))->row();
                                $dealquan = $row->order_quantity;
                                $dealprice = $deals->deal_discounted_price * $dealquan;
                                $totalprice = $totalprice + $dealprice;
                                
                                $msg .= "
                                    <tr>
                                        <td>".$deals->deal_title."</td>
                                        <td>".$dealquan."</td>
                                        <td>&nbsp;&nbsp;&nbsp;P ".number_format($dealprice).".00</td>
                                    </tr>";
                                }
                                $msg .= "
                                </tbody>
                                <tbody>
                                    <tr>
                                        <td></td>
                                        <td style='text-align:right;'><b>Grand Total</b></td>
                                        <td>&nbsp;&nbsp;&nbsp;<b>P ".number_format($totalprice).".00</b></td>
                                    </tr>
                                </tbody>
                            </table>
                            <div style='text-align:center; padding:5px; background:#141414;'>Thank you, <b>Vigattin Deals</b></div>
                        </div>
                    </div>
                    ";
                    $e = $this->session->userdata("vigattin_email");
                    $this->load->library('email');
                    $config['mailtype'] = 'html';
                    $this->email->initialize($config);
                    $this->email->from("admin@vigattin.org");
                    $this->email->to($e);
                    $this->email->subject('Vigattin Deals: New Order #'.$order_txne.'');
                    $this->email->message($msg);
                    $this->email->send();
                    //update status of order(s)
                    $update = "";
                    $update['order_status'] = "available";
                    $where = "";
                    $where = array("order_hash"=>$param['name']);
                    $this->order_model->update($update,$where);
                    //update order_txn
                    $update = "";
                    $update['order_txn'] = $order_txn;
                    $update['order_show'] = 1;
                    $where = "";
                    $where = array("order_hash"=>$name);
                    $this->order_model->update($update,$where);
                }
                elseif($param['status'] == 2)
                {
                    //send email
                    $fullname = $this->session->userdata("vigdeals_login_name");
                    $customer = $this->customer_model->get_where(array("customer_id"=>$this->session->userdata("vigattin_id")));
                    $time = date("F j, Y h:i a",$param['time']);
                    $reason = $param['reason'];
                    $name = $param['name'];
                    $payment = $this->order_model->get_where(array("order_hash"=>$name,"customer_id"=>$this->session->userdata("vigattin_id")));
                    $order_txn = $param['txnid'];
                    $order_txne = str_pad($order_txn, 10, '0', STR_PAD_LEFT);
                    $msg = 
                    "
                    <div style='width: 100%; background:#000000; color:white; font-family:arial; font-size:12px;'>
                        <div style='width:80%; background:#2b2b2b; margin:auto; border:1px solid #4d4d4d; padding:5px; overflow:auto;'>
                            <img src='".base_url()."assets/vigattin_deals/images/logo.png'><br />
                            <span style='font-weight:bold; font-size:16px;'>Hello, ".$fullname."</span>
                            <br /><br />
                            Thank you for your order from Vigattin Deals. Once your order/payment is confirmed we will send you an email with your Vigattin Deals voucher which you can use to claim your order. You have to check the status of your order by logging into your account to update the status of your order. If you have any questions about your order please contact us at support@vigattin.org or call us at 092721212121 Monday - Friday, 8am - 5pm PST.
                            <br />
                            Your order confirmation is below. Thank you again for your business.
                            <br /><br />
                            <span style='font-weight:bold; font-size:12px;'>Your Order #".$order_txne." (placed on '".$time."')</span>
                            <div style='margin-top:15px; width:100%; overflow:auto;'>
                                <div style='width:45%; border:1px solid #3F3F3F; padding:5px; float:left; margin-right:5px;'>
                                    <div style='background:#161616;text-indent:5px;'>Billing Information:</div>
                                    ".$fullname."<br />
                                    ".$customer->row("customer_address").",<br />
                                    ".$customer->row("customer_city").",<br />
                                    ".$customer->row("customer_province").",<br />
                                    Philippines<br />
                                    Contact #: ".$customer->row("customer_no")."
                                </div>
                                <div style='width:45%; border:1px solid #3F3F3F; padding:5px; float:left; margin-right:5px;'>
                                    <div style='background:#161616;text-indent:5px;'>Payment Method:</div>
                                    ".$reason."
                                </div>
                            </div>
                            <table style='color:white; font-size:12px; width:100%;margin-top:10px;'>
                                <thead style='background:#141414;'>
                                    <tr>
                                        <td style='width:40%;'>Item</td>
                                        <td style='width:30%;'>Qty</td>
                                        <td style='width:30%;'>Subtotal</td>
                                    </tr>
                                </thead>
                                <tbody>";
                                $totalprice = 0;
                                foreach($payment->result() as $row):
                                
                                $dealid = $row->deal_id;
                                $deals = $this->deals_model->get_where(array("deal_id"=>$dealid))->row();
                                $dealquan = $row->order_quantity;
                                $dealprice = $deals->deal_discounted_price * $dealquan;
                                $totalprice = $totalprice + $dealprice;
                                
                                $msg .= "
                                    <tr>
                                        <td>".$deals->deal_title."</td>
                                        <td>".$dealquan."</td>
                                        <td>&nbsp;&nbsp;&nbsp;P ".number_format($dealprice).".00</td>
                                    </tr>";
                                endforeach;
                                $msg .= "
                                </tbody>
                                <tbody>
                                    <tr>
                                        <td></td>
                                        <td style='text-align:right;'><b>Grand Total</b></td>
                                        <td>&nbsp;&nbsp;&nbsp;<b>P ".number_format($totalprice).".00</b></td>
                                    </tr>
                                </tbody>
                            </table>
                            <div style='text-align:center; padding:5px; background:#141414;'>Thank you, <b>Vigattin Deals</b></div>
                        </div>
                    </div>
                    ";
                    $e = $this->session->userdata("vigattin_email");
                    $this->load->library('email');
                    $config['mailtype'] = 'html';
                    $this->email->initialize($config);
                    $this->email->from("admin@vigattin.org");
                    $this->email->to($e);
                    $this->email->subject('Vigattin Deals: New Order #'.$order_txne.'');
                    $this->email->message($msg);
                    $this->email->send();
                    //update order_txn
                    $update = "";
                    $update['order_txn'] = $order_txn;
                    $update['order_show'] = 1;
                    $where = "";
                    $where = array("order_hash"=>$name);
                    $this->order_model->update($update,$where);
                }
                elseif($param['status'] == 3 || $param['status'] == 0)
                {
                    
                }
            }
            else
            {
                $this->session->set_flashdata("message","You are not allowed to view that content.");
                redirect(base_url());
            }
        }
        //PRIVATES
        //add to cart
        private function addtocart($dh,$dh2="")
        {
            if(isset($dh) && !isset($dh2))
            {
                $did = $this->deals_model->get_where(array("deal_hash"=>$dh))->row("deal_id");
                $vid = $this->session->userdata("vigattin_id");
                $dc = $this->deals_cart_model->get_where(array("deal_id"=>$did,"customer_id"=>$vid))->num_rows();
                if($dc == 0)
                {
                    $insert['deal_id'] = $did;
                    $insert['customer_id'] = $vid;
                    $insert['deal_cart_date'] = time();
                    $this->deals_cart_model->insert($insert);
                }
            }
            elseif(isset($dh) && isset($dh2))
            {
                $sd = $this->deals_model->get_where(array("deal_hash"=>$dh))->result();
                $wsd = 0;
                foreach($sd as $sdr)
                {
                    if($wsd == $dh2)
                    {
                        $did = $sdr->deal_id;
                        $wsd++;
                    }
                    else
                    {
                        $wsd++;
                    }
                }
                $vid = $this->session->userdata("vigattin_id");
                $dc = $this->deals_cart_model->get_where(array("deal_id"=>$did,"customer_id"=>$vid))->num_rows();
                if($dc == 0)
                {
                    $insert['deal_id'] = $did;
                    $insert['customer_id'] = $vid;
                    $insert['deal_cart_date'] = time();
                    $this->deals_cart_model->insert($insert);
                }
            }
            else
            {
                $this->session->set_flashdata("message","Invalid Deal");
                redirect(base_url());
            }
        }
    }
?>
