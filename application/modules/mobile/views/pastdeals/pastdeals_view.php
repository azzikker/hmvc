<div id="navigation">
    <ul>
        <a href="mobile"><li id="navigation-td"<?php if($this->uri->segment(2) == "" || $this->uri->segment(2) == "deal"): ?> class="navigation-active"<?php endif; ?>>Today's Deals</li></a>
        <a href="mobile/past_deals"><li<?php if($this->uri->segment(2) == "past_deals"): ?> class="navigation-active"<?php endif; ?>>Past Deals</li></a>
        <a href="mobile/how_it_works"><li<?php if($this->uri->segment(2) == "how_it_works"): ?> class="navigation-active"<?php endif; ?>>How It Works</li></a>
        <a href="mobile/about_us"><li<?php if($this->uri->segment(2) == "about_us"): ?> class="navigation-active"<?php endif; ?>>About Us</li></a>
    </ul>
</div>
<div id="category">
    <div id="category-btn">
        <div id="category-img"></div>
        <div id="category-lbl">Click to view the CATEGORIES</div>
    </div>
    <div id="category-icons">
        <div id="category-icons-box">
            <ul>
                <?php $caticon = 1; ?>
                <?php foreach($deals_category as $dc): ?>
                    <?php $replacedc = preg_replace('/[^a-z0-9]/i',' ',$dc->category_name);?>
                    <a href="mobile/past-category/<?php echo $dc->category_id ?>-<?php echo str_replace(" ","",$replacedc); ?>"><li id="category-icons-<?php echo $caticon; ?>"<?php $uri2 = $this->uri->segment(3); $strpos = stripos($uri2,"-"); $cat_id = substr($uri2,0, $strpos); if($cat_id == $dc->category_id): ?>class="category-icons-active"<?php endif; ?>><?php echo strtoupper($dc->category_name) ?></li></a>
                    <?php $caticon++; ?>
                    <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>
<div id="video"></div>
<?php if(isset($deals_view)): ?>
<?php foreach($deals_view as $dv): ?>
<script>var gm = new gm();</script>
<div id='googlemap'>
    <div id="googlemap-hide">HIDE</div>
</div>
<!-- START OF DEAL -->
<div id="deal">
    <div id="deal-h">
        <div id="deal-h-h"><?php echo $dv->deal_view_title ?>!</div>
        <div id="deal-h-sf">Supported Foundation</div>
    </div>
    <div id="deal-img">
        <img src="assets/general/images/deals_gallery/optimize/<?php echo $dv->deal_image; ?>" alt="">
    </div>
    <div id="deal-info">
        <div id="deal-info-top">
            <div id="deal-info-top-left">
                <div id="deal-info-top-left-left">
                    <span>P <?php echo number_format($dv->deal_original_price) ?></span>
                </div>
                <div id="deal-info-top-left-right">
                    <span><?php echo $dv->deal_discount ?>%</span>
                    <div>off</div>
                </div>
            </div>
<?php if (strtolower($dv->deal_view_type) == "single deal"): ?>
            <div class="deal-info-top-right" link="<?php echo htmlspecialchars($dv->video_embed) ?>">
                WATCH VIDEO
            </div>
<?php endif ?>
        </div>
        <div id="deal-info-bot">
            <div id="deal-info-bot-left">
                <span>P <?php echo number_format($dv->deal_discounted_price) ?></span>
            </div>
        </div>
    </div>
</div>
<!-- END OF DEAL -->
<div id="etcbtn">
    <div id="etcbtn-sl">
        <div id="etcbtn-sl-s">
        <script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script>
        <span style="border:1px solid #CAD4E7; display:block; padding:1px; background:#eceef5; height: 17px; margin-right: 5px;-webkit-border-radius: 3px;-moz-border-radius: 3px;border-radius: 3px;">
            <fb:share-button href="<?php echo base_url(); ?>mobile/past_deals/<?php echo $this->uri->segment(3) ?>/<?php $this->uri->segment(4) ?>" class="meta">
                <meta property="og:title" content="Past Deals - <?php echo $dv->deal_view_title ?>!"/>
                <meta property="og:type" content="product"/>
                <meta property="og:url" content="<?php echo base_url(); ?>mobile/past_deals/<?php echo $this->uri->segment(3) ?>/<?php $this->uri->segment(4) ?>"/>
                <meta property="og:description" content="<?php echo $dv->deal_view_statement ?>" />
                <meta property="og:image" content="<?php echo base_url(); ?>assets/general/images/deals_gallery/optimize/<?php echo $dv->deal_image; ?>"/>
                <meta name="title" content="Past Deals - <?php echo $dv->deal_view_title ?>!" />
                <link rel="image_src" href="<?php echo base_url(); ?>assets/general/images/deals_gallery/optimize/<?php echo $dv->deal_image; ?>" />
                <link rel="target_url" href="<?php echo base_url(); ?>mobile/past_deals/<?php echo $this->uri->segment(3) ?>/<?php $this->uri->segment(4) ?>" />
            </fb:share-button> 
        </span>
        </div>
        <div id="etcbtn-sl-l">
            <iframe src="http://www.facebook.com/plugins/like.php?href=<?php echo base_url()."mobile/past_deals/".$this->uri->segment(3) ?>/<?php $this->uri->segment(4) ?>&layout=button_count&show_faces=false&width=100&action=like&amp;font&colorscheme=light&height=20" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:100px; height:20px;" allowTransparency="true"></iframe>
        </div>
    </div>
