<!--START OF CSS-->
<link rel="stylesheet" type="text/css" href="assets/general/set/jtps/jtps.css">
<link rel="stylesheet" type="text/css" href="assets/general/set/datepicker/themes/base/jquery.ui.all.css">
<link rel="stylesheet" type="text/css" href="assets/admin/set/HoverLightbox/css/horizontal.css">
<link rel="stylesheet" type="text/css" href="SpryAssets/SpryMenuBarHorizontal.css" />
<!--END OF CSS-->
<!--START OF JS-->
<script type="text/javascript" src="assets/general/js/jquery.js"></script>
<script type="text/javascript" src="assets/general/set/jtps/jtps.js"></script>
<script type="text/javascript" src="assets/admin/js/datagrid.js"></script>
<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>

<script type="text/javascript" src="assets/general/set/datepicker/ui/jquery.ui.core.js"></script>
<script type="text/javascript" src="assets/general/set/datepicker/ui/jquery.ui.widget.js"></script>
<script type="text/javascript" src="assets/general/set/datepicker/ui/jquery.ui.datepicker.js"></script>
<script type="text/javascript" src="assets/admin/set/HoverLightbox/js/lightbox.js"></script>

<script type="text/javascript">
    var show_details = new show_details();
</script>
<!--END OF JS-->

<div id = "list_member" style="/*display: none;*/">  
    <article class="module width_full">
        <header>
            <h3 class="tabs_involved">Payment Due 
<?php $m = "F"; $d = "d"; $y = "Y"; ?>
<?php $year1 = date("Y", time()); $year2 = $year1 /*year*/ ?>                                                                                                    
<?php $month = str_replace("0", "", date("m", strtotime("01/01/" . $year1))); /*1st month of the year*/ ?>
<?php $month1 = date("m", time()); /*current month*/ ?>
<?php $month2 = str_replace("0", "", date("m", strtotime("01/01/" . $year1)) . " + 31 days"); ?>
<?php $month_num1 = $month2+1; ?>
<?php $lower_date = strtotime(date($m . " " . $d . ", " . $y, $this->uri->segment(4)) . " + 1 month"); ?>
<?php $upper_date = strtotime(date($m . " " . $d . ", " . $y, $this->uri->segment(5)) . " + 1 month"); ?>
<?php $timer_date = time(); ?>
<?php if($timer_date >= $this->uri->segment(4) && $timer_date <= $this->uri->segment(5)) : ?>
                <span class="tabs red">Current</span>
<?php elseif($timer_date >= $this->uri->segment(4) && $timer_date >= $this->uri->segment(5)) : ?>
                <span class="tabs blue">Finished</span>
<?php elseif($timer_date <= $this->uri->segment(4) && $timer_date <= $this->uri->segment(5)) : ?>     
                <span class="tabs green">On Progress</span>
<?php endif ?> 
            <select class="tabs"> 
<?php for($i=$month;$i<=12;$i++) : ?>
<?php $month_num2 = $month . "/1/" . $year1; ?>                              
<?php $seconds1 = strtotime($month . "/1/" . $year1/* . " - 1 month"*/); /*complete monthly date into seconds*/ ?>
<?php $seconds2 = strtotime($month_num1 . "/1/" . $year2/* . " + 1 month"*/); /*complete next monthly date into seconds*/ ?>
                <option <?php if($seconds1==$this->uri->segment(4)) : ?>selected="selected"<?php endif ?> onclick="window.location.href='<?php echo base_url(); ?>admin/admin_accounting/index/<?php echo $seconds1; ?>/<?php echo $seconds2; ?>','_self';" value="<?php echo strtotime("January 1, " . $year1); ?>"><?php echo date($m, $seconds1) ?></option>
<?php $month=$month+1; $month_num1=$month_num1+1; ?>
<?php if($month_num1==13) { $month_num1=1; $year2=$year2+1; } ?>
<?php endfor ?>
            </select>
<?php $table1 = "deal_view"; $table2 = "companies"; $table3 = "deal_category"; $table4 = "deals"; $table5 = "deal_option"; $table10 = "deal_payment"; ?>
<?php foreach($sql as $row) : $deal_view_due = xss_cleaner($row->deal_view_end); $company_id = xss_cleaner($row->company_id); $deal_hash = xss_cleaner($row->deal_hash); endforeach ?>
<?php /*sql1 variable call*/ $deal_where["deal_hash"] = $deal_hash; $where_start = $this->uri->segment(4); $where_end = $this->uri->segment(5); ?>
<?php $sql1 = $this->Deals_View_Model->displaySelectedDateBased($table1, $deal_where, $where_start, $where_end); ?>
        </header>          
        <table style="font-size: 11px" id="datagrid" style="border: 1px solid #ccc;" cellspacing="0" width="100%">
            <thead>
                <tr align="left">
                    <th id = "table_spacing"> # </th>
                    <th>
                        <span class="company_name">Company Name</span>
                    </th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
