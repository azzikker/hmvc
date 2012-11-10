<div id="invite" class="fleft"> 
    <div id="invite-h">My Invited Friends</div>
    <div id="invite-b">
    <span style="font-size: 16px; font-weight: bold;">Emailed Friends</span>
        <table class="invite-b-tb" cellpadding="0" cellspacing="0" style="border: 1px solid black;">
            <thead>
                <tr>
                    <td>Email</td>
                    <td>Name</td>
                    <td>Date</td>
                    <td>Status</td>
                </tr>
            </thead>
            <tbody>
<?php $irc = 0; ?>
<?php $link = 0; ?>
<?php foreach($invited_r as $ir): ?>
<?php if($irc == 0): ?>
<?php $irc = 1; ?> 
                <tr style="background-color: black; font-size: 14px; font-weight: bold;">
<?php else: ?>
<?php $irc = 0; ?>
                <tr style="font-size: 14px; font-weight: bold;">
<?php endif; ?>
                    <td><?php echo $ir->invited_email ?></td>
                    <td><?php echo $ir->invited_lname ?>, <?php echo $ir->invited_fname ?></td>
                    <td><?php echo date("m/d/Y",$ir->invited_date) ?></td>
                    <td><?php if($ir->invited_registered == 0): echo "Pending"; elseif($ir->invited_registered == 1): echo "Accepted"; else: echo "Rejected"; endif; ?></td>
                </tr>
<?php if($ir->invited_via == "link"): ?>
<?php $link++; ?>
<?php endif; ?>
<?php endforeach; ?>
            </tbody>
        </table>
        <div id="invite-b-hr"></div>
        <span style="font-size: 16px; font-weight: bold;">Other Friends(via Link Invitation) = <span style="font-size: 18px; color: #F69E2C;"><?php echo $link; ?></span></span>
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
