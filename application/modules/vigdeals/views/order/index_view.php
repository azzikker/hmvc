<script type="text/javascript" src="assets/vigattin_deals/js/order.js"></script>
<script type="text/javascript" src="assets/general/js/order.js"></script>
<div id="voucher" class="fleft">
    <div id="voucher-h">
        My Purchases And Vouchers
        <div id="voucher-h-ob">
            <img src="assets/vigattin_deals/images/show.png">
            <div>View</div>
            <div id='voucher-h-ob-hov'>
                <br />
                <a href="order"<?php if($this->uri->segment(1) == "order" && $this->uri->segment(2) == "" || $this->uri->segment(2) == "page"): ?> id="voucher-h-ob-hov-active"<?php endif; ?>>All</a><br />
                <a href="order/pending"<?php if($this->uri->segment(1) == "order" && $this->uri->segment(2) == "pending"): ?> id="voucher-h-ob-hov-active"<?php endif; ?>>Pending</a><br />
                <a href="order/used"<?php if($this->uri->segment(1) == "order" && $this->uri->segment(2) == "used"): ?> id="voucher-h-ob-hov-active"<?php endif; ?>>Used</a><br />
                <a href="order/available"<?php if($this->uri->segment(1) == "order" && $this->uri->segment(2) == "available"): ?> id="voucher-h-ob-hov-active"<?php endif; ?>>Available</a><br />
                <a href="order/expired"<?php if($this->uri->segment(1) == "order" && $this->uri->segment(2) == "expired"): ?> id="voucher-h-ob-hov-active"<?php endif; ?>>Expired</a><br />
            </div>
        </div>
    </div>
    <div id="voucher-c" class="voucher-container">
<?php if($this->uri->segment(2) == "" || $this->uri->segment(2) == "page"): ?>
        <div id="voucher-d"><?php echo $o_rows; ?> Purchases</div>
<?php elseif($this->uri->segment(2) == "pending"): ?>
        <div id="voucher-d"><?php echo $o_rows; ?> Pending</div>
<?php elseif($this->uri->segment(2) == "expired"): ?>
        <div id="voucher-d"><?php echo $o_rows; ?> Expired</div>
<?php elseif($this->uri->segment(2) == "available"): ?>
        <div id="voucher-d"><?php echo $o_rows; ?> Available</div>
<?php elseif($this->uri->segment(2) == "used"): ?>
        <div id="voucher-d"><?php echo $o_rows; ?> Used</div>
<?php endif; ?>
<?php if($o_rows <> 0): ?>
<?php $res = 0; ?>
<?php foreach($o_res as $o_result): ?>
<?php $res++; ?>
        <div id="voucher-b" class="generated-voucher" txnid="<?php echo $o_result->order_txn; ?>">
            <div id="voucher-b-img">
                <img src="assets/general/images/deals_gallery/customize/<?php echo $o_result->gallery_filename ?>" width="150px">
                <br/>
                <?php echo $o_result->deal_title ?>!
                <br/>
                <br/>
<?php if($o_result->order_status == "used"): ?>
                Status: <span style="color: red;" class="order_status"><b>Used</b></span>
<?php elseif($o_result->order_status == "available"): ?>
                Status: <span style="color: green;" class="order_status"><b>Available</b></span>
<?php elseif($o_result->order_date > time()): ?>
                Status: <span class="order_status"><b>Pending</b></span>
<?php else: ?>
                Status: <span style="color: red;" class="order_status"><b>Expired</b></span>
<?php endif; ?>
            </div>
            <div id="voucher-b-d">
                Order ID:
                <br />
                <span><?php echo str_pad($o_result->order_id, 10, '0', STR_PAD_LEFT) ?></span>
                <br />
                Voucher #
                <br />
                <span class="voucher-b-d-voucher" voucher='<?php echo $o_result->voucher_no ?>'><?php echo $o_result->voucher_no ?></span>
            </div>
            <div class="voucher-b-r voucher-b-r2"> 
<?php if($o_result->order_status == "pending"): ?>
                <span><?php $o_date = ($o_result->order_date - time()); $o_date2=$this->cllibrary->timeleft($o_date); echo "<span id='d'>".$o_date2['0']."</span> days, <span id='h'>".$o_date2['1']."</span> hours, <span id='m'>".$o_date2['2']."</span> minutes, <span id='s'>".$o_date2['3']."</span> seconds"; ?> Left To Pay.</span>
