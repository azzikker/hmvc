<!--START OF CSS-->
<link rel="stylesheet" type="text/css" href="assets/general/set/jtps/jtps.css">
<!--END OF CSS-->
<!--START OF JS-->
<script type="text/javascript" src="assets/general/js/jquery.js"></script>
<script type="text/javascript" src="assets/general/set/jtps/jtps.js"></script>
<script type="text/javascript" src="assets/admin/js/datagrid.js"></script>
<!--END OF JS-->

<div class = "profile_member">
<?php foreach($sql9 as $row9): ?>
<form action="<?php echo base_url(); ?>admin/admin_companies/editCompany/<?php echo $this->uri->segment(4); ?>/<?php echo $this->uri->segment(5); ?>" method="post" enctype="multipart/form-data">
    <article class="module width_full">
        <header><h3>Company - <?php echo xss_cleaner($row9->company_name); ?></h3></header>
            <div id="company_logo">
                <div>
                    <img src="assets/general/images/companies/optimize/<?php echo htmlentities($row9->company_logo);?>" width="300px">
                </div>
            </div>
            <div style="margin: 20px;">
                <div align="right"> 
                    <fieldset id="company_fieldset">
                        <b><?php echo xss_cleaner(strtoupper($row9->company_name)); ?></b>
<?php $table1 = "deal_view"; $deal_where['company_hash'] = htmlentities($row9->company_hash); ?>
<?php $sql1 = $this->db->get_where($table1,$deal_where); ?>
<?php $deals_count = htmlentities($sql1->num_rows); ?>
                        <!--span><?php echo $deals_count; ?></span-->
                    </fieldset>
                    <fieldset id="company_fieldset"><p id="company_fieldset"><?php echo nl2br(xss_cleaner($row9->company_pr)); ?></p></fieldset>
                    <fieldset id="company_fieldset"><b>NUMBER OF DEALS (</b> <?php echo htmlentities($deals_count); ?> <b>)</b></fieldset>
                    <fieldset id="company_fieldset">
                        <div id="company_field">
                            <div id="company_li"><b>WEBSITE         </b></div>
                            <div class = "company_li"><?php echo xss_cleaner($row9->company_website); ?></div>
                            <div id="company_li"><b>E-MAIL          </b></div>
                            <div class = "company_li"><?php echo xss_cleaner($row9->company_email); ?></div>
                            <div id="company_li"><b>CONTACT NO.     </b></div>
                            <div class = "company_li"><?php echo xss_cleaner($row9->company_no); ?></div>
                            <div id="company_li"><b>CONTACT PERSON  </b></div>
                            <div class = "company_li"><?php echo xss_cleaner($row9->company_person_no); ?></div>
                            <div><b>ADDRESS                         </b></div>
                            <div class = "company_li"><?php echo xss_cleaner($row9->company_address); ?></div>
                        </div>
                    </fieldset>
                </div>
                <div  align="right">
                    <fieldset id="company_fieldset">
                        <input type="button" value="Back" onclick="window.history.back();">
<?php if($this->session->userdata('user_level') == 3 || $this->session->userdata('user_level') == 2 || $this->session->userdata('user_level') == 0) : ?>
                        <input type="submit" name="Edit" value="Edit"/>
<?php endif ?>
                    </fieldset>
                </div>
            </div>
            <div style="margin: 20px;">
                <article class="module width_full">
                    <header>
                        <h3 class="tabs_involved">Deals - <?php echo ucwords($this->uri->segment(5)); ?></h3>
<?php if($this->uri->segment(5) == "current" || $this->uri->segment(5) == "future" || $this->uri->segment(5) == "past") : ?>
                        <ul class="tabs">
                            <li><a href="<?php echo base_url(); ?>admin/admin_companies/profileCompany/<?php echo $this->uri->segment(4); ?>/current">Current Deals</a></li>
                            <li><a href="<?php echo base_url(); ?>admin/admin_companies/profileCompany/<?php echo $this->uri->segment(4); ?>/future">Future Deals</a></li>
                            <li><a href="<?php echo base_url(); ?>admin/admin_companies/profileCompany/<?php echo $this->uri->segment(4); ?>/past">Past Deals</a></li>
                        </ul>
<?php endif ?>
                    </header>
                    <table style="font-size: 11px" id="datagrid" style="border: 1px solid #ccc;" cellspacing="0" width="100%">
                        <thead>
                            <tr align="left">
<?php if($this->uri->segment(5) == "current" || $this->uri->segment(5) == "future" || $this->uri->segment(5) == "past") : ?>
                                <th id = "table_spacing" title="Transaction Reference No.">TR NO.</th>
                                <th >TITLE</th>
                                <th>CATEGORY</th>
                                <th>TYPE</th>
                                <th align="right">PRICE</th>
                                <th align="right">SOLD</th>                                     
                                <th align="right">RETURNS</th>
                                <th align="right">STOCK</th>
<?php if($this->session->userdata("user_level") == 1 || $this->session->userdata('user_level') == 0) : ?>
                                <th align="right">REMITTANCE</th>
                                <th align="right">INCOME</th>
