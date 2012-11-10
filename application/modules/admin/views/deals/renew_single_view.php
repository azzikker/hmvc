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
    var discounted_single = new discounted_single(); 
    var add_more_option_single = new add_more_option_single();
    var add_more_highlights_single = new add_more_highlights_single();
    var add_more_terms_single = new add_more_terms_single();
    var add_more_location_single = new add_more_location_single(); 
</script>
<!--END OF JS-->
                                                             
<div class = "edit_member" style="/*display: none;*/">
<?php foreach($sql1 as $row1): ?>
<?php foreach($sql2 as $row2): ?>
<form action="<?php echo base_url(); ?>admin/admin_deals/resave_single_deal/<?php echo $this->uri->segment(4); ?>/<?php echo $this->uri->segment(5); ?>" method="post" enctype="multipart/form-data">
    <article class="module width_full">
        <header>
<?php $deal_view_title = shortenString($row1->deal_view_title, 40); ?>
            <h3 class="tabs_involved">Deals - <?php echo $row1->deal_view_type; ?> - <?php echo $deal_view_title[0]; ?></h3>
        </header>
            <div id="deal_header"></div>
            <div style="margin: 20px;">
                <div id="deal_type">
                    <fieldset style="display: none;">
                        <label>Deal Company</label>
                        <select name="addDCO">
<?php foreach($sql9b as $row9b): ?>
                            <option value="<?php echo htmlentities($row9b->company_id); ?>" selected="selected"><?php echo $row9b->company_name; ?></option>
<?php endforeach ?>                             
                        </select>                   
                        <label>Deal Category</label>
                        <select name="addDC">
<?php foreach($sqlb as $rowb): ?>
                            <option value="<?php echo htmlentities($rowb->category_id); ?>" selected="selected"><?php echo $rowb->category_name; ?></option>
<?php endforeach ?>
                        </select>
                        <label>Deal Type</label>
                        <select id="type" name="addDT" onchange="deal_type()">
                            <option value="Single Deal" selected="selected"><?php echo htmlentities($row1->deal_view_type); ?></option>
                        </select>
                    </fieldset>
                </div>
                <fieldset style="display: none;">
                    <label id="main_title">Deal Title</label>
                    <input type="text" name="addMDN" value="<?php echo $row1->deal_view_title; ?>" maxlength="60" required="required">
                    <label id="main_statement">Deal Statement</label>
                    <input type="text" name="addMDS" value="<?php echo $row1->deal_view_statement; ?>" maxlength="100" required="required">
                    <input type="hidden" name="addSubH" value="<?php echo htmlentities($row2->deal_subhash); ?>">
                </fieldset>
<?php $m = "m"; ?>
<?php $d = "d"; ?>
<?php $y = "Y"; ?>
                <fieldset id="enabled">
                    <label>Start of Deal</label>
                    <input id="datepicker1" type="text" name="addSOD" value="<?php echo date($m . "/" . $d . "/" . $y, time()); ?>" required="required">
                    <label>End of Deal</label>
                    <input id="datepicker2" type="text" name="addEOD" value="<?php echo date($m . "/" . $d . "/" . $y, strtotime(date($y, time()) . "+ 1 month")); ?>" required="required">
                </fieldset>
                <fieldset style="display: none;">
                        <label>Embeded Code ( <a href="http://www.youtube.com/" target="_new" title="Get YOU TUBE embeded code">You Tube</a> )</label>
                        <textarea id="locations" class="link" name="addDV_single"><?php foreach($sql0 as $row0) : ?><?php echo $row0->video_embed; ?><?php endforeach ?></textarea>
                    </fieldset>
                <fieldset id="enabled">
                    <label>Original Price</label>
                    <input class="original_solo" type="text" name="addOP" autocomplete="off" value="<?php echo htmlentities($row2->deal_original_price); ?>" maxlength="10" required="required">
                    <label>Discount (%)</label>
                    <input class="discount_solo" type="text" name="addD" autocomplete="off" value="<?php echo htmlentities($row2->deal_discount); ?>" maxlength="10" required="required">
                    <label>Discounted Price</label>
                    <input class="discounted_solo" type="text" disabled="disabled" value="<?php echo htmlentities($row2->deal_discounted_price); ?>" required="required">
                    <input class="discounted_solo" type="hidden" name="addDP" value="<?php echo htmlentities($row2->deal_discounted_price); ?>">
                </fieldset>
                <article class="module width_full" style="display: block;"> 
                    <header><h3></h3></header>
                    <div style="margin: 20px;">
                        <div id="deal_selections_solo">
                            <input type="hidden" name="addOPT" value="<?php echo htmlentities($row2->deal_option); ?>">
