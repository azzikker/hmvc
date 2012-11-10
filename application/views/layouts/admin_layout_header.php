<?php $first_name = $this->session->userdata('user_firstname'); ?>
<?php $last_name = $this->session->userdata('user_lastname'); ?>
<?php $level = $this->session->userdata('user_level'); ?>
<?php $whole_name = $first_name . " " . $last_name; ?>
<?php $table1 = "users"; $table = "companies"; ?>
<?php //start of green call ?>
<?php $unconfirmed['user_confirmed'] = 0; $banned['user_banned'] = 1; ?>
<?php $sql = $this->db->get($table)->result(); ?> 
<?php $sql1a = $this->db->get_where($table1, $unconfirmed)->num_rows(); ?>
<?php $sql1b = $this->db->get_where($table1, $banned)->num_rows(); ?>
<?php //start of user_id encryption ?>
<?php $u_encrypt = (($this->session->userdata("user_id"))*8)+8; ?>
<?php $u_decrypt = (($u_encrypt)-8)/8; ?>
<?php $u_encrypt_count = strlen($u_encrypt); ?>
<?php $user_id_hash = md5(time() . "" . $u_encrypt . "" . time() . "" . $u_decrypt) . "" . time() . "" . $u_encrypt; ?>
<?php //end of user_id encryption ?>
<?php //end of green call ?>
<base href="<?php echo base_url(); ?>" />
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Vigattin Deals Admin</title>
    <link rel="shortcut icon" href="favicon.ico">
    <!--START FOR CSS-->
    <link rel="stylesheet" href="assets/admin/css/admin_layout.css" type="text/css" media="screen" />
    <link rel="stylesheet" type="text/css" href="assets/admin/set/lightbox/css/lightbox.css"> 
    <link rel="stylesheet" type="text/css" href="assets/admin/css/style0.css">
    <link rel="stylesheet" type="text/css" href="assets/admin/css/style1.css">
    <!--END FOR CSS-->
    <!--START FOR JS-->
    <!--[if lt IE 9]>
    <link rel="stylesheet" href="css/ie.css" type="text/css" media="screen" />
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <script type="text/javascript" src="assets/general/js/jquery-1.5.2.min.js"></script>
    <script type="text/javascript" src="assets/general/js/jquery-latest.js"></script>
    <script type="text/javascript" src="assets/general/js/jquery.js"></script>
    <script type="text/javascript" src="assets/admin/set/lightbox/js/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="assets/admin/set/lightbox/js/lightbox.js"></script>
    <script type="text/javascript" src="assets/admin/js/hideshow.js"></script>
    <script type="text/javascript" src="assets/admin/js/jquery.tablesorter.min.js"></script>
    <script type="text/javascript" src="assets/admin/js/jquery.equalHeight.js"></script>
    <script type="text/javascript" src="assets/admin/js/script1.js"></script>
    <script type="text/javascript" src="assets/admin/js/script2.js"></script>
    <script type="text/javascript" src="assets/general/set/jquery_ui_full/jquery-ui.js"></script>
    <!--END FOR JS-->
</head>
<body>
    <aside id="sidebar" class="column">  
        <div class="hove">
        <h3>Maintenance</h3>
        <ul class="toggle tuggle">
            <br>
            <b><li class="icn_folder"><a href="admin/admin_companies/index/maintenance">Companies</a></li></b><hr>
            <b><li class="icn_folder"><a href="admin/admin_deals/index/current">Deals</a></li></b>
<?php if($level == 0) : ?>

                <li><a href="admin/admin_deals_category">Deals Category</a></li>
<?php endif ?>
            <br>
        </ul>
        </div>
        <div class="hove">
        <h3>Accounting</h3>
<?php $month1 = date("m", time()); /*current month*/ ?>                                       
<?php $year = date("Y", time()); /*year*/ ?>
<?php $second1 = strtotime($month1 . "/1/". $year) /*complete current date into seconds*/ ?>
<?php $month_num = date("m", $second1) + 1; /*next month in integer format*/ ?>
<?php if($month_num >= 13) { $month_num = 1; $year = $year+1; } /*if next month = 13, it resets to 1*/ ?>
<?php $second2 = strtotime($month_num . "/1/" . $year/* . " + 1 month"*/); /*complete next month into seconds*/ ?>
        <ul class="toggle tuggle">
            <br>
