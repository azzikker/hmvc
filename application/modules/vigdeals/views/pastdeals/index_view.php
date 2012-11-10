<script>var prequest = new prequest()</script>
<?php if(isset($_GET['m'])): ?>
<script>var monthsel = new monthsel(); var $monthselected="<?php echo $_GET['m']; ?>";</script>
<?php endif; ?>
<div id="category">
    <ul>
<?php $dcatnum = $deals_category->num_rows(); ?>
<?php $dcatnum2 = 0; ?>
<?php foreach($deals_category->result() as $dc): ?>
<?php $dcatnum2++; ?>
<?php $replacedc = preg_replace('/[^a-z0-9]/i',' ',$dc->category_name);?>
            <a href="past-category/<?php echo $dc->category_id ?>-<?php echo str_replace(" ","",$replacedc); ?>">
                <li<?php $uri2 = $this->uri->segment(2); $strpos = stripos($uri2,"-"); $cat_id = substr($uri2,0, $strpos); if($cat_id == $dc->category_id): ?> id="active"<?php endif; ?>><?php echo $dc->category_name ?></li>
            </a>
<?php if($dcatnum <> $dcatnum2): ?>
            <b>&middot;</b>
<?php endif; ?>
<?php endforeach; ?>
    </ul>
</div>
<div id="pdeal" class="fleft">
<div id="pdeal-mon">
    Month:
    <select name="month">
        <option value="0">All</option>
    </select>
</div>
<?php $stcks=0; ?>
<?php if($pd_rows > 0): ?>
<script>var viewvideo2 = new viewvideo2()</script>
<?php foreach($past_deals as $pd): ?>
    <!-- START OF PAST DEALS -->
<?php if(strtolower($pd->deal_view_type) == "single deal"): ?>
    <div id="pdeal-b" class="fleft">
        <div id="pdeal-b-ib">
            <div id="pdeal-b-ib-h"><?php echo $pd->deal_view_title ?></div>
            <img src="assets/general/images/deals_gallery/optimize/<?php echo $pd->deal_image ?>" width="347px" height="122px" alt="">
            <div id="pdeal-b-ib-d">
                <div id="pdeal-b-ib-d-l" class="fleft">
                    <div id="pdeal-b-ib-d-l-t">
                        <div id="pdeal-b-ib-d-l-t-l" class="fleft">
                            <span>P <?php echo number_format($pd->deal_original_price) ?></span>
                            <div>Original Price</div>
                        </div>
                        <div id="pdeal-b-ib-d-l-t-r" class="fleft">
                            <span><?php echo $pd->deal_discount ?>%</span>
                            <div>Off</div>
                        </div>
                    </div>
                    <div id="pdeal-b-ib-d-l-b">
						<div id="now_tag">NOW!</div>
                        <span>P <?php echo number_format($pd->deal_discounted_price) ?></span>
                    </div>
                </div>
                <div id="pdeal-b-ib-d-r" class="fleft">
                    <a href="past_deals/<?php echo $pd->deal_hash ?>">
                    <div id="pdeal-b-ib-d-r-b">
                        VIEW
                        <br />
                        DETAILS
                    </div>
                    </a>
					<div class="pdeal-b-ib-d-r-t" link="<?php echo htmlspecialchars($pd->video_embed) ?>">
                        WATCH VIDEO
                    </div>
                </div>
            </div>
            <div id="pdeal-b-ib-fb">
                <div id="etcbtn-fb-share">
                    <script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script>    
                    <span style="border:1px solid #CAD4E7; display:block; padding:1px; background:#eceef5; height: 17px; margin-right: 5px;-webkit-border-radius: 3px;-moz-border-radius: 3px;border-radius: 3px;">
                        <fb:share-button href="<?php echo base_url() ?>past_deals/<?php echo $pd->deal_hash ?>?og_title=<?php echo urlencode("Past Deal - ".$pd->deal_view_title); ?>&og_description=<?php echo urlencode($pd->deal_view_statement); ?>&og_image=<?php echo urlencode(base_url().'assets/general/images/deals_gallery/optimize/'.$pd->deal_image); ?>" class="meta">
                        </fb:share-button> 
                    </span>
                </div>
                <div id="etcbtn-fb-like">
                    <iframe src="http://www.facebook.com/plugins/like.php?href=<?php echo base_url() ?>past_deals/<?php echo $pd->deal_hash ?>&layout=button_count&show_faces=false&width=100&action=like&amp;font&colorscheme=light&height=20" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:100px; height:20px;" allowTransparency="true"></iframe>
                </div>
            </div>
            <div id="deal-info-hr"></div>
<?php $req=0; ?>
            <div class="pdeal-b-ib-req<?php foreach($request_deals as $reqd): if($reqd->deal_hash == $pd->deal_hash){ $req++; echo " reqed"; }; endforeach; ?>" deal="<?php echo $pd->deal_hash ?>">
<?php $requests = $this->deals_request_model->get_where(array("deal_hash"=>$pd->deal_hash))->num_rows(); ?>
            <div id='pdeal-b-ib-req-cnt' class="reqed"><span><?php echo $requests ?></span></div>
            </div>
        </div>
    </div>
<?php else: ?>
    <div id="pdeal-b" class="fleft">
        <div id="pdeal-b-ib">
            <div id="pdeal-b-ib-h"><?php echo $pd->deal_view_title ?></div>
            <img src="assets/general/images/deals_gallery/optimize/<?php echo $pd->deal_image ?>" width="347px" height="122px" alt="">
            <div id="pdeal-b-ib-e">
				<div id="pdeal-b-ib-e-u">
                    <a href="past_deals/<?php echo $pd->deal_hash ?>">
                        <div id="pdeal-b-ib-e-u-txt">
                        View Details
                        </div>
                     </a>
                     </div>
				<div class="pdeal-b-ib-e-b">
                    <div id="pdeal-b-ib-e-b-txt" class="fleft" link="<?php echo htmlspecialchars($pd->deal_video) ?>">
                    Watch Video
                    </div>
                </div>
            </div>
            <div id="deal-info-hr"></div>
<?php $req=0; ?>
            <div class="pdeal-b-ib-req<?php foreach($request_deals as $reqd): if($reqd->deal_hash == $pd->deal_hash){ $req++; echo " reqed"; }; endforeach; ?>" deal="<?php echo $pd->deal_hash ?>">
<?php $requests = $this->deals_request_model->get_where(array("deal_hash"=>$pd->deal_hash))->num_rows(); ?>
            <div id='pdeal-b-ib-req-cnt' class="reqed"><span><?php echo $requests ?></span></div>
            </div>
        </div>
    </div>
<?php endif; ?>
    <!-- END OF PAST DEALS -->
<?php endforeach; ?>
<?php else: ?>
    <div id='message'>
        <div id='message-b'>
            No deals for this month.
        </div>
    </div>
<?php endif; ?>
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