<div id="credits" class="fleft">
    <div id="credits-h">My Credits</div>
    <div id="credits-b">
        <a href="">
            <div id="credits-b-bvg">Buy Vigattin Gold&nbsp;&nbsp;&nbsp;<img src="assets/vigattin_deals/images/vigattingold.png" width="20px"></div>
        </a>
        <div id="credits-b-rot">
            <table width="100%" style="text-align: center;">
                <thead>
                    <tr>
                        <td>Rewards From Deal</td>
                        <td>Other Golds</td>
                        <td>Total Golds</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo number_format($cg->dummygold); ?></td>
                        <td>0</td>
                        <td><?php echo number_format($cg->dummygold); ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
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