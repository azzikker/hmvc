<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Vigattin_header extends MX_Controller {

	private $BASE_URL;
	private $MODULE_NAME = 'vigattin_header';
	private $LOGOUT_LINK = 'http://vigattin.com/index.php/vigattin_home2/deactivate';
	public $HOME_PAGE = 'http://vigattin.com/index.php/vigattin_home2/home';

	public function __construct()
	{
		parent::__construct();
		$this->load->config('config');
		$this->load->library('session');
		$this->BASE_URL = rtrim($this->config->item('base_url'), '/');
		$this->load->library('vigattin_home_model');
	}

	public function index()
	{
		$data['base_url'] = $this->BASE_URL;
		$data['module_name'] = $this->MODULE_NAME;
		$data['picture'] = 'https://graph.facebook.com/'.$this->session->userdata('vauth_id').'/picture';
		$data['name'] = $this->session->userdata('vauth_name');
		$data['logout_link'] = $this->LOGOUT_LINK;
		
		$data['main_navigation'] = $this->vigattin_home_model->encoded_link($this->HOME_PAGE);
		
		$this->load->view('vigattin_header_view', $data);
	}
	
	public function all_assets()
	{
		$data['css'] = 	'<link type="text/css" rel="stylesheet" href="'.$this->BASE_URL.'/index.php/'.$this->MODULE_NAME.'/assets/css/reset.css" />'.
						'<link type="text/css" rel="stylesheet" href="'.$this->BASE_URL.'/index.php/'.$this->MODULE_NAME.'/assets/css/typography.css" />'.
						'<link type="text/css" rel="stylesheet" href="'.$this->BASE_URL.'/index.php/'.$this->MODULE_NAME.'/assets/css/default.css" />'.
						'<!--[if IE]><link type="text/css" rel="stylesheet" href="'.$this->BASE_URL.'/index.php/'.$this->MODULE_NAME.'/assets/css/iefix.css" /><![endif]-->';
						
		$data['script'] = 	'<script type="text/javascript" src="'.$this->BASE_URL.'/index.php/'.$this->MODULE_NAME.'/assets/js/jquery.js"></script>'.
							'<script type="text/javascript" src="'.$this->BASE_URL.'/index.php/'.$this->MODULE_NAME.'/assets/js/navigator.js"></script>';
		
		echo $data['css'].$data['script'];
	}
	public function reset_style()
	{
		echo '<link type="text/css" rel="stylesheet" href="'.$this->BASE_URL.'/index.php/'.$this->MODULE_NAME.'/assets/css/reset.css" />';
	}
	public function typography_style()
	{
		echo '<link type="text/css" rel="stylesheet" href="'.$this->BASE_URL.'/index.php/'.$this->MODULE_NAME.'/assets/css/typography.css" />';
	}
	public function jquery()
	{			
		echo '<script type="text/javascript" src="'.$this->BASE_URL.'/index.php/'.$this->MODULE_NAME.'/assets/js/jquery.js"></script>';
	}
	public function header_script()
	{		
		echo '<script type="text/javascript" src="'.$this->BASE_URL.'/index.php/'.$this->MODULE_NAME.'/assets/js/navigator.js"></script>';
	}
	public function header_style()
	{
		echo '<link type="text/css" rel="stylesheet" href="'.$this->BASE_URL.'/index.php/'.$this->MODULE_NAME.'/assets/css/default.css" />'.
			 '<!--[if IE]><link type="text/css" rel="stylesheet" href="'.$this->BASE_URL.'/index.php/'.$this->MODULE_NAME.'/assets/css/iefix.css" /><![endif]-->';
	}
}