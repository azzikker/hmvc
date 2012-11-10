<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Assets extends MX_Controller {
	
	private $PATH;
	private $MODULE_NAME = 'vigattin_header';
	
	public function __construct()
	{
		parent::__construct();
		$this->load->config('config');
		$this->PATH = dirname(dirname(__FILE__)).'/assets';
	}
	public function index()
	{
										
	}
	public function css($file_name = '')
	{
		if(!is_file($this->PATH.'/css/'.$file_name)) return;
		header("Content-type: text/css", true);
		$css = file_get_contents($this->PATH.'/css/'.$file_name);
		echo str_replace('..', $this->config->item('base_url').'/index.php/'.$this->MODULE_NAME.'/assets', $css);
	}
	public function js($file_name = '')
	{
		if(!is_file($this->PATH.'/js/'.$file_name)) return;
		header("Content-type: text/javascript", true);
		echo file_get_contents($this->PATH.'/js/'.$file_name);
	}
	public function img($file_name = '')
	{
		if(!is_file($this->PATH.'/img/'.$file_name)) return;
		$info = pathinfo($this->PATH.'/img/'.$file_name);
		switch($info['extension'])
		{
			case 'jpg':
			header('Content-type: image/jpeg', true);
			break;
			
			case 'gif':
			header('Content-type: image/gif', true);
			break;
			
			case 'png':
			header('Content-type: image/png', true);
			break;
		}
		echo file_get_contents($this->PATH.'/img/'.$file_name);
	}
}