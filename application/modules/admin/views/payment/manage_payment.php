<!--START OF CSS-->
<link rel="stylesheet" type="text/css" href="assets/general/set/jtps/jtps.css">
<!--END OF CSS-->
<!--START OF JS-->
<script type="text/javascript" src="assets/general/js/jquery.js"></script>
<script type="text/javascript" src="assets/general/set/jtps/jtps.js"></script>
<script type="text/javascript" src="assets/admin/js/datagrid.js"></script>

<link rel="stylesheet" type="text/css" href="assets/general/set/datepicker/themes/base/jquery.ui.all.css">
<script type="text/javascript" src="assets/general/set/datepicker/ui/jquery.ui.core.js"></script>
<script type="text/javascript" src="assets/general/set/datepicker/ui/jquery.ui.widget.js"></script>
<script type="text/javascript" src="assets/general/set/datepicker/ui/jquery.ui.datepicker.js"></script>
<!--END OF JS-->

<div id = "list_member" style="/*display: none;*/">  
    <article class="module width_full">
<?php foreach($sql as $row) : ?>
<?php $deal_title = shortenString(xss_cleaner($row->deal_view_title), 35); ?>
        <header>
            <h3 class="tabs_involved">Manage Payment for <?php echo $deal_title[0]; ?></h3>
        </header>
        <form action="<?php echo base_url(); ?>admin/admin_accounting/finished/<?php echo $this->uri->segment(4); ?>/<?php echo $this->uri->segment(5); ?>/<?php echo $this->uri->segment(6); ?>" method="post" enctype="multipart/form-data">
            <div id="div_logo"><img id="deal_logo" src="assets/general/images/deals_gallery/optimize/<?php echo htmlentities($row->deal_image); ?>" width="650px"></div>
            <div id="div_sidefield" align="right" style="margin: 20px;">
                <fieldset id="deal_sidefield"><b><?php echo xss_cleaner($row->deal_view_title); ?></b></fieldset>
                <fieldset id="deal_sidefield"><?php echo xss_cleaner($row->deal_view_statement); ?></fieldset>
                <fieldset id="deal_sidefield">
                    <div id="company_li"><b>TR No.</b></div>
                    <div class ="company_li"><?php echo str_replace("10", "", printf("%010s", htmlentities($row->deal_view_id))); ?></div> 
                    <div id="company_li"><b>Company</b></div>
<?php $table9 = "companies"; ?>
<?php $where9["company_id"] = htmlentities($row->company_id); ?>
<?php $sql9 = $this->Companies_Model->displaySelected($table9, $where9); ?>
<?php foreach($sql9 as $row9) : ?>
                    <div class = "company_li"><?php echo htmlentities($row9->company_name); ?></div>
<?php endforeach ?>
                    <div id="company_li"><b>Category</b></div>
<?php $table = "deal_category"; ?>
<?php $where["category_id"] = htmlentities($row->category_id); ?>
<?php $sql1 = $this->Deals_Category_Model->displayCategorySelected($table, $where); ?>
<?php foreach($sql1 as $row1) : ?>
                    <div class = "company_li"><?php echo htmlentities($row1->category_name); ?></div>
<?php endforeach ?>
                    <div id="company_li"><b>Type</b></div>
                    <div class = "company_li"><?php echo htmlentities($row->deal_view_type); ?></div>
<?php $m = "%b"; $d = "%d"; $y = "%Y"; ?>
                    <div id="company_li"><b>Date Span</b></div>
                    <div class = "company_li"><?php echo strftime($m . " " . $d . ", " . $y, htmlentities($row->deal_view_start)); ?> - <?php echo strftime($m . " " . $d . ", " . $y, htmlentities($row->deal_view_end)); ?></div>
                </fieldset>
            </div>
            <br>
            <div style="margin: 20px;">
                <div id="deal_type">
                    <fieldset>
                        <input type="hidden" name="CI" value="<?php echo htmlentities($row->company_id); ?>">
                        <label>Receipt Number</label>
                        <input type="text" name="RN" autocomplete="off" value="" maxlength="16" required="required">
                        <label>Account Number</label>
                        <input type="text" name="AN" autocomplete="off" value="" maxlength="16" required="required">
                        <label>Bank Name</label>
                        <input type="text" name="BN" autocomplete="off" value="" maxlength="16" required="required">
                    </fieldset>
                </div>
                <div style="text-align: right;">
                    <fieldset>
                        <input type="button" value="Back" onclick="window.history.back();">
                        <input class="alt_btn" type="submit" name="complete" value="Complete"/>
                    </fieldset>       
                </div>
            </div>
        </form>
<?php endforeach ?>
    </article>
</div>