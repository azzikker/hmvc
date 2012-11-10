<script type="text/javascript" src="assets/vigattin_deals/js/timer.js"></script>
<!-- FB START -->
<!--<script type="text/javascript" src="assets/vigattin_deals/js/fb.js"></script>  -->
<div id="fb-root"></div>
<!-- FB END -->
<?php if(isset($deals_view)): ?>
<?php foreach($deals_view as $dv): ?>
<script>var googlemap = new googlemap()</script>
<script>var slideshow = new slideshow()</script>
<script>var viewvideo2 = new viewvideo2()</script>
<script type="text/javascript" src="assets/vigattin_deals/js/iv.js"></script>
<!-- START OF TEST -->
<style>
#deal-boxn
{
    width: 955px;
    height: 284px;
    margin: auto;
    background-color: #222;
    margin-bottom: 10px;
    margin-top: 10px;
}
#deal-boxn-h
{
    height: 40px;
    background: url('assets/vigattin_deals/images/header.png') #F69E2C;
    font-family: century gothic,tahoma,verdana,arial,helvetica,sans-serif;
    font-weight: bold;
    font-size: 18px;
    text-indent: 5px;
    line-height: 35px;
}
#deal-boxn-img
{
    width: 550px;
    height: 242px;
    position: relative;
}
#deal-boxn-img img
{
    width: 550px;
    height: 242px;
    position: absolute;
}
#deal-boxn-infos
{
    width: 384px;
    height: 221px;
    padding: 10px;
    background: url('assets/vigattin_deals/images/images5.png') no-repeat 4px -116px;
    border-bottom: 1px solid #424242;
    border-right: 1px solid #424242;
}
#dbxni-1
{
    height: 106px;
    margin-bottom: 11px;
    color: white;
    padding: 5px;
    font: 13px/18px trebuchet ms;
    font-weight: bold;
    word-wrap:break-word;
}
#dbxni-2
{
    height: 46px;
    margin-bottom: 3px;
    text-align: center;
    overflow: hidden;
}
#dbxni-2-1,#dbxni-3-1
{
    width: 182px;
    float: left;
    height: 46px;
    margin-right: 3px;
}
#dbxni-2-2,#dbxni-3-2 
{
    width: 98px;
    float: left;
    height: 46px;
    margin-right: 3px;
}
#dbxni-2-3,#dbxni-3-3
{
    width: 98px;
    float: left;
    height: 46px;
}
#dbxni-3
{
    height: 46px;
    text-align: center;
}
#dbxni-2-1
{
    font: 25pt verdana;
    font-weight: bold;
}
#dbxni-2-1 div
{
    overflow: auto;
    text-align: center;
    margin-top: 3px;
    color: #fff;
}
#dbxni-2-2
{
    color: #fff;
    font: 11pt verdana;
    font-weight: bold;
    margin-top: 13px;
}
#dbxni-2-3
{
    color: #fff;
    font: 16pt verdana;
    font-weight: bold;
    margin-top: 9px;
}
#dbxni-3-1
{
    color: #A82B00;
    font-size: 16pt;
    font-weight: bold;
    position: relative;
    overflow: hidden;
    cursor: pointer;
}
#dbxni-3-2
{
    font: 10pt verdana;
    font-weight: bold;
    margin-top: 14px;
    cursor: pointer;
}
#dbxni-3-2:hover
{
    text-decoration: underline;
}
#dbxni-3-3
{
    font: 10pt verdana;
    font-weight: bold;
    margin-top: 5px;
}
#dbxni-3-1-1
{
    position: absolute;
    width: 182px;
    height: 46px;
    left: -182px;
    top:0px;
    font-size: 18px;
    overflow: hidden;
    background: url('assets/vigattin_deals/images/vighover.png');
}
#dbxni-3-1-1 span
{
    color: white;
}
</style>
<script>
(function()
{
    function dr()
    {
        $("#dbxni-3-1").mouseenter(function(e)
        {
            $(e.target).find("#dbxni-3-1-1").stop(true,true)
            .animate({
                "left":"0px"
            })
        })
        $("#dbxni-3-1").mouseleave(function(e)
        {
            $("#dbxni-3-1-1").stop(true,true)
            .animate({
                "left":"-182px"
            })
        })
    }
    function init()
    {
        $(document).ready(function()
        {dr();})
    }
    init();
})();
</script>
<div id='deal-boxn'>
    <div id='deal-boxn-h'><?php echo $dv->deal_view_title ?></div>
    <div id='deal-boxn-img' class="fleft">
<?php foreach($galleries as $gallery): ?>
        <img src="assets/general/images/deals_gallery/optimize/<?php echo xss_cleaner($gallery->gallery_filename) ?>" alt="">
