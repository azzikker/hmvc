<!-- FB START -->
<script type="text/javascript" src="assets/vigattin_deals/js/fb.js"></script>
<div id="fb-root"></div>
<!-- FB END -->
<?php if(isset($deals_view)): ?>
<?php foreach($deals_view as $dv): ?>
<script>var googlemap = new googlemap()</script>
<script>var slideshow = new slideshow()</script>
<script>var viewvideo2 = new viewvideo2()</script>
<!-- START OF BOX -->
<div id="deal-box">
    <div id="deal-box-header">
        <?php echo $dv->deal_view_title ?>!
        <a href=""><div class="fright" id="deal-box-header-sp"><span>>></span> Supported Foundation</div></a>
    </div>
    <div id="deal-box-info" class="fright">
        <div id="deal-box-info-statement"><?php echo $dv->deal_view_statement ?></div>
        <div id="deal-box-info-btnsandd" class="deal-box-info-btnsandd"<?php if($dv->video_embed == ""): ?> style="height: 90px;"<?php endif; ?>>
            <div id="deal-box-info-btnsandd-opd">
                <div id="deal-box-info-btnsandd-op">
                    <span>P <?php echo number_format($dv->deal_original_price) ?></span>
                    <div>Original Price</div>
                </div>
                <div id="deal-box-info-btnsandd-d">
                    <div id="deal-box-info-btnsandd-d-n"><?php echo $dv->deal_discount ?>%</div>
                    <div id="deal-box-info-btnsandd-d-off">off</div>
                </div>
            </div>
            <div id="deal-box-info-btnanddd-dp">
                <span>P <?php echo number_format($dv->deal_discounted_price) ?></span>
            </div>
            <div class="push"></div>
<?php if($dv->video_embed <> ""): ?>
            <div class="deal-box-info-btnanddd-wv">
                <div link="<?php echo htmlspecialchars($dv->video_embed); ?>">Watch Video</div>
            </div>
<?php endif; ?>
        </div>
    </div>
    <div id="deal-box-img">
        <div>
<?php foreach($galleries as $gallery): ?>
            <img class="deal-box-imgs" src="assets/general/images/deals_gallery/optimize/<?php echo $gallery->gallery_filename ?>" alt="">
<?php endforeach; ?>
        </div>
    </div>
</div>
<!-- END OF BOX -->
<!-- START OF ETC -->
<div id="etcbtn">
    <a href="javascript: return false;" onclick="window.open('http://www.javascript-coder.com','mywindow','menubar=1,resizable=1,width=500,height=500')">
        <div id="etcbtn-cw" class="fleft"></div>
    </a>
    <div id="etcbtn-fb">
        <div id="etcbtn-fb-share">
            <script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script>    
                <span style="border:1px solid #CAD4E7; display:block; padding:1px; background:#eceef5; height: 17px; margin-right: 5px;-webkit-border-radius: 3px;-moz-border-radius: 3px;border-radius: 3px;">
                    <fb:share-button href="<?php echo base_url() ?>past_deals/<?php echo $dv->deal_hash ?>?og_title=<?php echo urlencode("Past Deal - ".$dv->deal_view_title); ?>&og_description=<?php echo urlencode($dv->deal_view_statement); ?>&og_image=<?php echo urlencode(base_url().'assets/general/images/deals_gallery/optimize/'.$gallery->gallery_filename); ?>" class="meta">
                    </fb:share-button> 
                </span>
        </div>
        <div id="etcbtn-fb-like">
            <iframe src="http://www.facebook.com/plugins/like.php?href=<?php echo base_url()."past_deals/".$this->uri->segment(2) ?>&layout=button_count&show_faces=false&width=100&action=like&amp;font&colorscheme=light&height=20" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:100px; height:20px;" allowTransparency="true"></iframe>
        </div>
    </div>
</div>
<!-- END OF ETC -->
<!-- START OF INFO -->
<div id="deal-info" class="fleft">
<div id="deal-info-box">
    <div id="deal-info-hlts">
        <div id="deal-info-h">HIGHLIGHTS</div>
        <div id="deal-info-c">
            <ul>
