<!--START OF CSS-->
<link rel="stylesheet" type="text/css" href="assets/general/set/jtps/jtps.css">
<!--END OF CSS-->
<!--START OF JS-->
<script type="text/javascript" src="assets/general/js/jquery.js"></script>
<script type="text/javascript" src="assets/general/set/jtps/jtps.js"></script>

<link rel="stylesheet" type="text/css" href="assets/general/set/datepicker/themes/base/jquery.ui.all.css">
<script type="text/javascript" src="assets/general/set/datepicker/ui/jquery.ui.core.js"></script>
<script type="text/javascript" src="assets/general/set/datepicker/ui/jquery.ui.widget.js"></script>
<script type="text/javascript" src="assets/general/set/datepicker/ui/jquery.ui.datepicker.js"></script>

<script type="text/javascript">
    $(function() { $( "#datepicker1" ).datepicker({ changeMonth: true, changeYear: true}); });
    $(function() { $( "#datepicker2" ).datepicker({ changeMonth: true, changeYear: true}); });
</script>
<script type="text/javascript">
    var stock_count = new stock_count();
    var discounted_solo = new discounted_solo(); 
    var add_more_selection_solo = new add_more_selection_solo();
    var add_more_option_solo = new add_more_option_solo();
    var add_more_highlights_solo = new add_more_highlights_solo();
    var add_more_terms_solo = new add_more_terms_solo();
    var remove_H_solo = new remove_H_solo();
    var remove_T_solo = new remove_T_solo();
    var add_more_location_solo = new add_more_location_solo();
    var remove_A_solo = new remove_A_solo(); 
</script>
<!--END OF JS-->
                                                             
<div class = "edit_member" style="/*display: none;*/">
<?php foreach($sql1 as $row1): ?>
<?php foreach($sql2 as $row2): ?>
<form action="<?php echo base_url(); ?>admin/admin_deals/update_single_deal/<?php echo $this->uri->segment(4); ?>/<?php echo $this->uri->segment(5); ?>/<?php echo htmlentities($row2->deal_option); ?>" method="post" enctype="multipart/form-data">
    <article class="module width_full">
        <header>
<?php $deal_view_title = shortenString(xss_cleaner($row1->deal_view_title), 40); ?>
            <h3 class="tabs_involved"> Deals - <?php echo htmlentities($row1->deal_view_type); ?> - <?php echo $deal_view_title[0]; ?></h3>
            <ul class="tabs">
                <li>
                    <a href="<?php echo base_url(); ?>admin/admin_deals_gallery/edit_gallery_single_deal/<?php echo $this->uri->segment(4); ?>/<?php echo $this->uri->segment(5); ?>">
                        Manage Gallery
                    </a>
                </li>
<?php if($this->session->userdata('user_level') == 0) : ?>
                <li>
                    <a href="<?php echo base_url(); ?>admin/admin_deals/profile_single_deal/<?php echo $this->uri->segment(4); ?>/<?php echo $this->uri->segment(5); ?>">
                        View Profile
                    </a>
                </li>
<?php endif ?>
            </ul>
        </header>
            <div id="deal_header"></div>
            <div style="margin: 20px;">
                <div id="deal_type">
                    <fieldset>
                        <label>Deal Company</label>
                        <select name="editDCO">
<?php if(htmlentities($row1->company_id) == 0) : ?>
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
<?php if(htmlentities($row1->category_id) == 0) : ?>
                            <option value="0" selected="selected">--choose--</option>
<?php else : ?>
<?php foreach($sqlb as $rowb): ?>
                            <option value="<?php echo htmlentities($rowb->category_id); ?>" selected="selected"><?php echo htmlentities($rowb->category_name); ?></option>
<?php endforeach ?>
<?php endif ?>
<?php foreach($sqla as $rowa): ?>
                            <option value="<?php echo htmlentities($rowa->category_id); ?>"><?php echo htmlentities($rowa->category_name); ?></option>
