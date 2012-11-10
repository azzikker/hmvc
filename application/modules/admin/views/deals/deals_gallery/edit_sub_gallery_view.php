<!--START OF CSS-->
<link rel="stylesheet" type="text/css" href="assets/general/set/jtps/jtps.css">
<link rel="stylesheet" type="text/css" href="assets/admin/set/HoverLightbox/css/horizontal.css">
<!--END OF CSS-->
<!--START OF JS-->
<script type="text/javascript" src="assets/general/js/jquery.js"></script>
<script type="text/javascript" src="assets/general/set/jtps/jtps.js"></script>
<script type="text/javascript" src="assets/admin/set/HoverLightbox/js/lightbox.js"></script>

<script type="text/javascript">
    var add_more_photo_single = new add_more_photo_single();
</script>
<!--END OF JS-->

<div class = "add_member" style="/*display: none;*/">
<form class="form" onsubmit="return eft(this)" action="<?php echo base_url(); ?>admin/admin_deals_gallery/update_gallery_sub_deal/<?php echo $this->uri->segment(4); ?>/<?php echo $this->uri->segment(5); ?>" method="post" enctype="multipart/form-data">
    <article class="module width_full">
<?php foreach($sql1 as $row1) : ?>
<?php foreach($sql2 as $row2) : ?>
        <header>
            <h3 class="tabs_involved">Deals - Sub Deal ( Gallery ) - <?php echo xss_cleaner($row2->deal_title); ?></h3>
<?php if($this->session->userdata('user_level') == 3) : ?>
            <ul class="tabs">
                <li>
                    <a href="<?php echo base_url(); ?>admin/admin_deals/edit_sub_deal/<?php echo $this->uri->segment(4); ?>/<?php echo $this->uri->segment(5); ?>">
                        Manage Information
                    </a>
                </li>
            </ul>
<?php elseif($this->session->userdata('user_level') == 0) : ?>
            <ul class="tabs">
                <li>
                    <a href="<?php echo base_url(); ?>admin/admin_deals/edit_sub_deal/<?php echo $this->uri->segment(4); ?>/<?php echo $this->uri->segment(5); ?>">
                        Manage Information
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url(); ?>admin/admin_deals/profile_sub_deal/<?php echo $this->uri->segment(4); ?>/<?php echo $this->uri->segment(5); ?>">
                        View Profile
                    </a>
                </li>
            </ul>
<?php else : ?>
            <ul class="tabs">
                <li>
                    <a href="<?php echo base_url(); ?>admin/admin_deals/profile_sub_deal/<?php echo $this->uri->segment(4); ?>/<?php echo $this->uri->segment(5); ?>">
                        View Profile
                    </a>
                </li>
            </ul>
<?php endif ?>
        </header>
<?php endforeach ?>
<?php endforeach ?>
        <div id = "add_member" style="/*display: none;*/">
            <article class="module width_full">
                <header><h3>Photo(s)</h3></header>
                <div style="margin: 20px;">
                    <fieldset>
<?php foreach($sql3 as $row3) : ?>
<?php $gallery_count = 2; ?>
                        <div class="image_frame"> 
                            <a href="assets/general/images/deals_gallery/optimize/<?php echo htmlentities($row3->gallery_filename); ?>" rel="lightbox[<?php echo $this->uri->segment(5); ?>]">
                                <img class="deal-image" src="assets/general/images/deals_gallery/customize/<?php echo htmlentities($row3->gallery_filename); ?>" border="0" width="240" height="105">
                            </a>
                            <div class="trash_select">
<?php $g_encrypt = ((htmlentities($row3->gallery_id))*8)+8; ?>
<?php $g_decrypt = (($g_encrypt)-8)/8; ?>
<?php $g_encrypt_count = strlen($g_encrypt); ?>
<?php $gallery_id_hash = md5($g_encrypt . "" . time() . "" . $g_decrypt) . "" . time() . "" . $g_encrypt; ?>
<?php if($row3->gallery_main != $gallery_count) : ?> 
<?php if($this->session->userdata('user_level') == 3 || $this->session->userdata('user_level') == 0) : ?>
                                <a onclick="return c_ask('Are you sure you want to delete the selected records?')" href="<?php echo base_url(); ?>admin/admin_deals_gallery/delete_gallery_sub_deal/<?php echo $g_encrypt_count; ?>/<?php echo $gallery_id_hash; ?>/<?php echo $this->uri->segment(5); ?>">
                                    <img src="assets/admin/images/icn_trash.png" title="Delete <?php echo htmlentities($row3->gallery_filename); ?>">
                                </a>
