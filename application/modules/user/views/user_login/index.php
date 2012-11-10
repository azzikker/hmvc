<base href="<?php echo base_url(); ?>" />
<link rel="stylesheet" type="text/css" href="assets/admin/css/style0.css">
<body bgcolor="#f3f3f3">
<?php if(strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox') == TRUE) : ?> 
    <div id="center_frame_login" align="center">
<?php else : ?>
    <div id="center_required_frame" align="center">
<?php endif ?>
        <title>Vigattin Deals Admin</title>
        <header id="header">
            <div id="title">Admin Login</div>
            <div id="sub_title">This is accessible only to chosen members of vigattin.</div>
        </header>
        <br>
<?php if(strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox') == TRUE) : ?> 
        <form action="<?php echo base_url(); ?>user/user_login/checklogin" method="post">
                <table cellpadding="5px" align="center" style="font-size: 10px; font-family: arial; font-weight: ; color: #3f3f3f;">
                    <?php if(isset($error)):?><tr>
                        <td id="error_content" align="center" colspan="2"><h4 class="alert_error"><?php echo $error; ?></h4></td>
                    </tr><?php endif; ?>
                    <tr>
                        <td id="main_content">Username</td>
                        <td><input style="width: 200px;" type="text" name="txtusername" value="<?php //echo set_value('username'); ?>"></td>
                    </tr>
                    <tr>
                        <td id="main_content">Password</td>
                        <td><input style="width: 200px;" type="password" name="txtpassword" value="<?php //echo set_value('password'); ?>"></td>
                    </tr>
                    <tr>
                        <td align="right" colspan="2">
                            <input type="submit" name="cmdlogin" value="Sign In"  />
                        </td>

                    </tr>
                </table>
            </div>                                                                                                                
        </form>
<?php else : ?>
        <div id="reg" align="center">You are required to use Mozilla Firefox for better use. <a href="http://www.mozilla.org/products/download.html?product=firefox-13.0.1&os=win&lang=en-US" target="_new">Download It Now</a>!</div>
<?php endif ?>
    </div>
<?php if(strpos($_SERVER['HTTP_USER_AGENT'], 'Green') == TRUE) : ?>
    <div id="reg" align="center">Want to be an admin? <a href="<?php echo base_url() ?>user/register">Click here</a>.</div>
<?php endif ?>
</body>
