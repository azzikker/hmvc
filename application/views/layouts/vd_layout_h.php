<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php if(isset($desc)): ?>
<?php if($this->uri->segment(1)<>"past_deals"): ?>
        <title><?php echo $desc->deal_title ?></title>
<?php else: ?>
        <title>Past Deal - <?php echo $desc->deal_title ?></title>
<?php endif; ?>
<?php else: ?>
        <title>VigDeals</title>
<?php endif; ?>
        <base href="<?php echo base_url(); ?>" />
        
        <!-- Vigattin Header start -->
        <?php //echo modules::run('vigattin_header/header_style'); ?>
        <!-- Vigattin Header end -->
        
        <!-- CSS PATHS -->
        <link href="assets/vigattin_deals/css/vigdeal.css" rel="stylesheet">
        <!-- CSS PATHS -->
        <!-- SCRIPT PATHS -->
        <link rel="shortcut icon" href="favicon.ico">
        <script type="text/javascript" src="assets/general/js/jquery.min.js"></script>
        <script type="text/javascript" src="assets/general/js/jquery.js"></script>
        <script type="text/javascript" src="assets/general/js/jquery.easing.1.3.js"></script>
        <script type="text/javascript" src="assets/vigattin_deals/js/vigdeal.js"></script>
        <script type="text/javascript">vigdeals = new vigdeals();</script>
<?php if($this->session->flashdata('message') <> ""): ?>
        <script type="text/javascript">var errr = new errr(); $errormsg="<?php echo $this->session->flashdata('message'); ?>"; $bgerror=""</script>
<?php endif; ?>
        <!-- SCRIPT PATHS -->
<?php $page = $this->uri->segment(1); ?>
<?php if(isset($desc)): ?>
<?php $stringd = str_replace('"', '',$desc->deal_statement) ?>
        <meta name="description" content="<?php echo $stringd ?>" />
        <meta property="og:description" content="<?php echo $stringd ?>" />
<?php endif; ?>

<!-- Vigattin Header start -->
<?php //echo modules::run('vigattin_header/header_script'); ?>
<!-- Vigattin Header end -->
    <!-- chat -->
<script type="text/javascript">
var __lc = {};
__lc.license = 1524012;

(function() {
  var lc = document.createElement('script'); lc.type = 'text/javascript'; lc.async = true;
  lc.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'cdn.livechatinc.com/tracking.js';
  var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(lc, s);
})();
</script>
    <!-- chat -->
    </head>
<?php if(isset($deal_background)): ?>
    <body style="background: url('assets/general/images/background/optimize/<?php echo $deal_background["bgimg"] ?>') #<?php echo $deal_background["bgcolor"] ?> <?php echo $deal_background["battach"] ?> <?php echo $deal_background["brepeat"] ?> <?php echo $deal_background["bposition"] ?>;">
<?php elseif(isset($backgroundimage)): ?>
    <body style="background:<?php if($backgroundimage->background_image <> ""): ?>url('assets/general/images/web_setting/optimize/<?php echo $backgroundimage->background_image ?>')<?php echo " "; endif; ?><?php echo $backgroundimage->background_color <> ""?"#".$backgroundimage->background_color." " : ""; ?><?php echo $backgroundimage->background_attach == "inherit" ? "":$backgroundimage->background_attach." " ?><?php echo $backgroundimage->background_repeat == "inherit" ? "":$backgroundimage->background_repeat." " ?><?php echo $backgroundimage->background_position == "inherit" ? "":$backgroundimage->background_position ?>;">
<?php else: ?>
    <body>
