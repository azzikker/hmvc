<!--START OF CSS-->
<link rel="stylesheet" type="text/css" href="assets/general/set/jtps/jtps.css">
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
<script type="text/javascript" src="assets/admin/set/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
    var add_faq = new add_faq();
    //var delete_faq = new delete_faq();
</script>
<!--END OF JS-->

<div>
<?php foreach($sqlWeb->result() as $rowWeb) : ?>
<form action="<?php echo base_url(); ?>admin/update/<?php echo $this->uri->segment(4); ?><?php echo ($this->uri->segment(4) == "maintenance" ? "/" . $this->uri->segment(5) : ""); ?><?php echo "/" . $this->uri->segment(7); ?><?php echo "/" . $this->uri->segment(8); ?>" method="post" enctype="multipart/form-data">   
    <article class="module width_full">                                                         
        <header>
            <h3 class="tabs_involved">Web Settings - <?php echo ucwords($this->uri->segment(4)); ?><?php echo ($this->uri->segment(4) == "maintenance" ? " - " . ucwords( str_ireplace("_", " ", $this->uri->segment(5))) . " - " : " - "); ?> Settings</h3>
            <ul class="tabs">
                <li><a href="admin/admin/settings/background">Background</a></li>
                <li><a href="admin/admin/settings/gender">Gender</a></li>
                <li><a href="admin/admin/settings/maintenance/about_us">Maintenance</a></li>
                <li><a href="admin/admin/settings/accounting">Accounting</a></li>
            </ul>
        </header>
<?php if($this->uri->segment(4) == "maintenance") : ?>
        <header>
            <ul class="tabs">
                <li><a href="admin/admin/settings/maintenance/about_us">About Us</a></li>
                <li><a href="admin/admin/settings/maintenance/contact_us">Contact Us</a></li>
                <li><a href="admin/admin/settings/maintenance/privacy_policy">Privacy Policy</a></li>
                <li><a href="admin/admin/settings/maintenance/terms_of_use">Terms of Use</a></li>
                <li><a href="admin/admin/settings/maintenance/return_and_exchange">Return and Exchange</a></li>
                <li><a href="admin/admin/settings/maintenance/terms_of_sale">Terms of Sale</a></li>
                <li><a href="admin/admin/settings/maintenance/faq">FAQ</a></li> 
            </ul>
        </header>
<?php endif ?>
<?php if($this->uri->segment(4) != "maintenance") : ?>
        <div style="margin: 20px;">
<?php endif ?>
<?php if($this->uri->segment(4) == "background") : ?>
            <fieldset>
                <div id="colorPicker" align="right" style="background-color: <?php echo $rowWeb->background_color; ?>;"></div>
                <label>Change Background Color</label>
                <input id="colorpickerField1" type="text" name="Scolor" value="<?php echo $rowWeb->background_color; ?>">
            </fieldset>
            <fieldset>
                <label>Change Background Image</label> 
                <label><input type="file" name="Simage" value=""></label> 
                <div align="center">
<?php if($rowWeb->background_image != "") : ?>
                    <a href="assets/general/images/web_setting/optimize/<?php echo $rowWeb->background_image; ?>" rel="lightbox">
                        <img class="deal-background" src="assets/general/images/web_setting/customize/<?php echo $rowWeb->background_image; ?>" border="0" width="300" height="200">
                    </a>             
                    <div class="remove_select">
                        <a onclick="return c_ask('Are you sure you want to remove the selected records?')" href="<?php echo base_url(); ?>admin/remove/<?php echo $this->uri->segment(4); ?>">
                            <img src="assets/admin/images/icn_trash.png" title="Remove Background Image">
                        </a>
                    </div>
<?php endif ?>
                    <br><br><br>
                </div>
                <label>Image Position</label>
                <select name="SIposition">
<?php if($rowWeb->background_position == "") : ?>
                    <option value="inherit" selected="selected">inherit</option>
<?php else : ?>
                    <option value="<?php echo $rowWeb->background_position; ?>" selected="selected"><?php echo $rowWeb->background_position; ?></option>
<?php endif ?>
                    <option value="bottom">bottom</option>
                    <option value="center">center</option>
                    <option value="inherit">inherit</option>
                    <option value="left">left</option>
                    <option value="right">right</option>
                    <option value="top">top</option>
                </select>
                <br><br><br>
                <label>Image Repetition</label>
                <select name="SIrepetition">
<?php if($rowWeb->background_repeat == "") : ?>
                    <option value="inherit" selected="selected">inherit</option>
