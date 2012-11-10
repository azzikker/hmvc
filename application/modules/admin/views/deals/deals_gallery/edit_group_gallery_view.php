<!--START OF CSS-->
<link rel="stylesheet" type="text/css" href="assets/general/set/jtps/jtps.css">
<link rel="stylesheet" type="text/css" href="assets/admin/set/HoverLightbox/css/horizontal.css">
<link rel="stylesheet" type="text/css" href="assets/admin/set/colorpicker/css/colorpicker.css">
<!--link rel="stylesheet" type="text/css" href="assets/admin/set/colorpicker/css/layout.css"-->
<!--END OF CSS-->
<!--START OF JS-->
<script type="text/javascript" src="assets/general/js/jquery.js"></script>
<script type="text/javascript" src="assets/general/set/jtps/jtps.js"></script>
<script type="text/javascript" src="assets/admin/set/colorpicker/js/colorpicker.js"></script>
<script type="text/javascript" src="assets/admin/set/colorpicker/js/eye.js"></script>
<script type="text/javascript" src="assets/admin/set/colorpicker/js/utils.js"></script>
<script type="text/javascript" src="assets/admin/set/colorpicker/js/layout.js?ver=1.0.2"></script>
<script type="text/javascript" src="assets/admin/js/datagrid.js"></script>
<script type="text/javascript" src="assets/admin/set/HoverLightbox/js/lightbox.js"></script>

<script type="text/javascript">
    var discounted_single = new discounted_single();
    var add_more_selection_single = new add_more_selection_single();
    var add_more_option_single = new add_more_option_single();
    var add_more_highlights_single = new add_more_highlights_single();
    var add_more_terms_single = new add_more_terms_single();
    var stock_option_single = new stock_option_single();
    var add_more_location_solo = new add_more_location_solo();
</script>
<!--END OF JS-->

<div class = "list_member" style="/*display: none;*/">
    <form class="form" onsubmit="return eft(this)" action="<?php echo base_url(); ?>admin/admin_deals_gallery/update_gallery_group_deal/<?php echo $this->uri->segment(4); ?>/<?php echo $this->uri->segment(5); ?>" method="post" enctype="multipart/form-data">
<?php foreach($sql1 as $row1) : ?>
<?php $main_image = "assets/general/images/deals_gallery/customize/" . htmlentities($row1->deal_image); ?>
<?php $background_image = "assets/general/images/background/customize/" . htmlentities($row1->deal_background); ?>
    <article class="module width_full">
        <header>
            <h3 class="tabs_involved">Deals - <?php echo xss_cleaner($row1->deal_view_type); ?> ( Gallery ) - <?php echo xss_cleaner($row1->deal_view_title); ?></h3>
<?php if($this->session->userdata('user_level') == 3) : ?> 
            <ul class="tabs">
                <li>        
                    <a href="<?php echo base_url(); ?>admin/admin_deals/edit_group_deal/<?php echo $this->uri->segment(4); ?>/<?php echo $this->uri->segment(5); ?>">
                        Manage Information
                    </a>
                </li>
            </ul>
<?php elseif($this->session->userdata('user_level') == 0) : ?>
            <ul class="tabs">
                <li>        
                    <a href="<?php echo base_url(); ?>admin/admin_deals/edit_group_deal/<?php echo $this->uri->segment(4); ?>/<?php echo $this->uri->segment(5); ?>">
                        Manage Information
                    </a>
                </li>
                <li>        
                    <a href="<?php echo base_url(); ?>admin/admin_deals/profile_group_deal/<?php echo $this->uri->segment(4); ?>/<?php echo $this->uri->segment(5); ?>">
                        View Profile
                    </a>
                </li>
            </ul>
<?php else : ?> 
            <ul class="tabs">
                <li>        
                    <a href="<?php echo base_url(); ?>admin/admin_deals/profile_group_deal/<?php echo $this->uri->segment(4); ?>/<?php echo $this->uri->segment(5); ?>">
                        View Profile
                    </a>
                </li>
            </ul> 
<?php endif ?>   
        </header>
        <div class = "display_member" style="/*display: none;*/">
            <div style="margin: 20px;">
                    <div align="center"> 
                        <a href="assets/general/images/deals_gallery/optimize/<?php echo htmlentities($row1->deal_image); ?>" rel="lightbox">
                            <img class="deal-image" src="<?php echo $main_image; ?>" border="0" width="240" height="105">
                        </a>
                    </div>
<?php if($this->session->userdata('user_level') == 3 || $this->session->userdata('user_level') == 0) : ?>
                <fieldset>
                    <label>Change Main Cover</label>
                    <input id="image_upload" type="file" name="editMMC" value="" <?php if($main_image == "assets/general/images/deals_gallery/customize/") : ?> required="required" <?php endif ?>>
