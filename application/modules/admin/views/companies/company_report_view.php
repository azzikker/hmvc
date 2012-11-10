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
<?php foreach($sql9 as $row9): ?>
<?php $c_encrypt = ((htmlentities($row9->company_id))*8)+8; ?>
<?php $c_decrypt = (($c_encrypt)-8)/8; ?>
<?php $c_encrypt_count = strlen($c_encrypt); ?>
<?php $company_id_hash = md5(time() . "" . $c_encrypt . "" . time() . "" . $c_decrypt) . "" . time() . "" . $c_encrypt; ?>
<form action="<?php echo base_url(); ?>admin/admin_companies/editCompany/<?php echo $this->uri->segment(4); ?>/<?php echo $this->uri->segment(5); ?>" method="post" enctype="multipart/form-data">
    <article class="module width_full">
        <header><h3>Company Reports - <?php echo $row9->company_name; ?></h3></header> 
            <div id="div_halffield" align="left" style="margin: 20px;">
                <fieldset id="deal_halffield">
                    <b><?php echo $row9->company_name; ?></b><p>
                    <div id="deal_li"><b>E-mail</b></div>
                    <div class = "deal_li"><?php echo $row9->company_email; ?></div>
                    <div id="deal_li"><b>Address</b></div>
                    <div class = "deal_li"><?php echo $row9->company_address; ?></div>
                    <div style="padding: 5px; text-align: right; margin: 2px;">
                        <a href="<?php echo base_url(); ?>admin/admin_companies/profileCompany/<?php echo $c_encrypt_count; ?>/<?php echo $company_id_hash; ?>/current">View Full Information</a>
                    </div>
                </fieldset>
            </div>
            <div style="margin: 20px;">
                <article class="module width_full">
                    <header>
                        <h3 class="tabs_involved">Deals</h3>
<!-- ADDED TABS
                        <ul class="tabs">
                            <li><a href="<?php echo base_url().'admin/admin_companies/reportCompany/'.$c_encrypt_count.'/'.$company_id_hash?>">Current</a></li>
                            <li><a href="<?php echo base_url().'admin/admin_companies/reportCompany/'.$c_encrypt_count.'/'.$company_id_hash.'/deals_past'?>">Past</a></li>
                            <li><a href="<?php echo base_url().'admin/admin_companies/reportCompany/'.$c_encrypt_count.'/'.$company_id_hash.'/deals_future'?>">Future</a></li>
                        </ul>
END TABS-->
                    </header>
                    <table style="font-size: 10px" id="datagrid" style="border: 1px solid #ccc;" cellspacing="0" width="100%">
                        <thead>
                            <tr align="left">
                                <th id = "table_spacing" title="Transaction Reference No.">TR No.</th>
                                <th>Deal Title</th>
                                <th>Deal Category</th>
                                <th>Deal Type</th>
                                <th>Date Duration</th>
<!--added deal status-->
                                <th>DEAL STATUS</th>
<!--end deal status-->
                                <th align="right">Price</th>
                                <th align="right">Sold</th>                                     
                                <th align="right">Returns</th>
                                <th align="right" <?php if($this->session->userdata("user_level") == 3) : ?>style="padding-right: 10px;"<?php endif ?>>Stock</th>
<?php if($this->session->userdata("user_level") == 1 || $this->session->userdata("user_level") == 0) : ?>
                                <th align="right">Remittance</th>
                                <th align="right" style="padding-right: 10px;">Income</th>
<?php elseif($this->session->userdata("user_level") == 2) : ?>
                                <th align="right" <?php if($this->session->userdata("user_level") == 2) : ?>style="padding-right: 10px;"<?php endif ?>>Remittance</th>
<?php endif ?>
                            </tr>
                        </thead>  
                        <tbody id = 'info_grid'>
<?php $totalNPFM = 0; $totalINCOME = 0; ?>
<?php foreach($sql2 as $row2): ?>
<?php $table0 = "deal_category"; $where0['category_id'] = htmlentities($row2->category_id); ?>
<?php $sql0 = $this->db->get_where($table0,$where0); ?>
<?php $table1 = "deals"; $where1['deal_hash'] = htmlentities($row2->deal_hash); ?>
<?php $this->db->select_sum('deal_original_stock'); $this->db->select_sum('deal_current_stock'); ?>
<?php $this->db->select_sum('deal_discounted_price'); $this->db->select_sum('deal_returned'); ?>
<?php $sql1 = $this->db->get_where($table1, $where1); ?>
<?php $sql3 = $this->Deals_Model->displaySelected($table1, $where1); ?>
<?php $table6 = "deal_option"; ?>
<?php $this->db->select_sum('deal_original_stock'); $this->db->select_sum('deal_current_stock'); ?>
<?php $this->db->select_sum('deal_returned'); ?>
<?php $sql6 = $this->db->get_where($table6, $where1); ?>
<?php $deal_title = shortenString($row2->deal_view_title, 25); ?>
<?php /*date format*/ $m = "%m"; $d = "%d"; $y = "%Y"; ?>
                            <tr align="left" title="<?php echo $row2->deal_view_title; ?>">
                                <td id = "table_spacing"><?php echo str_replace("10", "", printf("%010s", htmlentities($row2->deal_view_id))); ?></td>        
                                <td><?php echo $deal_title[0]; ?></td>          
<?php foreach($sql0->result() as $row0): ?>
                                <td><?php echo htmlentities($row0->category_name); ?></td>
