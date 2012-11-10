<script type="text/javascript" src="assets/vigattin_deals/js/colorplugin.js"></script> 
<script>var profile = new profile();</script>
<?php if(!isset($profile_infos)): ?>
<form method="post" action="vigdeals/vigdeals_profile/save_info">
    <div id="profile">
        <div id="profile-pic"><img src="<?php echo $this->vauth->get_picture('large') ?>"></div>
        <div id="profile-h">Welcome, <?php echo $this->session->userdata("vigdeals_login_name") ?></div>
        <div id="profile-c">
            <div id="profile-c-c" class="profile-c-c-edit">
                <div id="profile-c-c-div">
                    <div id="profile-c-c-l">Email:</div>
                    <div id="profile-c-c-i"><?php echo $this->session->userdata("vigattin_email") ?></div>
                </div>
                <div id="profile-c-c-div">
                    <div id="profile-c-c-l">First Name:</div>
                    <div id="profile-c-c-i"><?php echo $this->session->userdata("vigattin_firstname") ?></div>
                </div>
                <div id="profile-c-c-div">
                    <div id="profile-c-c-l">Last Name:</div>
                    <div id="profile-c-c-i"><?php echo $this->session->userdata("vigattin_lastname") ?></div>
                </div>
                <div id="profile-c-c-div">
                    <div id="profile-c-c-l">Gender:</div>
                    <div id="profile-c-c-i">
                        <select name="sex">
<?php foreach($profile_gender as $pgr): ?>
                            <option value="<?php echo $pgr->gender_id ?>"><?php echo $pgr->gender_name ?></option>
<?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div id="profile-c-c-div">
                    <div id="profile-c-c-l">Contact No:</div>
                    <div id="profile-c-c-i"><input type="text" name="cn" placeholder="Type your text here..." required=required></div>
                </div>
                <div id="profile-c-c-div">
                    <div id="profile-c-c-l">Zip Postal Code:</div>
                    <div id="profile-c-c-i"><input type="text" name="zc" placeholder="Type your text here..." required=required></div>
                </div>
                <div id="profile-c-c-div">
                    <div id="profile-c-c-l">Address:</div>
                    <div id="profile-c-c-i"><input type="text" name="add" placeholder="Type your text here..." required=required></div>
                </div>
                <div id="profile-c-c-div">
                    <div id="profile-c-c-l">City:</div>
                    <div id="profile-c-c-i"><input type="text" name="ct" placeholder="Type your text here..." required=required></div> 
                </div>
                <div id="profile-c-c-div">
                    <div id="profile-c-c-l">Province:</div>
                    <div id="profile-c-c-i"><input type="text" name="prov" placeholder="Type your text here..." required=required></div>
                </div>
            </div>
        </div>
        <div id="profile-btn">
            <a href="account"><div id="profile-btn-b">Back</div></a>
            <input type="submit" id="profile-btn-s" value="Save">
        </div>
    </div>
</form>
<?php else: ?>
<?php foreach($profile_infos as $pi): ?>
<form method="post" action="vigdeals/vigdeals_profile/update_info">
    <div id="profile">
        <div id="profile-pic"><img src="<?php echo $this->vauth->get_picture('large') ?>"></div>
        <div id="profile-h">Welcome, <?php echo $this->session->userdata("vigdeals_login_name") ?></div>
        <div id="profile-c">
            <div id="profile-c-c" class="profile-c-c-edit">
                <div id="profile-c-c-div">
                    <div id="profile-c-c-l">Email:</div>
                    <div id="profile-c-c-i"><?php echo $this->session->userdata("vigattin_email") ?></div>
                </div>
                <div id="profile-c-c-div">
                    <div id="profile-c-c-l">First Name:</div>
                    <div id="profile-c-c-i"><?php echo $pi->customer_firstname ?></div>
                </div>
                <div id="profile-c-c-div">
                    <div id="profile-c-c-l">Last Name:</div>
                    <div id="profile-c-c-i"><?php echo $pi->customer_lastname ?></div>
                </div>
                <div id="profile-c-c-div">
                    <div id="profile-c-c-l">Gender:</div>
                    <div id="profile-c-c-i">
                        <select name="sex">
<?php if($pi->customer_gender == ""): ?>
<?php foreach($profile_gender as $pgr): ?>
                            <option value="<?php echo $pgr->gender_id ?>"><?php echo $pgr->gender_name ?></option>
<?php endforeach; ?>
<?php else: ?>
<?php $gen = 0; ?>
<?php foreach($profile_gender as $pgr): ?>
<?php $gen++; ?>
                            <option value="<?php echo $pgr->gender_id ?>"<?php if($pi->customer_gender == $gen): ?> selected="selected"<?php endif; ?>><?php echo $pgr->gender_name ?></option>
<?php endforeach; ?>
<?php endif; ?>
                        </select>
                    </div>
                </div>
                <div id="profile-c-c-div">
                    <div id="profile-c-c-l">Contact No:</div>
                    <div id="profile-c-c-i"><input type="text" name="cn" placeholder="Type your text here..." required=required value="<?php echo $pi->customer_no ?>"></div>
                </div>
                <div id="profile-c-c-div">
                    <div id="profile-c-c-l">Zip Postal Code:</div>
                    <div id="profile-c-c-i"><input type="text" name="zc" placeholder="Type your text here..." required=required value="<?php echo $pi->customer_zipcode ?>"></div>
                </div>
                <div id="profile-c-c-div">
                    <div id="profile-c-c-l">Address:</div>
                    <div id="profile-c-c-i"><input type="text" name="add" placeholder="Type your text here..." required=required value="<?php echo $pi->customer_address ?>"></div>
                </div>
                <div id="profile-c-c-div">
                    <div id="profile-c-c-l">City:</div>
                    <div id="profile-c-c-i"><input type="text" name="ct" placeholder="Type your text here..." required=required value="<?php echo $pi->customer_city ?>"></div> 
                </div>
                <div id="profile-c-c-div">
                    <div id="profile-c-c-l">Province:</div>
                    <div id="profile-c-c-i"><input type="text" name="prov" placeholder="Type your text here..." required=required value="<?php echo $pi->customer_province ?>"></div>
                </div>
            </div>
        </div>
        <div id="profile-btn">
            <a href="account"><div id="profile-btn-b">Back</div></a>
            <input type="submit" id="profile-btn-s" value="Update">
        </div>
    </div>
</form>
<?php endforeach; ?>
<?php endif; ?>