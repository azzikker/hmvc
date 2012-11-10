<?php //  vauth v0.9.1

class vauth {
	
	public $AUTH_DOMAIN = 'http://vigattin.org.ph';
	public $REDIRECT_URL;
	private $CI;
	
	public function __construct()
	{
		$this->CI = &get_instance();
		$this->CI->load->config('config');
        $this->CI->load->library('session');
		$this->REDIRECT_URL = $this->CI->config->item('base_url');
		if((isset($_GET['logout'])) && ($_GET['logout'] ==  'user') && $this->CI->uri->segment(1) <> "deal")
		{
			header('P3P: CP="NOI ADM DEV COM NAV OUR STP"');
			$this->clear_data();
			exit();
		}
		if((isset($_GET['login'])) && ($_GET['login'] ==  'user') && $this->CI->uri->segment(1) <> "deal")
		{
			header('P3P: CP="NOI ADM DEV COM NAV OUR STP"');
			$info = $this->parse_info();
			$this->save_to_session($info);
			exit();
		}
		if(!$this->is_login() && $this->CI->uri->segment(1) <> "deal")
		{
			header('Location: '.$this->AUTH_DOMAIN.'?redirect='.urlencode($this->REDIRECT_URL));
			exit();
		}
	}
	public function is_login()
	{
		if($this->CI->session->userdata('vauth_id')) return true;
		else return false;
	}
	public function get_id()
	{
		return $this->CI->session->userdata('vauth_id');
	}
	public function get_username()
	{
		return $this->CI->session->userdata('vauth_username');
	}
	public function get_first_name()
	{
		return $this->CI->session->userdata('vauth_first_name');
	}
	public function get_last_name()
	{
		return $this->CI->session->userdata('vauth_last_name');
	}
	public function get_gender()
	{
		return $this->CI->session->userdata('vauth_gender');
	}
	public function get_email()
	{
		return $this->CI->session->userdata('vauth_email');
	}
	public function get_name()
	{
		return $this->CI->session->userdata('vauth_name');
	}
	public function get_picture($size = 'normal' /* small, normal or large */)
	{
		return 'http://graph.facebook.com/'.$this->get_id().'/picture?type='.$size;
	}
	public function logout($redirect_url = '')
	{
		$this->CI->session->set_userdata(array('vauth_id' => ''));
		if($redirect_url) 
		{
			header('Location: '.$redirect_url);
			exit();
		}
	}
	public function clear_data()
	{
		$this->CI->session->set_userdata('vauth_id', '');
		$this->CI->session->set_userdata('vauth_username', '');
		$this->CI->session->set_userdata('vauth_first_name', '');
		$this->CI->session->set_userdata('vauth_last_name', '');
		$this->CI->session->set_userdata('vauth_gender', '');
		$this->CI->session->set_userdata('vauth_email', '');
		$this->CI->session->set_userdata('vauth_name', '');
	}
	
	// private
	private function parse_info()
	{
		$info = '';
		if(isset($_GET['info']))
		{
			$info = unserialize(urldecode(base64_decode($_GET['info'])));
		}
		return $info;
	}
	private function save_to_session($info)
	{
		if(is_array($info))
		{
			return $this->CI->session->set_userdata($info);
		}
		else return false;
	}
	
}