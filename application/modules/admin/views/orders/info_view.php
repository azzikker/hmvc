<!--START OF CSS-->
<link rel="stylesheet" type="text/css" href="assets/general/set/jtps/jtps.css">
<!--END OF CSS-->
<!--START OF JS-->
<script type="text/javascript" src="assets/general/js/jquery.js"></script>
<script type="text/javascript" src="assets/general/set/jtps/jtps.js"></script>
<script type="text/javascript" src="assets/admin/js/datagrid_min.js"></script>
<!--END OF JS-->

<div class = "profile_member">
<?php /*date variables*/ $m = "m"; $d = "d"; $y = "Y"; /*tables variables*/ $table4 = "deal_selection"; $table5 = "deal_option"; ?>  
<?php foreach($sql as $row) : ?>
<?php /*tables field variables*/ $select_where["selection_hash"] = $row->selection_hash; $option_where["option_id"] = $row->option_id; ?>
<?php $sql1 = $this->Deals_Selection_Model->displaySelected($table4, $select_where) ?>
<?php $sql2 = $this->Deals_Option_Model->displaySelectedID($table5, $option_where) ?>
    <article class="module width_full">
        <header>
            <h3 class="tabs_involved">Orders - <?php echo $this->uri->segment(4); ?> - <?php echo $this->uri->segment(5); ?> - ( <?php echo htmlentities($row->voucher_no); ?> )</h3>
        </header>
        <div id="div_halffield" align="left">
            <fieldset id="deal_halffield">
                <label>Deal</label>
                <div id="deal_li"><b>Company Name</b></div>
                <div class = "deal_li"><?php echo xss_cleaner($row->company_name); ?></div>
                <div id="deal_li"><b>Deal Title</b></div>
                <div class = "deal_li"><?php echo xss_cleaner($row->deal_title); ?></div>
                <div style="padding: 5px; text-align: right; margin: 2px;">
<?php if($row->deal_view_type == "Single Deal") : ?>
                    <a href="<?php echo base_url() . "admin/admin_deals/profile_single_deal/" . htmlentities($row->deal_view_type) . "/" . htmlentities($row->deal_hash); ?>">View Full Information</a>
<?php else : ?>
                    <a href="<?php echo base_url() . "admin/admin_deals/profile_sub_deal/" . htmlentities($row->deal_view_type) . "/" . htmlentities($row->deal_subhash); ?>">View Full Information</a>
<?php endif ?>
                </div>
            </fieldset>
            <fieldset id="deal_halffield">
                <label>Customer</label>
                <div id="deal_li"><b>Customer ID</b></div>
                <div class = "deal_li"><?php echo htmlentities($row->customer_id); ?></div>
                <div id="deal_li"><b>Customer Name</b></div>
                <div class = "deal_li"><?php echo $row->customer_lastname . ", " . $row->customer_firstname; ?></div>
                <div style="padding: 5px; text-align: right; margin: 2px;">
                    <a href="admin/admin_customers/profile/<?php echo htmlentities($row->customer_hash); ?>">View Full Information</a>
                </div>
            </fieldset>
            <fieldset id="deal_halffield">
                <label>Order</label>
                <div id="deal_li"><b>Voucher No.</b></div>
                <div class = "deal_li"><?php echo htmlentities($row->voucher_no); ?></div>
                <div id="deal_li"><b>Purchase Date</b></div>
                <div class = "deal_li"><?php echo date($m . "/" . $d . "/" . $y, htmlentities($row->order_date)); ?></div>
                <label></label>
                <div id="deal_li"><b>Expiration Date</b></div>
                <div class = "deal_li"><?php echo date($m . "/" . $d . "/" . $y, strtotime(date($m . "/" . $d . "/" . $y, htmlentities($row->order_date)) . " + 25 days")); ?></div>
                <div id="deal_li"><b>Order Status</b></div>
                <div class = "deal_li"><?php echo ucfirst(htmlentities($row->order_status)); ?></div>
                <br>
<?php if(htmlentities($row->selection_hash) != "") : ?>
                <label></label>
                <div id="deal_li"><b><?php foreach($sql1 as $row1) : echo ucfirst(htmlentities($row1->selection_name)); endforeach ?></b></div>
                <div class = "deal_li"><?php foreach($sql2 as $row2) : echo ucfirst(htmlentities($row2->option_name)); endforeach ?></div>
                <br>
<?php endif ?>
                <label></label>
                <div id="deal_li"><b>Price</b></div>
                <div class = "deal_li"><?php echo number_format(htmlentities($row->deal_discounted_price)); ?></div>
                <div id="deal_li"><b>Order Quantity</b></div>
                <div class = "deal_li"><?php echo htmlentities($row->order_quantity); ?></div>
                <label></label>
                <div id="deal_li"><b>Returned Quantity</b></div>
                <div class = "deal_li"><?php echo htmlentities($row->order_returned); ?></div>
                <div id="deal_li"><b></b></div>
                <div class = "deal_li"><b><hr></b></div>
                <div id="deal_li"><b class="blue">Net Cost</b></div>
                <div id="blue" class = "deal_li"><?php echo number_format(htmlentities($row->order_each_price)); ?></div>
                <label></label>
                <div id="deal_li"></div>
                <div class = "deal_li"><b><hr></b></div>
                <div id="deal_li" class="green"><b>Total Cost</b></div>
                <div id="green" class = "deal_li"><b><?php echo number_format(htmlentities($row->order_total_price)); ?></b></div>
                <div style="padding: 5px; text-align: right; margin: 2px;">
                    <a href="<?php echo base_url(); ?>admin/admin_orders/manage_order/<?php echo $this->uri->segment(4); ?>/<?php echo $this->uri->segment(5); ?>/<?php echo htmlentities($row->order_id); ?>">Manage Order</a>
                    |
                    <a href="<?php echo base_url(); ?>admin/admin_orders/manage_return/<?php echo $this->uri->segment(4); ?>/<?php echo $this->uri->segment(5); ?>/<?php echo htmlentities($row->order_id); ?>">Manage Return History</a>
                </div>
            </fieldset>
            <fieldset id="deal_halffield">
                <label>Return History</label>
                <table style="font-size: 11px" id="datagrid_min" style="border: 1px solid #ccc;" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th id = "table_spacing" align="left">Code</th>
                            <th align="left">Option</th>
                            <th align="right">Quantity ( to be returned )</th>
                            <th align="center">Action</th>
                        </tr>
                    </thead>
                    <tbody id = 'info_grid'>
                        <tr>
                            <td id = "table_spacing"><?php echo return_code("Correastore", $row->voucher_no); ?></td>
                            <td align="left">cash / virtual money</td>
                            <td align="right">2</td>
                            <td align="center">
                                <a href="admin/systems_controller"><img id="icn_search" src="assets/admin/images/icn_search.png" title="View History"></a>
                            </td>
                        </tr>
                    </tbody>
                    <tfoot class="nav">
                <tr>
                    <td colspan=100>
                        <div class="pagination"></div>
                        <div class="paginationTitle">Page</div>
                        <div class="selectPerPage"></div>
                        <div class="status"></div>
                    </td>
                </tr>
            </tfoot>
                </table>
            </fieldset>
            <fieldset>
                <div style="padding: 5px; text-align: right; margin: 2px;">
                    <input type="button" value="Back" onclick="window.history.back();">
                </div>
            </fieldset>
        </div>
    </article>
<?php endforeach ?>
</div>