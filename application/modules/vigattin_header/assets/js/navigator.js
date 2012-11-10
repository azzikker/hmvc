function _navigator()
{
	var HOME = 'http://vigattin.com/index.php/vigattin_home2/home';
	
	// EVENT
	function on_external_link_click(e)
	{
		e.preventDefault();
		window.parent.location = HOME+'?external='+encodeURIComponent($(e.currentTarget).attr('href'));
	}
	function on_parent_link_mouse_in(e)
	{
		$('ul.sub_navigation', e.currentTarget).stop(true).css({'overflow':'visible', 'height':'auto', 'width':'auto'}).hide().slideDown(100);
	}
	function on_parent_link_mouse_out(e)
	{
		$('ul.sub_navigation', e.currentTarget).stop(true).css({'overflow':'hidden', 'height':'0'});
	}
	function on_document_ready(e)
	{
		$('div.vigattin_vauth_header div.vigattin_vauth_navigator ul.navigation li.link ul.sub_navigation').css({'overflow':'hidden', 'height':'0'});
		$('div.vigattin_vauth_header div.vigattin_vauth_navigator ul.navigation li.link').hover(function(e){on_parent_link_mouse_in(e)}, function(e){on_parent_link_mouse_out(e)});
		$('div.vigattin_vauth_header a.external').click(function(e){on_external_link_click(e);});
	}
	
	// LIBRARY
	function init()
	{
		$(document).ready(function(e)
		{
        	on_document_ready(e);    
        });	
	}
	
	// LIVE
	init();
}
var nav = new _navigator();