<?php else : ?>
                    <option value="<?php echo $rowWeb->background_repeat; ?>" selected="selected"><?php echo $rowWeb->background_repeat; ?></option>
<?php endif ?>
                    <option value="inherit">inherit</option>
                    <option value="no-repeat">no-repeat</option>
                    <option value="repeat">repeat</option>
                    <option value="repeat-x">repeat-x</option>
                    <option value="repeat-y">repeat-y</option>
                </select>
                <br><br><br>
                <label>Image Attachment</label>
                <select name="SIattachment">
<?php if($rowWeb->background_attach == "") : ?>
                    <option value="inherit" selected="selected">inherit</option>
<?php else : ?>
                    <option value="<?php echo $rowWeb->background_attach; ?>" selected="selected"><?php echo $rowWeb->background_attach; ?></option>
<?php endif ?>
                    <option value="fixed">fixed</option>
                    <option value="inherit">inherit</option>
                    <option value="scroll">scroll</option>
                </select>
                <br><br><br><br>
                <h4 class="alert_info">Required Image: 1200x800</h4>
            </fieldset>
        </div>
        <div style="text-align: right;">
            <div style="margin: 20px;">
                <fieldset>
                    <input type="button" value="Back" onclick="window.history.back();">
<?php if($this->session->userdata('user_level') == 3 || $this->session->userdata('user_level') == 0) : ?>
                    <input class="alt_btn" type="submit" name="Update" value="Update"/>
<?php endif ?>
                </fieldset>
            </div>
<?php elseif($this->uri->segment(4) == "gender") : ?>
            <center><img src="assets/admin/images/system/work_in_progress.jpg" border="0" alt="Work In Progress"></center>
<?php elseif($this->uri->segment(4) == "maintenance") : ?>
<?php if($this->uri->segment(6) == "edit") : ?>
<?php foreach($sqlFaq->result() as $rowFaq) : ?>
            <div class="add_member">
                <input type="hidden" name="faq_status" value="edit">
                <div style="margin: 20px;">
                    <fieldset>
                        <label>Question</label>
                        <input type="text" name="editQ" value="<?php echo xss_cleaner($rowFaq->faq_question); ?>">
                        <label>Answeer</label>
                        <textarea id="content" name="editA"><?php echo xss_cleaner($rowFaq->faq_answer); ?></textarea>
                    </fieldset>
                    <fieldset>
                        <label>Position</label>
                        <input type="hidden" name="editP_old" value="<?php echo xss_cleaner($rowFaq->faq_position); ?>">
                        <select name="editP_new">
<?php foreach($sqlFaqAll->result() as $rowFaqAll) : ?>
                            <option value="<?php echo $rowFaqAll->faq_position; ?>" <?php echo ($rowFaqAll->faq_position == $rowFaq->faq_position ? "selected=\"selected\"" : ""); ?>><?php echo $rowFaqAll->faq_position; ?></option>
<?php endforeach ?>
                        </select>
                    </fieldset>
                    <div style="text-align: right;">
                        <fieldset>
                            <input type="button" value="Back" onclick="window.history.back();">
                            <input class="alt_btn" type="submit" name="Update" value="Update">
                        </fieldset>
                    </div>
                </div>
            </div>
<?php endforeach ?>
<?php else : ?>
<?php if($this->uri->segment(5) != "faq") : ?>
            <textarea id="editor" class="ckeditor" name="web_content" cols="80" rows="30">
<?php foreach($sqlContent->result() as $rowContent) : ?>
<?php if($this->uri->segment(5) == "about_us") : echo $rowContent->au; ?>
<?php elseif($this->uri->segment(5) == "contact_us") : echo $rowContent->cu; ?>
<?php elseif($this->uri->segment(5) == "privacy_policy") : echo $rowContent->pp; ?>
<?php elseif($this->uri->segment(5) == "terms_of_use") : echo $rowContent->tu; ?>
<?php elseif($this->uri->segment(5) == "return_and_exchange") : echo $rowContent->re; ?>
<?php elseif($this->uri->segment(5) == "terms_of_sale") : echo $rowContent->ts; ?> 
<?php endif ?>
<?php endforeach ?>
         
            </textarea>
            <div style="text-align: right;">
                <div style="margin: 20px;">
                    <fieldset>
<?php if($this->session->userdata('user_level') == 3 || $this->session->userdata('user_level') == 0) : ?>
                        <input class="alt_btn" type="submit" name="Update" value="Update"/>
