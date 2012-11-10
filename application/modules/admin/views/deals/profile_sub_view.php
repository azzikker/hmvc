<!--START OF CSS-->
<link rel="stylesheet" type="text/css" href="assets/general/set/jtps/jtps.css">
<!--END OF CSS-->
<!--START OF JS-->
<script type="text/javascript" src="assets/general/js/jquery.js"></script>
<script type="text/javascript" src="assets/general/set/jtps/jtps.js"></script>
<!--END OF JS-->

<div class = "profile_member">
    <article class="module width_full">
<?php foreach($sql1 as $row1) : ?>
<?php foreach($sql2 as $row2) : ?>
        <header>
<?php $deal_title = shortenString($row2->deal_title, 40); ?>
            <h3 class="tabs_involved"> Deals - Sub Deal - <?php echo $deal_title[0]; ?></h3>
<?php if($this->session->userdata('user_level') <> 3) : ?>
            <ul class="tabs">
<?php if($this->session->userdata('user_level') == 0) : ?>
                <li>
                    <a href="<?php echo base_url(); ?>admin/admin_deals/edit_sub_deal/<?php echo $this->uri->segment(4); ?>/<?php echo $this->uri->segment(5); ?>">
                        Manage Information
                    </a>
                </li>
                
<?php endif ?>
                <li>
                    <a href="<?php echo base_url(); ?>admin/admin_deals_gallery/edit_gallery_sub_deal/<?php echo $this->uri->segment(4); ?>/<?php echo $this->uri->segment(5); ?>">
                        View Gallery
                    </a> 
                </li>
            </ul>
<?php endif ?>
        </header>
<?php foreach($sql3 as $row3) : ?>
            <div id="div_logo"><img id="deal_logo" src="assets/general/images/deals_gallery/optimize/<?php echo $row3->gallery_filename; ?>" width="650"></div>
<?php endforeach ?>
            <div id="div_sidefield" align="right" style="margin: 20px;">
                <fieldset id="deal_sidefield"><b><?php echo htmlentities($row2->deal_title); ?></b></fieldset>
                <fieldset id="deal_sidefield"><?php echo $row2->deal_statement; ?></fieldset>
                <fieldset id="deal_sidefield">
                    <div id="deal_li"><b>Original Price</b></div>
                    <div class = "deal_li"><?php echo "&#8369 " . htmlentities($row2->deal_original_price); ?></div>
                    <div id="deal_li"><b>Discount</b></div>
                    <div class = "deal_li"><?php echo htmlentities($row2->deal_discount) . "%"; ?></div>
                    <div id="deal_li"><b>Discounted Price</b></div>
                    <div class = "deal_li"><?php echo "&#8369 " . htmlentities($row2->deal_discounted_price); ?></div>  
                </fieldset>
                <fieldset id="deal_sidefield">
                    <div><b>Selections</b></div><br>
<?php foreach($sql4 as $row4) : ?>
                    <div id="deal_li"><?php echo htmlentities($row4->selection_name); ?></div>
<?php $table5 = "deal_option"; ?>
<?php $where5["selection_hash"] = $row4->selection_hash; $deal_where["deal_hash"] = htmlentities($row4->deal_hash); ?>
<?php $sql5 = $this->Deals_Option_Model->displaySelected($table5, $deal_where, $where5); ?>
<?php foreach($sql5 as $row5) : ?>
                            <div class = "deal_li"><?php echo htmlentities($row5->option_name); ?></div>
                            <div id="deal_li"></div>
<?php endforeach ?>
<?php endforeach ?>
                </fieldset>
            </div> 
            <div id="div_halffield" align="left" style="margin: 20px;">
                <fieldset id="deal_halffield">
                    <b>Highlights</b><p>
                    <ul style="margin: 20px;">
<?php foreach($sql6 as $row6) : ?>
                        <li><?php echo $row6->highlight_content; ?></li>
<?php endforeach ?>
                    </ul>
                </fieldset>
                <fieldset id="deal_halffield">
                    <b>About</b><p>
                    <div style="margin: 20px;"><?php echo nl2br(xss_cleaner($row2->deal_content)); ?></div>
                </fieldset>
                <fieldset id="deal_halffield">
                    <b>Deal's Terms</b><p>
                    <ul style="margin: 20px;">
<?php foreach($sql7 as $row7) : ?> 
                        <li><?php echo $row7->fineprint_content; ?></li>
<?php endforeach ?>
                    </ul>
                </fieldset>
                <fieldset id="deal_halffield">
                    <b>Location Map</b><p>
                    <ul style="margin: 20px;">
<?php foreach($sql8 as $row8) : ?>
                        <li><?php echo $row8->location_address; ?></li>
<?php endforeach ?>
                    </ul>
                </fieldset>
            </div>
            <div style="text-align: right; margin: 20px;">
                <fieldset>
                    <input type="button" value="Back" onclick="window.history.back();">
                </fieldset>        
            </div>
    </article>
<?php endforeach ?>
<?php endforeach ?>
</div>