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
    var discounted_group = new discounted_group(); 
    var add_more_selection_group = new add_more_selection_group();
    var add_more_option_group = new add_more_option_group();
    var add_more_highlights_group = new add_more_highlights_group();
    var add_more_terms_group = new add_more_terms_group();
    var add_more_location = new add_more_location(); 
</script>
<!--END OF JS-->

<div class = "edit_member" style="/*display: none;*/">
<?php foreach($sql1 as $row1) : ?>
<?php $deal_where["deal_hash"] = $this->uri->segment(5); ?>
<form action="<?php echo base_url(); ?>admin/admin_deals/resave_group_deal/<?php echo $this->uri->segment(4); ?>/<?php echo $this->uri->segment(5); ?>" method="post" enctype="multipart/form-data">
    <article class="module width_full">
<?php $deal_view_title = shortenString($row1->deal_view_title, 40); ?>
        <header><h3>Deals - <?php echo htmlentities($row1->deal_view_type); ?> - <?php echo $deal_view_title[0]; ?></h3></header>
            <div id="deal_header"></div>
            <div style="margin: 20px;">
                <div id="deal_type" style="display: none;">
                    <fieldset>
                        <label>Deal Company</label>
                        <select name="addDCO" required="required">                      
<?php foreach($sql9b as $row9b): ?>
                            <option value="<?php echo htmlentities($row9b->company_id); ?>" selected="selected"><?php echo htmlentities($row9b->company_name); ?></option>
<?php endforeach ?>                       
                        </select>
                        <label>Deal Category</label>
                        <select name="addDC" value="" required="required">
<?php foreach($sqlb as $rowb): ?>
                            <option value="<?php echo htmlentities($rowb->category_id); ?>" selected="selected"><?php echo htmlentities($rowb->category_name); ?></option>
<?php endforeach ?>
                        </select>
                        <label>Deal Type</label>
                        <select id="type" name="addDT" onchange="deal_type()">
                            <option value="Group Deal">Group Deal</option>
                        </select>
                    </fieldset>
                </div>
                <fieldset style="display: none;">
                    <label id="main_title">Main Title</label>
                    <input type="text" name="addMDN" value="<?php echo $row1->deal_view_title; ?>" maxlength="60" required="required">
                    <label id="main_statement">Main Statement</label>
                    <input type="text" name="addMDS" value="<?php echo $row1->deal_view_statement; ?>" maxlength="100" required="required">
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
                <div id="deals_group" style="/*display: none;*/">
                    <br><hr>
<?php $deal_count = 1; ?>
<?php foreach($sql2 as $row2) : $deal_subwhere["deal_subhash"] = htmlentities($row2->deal_subhash); ?>
                    <article class="module width_full">
                        <header><h3>Deal <?php echo htmlentities($deal_count); ?> - <?php echo $row2->deal_title; ?></h3></header>
                        <div style="margin: 20px;">
                            <fieldset style="display: none;">
                               <label>Deal Title</label><input type="text" name="addDN<?php echo $deal_count; ?>" value="<?php echo $row2->deal_title; ?>" maxlength="60" >
                               <label>Deal Statement</label><input type="text" name="addDS<?php echo $deal_count; ?>" value="<?php echo $row2->deal_statement; ?>" maxlength="100" >
                            </fieldset>
                            <fieldset id="enabled">
                                <label>Original Price</label>
                                <input class="original_group<?php echo $deal_count; ?>" type="text" name="addOP<?php echo $deal_count; ?>" autocomplete="off" value="<?php echo htmlentities($row2->deal_original_price); ?>" maxlength="10" >
                                <label>Discount (%)</label>
                                <input class="discount_group<?php echo $deal_count; ?>" type="text" name="addD<?php echo $deal_count; ?>" autocomplete="off" value="<?php echo htmlentities($row2->deal_discount); ?>" maxlength="10" >
                                <label>Discounted Price</label>
                                <input class="discounted_group<?php echo $deal_count; ?>" type="text" value="<?php echo htmlentities($row2->deal_discounted_price); ?>" disabled="disabled">
                                <input class="discounted_group<?php echo $deal_count; ?>" type="hidden" name="addDP<?php echo $deal_count; ?>" value="<?php echo htmlentities($row2->deal_discounted_price); ?>">
                            </fieldset>  
                            <article class="module width_full" style="display: blcok;">
                                <header><h3></h3></header>
                                <div style="margin: 20px;">
                                    <div id="deal_selections_group<?php echo $deal_count; ?>">
                                        <input type="hidden" name="addOPT<?php echo $deal_count; ?>" value="<?php echo htmlentities($row2->deal_option); ?>">
