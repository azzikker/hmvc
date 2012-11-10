<div id="category">
    <ul>
<?php $dcatnum = $deals_category->num_rows(); ?>
<?php $dcatnum2 = 0; ?>
<?php foreach($deals_category->result() as $dc): ?>
<?php $dcatnum2++; ?>
<?php $replacedc = preg_replace('/[^a-z0-9]/i',' ',$dc->category_name);?>
        <a href="category/<?php echo $dc->category_id ?>-<?php echo str_replace(" ","",$replacedc); ?>">
            <li<?php $uri2 = $this->uri->segment(2); $strpos = stripos($uri2,"-"); $cat_id = substr($uri2,0, $strpos); if($cat_id == $dc->category_id): ?> id="active"<?php endif; ?>><?php echo xss_cleaner($dc->category_name); ?></li>
        </a>
<?php if($dcatnum <> $dcatnum2): ?>
        <b>&middot;</b>
<?php endif; ?>
<?php endforeach; ?>
    </ul>
</div>
<script type="text/javascript">viewvideo2 = new viewvideo2();</script>
<script type="text/javascript">scrolleffect = new scrolleffect();</script>
<?php $deals = 0; ?>
<?php $dh=0; ?>
<?php foreach($deals_view as $dv): ?>
<?php $deals++; ?>
<?php if(strtolower($dv->deal_view_type) == "single deal"): ?>
<!-- START OF BOX -->
<div id="deal-box">
    <div id="deal-box-header">
        <div id="dbh-con" title="<?php echo xss_cleaner($dv->deal_view_title); ?>!"><?php echo xss_cleaner($dv->deal_view_title); ?>!</div>
        <div id="deal-box-header-sp"><span>>></span> <a href="javascript:return false;" onclick="window.open('http://www.facebook.com','mywindow','menubar=1,resizable=1,width=500,height=500')">Supported Foundation</a></div>
    </div>
    <div id="deal-box-info" class="fright">
        <div id="deal-box-info-statement"><?php echo xss_cleaner($dv->deal_view_statement) ?></div>
<?php if($dv->deal_option <> 0): ?>
<?php if($dv->deal_current_stock <> 0): ?>
        <div id="deal-box-info-btnsandd"<?php if($dv->video_embed == ""): ?> style="height: 145px;"<?php endif; ?> class="btncontainer">
            <div id="deal-box-info-btnsandd-opd">
                <div id="deal-box-info-btnsandd-op">
                    <span>P <?php echo number_format($dv->deal_original_price) ?></span>
                    <div>Original Price</div>
                </div>
                <div id="deal-box-info-btnsandd-d">
                    <div id="deal-box-info-btnsandd-d-n"><?php echo xss_cleaner(($dv->deal_discount < 100) ? $dv->deal_discount:"100") ?>%</div>
                    <div id="deal-box-info-btnsandd-d-off">off</div>
                </div>
            </div>
            <div id="deal-box-info-btnanddd-dp">
<?php if($dv->deal_discounted_price <> 0): ?>
                <span>P <?php echo number_format($dv->deal_discounted_price) ?></span>
<?php else: ?>
                <span>FREE</span>
<?php endif;?>
            </div>
            <div class="deal-box-info-btnanddd-vgs">
                <a href="deal/<?php echo xss_cleaner($dv->deal_hash) ?>/<?php  $utitle = preg_replace('/[^a-z0-9]/i','-',xss_cleaner($dv->deal_view_title)); echo $utitle; ?>" class="deal-box-info-btnanddd2-vgs-grp">
                    <div id="deal-box-info-btnanddd-vg">
                        <span>VIG IT</span>
                        <div>NOW!</div>
                        <div id="deal-box-info-btnanddd-vg-box">
                            <div id="deal-box-info-btnanddd-vg-box-vgin">
                                <span>VI<span id='deal-box-info-btnanddd-vg-box-vgin-span'>gorously</span> G<span id='deal-box-info-btnanddd-vg-box-vgin-span'>rab</span> IT</span><div>NOW!</div>
                            </div>
                        </div>
                    </div>
                </a>
                <div id="deal-box-info-btnanddd-s">
                    <span><?php echo number_format(($dv->deal_original_stock - $dv->deal_current_stock)) ?></span>
                    <div>sold</div>
                </div>
            </div>
<?php if($dv->video_embed <> ""): ?>
            <div class="deal-box-info-btnanddd-wv">
                <div link="<?php echo xss_cleaner($dv->video_embed) ?>">Watch Video</div>
            </div>
<?php endif; ?>
        </div>
<?php else: ?>
        <div id="deal-box-info-btnsandd2"<?php if($dv->video_embed == ""): ?> style="height: 145px;"<?php endif; ?> class="btncontainer">
            <div id="deal-box-info-btnsandd2-opd">
                <div id="deal-box-info-btnsandd2-op">
                    <span>P <?php echo number_format(xss_cleaner($dv->deal_original_price)) ?></span>
                    <div>Original Price</div>
                </div>
                <div id="deal-box-info-btnsandd2-d">
                    <div id="deal-box-info-btnsandd2-d-n"><?php echo xss_cleaner(($dv->deal_discount < 100) ? $dv->deal_discount:"100") ?>%</div>
                    <div id="deal-box-info-btnsandd2-d-off">off</div>
                </div>
            </div>
            <div id="deal-box-info-btnanddd2-dp">