<?php endforeach; ?>
    </div>
    <div id='deal-boxn-infos' class="fright">
        <div id='dbxni-1'><?php echo xss_cleaner($dv->deal_view_statement) ?></div>
        <div id='dbxni-2'>
            <div id='dbxni-2-1'><div><span style="font-size: 22px;vertical-align: top;color: #fff;">P</span><?php echo number_format(xss_cleaner($dv->deal_discounted_price)) ?></div></div>
            <div id='dbxni-2-2'><div style="text-decoration: line-through;">&nbsp;P <span style="color: white;"><?php echo number_format(xss_cleaner($dv->deal_original_price)) ?></span>&nbsp;</div></div>
            <div id='dbxni-2-3'><span style="color: white"><?php echo xss_cleaner($dv->deal_discount) ?>%</span><span style="vertical-align: top;font-size: 11pt;">Off</span></div>
        </div>
        <div id='dbxni-3'>
            <a href='buy/<?php echo xss_cleaner($dv->deal_hash) ?>'>
            <div id='dbxni-3-1'>
                VIG IT<div style="color: white;font-size: 11pt;">NOW!</div>
                <div id='dbxni-3-1-1'>VI<span>gorously</span> G<span>rab</span> IT<div><span style="font-size: 15px;">NOW!</span></div></div>
            </div>
            </a>
            <div id='dbxni-3-2'>Watch Video</div>
            <div id='dbxni-3-3'><?php echo xss_cleaner($dv->deal_original_stock-$dv->deal_current_stock) ?><div>SOLD</div></div>
        </div>
    </div>
</div>
<!-- START OF TEST -->
<!-- START OF BOX
<div id="deal-box">
    <div id="deal-box-header">
        <div id="dbh-con"><?php echo xss_cleaner($dv->deal_view_title) ?>!</div>
        <div class="fright" id="deal-box-header-sp"><span>>></span> <a href="vigdeals">Supported Foundation</a></div>
    </div>
    <div id="deal-box-info" class="fright">
        <div id="deal-box-info-statement"><?php echo xss_cleaner($dv->deal_view_statement) ?></div>
<?php if($dv->deal_option == 1): ?>
<?php if($dv->deal_current_stock <> 0): ?>
        <div id="deal-box-info-btnsandd" class="deal-box-info-btnsandd2 btncontainer"<?php if($dv->video_embed == ""): ?> style="height: 145px;"<?php endif; ?>>
            <div id="deal-box-info-btnsandd-opd">
                <div id="deal-box-info-btnsandd-op">
                    <span>P <?php echo number_format(xss_cleaner($dv->deal_original_price)) ?></span>
                    <div>Original Price</div>
                </div>
                <div id="deal-box-info-btnsandd-d">
                    <div id="deal-box-info-btnsandd-d-n"><?php echo xss_cleaner($dv->deal_discount) ?>%</div>
                    <div id="deal-box-info-btnsandd-d-off">off</div>
                </div>
            </div>
            <div id="deal-box-info-btnanddd-dp">
                <span>P <?php echo number_format(xss_cleaner($dv->deal_discounted_price)) ?></span>
            </div>
            <div class="push"></div>
            <div class="deal-box-info-btnanddd-vgs">
                <a href="javascript:return false;" class="deal-box-info-btnanddd2-vgs-grp" buylink="buy/<?php echo xss_cleaner($dv->deal_hash) ?>">
                    <div id="deal-box-info-btnanddd-vg">
                        <span>VIG IT</span>
                        <div>NOW!</div>
                        <div id="deal-box-info-btnanddd-vg-box">
                            <div id="deal-box-info-btnanddd-vg-box-vgin">
                                <span>VI<span id="deal-box-info-btnanddd-vg-box-vgin-span">gorously</span> G<span id="deal-box-info-btnanddd-vg-box-vgin-span">rab</span> IT</span><div>NOW!</div>
                            </div>
                        </div>
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
        <div id="deal-box-info-btnsandd2"<?php if($dv->video_embed == ""): ?> style="height: 145px;"<?php endif; ?>>
            <div id="deal-box-info-btnsandd2-opd">
                <div id="deal-box-info-btnsandd2-op">
                    <span>P <?php echo number_format(xss_cleaner($dv->deal_original_price)) ?></span>
                    <div>Original Price</div>
                </div>
                <div id="deal-box-info-btnsandd2-d">
                    <div id="deal-box-info-btnsandd2-d-n"><?php echo xss_cleaner($dv->deal_discount) ?>%</div>
                    <div id="deal-box-info-btnsandd2-d-off">off</div>
                </div>
            </div>
            <div id="deal-box-info-btnanddd2-dp">
                <span>P <?php echo number_format(xss_cleaner($dv->deal_discounted_price)) ?></span>
            </div>
            <div id="deal-box-info-btnanddd2-vgs">
                <div class="deal-box-info-btnanddd2-vg">
                    <span>SOLD OUT</span>
                </div>
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
<?php for($i=0;$i<$deal_option[0]["optl"];$i++): ?>
<?php $dos = $dos + $deal_option[0][$i]["dos"]; ?>
<?php $dcs = $dcs + $deal_option[0][$i]["dcs"]; ?>
<?php endfor; ?>
<?php if($dcs <> 0): ?>
        <div id="deal-box-info-btnsandd" class="deal-box-info-btnsandd2 btncontainer"<?php if($dv->video_embed == ""): ?> style="height: 145px;"<?php endif; ?>>
            <div id="deal-box-info-btnsandd-opd">
                <div id="deal-box-info-btnsandd-op">
                    <span>P <?php echo number_format(xss_cleaner($dv->deal_original_price)) ?></span>
                    <div>Original Price</div>
                </div>
                <div id="deal-box-info-btnsandd-d">
                    <div id="deal-box-info-btnsandd-d-n"><?php echo xss_cleaner($dv->deal_discount) ?>%</div>
                    <div id="deal-box-info-btnsandd-d-off">off</div>
                </div>
            </div>
            <div id="deal-box-info-btnanddd-dp">
                <span>P <?php echo number_format(xss_cleaner($dv->deal_discounted_price)) ?></span>
            </div>
            <div class="push"></div>
            <div class="deal-box-info-btnanddd-vgs">
                <a href="javascript:return false;" class="deal-box-info-btnanddd2-vgs-grp" buylink="buy/<?php echo xss_cleaner($dv->deal_hash) ?>">
                    <div id="deal-box-info-btnanddd-vg">
                        <span>VIG IT</span>
                        <div>NOW!</div>
                        <div id="deal-box-info-btnanddd-vg-box">
                            <div id="deal-box-info-btnanddd-vg-box-vgin">
                                <span>VI<span id="deal-box-info-btnanddd-vg-box-vgin-span">gorously</span> G<span id="deal-box-info-btnanddd-vg-box-vgin-span">rab</span> IT</span><div>NOW!</div>
                            </div>
                        </div>
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
        <div id="deal-box-info-btnsandd2"<?php if($dv->video_embed == ""): ?> style="height: 145px;"<?php endif; ?>>
            <div id="deal-box-info-btnsandd2-opd">
                <div id="deal-box-info-btnsandd2-op">
                    <span>P <?php echo number_format(xss_cleaner($dv->deal_original_price)) ?></span>
                    <div>Original Price</div>
                </div>
                <div id="deal-box-info-btnsandd2-d">
                    <div id="deal-box-info-btnsandd2-d-n"><?php echo xss_cleaner($dv->deal_discount) ?>%</div>
                    <div id="deal-box-info-btnsandd2-d-off">off</div>
                </div>
            </div>
            <div id="deal-box-info-btnanddd2-dp">
                <span>P <?php echo number_format(xss_cleaner($dv->deal_discounted_price)) ?></span>
            </div>
            <div id="deal-box-info-btnanddd2-vgs">
                <div class="deal-box-info-btnanddd2-vg">
                    <span>SOLD OUT</span>
                </div>
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
<?php $img=1; ?>
        <div>
