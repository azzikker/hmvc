<div id="prof">
    <div id="prof-h"><?php echo $this->session->userdata("vigdeals_login_name") ?></div>
<?php if(isset($profile_infos)): ?>
<?php foreach($profile_infos as $pi): ?>
    <div id="prof-b">
        <div id="prof-b-img"></div>
        <span>E-mail:</span>
        <div><?php echo $this->session->userdata("vigattin_email") ?></div>
        <span>First Name:</span>
        <div><?php echo $this->session->userdata("vigdeals_login_name") ?></div>
        <span>Last Name:</span>
        <div><?php echo $this->session->userdata("vigdeals_login_name") ?></div>
        <span>Contact No.:</span>
        <div><?php echo $pi->customer_no ?></div>
        <span>Zip Postal Code:</span>
        <div><?php echo $pi->customer_zipcode ?></div>
        <span>Address:</span>
        <div><?php echo $pi->customer_address ?></div>
        <span>City:</span>
        <div><?php echo $pi->customer_city ?></div>
        <span>Province:</span>
        <div><?php echo $pi->customer_province ?></div>
    </div>
    <div id="prof-btn">
        <div id="prof-btn-e">
            <a href="mobile/account/edit">
                <div>Edit Profile</div>
            </a>
        </div>
        <div id="prof-btn-v">
            <a href="mobile/orders">
                <div>My Voucher</div>
            </a>
        </div>
    </div>
<?php endforeach; ?>
<?php else: ?>
    <form action="mobile/account/save" method="post">
    <div id="prof-be">
        <span>E-mail:</span>
        <div><span><?php echo $this->session->userdata("vigattin_email") ?></span></div>
        <span>First Name:</span>
        <div><span><?php echo $this->session->userdata("vigdeals_login_name") ?></span></div>
        <span>Last Name:</span>
        <div><span><?php echo $this->session->userdata("vigdeals_login_name") ?></span></div>
        <span>Contact No.:</span>
        <div><input type="text" name="m-cno" required="required"></div>
        <span>Zip Postal Code:</span>
        <div><input type="text" name="m-zc" required="required"></div>
        <span>Address:</span>
        <div><input type="text" name="m-add" required="required"></div>
        <span>City:</span>
        <div><input type="text" name="m-ct" required="required"></div>
        <span>Province:</span>
        <div><input type="text" name="m-p" required="required"></div>
    </div>
    <div id="prof-btne">
        <input type="submit" name="info" value="Ok" id="prof-btne-s">
        <a href="mobile/account">
            <div id="prof-btne-b">Back</div>
        </a>
    </div>
    </form>
<?php endif; ?>
</div>