<?php if($level == 2) : ?>
            <b><li class="icn_tags"><a href="admin/admin_accounting/merchant/<?php echo $second1; ?>/<?php echo $second2; ?>">Payment Due</a></li></b>
<?php else : ?>
<?php if($level == 3 || $level == 0) : ?>
            <b><li class="icn_folder"><a href="admin/admin_orders/index/active/all">Vouchers / Orders</a></li></b><hr>
<?php endif ?>
            <b><li class="icn_retex"><a href="admin/systems_controller">Return / Exchange</a></li></b>
                <li><a href="admin/systems_controller">Return Notifications ( 0 )</a></li><hr>
            <b><li class="icn_tags"><a href="admin/admin_accounting/index/<?php echo $second1; ?>/<?php echo $second2; ?>">Payment Due</a></li></b>
<?php endif ?>  
            <br> 
        </ul>
        </div>
        <div class="hove">
<?php if($level == 2 || $level == 0) : ?>
        <h3>Reports</h3>
        <ul class="toggle tuggle">
            <br>
            <b><li class="icn_article"><a href="admin/admin_companies/index/reports">Companies</a></li></b><hr>
<?php $custome_count = ""; ?>
<?php foreach($sql as $row) : $custome_count = $custome_count + 1; endforeach ?>
<?php if($custome_count == 1) : ?>
            <b><li class="icn_article"><a href="admin/admin_customers<?php echo "/index/" . $row->company_id; ?>">Customers</a></li></b>
<?php else : ?>
            <b><li class="icn_article"><a href="admin/admin_customers">Customers</a></li></b>
<?php endif ?>
            <br/>
        </ul>
<?php endif ?>
        </div>
        <div class="hove">
        <h3>Utilities</h3>
        <ul class="toggle tuggle">
            <br/>
<?php if($level == 0) : ?>
            <b><li class="icn_view_users"><a href="admin<?php if($level == 3 || $level == 0) : ?>/admin_users<?php endif ?>">Users Maintenance</a></li></b> 
<?php if($this->session->userdata('user_id')==99) : ?>
                <li><a href="admin/admin_users/unconfirmedUser"><?php if($sql1a > 0) : ?><font class="critical_lane"><?php endif ?>Users Unconfirmed ( <?php echo $sql1a; ?> )<?php if($sql1a > 0) : ?></font><?php endif ?></a></li>
<?php endif ?>
                <li><a href="admin/admin_users/bannedUser"><?php if($sql1b > 0) : ?><font class="critical_lane"><?php endif ?>Users Banned ( <?php echo $sql1b; ?> )<?php if($sql1b > 0) : ?></font><?php endif ?></a></li>
                <li><a href="admin/admin_users/trashedUser">Users Trashed </a></li>
                <li><a href="admin/admin_users/accountUser/<?php echo $u_encrypt_count; ?>/<?php echo $user_id_hash; ?>">Your Profile</a></li>
<?php else : ?>
        <b><li class="icn_profile"><a href="admin/admin_users/accountUser/<?php echo $u_encrypt_count; ?>/<?php echo $user_id_hash; ?>">Your Profile</a></li></b><?php echo ($level == 0 ? '<hr>' : '') ?>
<?php endif ?>
<?php if($level == 0) : ?>
            <b><li class="icn_settings"><a href="<?php echo "admin/admin/settings/background"; ?>">Web Settings</a></li></b><hr>
            <b><li class="icn_categories"><a href="admin/admin_audit/index/<?php echo date("m/d/Y", time()); ?>">Audit Trail</a></li></b>
<?php endif ?>
            <br>
        </ul>
        </div>
        <footer>
            <p><strong>Copyright &copy; 2012 Vigattin Deals Admin</strong></p>
            <p>Theme by <a target="_new" href="http://vigattin.net">vigattin.net</a></p>
        </footer>
    </aside>
    <!-- END OF SIDE BAR -->
    <section id="main" class="column">
    <div>
    