<?php endforeach ?>
                                <td><?php echo htmlentities($row2->deal_view_type); ?></td>
                                <td><?php echo strftime(" " . $m . "/" . $d . "/" . $y, htmlentities($row2->deal_view_start)); ?> - <?php echo strftime(" " . $m . "/" . $d . "/" . $y, htmlentities($row2->deal_view_end)); ?></td>
                                <!--added status column-->
                                <td>
                                    <?php
                                        if(time() < $row2->deal_view_start)
                                        {
                                            echo htmlentities('Future');
                                        }
                                        elseif(time() > $row2->deal_view_start && time() < $row2->deal_view_end)
                                        {
                                            echo  htmlentities('current');
                                        }
                                        elseif(time() > $row2->deal_view_end)
                                        {
                                            echo  htmlentities('past');
                                        }
                                        else
                                        {
                                            echo  htmlentities('error');
                                        }
                                    ?>
                                </td>
                                 <!--end status column-->
<?php foreach($sql1->result() as $row1) : ?>
<?php if(htmlentities($row2->deal_view_type) == "Single Deal") : ?>
                                <td align="right"><?php echo number_format(htmlentities($row1->deal_discounted_price)); ?></td>
<?php else : ?>
                                <td align="right">-</td>
<?php endif ?>
<?php endforeach ?>
                                <td align="right">
<?php foreach($sql6->result() as $row6) : ?>
<?php if(htmlentities($row2->deal_view_type) == "Single Deal") : ?>
<?php if(htmlentities($row2->deal_current_stock) == 0) : ?>
                        <?php echo number_format((htmlentities($row2->deal_original_stock) - htmlentities($row2->deal_current_stock))+(htmlentities($row6->deal_original_stock) - htmlentities($row6->deal_current_stock))); ?>
<?php else : ?>
<?php if(htmlentities($row2->deal_original_stock) - htmlentities($row2->deal_current_stock) == 0) : ?>
                        NONE
<?php else : ?>
                        <?php echo number_format(htmlentities($row2->deal_original_stock) - htmlentities($row2->deal_current_stock)); ?>
<?php endif ?>
<?php endif ?>
<?php else : ?>
<?php if(htmlentities($row6->deal_current_stock) == 0) : ?>
                        <?php echo number_format((htmlentities($row1->deal_original_stock) - htmlentities($row1->deal_current_stock))+(htmlentities($row6->deal_original_stock) - htmlentities($row6->deal_current_stock))); ?>
<?php else : ?>
<?php if(htmlentities($row6->deal_original_stock) - htmlentities($row6->deal_current_stock) == 0) : ?>
                        NONE
<?php else : ?>                                                                                                 
                        <?php echo number_format((htmlentities($row1->deal_original_stock) - htmlentities($row1->deal_current_stock))+(htmlentities($row6->deal_original_stock) - htmlentities($row6->deal_current_stock))); ?>
<?php endif ?> 
<?php endif ?>
<?php endif ?>
<?php endforeach ?>
                                </td>
<?php foreach($sql6->result() as $row6) : ?>
<?php if(htmlentities($row2->deal_option) == 0) : ?>
<?php if(htmlentities($row6->deal_returned) == 0) : ?>
                                <td align="right">NONE</td>
<?php else : ?>
                                <td align="right"><?php echo number_format(htmlentities($row1->deal_returned) + htmlentities($row6->deal_returned)); ?></td>
<?php endif ?>
<?php else : ?>
<?php if(htmlentities($row1->deal_returned) == 0) : ?>
                                <td align="right">NONE</td>
<?php else : ?>
                                <td align="right"><?php echo number_format(htmlentities($row1->deal_returned) + htmlentities($row6->deal_returned)); ?></td>
<?php endif ?>                    
<?php endif ?>
<?php endforeach ?> 
<?php foreach($sql1->result() as $row1) : ?>
<?php foreach($sql6->result() as $row6) : ?>
<?php if(htmlentities($row2->deal_option) == 0) : ?>
<?php if(htmlentities($row6->deal_current_stock) == 0) : ?>
                                <td align="right" <?php if($this->session->userdata("user_level") == 3) : ?>style="padding-right: 10px;"<?php endif ?>><b><font color="green">SOLD!</font></b></td>
<?php else : ?> 
                                <td align="right" <?php if($this->session->userdata("user_level") == 3) : ?>style="padding-right: 10px;"<?php endif ?>><?php echo number_format(htmlentities($row1->deal_current_stock) + htmlentities($row6->deal_current_stock)); ?></td>
<?php endif ?>
<?php else : ?>
<?php if(htmlentities($row1->deal_current_stock) == 0) : ?>
                                <td align="right" <?php if($this->session->userdata("user_level") == 3) : ?>style="padding-right: 10px;"<?php endif ?>><b><font color="green">SOLD!</font></b></td>
<?php else : ?> 
                                <td align="right" <?php if($this->session->userdata("user_level") == 3) : ?>style="padding-right: 10px;"<?php endif ?>><?php echo number_format(htmlentities($row1->deal_current_stock) + htmlentities($row6->deal_current_stock)); ?></td>
<?php endif ?>
<?php endif ?> 
<?php endforeach ?>
<?php endforeach ?>
<?php $sp = htmlentities($row1->deal_discounted_price); $x = 25/100; ?>
<?php foreach($sql6->result() as $row6) : ?>
<?php if(htmlentities($row2->deal_view_type) == "Single Deal") : ?>
<?php $tf = (htmlentities($row1->deal_original_stock) - htmlentities($row1->deal_current_stock)) + (htmlentities($row6->deal_original_stock) - htmlentities($row6->deal_current_stock)); $nr = htmlentities($row1->deal_returned) + htmlentities($row6->deal_returned); ?>           
<?php $NPFM = npfm($sp, $x, $tf, $nr); $TOTAL_A = total_a($sp, $tf, $nr); $INCOME = income($TOTAL_A, $NPFM); ?>
<?php if($this->session->userdata("user_level") == 1 || $this->session->userdata("user_level") == 0) : ?>
                                <td align="right" <?php if($this->session->userdata("user_level") == 2) : ?>style="padding-right: 10px;"<?php endif ?>><?php echo number_format($NPFM); ?></td>
                                <td align="right" style="padding-right: 10px;"><?php echo number_format($INCOME); ?></td>
