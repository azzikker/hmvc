<script type="text/javascript" src="assets/vigattin_deals/js/colorplugin.js"></script>
<script>var payment = new payment();</script>
<form method="post" action="payment2">
    <div id="rpc-h">
        <div id="rpc-h-div">
            <img src="assets/vigattin_deals/images/payment2.png" style="position: absolute; width: 65px; left: 33px; top: 9px;" alt="">
            <span>PAYMENT</span>
        </div>
    </div>
    <div id="rpc">
        <div id="rpc-reviews2" class="fleft">
            <div id="rpc-rev-title">Order Summary</div>
            <div id="rpc-rev-b">
                <?php echo $summary; ?>
            </div>
        </div>
<?php $info = 0; ?>
<?php foreach($biladdress as $ba): ?>
<?php $info++; ?>
        <div id="rpc-ba" class="fleft">
            <div id="rpc-ba-t">Billing Address</div>
            <div id="rpc-ba-c">
                <div id="rpc-ba-c-l">Full Name</div>
                <div id="rpc-ba-c-i"><input type="text" name="fn" value="<?php echo $this->session->userdata('vigdeals_login_name'); ?>">
                <br /><span id="errorfn"></span>
                </div>
                <div id="rpc-ba-c-l">Phone Number</div>
                <div id="rpc-ba-c-i"><input type="text" name="pn" value="<?php echo $ba->customer_no ?>">
                <br /><span id="errorpn"></span>
                </div>
                <div id="rpc-ba-c-l">Address</div>
                <div id="rpc-ba-c-i"><input type="text" name="add1" value="<?php echo $ba->customer_address ?>">
                <br /><span id="erroradd1"></span>
                </div>
                <!--<div id="rpc-ba-c-l">Address 2</div>
                <div id="rpc-ba-c-i"><input type="text" name="add2"></div>-->
                <div id="rpc-ba-c-l">City</div>
                <div id="rpc-ba-c-i"><input type="text" name="ct" value="<?php echo $ba->customer_city ?>">
                <br /><span id="errorct"></span>
                </div>
                <div id="rpc-ba-c-l">Province</div>
                <div id="rpc-ba-c-i"><input type="text" name="prov" value="<?php echo $ba->customer_province ?>">
                <br /><span id="errorprov"></span>
                </div>
                <div id="rpc-ba-c-l">Zip Code</div>
                <div id="rpc-ba-c-i"><input type="text" name="zc" value="<?php echo $ba->customer_zipcode ?>">
                <br /><span id="errorzc"></span>
                </div>
            </div>
        </div>
<?php endforeach; ?>
<?php if($info == 0): ?>
        <div id="rpc-ba" class="fleft">
            <div id="rpc-ba-t">Billing Address</div>
            <div id="rpc-ba-c">
                <div id="rpc-ba-c-l">Full Name</div>
                <div id="rpc-ba-c-i"><input type="text" name="fn" value="<?php echo $this->session->flashdata("fn"); ?>">
                <br /><span id="errorfn"></span>
                </div>
                <div id="rpc-ba-c-l">Phone Number</div>
                <div id="rpc-ba-c-i"><input type="text" name="pn" value="<?php echo $this->session->flashdata("pn"); ?>">
                <br /><span id="errorpn"></span>
                </div>
                <div id="rpc-ba-c-l">Address</div>
                <div id="rpc-ba-c-i"><input type="text" name="add1" value="<?php echo $this->session->flashdata("add1"); ?>">
                <br /><span id="erroradd1"></span>
                </div>
                <!--<div id="rpc-ba-c-l">Address 2</div>
                <div id="rpc-ba-c-i"><input type="text" name="add2" value="<?php echo $this->session->flashdata("add2"); ?>"></div>-->
                <div id="rpc-ba-c-l">City</div>
                <div id="rpc-ba-c-i"><input type="text" name="ct" value="<?php echo $this->session->flashdata("ct"); ?>">
                <br /><span id="errorct"></span>
                </div>
                <div id="rpc-ba-c-l">Province</div>
                <div id="rpc-ba-c-i"><input type="text" name="prov" value="<?php echo $this->session->flashdata("prov"); ?>">
                <br /><span id="errorprov"></span>
                </div>
                <div id="rpc-ba-c-l">Zip Code</div>
                <div id="rpc-ba-c-i"><input type="text" name="zc" value="<?php echo $this->session->flashdata("zc"); ?>">
                <br /><span id="errorzc"></span>
                </div>
            </div>
        </div>
<?php endif; ?>
<?php if($this->session->flashdata("message") != ""): ?>
        <div id="rpc-ba-err" class="fright"><?php echo $this->session->flashdata("message"); ?></div>
<?php endif; ?>
    </div>
    <div id="rpc-btn">
    <a href="review">
        <div id="rpc-btn-b">Back to Cart</div>
    </a>
    <input type="submit" value="Pay Now" id="rpc-btn-ns">
    </div>
</form>