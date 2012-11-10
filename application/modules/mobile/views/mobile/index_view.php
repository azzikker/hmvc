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
            <a href="mobile/category/<?php echo $dc->category_id ?>-<?php echo str_replace(" ","",$replacedc); ?>"><li id="category-icons-<?php echo $caticon; ?>"<?php $uri2 = $this->uri->segment(3); $strpos = stripos($uri2,"-"); $cat_id = substr($uri2,0, $strpos); if($cat_id == $dc->category_id): ?>class="category-icons-active"<?php endif; ?>><?php echo strtoupper($dc->category_name) ?></li></a>
<?php $caticon++; ?>
<?php endforeach; ?>
        </ul>
        </div>
    </div>
</div>
<div id="video"></div>
<?php $dh=0; ?>
<?php foreach($deals_view as $dv): ?>
<?php if (strtolower($dv->deal_view_type) == "single deal"): ?>
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
                    <span>P <span>&nbsp;<?php echo number_format($dv->deal_original_price) ?>&nbsp;</span></span> 
                </div>
                <div id="deal-info-top-left-right">
                    <span><?php echo $dv->deal_discount ?>%</span>
                    <div>off</div>
                </div>
            </div>
<?php if($dv->video_embed <> ""): ?>
            <div class="deal-info-top-right" link="<?php echo htmlspecialchars($dv->video_embed) ?>">
                WATCH VIDEO
            </div>
<?php endif; ?>
        </div>
        <div id="deal-info-bot">
            <div id="deal-info-bot-left">
                <span>P <?php echo number_format($dv->deal_discounted_price) ?></span>
            </div>
            <a href="mobile/deal/<?php echo $dv->deal_hash ?>">
<?php if (strtolower($dv->deal_view_type) == "single deal"): ?>
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
<?php else: ?>
<?php if($stocks[$dh]['cstocks'] <> 0): ?>
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
<?php $dh++; ?>
<?php endif; ?>
            </a>
        </div>
    </div>
</div>
<!-- END OF DEAL -->
<?php else: ?>
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
        <div id="deal-info-top"<?php if($dv->video_embed == ""): ?> style='display:none'<?php endif; ?>>
            <div id="deal-info-top-left" style="background: none;">
            </div>
<?php if($dv->video_embed <> ""): ?>
            <div class="deal-info-top-right" link="<?php echo htmlspecialchars($dv->video_embed) ?>">
                WATCH VIDEO
            </div>
<?php endif; ?>
        </div>
        <div id="deal-info-bot">
            <div id="deal-info-bot-left" class="group">
                <span>Up to <?php echo $dpcnt[$dh]['prcnt'] ?>%<sup>off</sup></span>
            </div>
            <a href="mobile/deal/<?php echo $dv->deal_hash ?>">
<?php if (strtolower($dv->deal_view_type) == "single deal"): ?>
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
<?php else: ?>
<?php if($stocks[$dh]['cstocks'] <> 0): ?>
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
<?php $dh++; ?>
<?php endif; ?>
            </a>
        </div>
    </div>
</div>
<!-- END OF DEAL -->
<?php endif; ?>
<?php endforeach; ?>