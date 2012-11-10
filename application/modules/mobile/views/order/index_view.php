<div id="ordvou">
    <div id="ordvou-h">My Purchases And Voucher</div>
    <div id="ordvou-b">
<?php if($o_rows <> 0):
$res = 0;
foreach($o_res as $o_result):
    $purdate = "";
    $remaining = 0;
    $res++;
    $statust = $o_result->order_status;
    $preview = "";
    if($o_result->deal_view_start < time() && $o_result->deal_view_end > time()) $preview = "mobile/deal";
    else $preview = "mobile/past_deals";
    
    if($statust == "used"): 
        $statusc = "red";
        $b3 = "<a href='mobile/print/".$o_result->voucher_no."'>Print</a> | <a href='".$preview."/".$o_result->deal_hash."'>Preview Deal</a> | Delete";
    elseif($statust == "available"): 
        $statusc = "green"; 
        $purdate = "
                    <br /><br />
                    Purchase Date: <b>".date("Y-m-d",$o_result->order_date)."</b><br />
                    Expiration Date: <b>".date("Y-m-d",$o_result->order_date +2160000)."</b>";
        $b3 = "<a href='mobile/print/".$o_result->voucher_no."'>Print</a> | <a href='".$preview."/".$o_result->deal_hash."'>Preview Deal</a>";
    elseif($o_result->order_date > time()):
        $statusc = "orange";
        $b3 = "<a href='".$preview."/".$o_result->deal_hash."'>Preview Deal</a>";
        $purdate = "
                    <br /><br />
                    Purchase Date: <b>".date("Y-m-d",$o_result->order_date - 172800)."</b><br />
                    Expiration Date: <b>".date("Y-m-d",$o_result->order_date)."</b>";
        $remaining = 1;
    else:
        $statusc = "red";
        $b3 = "<a href='".$preview."/".$o_result->deal_hash."'>Preview Deal</a> | Delete";
    endif; ?>
        <div id="ordvou-b2-img" class="fleft">
            <img src="assets/general/images/deals_gallery/customize/<?php echo $o_result->gallery_filename ?>">
        </div>
        <div id="ordvou-b2-b" class="fleft">
            <b><?php echo $o_result->deal_title ?>!</b><br />
            Status: <b style="color: <?php echo $statusc; ?>;"><?php echo $statust; ?></b><br />
        </div>
        <div class="push"></div>
        <div id='ordvou-b2-b2'>
        <?php if($remaining == 1): ?>
            <b style="color: orange"><?php $o_date = ($o_result->order_date - time()); $o_date2=$this->cllibrary->timeleft($o_date); echo "<span id='d'>".$o_date2['0']."</span> days, <span id='h'>".$o_date2['1']."</span> hours, <span id='m'>".$o_date2['2']."</span> minutes, <span id='s'>".$o_date2['3']."</span> seconds"; ?> Left To Pay.</b><br />
<?php endif; ?>
            Order ID: <b><?php echo str_pad($o_result->order_id, 10, '0', STR_PAD_LEFT) ?></b><br />
            Voucher #: <b><?php echo $o_result->voucher_no ?></b>
            <?php echo $purdate; ?>
        </div>
        <div id='ordvou-b2-b3'>
            <?php echo $b3; ?>
        </div>
        <hr>
<?php endforeach; ?>
<?php else: ?>
    wew
<?php endif; ?>
    </div>
    <div id='voucher-c-page'><?php echo $this->pagination->create_links(); ?></div>
</div>