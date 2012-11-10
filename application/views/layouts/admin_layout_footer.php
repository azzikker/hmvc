<?php $first_name = $this->session->userdata('user_firstname'); ?>
<?php $last_name = $this->session->userdata('user_lastname'); ?>
<?php $level = $this->session->userdata('user_level'); ?>
<?php $whole_name = $first_name . " " . $last_name; ?>
<?php $table = "user_level"; $user_where["level_id"] = $level; ?>
<?php $sql = $this->db->get_where($table, $user_where); ?>
    
    <br><br><br>
    </div>   
    </section>
    <section id="secondary_bar">
        <div class="user">
            <p><?php echo $whole_name; ?></p>
        </div>
        <div class="breadcrumbs_container">
            <article class="breadcrumbs ">
                <a href="admin/"><?php foreach($sql->result() as $row) : echo ucwords($row->level_name); endforeach ?></a> 
                <div class="breadcrumb_divider"></div> 
                <a class="current"><?php echo $page; ?></a>
            </article>
<?php $m = "F"; $d = "d"; $y = "Y"; $h = "h"; $i = "i"; $s = "s"; ?>
            <ul class="date_tab"><li><?php echo ""; ?></li></ul> 
        </div>
    </section>
    <!-- END OF SECONDARY BAR -->
    <header id="header">
        <hgroup>
            <h1 class="site_title"><a><center><span class="orange_part">VIGATTIN</span><span class="gray_part">DEALS</span></center></a></h1>
            <h2 class="section_title"><a href="<?php echo base_url(); ?>" target="_new">View Site</a></h2>
            <div class="btn_view_site"><a onclick="return c_ask('Do you realy want to log out?')" href="<?php echo base_url(); ?>user/logout" class="logout_user" title="Log Out"></a></div>
        </hgroup>
    </header> 
    <!-- END OF HEADER BAR -->