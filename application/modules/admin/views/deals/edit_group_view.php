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

<script type="text/javascript">
    $(function() { $( "#datepicker1" ).datepicker({ changeMonth: true, changeYear: true}); });
    $(function() { $( "#datepicker2" ).datepicker({ changeMonth: true, changeYear: true}); });
</script>
<script type="text/javascript">
    var discounted_single = new discounted_single();
    var add_more_selection_single = new add_more_selection_single();
    var add_more_option_single = new add_more_option_single();
    var add_more_highlights_single = new add_more_highlights_single();
    var add_more_terms_single = new add_more_terms_single();
    var stock_option_single = new stock_option_single();
    var add_more_location_solo = new add_more_location_solo();
    var remove_A_solo = new remove_A_solo();
</script>
<!--END OF JS-->

<div class = "list_member" style="/*display: none;*/">
    <article class="module width_full">
<?php foreach($sql1 as $row1) : ?>
    <header>
    <?php $deal_view_title = shortenString($row1->deal_view_title, 40); ?>
        <h3 class="tabs_involved">Deals - <?php echo htmlentities($row1->deal_view_type); ?> - <?php echo $deal_view_title[0]; ?></h3>
        <ul class="tabs">
            <li>
                <a href="<?php echo base_url(); ?>admin/admin_deals_gallery/edit_gallery_group_deal/<?php echo $this->uri->segment(4); ?>/<?php echo $this->uri->segment(5); ?>">
                    Manage Gallery
                </a>
            </li>
<?php if($this->session->userdata('user_level') == 0) : ?>
            <li>        
                <a href="<?php echo base_url(); ?>admin/admin_deals/profile_group_deal/<?php echo $this->uri->segment(4); ?>/<?php echo $this->uri->segment(5); ?>">
                    View Profile
                </a>
            </li>
<?php endif ?>
        </ul>
    </header>
        <form action="<?php echo base_url(); ?>admin/admin_deals/update_Maingroup_deal/<?php echo $this->uri->segment(4); ?>/<?php echo $this->uri->segment(5); ?>" method="post" enctype="multipart/form-data">
            <div style="margin: 20px;">
                <div id="deal_type">
                    <fieldset>
                        <label>Deal Company</label>
                        <select name="editDCO">
<?php if($row1->company_id == 0) : ?>
                            <option value="0" selected="selected">--choose--</option>
<?php else : ?>
<?php foreach($sql9b as $row9b): ?>
                            <option value="<?php echo htmlentities($row9b->company_id); ?>" selected="selected"><?php echo htmlentities($row9b->company_name); ?></option>
<?php endforeach ?>
<?php endif ?>                         
<?php foreach($sql9a as $row9a): ?>
                            <option value="<?php echo htmlentities($row9a->company_id); ?>"><?php echo htmlentities($row9a->company_name); ?></option>
<?php endforeach ?>     
                        </select>
                        <label>Deal Category</label>
                        <select name="editDC">
<?php foreach($sqlb as $rowb): ?>
                            <option value="<?php echo htmlentities($rowb->category_id); ?>" selected="selected"><?php echo htmlentities($rowb->category_name); ?></option>
<?php endforeach ?>
<?php foreach($sqla as $rowa): ?>
                            <option value="<?php echo htmlentities($rowa->category_id); ?>"><?php echo htmlentities($rowa->category_name); ?></option>
<?php endforeach ?>
                        </select>
                        <label>Deal Type</label>
                        <select id="type" name="editDT" onchange="deal_type()" disabled="disabled">
                            <option><?php echo htmlentities($row1->deal_view_type); ?></option>
                        </select>
                    </fieldset>
                </div>
                <fieldset>                                                             
                    <label id="main_title">Main Title</label>                             
                    <input type="text" name="editMDN" value="<?php echo $row1->deal_view_title; ?>" maxlength="60" required="required">
                    <label id="main_statement">Main Statement</label>
                    <input type="text" name="editMDS" value="<?php echo $row1->deal_view_statement; ?>" maxlength="100" required="required">
                </fieldset>
<?php $m = "m"; ?>
<?php $d = "d"; ?>
<?php $y = "Y"; ?>
                <fieldset>
                    <label>Start of Deal</label>
                    <input id="datepicker1" type="text" name="editSOD" value="<?php echo date($m . "/" . $d . "/" . $y, htmlentities($row1->deal_view_start)); ?>">
                    <label>End of Deal</label>
                    <input id="datepicker2" type="text" name="editEOD" value="<?php echo date($m . "/" . $d . "/" . $y, htmlentities($row1->deal_view_end)); ?>">
                </fieldset>
                <article class="module width_full">
                <header><h3>Locations</h3></header>
                <div style="margin: 20px;">
                    <div id="deal_locations">