<?php foreach($galleries as $gallery): ?>
            <img class="deal-box-imgs" src2="<?php echo xss_cleaner($gallery->gallery_filename) ?>" src="assets/general/images/deals_gallery/optimize/<?php echo xss_cleaner($gallery->gallery_filename) ?>" alt="" id="<?php echo $img++; ?>">
<?php endforeach; ?>
        </div>
    </div>
</div>
END OF BOX -->
<!-- START OF ETC -->
<div id="etcbtn">
<?php $date=$this->cllibrary->timeleft(($dv->deal_view_end)-time());?>
    <div id="etcbtn-timer" class="etcbtn-timer">
        <div id="etcbtn-timer-t">DEAL ENDS IN:&nbsp;&nbsp;&nbsp;<span id="d"><?php echo ($date[0] < 10) ? "0".$date[0]:"".$date[0]; ?><span>d</span></span>&nbsp;&nbsp;&nbsp;<span id="h"><?php echo ($date[1] < 10) ? "0".$date[1]:"".$date[1]; ?><span>h</span></span>&nbsp;&nbsp;&nbsp;<span id="m"><?php echo ($date[2] < 10) ? "0".$date[2]:"".$date[2]; ?><span>m</span></span>&nbsp;&nbsp;&nbsp;<span id="s"><?php echo ($date[3] < 10) ? "0".$date[3]:"".$date[3]; ?><span>s</span></span> </div>
    </div>
    <a href="recommend">
        <div id="etcbtn-rec" class="fleft"></div>
    </a>
    <a href="javascript: return false;" onclick="window.open('http://www.javascript-coder.com','mywindow','menubar=1,resizable=1,width=500,height=500')">
        <div id="etcbtn-cw" class="fleft"></div>
    </a>
