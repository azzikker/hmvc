<!--START OF CSS-->
<link rel="stylesheet" type="text/css" href="assets/general/set/jtps/jtps.css">
<!--END OF CSS-->
<!--START OF JS-->
<script type="text/javascript" src="assets/general/js/jquery.js"></script>
<script type="text/javascript" src="assets/general/set/jtps/jtps.js"></script>
<script type="text/javascript" src="assets/admin/js/datagrid.js"></script>
<script type="text/javascript">
    var add_more_location = new add_more_location();
    var remove_A_all = new remove_A_all();
    var add_bcontact = new add_bcontact();
    var delete_bcontact = new delete_bcontact();
</script>
<!--END OF JS-->
                                                                                                               
<div class = "profile_member list_member">
<?php foreach($sql9 as $row9): ?>
<form action="<?php echo base_url(); ?>admin/admin_companies/editCompany/<?php echo $this->uri->segment(4); ?>/<?php echo $this->uri->segment(5); ?>" method="post" enctype="multipart/form-data">
    <article class="module width_full">
        <header>
            <h3 class="tabs_involved">Company - <?php echo xss_cleaner($row9->company_name); ?> - <?php echo ($this->uri->segment(5) == 'current' || $this->uri->segment(5) == 'future' || $this->uri->segment(5) == 'past' ? 'deals' : $this->uri->segment(5)); ?></h3>
            <ul class="tabs">                                                                                                                       
                <li><a href="<?php echo base_url(); ?>admin/admin_companies/profileCompany/<?php echo $this->uri->segment(4); ?>/profile">Profile</a></li>
                <li><a href="<?php echo base_url(); ?>admin/admin_companies/profileCompany/<?php echo $this->uri->segment(4); ?>/current">Deals</a></li>
                <li><a href="<?php echo base_url(); ?>admin/admin_companies/profileCompany/<?php echo $this->uri->segment(4); ?>/branches">Branches</a></li>
            </ul>
        </header>
<?php if($this->uri->segment(5) == "profile") : ?>
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
<?php if($row9->company_website != "") : ?>
                            <div id="company_li"><b>WEBSITE         </b></div>
                            <div class = "company_li"><?php echo xss_cleaner($row9->company_website); ?></div>
<?php endif ?>
<?php if($row9->company_email != "") : ?>
                            <div id="company_li"><b>E-MAIL          </b></div>
                            <div class = "company_li"><?php echo xss_cleaner($row9->company_email); ?></div>
<?php endif ?>
<?php if($row9->company_fax != "") : ?>
                            <div id="company_li"><b>FAX     </b></div>
                            <div class = "company_li"><?php echo xss_cleaner($row9->company_fax); ?></div>
<?php endif ?>
<?php if($row9->company_address != "") : ?>
                            <div><b>ADDRESS                         </b></div>
                            <div class = "company_li"><?php echo xss_cleaner($row9->company_address); ?></div>
<?php endif ?>
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
<?php endif ?>
<?php if($this->uri->segment(5) != "profile") : ?>
<?php if($this->uri->segment(5) == "current" || $this->uri->segment(5) == "future" || $this->uri->segment(5) == "past") : ?>
                    <header>
                        <h3 class="tabs_involved"><?php echo ucwords($this->uri->segment(5)); ?> Deals</h3>
<?php if($this->uri->segment(5) == "branches") : ?>
                    <header> 
<?php endif ?>
                        <ul class="tabs">
                            <li><a href="<?php echo base_url(); ?>admin/admin_companies/profileCompany/<?php echo $this->uri->segment(4); ?>/current">Current Deals</a></li>
                            <li><a href="<?php echo base_url(); ?>admin/admin_companies/profileCompany/<?php echo $this->uri->segment(4); ?>/future">Future Deals</a></li>
                            <li><a href="<?php echo base_url(); ?>admin/admin_companies/profileCompany/<?php echo $this->uri->segment(4); ?>/past">Past Deals</a></li>
                        </ul>
                    </header>
<?php endif ?>
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
                                <th align="center">ACTIONS</th>
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
<?php foreach($sql10->result() as $row10) : ?>
                            <tr align="left" title="<?php echo $row10->location_name; ?>">
                                <td id = "table_spacing"><?php echo $row10->location_name; ?></td>
<?php if($row10->user_id == 0) : ?>
                                <td align="left">-</td>
<?php else : ?>
<?php foreach($sql4 as $row4) : ?>
                                <td align="left"><?php echo $row4->user_lastname . ", " . $row4->user_firstname . " " . $row4->user_middlename; ?></td>