<?php if(htmlentities($row2->deal_option) == 1) : ?>
                            <fieldset id="enabled">
                                <label>Current Stock</label>        
                                <input class="addCStock" type="text" name="addCStock" autocomplete="off" value="<?php echo htmlentities($row2->deal_current_stock); ?>" maxlength="10" required="required">
                                <input class="addCStock_old" type="hidden" name="addCStock_old" value="<?php echo htmlentities($row2->deal_current_stock); ?>">
                            </fieldset>
<?php else : ?>
<?php $select_count=1; ?>
<?php foreach($sql4 as $row4) : ?>
<?php $s_encrypt = ((htmlentities($row4->selection_id))*8)+8; ?>
<?php $s_decrypt = (($s_encrypt)-8)/8; ?>
<?php $s_encrypt_count = strlen($s_encrypt); ?>
<?php $select_id_hash = md5($s_encrypt . "" . time() . "" . $s_decrypt) . "" . time() . "" . $s_encrypt; ?>
                            <fieldset>
                                <label>Selection</label>
                                <input type="text" name="addDselect_single<?php echo $select_count; ?>" value="<?php echo $row4->selection_name; ?>" maxlength="20" required="required">
                                <input type="hidden" name="addDselectNo<?php echo $select_count; ?>" value="<?php echo $s_encrypt_count; ?>">
                                <input type="hidden" name="addDselect_hashA<?php echo $select_count; ?>" value="<?php echo $select_id_hash; ?>">
                                <input type="hidden" name="addDselect_hashB<?php echo $select_count; ?>" value="<?php echo htmlentities($row4->selection_hash); ?>">
                                <label id="options">Options</label>
                                <div id="deal_options_single<?php echo $select_count; ?>">
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
                                    <input id="options" class="options_single<?php echo $select_count; ?>_<?php echo $option_count; ?>" type="text" name="addDoption_single<?php echo $select_count; ?>_<?php echo $option_count; ?>" maxlength="20" value="<?php echo $row5->option_name; ?>" required="required">
                                    <input type="hidden" name="addDoptionNo<?php echo $select_count; ?>_<?php echo $option_count; ?>" value="<?php echo $o_encrypt_count; ?>">
                                    <input type="hidden" name="addDoption_hash<?php echo $select_count; ?>_<?php echo $option_count; ?>" value="<?php echo $option_id_hash; ?>">
<?php $option_count=$option_count+1; ?>
<?php endforeach ?>
                                </div>
                                <label id="options">Stock</label>
                                <div id="deal_stock_single<?php echo $select_count; ?>">
<?php foreach($sql5 as $row5) : ?>
                                    <input id="options" class="options_stock<?php echo $select_count; ?>_<?php echo $Cstock_count; ?>" type="text" name="addStock_single<?php echo $select_count; ?>_<?php echo $Cstock_count; ?>" value="<?php echo htmlentities($row5->deal_current_stock); ?>" required="required">
<?php $Cstock_count=$Cstock_count+1; ?>
<?php endforeach ?> 
                                </div>
<?php if($this->session->userdata('user_level') == 99) : ?>
                                <label id="options"><a href="add_more_option_single<?php echo $select_count; ?>" id="add_more_option_single<?php echo $select_count; ?>">Add More Option(s) and Stock(s)</a></label> 
<?php endif ?>
                                <input type="hidden" name="nOPTION_single<?php echo $select_count; ?>" id="nOPTION_single<?php echo $select_count; ?>" value="<?php echo $option_count-1; ?>"> 
                            </fieldset>
<?php $select_count=$select_count+1; ?>
<?php endforeach ?>                            
<?php endif ?>
                        </div>
<?php if(htmlentities($row2->deal_option) == 0) : ?>
<?php if($this->session->userdata('user_level') == 99) : ?>
                        <fieldset>
                           <label><a href="add_more_selection_single" id="add_more_selection_single">Add More Selection(s)</a></label>
<?php endif ?>
                           <input type="hidden" name="nSELECTION_single" id="nSELECTION_single" value="<?php echo $select_count-1; ?>">
<?php if($this->session->userdata('user_level') == 99) : ?>
                        </fieldset>
<?php endif ?>
<?php endif ?>
                    </div>
                </article>
                <br>
                <fieldset style="display: none;">
                    <label>Highlights</label>
                    <div id="deal_highlights_solo">