<?php elseif($this->session->userdata("user_level") == 2 || $this->session->userdata('user_level') == 0) : ?>
                                <th align="right">REMITTANCE</th>
<?php endif ?>
                                <th align="center">ACTIONS</th>
<?php elseif($this->uri->segment(5) == "branches") : ?>
                                <th id = "table_spacing">BRANCHES</th>
                                <th align="left">MERCHANT</th>
<?php endif ?>
                            </tr>
                        </thead>  
                        <tbody id = 'info_grid'>
<?php if($this->uri->segment(5) == "current" || $this->uri->segment(5) == "future" || $this->uri->segment(5) == "past") : ?>
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
<?php $deal_title = shortenString(xss_cleaner($row2->deal_view_title), 25); ?>
                            <tr align="left" title="<?php echo xss_cleaner($row2->deal_view_title); ?>">
                                <td id = "table_spacing"><?php echo str_replace("10", "", printf("%010s", htmlentities($row2->deal_view_id))); ?></td>        
                                <td><?php echo $deal_title[0]; ?></td>          
<?php foreach($sql0->result() as $row0): ?>
                                <td><?php echo xss_cleaner($row0->category_name); ?></td>
<?php endforeach ?>
                                <td><?php echo xss_cleaner($row2->deal_view_type); ?></td>
<?php foreach($sql1->result() as $row1) : ?>
<?php if($row2->deal_view_type == "Single Deal") : ?>
                                <td align="right"><?php echo number_format(htmlentities($row1->deal_discounted_price)); ?></td>
<?php else : ?>
                                <td align="right">-</td>
<?php endif ?>
<?php endforeach ?>
                                <td align="right">
<?php foreach($sql6->result() as $row6) : ?>
<?php if($row2->deal_view_type == "Single Deal") : ?>
<?php if($row2->deal_current_stock == 0) : ?>
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
                                <td align="right"><?php echo number_format(xss_cleaner($row1->deal_returned) + xss_cleaner($row6->deal_returned)); ?></td>
<?php endif ?>
<?php else : ?>
<?php if(htmlentities($row1->deal_returned) == 0) : ?>
                                <td align="right">NONE</td>
<?php else : ?>
                                <td align="right"><?php echo number_format(xss_cleaner($row1->deal_returned) + xss_cleaner($row6->deal_returned)); ?></td>
<?php endif ?>                    
<?php endif ?>
<?php endforeach ?> 
<?php foreach($sql1->result() as $row1) : ?>
<?php foreach($sql6->result() as $row6) : ?>
<?php if(htmlentities($row2->deal_option) == 0) : ?>
<?php if(htmlentities($row6->deal_current_stock) == 0) : ?>
                                <td align="right"><b><font color="green">SOLD!</font></b></td>
<?php else : ?> 
                                <td align="right"><?php echo number_format(htmlentities($row1->deal_current_stock) + htmlentities($row6->deal_current_stock)); ?></td>
<?php endif ?>
<?php else : ?>
<?php if(htmlentities($row1->deal_current_stock) == 0) : ?>
                                <td align="right"><b><font color="green">SOLD!</font></b></td>
<?php else : ?> 
                                <td align="right"><?php echo number_format(htmlentities($row1->deal_current_stock) + htmlentities($row6->deal_current_stock)); ?></td>
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
                                <td align="right"><?php echo ($NPFM != 0 ? number_format($NPFM) : 'NONE'); ?></td>
                                <td align="right"><?php echo ($INCOME != 0 ? number_format($INCOME) : 'NONE'); ?></td>
<?php elseif($this->session->userdata("user_level") == 2) : ?>
                                <td align="right"><?php echo ($NPFM != 0 ? number_format($NPFM) : 'NONE'); ?></td> 
<?php endif ?>  
<?php else : ?>
<?php foreach($sql1->result() as $row1) : ?> 
<?php $tf = (htmlentities($row1->deal_original_stock) - htmlentities($row1->deal_current_stock)) + (htmlentities($row6->deal_original_stock) - htmlentities($row6->deal_current_stock)); $nr = htmlentities($row1->deal_returned) + htmlentities($row6->deal_returned); ?>
<?php $NPFM = npfm($sp, $x, $tf, $nr); $TOTAL_A = total_a($sp, $tf, $nr); $INCOME = income($TOTAL_A, $NPFM); ?>
<?php if($this->session->userdata("user_level") == 1 || $this->session->userdata('user_level') == 0) : ?>
                                <td align="right"><?php echo ($NPFM != 0 ? number_format($NPFM) : 'NONE'); ?></td>
                                <td align="right"><?php echo ($INCOME != 0 ? number_format($INCOME) : 'NONE'); ?></td>
<?php elseif($this->session->userdata("user_level") == 2 || $this->session->userdata('user_level') == 0) : ?>
                                <td align="right"><?php echo ($NPFM != 0 ? number_format($NPFM) : 'NONE'); ?></td> 
<?php endif ?>                  
<?php endforeach ?> 
<?php endif ?>
<?php endforeach ?>
                                <td align="center">
