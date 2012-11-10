<div id="ordvou">
    <div id="ordvou-h">My Purchases And Voucher</div>
    <div id="ordvou-b">
<?php if($o_rows == 0): ?>
        <div id="ordvou-b-b">
            <div>
                No Order Yet.
            </div>
        </div>
<?php else: ?>
<?php foreach($o_res as $o_result): ?>
        <div id="ordvou-b-b">
            <div id="ordvou-b-b-img">
                <img src="assets/general/images/deals_gallery/customize/<?php echo $o_result->gallery_filename ?>" alt="" title="<?php echo $o_result->deal_title ?>!">
            </div>
            <div id="ordvou-b-b-i">
                Over the counter payment still pending. 
                <br/>
                <?php $o_date = ($o_result->order_date - time()); $o_date2=$this->cllibrary->timeleft($o_date); echo "<span id='d'>".$o_date2['0']."</span> days, <span id='h'>".$o_date2['1']."</span> hours, <span id='m'>".$o_date2['2']."</span> minutes, <span id='s'>".$o_date2['3']."</span> seconds"; ?> Left To Pay.
            </div>
        </div>
        <hr>
<?php endforeach; ?>
<?php endif; ?>
    </div>
</div>