<?php $show_count = 1; ?>
<?php foreach($sql1 as $row1) : ?>
<?php /*$sql2 variable vcall*/ $company_where["company_id"] = xss_cleaner($row1->company_id); ?>
<?php /*$sql3 variable vcall*/ $category_where["category_id"] = xss_cleaner($row1->category_id); ?>
<?php /*$sql4 & $sql10 variable vcall*/ $where["deal_hash"] = xss_cleaner($row1->deal_hash); ?>
<?php $sql2 = $this->Companies_Model->displaySelected($table2, $company_where) ?>
<?php $sql3 = $this->Deals_Category_Model->displayCategorySelected($table3, $category_where) ?>
<?php $sql4 = $this->Deals_Model->displaySelectedSum($table4, $where) ?>
<?php $sql5 = $this->Deals_Option_Model->displaySelectedSum($table5, $where) ?>
<?php $sql10 = $this->Deals_Payment_Model->displaySelected($table1, $table10, $where["deal_hash"], $company_where["company_id"]); ?>
<?php $deal_title = shortenString(xss_cleaner($row1->deal_view_title), 25); ?>
<?php foreach($sql4 as $row4) : ?>
<?php foreach($sql5 as $row5) : ?>
<?php /*variable calls for $NPFM*/ $sp=$row4->deal_discounted_price; $x=$webcall/100; $tf=(xss_cleaner($row4->deal_original_stock)-htmlentities($row4->deal_current_stock))+(htmlentities($row5->deal_original_stock)-htmlentities($row5->deal_current_stock)); $nr=htmlentities($row4->deal_returned)+htmlentities($row5->deal_returned); ?>
<?php $NPFM = npfm($sp, $x, $tf, $nr); ?>
                <tr align="left">
                    <td id = "table_spacing"><?php echo $show_count; ?></td>
                    <td>
                        <span class="company_name"><?php foreach($sql2 as $row2) : echo xss_cleaner($row2->company_name); endforeach ?></span>
                    </td>
                    <td>
                        <a><img id="icn_hide_up" class="show_details" detail_count="<?php echo $show_count; ?>" src="assets/admin/images/icn_hide_up.png" title="View Details"></a>
                    </td>
                </tr>
                <tr>
                    <th></th>
                    <th align="right">
                        <span id="deal_header" class="deal_title"></span>
                        <span id="deal_header" class="deal_category"></span>
                        <span id="deal_header" class="deal_type"></span>
                        <span id="deal_header" class="deal_price"></span>
                        <span id="deal_header" class="deal_sold"></span>
                        <span id="deal_header" class="deal_returned"></span>             
                        <span id="deal_header" class="deal_stock"></span>
                        <span id="deal_header" class="deal_remittance"></span>
                        <span id="deal_header" class="deal_due"></span>
                        <span id="deal_header" class="deal_end"></span> 
                    </th>
                    <th></th>                                   
                </tr>
                <tr id="payment_details" class="payment_details<?php echo $show_count; ?>">
                    <th></th>
                    <th align="right">
                        <span id="deal_header" class="deal_title">Deal Title</span>
                        <span id="deal_header" class="deal_category">Deal Category</span>
                        <span id="deal_header" class="deal_type">Deal Type</span>
                        <span id="deal_header" class="deal_price">Price</span>
                        <span id="deal_header" class="deal_sold">Sold</span>
                        <span id="deal_header" class="deal_returned">Returns</span>             
                        <span id="deal_header" class="deal_stock">Stock</span>
<?php if($this->session->userdata('user_level') == 1 || $this->session->userdata('user_level') == 0) : ?>
                        <span id="deal_header" class="deal_remittance">Remittance</span>
<?php endif ?>
                        <span id="deal_header" class="deal_due">Payment Due</span>
                        <span id="deal_header" class="deal_end">Deal Ends On</span>
                    </th>
                    <th></th>                                   
                </tr>
                <tr id="payment_details" class="payment_details<?php echo $show_count; ?>">
                    <td></td>
                    <td title="<?php echo xss_cleaner($row1->deal_view_title); ?>">
                        <span class="deal deal_title"><?php echo $deal_title[0]; ?></span>
                        <span class="deal deal_category"><?php foreach($sql3 as $row3) : echo xss_cleaner($row3->category_name); endforeach ?></span>
                        <span class="deal deal_type"><?php echo htmlentities($row1->deal_view_type); ?></span>
<?php if(xss_cleaner($row1->deal_view_type) == "Single Deal") : ?>           
                        <span class="deal deal_price"><?php echo number_format($row4->deal_discounted_price); ?></span>