<?php $fimg=0; ?>
<?php foreach($galleries as $gallery): ?>
<?php if($fimg == 0): ?>
<?php $fimgis = base_url()."assets/general/images/deals_gallery/optimize/".xss_cleaner($gallery->gallery_filename).""; ?>
<?php endif; ?>
<?php $fimg++; ?>
<?php endforeach; ?>
    <a href="http://www.vigattin.net/index.php/games?image=<?php echo $fimgis; ?>&username=&userid=&back=<?php echo base_url("deal/".$this->uri->segment(2).""); ?>">
        <div id="etcbtn-play"></div>
    </a>
    <div id="etcbtn-fb">
        <div id="etcbtn-fb-share">
            <script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script>
                <span style="border:1px solid #CAD4E7; display:block; padding:1px; background:#eceef5; height: 17px; margin-right: 5px;-webkit-border-radius: 3px;-moz-border-radius: 3px;border-radius: 3px;">
                    <fb:share-button href="<?php echo base_url() ?>deal/<?php echo xss_cleaner($dv->deal_hash) ?>?og_title=<?php echo urlencode(xss_cleaner($dv->deal_view_title)); ?>&og_description=<?php echo urlencode(xss_cleaner($dv->deal_view_statement)); ?>&og_image=<?php echo urlencode(base_url().'assets/general/images/deals_gallery/optimize/'.xss_cleaner($gallery->gallery_filename)); ?>" class="meta">
                    </fb:share-button> 
                </span>
        </div>
        <div id="etcbtn-fb-like">
            <iframe src="http://www.facebook.com/plugins/like.php?href=<?php echo base_url()."deal/".$this->uri->segment(2) ?>&layout=button_count&show_faces=false&width=100&action=like&amp;font&colorscheme=light&height=20" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:100px; height:20px;" allowTransparency="true"></iframe>
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
                <li><?php echo xss_cleaner($hl->highlight_content) ?></li>
<?php endforeach; ?>
            </ul>
        </div>
    </div>
    <div id="deal-info-hr"></div>
    <div id="deal-info-abt">
        <div id="deal-info-h">ABOUT</div>
        <div id="deal-info-c">
            <?php echo nl2br(xss_cleaner($dv->deal_content)) ?>
        </div>
    </div>
    <div id="deal-info-hr"></div>
    <div id="deal-info-dt">
        <div id="deal-info-h">DEAL'S TERMS</div>
        <div id="deal-info-c">
            <ul>
<?php foreach($fineprint as $fp): ?>
                <li><?php echo xss_cleaner($fp->fineprint_content) ?></li>
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
                <iframe class="google_iframe" width="300" height="300" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="<?php echo xss_cleaner($ad_limit->location_link); ?>&z=15&output=embed"></iframe>
<?php endif ?>
<?php endforeach ?>
            </div>
            <div class="fleft">
                <ul style="margin-left: 10px; text-decoration: underline; cursor: pointer; width: 360px;">
<?php foreach($location as $ad) : ?>
<?php if($ad->location_address == "") : ?>

<?php else : ?>
                    <li link="<?php echo xss_cleaner($ad->location_link); ?>"><?php echo xss_cleaner($ad->location_address); ?></li>
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
    <div id="ads-h">You may also grab this</div>
    <div id="ads-b-b-b">
        <div id="ads-b-b" class="ads-b-b-h">
<?php foreach($random_deals as $rd): ?>
            <a href="deal/<?php echo xss_cleaner($rd->deal_hash) ?>">
                <div class="ads-b">
                    <div id="ads-b-h" title="<?php echo xss_cleaner($rd->deal_view_title) ?>"><?php echo xss_cleaner($rd->deal_view_title) ?></div>
                    <img src="assets/general/images/deals_gallery/customize/<?php echo xss_cleaner($rd->deal_image) ?>" alt="" width="242px" height="98px">
                </div>
            </a>
<?php endforeach; ?>
        </div>
    </div>
</div>
<!-- END OF ADS -->
<?php endforeach; ?>
<?php else: ?>
<?php $subdeal=0; ?>
<?php if($this->uri->segment(3) == ""): ?>
<div id="deal-box">
<?php foreach($banner as $img):?>
<img class="deal-box-banner" src="assets/general/images/deals_gallery/optimize/<?php echo xss_cleaner($img->deal_image) ?>" alt="">
<?php endforeach; ?>
</div>
<script>var viewvideo2 = new viewvideo2()</script>
<?php foreach($deals as $dv): ?>
<!-- START OF BOX -->
<div id="deal-box">
    <div id="deal-box-header">
        <div id="dbh-con"><?php echo xss_cleaner($dv->deal_title) ?>!</div>
        <div class="fright" id="deal-box-header-sp"><span>>></span> <a href="javascript:return false;" onclick="window.open('http://www.facebook.com','mywindow','menubar=1,resizable=1,width=500,height=500')">Supported Foundation</a></div>
    </div>
    <div id="deal-box-info" class="fright">
        <div id="deal-box-info-statement"><?php echo xss_cleaner($dv->deal_statement) ?></div>