<?php elseif($this->session->userdata("user_level") == 2) : ?>
                                <td align="right" <?php if($this->session->userdata("user_level") == 2) : ?>style="padding-right: 10px;"<?php endif ?>><?php echo number_format($NPFM); ?></td> 
<?php endif ?>  
<?php else : ?>
<?php foreach($sql1->result() as $row1) : ?> 
<?php $tf = (htmlentities($row1->deal_original_stock) - htmlentities($row1->deal_current_stock)) + (htmlentities($row6->deal_original_stock) - htmlentities($row6->deal_current_stock)); $nr = htmlentities($row1->deal_returned) + htmlentities($row6->deal_returned); ?>
<?php $NPFM = npfm($sp, $x, $tf, $nr); $TOTAL_A = total_a($sp, $tf, $nr); $INCOME = income($TOTAL_A, $NPFM); ?>
<?php if($this->session->userdata("user_level") == 1 || $this->session->userdata("user_level") == 0) : ?>
                                <td align="right" <?php if($this->session->userdata("user_level") == 2) : ?>style="padding-right: 10px;"<?php endif ?>><?php echo number_format($NPFM); ?></td>
                                <td align="right" style="padding-right: 10px;"><?php echo number_format($INCOME); ?></td>
<?php elseif($this->session->userdata("user_level") == 2) : ?>
                                <td align="right" <?php if($this->session->userdata("user_level") == 2) : ?>style="padding-right: 10px;"<?php endif ?>><?php echo number_format($NPFM); ?></td> 
<?php endif ?>                  
<?php endforeach ?> 
<?php endif ?>
<?php endforeach ?>
                            </tr>
<?php foreach($sql3 as $row3) : ?>
<?php if(htmlentities($row2->deal_view_type)=="Group Deal") : ?> 
<?php $deal_title = shortenString($row3->deal_title, 30); ?>
                            <tr id="sub_deal" title="<?php echo htmlentities($row3->deal_title); ?>">
                                <td id = "table_spacing"></td>
                                <td><?php echo $deal_title[0]; ?></td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td align="right"><?php echo number_format(htmlentities($row3->deal_discounted_price)); ?></td>
<?php if(htmlentities($row3->deal_option) == 1) : ?>
<?php if(htmlentities($row3->deal_original_stock) - htmlentities($row3->deal_current_stock) == 0) : ?>
                                <td align="right">NONE</td>
<?php else : ?>
<?php if(htmlentities($row3->deal_current_stock) == 0) : ?>
                                <td align="right"><?php echo number_format(htmlentities($row3->deal_original_stock) - htmlentities($row3->deal_current_stock)); ?></td>
<?php else : ?>
                                <td align="right"><?php echo number_format(htmlentities($row3->deal_original_stock) - htmlentities($row3->deal_current_stock)); ?></td>
<?php endif ?> 
<?php endif ?>                                                       
<?php else : //?>
<?php $table8 = "deal_selection"; $table7 = "deal_option"; $where2['deal_subhash'] = htmlentities($row3->deal_subhash); ?>
<?php $sql8 = $this->db->get_where($table8, $where2); ?>
<?php foreach($sql8->result() as $row8) : ?>  
<?php $where3['selection_hash'] = htmlentities($row8->selection_hash); ?>
<?php $this->db->select_sum('deal_original_stock'); $this->db->select_sum('deal_current_stock'); $this->db->select_sum('deal_returned'); ?>
<?php $sql7 = $this->db->get_where($table7, $where3); ?>
<?php foreach($sql7->result() as $row7) : ?>
<?php if(htmlentities($row7->deal_original_stock) - htmlentities($row7->deal_current_stock) == 0) : ?>
                                <td align="right">NONE</td>
<?php else : ?>
<?php if(htmlentities($row7->deal_current_stock) == 0) : ?>
                                <td align="right"><?php echo number_format(htmlentities($row7->deal_original_stock) - htmlentities($row7->deal_current_stock)); ?></td>
<?php else : ?>
                                <td align="right"><?php echo number_format(htmlentities($row7->deal_original_stock) - htmlentities($row7->deal_current_stock)); ?></td>
<?php endif ?>                                                                                                          
<?php endif ?>
<?php endforeach ?>
<?php endforeach ?>
<?php endif ?>
<?php if(htmlentities($row3->deal_option) == 1) : ?>
<?php if(htmlentities($row3->deal_returned) == 0) : ?>
                                <td align="right">NONE</td>
<?php else : ?>
                                <td align="right"><?php echo number_format(htmlentities($row3->deal_returned)); ?></td>
<?php endif ?>                                              
<?php else : // ?>
<?php foreach($sql7->result() as $row7) : ?>
<?php if(htmlentities($row7->deal_returned) == 0) : ?>
                                <td align="right">NONE</td>
<?php else : ?>
                                <td align="right"><?php echo number_format(htmlentities($row7->deal_returned)); ?></td>