<?php endforeach ?>
                        </select>
                        <label>Deal Type</label>
                        <select id="type" name="editDT" onchange="deal_type()" disabled="disabled">
                            <option value="Single Deal" selected="selected"><?php echo htmlentities($row1->deal_view_type); ?></option>
                        </select>
                    </fieldset>
                </div>
                <fieldset>
                    <label id="main_title">Deal Title</label>
                    <input type="text" name="editMDN" value="<?php echo xss_cleaner($row1->deal_view_title); ?>" maxlength="60" required="required">
                    <label id="main_statement">Deal Statement</label>
                    <input type="text" name="editMDS" value="<?php echo xss_cleaner($row1->deal_view_statement); ?>" maxlength="100" required="required">
                    <input type="hidden" name="editSubH" value="<?php echo htmlentities($row2->deal_subhash); ?>">
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
                <fieldset>
                    <label>Original Price</label>
                    <input class="original_solo" type="text" name="editOP" autocomplete="off" value="<?php echo htmlentities($row2->deal_original_price); ?>" maxlength="6" required="required">
                    <label>Discount (%)</label>
                    <input class="discount_solo" type="text" name="editD" autocomplete="off" value="<?php echo htmlentities($row2->deal_discount); ?>" maxlength="6" required="required">
                    <label>Discounted Price</label>
                    <input class="discounted_solo" type="text" disabled="disabled" value="<?php echo htmlentities($row2->deal_discounted_price); ?>" maxlength="6" required="required">
                    <input class="discounted_solo" type="hidden" name="editDP" value="<?php echo htmlentities($row2->deal_discounted_price); ?>">
                </fieldset>
                <article class="module width_full"> 
                    <header><h3></h3></header>
                    <div style="margin: 20px;">
                        <div id="deal_selections_solo">
<?php if(htmlentities($row2->deal_option) == 1) : ?>
                            <fieldset>
                                <label>Original Stock</label>
                                <input class="editOStock" type="text" name="editOStock" autocomplete="off" value="<?php echo htmlentities($row2->deal_original_stock); ?>" maxlength="10" required="required">
                                <input class="editOStock_old" type="hidden" name="editOStock_old" value="<?php echo htmlentities($row2->deal_original_stock); ?>">
                                <label>Current Stock</label>
                                <input class="editCStock" type="text" name="editCStock" autocomplete="off" value="<?php echo htmlentities($row2->deal_current_stock); ?>" maxlength="10" required="required">
                                <input class="editCStock_old" type="hidden" name="editCStock_old" value="<?php echo htmlentities($row2->deal_current_stock); ?>">
                            </fieldset>
<?php else : ?>
<?php $select_count=1; ?>
<?php foreach($sql4 as $row4) : ?>
<?php $s_encrypt = ((htmlentities($row4->selection_id))*8)+8; ?>
<?php $s_decrypt = (($s_encrypt)-8)/8; ?>
<?php $s_encrypt_count = strlen($s_encrypt); ?>
<?php $select_id_hash = md5($s_encrypt . "" . time() . "" . $s_decrypt) . "" . time() . "" . $s_encrypt; ?>
                            <fieldset>
                                <label>Selection <?php echo $select_count; ?></label>
                                <input type="text" name="editDselect_solo<?php echo $select_count; ?>" value="<?php echo htmlentities($row4->selection_name); ?>" maxlength="20" required="required">
                                <input type="hidden" name="editDselectNo<?php echo $select_count; ?>" value="<?php echo htmlentities($s_encrypt_count); ?>">
                                <input type="hidden" name="editDselect_hashA<?php echo $select_count; ?>" value="<?php echo htmlentities($select_id_hash); ?>">
                                <input type="hidden" name="editDselect_hashB<?php echo $select_count; ?>" value="<?php echo htmlentities($row4->selection_hash); ?>">
                                <label id="options">Options</label>
                                <div id="deal_options_solo<?php echo $select_count; ?>">
