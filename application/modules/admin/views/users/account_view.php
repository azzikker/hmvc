<!--START OF CSS-->
<link rel="stylesheet" type="text/css" href="assets/general/set/jtps/jtps.css">
<!--END OF CSS-->
<!--START OF JS-->
<script type="text/javascript" src="assets/general/js/jquery.js"></script>
<script type="text/javascript" src="assets/general/set/jtps/jtps.js"></script>

<div class = "list_member" style="/*display: none;*/">
<?php foreach($sql1 as $row1) : ?>
    <center style="margin-top: 100px;">
        <article class="module width_full" style="max-width: 500px;">
            <header><h3>Your Profile</h3></header>
                <div id="deal_header"></div>
                <div style="margin: 20px;">
                    <fieldset>
                            <div align="left" id="deal_li">Username</div><div class="deal_li"><?php echo ucwords(htmlentities($row1->user_name)); ?></div>
                    </fieldset>
                    <fieldset>
<?php foreach($sqlxb as $rowxb) :?>
                            <div align="left" id="deal_li">User Level</div><div class="deal_li"><?php echo ucwords(htmlentities($rowxb->level_name)); ?></div>
<?php endforeach ?>
                    </fieldset>
                    <fieldset>
                        <div align="left" id="deal_li">Last Name</div><div class="deal_li"><?php echo ucwords(htmlentities($row1->user_lastname)); ?></div>
                        <div align="left" id="deal_li">First Name</div><div class="deal_li"><?php echo ucwords(htmlentities($row1->user_firstname)); ?></div>
                        <div align="left" id="deal_li">Middle Name</div><div class="deal_li"><?php echo ucwords(htmlentities($row1->user_middlename)); ?></div>
                    </fieldset> 
                    <fieldset>
                        <div align="left" id="deal_li">E-mail</div><div class="deal_li"><?php echo htmlentities($row1->user_email); ?></div>
                        <div align="left" id="deal_li">Contact No.</div><div class="deal_li"><?php echo ucwords(htmlentities($row1->user_no)); ?></div>
                    </fieldset>    
                </div>
        </article>
        <article class="module width_full" style="max-width: 500px;">
            <div style="text-align: right;">
                <div style="margin: 20px;">
                    <fieldset>
                        <input type="button" value="Back" onclick="window.history.back();">
                        <input type="button" value="Edit" onclick="showAdd()">
                    </fieldset>
                </div>
            </div>
        </article>
    </center>
<?php endforeach ?>
</div>
<div class = "add_member" style="display: none;">
<?php foreach($sql1 as $row1) : ?>
<form action="<?php echo base_url(); ?>admin/admin_users/updateUser/<?php echo $this->uri->segment(4); ?>/<?php echo $this->uri->segment(5); ?>" name="register" method="post" onsubmit="return checkform();">
    <article class="module width_full">
        <header><h3>Edit Profile</h3></header>
            <div id="deal_header"></div>
            <div style="margin: 20px;">
                <div id="deal_type">
                    <fieldset>
                        <label>First Name</label><input type="text" name="txtFN" value="<?php echo ucwords(htmlentities($row1->user_firstname)); ?>" required="required">
                        <label>Middle Name</label><input type="text" name="txtMN" value="<?php echo ucwords(htmlentities($row1->user_middlename)); ?>" required="required">
                        <label>Last Name</label><input type="text" name="txtLN" value="<?php echo ucwords(htmlentities($row1->user_lastname)); ?>" required="required">
                    </fieldset>
                    <fieldset>
                        <?php if(isset($_GET['error1']) == 1):?><h4 class="alert_error">Username Already Exist!</h4><?php endif; ?>
                        <label>Username</label><input type="text" name="txtUN" value="<?php echo $row1->user_name; ?>" required="required">
                        <?php if(isset($_GET['error2']) == 1):?><br><br><br><h4 class="alert_error">Password did not matched!</h4><?php endif; ?>
                        <label>Old Password</label><input type="password" name="txtPWold" value="">
                        <label>New Password</label><input type="password" name="txtPWnew" value="">
                        <label>Confirm New Password</label><input type="password" name="txtCPW" value="">
                    </fieldset>
                    <fieldset>
                        <label>E-mail</label><input type="text" name="txtEA" value="<?php echo htmlentities($row1->user_email); ?>" required="required">
                        <label>Contact No.</label><input type="text" name="txtCN" value="<?php echo htmlentities($row1->user_no); ?>" required="required">
                        <input type="hidden" name="txtForm" value="<?php echo $this->uri->segment(3); ?>">
                        <input type="hidden" name="txtCcount" value="<?php echo $this->uri->segment(4); ?>">
                        <input type="hidden" name="txtChash" value="<?php echo $this->uri->segment(5); ?>">
                    </fieldset>
                </div>
            </div>
    </article>
    <article class="module width_full">
        <div style="text-align: right;">
            <div style="margin: 20px;">
                <fieldset>
                    <input type="button" value="Back" onclick="showList()">
                    <input class="alt_btn" type="submit" name="update" value="Update"/>
                </fieldset>
            </div>        
        </div>
    </article>
</form>
<?php endforeach ?>
</div>
