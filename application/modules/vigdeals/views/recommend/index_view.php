<div id="recommend" class="fleft">
    <div id="recommend-h">Recommend a Deal</div>
    <div id="recommend-b">
        <form action="recommends" method="post" target="recommendf">
            <div id="recommend-b-b">
                Search Friend
                <input type="text" name="sf" id="recommend-b-b-rsf" readonly="readonly" value="Dejah Thoris" required="required"><br /><br />
                Product
                <input type="text" name="p" id="recommend-b-b-rpu" required="required"><br /><br />
                Message
                <textarea name="m" cols="10" rows="10" id="recommend-b-b-rpm" required="required">This is the best and most recommended deal.</textarea>
                <div class="push"></div><br /><br />
                <div>
                    <input type="submit" value="Send">
                </div>
            </div>
        </form>
        <iframe id="recommendf" name="recommendf" style="background-color: white; display: none;"></iframe>
    </div>
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