<?php if(isset($_GET['error1']) == 1):?>
                    <h4 class="alert_error">The image(s) didn't fit(s) the required size.</h4>
<?php endif; ?>
<?php if(isset($_GET['error2']) == 1):?>
                    <h4 class="alert_error">The image(s) didn't fit(s) the required filetype.</h4>
<?php endif; ?>
                    <h4 class="alert_info">Required Image: (690 x 242) to (750 x 263) pixels JPG/JPEG</h4>
                </fieldset> 
<?php endif ?>              
            </div>
            <div id = "add_member" style="/*display: none;*/">
                <article class="module width_full">
                    <header><h3>Video</h3></header>
                    <div style="margin: 20px;">
                        <fieldset>
                            <div align="center" class="video_frame">
                                <span><?php foreach($sql1 as $row1) : ?><?php echo htmlentities($row1->deal_video); ?><?php endforeach ?></span>
                            </div>
                        </fieldset>
<?php if($this->session->userdata('user_level') == 3 || $this->session->userdata('user_level') == 0) : ?>
                        <fieldset>
                            <label>Embeded Code ( <a href="<?php echo "http://www.youtube.com/"; ?>" target="_new" title="Get YOU TUBE embeded code">You Tube</a> )</label>
                            <textarea id="locations" class="link vid" name="editMDV"><?php foreach($sql1 as $row1) : ?><?php echo $row1->deal_video; ?><?php endforeach ?></textarea>
                        </fieldset>
<?php endif ?>
                    </div>
                </article>
            </div>
        </div>
<?php if($this->session->userdata('user_level') == 3 || $this->session->userdata('user_level') == 0) : ?>
        <div id = "setting_member" style="/*display: none;*/">
            <article class="module width_full">
                <header><h3>Background Settings</h3></header>
                <div style="margin: 20px;">
                    <fieldset>
                        <div id="colorPicker" class="Picker" align="right" style="background-color: <?php echo $row1->deal_Bcolor; ?>;"></div>
                        <label>Change Background Color</label>
                        <input id="colorpickerField1" class="color" type="text" name="editMBC" value="<?php echo $row1->deal_Bcolor; ?>">
                    </fieldset>
                    <fieldset>
<?php if(isset($_GET['error3']) == 1):?>
                        <h4 class="alert_error">The image(s) didn't fit(s) the required size.</h4><br>
<?php endif; ?>
<?php if(isset($_GET['error4']) == 1):?>
                        <h4 class="alert_error">The image(s) didn't fit(s) the required filetype.</h4><br>
<?php endif; ?>
                        <label>Change Background Image</label> 
                        <label><input id="background_upload" type="file" name="editMBI" value=""></label> 
                        <div align="center">
<?php if($row1->deal_background != "") : ?> 
                            <a href="assets/general/images/background/optimize/<?php echo $row1->deal_background; ?>" rel="lightbox">
                                <img class="deal-background" src="<?php echo htmlentities($background_image); ?>" border="0" width="300" height="200">
                            </a>
<?php endif ?>              
                            <div class="remove_select">
<?php if($row1->deal_background != "") : ?>
                                <a onclick="return c_ask('Are you sure you want to remove the selected records?')" href="<?php echo base_url(); ?>admin/admin_deals_gallery/remove_background/Group Deal/<?php echo $this->uri->segment(5); ?>">
                                    <img src="assets/admin/images/icn_trash.png" title="Remove Background Image">
                                </a>
<?php endif ?>
                            </div>
                            <br><br><br>
                        </div>
                        <label>Image Position</label>
                        <select name="editMIP">
                            <option value="<?php echo xss_cleaner($row1->deal_Bposition); ?>" selected="selected"><?php echo htmlentities($row1->deal_Bposition); ?></option>
                            <option value="bottom">bottom</option>
                            <option value="center">center</option>
                            <option value="inherit">inherit</option>
                            <option value="left">left</option>
                            <option value="right">right</option>
                            <option value="top">top</option>
                        </select>
                        <br><br><br>
                        <label>Image Repetition</label>
                        <select name="editMIR">
                            <option value="<?php echo xss_cleaner($row1->deal_Brepeat); ?>" selected="selected"><?php echo htmlentities($row1->deal_Brepeat); ?></option>
                            <option value="inherit">inherit</option>
                            <option value="no-repeat">no-repeat</option>
                            <option value="repeat">repeat</option>
                            <option value="repeat-x">repeat-x</option>
                            <option value="repeat-y">repeat-y</option>
                        </select>
                        <br><br><br>
                        <label>Image Attachment</label>
                        <select name="editMIA">
                            <option value="<?php echo xss_cleaner($row1->deal_Battach); ?>" selected="selected"><?php echo htmlentities($row1->deal_Battach); ?></option>
                            <option value="fixed">fixed</option>
                            <option value="inherit">inherit</option>
                            <option value="scroll">scroll</option>
                        </select>
                        <br><br><br><br><br>
                        <h4 class="alert_info">Required Image: (1024 to 1280) pixels width JPG/JPEG</h4>
                    </fieldset>
                </div>
            </article>
        </div>
        <br><br>
<?php endif ?>
        <div style="text-align: right;">
            <div style="margin: 20px;">
                <fieldset>
                    <input type="button" value="Back" onclick="window.history.back();">
<?php if($this->session->userdata('user_level') == 3 || $this->session->userdata('user_level') == 0) : ?>
                    <input class="alt_btn" type="submit" name="Update" value="Update"/>
<?php endif ?>
                </fieldset>
            </div>        
        </div>
    </article>
<?php endforeach ?>
    </form>     
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
<?php $deal_title = shortenString(xss_cleaner($row2->deal_title), 25); ?>
                <tr align="center" title="<?php echo xss_cleaner($row2->deal_view_title); ?>">
                    <td><?php echo $deal_title[0]; ?></td>
<?php $table = "deal_category" ?>
<?php $where['category_id'] = htmlentities($row2->category_id); ?>
<?php $sql = $this->db->get_where($table,$where); ?>
<?php foreach($sql->result() as $row): ?>
                    <td><?php echo xss_cleaner($row->category_name); ?></td>
<?php endforeach ?>          
                    <td>
                        <a href="<?php echo base_url() . "admin/admin_deals_gallery/edit_gallery_sub_deal/" . xss_cleaner($row2->deal_view_type) . "/" . htmlentities($row2->deal_subhash); ?>"><img id="icn_gallery" src="assets/admin/images/icn_photo.png" title="<?php if($this->session->userdata('user_level') == 3) : ?>Manage<?php else : ?>View<?php endif ?> this gallery"></a>
<?php if($this->session->userdata('user_level') == 3 || $this->session->userdata('user_level') == 0) : ?>
                        <a onclick="return c_ask('Are you sure you want to delete the selected record?')" href="<?php echo base_url() . "admin/admin_deals/delete_group_deal/" . xss_cleaner($row2->deal_view_type) . "/" . htmlentities($row2->deal_subhash); ?>">
                            <img id="icn_trash" src="assets/admin/images/icn_trash.png" title="Delete this deal">
                        </a>
<?php endif ?>
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
<?php if($this->session->userdata('user_level') == 3 || $this->session->userdata('user_level') == 0) : ?>
            <input type="button" value="Add" onclick="showAdd()">
<?php endif ?>
        </div>
    </article>
</div>
<div class = "add_member" style="display: none;">
<form action="<?php echo base_url(); ?>admin/admin_deals/save_group_deal/<?php echo $this->uri->segment(4); ?>/<?php echo $this->uri->segment(5); ?>" method="post" enctype="multipart/form-data">
    <article class="module width_full">
        <header><h3>Add New Deal</h3></header>
            <div id="deal_header"></div>
            <div style="margin: 20px;">
                <fieldset>
                    <label id="main_title">Deal Title</label>
                    <input type="text" name="addMDN">
                    <label id="main_statement">Deal Statement</label>
                    <input type="text" name="addMDS">
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
                        <input class="original_single" type="text" name="addOP" autocomplete="off">
                        <label>Discount (%)</label>
                        <input class="discount_single" type="text" name="addD" autocomplete="off">
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
                                    <input type="text" name="addStock" value="">
                                </fieldset>
                                <fieldset class="with_option">
                                    <label>Selection</label>
                                    <input type="text" name="addDselect_single1" value="">
                                    <label id="options">Options</label>
                                    <div id="deal_options_single1">
                                        <input id="options" class="options_single1_1" type="text" name="addDoption_single1_1" value="" >
                                    </div>
                                    <label id="options">Stock</label>
                                    <div id="deal_stock_single1">
                                        <input id="options" class="options_stock1_1" type="text" name="addStock_single1_1" value="" >
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
                            <input id="highlights" type="text" name="addH_single1">
                        </div>
                        <label><a href="add_more_highlights_single" id="add_more_highlights_single">Add More Highlight(s)</a></label>
                        <input type="hidden" name="nH_single" id="nH_single" value="1">
                    </fieldset>
                    <fieldset>
                        <label>Terms</label>
                        <div id="deal_terms_single">
                            <input id="terms" type="text" name="addT_single1">
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
                    <input class="blt_btn" type="button" name="save" value="Save"/>
                    <input type="hidden" name="MAX_FILE_SIZE" value="4194304" />
                </fieldset>
            </div>        
        </div>
    </article>
</form>
</div>
