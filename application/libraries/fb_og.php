<?php // fb_og v0.9.0

class fb_og {
    
    public function __construct()
    {
        $agent = (isset($_SERVER['HTTP_USER_AGENT']) && $_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : 'undefined';
        if($agent != 'facebookexternalhit/1.1 (+http://www.facebook.com/externalhit_uatext.php)') return;
        $this->og_out();
        exit();
    }
    protected function og_out()
    {
        $title = (isset($_GET['og_title'])) ? $_GET['og_title'] : 'undefined';
        $type = (isset($_GET['og_type'])) ? $_GET['og_type'] : 'product';
        $image = (isset($_GET['og_image'])) ? $_GET['og_image'] : 'undefined';
        $description = (isset($_GET['og_description'])) ? $_GET['og_description'] : 'undefined';
        echo 
        '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">'.
        '<html xmlns="http://www.w3.org/1999/xhtml">'.
        '<head>'.
        '<title>'.htmlentities($title).'</title>'.
        '<meta property="og:type" content="'.htmlentities($type).'" />'. 
        '<meta property="og:title" content="'.htmlentities($title).'" />'.
        '<meta property="og:image" content="'.htmlentities($image).'" />'. 
        '<meta property="og:description" content="'.htmlentities($description).'" />'.
        '<meta property="og:url" content="http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'] .'">'.
        '</head>'.
        
        '<body>'.
        '</body>'.
        '</html>';

    }
    
}