<?php endif ?>
<?php else : ?>
                                <img src="assets/admin/images/icn_alert_info.png" title="Main Photo <?php echo htmlentities($row3->gallery_filename); ?>">
<?php endif ?>
<?php if($this->session->userdata('user_level') == 3 || $this->session->userdata('user_level') == 0) : ?>
                                <input id="checked_main" <?php if(htmlentities($row3->gallery_main) == $gallery_count) : ?>class="checked_main" checked="checked"<?php endif ?> type="radio" name="editGM" value="<?php echo htmlentities($row3->gallery_filename); ?>" title="Select as Main Photo" required="required"> MAIN PHOTO
<?php endif ?>
                            </div>
                        </div>
<?php endforeach ?>
                        <input class="main_image" type="hidden" name="main_image" value="<?php echo $gallery_count; ?>">
                    </fieldset>
<?php if($this->session->userdata('user_level') == 3 || $this->session->userdata('user_level') == 0) : ?>
                    <fieldset>
                        <label>Add Sub Deal Cover</label><br>
<?php if(isset($_GET['error1']) == 1):?>
                            <h4 class="alert_error">The image(s) didn't fit(s) the required size.</h4>
<?php endif; ?>
<?php if(isset($_GET['error2']) == 1):?>
                            <h4 class="alert_error">The image(s) didn't fit(s) the required filetype.</h4>
<?php endif; ?>
                        <div align="center" id="gallery_casing" style="margin: 20px;">                                                                        
                            <label>Photo 1</label>
                            <fieldset><input id="image_upload" type="file" name="addSDC1"></fieldset>
                        </div>
                        <div style="margin: 20px;">
                            <fieldset>
                                <label><a href="add_more_photo_single" id="add_more_photo_single">Add More Photo(s)</a></label><br>
                                <input type="hidden" name="nPHOTO" id="nPHOTO" value="1">
                                <h4 class="alert_info">Required Image: (690 x 242) to (750 x 263) pixels JPG/JPEG</h4>
                            </fieldset>
                        </div>
                    </fieldset>
<?php endif ?>         
                </div>
            </article>    
        </div>
        <div id = "add_member" style="/*display: none;*/">
            <article class="module width_full">
                <header><h3>Video</h3></header>
                <div style="margin: 20px;">
                    <fieldset>
                        <div align="center" class="video_frame">
                            <span><?php foreach($sql0 as $row0) : ?><?php echo $row0->video_embed; ?><?php endforeach ?></span>
                        </div>
                    </fieldset>
<?php if($this->session->userdata('user_level') == 3 || $this->session->userdata('user_level') == 0) : ?>
                    <fieldset>
                        <label>Embeded Code ( <a href="<?php echo "http://www.youtube.com/"; ?>" target="_new" title="Get YOU TUBE embeded code">You Tube</a> )</label>
                        <textarea id="locations" class="link vid" name="editDV"><?php foreach($sql0 as $row0) : ?><?php echo $row0->video_embed; ?><?php endforeach ?></textarea>
                    </fieldset>
<?php endif ?>
                </div>
            </article>
        </div>
        <br><br>
    </article>
    <article class="module width_full">
        <div style="text-align: right;">
            <div style="margin: 20px;">
                <fieldset>
                    <input type="button" value="Back" onclick="window.history.back();">
<?php if($this->session->userdata('user_level') == 3 || $this->session->userdata('user_level') == 0) : ?>
                    <input class="alt_btn" type="submit" name="Update" value="Update"/>
                    <input class="blt_btn" type="button" name="Update" value="Update"/>
                    <input type="hidden" name="MAX_FILE_SIZE" value="4194304" />
<?php endif ?>
                </fieldset>
            </div>        
        </div>
    </article>
</form>
</div>