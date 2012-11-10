<script type="text/javascript">
    var edit_ccontact = new edit_ccontact();
    var delete_ccontact = new delete_ccontact();
</script>

<div class = "edit_member">
<?php foreach($sql as $row): ?>
<form onsubmit="return eft(this)" action="<?php echo base_url(); ?>admin/admin_companies/updateCompany/<?php echo $this->uri->segment(4); ?>" method="post" enctype="multipart/form-data">
    <article class="module width_full">
        <header><h3>Edit Company</h3></header>
            <div style="margin: 20px;">
                <fieldset>   
                    <label>Company Name</label>
                    <input class="comparison_new" type="text" name="editCN" value="<?php echo $row->company_name; ?>" maxlength="40" required="required">
                    <input class="comparison2_old" type="hidden" name="editCN_old" value="<?php echo $row->company_name; ?>" maxlength="40" required="required">
                    <?php if(isset($_GET['error']) == 1):?><br><br><br><div><h4 class="alert_error">Company Name Already Exist!</h4></div><?php endif; ?>
                </fieldset>
                <fieldset>
                    <label>Company Logo</label><input id="image_upload" type="file" name="editCL">
<?php if(isset($_GET['error1']) == 1):?>
                    <h4 class="alert_error">The image(s) didn't fit(s) the required size.</h4>
<?php endif; ?>
<?php if(isset($_GET['error2']) == 1):?>
                    <h4 class="alert_error">The image(s) didn't fit(s) the required filetype.</h4>
<?php endif; ?>
                    <h4 class="alert_info">Required Image: (350 to 550) pixels width JPG/JPEG</h4>
                </fieldset>
                <fieldset>
                    <label>Company Website</label><input type="text" name="editCW" value="<?php echo $row->company_website; ?>" maxlength="40">
                    <label>Company E-mail</label><input type="text" name="editCE" value="<?php echo $row->company_email; ?>" maxlength="40">
                    <label>Company Fax</label><input type="text" name="editCFN" value="<?php echo $row->company_fax; ?>" maxlength="20">
                </fieldset>
                <fieldset>
                        <label>Contact No.</label>
                        <div id="cc">
<?php $contact_count = 1; ?>
<?php foreach($sql3 as $row3) : ?>
<?php $contact_encrypt = ((htmlentities($row3->contact_id))*8)+8; ?>
<?php $contact_decrypt = (($contact_encrypt)-8)/8; ?>
<?php $contact_encrypt_count = strlen($contact_encrypt); ?>
<?php $contact_id_hash = md5($contact_encrypt . "" . time() . "" . $contact_decrypt) . "" . time() . "" . $contact_encrypt; ?>
                            <input id="options" class="CN<?php echo $contact_count; ?> editCCN<?php echo $contact_count; ?>" type="text" name="editCCN<?php echo $contact_count; ?>" value="<?php echo $row3->contact_no; ?>" maxlength="20">
                            <input type="hidden" name="editCCNNo<?php echo $contact_count; ?>" value="<?php echo $contact_encrypt_count; ?>">
                            <input type="hidden" name="editCCNHash<?php echo $contact_count; ?>" value="<?php echo $contact_id_hash; ?>">
                            <div class="input_delete"><a style="position: absolute;" onclick="return c_ask('Are you sure you want to delete the selected record?')" href="<?php echo base_url(); ?>admin/admin_companies/deleteContact/<?php echo $this->uri->segment(4); ?>/<?php echo $contact_id_hash; ?>/<?php echo $contact_encrypt_count; ?>"><img id="icn_trash" src="assets/admin/images/icn_trash.png" title="Delete Contact No."></a></div>
<?php $contact_count = $contact_count + 1; ?>
<?php endforeach ?>
                        </div>
                        <label><a href="add_more_ccontact" id="add_more_ccontact">Add More Contact(s)</a></label>
                        <span id="icn_remove" class="input_remove CC off" count_cc="<?php echo $contact_count-1; ?>" title="Remove Last Line"></span>
                        <input type="hidden" name="mCCONTACT" id="mCCONTACT" value="<?php echo $contact_count-1; ?>">
                        <input type="hidden" name="nCCONTACT" id="nCCONTACT" value="<?php echo $contact_count-1; ?>">
                    </fieldset>
                <fieldset>
                    <label>Company Address</label><input type="text" name="editCA" value="<?php echo $row->company_address; ?>" required="required">  
                </fieldset>
                <fieldset>
                    <label>Company Press Release</label><textarea id="content" name="editCPR" required="required"><?php echo $row->company_pr; ?></textarea>
                </fieldset>
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
            </div>
    </article>
</form>
<?php endforeach ?>
</div>
