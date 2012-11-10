<!--START OF JS-->
<script type="text/javascript">
    var edit_bcontact = new edit_bcontact();
    var delete_bcontact = new delete_bcontact();
</script>
<!--END OF JS-->

<div class="add_member">
<?php foreach($sql1 as $row1) : ?>
    <form action="<?php echo base_url(); ?>admin/admin_branches/updateBranches/<?php echo $this->uri->segment(4); ?>/<?php echo $this->uri->segment(5); ?>" name="update" method="post" onsubmit="return checkform();" enctype="multipart/form-data">
        <article class="module width_full">    
            <header><h3>Edit Branch</h3></header>
            <div style="margin: 20px;">
                <div id="deal_locations">
                    <fieldset>
                        <label>Company</label>
                        <input type="text" value="<?php foreach($sql0 as $row0) : echo $row0->company_name; endforeach ?>" disabled="disabled">
                        <input type="hidden" name="editCompany" value="<?php foreach($sql0 as $row0) : echo $row0->company_name; endforeach ?>">
                    </fieldset>
                    <fieldset>
                        <label>Branch Name</label>
                        <input id="locations" type="text" name="editName" value="<?php echo $row1->location_name; ?>" required="required" >
                        <label>E-mail</label>
                        <input id="locations" type="text" name="editEmail" value="<?php echo $row1->location_email; ?>" maxlength="40">
                        <label>Fax</label>
                        <input id="locations" type="text" name="editFax" value="<?php echo $row1->location_fax; ?>" maxlength="20">
                    </fieldset>
                    <fieldset>
                        <label>Contact No.</label>
                        <div id="bc">
<?php $contact_count = 1; ?>
<?php foreach($sql2 as $row2) : ?>
<?php $contact_encrypt = ((htmlentities($row2->contact_id))*8)+8; ?>
<?php $contact_decrypt = (($contact_encrypt)-8)/8; ?>
<?php $contact_encrypt_count = strlen($contact_encrypt); ?>
<?php $contact_id_hash = md5($contact_encrypt . "" . time() . "" . $contact_decrypt) . "" . time() . "" . $contact_encrypt; ?> 
                            <input id="options" class="CN<?php echo $contact_count; ?> editBCN<?php echo $contact_count; ?>" type="text" name="editBCN<?php echo $contact_count; ?>" value="<?php echo $row2->contact_no; ?>" maxlength="20">
                            <input type="hidden" name="editBCNNo<?php echo $contact_count; ?>" value="<?php echo $contact_encrypt_count; ?>">
                            <input type="hidden" name="editBCNHash<?php echo $contact_count; ?>" value="<?php echo $contact_id_hash; ?>">
                            <div class="input_delete"><a style="position: absolute;" onclick="return c_ask('Are you sure you want to delete the selected record?')" href="<?php echo base_url(); ?>admin/admin_branches/deleteContact/<?php echo $this->uri->segment(4); ?>/<?php echo $this->uri->segment(5); ?>/<?php echo $contact_id_hash; ?>/<?php echo $contact_encrypt_count; ?>"><img id="icn_trash" src="assets/admin/images/icn_trash.png" title="Delete Contact No."></a></div>
<?php $contact_count = $contact_count + 1; ?>
<?php endforeach ?>
                        </div>
                        <label><a href="add_more_bcontact" id="add_more_bcontact">Add More Contact(s)</a></label>
                        <span id="icn_remove" class="input_remove BC off" count_bc="<?php echo $contact_count-1; ?>" title="Remove Last Line"></span>
                        <input type="hidden" name="mBCONTACT" id="mBCONTACT" value="<?php echo $contact_count-1; ?>">
                        <input type="hidden" name="nBCONTACT" id="nBCONTACT" value="<?php echo $contact_count-1; ?>">
                    </fieldset>
                    <fieldset>
                        <label>Address</label>
                        <input id="locations" type="text" name="editLocation" value="<?php echo $row1->location_address; ?>" required="required" >
                        <label>Map Link <font color="green"> ( <a href="http://maps.google.com.ph/" target="_new" id="view_map" title="Get the Map Link on the Google Map"> Open Google Map </a> )</font></label>
                        <textarea id="locations" class="link" name="editLink"><?php echo $row1->location_link; ?></textarea>
                    </fieldset>
                </div>
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
</div>