<?php endif ?>
<?php endforeach ?>
<?php endif ?>
<?php if(htmlentities($row3->deal_option) == 1) : ?> 
<?php if(htmlentities($row3->deal_current_stock) == 0) : ?>
                                <td align="right" <?php if($this->session->userdata("user_level") == 3) : ?>style="padding-right: 10px;"<?php endif ?>><b><font color="green">SOLD!</font></b></td> 
<?php else : ?>
                                <td align="right" <?php if($this->session->userdata("user_level") == 3) : ?>style="padding-right: 10px;"<?php endif ?>><?php echo number_format(htmlentities($row3->deal_current_stock)); ?></td>
<?php endif ?>
<?php else : ?>
<?php foreach($sql7->result() as $row7) : ?>
<?php if(htmlentities($row7->deal_current_stock) == 0) : ?>
                                <td align="right" <?php if($this->session->userdata("user_level") == 3) : ?>style="padding-right: 10px;"<?php endif ?>><b><font color="green">SOLD!</font></b></td> 
<?php else : ?>
                                <td align="right" <?php if($this->session->userdata("user_level") == 3) : ?>style="padding-right: 10px;"<?php endif ?>><?php echo number_format(htmlentities($row7->deal_current_stock)); ?></td>
<?php endif ?>
<?php endforeach ?>
<?php endif ?> 
<?php if(htmlentities($row3->deal_option) == 1) : ?>                                                                              
<?php $subtf = htmlentities($row3->deal_original_stock) - htmlentities($row3->deal_current_stock); ?>
<?php $subnr = htmlentities($row3->deal_returned); ?>
<?php $subNPFM = npfm($sp, $x, $subtf, $subnr); $TOTAL_A = total_a($sp, $subtf, $subnr); $subINCOME = income($TOTAL_A, $subNPFM); ?>
<?php if($this->session->userdata("user_level") == 1 || $this->session->userdata("user_level") == 0) : ?>
                                <td align="right" <?php if($this->session->userdata("user_level") == 2) : ?>style="padding-right: 10px;"<?php endif ?>><?php echo number_format($subNPFM); ?></td>
                                <td align="right" style="padding-right: 10px;"><?php echo number_format($subINCOME); ?></td>
<?php elseif($this->session->userdata("user_level") == 2) : ?>
                                <td align="right" <?php if($this->session->userdata("user_level") == 2) : ?>style="padding-right: 10px;"<?php endif ?>><?php echo number_format($subNPFM); ?></td>
<?php endif ?>
<?php else : ?>
<?php foreach($sql7->result() as $row7) : ?>
<?php $subtf = htmlentities($row7->deal_original_stock) - htmlentities($row7->deal_current_stock); ?>
<?php $subnr = htmlentities($row7->deal_returned); ?>
<?php $subNPFM = npfm($sp, $x, $subtf, $subnr); $TOTAL_A = total_a($sp, $subtf, $subnr); $subINCOME = income($TOTAL_A, $subNPFM); ?>
<?php if($this->session->userdata("user_level") == 1 || $this->session->userdata("user_level") == 0) : ?>
                                <td align="right" <?php if($this->session->userdata("user_level") == 2) : ?>style="padding-right: 10px;"<?php endif ?>><?php echo number_format($subNPFM); ?></td>
                                <td align="right" style="padding-right: 10px;"><?php echo number_format($subINCOME); ?></td>
<?php elseif($this->session->userdata("user_level") == 2) : ?>
                                <td align="right" <?php if($this->session->userdata("user_level") == 2) : ?>style="padding-right: 10px;"<?php endif ?>><?php echo number_format($subNPFM); ?></td>
<?php endif ?>
<?php endforeach ?>
<?php endif ?> 
                            </tr>
<?php endif ?>
<?php endforeach ?>
<?php $totalNPFM = $totalNPFM+$NPFM; $totalINCOME = $totalINCOME+$INCOME; ?>
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
<?php if($this->session->userdata("user_level") == 1 || $this->session->userdata("user_level") == 0) : ?> 
                            <tr>
                                <td colspan=100>
                                    <div style="margin: 20px;">
                                        <fieldset>
                                            <div id="deal_li"><b>Total Remittance</b></div>
                                            <div class = "deal_li"><?php echo number_format($totalNPFM); ?></div>
                                            <div id="deal_li"><b>Total Income</b></div>
                                            <div class = "deal_li"><?php echo number_format($totalINCOME); ?></div>
                                        </fieldset> 
                                    </div>
                                </td>
                            </tr>
<?php elseif($this->session->userdata("user_level") == 2) : ?>
                            <tr>
                                <td colspan=100>
                                    <div style="margin: 20px;">
                                        <fieldset>
                                            <div id="deal_li"><b>Total Remittance</b></div>
                                            <div class = "deal_li"><?php echo number_format($totalNPFM); ?></div>
                                        </fieldset> 
                                    </div>
                                </td>
                            </tr>
<?php endif ?>
                        </tfoot>
                    </table>
                </article>
                <div style="text-align: right;">
                    <fieldset>
                        <input type="button" value="Back" onclick="window.history.back();">
                        <input type="button" value="Print Preview" onclick="showPrint()">
                    </fieldset>
                </div>
            </div>
    </article>
</form>          
<?php endforeach ?>
</div>