<?php if($dv->deal_option <> 0): ?>
<?php if($dv->deal_current_stock <> 0): ?>
        <div id="deal-box-info-btnsandd"<?php if($dv->video_embed == ""): ?> style="height:145px"<?php endif; ?> class="btncontainer">
            <div id="deal-box-info-btnsandd-opd">
                <div id="deal-box-info-btnsandd-op">
                    <span>P <?php echo number_format(xss_cleaner($dv->deal_original_price)) ?></span>
                    <div>Original Price</div>
                </div>
                <div id="deal-box-info-btnsandd-d">
                    <div id="deal-box-info-btnsandd-d-n"><?php echo xss_cleaner($dv->deal_discount) ?>%</div>
                    <div id="deal-box-info-btnsandd-d-off">off</div>
                </div>
            </div>
            <div id="deal-box-info-btnanddd-dp">
                <span>P <?php echo number_format(xss_cleaner($dv->deal_discounted_price)) ?></span>
            </div>
            <div class="deal-box-info-btnanddd-vgs">
                <a href="deal/<?php echo xss_cleaner($dv->deal_hash) ?>/<?php echo $subdeal ?>/<?php  $utitle = preg_replace('/[^a-z0-9]/i','-',xss_cleaner($dv->deal_title)); echo $utitle; ?>">
                    <div id="deal-box-info-btnanddd-vg">
                        <span>VIG IT</span>
                        <div>NOW!</div>
                        <div id="deal-box-info-btnanddd-vg-box">
                            <div id="deal-box-info-btnanddd-vg-box-vgin">
                                <span>VI<span id='deal-box-info-btnanddd-vg-box-vgin-span'>gourously</span> G<span id='deal-box-info-btnanddd-vg-box-vgin-span'>rab</span> IT</span><div>NOW!</div>
                            </div>
                        </div>
                    </div>
                </a>
                <div id="deal-box-info-btnanddd-s">
                    <span><?php echo (xss_cleaner($dv->deal_original_stock - $dv->deal_current_stock)) ?></span>
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
        <div id="deal-box-info-btnsandd2"<?php if($dv->video_embed == ""): ?> style="height: 145px;"<?php endif; ?>>
            <div id="deal-box-info-btnsandd2-opd">
                <div id="deal-box-info-btnsandd2-op">
                    <span>P <?php echo number_format(xss_cleaner($dv->deal_original_price)) ?></span>
                    <div>Original Price</div>
                </div>
                <div id="deal-box-info-btnsandd2-d">
                    <div id="deal-box-info-btnsandd2-d-n"><?php echo xss_cleaner($dv->deal_discount) ?>%</div>
                    <div id="deal-box-info-btnsandd2-d-off">off</div>
                </div>
            </div>
            <div id="deal-box-info-btnanddd2-dp">
                <span>P <?php echo number_format(xss_cleaner($dv->deal_discounted_price)) ?></span>
            </div>
            <div id="deal-box-info-btnanddd2-vgs">
                <a href="deal/<?php echo xss_cleaner($dv->deal_hash) ?>/<?php echo $subdeal ?>/<?php  $utitle = preg_replace('/[^a-z0-9]/i','-',xss_cleaner($dv->deal_title)); echo $utitle; ?>">
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
<?php for($i=0;$i<$deal_option[$subdeal]["optl"];$i++): ?>
<?php $dos = $dos + $deal_option[$subdeal][$i]["dos"]; ?>
<?php $dcs = $dcs + $deal_option[$subdeal][$i]["dcs"]; ?>
<?php endfor; ?>
<?php if($dcs <> 0): ?>
        <div id="deal-box-info-btnsandd"<?php if($dv->video_embed == ""): ?> style="height:145px"<?php endif; ?> class="btncontainer">
            <div id="deal-box-info-btnsandd-opd">
                <div id="deal-box-info-btnsandd-op">
                    <span>P <?php echo number_format(xss_cleaner($dv->deal_original_price)) ?></span>
                    <div>Original Price</div>
                </div>
                <div id="deal-box-info-btnsandd-d">
                    <div id="deal-box-info-btnsandd-d-n"><?php echo xss_cleaner($dv->deal_discount) ?>%</div>
                    <div id="deal-box-info-btnsandd-d-off">off</div>
                </div>
            </div>
            <div id="deal-box-info-btnanddd-dp">
                <span>P <?php echo number_format(xss_cleaner($dv->deal_discounted_price)) ?></span>
            </div>
            <div class="deal-box-info-btnanddd-vgs">
                <a href="deal/<?php echo xss_cleaner($dv->deal_hash) ?>/<?php echo xss_cleaner($subdeal) ?>/<?php  $utitle = preg_replace('/[^a-z0-9]/i','-',xss_cleaner($dv->deal_title)); echo $utitle; ?>">
                    <div id="deal-box-info-btnanddd-vg">
                        <span>VIG IT</span>
                        <div>NOW!</div>
                        <div id="deal-box-info-btnanddd-vg-box">
                            <div id="deal-box-info-btnanddd-vg-box-vgin">
                                <span>VI<span id='deal-box-info-btnanddd-vg-box-vgin-span'>gourously</span> G<span id='deal-box-info-btnanddd-vg-box-vgin-span'>rab</span> IT</span><div>NOW!</div>
                            </div>
                        </div>
                    </div>
                </a>
                <div id="deal-box-info-btnanddd-s">
                    <span><?php echo ($dos - $dcs) ?></span>
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
        <div id="deal-box-info-btnsandd2"<?php if($dv->video_embed == ""): ?> style="height: 145px;"<?php endif; ?>>
            <div id="deal-box-info-btnsandd2-opd">
                <div id="deal-box-info-btnsandd2-op">
                    <span>P <?php echo number_format(xss_cleaner($dv->deal_original_price)) ?></span>
                    <div>Original Price</div>
                </div>
                <div id="deal-box-info-btnsandd2-d">
                    <div id="deal-box-info-btnsandd2-d-n"><?php echo xss_cleaner($dv->deal_discount) ?>%</div>
                    <div id="deal-box-info-btnsandd2-d-off">off</div>
                </div>
            </div>
            <div id="deal-box-info-btnanddd2-dp">
                <span>P <?php echo number_format(xss_cleaner($dv->deal_discounted_price)) ?></span>
            </div>
            <div id="deal-box-info-btnanddd2-vgs">
                <a href="deal/<?php echo xss_cleaner($dv->deal_hash) ?>/<?php echo $subdeal ?>/<?php  $utitle = preg_replace('/[^a-z0-9]/i','-',xss_cleaner($dv->deal_title)); echo $utitle; ?>">
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
        <img class="deal-box-imgs" src2="<?php echo xss_cleaner($dv->gallery_filename) ?>" src="assets/general/images/deals_gallery/optimize/<?php echo xss_cleaner($dv->gallery_filename) ?>" alt="">
    </div>