</div>
<!--START OF INFO-->
<div id="info">
    <div id="info-b">
        <div id="info-h">HIGHLIGHTS</div>
        <div id="info-i">
            <ul>
<?php foreach($highlight as $hl): ?>
                <li><?php echo $hl->highlight_content ?></li>
<?php endforeach; ?>
            </ul>
        </div>
        <div id="info-h">ABOUT</div>
            <div id="info-i">
                <?php echo nl2br($dv->deal_content) ?>
            </div>
        <div id="info-h">DEAL'S TERMS</div>
            <div id="info-i">
                <ul>
<?php foreach($fineprint as $fp): ?>
                    <li><?php echo $fp->fineprint_content ?></li>
<?php endforeach; ?>
                </ul>
            </div>
    </div>
    <div id="info-dbtn">
        <div id="info-dbtn-gm-box">
            <div id="info-dbtn-gm"></div>
        </div>
    </div>
    <div id="info-gmbtn">
<?php foreach($location as $ad) : ?>
<?php if($ad->location_address == "") : ?>

<?php else : ?>
        <div class="info-gmbtn-btn" link="<?php echo $ad->location_link; ?>"><?php echo $ad->location_address; ?></div>
<?php endif; ?>
<?php endforeach; ?>
    </div>
</div>
<!--END OF INFO-->
<?php endforeach; ?>
<?php else: ?>
<?php if($this->uri->segment(4) <> ""): ?>
<?php foreach($subdeals as $dv): ?>
<script>var gm = new gm();</script>
<div id='googlemap'>
    <div id="googlemap-hide">HIDE</div>
</div>
<!-- START OF DEAL -->
<div id="deal">
    <div id="deal-h">
        <div id="deal-h-h"><?php echo $dv->deal_view_title ?>!</div>
        <div id="deal-h-sf">Supported Foundation</div>
    </div>
    <div id="deal-img">
        <img src="assets/general/images/deals_gallery/optimize/<?php echo $dv->gallery_filename; ?>" alt="">
    </div>
    <div id="deal-info">
        <div id="deal-info-top">
            <div id="deal-info-top-left">
                <div id="deal-info-top-left-left">
                    <span>P <?php echo number_format($dv->deal_original_price) ?></span>
                </div>
                <div id="deal-info-top-left-right">
                    <span><?php echo $dv->deal_discount ?>%</span>
                    <div>off</div>
                </div>
            </div>
            <div class="deal-info-top-right" link="<?php echo htmlspecialchars($dv->video_embed) ?>">
                WATCH VIDEO
            </div>
        </div>
        <div id="deal-info-bot">
            <div id="deal-info-bot-left">
                <span>P <?php echo number_format($dv->deal_discounted_price) ?></span>
            </div>
        </div>
    </div>