<!-- PRINT PREVIEW -->
<div class = "print_member" style="display: none; font-family: "Helvetica Neue", Helvetica, Arial, Verdana, sans-serif; font-size: 10px;">
<?php foreach($sql9 as $row9): ?>
<?php $c_encrypt = ((htmlentities($row9->company_id))*8)+8; ?>
<?php $c_decrypt = (($c_encrypt)-8)/8; ?>
<?php $c_encrypt_count = strlen($c_encrypt); ?>
<?php $company_id_hash = md5(time() . "" . $c_encrypt . "" . time() . "" . $c_decrypt) . "" . time() . "" . $c_encrypt; ?>
    <article class="module width_full" style="width: 1100px;">
        <header><h3>Company Reports - <?php echo $row9->company_name; ?></h3></header>
            <div id="printN">
                <div id="div_halffield" align="left" style="margin: 20px;">
                    <div class="div_header_3x">
                        <div id="deal_li"><b>COMPANY</b></div>
                        <div class = "deal_li"><?php echo $row9->company_name; ?></div>
                        <div id="deal_li"><b>E-MAIL</b></div>
                        <div class = "deal_li"><?php echo $row9->company_email; ?></div>
                        <div id="deal_li"><b>ADDRESS</b></div>
                        <div class = "deal_li"><?php echo $row9->company_address; ?></div>
                    </div>
                </div>
                <div id="div_halffield" align="left" style="margin: 20px;">
                    <h4 class="tabs_involved">DEALS</h4>
                    <div class="div_body">
                        <table style="font-size: 11px" style="border: 1px solid #ccc;" cellspacing="0" width="100%">
                            <thead class="print_header" style="/*height: 30px; vertical-align: top;*/">
                                <tr class="print_tr">
                                    <th id = "table_spacing" class="print_th" title="Transaction Reference No.">TR No.</th>
                                    <th class="print_th">DEAL TITLE</th>
                                    <th class="print_th">DEAL CATEGORY</th>
                                    <th class="print_th">DEAL TYPE</th>
                                    <th class="print_th">DEAL DURATION</th>

                                    <th class="print_th">PRICE</th>
                                    <th class="print_th">SOLD</th>                                     
                                    <th class="print_th">RETURNS</th>
                                    <th class="print_th">STOCK</th>
<?php if($this->session->userdata("user_level") == 1 || $this->session->userdata('user_level') == 0) : ?>
                                    <th class="print_th">REMITTANCE</th>
                                    <th class="print_th">INCOME</th>
<?php elseif($this->session->userdata("user_level") == 2) : ?>
                                <th class="print_th" align="right">REMITTANCE</th>
<?php endif ?>
                                </tr>
                            </thead> 
                            <tbody id ="info_grid" class="print_body">
<?php $totalNPFM = 0; $totalINCOME = 0; ?>
<?php foreach($sql2 as $row2): ?>
<?php $table0 = "deal_category"; $where0['category_id'] = htmlentities($row2->category_id); ?>
<?php $sql0 = $this->db->get_where($table0,$where0); ?>
<?php $table1 = "deals"; $where1['deal_hash'] = htmlentities($row2->deal_hash); ?>
<?php $this->db->select_sum('deal_original_stock'); $this->db->select_sum('deal_current_stock'); ?>
<?php $this->db->select_sum('deal_discounted_price'); $this->db->select_sum('deal_returned'); ?>
<?php $sql1 = $this->db->get_where($table1, $where1); ?>
<?php $sql3 = $this->Deals_Model->displaySelected($table1, $where1); ?>
<?php $table6 = "deal_option"; ?>
<?php $this->db->select_sum('deal_original_stock'); $this->db->select_sum('deal_current_stock'); ?>
<?php $this->db->select_sum('deal_returned'); ?>
<?php $sql6 = $this->db->get_where($table6, $where1); ?>
<?php /*date format*/ $m = "%m"; $d = "%d"; $y = "%Y"; ?>
                                <tr class="print_tr" align="left" title="<?php echo $row2->deal_view_title; ?>"  style="/*height: 20px; vertical-align: top;*/">
                                    <td id = "table_spacing" class="print_td"><b><?php echo str_replace("10", "", printf("%010s", htmlentities($row2->deal_view_id))); ?></b></td>        
                                    <td class="print_td"><b><?php echo $row2->deal_view_title; ?></td>          
<?php foreach($sql0->result() as $row0): ?>
                                    <td class="print_td"><b><?php echo htmlentities($row0->category_name); ?></b></td>
<?php endforeach ?>
                                    <td class="print_td"><b><?php echo htmlentities($row2->deal_view_type); ?></b></td>
                                    <td class="print_td"><b><?php echo strftime(" " . $m . "/" . $d . "/" . $y, htmlentities($row2->deal_view_start)); ?> - <?php echo strftime(" " . $m . "/" . $d . "/" . $y, htmlentities($row2->deal_view_end)); ?></b></td>
<?php foreach($sql1->result() as $row1) : ?>
<?php if(htmlentities($row2->deal_view_type) == "Single Deal") : ?>
                                    <td class="print_td" align="right" style="padding-right: 10px;"><b><?php echo number_format(htmlentities($row1->deal_discounted_price)); ?></b></td>
<?php else : ?>
                                    <td class="print_td" align="right" style="padding-right: 10px;"><b>-</b></td>
<?php endif ?>
<?php endforeach ?>
                                    <td class="print_td" align="right" style="padding-right: 10px;">
<?php foreach($sql6->result() as $row6) : ?>
<?php if(htmlentities($row2->deal_view_type) == "Single Deal") : ?>
<?php if(htmlentities($row2->deal_current_stock) == 0) : ?>
                            <b><?php echo number_format((htmlentities($row2->deal_original_stock) - htmlentities($row2->deal_current_stock))+(htmlentities($row6->deal_original_stock) - htmlentities($row6->deal_current_stock))); ?></b>
<?php else : ?>
<?php if(htmlentities($row2->deal_original_stock) - htmlentities($row2->deal_current_stock) == 0) : ?>
                            <b>NONE</b>
