<!--START OF CSS-->
<link rel="stylesheet" type="text/css" href="assets/general/set/jtps/jtps.css">
<!--END OF CSS-->
<!--START OF JS-->
<script type="text/javascript" src="assets/general/js/jquery.js"></script>
<script type="text/javascript" src="assets/general/set/jtps/jtps.js"></script>
<script type="text/javascript" src="assets/general/js/print.js"></script>
<script type="text/javascript" src="assets/admin/js/datagrid.js"></script>
<script type="text/javascript" src="assets/admin/js/print.js"></script>
<!--END OF JS-->

<div class = "list_member" style="display: block;">  
    <div id="div_halffield" align="left" style="margin: 20px;">
        <fieldset id="deal_halffield">
            <label>Company</label>
<?php $company_count = ""; foreach($sql1 as $row1) : $company_count = $company_count+1; endforeach ?>
<?php if($company_count > 1) : ?>
            <select class="company_select" onchange="company_select(this.value)">
<?php if($this->uri->segment(4)!="") : ?>
<?php else : ?>
                <option value="">-choose-</option>
<?php endif ?>
<?php foreach($sql1 as $row1) : ?>
                <option value="<?php echo $row1->company_id; ?>" <?php if($this->uri->segment(4)==$row1->company_id) : ?>selected="selected"<?php endif ?>><?php echo $row1->company_name; ?></option>
<?php $company_count = $company_count+1; ?>
<?php endforeach ?>
            </select>
<?php else : ?>
<?php foreach($sql1 as $row1) : ?>
            <input type="text" value="<?php echo $row1->company_name; ?>" disabled="disabled">
            <input type="hidden" class="company_select" value="<?php echo $row1->company_id; ?>">
<?php endforeach ?>
<?php endif ?>
<?php if($this->uri->segment(4)!="") : //2nd SELECTION  ?>
<?php foreach($sql2 as $row2) : $deal_view_type = $row2->deal_view_type; endforeach ?>
            <label>Deals</label>
            <select class="deals_select" onchange="deal_select(this.value)">
<?php if($this->uri->segment(5)!="") : ?>
<?php else : ?>
                <option value="">-choose-</option>
<?php endif ?>
<?php foreach($sql2 as $row2) : ?>
 <?php if($deal_view_type == "Group Deal") : ?>                 
                <option value="<?php echo $row2->deal_view_id; ?>" <?php if($this->uri->segment(5)==$row2->deal_view_id) : ?>selected="selected"<?php endif ?>><?php echo str_replace("10", "", printf("%010s", htmlentities($row2->deal_view_id))) . " - " . $row2->deal_view_title; ?></option>
 <?php else : ?>
                <option value="<?php echo $row2->deal_view_id; ?>/<?php echo $row2->deal_id; ?>" <?php if($this->uri->segment(5)==$row2->deal_view_id) : ?>selected="selected"<?php endif ?>><?php echo str_replace("10", "", printf("%010s", htmlentities($row2->deal_view_id))) . " - " . $row2->deal_view_title; ?></option>
 <?php endif ?>
 <?php endforeach ?>
            </select>
<?php endif ?> 
<?php if($this->uri->segment(5)!="" && $deal_view_type == "Group Deal") : //3rd SELECTION ?>
            <label>Sub Deals</label>
            <select class="subdeals_select" onchange="subdeal_select(this.value)">
<?php if($this->uri->segment(6)!="") : ?>
<?php else : ?>
                <option value="">-choose-</option>
<?php endif ?>
<?php foreach($sql5 as $row5) : ?>
                <option value="<?php echo $row5->deal_id; ?>" <?php if($this->uri->segment(6)==$row5->deal_id) : ?>selected="selected"<?php endif ?>><?php echo str_replace("10", "", printf("%010s", htmlentities($row5->deal_id))) . " - " . $row5->deal_title; ?></option>
<?php endforeach ?> 
            </select>
<?php endif ?>
        </fieldset>
    </div>
    <div style="margin: 20px;">
        <article class="module width_full">
            <header><h3 class="tabs_involved">Customers</h3></header>
            <table style="font-size: 11px" id="datagrid" style="border: 1px solid #ccc;" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th id = "table_spacing" align="left"align="left"> # </th>
                        <th align="left">Customer Name</th>
                        <th align="left">Voucher No.</th>
                        <th align="center">Actions</th>
                    </tr>
                </thead>
                <tbody id = 'info_grid'>