<?php else : ?>
                        <span class="deal deal_price"> - </span>
<?php endif ?>
<?php if((xss_cleaner($row4->deal_original_stock)-xss_cleaner($row4->deal_current_stock)) == 0 && (xss_cleaner($row5->deal_original_stock)-xss_cleaner($row5->deal_current_stock)) == 0) : ?>
                        <span class="deal deal_sold">NONE</span>
<?php else : ?>
                        <span class="deal deal_sold"><?php echo number_format((xss_cleaner($row4->deal_original_stock)-xss_cleaner($row4->deal_current_stock))+(xss_cleaner($row5->deal_original_stock)-xss_cleaner($row5->deal_current_stock))); ?></span>
<?php endif ?>
<?php if(xss_cleaner($row4->deal_returned) == 0 && xss_cleaner($row5->deal_returned) == 0) : ?>
                        <span class="deal deal_returned">NONE</span>
<?php else : ?>
                        <span class="deal deal_returned"><?php echo number_format(xss_cleaner($row4->deal_returned)+xss_cleaner($row5->deal_returned)); ?></span>
<?php endif ?>
<?php if(xss_cleaner($row4->deal_current_stock) == 0 && htmlentities($row5->deal_current_stock) == 0) : ?>
                        <span class="deal deal_stock">SOLD</span>
<?php else : ?> 
                        <span class="deal deal_stock"><?php echo number_format(xss_cleaner($row4->deal_current_stock)+xss_cleaner($row5->deal_current_stock)); ?></span>
<?php endif ?>
<?php if($this->session->userdata('user_level') == 1 || $this->session->userdata('user_level') == 0) : ?>
<?php if($timer_date <= $this->uri->segment(4) && $timer_date <= $this->uri->segment(5) || $timer_date <= xss_cleaner($row1->deal_view_end)) : ?>
                        <span id="green" class="deal deal_remittance">On Progress</span>
<?php else : ?>
<?php if($NPFM == 0) : ?>
                        <span class="deal deal_remittance">NONE</span>
<?php else : ?>
<?php if(xss_cleaner($row1->deal_status) == "Finished") : ?>
<?php foreach($sql10 as $row10) : ?>
                        <span id="blue" class="deal deal_remittance"><?php echo number_format($row10->payment_amount); ?></span>
<?php endforeach ?>
<?php else : ?>
                        <span id="red" class="deal deal_remittance"><?php echo number_format($NPFM); ?></span>
<?php endif ?>
<?php endif ?>
<?php endif ?>
<?php endif ?>
                        <span <?php if($timer_date >= xss_cleaner($row1->deal_view_due)) : ?>id="red"<?php endif ?> class="deal deal_due"><?php echo date("m/" . $d . "/" . $y, strtotime(date("m/" . $d . "/" . $y, xss_cleaner($row1->deal_view_due)))); ?></span> 
                        <span class="deal deal_end"><?php echo date("m/" . $d . "/" . $y, xss_cleaner($row1->deal_view_end)); ?></span> 
                    </td>
                    <td>
<?php if($this->session->userdata('user_level') == 1 || $this->session->userdata('user_level') == 0) : ?>
<?php if(xss_cleaner($row1->deal_status) == "Finished") : ?>
<?php foreach($sql10 as $row10) : ?>
                        <a onclick="return c_view('<?php echo payment_summary_view(xss_cleaner($row2->company_name), xss_cleaner($row10->deal_view_title), $row10->payment_amount, date("m/" . $d . "/" . $y, strtotime(date("m/" . $d . "/" . $y, xss_cleaner($row1->deal_view_due)))), date("m/" . $d . "/" . $y, strtotime(date("m/" . $d . "/" . $y, xss_cleaner($row10->date_paid)))), xss_cleaner($row10->receipt_no), $row10->account_no, xss_cleaner($row10->bank_name)); ?>')">
                            <img id="icn_search" src="assets/admin/images/icn_search.png" title="View Payment">
                        </a>
<?php endforeach ?>
<?php elseif($timer_date <= $this->uri->segment(4) && $timer_date <= $this->uri->segment(5) || $timer_date <= xss_cleaner($row1->deal_view_end) || $NPFM == 0) : ?>
<?php else : ?>
                        <a href="<?php echo base_url() . "admin/admin_accounting/managePayment/" . $this->uri->segment(4) . "/" . $this->uri->segment(5) . "/" . xss_cleaner($row1->deal_hash); ?>">
                            <img id="icn_edit" src="assets/admin/images/icn_edit.png" title="Manage Payment">
                        </a> 
<?php endif ?>
<?php endif ?>
                    </td>
                </tr>
<?php endforeach ?>                                         
<?php endforeach ?>                                         
<?php $show_count = $show_count+1; ?>
<?php endforeach ?> 
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
        <br>
    </article>
</div>