<?php if(htmlentities($row2->deal_view_type)=="Single Deal") : ?>
                                    <a href="<?php echo base_url() . "admin/admin_deals/profile_single_deal/" . htmlentities($row2->deal_view_type) . "/" . htmlentities($row2->deal_hash); ?>"><img id="icn_search" src="assets/admin/images/icn_search.png" title="View Single Deal Profile"></a>
<?php else : ?>
                                    <a href="<?php echo base_url() . "admin/admin_deals/profile_group_deal/" . htmlentities($row2->deal_view_type) . "/" . htmlentities($row2->deal_hash); ?>"><img id="icn_search" src="assets/admin/images/icn_search.png" title="View Group Deal Profile"></a>
<?php endif ?>
                                </td>
                            </tr>
<?php foreach($sql3 as $row3) : ?>
<?php if($row2->deal_view_type=="Group Deal") : ?> 
<?php $deal_title = shortenString(xss_cleaner($row3->deal_title), 30); ?>
                            <tr id="sub_deal" title="<?php echo xss_cleaner($row3->deal_title); ?>">
                                <td id = "table_spacing"></td>
                                <td><?php echo $deal_title[0]; ?></td>
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
                                <td align="right"><b><font color="green">SOLD!</font></b></td> 
<?php else : ?>
                                <td align="right"><?php echo number_format(htmlentities($row3->deal_current_stock)); ?></td>
<?php endif ?>
<?php else : ?>
<?php foreach($sql7->result() as $row7) : ?>
<?php if(htmlentities($row7->deal_current_stock) == 0) : ?>
                                <td align="right"><b><font color="green">SOLD!</font></b></td> 
<?php else : ?>
                                <td align="right"><?php echo number_format(htmlentities($row7->deal_current_stock)); ?></td>
<?php endif ?>
<?php endforeach ?>
<?php endif ?> 
<?php if(htmlentities($row3->deal_option) == 1) : ?>                                                                              
<?php $subtf = htmlentities($row3->deal_original_stock) - htmlentities($row3->deal_current_stock); ?>
<?php $subnr = htmlentities($row3->deal_returned); ?>
<?php $subNPFM = npfm($sp, $x, $subtf, $subnr); $TOTAL_A = total_a($sp, $subtf, $subnr); $subINCOME = income($TOTAL_A, $subNPFM); ?>
<?php if($this->session->userdata("user_level") == 1 || $this->session->userdata('user_level') == 0) : ?>
                                <td align="right"><?php echo ($subNPFM != 0 ? number_format($subNPFM) : 'NONE'); ?></td>
                                <td align="right"><?php echo ($subINCOME != 0 ? number_format($subINCOME) : 'NONE'); ?></td>
<?php elseif($this->session->userdata("user_level") == 2) : ?>
                                <td align="right"><?php echo ($subNPFM != 0 ? number_format($subNPFM) : 'NONE'); ?></td>
<?php endif ?>
<?php else : ?>
<?php foreach($sql7->result() as $row7) : ?>
<?php $subtf = htmlentities($row7->deal_original_stock) - htmlentities($row7->deal_current_stock); ?>
<?php $subnr = htmlentities($row7->deal_returned); ?>
<?php $subNPFM = npfm($sp, $x, $subtf, $subnr); $TOTAL_A = total_a($sp, $subtf, $subnr); $subINCOME = income($TOTAL_A, $subNPFM); ?>
<?php if($this->session->userdata("user_level") == 1 || $this->session->userdata('user_level') == 0) : ?>
                                <td align="right"><?php echo ($subNPFM != 0 ? number_format($subNPFM) : 'NONE'); ?></td>
                                <td align="right"><?php echo ($subINCOME != 0 ? number_format($subINCOME) : 'NONE'); ?></td>
<?php elseif($this->session->userdata("user_level") == 2) : ?>
                                <td align="right"><?php echo ($subNPFM != 0 ? number_format($subNPFM) : 'NONE'); ?></td>
<?php endif ?>
<?php endforeach ?>
<?php endif ?> 
                                <td align="center">-</td>
                            </tr>
<?php endif ?>
<?php endforeach ?>
<?php $totalNPFM = $totalNPFM+$NPFM; $totalINCOME = $totalINCOME+$INCOME; ?>
<?php endforeach ?>
<?php elseif($this->uri->segment(5) == "branches") : ?>
<?php foreach($sql10 as $row10) : ?>
                            <tr align="left" title="<?php echo $row10->location_address; ?>">
                                <td id = "table_spacing"><?php echo $row10->location_address; ?></td>
                                <td align="left"><?php echo ""; ?></td>
                            </tr>
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
<?php  if($this->uri->segment(5) == "current" || $this->uri->segment(5) == "future" || $this->uri->segment(5) == "past") : ?>
<?php if($this->session->userdata("user_level") == 1 || $this->session->userdata('user_level') == 0) : ?> 
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
<?php elseif($this->uri->segment(5) == "current") : ?>
<?php endif ?>
                        </tfoot>
                    </table>
                </article>
            </div>
    </article>
</form>          
<?php endforeach ?>
</div>