<?php else : ?>
                            <b><?php echo number_format(htmlentities($row2->deal_original_stock) - htmlentities($row2->deal_current_stock)); ?></b>
<?php endif ?>
<?php endif ?>
<?php else : ?>
<?php if(htmlentities($row6->deal_current_stock) == 0) : ?>
                            <b><?php echo number_format((htmlentities($row1->deal_original_stock) - htmlentities($row1->deal_current_stock))+(htmlentities($row6->deal_original_stock) - htmlentities($row6->deal_current_stock))); ?></b>
<?php else : ?>
<?php if(htmlentities($row6->deal_original_stock) - htmlentities($row6->deal_current_stock) == 0) : ?>
                            <b>NONE</b>
<?php else : ?>                                                                                                 
                            <b><?php echo number_format((htmlentities($row1->deal_original_stock) - htmlentities($row1->deal_current_stock))+(htmlentities($row6->deal_original_stock) - htmlentities($row6->deal_current_stock))); ?></b>
<?php endif ?> 
<?php endif ?>
<?php endif ?>
<?php endforeach ?>
                                    </td>
<?php foreach($sql6->result() as $row6) : ?>
<?php if(htmlentities($row2->deal_option) == 0) : ?>
<?php if(htmlentities($row6->deal_returned) == 0) : ?>
                                    <td class="print_td" align="right" style="padding-right: 10px;"><b>NONE</b></td>
<?php else : ?>
                                    <td class="print_td" align="right" style="padding-right: 10px;"><b><?php echo number_format(htmlentities($row1->deal_returned) + htmlentities($row6->deal_returned)); ?></b></td>
<?php endif ?>
<?php else : ?>
<?php if(htmlentities($row1->deal_returned) == 0) : ?>
                                    <td class="print_td" align="right" style="padding-right: 10px;"><b>NONE</b></td>
<?php else : ?>
                                    <td class="print_td" align="right" style="padding-right: 10px;"><b><?php echo number_format(htmlentities($row1->deal_returned) + htmlentities($row6->deal_returned)); ?></b></td>
<?php endif ?>                    
<?php endif ?>
<?php endforeach ?> 
<?php foreach($sql1->result() as $row1) : ?>
<?php foreach($sql6->result() as $row6) : ?>
<?php if(htmlentities($row2->deal_option) == 0) : ?>
<?php if(htmlentities($row6->deal_current_stock) == 0) : ?>
                                    <td class="print_td" align="right" style="padding-right: 10px;" <?php if($this->session->userdata("user_level") == 3 || $this->session->userdata('user_level') == 0) : ?>style="padding-right: 10px;"<?php endif ?>><b><font color="green">SOLD!</font></b></td>
<?php else : ?> 
                                    <td class="print_td" align="right" style="padding-right: 10px;" <?php if($this->session->userdata("user_level") == 3 || $this->session->userdata('user_level') == 0) : ?>style="padding-right: 10px;"<?php endif ?>><b><?php echo number_format(htmlentities($row1->deal_current_stock) + htmlentities($row6->deal_current_stock)); ?></b></td>
<?php endif ?>
<?php else : ?>
<?php if(htmlentities($row1->deal_current_stock) == 0) : ?>
                                    <td class="print_td" align="right" style="padding-right: 10px;" <?php if($this->session->userdata("user_level") == 3 || $this->session->userdata('user_level') == 0) : ?>style="padding-right: 10px;"<?php endif ?>><b><font color="green">SOLD!</font></b></td>
<?php else : ?> 
                                    <td class="print_td" align="right" style="padding-right: 10px;" <?php if($this->session->userdata("user_level") == 3 || $this->session->userdata('user_level') == 0) : ?>style="padding-right: 10px;"<?php endif ?>><b><?php echo number_format(htmlentities($row1->deal_current_stock) + htmlentities($row6->deal_current_stock)); ?></b></td>
<?php endif ?>
<?php endif ?> 
<?php endforeach ?>
<?php endforeach ?>
<?php $sp = htmlentities($row1->deal_discounted_price); $x = $webcall/100; ?>
<?php foreach($sql6->result() as $row6) : ?>
<?php if(htmlentities($row2->deal_view_type) == "Single Deal") : ?>
<?php $tf = (htmlentities($row1->deal_original_stock) - htmlentities($row1->deal_current_stock)) + (htmlentities($row6->deal_original_stock) - htmlentities($row6->deal_current_stock)); $nr = htmlentities($row1->deal_returned) + htmlentities($row6->deal_returned); ?>           
<?php $NPFM = npfm($sp, $x, $tf, $nr); $TOTAL_A = total_a($sp, $tf, $nr); $INCOME = income($TOTAL_A, $NPFM); ?>
<?php if($this->session->userdata("user_level") == 1 || $this->session->userdata('user_level') == 0) : ?>
                                    <td class="print_td" align="right" <?php if($this->session->userdata("user_level") == 2 || $this->session->userdata('user_level') == 0) : ?>style="padding-right: 10px;"<?php endif ?>><b><?php echo number_format($NPFM); ?></b></td>
                                    <td class="print_td" align="right" style="padding-right: 10px;"><b><?php echo number_format($INCOME); ?><b></td>
<?php elseif($this->session->userdata("user_level") == 2) : ?>
                                    <td class="print_td" align="right" <?php if($this->session->userdata("user_level") == 2) : ?>style="padding-right: 10px;"<?php endif ?>><b><?php echo number_format($NPFM); ?></b></td> 