<?php $option_count=1; $Ostock_count=1; $Cstock_count=1; ?>
<?php $table5 = "deal_option"; ?>
<?php $deal_where["deal_hash"] = $this->uri->segment(5); ?>
<?php $option_where["selection_hash"] = htmlentities($row4->selection_hash); ?>
<?php $sql5 = $this->Deals_Option_Model->displaySelected($table5, $deal_where, $option_where); ?> 
<?php foreach($sql5 as $row5) : ?>
<?php $o_encrypt = ((htmlentities($row5->option_id))*8)+8; ?>
<?php $o_decrypt = (($o_encrypt)-8)/8; ?>
<?php $o_encrypt_count = strlen($o_encrypt); ?>
<?php $option_id_hash = md5($o_encrypt . "" . time() . "" . $o_decrypt) . "" . time() . "" . $o_encrypt; ?>
                                    <input id="options" class="options_solo<?php echo $select_count; ?>_<?php echo $option_count; ?>" type="text" name="editDoption_solo<?php echo $select_count; ?>_<?php echo $option_count; ?>" value="<?php echo htmlentities($row5->option_name); ?>" maxlength="20" required="required">
                                    <input type="hidden" name="editDoptionNo<?php echo $select_count; ?>_<?php echo $option_count; ?>" value="<?php echo $o_encrypt_count; ?>">
                                    <input type="hidden" name="editDoption_hash<?php echo $select_count; ?>_<?php echo $option_count; ?>" value="<?php echo $option_id_hash; ?>">
<?php $option_count=$option_count+1; ?>
<?php endforeach ?>
                                </div>
                                <label id="options">Original Stock</label>
                                <div id="deal_Ostock_solo<?php echo $select_count; ?>">
<?php foreach($sql5 as $row5) : ?>
                                    <input id="options" class="options_solo<?php echo $select_count; ?>_<?php echo $Ostock_count; ?>" type="text" name="editOStock_solo<?php echo $select_count; ?>_<?php echo $Ostock_count; ?>" value="<?php echo htmlentities($row5->deal_original_stock); ?>" maxlength="10" required="required">
<?php $Ostock_count=$Ostock_count+1; ?>
<?php endforeach ?> 
                                </div>
                                <label id="options">Current Stock</label>
                                <div id="deal_Cstock_solo<?php echo $select_count; ?>">
<?php foreach($sql5 as $row5) : ?>
                                    <input id="options" class="options_solo<?php echo $select_count; ?>_<?php echo $Cstock_count; ?>" type="text" name="editCStock_solo<?php echo $select_count; ?>_<?php echo $Cstock_count; ?>" value="<?php echo htmlentities($row5->deal_current_stock); ?>" maxlength="10" required="required">
<?php $Cstock_count=$Cstock_count+1; ?>
<?php endforeach ?> 
                                </div>
                                <label id="options"><a href="add_more_option_solo<?php echo $select_count; ?>" id="add_more_option_solo<?php echo $select_count; ?>">Add More Option(s) and Stock(s)</a></label>
                                <input type="hidden" name="mOPTION_solo<?php echo $select_count; ?>" id="mOPTION_solo<?php echo $select_count; ?>" value="<?php echo $option_count-1; ?>">
                                <input type="hidden" name="nOPTION_solo<?php echo $select_count; ?>" id="nOPTION_solo<?php echo $select_count; ?>" value="<?php echo $option_count-1; ?>"> 
                            </fieldset>
<?php $select_count=$select_count+1; ?>
<?php endforeach ?>
<?php endif ?> 
                        </div>
<?php if($row2->deal_option == 0) : ?>
                        <fieldset>
                           <label><a href="add_more_selection_solo" id="add_more_selection_solo">Add More Selection(s)</a></label>
                           <input type="hidden" name="mSELECTION_solo" id="mSELECTION_solo" value="<?php echo $select_count-1; ?>">
                           <input type="hidden" name="nSELECTION_solo" id="nSELECTION_solo" value="<?php echo $select_count-1; ?>">
                        </fieldset>
<?php endif ?>
                    </div>
                </article>
                <br>
                <fieldset>
                    <label>Highlights</label>
                    <div id="deal_highlights_solo">
