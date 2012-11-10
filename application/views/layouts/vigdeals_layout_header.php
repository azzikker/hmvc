<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Vigdeals</title>
        <base href="<?php echo base_url(); ?>" />
        <!-- CSS PATHS -->
        <link href="assets/vigattin_deals/css/vigdeals_layout.css" rel="stylesheet">   
        <!-- END OF CSS PATHS -->   
        <!-- SCRIPT PATHS -->
        <script type="text/javascript" src="assets/general/js/jquery.js"></script>
        <script type="text/javascript" src="assets/vigattin_deals/js/vigdeals.js"></script>
        <script type="text/javascript" src="assets/vigattin_deals/js/script1.js"></script>
        <!-- END OF SCRIPT PATHS -->
        <?php $page = $this->uri->segment(1); ?>
    </head>
    <center>
        <body>
            <div id = "wrapper">
                <div class = "navigation">
                    <ul>
                        <li id="viglogo"><img src="assets/vigattin_deals/images/logo.png"></li>
                        <a href=""><li<?php if($page == ""): ?> id = "active"<?php endif; ?>>Today's Deals</li></a>
                        <a href="past_deals"><li<?php if($page == "past_deals"): ?> id = "active"<?php endif; ?>>Past Deals</li></a>
                        <a href="how_it_works"><li<?php if($page == "how_it_works"): ?> id = "active"<?php endif; ?>>How It Works</li></a>
                        <a href="about_us"><li<?php if($page == "about_us"): ?> id = "active"<?php endif; ?>>About Us</li></a>
                        <li<?php if($page == "account" || $page == "order"): ?> id = "active"<?php endif; ?> style="border: none;" class = "my_account">
                            My Account
                            <div id="myaccountmenu">
                                <a href="account"><div>My Profile</div></a>
                                <a href="order"><div>My Voucher/Order</div></a>
                            </div>
                        </li>
                    </ul>
                </div>
                <div id = "divcontent">
                    <!-- START OF CONTENT -->
                    <?php //echo $content; ?>
                    <!-- END OF CONTENT -->