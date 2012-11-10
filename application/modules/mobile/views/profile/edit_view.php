<div id="prof">
    <div id="prof-h"><?php echo $this->session->userdata("vigdeals_login_name") ?></div>
<?php foreach($profile_infos as $pi): ?>
    <form action="mobile/account/update" method="post">
    <div id="prof-be">
        <span>E-mail:</span>
        <div><span><?php echo $this->session->userdata("vigattin_email") ?></span></div>
        <span>First Name:</span>
        <div><span><?php echo $this->session->userdata("vigdeals_login_name") ?></span></div>
        <span>Last Name:</span>
        <div><span><?php echo $this->session->userdata("vigdeals_login_name") ?></span></div>
        <span>Contact No.:</span>
        <div><input type="text" name="m-cno" value="<?php echo $pi->customer_no ?>" required="required"></div>
        <span>Zip Postal Code:</span>
        <div><input type="text" name="m-zc" value="<?php echo $pi->customer_zipcode ?>" required="required"></div>
        <span>Address:</span>
        <div><input type="text" name="m-add" value="<?php echo $pi->customer_address ?>" required="required"></div>
        <span>City:</span>
        <div><input type="text" name="m-ct" value="<?php echo $pi->customer_city ?>" required="required"></div>
        <span>Province:</span>
        <div><input type="text" name="m-p" value="<?php echo $pi->customer_province ?>" required="required"></div>
    </div>
    <div id="prof-btne">
        <input type="submit" name="info" value="Ok" id="prof-btne-s">
        <a href="mobile/account">
            <div id="prof-btne-b">Back</div>
        </a>
    </div>
    </form>
<?php endforeach; ?>
</div>