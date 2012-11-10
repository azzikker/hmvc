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
<?php $deal_view_title = shortenString(xss_cleaner($row1->deal_view_title), 40); ?>
            <h3 class="tabs_involved"> Deals - <?php echo xss_cleaner($row1->deal_view_type); ?> - <?php echo $deal_view_title[0]; ?></h3>
<?php if($this->session->userdata('user_level') <> 3) : ?>
            <ul class="tabs">
<?php if($this->session->userdata('user_level') == 0) : ?>
                <li>
                    <a href="<?php echo base_url(); ?>admin/admin_deals/edit_single_deal/<?php echo $this->uri->segment(4); ?>/<?php echo $this->uri->segment(5); ?>">
                        Manage Information
                    </a>
                </li>
<?php endif ?> 
                <li>
                    <a href="<?php echo base_url(); ?>admin/admin_deals_gallery/edit_gallery_single_deal/<?php echo $this->uri->segment(4); ?>/<?php echo $this->uri->segment(5); ?>">
                        View Gallery
                    </a> 
                </li>
            </ul>
<?php endif ?> 
        </header>
            <div id="div_logo"><img id="deal_logo" src="assets/general/images/deals_gallery/optimize/<?php echo $row1->deal_image; ?>"></div>
            <div id="div_sidefield" align="right" style="margin: 20px;">
                <fieldset id="deal_sidefield"><b><?php echo xss_cleaner($row1->deal_view_title); ?></b></fieldset>
                <fieldset id="deal_sidefield"><?php echo $row1->deal_view_statement; ?></fieldset>
                <fieldset id="deal_sidefield">
                    <div id="deal_li"><b>Company</b></div>
<?php $table9 = "companies"; ?>
<?php $where9["company_hash"] = $row1->company_hash; ?>
<?php $sql9 = $this->Companies_Model->displaySelected($table9, $where9); ?>
<?php foreach($sql9 as $row9) : ?>
                    <div class = "deal_li"><?php echo xss_cleaner($row9->company_name); ?></div>
<?php endforeach ?>
                    <div id="deal_li"><b>Category</b></div>
<?php $table = "deal_category"; ?>
<?php $where["category_id"] = $row1->category_id; ?>
<?php $sql = $this->Deals_Category_Model->displayCategorySelected($table, $where); ?>
<?php foreach($sql as $row) : ?>
                    <div class = "deal_li"><?php echo xss_cleaner($row->category_name); ?></div>
<?php endforeach ?>
                    <div id="deal_li"><b>Type</b></div>
                    <div class = "deal_li"><?php echo xss_cleaner($row1->deal_view_type); ?></div>
<?php $m = "%m"; $d = "%d"; $y = "%Y"; ?>
                    <div id="deal_li"><b>Date Duration</b></div>
                    <div class = "deal_li"><?php echo strftime($m . "/" . $d . "/" . $y, htmlentities($row1->deal_view_start)); ?> - <?php echo strftime($m . "/" . $d . "/" . $y, htmlentities($row1->deal_view_end)); ?></div>
                </fieldset>
                <fieldset id="deal_sidefield">
                    <div id="deal_li"><b>Original Price</b></div>
                    <div class = "deal_li"><?php echo "&#8369 " . number_format($row2->deal_original_price); ?></div>
                    <div id="deal_li"><b>Discount</b></div>
                    <div class = "deal_li"><?php echo htmlentities($row2->deal_discount) . "%"; ?></div>
                    <div id="deal_li"><b>Discounted Price</b></div>
                    <div class = "deal_li"><?php echo "&#8369 " . number_format($row2->deal_discounted_price); ?></div>  
                </fieldset>
                <fieldset id="deal_sidefield">
                    <div><b>Selections</b></div><br>
<?php foreach($sql4 as $row4) : ?>
                    <div id="deal_li"><?php echo xss_cleaner($row4->selection_name); ?></div>
<?php $table5 = "deal_option"; ?>
<?php $where5["selection_hash"] = htmlentities($row4->selection_hash); $deal_where["deal_hash"] = htmlentities($row4->deal_hash); ?>
<?php $sql5 = $this->Deals_Option_Model->displaySelected($table5, $deal_where, $where5); ?>
<?php foreach($sql5 as $row5) : ?>
                            <div class = "deal_li"><?php echo xss_cleaner($row5->option_name); ?></div>
                            <div id="deal_li"></div>
<?php endforeach ?>
                            <br>
<?php endforeach ?>
                </fieldset>
            </div>
            <div id="div_halffield" align="left">
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