<?php $highlight_count=1; ?>
<?php foreach($sql6 as $row6) : ?>
<?php $h_encrypt = ((htmlentities($row6->highlight_id))*8)+8; ?>
<?php $h_decrypt = (($h_encrypt)-8)/8; ?>
<?php $h_encrypt_count = strlen($h_encrypt); ?>
<?php $highlight_id_hash = md5($h_encrypt . "" . time() . "" . $h_decrypt) . "" . time() . "" . $h_encrypt; ?>
                        <input id="highlights" class="single_id H<?php echo $highlight_count; ?>" type="text" name="editH_solo<?php echo $highlight_count; ?>" value="<?php echo xss_cleaner($row6->highlight_content); ?>" maxlength="255" required="required">
                        <input class="single_id H<?php echo $highlight_count; ?>" type="hidden" name="editHNo<?php echo $highlight_count; ?>" value="<?php echo $h_encrypt_count; ?>">
                        <input class="single_id H<?php echo $highlight_count; ?>" type="hidden" name="editH_hash<?php echo $highlight_count; ?>" value="<?php echo $highlight_id_hash; ?>">
<?php $highlight_count=$highlight_count+1; ?>
<?php endforeach ?>
                    </div>
                    <label><a href="add_more_highlights_solo" id="add_more_highlights_solo">Add More Highlight(s)</a></label>
                    <span id="icn_remove" class="input_remove H off" count_a="<?php echo $highlight_count-1; ?>" title="Remove Last Line"></span>
                    <input type="hidden" name="mH_solo" id="mH_solo" value="<?php echo $highlight_count-1; ?>">
                    <input type="hidden" name="nH_solo" id="nH_solo" value="<?php echo $highlight_count-1; ?>">
                </fieldset>
                <fieldset>
                    <label>Terms</label>
                    <div id="deal_terms_solo">
<?php $term_count=1; ?>
<?php foreach($sql7 as $row7) : ?>
<?php $t_encrypt = ((htmlentities($row7->fineprint_id))*8)+8; ?>
<?php $t_decrypt = (($t_encrypt)-8)/8; ?>
<?php $t_encrypt_count = strlen($t_encrypt); ?>
<?php $fineprint_id_hash = md5($t_encrypt . "" . time() . "" . $t_decrypt) . "" . time() . "" . $t_encrypt; ?>
                        <input id="terms" class="single_id T<?php echo $term_count; ?>" type="text" name="editT_solo<?php echo $term_count; ?>" value="<?php echo xss_cleaner($row7->fineprint_content); ?>" maxlength="255" required="required">
                        <input class="single_id T<?php echo $term_count; ?>" type="hidden" name="editTNo<?php echo $term_count; ?>" value="<?php echo $t_encrypt_count; ?>">
                        <input class="single_id T<?php echo $term_count; ?>" type="hidden" name="editT_hash<?php echo $term_count; ?>" value="<?php echo $fineprint_id_hash; ?>">
<?php $term_count=$term_count+1; ?>
<?php endforeach ?>
                    </div>
                    <label><a href="add_more_terms_solo" id="add_more_terms_solo">Add More Term(s)</a></label>
                    <span id="icn_remove" class="input_remove T off" count_a="<?php echo $term_count-1; ?>" title="Remove Last Line"></span>
                    <input type="hidden" name="mT_solo" id="mT_solo" value="<?php echo $term_count-1; ?>">
                    <input type="hidden" name="nT_solo" id="nT_solo" value="<?php echo $term_count-1; ?>">
                </fieldset>
                <fieldset>
                    <label>Content</label>
                    <textarea id="content" name="editContent_solo" required="required"><?php echo xss_cleaner($row2->deal_content); ?></textarea>
                </fieldset>
            </div>
    </article>
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
                    <input id="locations" type="text" name="editLocation<?php echo $location_count; ?>" value="<?php echo  xss_cleaner($row8->location_address); ?>" required="required">
                    <label>Map Link <font color="green"> ( <a href="<?php if($row8->location_link=="") { echo "http://maps.google.com.ph"; } else { echo $row8->location_link; } ?>" target="_new" id="view_map" title="Get the Map Link on the Google Map"> Open Google Map </a> )</font></label>
                    <textarea id="locations" class="link" name="editLink<?php echo $location_count; ?>"><?php echo $row8->location_link; ?></textarea>
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
    <article class="module width_full">
        <div style="text-align: right;">
            <div style="margin: 20px;">
                <fieldset>
                    <input type="button" value="Back" onclick="window.history.back();">
                    <input class="alt_btn" type="submit" name="update" value="Update"/>
                </fieldset>
            </div>        
        </div>
    </article>
</form>
<?php endforeach ?>
<?php endforeach ?>
</div>
