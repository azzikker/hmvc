<link href="assets/vigattin_mobile/css/mprofile.css" rel="stylesheet">
<div class="mprofilen">
    <a href="mobile/account"><div>Back</div></a>
    <div <?php if($this->uri->segment(3)=="edit"): ?>id="active"<?php endif; ?>>My Profile</div>
    <a href="mobile/orders"><div <?php if($this->uri->segment(2)=="orders"): ?>id="active"<?php endif; ?>>My Voucher</div></a>
</div>
<?php foreach($profile_infos as $pi): ?><div class="mprofileinfo">
    <div id="mprofileinfo-h"><?php echo $this->session->userdata("vigdeals_login_name") ?></div>
    <form action="mobile/account/update" method="post">
    <div id="mprofileinfo2-i">
        <div>Email: <span><input type="text" name="m-email" value="<?php echo $this->session->userdata("vigattin_email") ?>"></span></div>
        <div>Contact No: <span><input type="text" name="m-cno" value="<?php echo $pi->customer_no ?>"></span></div>
        <div>Zip Code: <span><input type="text" name="m-zc" value="<?php echo $pi->customer_zipcode ?>"></span></div>
        <div>Address: <span><input type="text" name="m-add" value="<?php echo $pi->customer_address ?>"></span></div>
        <div>City: <span><input type="text" name="m-ct" value="<?php echo $pi->customer_city ?>"></span></div>
        <div>Province: <span><input type="text" name="m-p" value="<?php echo $pi->customer_province ?>"></span></div>
    </div>
    <input type="submit" name="info" value="Update" id="mprofileinfo-btn">
    </form>
</div>
<?php endforeach; ?><div class="mprofilen">
    <a href="mobile/account"><div>Back</div></a>
    <div <?php if($this->uri->segment(3)=="edit"): ?>id="active"<?php endif; ?>>My Profile</div>
    <a href="mobile/orders"><div <?php if($this->uri->segment(2)=="orders"): ?>id="active"<?php endif; ?>>My Voucher</div></a>
</div>