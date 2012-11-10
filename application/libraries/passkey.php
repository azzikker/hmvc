<?php
    class passkey extends MX_Controller
    {
        private $CI;
        public $REDIRECT_URL;

        function __construct()
        {
            $this->CI = &get_instance();
            $this->CI->load->config('config');
            $this->CI->load->library('session');
            $this->REDIRECT_URL = $this->CI->config->item('base_url');
            //if($this->uri->segment(1) == "service")
            //{
                $this->index();
            //}
            //if($this->uri->segment(1) == "profile")
            //{
                //$this->logoutbns();
            //}
        }
        function index()
        {
            if($this->CI->session->userdata("bnslogins") && $this->CI->uri->segment(1) <> "deal")
            {
                return true;
            }
            else
            {
                if($this->session->userdata("bnslogins") <> true  && $this->CI->uri->segment(1) <> "deal")
                {
                    $ourpassword = "kganda";
                    $error = 0;
                    if(isset($_POST['passwordkey']))
                    {
                        if($_POST['passwordkey'] == $ourpassword)
                        {
                            $this->session->set_userdata("bnslogins",true);
                            redirect(base_url());
                        }
                        else
                        {
                            $error = 1;
                        }
                    }
                    echo'
                    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                    <html xmlns="http://www.w3.org/1999/xhtml">
                    <head>
                    <base href="'.base_url().'">
                    <style>
                    body{background: #000; color:white;}
                    #bnslogin{width:200px;margin:auto;margin-top:15%;}
                    #bnslogin1{text-align:center;color:white;}
                    #bnslogin1 input{width:200px; height: 30px; text-align:center; font-size:16px;}
                    #bnslogin2{text-align:center; font-size:20px;}
                    </style>
                    <script type="text/javascript" src="assets/general/js/jquery-1.7.1.min.js"></script>
                    <script>
                    $(document).ready(function()
                    {
                    if($("#bnslogin2").length == 1)
                    {
                    $("#bnslogin2").slideToggle(300,function()
                    {
                        $(this).fadeOut(500);
                    });
                    }
                    })
                    </script>
                    </head>
                    <body>
                    <div id="bnslogin">
                    <div id="bnslogin1">
                    <form action="#" method="post"><input type="password" name="passwordkey"></form>
                    </div>
                    ';
                    if($error == 1)
                    {
                        echo'
                        <div id="bnslogin2" style="display:none;">
                        Password Incorrect!
                        </div>
                        ';
                    }
                    echo'
                    </div>
                    </body>
                    </html>
                    ';
                    die();
                }
            }
        }
        function logoutbns()
        {
            $this->CI->session->unset_userdata("bnslogins");
        }
    }
?>