<?php endif; ?>

        <!-- Global Header Start -->
        <?php //echo modules::run('vigattin_header/index'); ?>
        <!-- Global Header End -->
        
        <div id="wrapper">
            <!--<div id="vlava">-->
            <div id="navigation">
                <ul>
                    <div id="logo" class="fleft"></div>
                    <li<?php if($page == "" || $page == "deal" || $page == "category"): ?> class="selected"<?php endif; ?>><a<?php if($page == "" || $page == "deal" || $page == "category"): ?> id = "active"<?php endif; ?> href="" class="nav-a">Today's Deals</a></li>
                    <li<?php if($page == "past_deals" || $page == "past-category"): ?> class="selected"<?php endif; ?>><a<?php if($page == "past_deals" || $page == "past-category"): ?> id = "active"<?php endif; ?> href="past_deals" class="nav-a">Past Deals</a></li>
                    <li>
                    <div id='location-c'>
                        <div id='location-txt'>Metro Manila</div>
                        <div id='location-ddown'></div>
                    </div>
                    </li>
                    <li<?php if($page == "how_it_works"): ?> class="selected howitworks"<?php else: ?> class="howitworks"<?php endif; ?>><div style="margin-top: -8px;height: 45px;width: 128px;margin-right: 4px;"><a<?php if($page == "how_it_works"): ?> id = "active"<?php endif; ?> href="how_it_works" class="nav-a">How It Works</a></div><div style="margin-top: -29px;width: 111px;height: 33px;"><a<?php if($page == "about_us"): ?> id = "active"<?php endif; ?> href="about_us" class="nav-a">About Us</a></div></li>
                    <li<?php if($page == "account" || $page == "order" || $page == "invited" || $page == "invite" || $page == "recommended-deals"): ?> class="selected"<?php endif; ?>>
                        <a href="javascript:;" id="myaccount" class="nav-a">My Account
                        <?php if($this->session->userdata('vigdeals_login_state') == TRUE): ?>(<span><?php echo $this->db->get_where("deal_cart",array("customer_id"=>$this->session->userdata("vigattin_id")))->num_rows(); ?></span>)<?php endif; ?>
                        </a>
                        <!--<div id="myaccount-user">Welcome <?php echo ($this->session->userdata('vigdeals_login_state') == FALSE || $this->session->userdata('vigdeals_login_state') == "") ? "Guest!":$this->session->userdata("vigattin_firstname")."!"; ?></div>-->
<?php if($this->session->userdata('vigdeals_login_state') == TRUE): ?>
                        <div id='myaccount-menu'>
                            <a href='account'><div>My Profile</div></a>
                            <a href='review'><div>Review Cart <?php if($this->session->userdata('vigdeals_login_state') == TRUE): ?>(<span><?php echo $this->db->get_where("deal_cart",array("customer_id"=>$this->session->userdata("vigattin_id")))->num_rows(); ?></span>)<?php endif; ?></div></a>
                            <a href='order'><div>My Voucher</div></a>
                            <a href='invited'><div>My Invited Friends</div></a>
                            <a href='vigdeals/vigdealswauth/credits'><div>My Credits</div></a>
                            <a href='invite'><div>Invite a Friend</div></a>
                            <a href='recommended-deals'><div>Recommended Deals for Me</div></a>
                        </div>
<?php endif; ?>
                    </li>
                    <li id="box"><div class="head"></div></li>
                </ul>
            </div>
            <!--</div>-->
            <!--LOCATION TOGGLE-->
            <div id='locationt'>
                <div id='locationt-s'><a href=''>ANTIPOLO</a></div>
                <div id='locationt-s'><a href=''>BATANGAS/LIPA CITY</a></div>
                <div id='locationt-s'><a href=''>CAGAYAN DE ORO</a></div>
                <div id='locationt-s'><a href=''>COTABATO CITY</a></div>
                <div id='locationt-s'><a href=''>GENERAL SANTOS</a></div>
                <div id='locationt-s'><a href=''>METRO CEBU</a></div>
                <div id='locationt-s'><a href=''>METRO DAVAO</a></div>
                <div id='locationt-s' class="loc-active"><a href=''>METRO MANILA</a></div>
                <div id='locationt-s'><a href=''>SAN JOSE DEL MONTE</a></div>
                <div id='locationt-s'><a href=''>ZAMBOANGA CITY</a></div>
            </div>
            <!--LOCATION TOGGLE-->
            <!-- START OF CONTENT -->
            <div id="vigloading"><img src="assets/vigattin_deals/images/loading2.gif" alt=""></div>
            <div class="content">
