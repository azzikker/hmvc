<?php
    class Vigdeals_Profile extends MX_Controller
    {
        function __construct()
        {
            parent::__construct();
            $this->load->helper("green");
            $this->load->model("customer_model");
            $this->load->model("deals_model");
            $this->load->model("deals_view_model");

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
        function save_info()
        {
            if($this->customer_model->select_data_customer_id_boolean($this->session->userdata("vigattin_id")) == false)
            {
                if($this->customer_model->select_data_customer_email_boolean($this->session->userdata("vigattin_email")) == false)
                {
                    $data['customer_date'] = time();
                    $data['customer_hash'] = md5($this->session->userdata("vigattin_id") . $this->session->userdata("vigattin_email"));
                    $data['customer_id'] = $this->session->userdata("vigattin_id");
                    $data['customer_email'] = $this->session->userdata("vigattin_email");
                    //check user infos
                    $this->form_validation->set_rules('cn','Phone Number','trim|required|xss_clean|numeric');
                    $this->form_validation->set_rules('add','Address','trim|required|xss_clean');
                    $this->form_validation->set_rules('ct','City','trim|required|xss_clean');
                    $this->form_validation->set_rules('prov','Province','trim|required|xss_clean');
                    $this->form_validation->set_rules('zc','Zip Code','trim|required|xss_clean|numeric');
                    $this->form_validation->set_rules('sex','Gender','trim|required|xss_clean|numeric|max_length[1]|min_length[1]');
                    if($this->form_validation->run() == false)
                    {
                        $this->session->set_flashdata("message","Error Occurred! Please Try Again");
                        redirect(base_url()."account");
                    }
                    else
                    {
                        $data['customer_no'] = $_POST['cn'];
                        $data['customer_zipcode'] = $_POST['zc'];
                        $data['customer_address'] = $_POST['add'];
                        $data['customer_city'] = $_POST['ct'];
                        $data['customer_province'] = $_POST['prov'];
                        $data['customer_gender'] = $_POST['sex'];
                        $this->customer_model->insert_data_customer($data);
                        $this->session->set_flashdata("message","Your Info Successfully Saved");
                        redirect(base_url()."account");
                    }
                }
                else
                {
                     $this->session->set_flashdata("message","Email Already Exist.");
                    redirect(base_url());
                }
            }
            else
            {
                $this->update_info();
            }
        }
        function save_info_buy()
        {
            if($this->customer_model->select_data_customer_id_boolean($this->session->userdata("vigattin_id")) == false)
            {
                if($this->uri->segment(4) <> "" && $this->uri->segment(5) == "")
                {
                    if($this->customer_model->select_data_customer_email_boolean($this->session->userdata("vigattin_email")) == false)
                    {
                        $data['customer_date'] = time();
                        $data['customer_hash'] = md5($this->session->userdata("vigattin_id") . $this->session->userdata("vigattin_email"));
                        $data['customer_id'] = $this->session->userdata("vigattin_id");
                        $data['customer_email'] = $this->session->userdata("vigattin_email");
                        $data['customer_no'] = $_POST['cn'];
                        $data['customer_zipcode'] = $_POST['zc'];
                        $data['customer_address'] = $_POST['add'];
                        $data['customer_city'] = $_POST['ct'];
                        $data['customer_province'] = $_POST['prov'];
                        $data['customer_gender'] = $_POST['sex'];
                        $this->customer_model->insert_data_customer($data);
                        redirect("buy/".$this->uri->segment(4));
                    }
                    else
                    {
                        $this->session->set_flashdata("message","Email Already Exist.");
                        redirect(base_url());
                    }
                }
                elseif($this->uri->segment(4) <> "" && $this->uri->segment(5) <> "")
                {
                    if($this->customer_model->select_data_customer_email_boolean($this->session->userdata("vigattin_email")) == false)
                    {
                        $data['customer_date'] = time();
                        $data['customer_hash'] = md5($this->session->userdata("vigattin_id") . $this->session->userdata("vigattin_email"));
                        $data['customer_id'] = $this->session->userdata("vigattin_id");
                        $data['customer_email'] = $this->session->userdata("vigattin_email");
                        $data['customer_no'] = $_POST['cn'];
                        $data['customer_zipcode'] = $_POST['zc'];
                        $data['customer_address'] = $_POST['add'];
                        $data['customer_city'] = $_POST['ct'];
                        $data['customer_province'] = $_POST['prov'];
                        $data['customer_gender'] = $_POST['sex'];
                        $this->customer_model->insert_data_customer($data);
                        redirect(base_url()."buy/".$this->uri->segment(4)."/".$this->uri->segment(5));
                    }
                    else
                    {
                        $this->session->set_flashdata("message","Email Already Exist.");
                        redirect(base_url());
                    }
                }
            }
        }
        function update_info()
        {
            $id = $this->session->userdata("vigattin_id");
            //check user infos
            $this->form_validation->set_rules('cn','Phone Number','trim|required|xss_clean|numeric');
            $this->form_validation->set_rules('add','Address','trim|required|xss_clean');
            $this->form_validation->set_rules('ct','City','trim|required|xss_clean');
            $this->form_validation->set_rules('prov','Province','trim|required|xss_clean');
            $this->form_validation->set_rules('zc','Zip Code','trim|required|xss_clean|numeric');
            $this->form_validation->set_rules('sex','Gender','trim|required|xss_clean|numeric|max_length[1]|min_length[1]');
            
            if($this->form_validation->run() == false)
            {
                $this->session->set_flashdata("message","Error Occurred! Please Try Again");
                $this->session->set_flashdata("error",validation_errors());
                redirect(base_url()."account");
            }
            else
            {
                $data['customer_no'] = $_POST['cn'];
                $data['customer_zipcode'] = $_POST['zc'];
                $data['customer_address'] = $_POST['add'];
                $data['customer_city'] = $_POST['ct'];
                $data['customer_province'] = $_POST['prov'];
                $data['customer_gender'] = $_POST['sex'];
                $where['customer_id'] = $id;
                $this->customer_model->update($data,$where);
                redirect(base_url()."account");
            }
        }
        function update_info_buy()
        {
            if($this->uri->segment(4) <> "" && $this->uri->segment(5) == "")
            {
                $id = $this->session->userdata("vigattin_id");
                $data['customer_no'] = $_POST['cn'];
                $data['customer_zipcode'] = $_POST['zc'];
                $data['customer_address'] = $_POST['add'];
                $data['customer_city'] = $_POST['ct'];
                $data['customer_province'] = $_POST['prov'];
                $data['customer_gender'] = $_POST['sex'];
                $this->customer_model->update_data_customer_id($data,$id);
                redirect(base_url()."buy/".$this->uri->segment(4));
            }
            elseif($this->uri->segment(4) <> "" && $this->uri->segment(5) <> "")
            {
                $id = $this->session->userdata("vigattin_id");;
                $data['customer_no'] = $_POST['cn'];
                $data['customer_zipcode'] = $_POST['zc'];
                $data['customer_address'] = $_POST['add'];
                $data['customer_city'] = $_POST['ct'];
                $data['customer_province'] = $_POST['prov'];
                $data['customer_gender'] = $_POST['sex'];
                $this->customer_model->update_data_customer_id($data,$id);
                redirect(base_url()."buy/".$this->uri->segment(4)."/".$this->uri->segment(5));
            }
        }
    }  
?>