</div>
<!-- END OF DEAL -->
<div id="etcbtn">
    <div id="etcbtn-sl">
        <div id="etcbtn-sl-s">
        <script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script>
        <span style="border:1px solid #CAD4E7; display:block; padding:1px; background:#eceef5; height: 17px; margin-right: 5px;-webkit-border-radius: 3px;-moz-border-radius: 3px;border-radius: 3px;">
            <fb:share-button href="<?php echo base_url(); ?>mobile/past_deals/<?php echo $this->uri->segment(3) ?>/<?php echo $this->uri->segment(4) ?>" class="meta">
                <meta property="og:title" content="Past Deals - <?php echo $dv->deal_view_title ?>!"/>
                <meta property="og:type" content="product"/>
                <meta property="og:url" content="<?php echo base_url(); ?>mobile/past_deals/<?php echo $this->uri->segment(3) ?>/<?php echo $this->uri->segment(4) ?>"/>
                <meta property="og:description" content="<?php echo $dv->deal_view_statement ?>" />
                <meta property="og:image" content="<?php echo base_url(); ?>assets/general/images/deals_gallery/optimize/<?php echo $dv->deal_image; ?>"/>
                <meta name="title" content="Past Deals - <?php echo $dv->deal_view_title ?>!" />
                <link rel="image_src" href="<?php echo base_url(); ?>assets/general/images/deals_gallery/optimize/<?php echo $dv->deal_image; ?>" />
                <link rel="target_url" href="<?php echo base_url(); ?>mobile/past_deals/<?php echo $this->uri->segment(3) ?>/<?php echo $this->uri->segment(4) ?>" />
            </fb:share-button> 
        </span>
        </div>
        <div id="etcbtn-sl-l">
            <iframe src="http://www.facebook.com/plugins/like.php?href=<?php echo base_url()."mobile/past_deals/".$this->uri->segment(3) ?>/<?php echo $this->uri->segment(4) ?>&layout=button_count&show_faces=false&width=100&action=like&amp;font&colorscheme=light&height=20" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:100px; height:20px;" allowTransparency="true"></iframe>
        </div>
    </div>
</div>
<!--START OF INFO-->
<div id="info">
    <div id="info-b">
        <div id="info-h">HIGHLIGHTS</div>
        <div id="info-i">
            <ul>
<?php foreach($highlight as $hl): ?>
                <li><?php echo $hl->highlight_content ?></li>
<?php endforeach; ?>
            </ul>
        </div>
        <div id="info-h">ABOUT</div>
            <div id="info-i">
                <?php echo nl2br($dv->deal_content) ?>
            </div>
        <div id="info-h">DEAL'S TERMS</div>
            <div id="info-i">
                <ul>
<?php foreach($fineprint as $fp): ?>
                    <li><?php echo $fp->fineprint_content ?></li>
<?php endforeach; ?>
                </ul>
            </div>
    </div>
    <div id="info-dbtn">
        <div id="info-dbtn-gm-box">
            <div id="info-dbtn-gm"></div>
        </div>
    </div>
    <div id="info-gmbtn">
<?php foreach($location as $ad) : ?>
<?php if($ad->location_address == "") : ?>

<?php else : ?>
        <div class="info-gmbtn-btn" link="<?php echo $ad->location_link; ?>"><?php echo $ad->location_address; ?></div>
<?php endif; ?>
<?php endforeach; ?>
    </div>
</div>
<!--END OF INFO-->
<?php endforeach; ?>
<?php else: ?>
<?php $dh=0; ?>
<?php foreach($deals as $dv): ?>
<!-- START OF DEAL -->
<div id="deal">
    <div id="deal-h">
        <div id="deal-h-h"><?php echo $dv->deal_view_title ?>!</div>
        <div id="deal-h-sf">Supported Foundation</div>
    </div>
    <div id="deal-img">
        <img class="deal-box-imgs" src="assets/general/images/deals_gallery/optimize/<?php echo $dv->gallery_filename ?>" alt="">
    </div>
    <div id="deal-info">
        <div id="deal-info-top">
            <div id="deal-info-top-left">
                <div id="deal-info-top-left-left">
                    <span>P <?php echo number_format($dv->deal_original_price) ?></span>
                </div>
                <div id="deal-info-top-left-right">
                    <span><?php echo $dv->deal_discount ?>%</span>
                    <div>off</div>
                </div>
            </div>
            <div class="deal-info-top-right" link="<?php echo htmlspecialchars($dv->video_embed) ?>">
                WATCH VIDEO
            </div>
        </div>
        <div id="deal-info-bot">
            <div id="deal-info-bot-left">
                <span>P <?php echo number_format($dv->deal_discounted_price) ?></span>
            </div>
            <a href="mobile/past_deals/<?php echo $dv->deal_hash ?>/<?php echo $dh; ?>">
<?php if($dv->deal_current_stock <> 0): ?>
                <div id="deal-info-bot-right">
                    <div><span>VI</span>gorously</div>
                    <div><span>G</span>rab <span>IT</span>!</div>
                </div>
<?php else: ?>
                <div id="deal-info-bot-right">
                    <div>SOLD</div>
                    <div>OUT</div>
                </div>
<?php endif; ?>
            </a>
        </div>
    </div>
</div>
<!-- END OF DEAL -->
<?php $dh++; ?>
<?php endforeach; ?>
<?php endif; ?>
<?php endif; ?>