<?php if(htmlentities($row2->deal_option) == 1) : ?>
                             <fieldset id="enabled">
                                <label>Stock</label>
                                <input type="text" name="addCStock<?php echo $deal_count; ?>" value="<?php echo $row2->deal_current_stock; ?>" >
                            </fieldset>
<?php else : ?>
<?php $select_count = 1; ?>
<?php $table4 = "deal_selection";  ?>
<?php $sql4 = $this->Deals_Selection_Model->displaySelected($table4, $deal_subwhere); ?>
<?php foreach($sql4 as $row4) : ?>
                                        <fieldset>
                                            <label>Selection</label>
                                            <input type="text" name="addDselect_group<?php echo $deal_count; ?>_<?php echo $select_count; ?>" value="<?php echo htmlentities($row4->selection_name); ?>" maxlength="20">
                                            <label id="options">Options</label>
                                            <div id="deal_options_group<?php echo $deal_count; ?>_<?php echo $select_count; ?>">
<?php $option_count = 1; $Cstock_count=1; ?>
<?php $table5 = "deal_option"; ?>
<?php $option_where["selection_hash"] = htmlentities($row4->selection_hash); ?>
<?php $sql5 = $this->Deals_Option_Model->displaySelected($table5, $deal_where, $option_where); ?>
<?php foreach($sql5 as $row5) : ?>
                                                <input id="options" class="options_group<?php echo $deal_count; ?>_<?php echo $select_count; ?>_<?php echo $option_count; ?>" type="text" name="addDoption_group<?php echo $deal_count; ?>_<?php echo $select_count; ?>_<?php echo $option_count; ?>" value="<?php echo htmlentities($row5->option_name); ?>">
<?php $option_count = $option_count+1; ?>
<?php endforeach ?>
                                            </div>
                                            <label id="options">Stock</label>
                                            <div id="deal_stock_group<?php echo $deal_count; ?>_<?php echo $select_count; ?>">
<?php foreach($sql5 as $row5) : ?>
                                                <input id="options" class="options_group<?php echo $deal_count; ?>_<?php echo $select_count; ?>_<?php echo $Cstock_count; ?>" type="text" name="addStock_group<?php echo $deal_count; ?>_<?php echo $select_count; ?>_<?php echo $Cstock_count; ?>" value="<?php echo htmlentities($row5->deal_current_stock); ?>">
<?php $Cstock_count=$Cstock_count+1; ?>
<?php endforeach ?> 
                                            </div>
<?php if($this->session->userdata('user_level') == 99) : ?>
                                            <label id="options"><a href="add_more_option_group<?php echo $deal_count; ?>_<?php echo $select_count; ?>" id="add_more_option_group<?php echo $deal_count; ?>_<?php echo $select_count; ?>">Add More Option(s) and Stock(s)</a></label>
<?php endif ?>
                                            <input type="hidden" name="nOPTION_group<?php echo $deal_count; ?>_<?php echo $select_count; ?>" id="nOPTION_group<?php echo $deal_count; ?>_<?php echo $select_count; ?>" value="<?php echo $option_count-1; ?>">
                                        </fieldset>
                                        </div>
<?php $select_count = $select_count+1; ?>
<?php endforeach ?>
<?php endif ?>                  
                                </div>
<?php if(htmlentities($row2->deal_option) == 0) : ?>
<?php if($this->session->userdata('user_level') == 99) : ?>
                                <fieldset>
<?php endif ?>
                                   <input type="hidden" name="nSELECTION_group<?php echo $deal_count; ?>" id="nSELECTION_group<?php echo $deal_count; ?>" value="<?php echo $select_count-1; ?>">
<?php if($this->session->userdata('user_level') == 99) : ?>
                                </fieldset>
<?php endif ?>                     
<?php endif ?>                     
                            </article>
                            <br>
                            <fieldset style="display: none;">
                                <label>Highlights</label>
                                <div id="deal_highlights_group<?php echo $deal_count; ?>">