<?php foreach($highlight as $hl): ?>
                <li><?php echo $hl->highlight_content ?></li>
<?php endforeach; ?>
            </ul>
        </div>
    </div>
    <div id="deal-info-hr"></div>
    <div id="deal-info-abt">
        <div id="deal-info-h">ABOUT</div>
        <div id="deal-info-c">
            <?php echo nl2br($dv->deal_content) ?>
        </div>
    </div>
    <div id="deal-info-hr"></div>
    <div id="deal-info-dt">
        <div id="deal-info-h">DEAL'S TERMS</div>
        <div id="deal-info-c">
            <ul>
<?php foreach($fineprint as $fp): ?>
                <li><?php echo $fp->fineprint_content ?></li>
<?php endforeach; ?>
            </ul>
        </div>
    </div>
    <div id="deal-info-hr"></div>
    <div id="deal-info-lm">
        <div id="deal-info-h">LOCATION MAP</div>
        <div id="deal-info-c">
            <div id="deal-info-c-gm" class="fleft">
<?php foreach($location_limit as $ad_limit) : ?>
<?php if($ad_limit->location_link == "" || $ad_limit->location_address == "") : ?>

<?php else : ?>
                <iframe class="google_iframe" width="300" height="300" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="<?php echo $ad_limit->location_link; ?>&z=15&output=embed"></iframe>
<?php endif ?>
<?php endforeach ?>
            </div>
            <div class="fleft">
                <ul style="margin-left: 10px; text-decoration: underline; cursor: pointer; width: 360px;">
<?php foreach($location as $ad) : ?>
<?php if($ad->location_address == "") : ?>

<?php else : ?>
                    <li link="<?php echo $ad->location_link; ?>"><?php echo $ad->location_address; ?></li>
<?php endif ?>
<?php endforeach ?>
                </ul>
            </div>
        </div>
    </div>
</div>
</div>
<!-- END OF INFO -->
<!-- START OF ADS -->
<div class="fleft" id="ads" style="margin-left: 5px;">
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
<?php endforeach; ?>
<?php else: ?>
<?php $sdeal=0; ?>
<?php if($this->uri->segment(3) == ""): ?>
<?php foreach($banner as $img):?>
    <img class="deal-box-banner" src="assets/general/images/deals_gallery/optimize/<?php echo $img->deal_image ?>" alt="" style="margin-top: 25px;">
<?php endforeach; ?>
<script>var viewvideo2 = new viewvideo2();</script>
<?php foreach($deals as $dv): ?>
<!-- START OF BOX -->
<div id="deal-box">
    <div id="deal-box-header">
        <?php echo $dv->deal_title ?>!
        <a href="javascript:return false;" onclick="window.open('http://www.facebook.com','mywindow','menubar=1,resizable=1,width=500,height=500')"><div class="fright" id="deal-box-header-sp"><span>>></span> Supported Foundation</div></a>
    </div>
    <div id="deal-box-info" class="fright">
        <div id="deal-box-info-statement"><?php echo $dv->deal_statement ?></div>
<?php if($dv->deal_current_stock <> 0): ?>
        <div id="deal-box-info-btnsandd2"<?php if($dv->video_embed == ""): ?> style="height: 145px;"<?php endif; ?>>
            <div id="deal-box-info-btnsandd2-opd">
                <div id="deal-box-info-btnsandd2-op">
                    <span>P <?php echo number_format($dv->deal_original_price) ?></span>
                    <div>Original Price</div>
                </div>
                <div id="deal-box-info-btnsandd2-d">
                    <div id="deal-box-info-btnsandd2-d-n"><?php echo $dv->deal_discount ?>%</div>
                    <div id="deal-box-info-btnsandd2-d-off">off</div>
                </div>
            </div>
            <div id="deal-box-info-btnanddd2-dp">
                <span>P <?php echo number_format($dv->deal_discounted_price) ?></span>
            </div>
            <div id="deal-box-info-btnanddd2-vgs">
                <a href="past_deals/<?php echo $dv->deal_hash ?>/<?php echo $sdeal ?>">
                    <div class="deal-box-info-btnanddd2-vg">
                        <span style="text-shadow: none; color: white;">VIEW THIS DEAL</span>
                    </div>
                </a>
            </div>
