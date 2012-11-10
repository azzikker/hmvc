<link href="assets/vigattin_mobile/css/mprofile.css" rel="stylesheet">
<div class="mprofilen">
    <a href="mobile"><div>Back</div></a>
    <div <?php if($this->uri->segment(2)=="account"): ?>id="active"<?php endif; ?>>My Profile</div>
    <a href="mobile/orders"><div <?php if($this->uri->segment(2)=="orders"): ?>id="active"<?php endif; ?>>My Voucher</div></a>
</div>
<?php if(isset($profile_infos)): ?><?php foreach($profile_infos as $pi): ?><div class="mprofileinfo">
    <div id="mprofileinfo-h"><?php echo $this->session->userdata("vigdeals_login_name") ?></div>
    <div id="mprofileinfo-i">
        <div>Email: <span><?php echo $this->session->userdata("vigattin_email") ?></span></div>
        <div>Contact No: <span><?php echo $pi->customer_no ?></span></div>
        <div>Zip Code: <span><?php echo $pi->customer_zipcode ?></span></div>
        <div>Address: <span><?php echo $pi->customer_address ?></span></div>
        <div>City: <span><?php echo $pi->customer_city ?></span></div>
        <div>Province: <span><?php echo $pi->customer_province ?></span></div>
    </div>
    <a href="mobile/account/edit"><div id="mprofileinfo-btn">Edit</div></a>
</div>
<?php endforeach; ?><?php else: ?><div class="mprofileinfo">
    <div id="mprofileinfo-h"><?php echo $this->session->userdata("vigdeals_login_name") ?></div>
    <form action="mobile/account/save" method="post">
    <div id="mprofileinfo2-i">
        <div>Email: <span><input disabled="disabled" type="text" name="m-email" value="<?php echo $this->session->userdata("vigattin_email") ?>"></span></div>
        <div>Contact No: <span><input type="text" name="m-cno"></span></div>
        <div>Zip Code: <span><input type="text" name="m-zc"></span></div>
        <div>Address: <span><input type="text" name="m-add"></span></div>
        <div>City: <span><input type="text" name="m-ct"></span></div>
        <div>Province: <span><input type="text" name="m-p"></span></div>
    </div>
    <input type="submit" name="info" value="Save" id="mprofileinfo-btn">
    </form>
</div>
<?php endif; ?><div class="mprofilen">
    <a href="mobile"><div>Back</div></a>
    <div <?php if($this->uri->segment(2)=="account"): ?>id="active"<?php endif; ?>>My Profile</div>
    <a href="mobile/orders"><div <?php if($this->uri->segment(2)=="orders"): ?>id="active"<?php endif; ?>>My Voucher</div></a>
</div>