<?php $highlight_count=1; ?>
<?php foreach($sql6 as $row6) : ?>
<?php $h_encrypt = ((htmlentities($row6->highlight_id))*8)+8; ?>
<?php $h_decrypt = (($h_encrypt)-8)/8; ?>
<?php $h_encrypt_count = strlen($h_encrypt); ?>
<?php $highlight_id_hash = md5($h_encrypt . "" . time() . "" . $h_decrypt) . "" . time() . "" . $h_encrypt; ?>
                        <input id="highlights" type="text" name="addH_single<?php echo $highlight_count; ?>" value="<?php echo $row6->highlight_content; ?>" maxlength="255" required="required">
                        <input type="hidden" name="addHNo<?php echo $highlight_count; ?>" value="<?php echo $h_encrypt_count; ?>">
                        <input type="hidden" name="addH_hash<?php echo $highlight_count; ?>" value="<?php echo $highlight_id_hash; ?>">
<?php $highlight_count=$highlight_count+1; ?>
<?php endforeach ?>
                    </div>
                    <input type="hidden" name="nH_single" id="nH_single" value="<?php echo $highlight_count-1; ?>">
                </fieldset>
                <fieldset style="display: none;">
                    <label>Terms</label>
                    <div id="deal_terms_single">
<?php $term_count=1; ?>
<?php foreach($sql7 as $row7) : ?>
<?php $t_encrypt = ((htmlentities($row7->fineprint_id))*8)+8; ?>
<?php $t_decrypt = (($t_encrypt)-8)/8; ?>
<?php $t_encrypt_count = strlen($t_encrypt); ?>
<?php $fineprint_id_hash = md5($t_encrypt . "" . time() . "" . $t_decrypt) . "" . time() . "" . $t_encrypt; ?>
                        <input id="terms" type="text" name="addT_single<?php echo $term_count; ?>" value="<?php echo $row7->fineprint_content; ?>" maxlength="255" required="required">
                        <input type="hidden" name="addTNo<?php echo $term_count; ?>" value="<?php echo htmlentities($t_encrypt_count); ?>">
                        <input type="hidden" name="addT_hash<?php echo $term_count; ?>" value="<?php echo $fineprint_id_hash; ?>">
<?php $term_count=$term_count+1; ?>
<?php endforeach ?>
                    </div>
                    <input type="hidden" name="nT_single" id="nT_single" value="<?php echo $term_count-1; ?>">
                </fieldset>
                <fieldset style="display: none;">
                    <label>Content</label>
                    <textarea id="content" name="addContent_single" required="required"><?php echo $row2->deal_content; ?></textarea>
                </fieldset>
            </div>
    </article>
    <article class="module width_full" style="display: none;">
        <header><h3>Locations</h3></header>
        <div style="margin: 20px;">
            <div id="deal_locations">
<?php $location_count=1; ?>
<?php foreach($sql8 as $row8) : ?>
<?php $l_encrypt = ((htmlentities($row8->location_id))*8)+8; ?>
<?php $l_decrypt = (($l_encrypt)-8)/8; ?>
<?php $l_encrypt_count = strlen($l_encrypt); ?>
<?php $location_id_hash = md5($l_encrypt . "" . time() . "" . $l_decrypt) . "" . time() . "" . $l_encrypt; ?>
                <fieldset>
                    <label>Address</label>
                    <input id="locations" type="text" name="addLocation<?php echo $location_count; ?>" value="<?php echo $row8->location_address; ?>" required="required">
                    <label>Map Link</label>
                    <textarea id="locations" class="link" name="addLink<?php echo $location_count; ?>"><?php echo $row8->location_link; ?></textarea>
                    <input type="hidden" name="addLinkNo<?php echo $location_count; ?>" value="<?php echo $l_encrypt_count; ?>">
                    <input type="hidden" name="addHash<?php echo $location_count; ?>" value="<?php echo $location_id_hash; ?>">
                </fieldset>
<?php $location_count=$location_count+1; ?>
<?php endforeach ?>
            </div>
            <fieldset>
                <input type="hidden" name="nLOCATION" id="nLOCATION" value="<?php echo $location_count-1; ?>">
            </fieldset>
        </div>
    </article>
    <article class="module width_full">
        <div style="text-align: right;">
            <div style="margin: 20px;">
                <fieldset>
                    <input type="button" value="Back" onclick="window.history.back();">
                    <input class="alt_btn" type="submit" name="renew" value="Renew"/>
                </fieldset>
            </div>        
        </div>
    </article>
</form>
<?php endforeach ?>
<?php endforeach ?>
</div>