<?php if($dv->video_embed <> ""): ?>
            <div class="deal-box-info-btnanddd-wv">
                <div link="<?php echo htmlspecialchars($dv->video_embed) ?>">Watch Video</div>
            </div>
<?php endif; ?>
        </div>
<?php else: ?>
        <div id="deal-box-info-btnsandd2"<?php if($dv->video_embed == ""): ?> style="height: 145px;"<?php endif; ?>>
            <div id="deal-box-info-btnsandd2-opd">
                <div id="deal-box-info-btnsandd2-op">
                    <span>P <?php echo number_format($dv->deal_original_price) ?></span>
                    <div>Original Price</div>
                </div>
                <div id="deal-box-info-btnsandd2-d">
                    <div id="deal-box-info-btnsandd2-d-n"><?php echo $dv->deal_discount ?>%</div>
                    <div id="deal-box-info-btnsandd2-d-off">off</div>
                </div>
            </div>
            <div id="deal-box-info-btnanddd2-dp">
                <span>P <?php echo number_format($dv->deal_discounted_price) ?></span>
            </div>
            <div id="deal-box-info-btnanddd2-vgs">
                <a href="past_deals/<?php echo $dv->deal_hash ?>/<?php echo $sdeal ?>">
                    <div class="deal-box-info-btnanddd2-vg">
                        <span>SOLD OUT</span>
                    </div>
                </a>
            </div>
<?php if($dv->video_embed <> ""): ?>
            <div class="deal-box-info-btnanddd-wv">
                <div link="<?php echo htmlspecialchars($dv->video_embed) ?>">Watch Video</div>
            </div>
<?php endif; ?>
        </div>
<?php endif; ?>
    </div>
    <div id="deal-box-img">
        <img class="deal-box-imgs" src="assets/general/images/deals_gallery/optimize/<?php echo $dv->gallery_filename ?>" alt="">
    </div>
</div>
<!-- END OF BOX -->
<?php $sdeal++; ?>
<?php endforeach; ?>
<?php else: ?>
<?php foreach($subdeals as $dv): ?>
<script>var googlemap = new googlemap()</script>
<script>var slideshow = new slideshow()</script>
<script>var viewvideo2 = new viewvideo2()</script>
<!-- START OF BOX -->
<div id="deal-box">
    <div id="deal-box-header">
        <?php echo $dv->deal_title ?>!
        <a href=""><div class="fright" id="deal-box-header-sp"><span>>></span> Supported Foundation</div></a>
    </div>
    <div id="deal-box-info" class="fright">
        <div id="deal-box-info-statement"><?php echo $dv->deal_view_statement ?></div>
        <div id="deal-box-info-btnsandd" class="deal-box-info-btnsandd"<?php if($dv->video_embed == ""): ?> style="height: 90px;"<?php endif; ?>>
            <div id="deal-box-info-btnsandd-opd">
                <div id="deal-box-info-btnsandd-op">
                    <span>P <?php echo number_format($dv->deal_original_price) ?></span>
                    <div>Original Price</div>
                </div>
                <div id="deal-box-info-btnsandd-d">
                    <div id="deal-box-info-btnsandd-d-n"><?php echo $dv->deal_discount ?>%</div>
                    <div id="deal-box-info-btnsandd-d-off">off</div>
                </div>
            </div>
            <div id="deal-box-info-btnanddd-dp">
                <span>P <?php echo number_format($dv->deal_discounted_price) ?></span>
            </div>
            <div class="push"></div>
<?php if($dv->video_embed <> ""): ?>
            <div class="deal-box-info-btnanddd-wv">
                <div link="<?php echo htmlspecialchars($dv->video_embed); ?>">Watch Video</div>
            </div>
<?php endif; ?>
        </div>
    </div>
    <div id="deal-box-img">
<?php $img=1; ?>
        <div>
<?php foreach($galleries as $gallery): ?>
            <img class="deal-box-imgs" src="assets/general/images/deals_gallery/optimize/<?php echo $gallery->gallery_filename ?>" alt="" id="<?php echo $img++; ?>">