<?php if($this->uri->segment(5)=="") : ?>
<?php else : ?>
<?php $count = 1; ?>
<?php foreach($sql as $row) : ?>
                    <tr>
                        <td id = "table_spacing"><?php echo $count; ?></td>
                        <td><?php echo $row->customer_lastname . ", " . $row->customer_firstname; ?></td>
                        <td><?php echo $row->voucher_no; ?></td>
                        <td align="center">
                            <a href="admin/admin_orders/information/<?php echo $row->order_status; ?>/-/<?php echo $row->order_id; ?>"><img id="icn_view" src="assets/admin/images/icn_search.png" title="View Information"></a>
                            <a href="admin/admin_customers/profile/<?php echo htmlentities($row->customer_hash); ?>"><img id="icn_profile" src="assets/admin/images/icn_profile.png" title="View Customer Profile"></a>
                        </td>
                    </tr>
<?php $count = $count+1; ?>
<?php endforeach ?>
<?php endif ?>
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
        </article>
        <div style="text-align: right;">
            <fieldset>
                <input type="button" value="Back" onclick="window.history.back();">
<?php if($this->uri->segment(5)=="") : ?>
<?php else : ?>
                <input type="button" value="Print Preview" onclick="showPrint()">
<?php endif ?>
            </fieldset>
        </div>
    </div>
</div>
<?php if($this->uri->segment(5)=="") : ?>
<?php else : ?>

<!-- PRINT PREVIEW -->
<div class = "print_member" style="display: none; font-family: "Helvetica Neue", Helvetica, Arial, Verdana, sans-serif; font-size: 10px;">
    <article class="module width_full" style="width: 1100px;">
        <header><h3>Customer Reports - <?php echo "company name"; ?></h3></header>
            <div id="printN">
                <div id="div_halffield" align="left" style="margin: 20px;">
                    <div class="div_header_<?php if($deal_view_type == "Group Deal") : ?>3<?php else : ?>2<?php endif ?>x">
                        <div id="deal_li"><b>COMPANY</b></div>
                        <div class = "deal_li"><?php foreach($sql3 as $row3) : echo $row3->company_name; endforeach ?></div>
                        <div id="deal_li"><b>DEAL</b></div>
                        <div class = "deal_li"><?php foreach($sql4 as $row4) : echo $row4->deal_view_title; endforeach ?></div>
<?php if($deal_view_type == "Group Deal") : ?>
                        <div id="deal_li"><b>SUB DEAL</b></div>
                        <div class = "deal_li"><?php foreach($sql6 as $row6) : echo $row6->deal_title; endforeach ?></div>
<?php endif ?>
                    </div>
                </div>
                <div id="div_halffield" align="left" style="margin: 20px;">
                    <h4 class="tabs_involved">CUSTOMERS</h4>
                    <div class="div_body">
                        <table style="font-size: 11px" cellspacing="0" width="100%">
                            <thead class="print_header">
                                <tr class="print_tr" align="left">
                                    <th class="print_th" align="center">CUSTOMERS' NAME</th> 
                                    <th class="print_th" align="center">VOUCHER NO.</th>
                                    <th class="print_th" align="center">RECEIVED BY / SIGNATURE</th>
                                </tr>
                            </thead>                                                         
                            <tbody id="info_grid" class="print_body">
<?php foreach($sql as $row) : ?>
                                <tr class="print_tr" align="left">
                                    <td class="print_td"><?php echo $row->customer_lastname . ", " . $row->customer_firstname; ?></td>
                                    <td class="print_td"><?php echo $row->voucher_no; ?></td>
                                    <td class="print_td"><b></b></td>
                                </tr>
<?php endforeach ?>
                            </tbody>
                            <tfoot class="nav">
                                <tr>
                                    <td colspan=100></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <div id="div_halffield" align="left" style="margin: 20px;">
                <div style="text-align: right;">
                    <fieldset style="width: 1060px;">
                        <div>
                            <div>
                                <input type="button" value="Back" onclick="showList()">
                                <input id="printNdiv" class="alt_btn" type="submit" value="Print">
                            </div>
                        </div>
                    </fieldset>
                </div>
            </div>
    </article>
</div>
<?php endif ?>
