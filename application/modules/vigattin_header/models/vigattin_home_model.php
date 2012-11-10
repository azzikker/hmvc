<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Vigattin_home_model extends CI_MODEL {

	private $VIGATTIN_HOME_DB_SETTING;
	private $VIGATTIN_HOME_DB;
	
	// Public	
	public function __construct()
	{
		// Parent
		$VIGATTIN_HOME_DB_SETTING['hostname'] = "localhost";
		$VIGATTIN_HOME_DB_SETTING['username'] = "fotografia";
		$VIGATTIN_HOME_DB_SETTING['password'] = "vigattinfotografia";
		$VIGATTIN_HOME_DB_SETTING['database'] = "fotografia";
		$VIGATTIN_HOME_DB_SETTING['dbdriver'] = "mysql";
		$VIGATTIN_HOME_DB_SETTING['dbprefix'] = "";
		$VIGATTIN_HOME_DB_SETTING['pconnect'] = FALSE;
		$VIGATTIN_HOME_DB_SETTING['db_debug'] = TRUE;
		$VIGATTIN_HOME_DB_SETTING['cache_on'] = FALSE;
		$VIGATTIN_HOME_DB_SETTING['cachedir'] = "";
		$VIGATTIN_HOME_DB_SETTING['char_set'] = "utf8";
		$VIGATTIN_HOME_DB_SETTING['dbcollat'] = "utf8_general_ci";
		$this->VIGATTIN_HOME_DB = $this->load->database($VIGATTIN_HOME_DB_SETTING, TRUE);
		$this->init_table_link();
	}
	public function add_link($name, $href, $category = 'default', $note = '')
	{
		$sql = "INSERT INTO link (name, href, category, note) VALUES (?, ?, ?, ?)";
		return $this->VIGATTIN_HOME_DB->query($sql, array($name, $href, $category, $note));
	}
	public function remove_link($id)
	{
		$sql = "DELETE FROM `link` WHERE `id` = ? LIMIT 1";
		return $this->VIGATTIN_HOME_DB->query($sql, array($id));
	}
	public function get_link()
	{
		$sql = "SELECT * FROM link ORDER BY category ASC";
		$result = $this->VIGATTIN_HOME_DB->query($sql);
		$link = array();
		foreach($result->result_array() as $value)
		{
			$link[$value['category']][] = array('id' => $value['id'], 'name' => $value['name'], 'href' => $value['href'], 'note' => $value['note'], 'type' => $value['type']);
		}
		return $link;
	}
	public function vigattin_link()
	{
		$sql = "SELECT * FROM link WHERE type = 'vigattin' ORDER BY category ASC";
		$result = $this->VIGATTIN_HOME_DB->query($sql);
		$link = array();
		foreach($result->result_array() as $value)
		{
			$link[] = $value['href'];
		}
		return $link;
	}
	public function encoded_link($home_link = '')
	{
		$link = $this->get_link();
		if(is_array($link))
		{
			$ul = '<ul class="navigation"><li class="link home"><a target="_parent" href="'.$home_link.'"></a></li>';
			foreach($link as $key => $value)
			{
				if(is_array($value))
				{
					if(count($value) == 1)
					{
						$ul .= '<li class="link"><a target="_parent" class="parent_link '.$value[0]['type'].'" href="'.$value[0]['href'].'">'.strtoupper($key).'</a></li>';
					}
					else
					{
						$ul .= '<li class="link"><a target="_parent" class="parent_link" href="javascript:">'.strtoupper($key).'</a>';
						$ul .= '<ul class="sub_navigation">';
						$total = count($value);
						foreach($value as $key => $value2)
						{
							$first = ($key == 0) ? 'sub_first' : '';
							$last = (($total - 1) == $key) ? 'sub_last' : '';
							$ul .= '<li class="sub_navigation '.$first.$last.'"><a target="_parent" class="child_link '.$value2['type'].'" href="'.$value2['href'].'">'.$value2['name'].'</a></li>';
						}
						$ul .= '</ul>';
						$ul .='</li>';
					}
				}
				else $ul .='<li class="link"></li>';
			}
			$ul .= '<li class="link last"></li></ul>';
		}
		return $ul;
	}
	
	// Private
	private function init_table_link()
	{
		$query = 	"CREATE TABLE IF NOT EXISTS `link` (
					`id` int(10) unsigned NOT NULL AUTO_INCREMENT, 
					`name` varchar(255) NOT NULL, 
					`href` varchar(255) NOT NULL, 
					`category` varchar(255) NOT NULL, 
					`note` text NOT NULL, 
					`country` varchar(255) NOT NULL,
					`type` varchar(255) NOT NULL,
					PRIMARY KEY (`id`), 
					KEY `name` (`name`,`category`,`country`)) 
					ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1";
					
		$this->VIGATTIN_HOME_DB->query($query);
	}
}