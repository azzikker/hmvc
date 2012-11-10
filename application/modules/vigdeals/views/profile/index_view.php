<div style="text-align: center;"><span id='errorprof'><?php echo $this->session->flashdata("error"); ?></span></div>
<div id="profile">
    <div id="profile-pic"><img src="<?php echo $this->vauth->get_picture('large') ?>"></div>
    <div id="profile-h">Welcome, <?php echo $this->session->userdata("vigdeals_login_name") ?></div>
    <div id="profile-c">
<?php foreach($profile_infos as $pi): ?>
        <div id="profile-c-ei"><a href="account/edit">Edit Information</a></div>
        <div id="profile-c-c">
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
<?php if(isset($pi->customer_gender)): ?>
<?php $gen = $this->db->get_where("gender",array("gender_id"=>$pi->customer_gender))->row("gender_name"); ?>
            <div id="profile-c-c-div">
                <div id="profile-c-c-l">Gender:</div>
                <div id="profile-c-c-i"><?php echo $gen; ?></div>
            </div>
<?php endif; ?>
            <div id="profile-c-c-div">
                <div id="profile-c-c-l">Contact No:</div>
                <div id="profile-c-c-i"><?php echo $pi->customer_no ?></div>
            </div>
            <div id="profile-c-c-div">
                <div id="profile-c-c-l">Zip Postal Code:</div>
                <div id="profile-c-c-i"><?php echo $pi->customer_zipcode ?></div>
            </div>
            <div id="profile-c-c-div">
                <div id="profile-c-c-l">Address:</div>
                <div id="profile-c-c-i"><?php echo $pi->customer_address ?></div>
            </div>
            <div id="profile-c-c-div">
                <div id="profile-c-c-l">City:</div>
                <div id="profile-c-c-i"><?php echo $pi->customer_city ?></div> 
            </div>
            <div id="profile-c-c-div">
                <div id="profile-c-c-l">Province:</div>
                <div id="profile-c-c-i"><?php echo $pi->customer_province ?></div>
            </div>
        </div>
<?php endforeach; ?>
    </div>
    <div id="profile-btn">
        <a href="order"><div id="profile-btn-v">My Voucher >></div></a>
    </div>
</div>