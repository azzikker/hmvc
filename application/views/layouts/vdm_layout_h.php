<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="HandheldFriendly" content="True">
        <meta name="MobileOptimized" content="320">
        <meta name="viewport" content="width=device-width">
<?php if(isset($desc)): ?>
<?php if($this->uri->segment(2)<>"past_deals"): ?>
        <title><?php echo $desc->deal_title ?></title>
<?php else: ?>
        <title>Past Deal - <?php echo $desc->deal_title ?></title>
<?php endif; ?>
<?php if(isset($desc)): ?>
<?php $stringd = str_replace('"', '',$desc->deal_statement) ?>
        <meta name="description" content="<?php echo $stringd ?>" />
        <meta property="og:description" content="<?php echo $stringd ?>" />
<?php endif; ?>
<?php else: ?>
        <title>VigDeals Mobile</title>
<?php endif; ?>
        <base href="<?php echo base_url(); ?>" />
        <!-- CSS PATHS -->
        <link href="assets/vigattin_mobile/css/vigdealm.css" rel="stylesheet">   
        <!-- END OF CSS PATHS -->   
        <!-- SCRIPT PATHS -->
        <link rel="shortcut icon" href="favicon.ico">
        <script type="text/javascript" src="assets/general/js/jquery.js"></script>
        <script type="text/javascript" src="assets/vigattin_mobile/js/vigdeal.js"></script>
        <script>var vigdeal = new vigdeal();</script>
<?php if(isset($_GET['e'])): ?>
<?php if($_GET['e'] == 'notfound'): ?>
        <script type="text/javascript">var errr = new errr(); $errormsg="Deal not found!"</script>
<?php elseif($_GET['e'] == 'invalid'): ?>
        <script type="text/javascript">var errr = new errr(); $errormsg="Invalid deal!"</script>
<?php elseif($_GET['e'] == 'thankyou'): ?>
        <script type="text/javascript">var errr = new errr(); $errormsg="Thank you for buying. Check your email for more details."</script>
<?php elseif($_GET['e'] == 'soldout'): ?>
        <script type="text/javascript">var errr = new errr(); $errormsg="Sorry the selected deal is sold out."</script>
<?php elseif($_GET['e'] == 'pastnotfound'): ?>
        <script type="text/javascript">var errr = new errr(); $errormsg="Past deal not found!"</script>
<?php elseif($_GET['e'] == 'timeout'): ?>
        <script type="text/javascript">var errr = new errr(); $errormsg="Session timeout!"</script>
<?php elseif($_GET['e'] == 'invalidquantity'): ?>
        <script type="text/javascript">var errr = new errr(); $errormsg="Invalid Quantity!"</script>
<?php elseif($_GET['e'] == 'locnotfound'): ?> 
        <script type="text/javascript">var errr = new errr(); $errormsg="Location not Found!"</script>
<?php elseif($_GET['e'] == 'emailexisted'): ?> 
        <script type="text/javascript">var errr = new errr(); $errormsg="Email Already Existed!"</script>
<?php elseif($_GET['e'] == 'selectaddress'): ?> 
        <script type="text/javascript">var errr = new errr(); $errormsg="Please select address below!"</script>
<?php elseif($_GET['e'] == 'nodeal'): ?> 
        <script type="text/javascript">var errr = new errr(); $errormsg="Your shopping cart is empty."</script>
<?php elseif($_GET['e'] == 'fillallblanks'): ?> 
        <script type="text/javascript">var errr = new errr(); $errormsg="Please fill all the blanks."</script>
<?php endif; ?>
<?php endif; ?>
<?php if($this->session->flashdata("message") <> ""): ?>
        <script type="text/javascript">var errr = new errr(); $errormsg="<?php echo $this->session->flashdata("message"); ?>"</script>
<?php endif; ?>
        <!-- END OF SCRIPT PATHS -->
    </head>
<?php $page = $this->uri->segment(1); ?>
        <body>
            <div id="header">
                <ul>
                    <li id="header-logo"></li>
                    <a href="mobile"><li id="header-home"<?php if($this->uri->segment(2) == "" || ($this->uri->segment(2) == "deal" && $this->uri->segment(3) == "")): ?> class="header-home-a"<?php endif ?>>HOME</li></a>
                    <a href="javascript:;">
                        <li id="header-profile"<?php if($this->uri->segment(2) == "account"): ?> class="header-profile-a"<?php endif; ?>>
                            PROFILE
                            <div id='profile-menu'>
                                <a href='mobile/account'>
                                    <div>My Profile</div>
                                </a>
                                <a href='mobile/review'>
                                    <div>Review Cart</div>
                                </a>
                                <a href='mobile/orders'>
                                    <div>My Voucher</div>
                                </a>
                            </div>
                        </li>
                    </a>
                </ul>
                <div class="push"></div>
                <div id='welcome'>Welcome <?php echo $this->session->userdata("vigattin_firstname"); ?>!&nbsp;&nbsp;&nbsp;</div>
            </div>