<?php endif ?>  
<?php else : ?>
<?php foreach($sql1->result() as $row1) : ?> 
<?php $tf = (htmlentities($row1->deal_original_stock) - htmlentities($row1->deal_current_stock)) + (htmlentities($row6->deal_original_stock) - htmlentities($row6->deal_current_stock)); $nr = htmlentities($row1->deal_returned) + htmlentities($row6->deal_returned); ?>
<?php $NPFM = npfm($sp, $x, $tf, $nr); $TOTAL_A = total_a($sp, $tf, $nr); $INCOME = income($TOTAL_A, $NPFM); ?>
<?php if($this->session->userdata("user_level") == 1 || $this->session->userdata('user_level') == 0) : ?>
                                    <td class="print_td" align="right" <?php if($this->session->userdata("user_level") == 2 || $this->session->userdata('user_level') == 0) : ?>style="padding-right: 10px;"<?php endif ?>><b><?php echo number_format($NPFM); ?></b></td>
                                    <td class="print_td" align="right" style="padding-right: 10px;"><b><?php echo number_format($INCOME); ?></b></td>
<?php elseif($this->session->userdata("user_level") == 2) : ?>
                                    <td class="print_td" align="right" <?php if($this->session->userdata("user_level") == 2) : ?>style="padding-right: 10px;"<?php endif ?>><b><?php echo number_format($NPFM); ?></b></td> 
<?php endif ?>                  
<?php endforeach ?> 
<?php endif ?>
<?php endforeach ?>
                                </tr>
<?php foreach($sql3 as $row3) : ?>
<?php if(htmlentities($row2->deal_view_type)=="Group Deal") : ?> 
<?php $deal_title = shortenString(htmlentities($row3->deal_title), 30); ?>
                                <tr id="sub_print" class="print_tr" title="<?php echo htmlentities($row3->deal_title); ?>" style="height: 20px; vertical-align: top;">
                                    <td id = "table_spacing" class="print_td_none"><b></b></td>
                                    <td class="print_td"><?php echo $row3->deal_title; ?></td>
                                    <td class="print_td">-</td>
                                    <td class="print_td">-</td>
                                    <td class="print_td"  style="border-bottom: 1px solid #ccc;">-</td>
                                    <td class="print_td" align="right"style="padding-right: 10px;"><?php echo number_format(htmlentities($row3->deal_discounted_price)); ?></td>
<?php if(htmlentities($row3->deal_option) == 1) : ?>
<?php if(htmlentities($row3->deal_original_stock) - htmlentities($row3->deal_current_stock) == 0) : ?>
                                    <td class="print_td" align="right"style="padding-right: 10px;">NONE</td>
<?php else : ?>
<?php if(htmlentities($row3->deal_current_stock) == 0) : ?>
                                    <td class="print_td" align="right"style="padding-right: 10px;"><?php echo number_format(htmlentities($row3->deal_original_stock) - htmlentities($row3->deal_current_stock)); ?></td>
<?php else : ?>
                                    <td class="print_td" align="right"style="padding-right: 10px;"><?php echo number_format(htmlentities($row3->deal_original_stock) - htmlentities($row3->deal_current_stock)); ?></td>
<?php endif ?> 
<?php endif ?>                                                       
<?php else : //?>
<?php $table8 = "deal_selection"; $table7 = "deal_option"; $where2['deal_subhash'] = htmlentities($row3->deal_subhash); ?>
<?php $sql8 = $this->db->get_where($table8, $where2); ?>
<?php foreach($sql8->result() as $row8) : ?>  
<?php $where3['selection_hash'] = htmlentities($row8->selection_hash); ?>
<?php $this->db->select_sum('deal_original_stock'); $this->db->select_sum('deal_current_stock'); $this->db->select_sum('deal_returned'); ?>
<?php $sql7 = $this->db->get_where($table7, $where3); ?>
<?php foreach($sql7->result() as $row7) : ?>
<?php if(htmlentities($row7->deal_original_stock) - htmlentities($row7->deal_current_stock) == 0) : ?>
                                    <td class="print_td" align="right"style="padding-right: 10px;">NONE</td>
<?php else : ?>
<?php if(htmlentities($row7->deal_current_stock) == 0) : ?>
                                    <td class="print_td" align="right"style="padding-right: 10px;"><?php echo number_format(htmlentities($row7->deal_original_stock) - htmlentities($row7->deal_current_stock)); ?></td>
<?php else : ?>
                                    <td class="print_td" align="right"style="padding-right: 10px;"><?php echo number_format(htmlentities($row7->deal_original_stock) - htmlentities($row7->deal_current_stock)); ?></td>
<?php endif ?>                                                                                                          
<?php endif ?>
<?php endforeach ?>
<?php endforeach ?>
<?php endif ?>
<?php if(htmlentities($row3->deal_option) == 1) : ?>
<?php if(htmlentities($row3->deal_returned) == 0) : ?>
                                    <td class="print_td" align="right"style="padding-right: 10px;">NONE</td>
<?php else : ?>
                                    <td class="print_td" align="right"style="padding-right: 10px;"><?php echo number_format(htmlentities($row3->deal_returned)); ?></td>
<?php endif ?>                                              
<?php else : // ?>
<?php foreach($sql7->result() as $row7) : ?>
<?php if(htmlentities($row7->deal_returned) == 0) : ?>
                                    <td class="print_td" align="right"style="padding-right: 10px;">NONE</td>
<?php else : ?>
                                    <td class="print_td" align="right"style="padding-right: 10px;"><?php echo number_format(htmlentities($row7->deal_returned)); ?></td>