<?php if($dv->deal_discounted_price <> 0): ?>
                <span>P <?php echo number_format(xss_cleaner($dv->deal_discounted_price)) ?></span>
<?php else: ?>
                <span>FREE</span>
<?php endif; ?>
            </div>
            <div id="deal-box-info-btnanddd2-vgs">
                <a href="deal/<?php echo xss_cleaner($dv->deal_hash) ?>/<?php  $utitle = preg_replace('/[^a-z0-9]/i','-',xss_cleaner($dv->deal_view_title)); echo $utitle; ?>" class="deal-box-info-btnanddd2-vgs-grp">
                    <div class="deal-box-info-btnanddd2-vg">
                        <span>SOLD OUT</span>
                    </div>
                </a>
            </div>
<?php if($dv->video_embed <> ""): ?>
            <div class="deal-box-info-btnanddd-wv">
                <div link="<?php echo xss_cleaner($dv->video_embed) ?>">Watch Video</div>
            </div>
<?php endif; ?>
        </div>
<?php endif; ?>
<?php else: ?>
<?php $dcs=0; ?>
<?php $dos=0; ?>
<?php for($i=0;$i<$deal_option[$dh]["optl"];$i++): ?>
<?php $dos = $dos + $deal_option[$dh][$i]["dos"]; ?>
<?php $dcs = $dcs + $deal_option[$dh][$i]["dcs"]; ?>
<?php endfor; ?>
<?php if($dcs <> 0): ?>
        <div id="deal-box-info-btnsandd"<?php if($dv->video_embed == ""): ?> style="height: 145px;"<?php endif; ?> class="btncontainer">
            <div id="deal-box-info-btnsandd-opd">
                <div id="deal-box-info-btnsandd-op">
                    <span>P <?php echo number_format(xss_cleaner($dv->deal_original_price)) ?></span>
                    <div>Original Price</div>
                </div>
                <div id="deal-box-info-btnsandd-d">
                    <div id="deal-box-info-btnsandd-d-n"><?php echo xss_cleaner(($dv->deal_discount < 100) ? $dv->deal_discount:"100") ?>%</div>
                    <div id="deal-box-info-btnsandd-d-off">off</div>
                </div>
            </div>
            <div id="deal-box-info-btnanddd-dp">
<?php if($dv->deal_discounted_price <> 0): ?>
                <span>P <?php echo number_format(xss_cleaner($dv->deal_discounted_price)) ?></span>
<?php else: ?>
                <span>FREE</span>
<?php endif; ?>
            </div>
            <div class="deal-box-info-btnanddd-vgs">
                <a href="deal/<?php echo xss_cleaner($dv->deal_hash) ?>/<?php  $utitle = preg_replace('/[^a-z0-9]/i','-',xss_cleaner($dv->deal_view_title)); echo $utitle; ?>" class="deal-box-info-btnanddd2-vgs-grp">
                    <div id="deal-box-info-btnanddd-vg">
                        <span>VIG IT</span>
                        <div>NOW!</div>
                        <div id="deal-box-info-btnanddd-vg-box">
                            <div id="deal-box-info-btnanddd-vg-box-vgin">
                                <span>VI<span id='deal-box-info-btnanddd-vg-box-vgin-span'>gorously</span> G<span id='deal-box-info-btnanddd-vg-box-vgin-span'>rab</span> IT</span><div>NOW!</div>
                            </div>
                        </div>
                    </div>
                </a>
                <div id="deal-box-info-btnanddd-s">
                    <span><?php echo number_format(xss_cleaner(($dos - $dcs))) ?></span>
                    <div>sold</div>
                </div>
            </div>
<?php if($dv->video_embed <> ""): ?>
            <div class="deal-box-info-btnanddd-wv">
                <div link="<?php echo xss_cleaner($dv->video_embed) ?>">Watch Video</div>
            </div>
<?php endif; ?>
        </div>
<?php else: ?>
        <div id="deal-box-info-btnsandd2"<?php if($dv->video_embed == ""): ?> style="height: 145px;"<?php endif; ?> class="btncontainer">
            <div id="deal-box-info-btnsandd2-opd">
                <div id="deal-box-info-btnsandd2-op">
                    <span>P <?php echo number_format(xss_cleaner($dv->deal_original_price)) ?></span>
                    <div>Original Price</div>
                </div>
                <div id="deal-box-info-btnsandd2-d">
                    <div id="deal-box-info-btnsandd2-d-n"><?php echo xss_cleaner(($dv->deal_discount < 100) ? $dv->deal_discount:"100") ?>%</div>
                    <div id="deal-box-info-btnsandd2-d-off">off</div>
                </div>
            </div>
            <div id="deal-box-info-btnanddd2-dp">
<?php if($dv->deal_discounted_price <> 0): ?>
                <span>P <?php echo number_format(xss_cleaner($dv->deal_discounted_price)) ?></span>
