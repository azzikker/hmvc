<script type="text/javascript">viewvideo2 = new viewvideo2();</script>
<?php $dh=0; ?>
<?php foreach($deals_view as $dv): ?>
<?php if(strtolower($dv->deal_view_type) == "single deal"): ?>
<!-- START OF BOX -->
<div id="deal-box">
    <div id="deal-box-header">
        <?php echo $dv->deal_view_title ?>!
        <a href="javascript:return false;" onclick="window.open('http://www.facebook.com','mywindow','menubar=1,resizable=1,width=500,height=500')"><div id="deal-box-header-sp"><span>>></span> Supported Foundation</div></a>
    </div>
    <div id="deal-box-info" class="fright">
        <div id="deal-box-info-statement"><?php echo $dv->deal_view_statement ?></div>
<?php if($dv->deal_option <> 0): ?>
<?php if($dv->deal_current_stock <> 0): ?>
        <div id="deal-box-info-btnsandd"<?php if($dv->video_embed == ""): ?> style="height: 145px;"<?php endif; ?>>
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
                <div id="now_tag">NOW!</div>
                <span>P <?php echo number_format($dv->deal_discounted_price) ?></span>
            </div>
            <div class="deal-box-info-btnanddd-vgs">
                <a href="deal/<?php echo $dv->deal_hash ?>/<?php  $utitle = preg_replace('/[^a-z0-9]/i','-',$dv->deal_view_title); echo $utitle; ?>" class="deal-box-info-btnanddd2-vgs-grp">
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
                <div>NOW!</div>
            </div>
            <div id="deal-box-info-btnanddd2-vgs">
                <a href="deal/<?php echo $dv->deal_hash ?>/<?php  $utitle = preg_replace('/[^a-z0-9]/i','-',$dv->deal_view_title); echo $utitle; ?>" class="deal-box-info-btnanddd2-vgs-grp">
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
<?php else: ?>
<?php $dcs=0; ?>
<?php $dos=0; ?>
<?php for($i=0;$i<$deal_option[$dh]["optl"];$i++): ?>
<?php $dos = $dos + $deal_option[$dh][$i]["dos"]; ?>
<?php $dcs = $dcs + $deal_option[$dh][$i]["dcs"]; ?>
<?php endfor; ?>
<?php if($dcs <> 0): ?>
        <div id="deal-box-info-btnsandd"<?php if($dv->video_embed == ""): ?> style="height: 145px;"<?php endif; ?>>
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
                <div id="now_tag">NOW!</div>
                <span>P <?php echo number_format($dv->deal_discounted_price) ?></span>
            </div>
            <div class="deal-box-info-btnanddd-vgs">
                <a href="deal/<?php echo $dv->deal_hash ?>/<?php  $utitle = preg_replace('/[^a-z0-9]/i','-',$dv->deal_view_title); echo $utitle; ?>" class="deal-box-info-btnanddd2-vgs-grp">
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
                    <span><?php echo number_format(($dos - $dcs)) ?></span>
                    <div>sold</div>
                </div>
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
                <div>NOW!</div>
            </div>
            <div id="deal-box-info-btnanddd2-vgs">
                <a href="deal/<?php echo $dv->deal_hash ?>/<?php  $utitle = preg_replace('/[^a-z0-9]/i','-',$dv->deal_view_title); echo $utitle; ?>" class="deal-box-info-btnanddd2-vgs-grp">
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
<?php endif; ?>
    </div>
    <div id="deal-box-img">
        <img class="deal-box-imgs" src="assets/general/images/deals_gallery/optimize/<?php echo $dv->deal_image ?>" alt="">
    </div>
</div>
<!-- END OF BOX -->
<?php else: ?>
<!-- START OF BOX -->
<div id="deal-box" class="vdss">
    <div id="deal-box-header">
        <?php echo $dv->deal_view_title ?>!
        <a href="javascript:return false;" onclick="window.open('http://www.facebook.com','mywindow','menubar=1,resizable=1,width=500,height=500')"><div class="fright" id="deal-box-header-sp"><span>>></span> Supported Foundation</div></a>
    </div>
    <div id="deal-box-info" class="fright">
        <div id="deal-box-info-statement"><?php echo $dv->deal_view_statement ?></div>
<?php if($stocks[$dh]['cstocks'] <> 0): ?>
        <div id="deal-box-info-btnsandd3"<?php if($dv->video_embed == ""): ?> style="height: 100px;"<?php endif; ?>>
            <div id="deal-box-info-btnanddd3-dp">
                Up to <?php echo $dpcnt[$dh]['prcnt'] ?>%<sup>off</sup>
            </div>
            <div class="deal-box-info-btnanddd3-vgs">
                <a href="deal/<?php echo $dv->deal_hash ?>" class="deal-box-info-btnanddd3-vgs-grp">
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
                <div link="<?php echo htmlspecialchars($dv->deal_video) ?>">Watch Video</div>
            </div>
<?php endif; ?>
        </div>
<?php else: ?>
        <div id="deal-box-info-btnsandd4"<?php if($dv->video_embed == ""): ?> style="height: 100px;"<?php endif; ?>>
            <div id="deal-box-info-btnanddd4-dp">
                Up to <?php echo $dpcnt[$dh]['prcnt'] ?>%<sup>off</sup>
            </div>
            <div class="deal-box-info-btnanddd4-vgs">
                <a href="deal/<?php echo $dv->deal_hash ?>" class="deal-box-info-btnanddd4-vgs-grp">
                    <div class="deal-box-info-btnanddd4-vg">
                        <span>SOLD OUT</span>
                    </div>
                </a>
            </div>
<?php if($dv->video_embed <> ""): ?>
            <div class="deal-box-info-btnanddd-wv">
                <div link="<?php echo htmlspecialchars($dv->deal_video) ?>">Watch Video</div>
            </div>
<?php endif; ?>
        </div>
<?php endif; ?>
    </div>
    <div id="deal-box-img">
        <img class="deal-box-imgs" src="assets/general/images/deals_gallery/optimize/<?php echo $dv->deal_image ?>" alt="">
    </div>
</div>
<!-- END OF BOX -->
<?php $dh++; ?>
<?php endif; ?>
<?php endforeach; ?>