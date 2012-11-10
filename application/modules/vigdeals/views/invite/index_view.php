<script type="text/javascript" src="assets/vigattin_deals/js/colorplugin.js"></script>
<script type="text/javascript" src="assets/vigattin_deals/js/zclip/jquery.zclip.min.js"></script>
<script type="text/javascript" src="assets/vigattin_deals/js/invite.js"></script>
<div id="invite" class="fleft">
    <div id="invite-h">Invite a Friend</div>
    <div id="invite-b">
        <span style="font-size: 14px;">We will give you 200 credits when someone you invite joins the Vigattin community. We want to reward you for sharing our great deals and there is no limit on how much you can earn!</span>
        <div id="invite-b-hr"></div>
        <span style="font-size: 16px; font-weight: bold;">Send Email Invitation</span>
        <br />
        <form action="invitenow" method="post">
            <table class="invite-b-tb">
                <thead>
                    <tr>
                        <td>Email</td>
                        <td>First Name</td>
                        <td>Last Name</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input type="text" name="inv-e[]" required="required"></td>
                        <td><input type="text" name="inv-fn[]" required="required"></td>
                        <td><input type="text" name="inv-ln[]" required="required"></td>
                    </tr>
                </tbody>
            </table>
            <input type="hidden" name="inv-ni" value="1">
            <div id="invite-b-ar">
                <input type="button" value="-">
                <input type="button" value="+">
                <br />
                <img src="assets/vigattin_deals/images/loading2.gif" alt="" style="height: 25px; display: none;" id="invite-b-ar-lding"><input type="submit" value="INVITE">
            </div>
        </form>
        <div id="invite-b-hr"></div>
        <span style="font-size: 16px; font-weight: bold;">My Link Invitation</span>
        <br />
        <input type="text" readonly="readonly" value="<?php echo base_url() ?>vigdeals/vigdealswauth/link/<?php echo $customer->customer_hash ?>" style="width: 60%; height: 25px; font-size: 18px; color: white; border: none; background: #111111; padding: 3px; margin-top: 15px; float: left;">
        <input type="button" value="Copy" style="font-size: 16px;background: black;color: white;border: none;font-family: century gothic,tahoma,verdana,arial,helvetica,sans-serif;cursor: pointer; float: left; margin-top: 17px;">
        <div id="invite-b-msgd" style="float: left; margin-top: 15px; padding-top: 3px; margin-left: 10px;"></div>
        <div id="invite-b-chk" style="background: url('assets/vigattin_deals/images/images2.png') -254px -5px; width: 44px; height: 26px; float: left; margin-top: 14px; display: none; margin-left: 10px;"></div>
        <span id="invite-b-msg"></span>
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