</div>
<!-- END OF BOX -->
<?php $subdeal++; ?>
<?php endforeach; ?>
<?php else: ?>
<?php foreach($subdeals as $dv): ?>
<script type="text/javascript" src="assets/vigattin_deals/js/vigdeal.js"></script>
<script>googlemap = new googlemap()</script>
<script>slideshow = new slideshow()</script>
<script>viewvideo2 = new viewvideo2()</script>
<script type="text/javascript" src="assets/vigattin_deals/js/iv.js"></script>
<!-- START OF BOX -->
<div id="deal-box">
    <div id="deal-box-header">
        <div id="dbh-con"><?php echo xss_cleaner($dv->deal_title) ?>!</div>
        <div class="fright" id="deal-box-header-sp"><span>>></span> <a href="vigdeals">Supported Foundation</a></div>
    </div>
    <div id="deal-box-info" class="fright">
        <div id="deal-box-info-statement"><?php echo xss_cleaner($dv->deal_view_statement) ?></div>
<?php if($dv->deal_option == 1): ?>
<?php if($dv->deal_current_stock <> 0): ?>
        <div id="deal-box-info-btnsandd" class="deal-box-info-btnsandd2 btncontainer"<?php if($dv->video_embed == ""): ?> style="height: 145px;"<?php endif; ?>>
            <div id="deal-box-info-btnsandd-opd">
                <div id="deal-box-info-btnsandd-op">
                    <span>P <?php echo number_format(xss_cleaner($dv->deal_original_price)) ?></span>
                    <div>Original Price</div>
                </div>
                <div id="deal-box-info-btnsandd-d">
                    <div id="deal-box-info-btnsandd-d-n"><?php echo xss_cleaner($dv->deal_discount) ?>%</div>
                    <div id="deal-box-info-btnsandd-d-off">off</div>
                </div>
            </div>
            <div id="deal-box-info-btnanddd-dp">
                <span>P <?php echo number_format(xss_cleaner($dv->deal_discounted_price)) ?></span>
            </div>
            <div class="push"></div>
            <div class="deal-box-info-btnanddd-vgs">
                <a href="javascript:return false;" class="deal-box-info-btnanddd2-vgs-grp" buylink="buy/<?php echo xss_cleaner($dv->deal_hash) ?>/<?php echo xss_cleaner($this->uri->segment(3)) ?>">
                    <div id="deal-box-info-btnanddd-vg">
                        <span>VIG IT</span>
                        <div>NOW!</div>
                        <div id="deal-box-info-btnanddd-vg-box">
                            <div id="deal-box-info-btnanddd-vg-box-vgin">
                                <span>VI<span id="deal-box-info-btnanddd-vg-box-vgin-span">gorously</span> G<span id="deal-box-info-btnanddd-vg-box-vgin-span">rab</span> IT</span><div>NOW!</div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
<?php if($dv->video_embed <> ""): ?>
            <div class="deal-box-info-btnanddd-wv">
                <div link="<?php echo htmlspecialchars(xss_cleaner($dv->video_embed)) ?>">Watch Video</div>
            </div>
<?php endif; ?>
        </div>