<?php $location_count=1; ?>
<?php foreach($sql8 as $row8) : ?>
<?php $l_encrypt = ((htmlentities($row8->location_id))*8)+8; ?>
<?php $l_decrypt = (($l_encrypt)-8)/8; ?>
<?php $l_encrypt_count = strlen($l_encrypt); ?>
<?php $location_id_hash = md5($l_encrypt . "" . time() . "" . $l_decrypt) . "" . time() . "" . $l_encrypt; ?>
                        <fieldset class="A1">
                            <label>Address</label>
                            <input id="locations" type="text" name="editLocation<?php echo $location_count; ?>" value="<?php echo htmlentities($row8->location_address); ?>" required="required">
                            <label>Map Link <font color="green"> ( <a href="<?php if($row8->location_link=="") { echo "http://maps.google.com.ph"; } else { echo $row8->location_link; } ?>" target="_new" id="view_map" title="Get the Map Link on the Google Map"> Open Google Map </a> )</font></label>
                            <textarea id="locations" class="link" name="editLink<?php echo $location_count; ?>" required="required"><?php echo $row8->location_link; ?></textarea>
                            <input type="hidden" name="editLinkNo<?php echo $location_count; ?>" value="<?php echo $l_encrypt_count; ?>">
                            <input type="hidden" name="editHash<?php echo $location_count; ?>" value="<?php echo $location_id_hash; ?>">
                        </fieldset>
<?php $location_count=$location_count+1; ?>
<?php endforeach ?>
                        </div>
                        <fieldset>
                            <label><a href="add_more_location" id="add_more_location">Add More Location(s)</a></label>
                            <span id="icn_remove" class="input_remove A off" count_a="1" title="Remove Last Line"></span>
                            <input type="hidden" name="mLOCATION" id="mLOCATION" value="<?php echo $location_count-1; ?>">
                            <input type="hidden" name="nLOCATION" id="nLOCATION" value="<?php echo $location_count-1; ?>">
                        </fieldset>
                    </div>
                </article>
                <div style="text-align: right;">
                    <fieldset>
                        <input type="button" value="Back" onclick="window.history.back();">
                        <input class="alt_btn" type="submit" name="update" value="Update"/>
                    </fieldset>       
                </div>
            </div>
<?php endforeach ?>
        </form>  
    </article>
    <article class="module width_full">
    <header><h3>Sub Deals</h3></header>
        <table style="font-size: 11px" id="datagrid" style="border: 1px solid #ccc;" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Deal Title</th>
                    <th>Deal Category</th>
                    <th>Actions</th>
                </tr>
            </thead>  
            <tbody id = 'info_grid'>
<?php foreach($sql2 as $row2): ?>
<?php $deal_title = shortenString(htmlentities($row2->deal_title), 25); ?>
                <tr align="center" title="<?php echo $row2->deal_title; ?>">
                    <td><?php echo $deal_title[0]; ?></td>
<?php $table0 = "deal_category" ?>
<?php $where0['category_id'] = htmlentities($row2->category_id); ?>
<?php $sql0 = $this->db->get_where($table0,$where0); ?>
<?php foreach($sql0->result() as $row0): ?>
                    <td><?php echo htmlentities($row0->category_name); ?></td>
<?php endforeach ?>          
                    <td>
                        <a href="<?php echo base_url() . "admin/admin_deals/edit_sub_deal/" . $row2->deal_view_type . "/" . htmlentities($row2->deal_subhash); ?>"><img id="icn_edit" src="assets/admin/images/icn_edit.png" title="Manage Sub Deal Info"></a>
                        <a onclick="return c_ask('Are you sure you want to delete the selected record?')" href="<?php echo base_url() . "admin/admin_deals/delete_group_deal/" . htmlentities($row2->deal_view_type) . "/" . htmlentities($row2->deal_subhash); ?>">
                            <img id="icn_trash" src="assets/admin/images/icn_trash.png" title="Delete Sub Deal">
                        </a>
                    </td>
                </tr>
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
        <div style="padding: 5px; text-align: right; margin: 2px;">
            <input type="button" value="Back" onclick="window.history.back();">
            <input type="button" value="Add" onclick="showAdd()">
        </div>
    </article>        
</div>
<div class = "add_member" style="display: none;">
<form action="<?php echo base_url(); ?>admin/admin_deals/save_group_deal/<?php echo $this->uri->segment(4); ?>/<?php echo $this->uri->segment(5); ?>" method="post" enctype="multipart/form-data">
    <article class="module width_full">
        <header><h3>Add New Sub Deal</h3></header>
            <div id="deal_header"></div>
            <div style="margin: 20px;">
                <fieldset>
                    <label id="main_title">Deal Title</label>
                    <input type="text" name="addMDN" maxlength="60">
                    <label id="main_statement">Deal Statement</label>
                    <input type="text" name="addMDS" maxlength="100">
                </fieldset>
                <fieldset>
                    <label>Deal Cover</label>
                    <input type="file" name="addMMC">
                    <h4 class="alert_info">Required Image: 690x242</h4>
                </fieldset>
                <div id="deals_single">
                    <fieldset>
                        <label>Embeded Code ( <a href="http://www.youtube.com/" target="_new" title="Get YOU TUBE embeded code">You Tube</a> )</label>
                        <textarea id="locations" class="link" name="addDV"></textarea>
                    </fieldset>
                    <fieldset>
                        <label>Original Price</label>
                        <input class="original_single" type="text" name="addOP" maxlength="10" autocomplete="off">
                        <label>Discount (%)</label>
                        <input class="discount_single" type="text" name="addD" maxlength="10" autocomplete="off">
                        <label>Discounted Price</label>
                        <input class="discounted_single" type="text" disabled="disabled">
                        <input class="discounted_single" type="hidden" name="addDP">
                    </fieldset>
                    <article class="module width_full"> 
                        <header>
                            <h3 class="tabs_involved">
                            <select id="option_switcher" class="tabs" name="Oswitcher">
                                <option value="1">No options</option>
                                <option value="0">With options</option>
                            </select>
                        </header>
                        <div style="margin: 20px;">
                            <div id="deal_selections_single">
                                <fieldset class="none_option">
                                    <label>Stock</label>
                                    <input type="text" name="addStock" value="" maxlength="10">
                                </fieldset>
                                <fieldset class="with_option">
                                    <label>Selection</label>
                                    <input type="text" name="addDselect_single1" value="" maxlength="20">
                                    <label id="options">Options</label>
                                    <div id="deal_options_single1">
                                        <input id="options" class="options_single1_1" type="text" name="addDoption_single1_1" value="" maxlength="20" >
                                    </div>
                                    <label id="options">Stock</label>
                                    <div id="deal_stock_single1">
                                        <input id="options" class="options_stock1_1" type="text" name="addStock_single1_1" value="" maxlength="10" >
                                    </div>
                                    <label id="options"><a href="add_more_option_single1" id="add_more_option_single1">Add More Option(s) and Stock(s)</a></label>
                                    <input type="hidden" name="nOPTION_single1" id="nOPTION_single1" value="1"> 
                                </fieldset>
                            </div>
<?php if($this->session->userdata('user_level') == 99) : ?>
                            <fieldset class="with_option">
                               <label><a href="add_more_selection_single" id="add_more_selection_single">Add More Selection(s)</a></label>
<?php endif ?> 
                               <input type="hidden" name="nSELECTION_single" id="nSELECTION_single" value="1">
<?php if($this->session->userdata('user_level') == 99) : ?> 
                            </fieldset>
<?php endif ?>
                        </div>
                    </article>
                    <br>
                    <fieldset>
                        <label>Highlights</label>
                        <div id="deal_highlights_single">
                            <input id="highlights" type="text" name="addH_single1" maxlength="255">
                        </div>
                        <label><a href="add_more_highlights_single" id="add_more_highlights_single">Add More Highlight(s)</a></label>
                        <input type="hidden" name="nH_single" id="nH_single" value="1">
                    </fieldset>
                    <fieldset>
                        <label>Terms</label>
                        <div id="deal_terms_single">
                            <input id="terms" type="text" name="addT_single1" maxlength="255">
                        </div>
                        <label><a href="add_more_terms_single" id="add_more_terms_single">Add More Term(s)</a></label>
                        <input type="hidden" name="nT_single" id="nT_single" value="1">
                    </fieldset>
                    <fieldset>
                        <label>Content</label>
                        <textarea id="content" name="addContent_single"></textarea>
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