<?php endif; ?>
                <br /><br />
<?php if($o_result->order_status == "pending"): ?>
                Purchase Date:
                <br />
                <span><?php echo date("Y-m-d",$o_result->order_date - 172800) ?> </span>
                <br /><br />
                Expiration Date:
                <br />
                <span><?php echo date("Y-m-d",$o_result->order_date) ?></span>
<?php elseif($o_result->order_status == "available"): ?>
                Purchase Date:
                <br />
                <span><?php echo date("Y-m-d",$o_result->order_date) ?> </span>
                <br /><br />
                Expiration Date:
                <br />
                <span><?php echo date("Y-m-d",$o_result->order_date +2160000) ?></span>
<?php endif; ?>
            </div>
            <div id="voucher-b-a">
                <br /><br />
                <div id='voucher-b-a-con'>
<?php if($o_result->order_status == "used" || $o_result->order_status == "available"): ?> 
                <a href='print/<?php echo $o_result->voucher_no; ?>' id="print">Print</a>
<?php endif; ?>
                </div>
                <br /><br />
                <a href="<?php if($o_result->deal_view_start < time() && $o_result->deal_view_end > time()): ?>deal<?php else: ?>past_deals<?php endif; ?>/<?php echo $o_result->deal_hash ?>">Preview Deal</a>
<?php if($o_result->order_date < time() && $o_result->order_status != "available"): ?>
                <br /><br />
                <span style="color: white;" vid="<?php echo $o_result->order_id ?>">Delete</span>
<?php endif; ?>
            </div>
        </div>
<?php endforeach; ?>
<?php if($res == 0): ?>
        <div id="voucher-b" style="text-align: center; font-size: 20px; padding-top: 50px; padding-bottom: 50px;">
            No Voucher Found in this page.
        </div>
<?php endif; ?>
<?php else: ?>
        <div id="voucher-msg">
            <div id="voucher-msg-c">
                <div style="text-align: center; font-weight: bold; font-family: arial; font-size: 20px;">No vouchers found.</div>
            </div>
        </div>
<?php endif; ?>
    <div id="voucher-c-page">
    <?php echo $this->pagination->create_links(); ?>
    </div>
    </div>
<?php if($this->uri->segment(2) == ""): ?>
    <input type="hidden" name="orurl" value="order">
<?php elseif($this->uri->segment(2) == "pending" && $this->uri->segment(3) == ""): ?>
    <input type="hidden" name="orurl" value="order/pending">
<?php elseif($this->uri->segment(2) == "pending" && $this->uri->segment(3) == "page"): ?>
    <input type="hidden" name="orurl" value="order/pending/page/<?php echo $this->uri->segment(4) ?>">
<?php elseif($this->uri->segment(2) == "expired" && $this->uri->segment(3) == ""): ?>
    <input type="hidden" name="orurl" value="order/expired">
<?php elseif($this->uri->segment(2) == "expired" && $this->uri->segment(3) == "page"): ?>
    <input type="hidden" name="orurl" value="order/expired/page/<?php echo $this->uri->segment(4) ?>">
<?php else: ?>
    <input type="hidden" name="orurl" value="order/page/<?php echo $this->uri->segment(3) ?>">
<?php endif; ?>
</div>
<!-- START OF ADS -->
<div class="fleft" id="ads" style="margin-top: 20px;">
    <div id="ads-h">You may also grab this:</div>
    <div id="ads-b-b-b">
        <div id="ads-b-b" class="ads-b-b-h">
<?php foreach($random_deals as $rd): ?>
            <a href="deal/<?php echo $rd->deal_hash ?>">
                <div class="ads-b">
                    <div id="ads-b-h" title="<?php echo $rd->deal_view_title ?>"><?php echo $rd->deal_view_title ?></div>
                    <img src="assets/general/images/deals_gallery/customize/<?php echo $rd->deal_image ?>" alt="" width="242px" height="98px">
                </div>
            </a>
<?php endforeach; ?>
        </div>
    </div>
</div>
<!-- END OF ADS -->