<?php else: ?>
        <div id="deal-box-info-btnsandd2"<?php if($dv->video_embed == ""): ?> style="height: 145px;"<?php endif; ?>>
            <div id="deal-box-info-btnsandd2-opd">
                <div id="deal-box-info-btnsandd2-op">
                    <span>P <?php echo number_format(xss_cleaner($dv->deal_original_price)) ?></span>
                    <div>Original Price</div>
                </div>
                <div id="deal-box-info-btnsandd2-d">
                    <div id="deal-box-info-btnsandd2-d-n"><?php echo xss_cleaner($dv->deal_discount) ?>%</div>
                    <div id="deal-box-info-btnsandd2-d-off">off</div>
                </div>
            </div>
            <div id="deal-box-info-btnanddd2-dp">
                <span>P <?php echo number_format(xss_cleaner($dv->deal_discounted_price)) ?></span>
            </div>
            <div id="deal-box-info-btnanddd2-vgs">
                <div class="deal-box-info-btnanddd2-vg">
                    <span>SOLD OUT</span>
                </div>
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
<?php for($i=0;$i<$deal_option[0]["optl"];$i++): ?>
<?php $dos = $dos + $deal_option[0][$i]["dos"]; ?>
<?php $dcs = $dcs + $deal_option[0][$i]["dcs"]; ?>
<?php endfor; ?>
<?php if($dcs <> 0): ?>
        <div id="deal-box-info-btnsandd" class="deal-box-info-btnsandd2 btncontainer"<?php if($dv->video_embed == ""): ?> style="height: 145px;"<?php endif; ?>>
            <div id="deal-box-info-btnsandd-opd">
                <div id="deal-box-info-btnsandd-op">
                    <span>P <?php echo number_format(xss_cleaner($dv->deal_original_price)) ?></span>
                    <div>Original Price</div>
                </div>
                <div id="deal-box-info-btnsandd-d">
                    <div id="deal-box-info-btnsandd-d-n"><?php echo xss_cleaner($dv->deal_discount) ?>%</div>
                    <div id="deal-box-info-btnsandd-d-off">off</div>
                </div>
            </div>
            <div id="deal-box-info-btnanddd-dp">
                <span>P <?php echo number_format(xss_cleaner($dv->deal_discounted_price)) ?></span>
            </div>
            <div class="push"></div>
            <div class="deal-box-info-btnanddd-vgs">
                <a href="javascript:return false;" class="deal-box-info-btnanddd2-vgs-grp" buylink="buy/<?php echo xss_cleaner($dv->deal_hash) ?>/<?php echo $this->uri->segment(3) ?>">
                    <div id="deal-box-info-btnanddd-vg">
                        <span>VIG IT</span>
                        <div>NOW!</div>
                        <div id="deal-box-info-btnanddd-vg-box">
                            <div id="deal-box-info-btnanddd-vg-box-vgin">
                                <span>VI<span id="deal-box-info-btnanddd-vg-box-vgin-span">gorously</span> G<span id="deal-box-info-btnanddd-vg-box-vgin-span">rab</span> IT</span><div>NOW!</div>
                            </div>
                        </div>
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
        <div id="deal-box-info-btnsandd2"<?php if($dv->video_embed == ""): ?> style="height: 145px;"<?php endif; ?>>
            <div id="deal-box-info-btnsandd2-opd">
                <div id="deal-box-info-btnsandd2-op">
                    <span>P <?php echo number_format(xss_cleaner($dv->deal_original_price)) ?></span>
                    <div>Original Price</div>
                </div>
                <div id="deal-box-info-btnsandd2-d">
                    <div id="deal-box-info-btnsandd2-d-n"><?php echo xss_cleaner($dv->deal_discount) ?>%</div>
                    <div id="deal-box-info-btnsandd2-d-off">off</div>
                </div>
            </div>
            <div id="deal-box-info-btnanddd2-dp">
                <span>P <?php echo number_format(xss_cleaner($dv->deal_discounted_price)) ?></span>
            </div>
            <div id="deal-box-info-btnanddd2-vgs">
                <div class="deal-box-info-btnanddd2-vg">
                    <span>SOLD OUT</span>
                </div>
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
<?php $img=1; ?>
        <div>
<?php foreach($galleries as $gallery): ?>
            <img class="deal-box-imgs" src2="<?php echo xss_cleaner($gallery->gallery_filename) ?>" src="assets/general/images/deals_gallery/optimize/<?php echo xss_cleaner($gallery->gallery_filename) ?>" alt="" id="<?php echo $img++; ?>">
<?php endforeach; ?>
        </div>
    </div>
