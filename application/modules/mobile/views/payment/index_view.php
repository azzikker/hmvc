<script>var payment = new payment();</script>
<div id="rpc">
    <form action="mobile/payment2" method="post">
    <div id="rpc-header">
         <div id="rpc-header-box">
            <div>
                <img src="assets/vigattin_mobile/images/new/payment2.png" alt="" style="width: 33px;position: absolute;left: 4px;top: 10px;">
                PAYMENT
            </div>
         </div>
    </div>
    <div id="rpc-body">
        <div id='rpc-body-revw'>
            <div style="padding: 5px;font-weight: bold;font-size: 14px;">Order Summary <a href='javascript:;' id='paymentsummaryhide'>(HIDE)</a></div>
            <div id='rpc-body-revw-c'>
                <?php echo $summary; ?>
            </div>
        </div>
        <div id='rpc-body-add' style="padding: 5px;">
            <div style="padding: 5px;font-weight: bold;font-size: 14px;">Billing Address</div>
<?php $info = 0; ?>
<?php foreach($biladdress as $ba): ?>
<?php $info++; ?>
            <div id='rpc-body-add-b'>
                Full Name:<br />
                <input type="text" name="fn" value="<?php echo $this->session->userdata('vigdeals_login_name'); ?>"><br />
                Phone Number:<br />
                <input type="text" name="pn" value="<?php echo $ba->customer_no ?>"><br />
                Address:<br />
                <input type="text" name="add1" value="<?php echo $ba->customer_address ?>"><br />
                City:<br />
                <input type="text" name="ct" value="<?php echo $ba->customer_city ?>"><br />
                Province:<br />
                <input type="text" name="prov" value="<?php echo $ba->customer_province ?>"><br />
                Zip Code:<br />
                <input type="text" name="zc" value="<?php echo $ba->customer_zipcode ?>"><br />
            </div>
<?php endforeach; ?>
<?php if($info == 0): ?>
            <div id='rpc-body-add-b'>
                Full Name:<br />
                <input type="text" name="fn" value="<?php echo $this->session->flashdata("fn"); ?>"><br />
                Phone Number:<br />
                <input type="text" name="pn" value="<?php echo $this->session->flashdata("pn"); ?>"><br />
                Address:<br />
                <input type="text" name="add1" value="<?php echo $this->session->flashdata("add1"); ?>"><br />
                City:<br />
                <input type="text" name="ct" value="<?php echo $this->session->flashdata("ct"); ?>"><br />
                Province:<br />
                <input type="text" name="prov" value="<?php echo $this->session->flashdata("prov"); ?>"><br />
                Zip Code:<br />
                <input type="text" name="zc" value="<?php echo $this->session->flashdata("zc"); ?>"><br />
            </div>
<?php endif; ?>
        </div>
    </div>
    <div id="rpc-btn">
        <input type="submit" id="rpc-btn-n" value="SUBMIT">
        <a href="javascript:history.back()">
            <div id="rpc-btn-b">BACK</div>
        </a>
    </div>
    </form> 
</div>