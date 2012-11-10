<?php
    class Mobile_Profile extends MX_Controller
    {
        function __construct()
        {
            parent::__construct();
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
                    $this->session->set_userdata(array('vigdeals_login_state' => TRUE, 'vigdeals_login_name' => $deals_user_data->row('customer_firstname') . " " . $deals_user_data->row('customer_lastname'), 'vigattin_id' => $deals_user_data->row('customer_id'), 'vigattin_email' => $deals_user_data->row('customer_email'), 'vigattin_firstname' => $deals_user_data->row('customer_firstname'), 'vigattin_lastname' => $deals_user_data->row('customer_lastname')));
                }
            }
        }
        function edit()
        {
            if($this->customer_model->select_data_customer_id($this->session->userdata("vigattin_id"))->num_rows() > 0)
            {
                $data['profile_infos'] = $this->customer_model->select_data_customer_id($this->session->userdata("vigattin_id"))->result();
                $this->load->view("layouts/vdm_layout_h");
                $this->load->view("mobile/profile/edit_view",$data);
                $this->load->view("layouts/vdm_layout_f");
            }
            else
            {
                redirect("mobile/account");
            }
        }
        function update()
        {
            if(isset($_POST['info']))
            {
                if($_POST['m-cno'] <> "" && $_POST['m-zc'] <> "" && $_POST['m-add'] <> "" && $_POST['m-p'] <> "" && $_POST['m-ct'] <> "")
                {
                    $id = $this->session->userdata("vigattin_id");
                    $data['customer_email'] = $this->session->userdata("vigattin_email");
                    $data['customer_no'] = $_POST['m-cno'];
                    $data['customer_zipcode'] = $_POST['m-zc'];
                    $data['customer_address'] = $_POST['m-add'];
                    $data['customer_city'] = $_POST['m-ct'];
                    $data['customer_province'] = $_POST['m-p'];
                    $this->customer_model->update_data_customer_id($data,$id);
                    redirect("mobile/account");
                }
                else
                {
                    redirect("mobile/account/edit?e=fillallblanks");
                }
            }
            else
            {
                redirect("mobile/account");
            }
        }
        function save()
        {
            if(isset($_POST['info']))
            {
                if($_POST['m-cno'] <> "" && $_POST['m-zc'] <> "" && $_POST['m-add'] <> "" && $_POST['m-p'] <> "" && $_POST['m-ct'] <> "")
                {
                    $data['customer_id'] = $this->session->userdata("vigattin_id");
                    $data['customer_email'] = $this->session->userdata("vigattin_email");
                    $data['customer_no'] = $_POST['m-cno'];
                    $data['customer_zipcode'] = $_POST['m-zc'];
                    $data['customer_address'] = $_POST['m-add'];
                    $data['customer_city'] = $_POST['m-ct'];
                    $data['customer_province'] = $_POST['m-p'];
                    $this->customer_model->insert_data_customer($data);
                    redirect("mobile/account");
                }
                else
                {
                    redirect("mobile/account?e=fillallblanks");
                }
            }
            else
            {
                redirect("mobile/account");
            }
        }
    }
?>
