<script>var review = new review();</script>
<div id="rpc">
    <div id="rpc-header">
         <div id="rpc-header-box">
            <div class="rpc-header-box-active">
                REVIEW CART
                <br/>
                Step 1
            </div>
            <div id="rpc-header-box-mid">
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
<?php if($buys[1] == ""): ?>
<?php foreach($sd as $deals): ?>
<?php if(strtolower($deals->deal_view_type) == "single deal"): ?>
    <form action="mobile/payment" method="post">
        <div id="rpc-body">
            <div id="rpc-body-rev">
                <div id="rpc-body-rev-l"><li>DEAL</li></div>
                <div id="rpc-body-rev-d" style="margin-bottom: 20px; text-align: center;">
                    <img src="assets/general/images/deals_gallery/customize/<?php echo $deals->deal_image ?>">
                    <br/>
                    <?php echo $deals->deal_title ?>
                </div>
                <div id="rpc-body-rev-l"><li>QUANTITY</li></div>
                <div id="rpc-body-rev-d">
                    <input type="number" name="quan" value="1" maxlength="5" style="width: 80%; text-align: center;" max="<?php echo $deals->deal_current_stock ?>" min="1">
                    <br/>Quantity Left: <?php echo $deals->deal_current_stock ?>
                </div>
                <div id="rpc-body-rev-l"><li>SEND TO</li></div>
                <div id="rpc-body-rev-d">
                    <select style="width: 100%;" name="rbst">
                        <option value="0">Select Address</option>
<?php $l = 0; ?>
<?php foreach($location as $loc): ?>
<?php $l++; ?>
                        <option value="<?php echo $l ?>"><?php echo $loc->location_address ?></option>
<?php endforeach; ?>
                    </select>
                </div>
                <div id="rpc-body-rev-l"><li>UNIT PRICE</li></div>
                <div id="rpc-body-rev-d" style="font-weight: bold;" class="rpc-body-rev-d-op" op="<?php echo $deals->deal_discounted_price ?>">
                    P <?php echo number_format($deals->deal_discounted_price) ?>
                </div>
                <div id="rpc-body-rev-l"><li>TOTAL PRICE</li></div>
                <div id="rpc-body-rev-d" class="rpc-body-rev-d-dp" style="font-weight: bold;">
                    P <?php echo number_format($deals->deal_discounted_price) ?>
                </div>
            </div>
        </div>
        <div id="rpc-btn">
            <input type="hidden" name="buy1" value="<?php echo $this->uri->segment(3) ?>">
            <input type="hidden" name="buy2" value="<?php echo $this->uri->segment(4) ?>">
            <input type="submit" id="rpc-btn-n" value="NEXT">
            <a href="javascript:history.back()">
                <div id="rpc-btn-b">BACK</div>
            </a>
        </div>
    </form>
<?php else: ?>
<?php redirect(base_url()."?e=invalid"); ?>
<?php endif; ?>
<?php endforeach; ?>
<?php else: ?>
<?php foreach($sd as $deals): ?>
    <form action="mobile/payment" method="post">
        <div id="rpc-body">
            <div id="rpc-body-rev">
                <div id="rpc-body-rev-l"><li>DEAL</li></div>
                <div id="rpc-body-rev-d" style="margin-bottom: 20px; text-align: center;">
                    <img src="assets/general/images/deals_gallery/customize/<?php echo $deals->gallery_filename ?>">
                    <br/>
                    <?php echo $deals->deal_title ?>
                </div>
                <div id="rpc-body-rev-l"><li>QUANTITY</li></div>
                <div id="rpc-body-rev-d">
                    <input type="number" name="quan" value="1" maxlength="5" style="width: 80%; text-align: center;" max="<?php echo $deals->deal_current_stock ?>" min="1">
                    <br/>Quantity Left: <?php echo $deals->deal_current_stock ?>
                </div>
                <div id="rpc-body-rev-l"><li>SEND TO</li></div>
                <div id="rpc-body-rev-d">
                    <select style="width: 100%;" name="rbst">
                        <option value="0">Select Address</option>
<?php $l = 0; ?>
<?php foreach($location as $loc): ?>
<?php $l++; ?>
                        <option value="<?php echo $l ?>"><?php echo $loc->location_address ?></option>
<?php endforeach; ?>
                    </select>
                </div>
                <div id="rpc-body-rev-l"><li>UNIT PRICE</li></div>
                <div id="rpc-body-rev-d" style="font-weight: bold;" class="rpc-body-rev-d-op" op="<?php echo $deals->deal_discounted_price ?>">
                    P <?php echo number_format($deals->deal_discounted_price) ?>
                </div>
                <div id="rpc-body-rev-l"><li>TOTAL PRICE</li></div>
                <div id="rpc-body-rev-d" class="rpc-body-rev-d-dp" style="font-weight: bold;">
                    P <?php echo number_format($deals->deal_discounted_price) ?>
                </div>
            </div>
        </div>
        <div id="rpc-btn">
            <input type="hidden" name="buy1" value="<?php echo $this->uri->segment(3) ?>">
            <input type="hidden" name="buy2" value="<?php echo $this->uri->segment(4) ?>">
            <input type="submit" id="rpc-btn-n" value="NEXT">
            <a href="javascript:history.back()">
                <div id="rpc-btn-b">BACK</div>
            </a>
        </div>
    </form>
<?php endforeach; ?>
<?php endif; ?>
</div>