<?php endforeach ?>
<?php endif ?>
                                <td align="center">
                                    <a href="<?php echo base_url(); ?>admin/admin_branches/editBranches/<?php echo $this->uri->segment(4) ?>/<?php echo $row10->location_hash; ?>/<?php echo $this->uri->segment(5); ?>"><img id="icn_edit" src="assets/admin/images/icn_edit.png" title="Manage Branch"></a>
                                    <a onclick="return c_ask('Are you sure you want to delete the selected record?')" href="<?php echo base_url(); ?>admin/admin_branches/deleteBranches/<?php echo $this->uri->segment(4) ?>/<?php echo $row10->location_hash; ?>/<?php echo $this->uri->segment(5); ?>"><img id="icn_trash" src="assets/admin/images/icn_trash.png" title="Delete Branch"></a>
                                </td>
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
<?php endif ?>
<?php if($this->uri->segment(5) != "profile") : ?>
                    <div style="padding: 5px; text-align: right; margin: 2px;">
                        <form action="" method="post">
<?php if($this->uri->segment(5) != "past") : ?>
                            <input type="button" value="Back" onclick="window.history.back();"> 
                            <input type="button" value="Add" onclick="showAdd()">
<?php endif ?>
<?php if($this->uri->segment(5) == "current" || $this->uri->segment(5) == "future" || $this->uri->segment(5) == "past") : ?>
                            <!--multi delete-->
                            <input onclick="return c_ask('Are you sure you want to delete the selected records?')" type="button" value="Delete Selected" id="multi_delete" onclick="return false">
                            <!--end multi delete-->
<?php endif ?>
                        </form>
<?php endif ?>
<?php if($this->uri->segment(5) == "current" || $this->uri->segment(5) == "future" || $this->uri->segment(5) == "past") : ?>
                        <!--multi delete script-->
                        <script type="text/javascript">
                            $(function(){
                                $("#multi_delete").click(function(){
                                    $("#form_multi").attr("action", "<?php echo base_url()?>/admin/admin_deals/multi_delete_single_deal").submit();
                                });
                            });
                        </script>
                        <!--end multi delete script-->
                    </div>
<?php endif ?>
    </article>
</form>          
<?php endforeach ?>
</div>
<?php if($this->uri->segment(5) == "branches") : ?>
<div class="add_member" style="display: none;">
    <form action="<?php echo base_url(); ?>admin/admin_branches/saveBranches/<?php echo $this->uri->segment(4); ?>/<?php echo $this->uri->segment(5); ?>" name="register" method="post" onsubmit="return checkform();" enctype="multipart/form-data">
        <article class="module width_full">    
            <header><h3>Add New Branch</h3></header>
            <div style="margin: 20px;">
                <div id="deal_locations">
                    <fieldset>
                        <label>Company</label>
                        <input type="text" value="<?php foreach($sql0 as $row0) : echo $row0->company_name; endforeach ?>" disabled="disabled">
                        <input type="hidden" name="addCompany" value="<?php foreach($sql0 as $row0) : echo $row0->company_name; endforeach ?>">
                    </fieldset>
                    <fieldset>
                        <label>Branch Name</label>
                        <input id="locations" type="text" name="addName" required="required" >
                        <label>E-mail</label>
                        <input id="locations" type="text" name="addEmail" maxlength="40">
                        <label>Fax</label>
                        <input id="locations" type="text" name="addFax" maxlength="20">
                    </fieldset>
                    <fieldset>
                        <label>Contact No.</label>
                        <div id="bc"> 
                            <input id="options" class="CN1 addBCN1" type="text" name="addBCN1" maxlength="20">
                        </div>
                        <label><a href="add_more_bcontact" id="add_more_bcontact">Add More Contact(s)</a></label>
                        <span id="icn_remove" class="input_remove BC off" count_bc="1" title="Remove Last Line"></span>
                        <input type="hidden" name="mBCONTACT" id="mBCONTACT" value="1">
                        <input type="hidden" name="nBCONTACT" id="nBCONTACT" value="1">
                    </fieldset>
                    <fieldset>
                        <label>Address</label>
                        <input id="locations" type="text" name="addLocation" required="required" >
                        <label>Map Link <font color="green"> ( <a href="http://maps.google.com.ph/" target="_new" id="view_map" title="Get the Map Link on the Google Map"> Open Google Map </a> )</font></label>
                        <textarea id="locations" class="link" name="addLink"></textarea>
                    </fieldset>
                </div>
            </div>
        </article>
        <article class="module width_full">
            <div style="text-align: right;">
                <div style="margin: 20px;">
                    <fieldset>
                        <input type="button" value="Back" onclick="showList()">
                        <input class="alt_btn" type="submit" name="save" value="Save"/>
                    </fieldset>
                </div>        
            </div>
        </article>
    </form>
</div>
<?php endif ?>

