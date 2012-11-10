<!--START OF CSS-->
<link rel="stylesheet" type="text/css" href="assets/general/set/jtps/jtps.css">
<!--END OF CSS-->
<!--START OF JS-->
<script type="text/javascript" src="assets/general/js/jquery.js"></script>
<script type="text/javascript" src="assets/general/set/jtps/jtps.js"></script>

<script type="text/javascript">
    var returned_count = new returned_count(); 
    var quantity_returned_count = new quantity_returned_count(); 
</script>
<!--END OF JS-->

<div class = "edit_member" style="/*display: none;*/">
<?php /*date variables*/ $m = "m"; $d = "d"; $y = "Y"; /*tables variables*/ $table4 = "deal_selection"; $table5 = "deal_option"; ?> 
<?php foreach($sql as $row) : ?>
<?php /*tables field variables*/ $select_where["selection_hash"] = htmlentities($row->selection_hash); $option_where["option_id"] = htmlentities($row->option_id); ?>
<?php $sql1 = $this->Deals_Selection_Model->displaySelected($table4, $select_where) ?>
<?php $sql2 = $this->Deals_Option_Model->displaySelectedID($table5, $option_where) ?>
<form action="<?php echo base_url(); ?>admin/admin_orders/update_manage_<?php echo ($this->uri->segment(3) == "manage_order" ? "order" : "return"); ?>/<?php echo $this->uri->segment(4); ?>/<?php echo $this->uri->segment(5); ?>/<?php echo $this->uri->segment(6); ?>" method="post" enctype="multipart/form-data">
    <article class="module width_full">
        <header>
            <h3 class="tabs_involved">Orders - <?php echo $this->uri->segment(4); ?> - <?php echo $this->uri->segment(5); ?> - ( <?php echo htmlentities($row->voucher_no); ?> )</h3>
        </header>
        <div style="margin: 20px;">
<?php if($this->uri->segment(3) == "manage_order") : ?>
            <fieldset id="deal_halffield">
                <label>Order Status</label>
                <select name="editOS">
                    <option value="<?php echo htmlentities($row->order_status); ?>" selected="selected"><?php echo htmlentities($row->order_status); ?></option>
<?php if(htmlentities($row->order_status) == "pending") : ?><?php else : ?>
                    <option value="pending">pending</option>
<?php endif ?>
<?php if(htmlentities($row->order_status) == "used") : ?><?php else : ?>
                    <option value="used">used</option>
<?php endif ?>
<?php if(htmlentities($row->order_status) == "available") : ?><?php else : ?>
                    <option value="available">available</option>
<?php endif ?>
                </select>
<?php if(htmlentities($row->selection_hash) == "") : ?>
                <input type="hidden" class="edtoq" name="edtoq" value="<?php echo htmlentities($row->deal_current_stock); ?>">
<?php else : ?>
                <input type="hidden" class="edtoq" name="edtoq" value="<?php foreach($sql2 as $row2) : echo htmlentities($row2->deal_current_stock); endforeach ?>">
<?php endif ?>
                <input type="hidden" class="editoi" name="editoi" value="<?php echo htmlentities($row->option_id); ?>">
<?php if(htmlentities($row->selection_hash) == "") : ?>
                <input type="hidden" class="edtor" name="edtor" value="<?php echo htmlentities($row->deal_returned); ?>">
<?php else : ?>
                <input type="hidden" class="edtor" name="edtor" value="<?php foreach($sql2 as $row2) : echo htmlentities($row2->deal_returned); endforeach ?>">
<?php endif ?>
            </fieldset>
<?php elseif($this->uri->segment(3) == "manage_return") : ?>
            <fieldset id="deal_halffield">
                <label>History</label>
                <label id="options">Return Code</label>
                <input id="options" class="editRC" type="text" name="editRC_new" value="<?php echo return_code($row->company_name, $row->voucher_no); ?>" disabled="disabled">
                <input id="options" class="editRC_new" type="hidden" name="editRC" value="<?php echo return_code($row->company_name, $row->voucher_no); ?>">
                <label id="options">Order ID</label>
                <input id="options" class="editOR" type="text" name="editOR_new" value="<?php echo $row->order_txn; ?>" disabled="disabled">
                <input id="options" class="editOR_new" type="hidden" name="editOR" value="<?php echo $row->order_txn; ?>">
                <label id="options">Voucher No.</label>
                <input id="options" class="editVC" type="text" name="editVC_new" value="<?php echo $row->voucher_no; ?>" disabled="disabled">
                <input id="options" class="editVC_new" type="hidden" name="editVC" value="<?php echo $row->voucher_no; ?>">
                <label id="options">Quantity ( to be returned )</label>
                <input id="options" class="editTQ" type="text" name="editTQ_new" value="1" required="requierd"<?php if(($row->order_quantity - $row->order_returned)==1) : ?> disabled="disabled"<?php endif ?>>
                <input id="options" class="editTQ_old" type="hidden" name="editTQ_old" value="<?php echo number_format($row->order_quantity - $row->order_returned); ?>" required="requierd">
                <input id="options" class="editTQ_new" type="hidden" name="editTQ" value="1" required="requierd"<?php if(($row->order_quantity - $row->order_returned)==1) : ?> disabled="disabled"<?php endif ?>>
                <label id="options">Refund Amount</label>
                <input id="options" class="editRA" type="text" name="editRA_new" value="<?php echo number_format($row->deal_discounted_price); ?>" disabled="disabled">
                <input id="options" class="editRA_old" type="hidden" name="editRA_old" value="<?php echo number_format($row->deal_discounted_price); ?>" disabled="disabled">
                <input id="options" class="editRA_new" type="text" name="editRA" value="<?php echo number_format($row->deal_discounted_price); ?>" disabled="disabled">
            </fieldset>
            <fieldset>
<?php endif ?>
                <div style="padding: 5px; text-align: right; margin: 2px;">
                    <input type="button" value="Back" onclick="window.history.back();">
                    <input class="alt_btn" type="submit" name="update" value="Update"/>
                </div>
            </fieldset>
        </div>
    </article>
</form>
<?php endforeach ?>
</div>