<?php endforeach; ?>
        </div>
    </div>
</div>
<!-- END OF BOX -->
<!-- START OF ETC -->
<div id="etcbtn">
    <a href="javascript: return false;" onclick="window.open('http://www.javascript-coder.com','mywindow','menubar=1,resizable=1,width=500,height=500')">
        <div id="etcbtn-cw" class="fleft"></div>
    </a>
    <div id="etcbtn-fb">
        <div id="etcbtn-fb-share">
            <script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script>    
            <span style="border:1px solid #CAD4E7; display:block; padding:1px; background:#eceef5; height: 17px; margin-right: 5px;-webkit-border-radius: 3px;-moz-border-radius: 3px;border-radius: 3px;">
                <fb:share-button href="<?php echo base_url() ?>past_deals/<?php echo $dv->deal_hash ?>/<?php echo $this->uri->segment(3) ?>?og_title=<?php echo urlencode("Past Deal - ".$dv->deal_view_title); ?>&og_description=<?php echo urlencode($dv->deal_view_statement); ?>&og_image=<?php echo urlencode(base_url().'assets/general/images/deals_gallery/optimize/'.$gallery->gallery_filename); ?>" class="meta">
                </fb:share-button> 
            </span>
        </div>
        <div id="etcbtn-fb-like">
            <iframe src="http://www.facebook.com/plugins/like.php?href=<?php echo base_url()."past_deals/".$this->uri->segment(2) ?>/<?php echo $this->uri->segment(3) ?>&layout=button_count&show_faces=false&width=100&action=like&amp;font&colorscheme=light&height=20" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:100px; height:20px;" allowTransparency="true"></iframe>
        </div>
    </div>
</div>
<!-- END OF ETC -->
<!-- START OF INFO -->
<div id="deal-info" class="fleft">
<div id="deal-info-box">
    <div id="deal-info-hlts">
        <div id="deal-info-h">HIGHLIGHTS</div>
        <div id="deal-info-c">
            <ul>
<?php foreach($highlight as $hl): ?>
                <li><?php echo $hl->highlight_content ?></li>
<?php endforeach; ?>
            </ul>
        </div>
    </div>
    <div id="deal-info-hr"></div>
    <div id="deal-info-abt">
        <div id="deal-info-h">ABOUT</div>
        <div id="deal-info-c">
            <?php echo nl2br($dv->deal_content) ?>
        </div>
    </div>
    <div id="deal-info-hr"></div>
    <div id="deal-info-dt">
        <div id="deal-info-h">DEAL'S TERMS</div>
        <div id="deal-info-c">
            <ul>
<?php foreach($fineprint as $fp): ?>
                <li><?php echo $fp->fineprint_content ?></li>
<?php endforeach; ?>
            </ul>
        </div>
    </div>
    <div id="deal-info-hr"></div>
    <div id="deal-info-lm">
        <div id="deal-info-h">LOCATION MAP</div>
        <div id="deal-info-c">
            <div id="deal-info-c-gm" class="fleft">
<?php foreach($location_limit as $ad_limit) : ?>
<?php if($ad_limit->location_link == "" || $ad_limit->location_address == "") : ?>

<?php else : ?>
                <iframe class="google_iframe" width="300" height="300" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="<?php echo $ad_limit->location_link; ?>&z=15&output=embed"></iframe>
<?php endif ?>
<?php endforeach ?>
            </div>
            <div class="fleft">
                <ul style="margin-left: 10px; text-decoration: underline; cursor: pointer; width: 360px;">
<?php foreach($location as $ad) : ?>
<?php if($ad->location_address == "") : ?>

<?php else : ?>
                    <li link="<?php echo $ad->location_link; ?>"><?php echo $ad->location_address; ?></li>
<?php endif ?>
<?php endforeach ?>
                </ul>
            </div>
        </div>
    </div>
</div>
</div>
<!-- END OF INFO -->
<!-- START OF ADS -->
<div class="fleft" id="ads" style="margin-left: 5px;">
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
<?php endforeach; ?>
<?php endif; ?>
<?php endif; ?>
