<?php
    class Mobile extends MX_Controller
    {
        function __construct()
        {
            parent::__construct();
            $this->load->library("CLLibrary");
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
                    $this->session->set_userdata(array('vigdeals_login_state' => TRUE, 'vigdeals_login_name' => $deals_user_data->row('customer_firstname') . " " . $deals_user_data->row('customer_lastname'), 'vigattin_id' => $deals_user_data->row('customer_id'), 'vigattin_email' => $deals_user_data->row('customer_email'), 'vigattin_firstname' => $deals_user_data->row('customer_firstname'), 'vigattin_lastname' => $deals_user_data->row('customer_lastname')));
                }
            }
        }
        function index()
        {
            if(strtolower($this->uri->segment(2)) <> "category")
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
                $uri2 = $this->uri->segment(3);
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
            $data["deals_category"] = $this->deals_category_model->select_data_deal_category()->result();
            
            $this->load->view("layouts/vdm_layout_h");
            $this->load->view("mobile/mobile/index_view",$data);
            $this->load->view("layouts/vdm_layout_f");
        }
        function view()
        {
            if($this->deals_view_model->select_data_dealsview2($this->uri->segment(3))->num_rows() > 0)
            {
                $q = $this->deals_view_model->select_data_dealsview2($this->uri->segment(3))->row();
                $data["location_limit"] = $this->deals_location_model->displaylocation_limit($this->uri->segment(3))->result();
                $data["location"] = $this->deals_location_model->displaylocation($this->uri->segment(3))->result();
                if(strtolower($q->deal_view_type) == "single deal")
                {
                    $data["deals_view"] = $this->deals_view_model->select_data_dealsview2($this->uri->segment(3))->result();
                    //info
                    $sh = $q->deal_subhash;
                    $data['galleries'] = $this->deals_gallery_model->select_data_gallery2($q->deal_subhash)->result();
                    $data["fineprint"] = $this->deals_view_model->select_data_fineprint($sh)->result();
                    $data["highlight"] = $this->deals_view_model->select_data_higlight($sh)->result();
                    $data['desc'] = $this->deals_model->select_data_deal_fb($sh)->row();
                }
                elseif($this->uri->segment(4) == "")
                {
                    $data["deals"] = $this->deals_model->select_data_deals($this->uri->segment(3))->result();
                }
                else
                {
                    $sdquery = $this->deals_model->select_data_deals3($this->uri->segment(3),abs($this->uri->segment(4)));
                    if($sdquery->num_rows() > 0)
                    {
                        $sdq = $sdquery->row();
                        $sdid = $sdq->deal_id;
                        $data["deals_view"] = $this->deals_model->select_data_deals2($sdid)->result();
                        //info
                        $sh = $sdq->deal_subhash;
                        $data['galleries'] = $this->deals_gallery_model->select_data_gallery($sh)->result();
                        $data["fineprint"] = $this->deals_view_model->select_data_fineprint($sh)->result();
                        $data["highlight"] = $this->deals_view_model->select_data_higlight($sh)->result();
                        $data['desc'] = $this->deals_model->select_data_deal_fb($sh)->row();
                    }
                    else
                    {
                        $this->session->set_flashdata("message","Deal Not Found.");
                        redirect(base_url()."mobile/deal/".$this->uri->segment(3));
                    }
                }
                $data["deals_category"] = $this->deals_category_model->select_data_deal_category()->result();
                $this->load->view("layouts/vdm_layout_h",$data);
                $this->load->view("mobile/deal_view/index_view",$data);
                $this->load->view("layouts/vdm_layout_f");
            }
            else
            {
                $this->session->set_flashdata("message","Deal Not Found.");
                redirect(base_url()."mobile");
            }
        }
        function profile()
        {
            if($this->customer_model->select_data_customer_id($this->session->userdata("vigattin_id"))->num_rows() > 0)
            {
                $data['profile_infos'] = $this->customer_model->select_data_customer_id($this->session->userdata("vigattin_id"))->result();
                $this->load->view("layouts/vdm_layout_h");
                $this->load->view("mobile/profile/index_view",$data);
                $this->load->view("layouts/vdm_layout_f");
            }
            else
            {
                $this->load->view("layouts/vdm_layout_h");
                $this->load->view("mobile/profile/index_view");
                $this->load->view("layouts/vdm_layout_f");
            }
        }
        function orders()
        {
            $allord = $this->order_model->select_data_order($this->session->userdata("vigattin_id"));
            foreach($allord->result() as $orders)
            {
                $txn = $orders->order_txn;
            }
            if($this->uri->segment(3) == "page" || $this->uri->segment(3) == "")
            {
                $this->load->library('pagination');
                $config['base_url'] = base_url()."mobile/orders/page";
                $cnt = 10;
                $page = $this->uri->segment(4);
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
                
                $this->load->view("layouts/vdm_layout_h");
                $this->load->view("mobile/order/index_view",$data);
                $this->load->view("layouts/vdm_layout_f");
            }
        }
        function pastdeals()
        {
            if(strtolower($this->uri->segment(2)) <> "past-category")
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
            else
            {
                $uri3 = $this->uri->segment(3);
                $strpos = stripos($uri3,"-");
                $cat_id = substr($uri3,0, $strpos);
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
            $data["deals_category"] = $this->deals_category_model->select_data_deal_category()->result();
            $data["pd_rows"] = $pd->num_rows();
            $data["past_deals"] = $pd->result();
            $this->load->view("layouts/vdm_layout_h");
            $this->load->view("mobile/pastdeals/index_view",$data);
            $this->load->view("layouts/vdm_layout_f");
        }
        function pastdeals_view()
        {
            if($this->deals_view_model->select_data_dealsview6($this->uri->segment(3))->num_rows() > 0)
            {
                $q = $this->deals_view_model->select_data_dealsview6($this->uri->segment(3))->row();
                $data["location_limit"] = $this->deals_location_model->displaylocation_limit($this->uri->segment(3))->result();
                $data["location"] = $this->deals_location_model->displaylocation($this->uri->segment(3))->result();
                if(strtolower($q->deal_view_type) == "single deal")
                {
                    $data["deals_view"] = $this->deals_view_model->select_data_dealsview6($this->uri->segment(3))->result();
                    //info
                    $sh = $q->deal_subhash;
                    $data["fineprint"] = $this->deals_view_model->select_data_fineprint($sh)->result();
                    $data["highlight"] = $this->deals_view_model->select_data_higlight($sh)->result();
                    $data['desc'] = $this->deals_model->select_data_deal_fb($sh)->row();
                }
                elseif($this->uri->segment(4) == "")
                {
                    $data["deals"] = $this->deals_model->select_data_deals($this->uri->segment(3))->result(); 
                }
                else
                {
                    $sdquery = $this->deals_model->select_data_deals3($this->uri->segment(3),abs($this->uri->segment(4)));
                    if($sdquery->num_rows() > 0)
                    {
                        $sdid = $sdquery->row();
                        $sdid = $sdid->deal_id;
                        $data["subdeals"] = $this->deals_model->select_data_deals2($sdid)->result();
                        //info
                        $sh = $q->deal_subhash;
                        $data["fineprint"] = $this->deals_view_model->select_data_fineprint($sh)->result();
                        $data["highlight"] = $this->deals_view_model->select_data_higlight($sh)->result();
                        $data['desc'] = $this->deals_model->select_data_deal_fb($sh)->row();
                    }
                    else
                    {
                        $this->session->set_flashdata("message","Past Deal Not Found.");
                        redirect(base_url()."mobile/past_deals/".$this->uri->segment(3));
                    }
                }

                $data["deals_category"] = $this->deals_category_model->select_data_deal_category()->result();
                $this->load->view("layouts/vdm_layout_h",$data);
                $this->load->view("mobile/pastdeals/pastdeals_view",$data);
                $this->load->view("layouts/vdm_layout_f");
            }
            else
            {
                $this->session->set_flashdata("message","Past Deal Not Found.");
                redirect(base_url()."mobile/past_deals");
            }
        }
        //step 1
        function review2()
        {
            $uri3 = $this->uri->segment(3);
            $uri4 = abs($this->uri->segment(4));
            
            $q = $this->deals_view_model->select_data_dealsview2($uri3)->row();
            
            if(strtolower($q->deal_view_type) == "single deal")
            {
                $this->addtocart($uri3);
                redirect(base_url()."mobile/review");    
            }
            elseif(strtolower($q->deal_view_type) == "group deal")
            {
                $deals = $this->deals_model->select_data_deals3($uri3,$uri4);
                if($deals->num_rows() == 1)
                {
                    $q = $deals->row();
                    if($q->deal_option == 1)
                    {
                        if($q->deal_current_stock == 0)
                        {
                            $this->session->set_flashdata("message","Deal is out of stock");
                            redirect(base_url()."mobile/review");
                        }
                        else
                        {
                            $this->addtocart($uri3,$uri4);
                            redirect(base_url()."mobile/review");
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
                            $this->addtocart($uri3,$uri4);
                            redirect(base_url()."mobile/review");
                        }
                    }
                }
            }
            else
            {
                 $this->session->set_flashdata("message","Deal not found");
                 redirect(base_url()."mobile");
            }
        }
        //step 2
        function review()
        {
            $my_cart = $this->deals_cart_model->select_data_cart($this->session->userdata("vigattin_id"));
            $reviewcontent = "";
            if($my_cart->num_rows > 0){
            $cartnum = 0;
            $reviewcontent .= "
            <div style=\"padding: 5px;\">Select All<input type=\"checkbox\"></div>
            <form action=\"mobile/payment\" method=\"post\">";
            foreach($my_cart->result() as $my_crow)
            {
            $cartnum++;
            $reviewcontent .= "
                <table>
                    <tr>
                        <td><b>Item #".$cartnum.":</b>
                            <div><input type=\"checkbox\" name='addtocart".$cartnum."'></div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <b>Deal:</b>
                        <div>
                            <img src=\"assets/general/images/deals_gallery/customize/".$my_crow->gallery_filename."\" alt=\"\"><br />
                            ".$my_crow->deal_title."
                        </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <b>Quantity:</b>
                        <div>
                            <input type=\"number\" value=\"1\" min=\"1\" name=\"quantity".$cartnum."\" max=\"".$my_crow->deal_current_stock."\">
                        </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Redemption Branch/Send to:</b>
                            <div>
                                <select name='loc".$cartnum."'>";
            //get location 
            $location = $this->deals_location_model->get_where(array("deal_hash"=>$my_crow->deal_hash));
            $locnum = $location->num_rows();
            $locr = $location->result();
            $loc = 0;
            if($locnum > 1)
            {
            $reviewcontent .= "
                                    <option value=\"0\">Select Address</option>";
            }
            foreach($locr as $locr)
            {
            $loc++;
            $reviewcontent .= "
                                    <option value=\"".$loc."\">".$locr->location_address."</option>";
            }
            $reviewcontent .= "        
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Unit Price:</b>
                            <div>
                                P ".number_format($my_crow->deal_discounted_price)."
                            </div>                        
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Total Price:</b>
                            <div>
                                P <b>".number_format($my_crow->deal_discounted_price)."</b>
                            </div>                        
                        </td>
                    </tr>
                </table>
                <div style='border-bottom: 2px dashed white; margin-bottom: 10px;margin-top: 10px;'></div>";
            }
            $reviewcontent .= "
                <input type=\"submit\" id=\"rpc-btn-n\" value=\"NEXT\">
                <a href=\"mobile\">
                    <div id=\"rpc-btn-b\">Shop More</div>
                </a>
            </form>";
            }
            else
            {
            $reviewcontent .= "
            <div id='emptycart'>Empty Cart</div>";
            }
            $data['reviewcontent'] = $reviewcontent;
            $this->load->view("layouts/vdm_layout_h");
            $this->load->view("mobile/review/index_view",$data);
            $this->load->view("layouts/vdm_layout_f");
        }
        //step 3
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
                        redirect(base_url()."mobile/review");
                    }
                    else
                    {
                        $cartsnum++;
                        $location = $_POST["loc$i"];
                        $quantity = $_POST["quantity$i"];
                        //check location;
                        if($location == 0)
                        {
                            $this->session->set_flashdata("post_data",true);
                            $this->session->set_flashdata("message","Please select location.");
                            redirect(base_url()."mobile/review");
                        }
                        //check quantity
                        elseif($quantity == 0)
                        {
                            $this->session->set_flashdata("post_data",true);
                            $this->session->set_flashdata("message","Please input quantity.");
                            redirect(base_url()."mobile/review");
                        }
                        //has option
                        elseif($cartsrow->deal_option == 0)
                        {
                            if(isset($_POST["option$i"]))
                            {
                                $option = $_POST["option$i"];
                            }
                            else
                            {
                                $this->session->set_flashdata("post_data",true);
                                $this->session->set_flashdata("message","Please select at least one option on the following deals with option.");
                                redirect(base_url()."mobile/review");
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
                                redirect(base_url()."mobile/review");
                            }
                            //CHECK IF CUSTOMER QUANTITY IS GREATER THAN REMAINING STOCK(S)
                            elseif($stock < $quantity)
                            {
                                $this->session->set_flashdata("post_data",true);
                                $this->session->set_flashdata("message","Invalid Quantity. Please try again.");
                                redirect(base_url()."mobile/review");
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
                                redirect(base_url()."mobile/review");
                            }
                            if($stock == 0)
                            {
                                $this->session->set_flashdata("message","Deal out of stock.");
                                redirect(base_url()."mobile/review");
                            }
                            //CHECK IF CUSTOMER QUANTITY IS GREATER THAN REMAINING STOCK(S)
                            elseif($stock < $quantity)
                            {
                                $this->session->set_flashdata("post_data",true);
                                $this->session->set_flashdata("message","Invalid Quantity. Please try again.");
                                redirect(base_url()."mobile/review");
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
                        redirect(base_url()."mobile/review");
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
                redirect(base_url()."mobile/review");
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
                $data['summary'] .= '
                <div class=\'summary-b\'>
                    <img src="assets/general/images/deals_gallery/customize/'.$row->gallery_filename.'" alt=""><br />
                    <span>'.$row->deal_title.'</span><br /><br />
                    Redemption Branch/Send to: <span>'.$location.'</span><br />
                    Original Price: <span>'.number_format($row->deal_original_price).'</span><br /><br />
                    Quantity: <span>'.$row->quantity.'</span><br />
                    Unit Price: <span>P '.number_format($row->deal_discounted_price).'</span><br /><br /><br />
                    Total Price: <span>P '.number_format($tp).'</span>
                    <hr>
                </div>';
                }
                $data['summary'] .= '
                <div id=\'rpc-body-revw-totals\'>
                    <span>Total:</span> P '.number_format($total).'<br />
                    <span style="font-style: italic;">Saved From Vigdeals:</span> P '.number_format($saved).'
                </div>
                ';
                $this->load->view("layouts/vdm_layout_h");
                $this->load->view("mobile/payment/index_view",$data);
                $this->load->view("layouts/vdm_layout_f");
            }
        }
        //step 4
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
                redirect(base_url()."mobile/account/edit");
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
                    $insert['voucher_no'] = str_pad($que->deal_id, 6, '0', STR_PAD_LEFT) . str_pad($vouchno+1, 6, '0', STR_PAD_LEFT);
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
                redirect(base_url()."mobile");
            }
        }
        function printvouch()
        {
            $uri2 = $this->uri->segment(3);
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
                    $this->load->view("mobile/print/index_view",$data);
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
    }
?>
