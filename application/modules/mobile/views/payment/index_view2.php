<div id="rpc">
    <div id="rpc-header">
         <div id="rpc-header-box">
            <div>
                REVIEW CART
                <br/>
                Step 1
            </div>
            <div id="rpc-header-box-mid" class="rpc-header-box-active">
                PAYMENT
                <br/>
                Step 2
            </div>
            <div>
                CONFIRMATION
                <br/>
                Step 3
            </div>
         </div>
    </div>
<?php if(isset($_POST['pt'])): ?>
<form action="mobile/payment2" method="post">
<?php else: ?>
<form action="mobile/payment" method="post">
<?php endif; ?>
    <div id="rpc-body">
        <div id="rpc-body-pmnt">
<?php if(!isset($_POST['pt'])): ?>
            <div id="rpc-body-pmnt-h">How would you like to pay?</div>
            <div id="rpc-body-pmnt-div">
                <input type="submit" id="rpc-body-pmnt-cc" value="CREDIT CARD" name="pt">
            </div>
            <div id="rpc-body-pmnt-div">
                <input type="submit" id="rpc-body-pmnt-cotc" value="CASH" name="pt">
            </div>
<?php else: ?>
<?php if($_POST['pt'] == "CREDIT CARD"): ?>
            <div id="rpc-body-pmnt-cc-b">
                <div id="rpc-body-pmnt-cc-b-h">
                    CREDIT CARD <img src="assets/vigattin_mobile/images/new/cc.jpg">
                </div>
                <div id="rpc-body-pmnt-cc-b-i">
                    <label>CARD HOLDER'S NAME</label>
                    <input type="text">
                    <br/>
                    <label>CREDIT CARD NUMBER</label>
                    <input type="text">
                    <br/>
                    <label>VERIFICATION CODE</label>
                    <input type="text">
                    <br/>
                    <label>CREDIT CARD TYPE</label>
                    <input type="text">
                    <br/>
                    <label>EXPIRATION DATE</label>
                    <select name="cc_expiration_month" class="expiry-month">
                        <option value="" class="default" selected="selected">Month</option>
                        <option value="01">January</option>
                        <option value="02">February</option>
                        <option value="03">March</option>
                        <option value="04">April</option>
                        <option value="05">May</option>
                        <option value="06">June</option>
                        <option value="07">July</option>
                        <option value="08">August</option>
                        <option value="09">September</option>
                        <option value="10">October</option>
                        <option value="11">November</option>
                        <option value="12">December</option>
                    </select>
                    <select name="cc_expiration_year" class="expiry-year">
                        <option value="" class="default" selected="selected">Year</option>
<?php for($i=date('Y');$i<date('Y')+9;$i++): ?>
                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
<?php endfor; ?>
                    </select>
                    <br/>
                </div>
            </div>
<?php elseif($_POST['pt'] == "CASH"): ?>
            <div id="rpc-body-pmnt-cotc-b">
                <div id="rpc-body-pmnt-cotc-b-h">
                    Cash Over the Counter <img src="assets/vigattin_mobile/images/new/cotc.jpg">
                </div>
                <div id="rpc-body-pmnt-cotc-b-i">
                    <label>FULL NAME</label>
                    <input type="text">
                    <br/>
                    <label>MOBILE NUMBER</label>
                    <input type="text">
                    <br/>
                    <label>ADDRESS 1</label>
                    <input type="text">
                    <br/>
                    <label>ADDRESS 2</label>
                    <input type="text">
                    <br/>
                    <label>CITY</label>
                    <input type="text">
                    <br/>
                    <label>PROVINCE</label>
                    <input type="text">
                    <br/>
                    <label>ZIP CODE</label>
                    <input type="text">
                    <br/>
                </div>
            </div>
<?php else: ?>
<?php redirect(base_url()."?e=invalid") ?>
<?php endif; ?>
<?php endif; ?>
        </div>
    </div>
    <div id="rpc-btn">
<?php if(!isset($_POST['pt'])): ?>
        <input type="hidden" name="buy1" value="<?php echo $_POST['buy1'] ?>">
        <input type="hidden" name="buy2" value="<?php echo $_POST['buy2'] ?>">
        <input type="hidden" name="quantity" value="<?php echo $_POST['quan'] ?>">
        <input type="hidden" name="loc" value="<?php echo $_POST['rbst'] ?>">
<?php else: ?>
        <input type="hidden" name="buy1" value="<?php echo $buy1 ?>">
        <input type="hidden" name="buy2" value="<?php echo $buy2 ?>">
        <input type="hidden" name="quantity" value="<?php echo $q ?>">
        <input type="hidden" name="loc" value="<?php echo $l ?>">
<?php endif; ?>
<?php if(isset($_POST['pt'])): ?>
        <input type="submit" id="rpc-btn-n" value="SUBMIT">
<?php endif; ?>
        <a href="javascript:history.back()">
            <div id="rpc-btn-b">BACK</div>
        </a>
    </div>
</form>
</div>