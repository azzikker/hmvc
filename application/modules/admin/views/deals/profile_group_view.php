<!--START OF CSS-->
<link rel="stylesheet" type="text/css" href="assets/general/set/jtps/jtps.css">
<!--END OF CSS-->
<!--START OF JS-->
<script type="text/javascript" src="assets/general/js/jquery.js"></script>
<script type="text/javascript" src="assets/general/set/jtps/jtps.js"></script>
<script type="text/javascript" src="assets/admin/js/datagrid.js"></script>
<!--END OF JS-->

<div class = "profile_member">
    <article class="module width_full">
<?php foreach($sql1 as $row1) : ?>
        <header>
<?php $deal_view_title = shortenString($row1->deal_view_title, 40); ?>
            <h3 class="tabs_involved"> Deals - <?php echo $row1->deal_view_type; ?> - <?php echo $deal_view_title[0]; ?></h3>
<?php if($this->session->userdata('user_level') <> 3) : ?>
            <ul class="tabs">
<?php if($this->session->userdata('user_level') == 0) : ?>
                <li>        
                    <a href="<?php echo base_url(); ?>admin/admin_deals/edit_group_deal/<?php echo $this->uri->segment(4); ?>/<?php echo $this->uri->segment(5); ?>">
                        Manage Information
                    </a>
                </li>
<?php endif ?>
                <li>
                    <a href="<?php echo base_url(); ?>admin/admin_deals_gallery/edit_gallery_group_deal/<?php echo $this->uri->segment(4); ?>/<?php echo $this->uri->segment(5); ?>">
                        View Gallery
                    </a> 
                </li>
            </ul>
<?php endif ?>
        </header>
            <div id="div_logo"><img id="deal_logo" src="assets/general/images/deals_gallery/optimize/<?php echo $row1->deal_image; ?>" width="650"></div>
            <div id="div_sidefield" align="right" style="margin: 20px;">
                <fieldset id="deal_sidefield"><b><?php echo $row1->deal_view_title; ?></b></fieldset>
                <fieldset id="deal_sidefield"><?php echo $row1->deal_view_statement; ?></fieldset>
                <fieldset id="deal_sidefield">
                    <div id="deal_li"><b>Company</b></div>
<?php $table9 = "companies"; ?>
<?php $where9["company_id"] = htmlentities($row1->company_id); ?>
<?php $sql9 = $this->Companies_Model->displaySelected($table9, $where9); ?>
<?php foreach($sql9 as $row9) : ?>
                    <div class = "deal_li"><?php echo $row9->company_name; ?></div>
<?php endforeach ?>
                    <div id="deal_li"><b>Category</b></div>
<?php $table = "deal_category"; ?>
<?php $where["category_id"] = $row1->category_id; ?>
<?php $sql = $this->Deals_Category_Model->displayCategorySelected($table, $where); ?>
<?php foreach($sql as $row) : ?>
                    <div class = "deal_li"><?php echo htmlentities($row->category_name); ?></div>
<?php endforeach ?>
                    <div id="deal_li"><b>Type</b></div>
                    <div class = "deal_li"><?php echo htmlentities($row1->deal_view_type); ?></div>
<?php $m = "%m"; ?>
<?php $d = "%d"; ?>
<?php $y = "%Y"; ?>
                    <div id="deal_li"><b>Date Duration</b></div>
                    <div class = "deal_li"><?php echo strftime($m . "/" . $d . "/" . $y, htmlentities($row1->deal_view_start)); ?> - <?php echo strftime($m . "/" . $d . "/" . htmlentities($y, $row1->deal_view_end)); ?></div>
                </fieldset>
            </div>
            <br>
            <div id="div_halffield" align="left" style="margin: 20px;">
                <fieldset id="deal_halffield">
                    <b>Location Map</b><p>
                    <ul style="margin: 20px;">
<?php foreach($sql8 as $row8) : ?>
                        <li><?php echo htmlentities($row8->location_address); ?></li>
<?php endforeach ?>
                    </ul>
                </fieldset>
            </div>