<?php else: ?>
                <span>FREE</span>
<?php endif; ?>
            </div>
            <div id="deal-box-info-btnanddd2-vgs">
                <a href="deal/<?php echo xss_cleaner($dv->deal_hash) ?>/<?php  $utitle = preg_replace('/[^a-z0-9]/i','-',xss_cleaner($dv->deal_view_title)); echo $utitle; ?>" class="deal-box-info-btnanddd2-vgs-grp">
                    <div class="deal-box-info-btnanddd2-vg">
                        <span>SOLD OUT</span>
                    </div>
                </a>
            </div>
<?php if($dv->video_embed <> ""): ?>
            <div class="deal-box-info-btnanddd-wv">
                <div link="<?php echo xss_cleaner($dv->video_embed) ?>">Watch Video</div>
            </div>
<?php endif; ?>
        </div>
<?php endif; ?>
<?php endif; ?>
    </div>
    <div id="deal-box-img">
<?php if($dv->deal_view_start+345600 > time()): ?>
        <div class="newdeal"></div>
<?php endif; ?>
        <img class="deal-box-imgs notload" src="assets/vigattin_deals/images/blank.gif" alt="" original="assets/general/images/deals_gallery/optimize/<?php echo xss_cleaner($dv->deal_image) ?>">
    </div>
</div>
<!-- END OF BOX -->
<?php else: ?>
<!-- START OF BOX -->
<div id="deal-box" class="vdss">
    <div id="deal-box-header">
        <div id="dbh-con" title="<?php echo xss_cleaner($dv->deal_view_title) ?>!"><?php echo xss_cleaner($dv->deal_view_title) ?>!</div>
        <div class="fright" id="deal-box-header-sp"><span>>></span> <a href="javascript:return false;" onclick="window.open('http://www.facebook.com','mywindow','menubar=1,resizable=1,width=500,height=500')">Supported Foundation</a></div>
    </div>
    <div id="deal-box-info" class="fright">
        <div id="deal-box-info-statement"><?php echo xss_cleaner($dv->deal_view_statement) ?></div>
<?php if($stocks[$dh]['cstocks'] <> 0): ?>
        <div id="deal-box-info-btnsandd3"<?php if($dv->video_embed == ""): ?> style="height: 100px;"<?php endif; ?> class="btncontainer">
            <div id="deal-box-info-btnanddd3-dp">
                Up to <?php echo $dpcnt[$dh]['prcnt'] ?>%<sup>off</sup>
            </div>
            <div class="deal-box-info-btnanddd3-vgs">
                <a href="deal/<?php echo xss_cleaner($dv->deal_hash) ?>" class="deal-box-info-btnanddd3-vgs-grp">
                    <div id="deal-box-info-btnanddd3-vg-box-vgin">
                        <span>VI<span id="deal-box-info-btnanddd-vg-box-vgin-span">gorously</span> G<span id="deal-box-info-btnanddd-vg-box-vgin-span">rab</span> IT</span><div>NOW!</div>
                    </div>
                    <div class="deal-box-info-btnanddd3-vg">
                        <span>VIG IT</span>
                        <div>NOW!</div>
                    </div>
                </a>
            </div>
<?php if($dv->video_embed <> ""): ?>
            <div class="deal-box-info-btnanddd-wv">
                <div link="<?php echo xss_cleaner($dv->video_embed) ?>">Watch Video</div>
            </div>
<?php endif; ?>
        </div>
<?php else: ?>
        <div id="deal-box-info-btnsandd4"<?php if($dv->video_embed == ""): ?> style="height: 100px;"<?php endif; ?> class="btncontainer">
            <div id="deal-box-info-btnanddd4-dp">
                Up to <?php echo $dpcnt[$dh]['prcnt'] ?>%<sup>off</sup>
            </div>
            <div class="deal-box-info-btnanddd4-vgs">
                <a href="deal/<?php echo xss_cleaner($dv->deal_hash) ?>" class="deal-box-info-btnanddd4-vgs-grp">
                    <div class="deal-box-info-btnanddd4-vg">
                        <span>SOLD OUT</span>
                    </div>
                </a>
            </div>
<?php if($dv->video_embed <> ""): ?>
            <div class="deal-box-info-btnanddd-wv">
                <div link="<?php echo xss_cleaner($dv->deal_video) ?>">Watch Video</div>
            </div>
<?php endif; ?>
        </div>
<?php endif; ?>
    </div>
    <div id="deal-box-img">
<?php if($dv->deal_view_start+345600 > time()): ?>
        <div class="newdeal"></div>
<?php endif; ?>
        <img class="deal-box-imgs notload" src="assets/vigattin_deals/images/blank.gif" alt="" original="assets/general/images/deals_gallery/optimize/<?php echo xss_cleaner($dv->deal_image) ?>">
    </div>
</div>
<!-- END OF BOX -->
<?php $dh++; ?>
<?php endif; ?>
<?php endforeach; ?>
<?php if($deals == 0): ?>
<div id='message'>
    <div id='message-b'>
        No deals found.
    </div>
</div>
<?php endif; ?>