</div>
<!-- END OF BOX -->
<!-- START OF ETC -->
<div id="etcbtn">
<?php $date=$this->cllibrary->timeleft(($dv->deal_view_end)-time());?>
    <div id="etcbtn-timer" class="etcbtn-timer">
        <div id="etcbtn-timer-t">DEAL ENDS IN:&nbsp;&nbsp;&nbsp;<span id="d"><?php echo ($date[0] < 10) ? "0".$date[0]:"".$date[0]; ?><span>d</span></span>&nbsp;&nbsp;&nbsp;<span id="h"><?php echo ($date[1] < 10) ? "0".$date[1]:"".$date[1]; ?><span>h</span></span>&nbsp;&nbsp;&nbsp;<span id="m"><?php echo ($date[2] < 10) ? "0".$date[2]:"".$date[2]; ?><span>m</span></span>&nbsp;&nbsp;&nbsp;<span id="s"><?php echo ($date[3] < 10) ? "0".$date[3]:"".$date[3]; ?><span>s</span></span> </div>
    </div>
    <a href="recommend">
        <div id="etcbtn-rec" class="fleft"></div>
    </a>
    <a href="javascript: return false;" onclick="window.open('http://www.javascript-coder.com','mywindow','menubar=1,resizable=1,width=500,height=500')">
        <div id="etcbtn-cw" class="fleft"></div>
    </a>
<?php $fimg=0; ?>
<?php foreach($galleries as $gallery): ?>
<?php if($fimg == 0): ?>
<?php $fimgis = base_url()."assets/general/images/deals_gallery/optimize/".$gallery->gallery_filename.""; ?>
<?php endif; ?>
<?php $fimg++; ?>
<?php endforeach; ?>
    <a href="http://www.vigattin.net/index.php/games?image=<?php echo $fimgis; ?>&username=&userid=&back=<?php echo base_url("deal/".$this->uri->segment(2)."/".$this->uri->segment(3).""); ?>">
        <div id="etcbtn-play"></div>
    </a>
    <div id="etcbtn-fb">
        <div id="etcbtn-fb-share">
            <script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script>    
            <span style="border:1px solid #CAD4E7; display:block; padding:1px; background:#eceef5; height: 17px; margin-right: 5px;-webkit-border-radius: 3px;-moz-border-radius: 3px;border-radius: 3px;">
                <fb:share-button href="<?php echo base_url() ?>deal/<?php echo $dv->deal_hash ?>?og_title=<?php echo urlencode(xss_cleaner($dv->deal_view_title)); ?>&og_description=<?php echo urlencode(xss_cleaner($dv->deal_view_statement)); ?>&og_image=<?php echo urlencode(base_url().'assets/general/images/deals_gallery/optimize/'.xss_cleaner($gallery->gallery_filename)); ?>" class="meta">
                </fb:share-button> 
            </span>
        </div>
        <div id="etcbtn-fb-like">
            <iframe src="http://www.facebook.com/plugins/like.php?href=<?php echo base_url()."deal/".$this->uri->segment(2) ?>/<?php echo $this->uri->segment(3) ?>&layout=button_count&show_faces=false&width=100&action=like&amp;font&colorscheme=light&height=20" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:100px; height:20px;" allowTransparency="true"></iframe>
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
                <li><?php echo xss_cleaner($hl->highlight_content) ?></li>
<?php endforeach; ?>
            </ul>
        </div>
    </div>
    <div id="deal-info-hr"></div>
    <div id="deal-info-abt">
        <div id="deal-info-h">ABOUT</div>
        <div id="deal-info-c">
            <?php echo nl2br(xss_cleaner($dv->deal_content)) ?>
        </div>
    </div>
    <div id="deal-info-hr"></div>
    <div id="deal-info-dt">
        <div id="deal-info-h">DEAL'S TERMS</div>
        <div id="deal-info-c">
            <ul>
<?php foreach($fineprint as $fp): ?>
                <li><?php echo xss_cleaner($fp->fineprint_content) ?></li>
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
                <iframe class="google_iframe" width="300" height="300" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="<?php echo xss_cleaner($ad_limit->location_link); ?>&z=15&output=embed"></iframe>
<?php endif ?>
<?php endforeach ?>
            </div>
            <div class="fleft">
                <ul style="margin-left: 10px; text-decoration: underline; cursor: pointer; width: 360px;">
<?php foreach($location as $ad) : ?>
<?php if($ad->location_address == "") : ?>

<?php else : ?>
                    <li link="<?php echo xss_cleaner($ad->location_link); ?>"><?php echo xss_cleaner($ad->location_address); ?></li>
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
    <div id="ads-h">You may also grab this</div>
    <div id="ads-b-b-b">
        <div id="ads-b-b" class="ads-b-b-h">
<?php foreach($random_deals as $rd): ?>
            <a href="deal/<?php echo xss_cleaner($rd->deal_hash) ?>">
                <div class="ads-b">
                    <div id="ads-b-h" title="<?php echo xss_cleaner($rd->deal_view_title) ?>"><?php echo xss_cleaner($rd->deal_view_title) ?></div>
                    <img src="assets/general/images/deals_gallery/customize/<?php echo xss_cleaner($rd->deal_image) ?>" alt="" width="242px" height="98px">
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