<?php endforeach ?>
    </article>
    <article class="module width_full">
    <header><h3>Sub Deals</h3></header>
        <table style="font-size: 11px" id="datagrid" style="border: 1px solid #ccc;" cellspacing="0" width="100%">
            <thead>
                <tr align="left">
                    <th id="table_spacing">Deal ID</th>
                    <th>Deal Title</th>
                    <th>Deal Category</th>
                    <th align="right">Sold</th>
                    <th align="right">Returns</th>
                    <th align="right">Stock</th>
                    <th align="center">Actions</th>
                </tr>
            </thead>  
            <tbody id = 'info_grid'>
<?php foreach($sql2 as $row2): $select_where["deal_subhash"] = $row2->deal_subhash; ?>
<?php $deal_title = shortenString(htmlentities($row2->deal_title), 25); ?>
                <tr align="left" title="<?php echo $row2->deal_view_title; ?>">
                    <td id="table_spacing"><?php echo str_replace("10", "", printf("%010s", htmlentities($row2->deal_id))); ?></td>
                    <td><?php echo $deal_title[0]; ?></td>
<?php $table0 = "deal_category" ?>
<?php $where0['category_id'] = htmlentities($row2->category_id); ?>
<?php $sql0 = $this->db->get_where($table0,$where0); ?>
<?php $table4="deal_selection"; $table5="deal_option"; ?>
<?php $sql4 = $this->Deals_Selection_Model->displaySelectedFiltered($table4, $table5, $select_where); ?>
<?php foreach($sql4 as $row4) : ?>
<?php foreach($sql0->result() as $row0): ?>
                    <td><?php echo htmlentities($row0->category_name); ?></td>
<?php endforeach ?>
<?php if($row2->deal_option==1) : ?>
<?php if(htmlentities($row2->deal_original_stock)-htmlentities($row2->deal_current_stock)==0) : ?>
                    <td align="right">NONE</td>
<?php else : ?>
                    <td align="right"><?php echo number_format(htmlentities($row2->deal_original_stock)-htmlentities($row2->deal_current_stock)); ?></td>
<?php endif ?>
<?php else : ?>
<?php if(htmlentities($row4->deal_original_stock)-htmlentities($row4->deal_current_stock)==0) : ?>
                    <td align="right">NONE</td>
<?php else : ?>
                    <td align="right"><?php echo number_format(htmlentities($row4->deal_original_stock)-htmlentities($row4->deal_current_stock)); ?></td>
<?php endif ?>
<?php endif ?>
<?php if($row2->deal_option==1) : ?>
<?php if(htmlentities($row2->deal_returned)==0) : ?>
                    <td align="right">NONE</td>
<?php else : ?>       
                    <td align="right"><?php echo number_format(htmlentities($row2->deal_returned));?></td>
<?php endif ?>
<?php else : ?>
<?php if(htmlentities($row4->deal_returned)==0) : ?>
                    <td align="right">NONE</td>
<?php else : ?> 
                    <td align="right"><?php echo number_format(htmlentities($row4->deal_returned));?></td>
<?php endif ?>
<?php endif ?>
<?php if($row2->deal_option==1) : ?>          
                    <td align="right"><?php echo number_format(htmlentities($row2->deal_current_stock));?></td>
<?php else : ?>
                    <td align="right"><?php echo number_format(htmlentities($row4->deal_current_stock));?></td>
<?php endif ?>           
                    <td align="center">
                        <a href="<?php echo base_url() . "admin/admin_deals/profile_sub_deal/" . htmlentities($row2->deal_view_type) . "/" . htmlentities($row2->deal_subhash); ?>"><img id="icn_search" src="assets/admin/images/icn_search.png" title="View Sub Deal Profile"></a>
                    </td>
                </tr>
<?php endforeach ?>                  
<?php endforeach ?>                  
            </tbody> 
            <tfoot class="nav">
                <tr>
                    <td colspan=7>
                        <div class="pagination"></div>
                        <div class="paginationTitle">Page</div>
                        <div class="selectPerPage"></div>
                        <div class="status"></div>
                    </td>
                </tr>
            </tfoot>
        </table>
        <div style="text-align: right; margin: 20px;">
            <fieldset>
                <input type="button" value="Back" onclick="window.history.back();">
            </fieldset>        
        </div>
    </article>
</div>