<?php endif ?>
<?php endforeach ?>
<?php endif ?>
<?php if(htmlentities($row3->deal_option) == 1) : ?> 
<?php if(htmlentities($row3->deal_current_stock) == 0) : ?>
                                    <td class="print_td" align="right" style="padding-right: 10px;" <?php if($this->session->userdata("user_level") == 3 || $this->session->userdata('user_level') == 0) : ?>style="padding-right: 10px;"<?php endif ?>><b><font color="green">SOLD!</font></b></td> 
<?php else : ?>
                                    <td class="print_td" align="right" style="padding-right: 10px;" <?php if($this->session->userdata("user_level") == 3 || $this->session->userdata('user_level') == 0) : ?>style="padding-right: 10px;"<?php endif ?>><?php echo number_format(htmlentities($row3->deal_current_stock)); ?></b></td>
<?php endif ?>
<?php else : ?>
<?php foreach($sql7->result() as $row7) : ?>
<?php if(htmlentities($row7->deal_current_stock) == 0) : ?>
                                    <td class="print_td" align="right" style="padding-right: 10px;" <?php if($this->session->userdata("user_level") == 3 || $this->session->userdata('user_level') == 0) : ?>style="padding-right: 10px;"<?php endif ?>><b><font color="green">SOLD!</font></b></td> 
<?php else : ?>
                                    <td class="print_td" align="right" style="padding-right: 10px;" <?php if($this->session->userdata("user_level") == 3 || $this->session->userdata('user_level') == 0) : ?>style="padding-right: 10px;"<?php endif ?>><b><?php echo number_format(htmlentities($row7->deal_current_stock)); ?></b></td>
<?php endif ?>
<?php endforeach ?>
<?php endif ?> 
<?php if(htmlentities($row3->deal_option) == 1) : ?>                                                                              
<?php $subtf = htmlentities($row3->deal_original_stock) - htmlentities($row3->deal_current_stock); ?>
<?php $subnr = htmlentities($row3->deal_returned); ?>
<?php $subNPFM = npfm($sp, $x, $subtf, $subnr); $TOTAL_A = total_a($sp, $subtf, $subnr); $subINCOME = income($TOTAL_A, $subNPFM); ?>
<?php if($this->session->userdata("user_level") == 1 || $this->session->userdata('user_level') == 0) : ?>
                                    <td class="print_td" align="right" <?php if($this->session->userdata("user_level") == 2 || $this->session->userdata('user_level') == 0) : ?>style="padding-right: 10px;"<?php endif ?>><b><?php echo number_format($subNPFM); ?></b></td>
                                    <td class="print_td" align="right" style="padding-right: 10px;"><?php echo number_format($subINCOME); ?></td>
<?php elseif($this->session->userdata("user_level") == 2) : ?>
                                    <td class="print_td" align="right" <?php if($this->session->userdata("user_level") == 2) : ?>style="padding-right: 10px;"<?php endif ?>><?php echo number_format($subNPFM); ?></td>
<?php endif ?>
<?php else : ?>
<?php foreach($sql7->result() as $row7) : ?>
<?php $subtf = htmlentities($row7->deal_original_stock) - htmlentities($row7->deal_current_stock); ?>
<?php $subnr = htmlentities($row7->deal_returned); ?>
<?php $subNPFM = npfm($sp, $x, $subtf, $subnr); $TOTAL_A = total_a($sp, $subtf, $subnr); $subINCOME = income($TOTAL_A, $subNPFM); ?>
<?php if($this->session->userdata("user_level") == 1 || $this->session->userdata('user_level') == 0) : ?>
                                    <td class="print_td" align="right" <?php if($this->session->userdata("user_level") == 2 || $this->session->userdata('user_level') == 0) : ?>style="padding-right: 10px;"<?php endif ?>><b><?php echo number_format($subNPFM); ?></b></td>
                                    <td class="print_td" align="right" style="padding-right: 10px;"><?php echo number_format($subINCOME); ?></td>
<?php elseif($this->session->userdata("user_level") == 2) : ?>
                                    <td class="print_td" align="right" <?php if($this->session->userdata("user_level") == 2) : ?>style="padding-right: 10px;"<?php endif ?>><?php echo number_format($subNPFM); ?></td>
<?php endif ?>
<?php endforeach ?>
<?php endif ?> 
                                </tr>
<?php endif ?>
<?php endforeach ?>
<?php $totalNPFM = $totalNPFM+$NPFM; $totalINCOME = $totalINCOME+$INCOME; ?>
<?php endforeach ?>
                            </tbody>
                            <tfoot class="nav">
<?php if($this->session->userdata("user_level") == 1 || $this->session->userdata('user_level') == 0) : ?> 
                                <tr>
                                    <td colspan=100>
                                        <div class="div_footer">
                                            <div>
                                                <div id="deal_li"><b>TOTAL REMITTANCE</b></div>
                                                <div class = "deal_li"><?php echo number_format($totalNPFM); ?></div>
                                                <div id="deal_li"><b>TOTAL INCOME</b></div>
                                                <div class = "deal_li"><?php echo number_format($totalINCOME); ?></div>
                                            </div> 
                                        </div>
                                    </td>
                                </tr>
<?php elseif($this->session->userdata("user_level") == 2) : ?>
                                <tr>
                                    <td colspan=100>
                                        <div style="margin: 10px;">
                                            <br>
                                            <div style="border: 1px solid #ccc;">
                                                <div id="deal_li"><b>TOTAL REMITTANCE</b></div>
                                                <div class = "deal_li"><?php echo number_format($totalNPFM); ?></div>
                                            </div> 
                                        </div>
                                    </td>
                                </tr>
<?php endif ?>
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
<?php endforeach ?>
</div>