<?php $highlight_count = 1; ?>
<?php $table6 = "deal_highlight";  ?>
<?php $sql6 = $this->Deals_Highlight_Model->displaySelected($table6, $deal_subwhere); ?>
<?php foreach($sql6 as $row6) : ?>
                                    <input id="highlights" type="text" name="addH_group<?php echo $deal_count; ?>_<?php echo $highlight_count; ?>" value="<?php echo $row6->highlight_content; ?>" maxlength="255">
<?php $highlight_count = $highlight_count+1; ?>
<?php endforeach ?>
                                </div>
                                <input type="hidden" name="nH_group<?php echo $deal_count; ?>" id="nH_group<?php echo $deal_count; ?>" value="<?php echo htmlentities($highlight_count)-1; ?>">
                            </fieldset>
                            <fieldset style="display: none;">
                                <label>Terms</label>
                                <div id="deal_terms_group<?php echo $deal_count; ?>">
<?php $term_count = 1; ?>
<?php $table7 = "deal_fineprint";  ?>
<?php $sql7 = $this->Deals_Term_Model->displaySelected($table7, $deal_subwhere); ?>
<?php foreach($sql7 as $row7) : ?>
                                    <input id="terms" type="text" name="addT_group<?php echo $deal_count; ?>_<?php echo $term_count; ?>" value="<?php echo $row7->fineprint_content; ?>" maxlength="255">
<?php $term_count = $term_count+1; ?>
<?php endforeach ?>
                                </div>
                                <input type="hidden" name="nT_group<?php echo $deal_count; ?>" id="nT_group<?php echo $deal_count; ?>" value="<?php echo $term_count-1; ?>">
                            </fieldset>
                            <fieldset style="display: none;">
                                <label>Content</label>
                                <textarea id="content" name="addContent_group<?php echo $deal_count; ?>"><?php echo $row2->deal_content; ?></textarea>
                            </fieldset>
                            <fieldset style="display: none;">
                                <label>Deal Cover</label>
<?php $table3 = "deal_gallery";  ?>
<?php $sql3 = $this->Deals_Term_Model->displaySelected($table3, $deal_subwhere); ?>
<?php foreach($sql3 as $row3) : ?>
                                <input type="text" name="addMC<?php echo $deal_count; ?>" value="<?php echo time() . rand(10000,99999) .  ".jpg"; ?>" required="required">
                                <input type="hidden" name="addMC_old<?php echo $deal_count; ?>" value="<?php echo $row3->gallery_filename; ?>">
<?php endforeach ?>
                            </fieldset>
                            <fieldset style="display: none;">
                                <label>Embeded Code ( <a href="http://www.youtube.com/" target="_new" title="Get YOU TUBE embeded code">You Tube</a> )</label>
                                <textarea id="locations" class="link" name="addDV_group<?php echo $deal_count; ?>"><?php echo $row2->video_embed; ?></textarea>
                            </fieldset>
                        </div>
                    </article>
<?php $deal_count = $deal_count+1; ?>
<?php endforeach ?>
                </div>
                <div id="add_more" style="display: none;">
                    <fieldset>
                       <input type="hidden" name="nDEAL" id="nDEAL" value="<?php echo $deal_count-1; ?>">
                    </fieldset>
                </div>
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
                    <label>Map Link <font color="green"> ( <a href="<?php if($row8->location_link=="") { echo "http://maps.google.com.ph"; } else { echo $row8->location_link; } ?>" target="_new" id="view_map" title="Get the Map Link on the Google Map"> Open Google Map </a> )</font></label>
                    <textarea id="locations" class="link" name="addLink<?php echo $location_count; ?>"><?php echo $row8->location_link; ?></textarea>
                    <input type="hidden" name="editLinkNo<?php echo $location_count; ?>" value="<?php echo $l_encrypt_count; ?>">
                    <input type="hidden" name="editHash<?php echo $location_count; ?>" value="<?php echo $location_id_hash; ?>">
                </fieldset>
<?php $location_count=$location_count+1; ?>
<?php endforeach ?>
            </div>
            <fieldset>
                <input type="hidden" name="nLOCATION" id="nLOCATION" value="1">
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
</div>