<?php endif ?>
                    </fieldset>
                </div>
            </div>
<?php else : ?>
            <div class="list_member" style="display:block">
                <table style="font-size: 11px" id="datagrid" style="border: 1px solid #ccc;" cellspacing="0" width="100%">
                    <thead>
                        <tr align="left">
                            <th id = "table_spacing" align="center">#</th>
                            <th align="left">QUESTIONS</th>
                            <th align="center">ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody id = 'info_grid'>
<?php $table_count = 1; ?>
<?php foreach($sqlFaq->result() as $rowFaq) : ?>
<?php $faq_encrypt = ((htmlentities($rowFaq->faq_id))*8)+8; ?>
<?php $faq_decrypt = (($faq_encrypt)-8)/8; ?>
<?php $faq_encrypt_count = strlen($faq_encrypt); ?>
<?php $faq_id_hash = md5($faq_encrypt . "" . time() . "" . $faq_decrypt) . "" . time() . "" . $faq_encrypt; ?>
                        <tr align="left">
                            <td id = "table_spacing" align="center"><?php echo $table_count; ?></td>
                            <td align="left"><?php echo $rowFaq->faq_question; ?></td>
                            <td align="center">
                                <a href="<?php echo base_url(); ?>admin/admin/settings/maintenance/faq/edit/<?php echo $faq_id_hash; ?>/<?php echo $faq_encrypt_count; ?>"><img id="icn_edit" src="assets/admin/images/icn_edit.png" title="Manage Company Profile"></a>
                                <a onclick="return c_ask('Are you sure you want to delete the selected information?')" href="<?php echo base_url(); ?>"><img id="icn_trash" src="assets/admin/images/icn_trash.png" title="Delete Information"></a>
                            </td>
                        </tr>                                         
<?php $table_count = $table_count + 1; ?>
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
                    <input type="button" value="Add" onclick="showAdd()"/>
                </div>
            </div>
            <div class="add_member" style="display:none">
                <input type="hidden" name="faq_status" value="add">
                <input type="hidden" name="faq_count" value="<?php echo $table_count; ?>">
                <div style="margin: 20px;">
                    <fieldset>
                        <label>Question</label>
                        <input type="text" name="addQ">
                        <label>Answeer</label>
                        <textarea id="content" name="addA"></textarea>
                    </fieldset>
                    <div style="text-align: right;">
                        <fieldset>
                            <input type="button" value="Back" onclick="showList()">
                            <input class="alt_btn" type="submit" name="Save" value="Save">
                        </fieldset>
                    </div>
                </div>
            </div>  
<?php endif ?>
<?php endif ?>
<?php elseif($this->uri->segment(4) == "accounting") : ?>
        <fieldset>
            <div class="remittance" title="REMITTANCE <?php echo $rowWeb->accounting_remittance; ?>%">
                <div class="income" style="width: <?php echo $rowWeb->accounting_income; ?>%;"  title="INCOME <?php echo $rowWeb->accounting_income; ?>%">
                </div>
            </div>
            <input class="button_income" type="button" value="+" title="Increase Income Percentage">
            <div class="content_income">
                <div class="box_income"></div>
                <div class="text_income"> INCOME ( <b><?php echo $rowWeb->accounting_income; ?>%</b> )</div>
            </div>
            
            <input class="button_remittance" type="button" value="+" title="Increase Remittance Percentage">
            <div class="content_remittance">
                <div class="box_remittance"></div>
                <div class="text_remittance"> REMITTANCE ( <b><?php echo $rowWeb->accounting_remittance; ?>%</b> )</div>
            </div> 
            <input class="a_income" type="hidden" name="updateIP" value="<?php echo $rowWeb->accounting_income; ?>" maxlength="2" autocomplete="off">
            <input class="a_remittance" type="hidden" name="updateRP" value="<?php echo $rowWeb->accounting_remittance; ?>" maxlength="2" autocomplete="off">
        </fieldset>
        <div style="text-align:right;">
            <div>
                <fieldset>
                    <input type="button" value="Back" onclick="window.history.back();">
<?php if($this->session->userdata('user_level') == 3 || $this->session->userdata('user_level') == 0) : ?>
                    <input class="alt_btn" type="submit" name="Update" value="Update"/>
<?php endif ?>
                </fieldset>
            </div>
<?php endif ?>
<?php if($this->uri->segment(4) != "maintenance") : ?>       
        </div>
<?php endif ?>
    </article>
</form>
<?php endforeach ?>
</div>
